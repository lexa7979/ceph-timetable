<?php

namespace Cepharum\TimetableBundle;

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class TimetableBackend extends \Backend {

	public function listCourses($arrRow) {
		$s = [
			0 => $GLOBALS['TL_LANG']['tl_timetable']['time'][0],
			1 => substr($arrRow['time'], 0, 5),
		];
		return <<<EOT
<div>$s[1]</div>
EOT;
		// $s = "";
		// foreach ($arrRow as $key => $value) if (is_string($value))
		// 	$s .= "<div>$key: $value</div>";
		// return $s;
	}
}
