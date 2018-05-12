<?php

namespace Cepharum\TimetableBundle;

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class TimetableRoomsBackend extends \Backend {

	public function listRooms($arrRow) {
		$s = [
			0 => !\Config::get('doNotCollapse') ? ' h40' : '',
			1 => $arrRow['roomnumber']
		];
		return <<<EOT
<div class="limit_height$s[0]"><h2>$s[1]</h2></div>
EOT;
	}
}
