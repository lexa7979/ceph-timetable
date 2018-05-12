<?php

$GLOBALS['TL_DCA']['tl_timetable_rooms'] = [

	// General options:
	'config' 	=> [
		'dataContainer'		=> 'Table',
		'ptable'			=> 'tl_timetable_sites',
		'enableVersioning'	=> true,
		'sql'				=> ['keys' => ['id' => 'primary']],
	],

	// Structure within database:
	'fields' 	=> [
		'id'		=> [
			'sql'			=> "int(10) unsigned NOT NULL auto_increment",
		],
		'pid'		=> [
			'sql'			=> "int(10) unsigned NOT NULL default '0'",
			'foreignKey'	=> 'tl_timetable_sites.name',
			'relation'		=> ['type' => 'belongsTo', 'load' => 'lazy'],
		],
		'roomnumber'=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable_rooms']['roomnumber'],
			'exclude'		=> true,
			'search'		=> true,
			'sorting'		=> true,
			'flag'			=> 1,
			'inputType'		=> 'text',
			'eval'			=> ['mandatory' => true, 'maxlength' => 255],
			'sql'			=> "varchar(255) NOT NULL default ''",
		],
		'sorting'	=> [
			'label'			=> &$GLOBALS['TL_LANG']['MSC']['sorting'],
			'sorting'		=> true,
			'flag'			=> 11,
			'sql'			=> "int(10) unsigned NOT NULL default '0'",
		],
		'tstamp'	=> [
			'sql'			=> "int(10) unsigned NOT NULL default '0'",
		],
	],

	// Structure of record list:
	'list'		=> [
		'sorting'	=> [
			'mode'			=> 4,		// "Displays the child records of a parent record (see style sheets module)"
			// 'flag'			=> 1,
			'fields'		=> ['sorting'],
			'panelLayout'	=> 'filter;sort,search,limit',
			'headerFields'	=> ['id', 'name', 'tstamp'],
			'child_record_callback'	=> ['TimetableRoomsBackend', 'listRooms']
			// 'child_record_callback'	=> ['Cepharum\Timetable\TimetableRoomsBackend', 'listRooms']
		],
		'label' 	=> [
			'fields'		=> ['roomnumber'],
			'format'		=> '%s',
			'showColumns'	=> true
		],
		'global_operations'=> [
		],
		'operations'=> [
			'edit'		=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_rooms']['edit'],
				'icon'		=> 'edit.gif',
				'href'		=> 'act=edit'
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
		'default'			=> '{title_legend},roomnumber',
	],
];

/**
 * Provide miscellaneous methods that are used by the data configuration array.
 */
class TimetableRoomsBackend extends Backend {

	public function listRooms($arrRow) {
		$s = [
			0 => !Config::get('doNotCollapse') ? ' h40' : '',
			1 => $arrRow['roomnumber']
		];
		return <<<EOT
<div class="limit_height$s[0]"><h2>$s[1]</h2></div>
EOT;
	}
}
