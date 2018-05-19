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
	 * @return
	 */
	public static function getReferenceNames() {

		if (! is_array($this->arrData) || count($this->arrData) == 0)
			return false;

		$objDatabase = Database::getInstance();

		$roomData		= $objDatabase->execute("SELECT * FROM tl_timetable_rooms WHERE id = " . $this->arrData['room'])->row();
		$siteData		= $objDatabase->execute("SELECT * FROM tl_timetable_sites WHERE id = " . $roomData['pid'])->row();
		$styleData		= $objDatabase->execute("SELECT * FROM tl_timetable_styles WHERE id = " . $this->arrData['style'])->row();
		$teacherData	= $objDatabase->execute("SELECT * FROM tl_timetable_teachers WHERE id = " . $this->arrData['teacher'])->row();

		$this->reference_names = [
			'room'		=> $roomData['roomname'],
			'site'		=> $siteData['name'],
			'style'		=> $styleData['name'],
			'teacher'	=> $teacherData['name']
		];

		return true;
	}
}
