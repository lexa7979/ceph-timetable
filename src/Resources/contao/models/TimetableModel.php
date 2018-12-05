<?php

namespace Cepharum\Timetable;

use Contao\Model;
use Contao\Database;

class TimetableModel extends Model {

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_timetable';

	/**
	 * @property $reference_names
	 */
	public $reference_names = [];

	/**
	 *
	 **/
	public static function getCompleteTimetable() {

		$objDatabase = Database::getInstance();

		$rooms_data = $objDatabase->execute("SELECT r.id AS room_id, r.roomnumber AS roomnumber, s.name AS sitename FROM tl_timetable_rooms r INNER JOIN tl_timetable_sites s ON r.pid = s.id ORDER BY s.sorting, r.sorting")->fetchAllAssoc();
		$courses_data = $objDatabase->execute("SELECT c.*, t.name AS teacher_name, s.id AS style_id, s.name AS style_name, s.background AS background FROM tl_timetable c JOIN tl_timetable_teachers t ON c.teacher = t.id JOIN tl_timetable_styles s ON c.style = s.id")->fetchAllAssoc();
		$styles_data = $objDatabase->execute("SELECT s.id AS id, s.name AS name, s.filter_name AS filter_name FROM tl_timetable_styles s ORDER BY s.name")->fetchAllAssoc();
		$styles_count = $objDatabase->execute("SELECT c.style AS style_id, COUNT(c.id) AS n_courses FROM tl_timetable c GROUP BY c.style")->fetchAllAssoc();

		// Get the range of times in which courses take place:
		$range_data = $objDatabase->execute("SELECT COUNT(*) AS c, MIN(time+duration*30) AS t_min, MAX(time+duration*30) AS t_max FROM tl_timetable WHERE placement = 0")->row();
		$range_placements = $objDatabase->execute("SELECT COUNT(*) AS c, MIN(placement) AS p_min, MAX(placement) AS p_max FROM tl_timetable WHERE placement > 0 AND placement < 24")->row();
		$range_placements2 = $objDatabase->execute("SELECT COUNT(*) AS c FROM tl_timetable WHERE placement = 24")->row();
		$range_data['t_min'] = min(
			($range_data['c'] > 0) ? floor($range_data['t_min'] / 3600) : 25,
			($range_placements['c'] > 0) ? $range_placements['p_min'] : 25,
			($range_placements2['c'] > 0) ? 0 : 25
		);
		$range_data['t_max'] = max(
			($range_data['c'] > 0) ? floor($range_data['t_max'] / 3600) : -1,
			($range_placements['c'] > 0) ? $range_placements['p_max'] : -1
		);

		// Get the number of courses which take place in every room during the week:
		$room_count_data = $objDatabase->execute("SELECT c.room AS room_id, COUNT(c.id) AS c FROM tl_timetable c JOIN tl_timetable_rooms r ON c.room = r.id GROUP BY c.room")->fetchAllAssoc();
		foreach ($rooms_data as $k => $r) {
			$rooms_data[$k]['count'] = 0;
			foreach ($room_count_data as $c) if ($r['room_id'] == $c['room_id']) {
				$rooms_data[$k]['count'] = $c['c'];
				break;
			}
		}

		// Process styles and prepare suitable data for filtering:
		$styles_filter_data = array('hidden');	// new filter-ID => caption
		$styles_filter_map = array();			// style-ID => new filter-ID
		foreach ($styles_data as $record) {
			// Ensure that there actually are courses which use the current style:
			$skip = true;
			foreach ($styles_count as $o) {
				if ($o['style_id'] == $record['id'] && $o['n_courses'] > 0) {
					$skip = false;
					break;
				}
			}
			if ($skip)
				continue;
			// Get current filter-caption:
			$filter_name = $record['filter_name'];
			// Ensure that a filter-caption was given:
			if ($filter_name == '') {
				// Memorise that the courses of the current style should not apply to any filter:
				$styles_filter_map[$record['id']] = 0;
				continue;
			}
			// Create new filter-ID for current filter-caption if it hasn't appeared before:
			$filter_id = array_search($filter_name, $styles_filter_data);
			if ($filter_id === FALSE) {
				$styles_filter_data[] = $filter_name;
				$filter_id = array_search($filter_name, $styles_filter_data);
			}
			// Connect found filter-ID with current style-ID:
			$styles_filter_map[$record['id']] = $filter_id;
		}

		// Prepare first level of timetable - weekdays:
		$timetable = [];
		for ($wd = 0; $wd <= 5; $wd++) {
			$timetable[$wd] = [];
			// Prepare second level of timetable - sites and rooms:
			// (Ensure that only those rooms are included which are used for at least one course at all.)
			foreach ($rooms_data as $r) if ($r['count'] > 0) {
				$sn = $r['sitename'];
				$rn = $r['roomnumber'];
				if (! is_array($timetable[$wd][$sn]))
					$timetable[$wd][$sn] = [];
				$timetable[$wd][$sn][$rn] = [];
				// Prepare third level of timetable - times:
				for ($ti = $range_data['t_min']; $ti <= $range_data['t_max']; $ti++) {
					// Add data about the course at the current site and time:
					$timetable[$wd][$sn][$rn][$ti] = null;
					foreach ($courses_data as $k => $c) {
						$start = floor($c['time'] / 60);
						$end = $start + $c['duration'];
						$mid = floor($start + $c['duration'] / 2);
						$hour = ($c['placement'] == 0) ? floor($mid / 60) : $c['placement'] % 24;
						if ($hour == $ti && $c['weekday'] == $wd && $c['room'] == $r['room_id']) {
							$timetable[$wd][$sn][$rn][$ti] = [
								'array-key'			=> $k,
								'start'				=> [floor($start / 60), $start % 60],
								'end'				=> [floor($end / 60), $end % 60],
								'teacher'			=> $c['teacher_name'],
								'style'				=> $c['style_name'],
								'style_id'			=> $styles_filter_map[$c['style_id']],
								'background'		=> $c['background'],
								'description'		=> $c['description'],
								'ages'				=> $c['ages'],
								'audience'			=> ($c['audience']) ? implode(',', unserialize($c['audience'])) : '',
								'is_forbeginners'	=> ($c['is_forbeginners'] == 1),
								'is_fullybooked'	=> ($c['is_fullybooked'] == 1),
							];
						}
					}
				}
			}
		}

		// Determine for every weekday which lines of the course plan
		// are empty at the beginning and at the end of the day:
		$weekdays = [];
		for ($wd = 0; $wd <= 5; $wd++) {
			$ti_min = null;
			$ti_max = null;
			foreach (array_keys($timetable[$wd]) as $sn) {
				foreach (array_keys($timetable[$wd][$sn]) as $rn) {
					foreach ($timetable[$wd][$sn][$rn] as $ti => $course) {
						if (is_array($course)) {
							$ti_min = ($ti_min === null || $ti < $ti_min) ? $ti : $ti_min;
							$ti_max = ($ti_max === null || $ti > $ti_max) ? $ti : $ti_max;
						}
					}
				}
			}
			if ($ti_min !== null)
				$weekdays[$wd] = [$ti_min, $ti_max];
		}

		\System::loadLanguageFile('tl_timetable');

		return [
			'timetable' => $timetable,
			'courses'	=> $courses_data,
			'weekdays'	=> $weekdays,
			'styles'	=> $styles_filter_data,	//$styles_data,
			'lang'		=> $GLOBALS['TL_LANG']['tl_timetable'],
		];
	}
}
