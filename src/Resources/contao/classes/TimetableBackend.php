<?php

namespace Cepharum\Timetable;

use Contao\Backend;
use Contao\Database;

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */

class TimetableBackend extends Backend {

	public function listCourses($arrRow) {

		$start = floor($arrRow['time'] / 60);
		$end = $start + $arrRow['duration'];
		// $hour = floor($start / 60);
		$mid = floor(($start + $end) / 2);
		$hour = ($arrRow['placement'] == 0) ? floor($mid / 60) : $arrRow['placement'] % 24;

		$problems = array();

		// Ensure that there is no collision with another course:
		$data = $this->Database->prepare("SELECT c.time AS time, c.placement AS placement, c.duration AS duration FROM tl_timetable c WHERE c.weekday=? AND c.room=? AND c.id<>?")
					->execute($arrRow['weekday'], $arrRow['room'], $arrRow['id']);
		while ($row = $data->next()) {
			$start2 = floor($row->time / 60);
			$end2 = $start2 + $row->duration;
			$mid2 = floor(($start2 + $end2) / 2);
			$hour2 = ($row->placement == 0) ? floor($mid2 / 60) : $row->placement % 24;
			if (($start2 > $start && $start2 < $end) || ($start2 == $start) || ($start2 < $start && $end2 > $start)) {
				$problems[] = ['error', 'error_collision'];
				if ($hour2 == $hour)
					$problems[] = ['error', 'error_collision2'];
				break;
			}
			if ($hour2 == $hour) {
				$problems[] = ['error', 'error_collision2'];
				break;
			}
		}

		// Check if the same teacher has another course at the same time:
		$data = $this->Database->prepare("SELECT c.time AS time, c.duration AS duration FROM tl_timetable c WHERE c.weekday=? AND c.teacher=? AND c.id<>?")
					->execute($arrRow['weekday'], $arrRow['teacher'], $arrRow['id']);
		while ($row = $data->next()) {
			$start2 = floor($row->time / 60);
			$end2 = $start2 + $row->duration;
			if (($start2 > $start && $start2 < $end) || ($start2 == $start) || ($start2 < $start && $end2 > $start)) {
				$problems[] = ['warning', 'warning_teacher'];
				break;
			}
		}

		// Query the related data out of the other tables:
		$refData = [
			'room'		=> $this->Database->execute("SELECT r.roomnumber AS title, r.pid AS pid FROM tl_timetable_rooms r WHERE r.id = " . $arrRow['room'])->next(),
			'style'		=> $this->Database->execute("SELECT s.name AS title FROM tl_timetable_styles s WHERE s.id = " . $arrRow['style'])->next(),
			'teacher'	=> $this->Database->execute("SELECT t.name AS title FROM tl_timetable_teachers t WHERE t.id = " . $arrRow['teacher'])->next(),
		];
		if ($refData['room'] != null)
			$refData['site'] = $this->Database->prepare("SELECT s.name AS title FROM tl_timetable_sites s WHERE s.id=?")->execute($refData['room']->pid)->next();

		// Ensure that there are no dead references:
		foreach ($refData as $v)	if ($v == null) {
			$problems[] = ['fatal', 'error_incomplete'];
			break;
		}

		// Collect the titles of the related datasets:
		$refTitle = [];
		foreach ($refData as $k => $v)
		 	$refTitle[$k] = $v->title;

		$s = [
			// 0 => $GLOBALS['TL_LANG']['tl_timetable']['time'][0],
			// 1 => sprintf("%02d:%02d", floor($arrRow['time'] / 3600), floor(($arrRow['time'] % 3600) / 60)),
			2 => $GLOBALS['TL_LANG']['tl_timetable']['room'][0] . ' ' . $refTitle['room'],
			3 => $GLOBALS['TL_LANG']['tl_timetable']['site'][0] . ' ' . $refTitle['site'],
			4 => $refTitle['style'],	//$styledata->name,
			5 => $GLOBALS['TL_LANG']['tl_timetable']['teacher'][0] . ' ' . $refTitle['teacher'],	//$teacherdata->name,
			6 => ($arrRow['description'] == '') ? $GLOBALS['TL_LANG']['tl_timetable']['no_description'][0] : $arrRow['description'],
			7 => ($arrRow['ages'] == '') ? $GLOBALS['TL_LANG']['tl_timetable']['no_ages'][0] : $arrRow['ages'],
			8 => $GLOBALS['TL_LANG']['tl_timetable']['is_forbeginners_switch'][($arrRow['is_forbeginners'] == 1) ? 1 : 0],
			9 => $GLOBALS['TL_LANG']['tl_timetable']['is_fullybooked_switch'][($arrRow['is_fullybooked'] == 1) ? 1 : 0],
			10 => sprintf($GLOBALS['TL_LANG']['tl_timetable']['format_frontend_time1'], $hour) . (($arrRow['placement'] == 0) ? '' : ', ' . $GLOBALS['TL_LANG']['tl_timetable']['format_frontend_manual']),
			11 => sprintf($GLOBALS['TL_LANG']['tl_timetable']['format_frontend_time2'], floor($start / 60), $start % 60, floor($end / 60), $end % 60),
		];
		foreach ($s as $k => $v)
			$s[$k] = trim($v);

		$s_problem = "";
		foreach ($problems as $p) {
			$color = ($p[0] == 'warning') ? 'green' : 'red';
			$s_problem .= "<div style=\"color: $color\">" . $GLOBALS['TL_LANG']['tl_timetable'][$p[1]][1] . "</div>";
			if ($p[0] == 'fatal')
				return $s_problem;
		}

		return <<<EOT
$s_problem<div><span style="font-weight: bold; font-size: 1.25em">$s[11] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>($s[10])</div>
<div style="margin-left: 30px">$s[2] ($s[3]): $s[4] ($s[5])</div>
<div style="margin-left: 30px">$s[6], $s[7] ($s[8], $s[9])</div>
EOT;
	}

	public static function listRooms() {

		$options = array();

		$objDatabase = Database::getInstance();

		$s_sort = 'name';
		$r_sort = 'sorting';

		$data = $objDatabase->execute("SELECT r.id AS id, r.roomnumber AS room, s.name AS site FROM tl_timetable_rooms r JOIN tl_timetable_sites s ON r.pid = s.id ORDER BY s.$s_sort, r.$r_sort");

		while ($r_data = $data->next())
			$options[$r_data->id] = sprintf($GLOBALS['TL_LANG']['tl_timetable']['roomlist_caption_site_room'], $r_data->site, $r_data->room);

		return $options;
	}
}
