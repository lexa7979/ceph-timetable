<?php

namespace Cepharum\Timetable;

use Contao\Backend;
use Contao\Config;

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class TimetableTeachersBackend extends Backend {

	/**
	 * This function is registered in the table's DCA to determine the view of the delete button.
	 * 
	 * The Contao system calls it with the following parameters:
	 * 
	 * @param $row			Array with recordset of the related style
	 * @param $href			Hyperlink from DCA configuration
	 * @param $label		Short caption for button
	 * @param $title		Long caption for button
	 * @param $icon			Icon from DCA configuration
	 * @param $attributes	Attributes of HTML-tag (e.g. class)
	 */
	public function generateDeleteButton($row, $href, $label, $title, $icon, $attributes) {

		$statistics = $this->Database->prepare("SELECT COUNT(*) AS c FROM tl_timetable WHERE teacher=?")->execute($row['id'])->row();

		if ($statistics['c'] > 0) {
			$icon = 'delete_.svg';
			$label = sprintf($GLOBALS['TL_LANG']['tl_timetable_teachers']['delete_'][0], $row['id']);
			$title = sprintf($GLOBALS['TL_LANG']['tl_timetable_teachers']['delete_'][1], $row['id']);
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
