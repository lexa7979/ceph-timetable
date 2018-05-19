<?php

namespace Cepharum\Timetable;

$GLOBALS['TL_DCA']['tl_timetable'] = [

	// General options:
	'config' 	=> [
		'dataContainer'		=> 'Table',
		'enableVersioning'	=> true,
		'sql'				=> ['keys' => ['id' => 'primary']],
	],
	
	// Structure within database:
	'fields' 	=> [
		'id'		=> [
			'sql'			=> "int(10) unsigned NOT NULL auto_increment",
		],
		'weekday'	=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable']['weekday'],
			'exclude'		=> true,
			'search'		=> true,
			// 'sorting'		=> true,
			'flag'			=> 11,							// "Sort ascending"
			'inputType'		=> 'select',
			'options'		=> [0, 1, 2, 3, 4, 5, 6],
			'reference'		=> &$GLOBALS['TL_LANG']['tl_timetable']['weekdays_set'],
			'sql'			=> "int(4) NOT NULL default '0'",
		],
		'time'		=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable']['time'],
			'exclude'		=> true,
			'search'		=> true,
			// 'sorting'		=> true,
			'flag'			=> 11,							// "Sort ascending"
			'inputType'		=> 'select',
			'options'		=> ['06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:00'],
			'sql'			=> "time NOT NULL default '12:00:00'",
		],
		'room'		=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable']['room'],
			'exclude'		=> true,
			'search'		=> true,
			// 'sorting'		=> true,
			'flag'			=> 1,							// "Sort by initial letter ascending"
			'inputType'		=> 'select',
			'foreignKey'	=> 'tl_timetable_rooms.roomnumber',	// Get options from a database table
			'sql'			=> "int(10) unsigned NOT NULL default '0'",
			'relation'		=> ['type' => 'belongsTo', 'load' => 'lazy']
		],
		'teacher'	=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable']['teacher'],
			'exclude'		=> true,
			'search'		=> true,
			// 'sorting'		=> true,
			'flag'			=> 1,							// "Sort by initial letter ascending"
			'inputType'		=> 'select',
			'foreignKey'	=> 'tl_timetable_teachers.name',// Get options from a database table
			'sql'			=> "int(10) unsigned NOT NULL default '0'",
			'relation'		=> ['type' => 'belongsTo', 'load' => 'lazy']
		],
		'style'		=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable']['style'],
			'exclude'		=> true,
			'search'		=> true,
			// 'sorting'		=> true,
			'flag'			=> 1,							// "Sort by initial letter ascending"
			'inputType'		=> 'select',
			'foreignKey'	=> 'tl_timetable_styles.name',	// Get options from a database table
			'sql'			=> "int(10) unsigned NOT NULL default '0'",
			'relation'		=> ['type' => 'belongsTo', 'load' => 'lazy']
		],
		'description'=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable']['description'],
			'exclude'		=> true,
			'search'		=> true,
			// 'sorting'		=> true,
			'flag'			=> 1,							// "Sort by initial letter ascending"
			'inputType'		=> 'text',
			'sql'			=> "varchar(255) NOT NULL default ''"
		],
		'ages'		=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable']['ages'],
			'exclude'		=> true,
			'search'		=> true,
			// 'sorting'		=> true,
			'flag'			=> 1,							// "Sort by initial letter ascending"
			'inputType'		=> 'text',
			'sql'			=> "varchar(255) NOT NULL default ''"
		],
		'is_forbeginners'=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable']['is_forbeginners'],
			'exclude'		=> true,
			'search'		=> true,
			// 'sorting'		=> true,
			'flag'			=> 11,							// "Sort ascending"
			'inputType'		=> 'checkbox',
			'sql'			=> "char(1) NOT NULL default ''"
		],
		'is_fullybooked'=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable']['is_fullybooked'],
			'exclude'		=> true,
			'search'		=> true,
			// 'sorting'		=> true,
			'flag'			=> 11,							// "Sort ascending"
			'inputType'		=> 'checkbox',
			'sql'			=> "char(1) NOT NULL default ''"
		],
		'tstamp'	=> [
			'sql'			=> "int(10) unsigned NOT NULL default '0'",
		],
	],

	// Structure of record list:
	'list'		=> [
		'sorting'	=> [
			'mode'			=> 1,							// "Records are sorted by a fixed field"
			// 'mode'			=> 4,							// "Displays the child records of a parent record"
			'flag'			=> 1,							// "Sort by initial letter ascending"
			'fields'		=> ['weekday', 'time'],
			'panelLayout'	=> 'filter;sort,search,limit',
		],
		'label' 	=> [
			// 'fields'		=> ['weekday', 'time', 'room:tl_timetable_rooms.roomnumber', 'teacher:tl_timetable_teachers.name', 'style:tl_timetable_styles.name', 'description', 'ages'],
			// 'format'		=> '%s',
			'showColumns'	=> false,
			'label_callback'=> [TimetableBackend::class, 'listCourses'],
			// 'label_callback'=> ['Cepharum\Timetable\TimetableBackend', 'listCourses'],
		],
		'global_operations'=> [
		],
		'operations'=> [
			'edit'		=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_rooms']['edit'],
				'href'		=> 'act=edit',
				'icon'		=> 'edit.gif'
			],
			'copy' 		=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_rooms']['copy'],
				'href'		=> 'act=copy',
				'icon'		=> 'copy.gif'
			],
			'delete' 	=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_rooms']['delete'],
				'href'		=> 'act=delete',
				'icon'		=> 'delete.gif',
				'attributes'=> 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			],
			'show'		=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_rooms']['show'],
				'href'		=> 'act=show',
				'icon'		=> 'show.gif'
			]
		]
	],

	// Strucutre of input form:
	'palettes' 	=> [
		'__selector__'		=> [],
		'default'			=> '{title_legend},weekday,time,room,teacher,style,description,ages,is_forbeginners,is_fullybooked',
	],
];

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 * /
class TimetableBackend extends \Backend {

	public function listCourses($arrRow) {

		$refData = TimetableModel();
		$refData->findByPk($arrRow['id']);
		if (! $refData->getReferenceNames())
			return "<div>" . $GLOBALS['TL_LANG']['tl_timetable']['error_incomplete'][1] . "</div>";

		// $refData = [
		// 	'room'		=> $this->Database->execute("SELECT r.roomnumber AS title, r.pid AS pid FROM tl_timetable_rooms r WHERE id = " . $arrRow['room']),
		// 	'style'		=> $this->Database->execute("SELECT s.name AS title FROM tl_timetable_styles s WHERE id = " . $arrRow['style']),
		// 	'teacher'	=> $this->Database->execute("SELECT t.name AS title FROM tl_timetable_teachers t WHERE id = " . $arrRow['teacher']),
		// ];
		// $refTitle = [];
		// foreach ($refData as $k => $r)
		// 	$refTitle['$k'] = $r->next()->title;

		$roomdata = $this->Database->execute("SELECT * FROM tl_timetable_rooms r WHERE id = " . $arrRow['room'])->next();
		$sitedata = $this->Database->execute("SELECT * FROM tl_timetable_sites s WHERE id = " . $roomdata->pid)->next();
		$styledata = $this->Database->execute("SELECT * FROM tl_timetable_styles s WHERE id = " . $arrRow['style'])->next();
		$teacherdata = $this->Database->execute("SELECT * FROM tl_timetable_teachers t WHERE id = " . $arrRow['teacher'])->next();

		$s = [
			0 => $GLOBALS['TL_LANG']['tl_timetable']['time'][0],
			1 => substr($arrRow['time'], 0, 5),
			// 2 => $GLOBALS['TL_LANG']['tl_timetable']['room'][0] . ' ' . $roomdata->roomnumber,
			2 => $GLOBALS['TL_LANG']['tl_timetable']['room'][0] . ' ' . $refData->reference_names['room'],
			3 => $GLOBALS['TL_LANG']['tl_timetable']['site'][0] . ' ' . $sitedata->name,
			4 => $styledata->name,
			5 => $GLOBALS['TL_LANG']['tl_timetable']['teacher'][0] . ' ' . $teacherdata->name,
			6 => $arrRow['description'],
			7 => $arrRow['ages'],
			8 => $GLOBALS['TL_LANG']['tl_timetable']['is_forbeginners_switch'][($arrRow['is_forbeginners'] == 1) ? 1 : 0],
			9 => $GLOBALS['TL_LANG']['tl_timetable']['is_fullybooked_switch'][($arrRow['is_fullybooked'] == 1) ? 1 : 0],
		];
		foreach ($s as $k => $v)
			$s[$k] = trim($v);
		return <<<EOT
<div style="font-weight: bold">$s[1]</div>
<div style="margin-left: 30px">$s[2] ($s[3]): $s[4] ($s[5])</div>
<div style="margin-left: 30px">$s[6], $s[7] ($s[8], $s[9])</div>
EOT;
	}
}
/***/
