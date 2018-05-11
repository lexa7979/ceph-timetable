<?php

$GLOBALS['TL_DCA']['tl_timetable_rooms'] = [

	// General options:
	'config' 	=> [
		'dataContainer'		=> 'Table',
		'ptable'			=> 'tl_timetable_sites',
		'switchToEdit'		=> true,	// sorting mode 4 only...
		'enableVersioning'	=> true,
		'sql'				=> ['keys' => ['id' => 'primary']],
	],

	// Structure of record list:
	'list'		=> [
		'sorting'	=> [
			'mode'			=> 4,		// "Displays the child records of a parent record (see style sheets module)"
			'flag'			=> 1,
			'fields'		=> ['sorting'],
			'panelLayout'	=> 'debug;filter;sort,search,limit',
			'headerFields'	=> ['roomnumber'],
		],
		'label' 	=> [
			'fields'		=> ['roomnumber'],
			'format'		=> '%s',
			'showColumns'	=> true,
		],
		'global_operations'=> [
		],
		'operations'=> [
			'edit'		=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_rooms']['edit'],
				'href'		=> 'table=tl_timetable_rooms',
				'icon'		=> 'edit.gif',
			],
			'editheader'=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_rooms']['editheader'],
				'href'		=> 'act=edit',
				'icon'		=> 'header.gif',
			],
			'copy' 		=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_rooms']['copy'],
				'href'		=> 'act=copy',
				'icon'		=> 'copy.gif',
			],
			'delete' 	=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_rooms']['delete'],
				'href'		=> 'act=delete',
				'icon'		=> 'delete.gif',
				'attributes'=> 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
			],
			'show'		=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_rooms']['show'],
				'href'		=> 'act=show',
				'icon'		=> 'show.gif',
			]
		]
	],

	// Strucutre of input form:
	'palettes' 	=> [
		'__selector__'		=> [],
		'default'			=> '{description},roomnumber',
	],
	
	// Structure inside database:
	'fields' 	=> [
		'id'		=> [
			'sql'			=> "int(10) unsigned NOT NULL auto_increment",
		],
		'pid'		=> [
			'sql'			=> "int(10) unsigned NOT NULL default '0'",
			'foreignKey'	=> 'tl_timetable_sites.name',
			'relation'		=> ['type' => 'belongsTo', 'load' => 'lazy'],
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
	],
];
