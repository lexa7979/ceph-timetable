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

	// /**
	//  * 
	//  * @return
	//  */
	// public function getReferenceNames() {

	// 	if (! is_array($this->arrData) || count($this->arrData) == 0)
	// 		return false;

	// 	$objDatabase = Database::getInstance();

	// 	$roomData		= $objDatabase->execute("SELECT * FROM tl_timetable_rooms WHERE id = " . $this->arrData['room'])->row();
	// 	$styleData		= $objDatabase->execute("SELECT * FROM tl_timetable_styles WHERE id = " . $this->arrData['style'])->row();
	// 	$teacherData	= $objDatabase->execute("SELECT * FROM tl_timetable_teachers WHERE id = " . $this->arrData['teacher'])->row();

	// 	$siteData		= $objDatabase->execute("SELECT * FROM tl_timetable_sites WHERE id = " . $roomData['pid'])->row();

	// 	$this->reference_names = [
	// 		'room'		=> $roomData['roomname'],
	// 		'site'		=> $siteData['name'],
	// 		'style'		=> $styleData['name'],
	// 		'teacher'	=> $teacherData['name']
	// 	];

	// 	return true;
	// }

	public static function getCompleteTimetable() {

		$objDatabase = Database::getInstance();

		$rooms_data = $objDatabase->execute("SELECT r.id AS room_id, r.roomnumber AS roomnumber, s.name AS sitename FROM tl_timetable_rooms r INNER JOIN tl_timetable_sites s ON r.pid = s.id ORDER BY s.sorting, r.sorting")->fetchAllAssoc();
		$courses_data = $objDatabase->execute("SELECT c.*, t.name AS teacher_name, s.name AS style_name FROM tl_timetable c JOIN tl_timetable_teachers t ON c.teacher = t.id JOIN tl_timetable_styles s ON c.style = s.id")->fetchAllAssoc();

		// Get the range of weekdays and range of times in which courses take place:
		$range_data = $objDatabase->execute("SELECT MIN(weekday) AS w_min, MAX(weekday) AS w_max, MIN(HOUR(time)) AS t_min, MAX(HOUR(time)) AS t_max FROM tl_timetable")->row();

		// Get the number of courses which take place in every room during the week:
		$room_count_data = $objDatabase->execute("SELECT c.room AS room_id, COUNT(c.id) AS c FROM tl_timetable c JOIN tl_timetable_rooms r ON c.room = r.id GROUP BY c.room")->fetchAllAssoc();
		foreach ($rooms_data as $k => $r) {
			$rooms_data[$k]['count'] = 0;
			foreach ($room_count_data as $c)
				if ($r['room_id'] == $c['room_id']) {
					$rooms_data[$k]['count'] = $c['c'];
					break;
				}
		}

		// Prepare first level of timetable - weekdays:
		$timetable = [];
		for ($wd = $range_data['w_min']; $wd <= $range_data['w_max']; $wd++) {
			$timetable[$wd] = [];
			// Prepare second level of timetable - sites and rooms:
			// (Ensure that only those rooms are included which are used for at least one course at all.)
			foreach ($rooms_data as $r) if ($r['count'] > 0) {
				$sn = $r['sitename'];
				$rn = $r['roomnumber'];
				if (! is_array[$timetable[$wd][$sn]])
					$timetable[$wd][$sn] = [];
				$timetable[$wd][$sn][$rn] = [];
				// Prepare third level of timetable - times:
				for ($ti = $range_data['t_min']; $ti <= $range_data['t_max']; $ti++) {
					// Add data about the course at the current site and time:
					// $timetable[$wd][$sn][$rn][$ti] = [];
					$timetable[$wd][$sn][$rn][$ti] = null;
					$ti_s = (($ti < 10) ? "0" : "") . $ti . ":00:00";
					foreach ($courses_data as $k => $c) {
						if ($c['weekday'] == $wd && $c['room'] == $r['room_id'] && $c['time'] == $ti_s) {
							$timetable[$wd][$sn][$rn][$ti] = [
								'array-key'			=> $k,
								'teacher'			=> $c['teacher_name'],
								'style'				=> $c['style_name'],
								'description'		=> $c['description'],
								'ages'				=> $c['ages'],
								'is_forbeginners'	=> ($c['is_forbeginners'] == 1),
								'is_fullybooked'	=> ($c['is_fullybooked'] == 1)
							];
							// $timetable[$wd][$sn][$rn][$ti] = $k;
						}
					}
				}
			}
		}

		// return $courses_data;
		return [
			'timetable' => $timetable,
			'courses'	=> $courses_data,
			// 'weekdays'	=> $GLOBALS['TL_LANG']['FMD']['weekdays_set'],
		];
	}
}
