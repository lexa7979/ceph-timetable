<?php

namespace Cepharum\Timetable;

use Contao\Backend;

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */

class TimetableBackend extends Backend {

	public function listCourses($arrRow) {

		$refData = [
			'room'		=> $this->Database->execute("SELECT r.roomnumber AS title, r.pid AS pid FROM tl_timetable_rooms r WHERE id = " . $arrRow['room'])->next(),
			'style'		=> $this->Database->execute("SELECT s.name AS title FROM tl_timetable_styles s WHERE id = " . $arrRow['style'])->next(),
			'teacher'	=> $this->Database->execute("SELECT t.name AS title FROM tl_timetable_teachers t WHERE id = " . $arrRow['teacher'])->next(),
		];

		if ($refData['room'] != null)
			$refData['site'] = $this->Database->execute("SELECT s.name AS title FROM tl_timetable_sites s WHERE id = " . $refData['room']->pid)->next();

		foreach ($refData as $v)	if ($v == null)
			return "<div style=\"color: red\">" . $GLOBALS['TL_LANG']['tl_timetable']['error_incomplete'][1] . "</div>";

		$refTitle = [];
		foreach ($refData as $k => $v)
		 	$refTitle[$k] = $v->title;

		$roomdata = $this->Database->execute("SELECT * FROM tl_timetable_rooms r WHERE id = " . $arrRow['room'])->next();
		$sitedata = $this->Database->execute("SELECT * FROM tl_timetable_sites s WHERE id = " . $roomdata->pid)->next();
		$styledata = $this->Database->execute("SELECT * FROM tl_timetable_styles s WHERE id = " . $arrRow['style'])->next();
		$teacherdata = $this->Database->execute("SELECT * FROM tl_timetable_teachers t WHERE id = " . $arrRow['teacher'])->next();

		$s = [
			0 => $GLOBALS['TL_LANG']['tl_timetable']['time'][0],
			1 => substr($arrRow['time'], 0, 5),
			// 2 => $GLOBALS['TL_LANG']['tl_timetable']['room'][0] . ' ' . $roomdata->roomnumber,
			2 => $GLOBALS['TL_LANG']['tl_timetable']['room'][0] . ' ' . $refTitle['room'],
			3 => $GLOBALS['TL_LANG']['tl_timetable']['site'][0] . ' ' . $sitedata->name,
			4 => $styledata->name,
			5 => $GLOBALS['TL_LANG']['tl_timetable']['teacher'][0] . ' ' . $teacherdata->name,
			6 => ($arrRow['description'] == '') ? $GLOBALS['TL_LANG']['tl_timetable']['no_description'][0] : $arrRow['description'],
			7 => ($arrRow['ages'] == '') ? $GLOBALS['TL_LANG']['tl_timetable']['no_ages'][0] : $arrRow['ages'],
			8 => $GLOBALS['TL_LANG']['tl_timetable']['is_forbeginners_switch'][($arrRow['is_forbeginners'] == 1) ? 1 : 0],
			9 => $GLOBALS['TL_LANG']['tl_timetable']['is_fullybooked_switch'][($arrRow['is_fullybooked'] == 1) ? 1 : 0],
		];
		foreach ($s as $k => $v)
			$s[$k] = trim($v);
		return <<<EOT
<h2>$s[1]</h2>
<div style="margin-left: 30px">$s[2] ($s[3]): $s[4] ($s[5])</div>
<div style="margin-left: 30px">$s[6], $s[7] ($s[8], $s[9])</div>
EOT;
	}
}
