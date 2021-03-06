<?php

namespace Cepharum\Timetable;

use Contao\Backend;
use Contao\Config;

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class TimetableRoomsBackend extends Backend {

	public function listRooms($arrRow) {
		$s = [
			0 => ! Config::get('doNotCollapse') ? ' h40' : '',
			1 => $arrRow['roomnumber']
		];
		return <<<EOT
<div class="limit_height$s[0]"><h2>$s[1]</h2></div>
EOT;
	}

	/**
	 * This function is registered in the table's DCA to determine the view of the delete button.
	 * 
	 * The Contao system calls it with the following parameters:
	 * 
	 * @param $row			Array with recordset of the related room
	 * @param $href			Hyperlink from DCA configuration
	 * @param $label		Short caption for button
	 * @param $title		Long caption for button
	 * @param $icon			Icon from DCA configuration
	 * @param $attributes	Attributes of HTML-tag (e.g. class)
	 */
	public function generateDeleteButton($row, $href, $label, $title, $icon, $attributes) {

		$statistics = $this->Database->prepare("SELECT COUNT(*) AS c FROM tl_timetable WHERE room=?")->execute($row['id'])->row();

		if ($statistics['c'] > 0) {
			$icon = 'delete_.svg';
			$label = sprintf($GLOBALS['TL_LANG']['tl_timetable_rooms']['delete_'][0], $row['id']);
			$title = sprintf($GLOBALS['TL_LANG']['tl_timetable_rooms']['delete_'][1], $row['id']);
			$tagname = 'a';
			$tagdata = ' href=""';
			$attributes = 'onclick="return false;"';
		}
		else {
			$tagname = 'a';
			$tagdata = ' href="' . $this->addToUrl("id={$row['id']}&$href", false) . '"';
		}

		return "<$tagname$tagdata title=\"" . \StringUtil::specialchars($title) . "\"$attributes>" . \Image::getHtml($icon, $label) . "</$tagname> ";
	}
}
/***/
