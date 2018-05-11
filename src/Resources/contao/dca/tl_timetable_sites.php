<?php

$GLOBALS['TL_DCA']['tl_timetable_sites'] = [

	// General options:
	'config'	=> [
		'dataContainer'		=> 'Table',
		'ctable'			=> ['tl_timetable_rooms'],
		'enableVersioning'	=> true,
		'sql'				=> ['keys' => ['id' => 'primary']]
	],

	// Structure of record list:
	'list'		=> [
		'sorting'	=> [
			'mode'			=> 1,		// "Records are sorted by a fixed field"
			'flag'			=> 1,		// "Sort by initial letter ascending"
			'panelLayout'	=> 'debug;filter;sort,search,limit',
			'fields'		=> ['name']
		],
		'label'		=> [
			'fields'		=> ['name'],
			'showColumns'	=> true,
			'format'		=> '%s',
		],
		'global_operations'=> [
		],
		'operations'=> [
			'edit'		=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_sites']['edit'],
				'href'		=> 'table=tl_timetable_sites',
				'icon'		=> 'edit.gif'
			],
			'editheader'=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_sites']['editheader'],
				'href'		=> 'act=edit',
				'icon'		=> 'header.gif',
			],
			'copy'		=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_sites']['copy'],
				'href'		=> 'act=copy',
				'icon'		=> 'copy.gif',
			],
			'delete'	=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_sites']['delete'],
				'href'		=> 'act=delete',
				'icon'		=> 'delete.gif',
				'attributes'=> 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
			],
			'show'		=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_sites']['show'],
				'href'		=> 'act=show',
				'icon'		=> 'show.gif'
			]
		]
	],

	'fields'	=> [
		'id'		=> [
			'sql'			=> "int(10) unsigned NOT NULL auto_increment"
		],
		'sorting'	=> [
			'label'			=> &$GLOBALS['TL_LANG']['MSC']['sorting'],
			'sorting'		=> true,
			'flag'			=> 11,
			'sql'			=> "int(10) unsigned NOT NULL default '0'",
		],
		'tstamp'	=> [
			'sql'			=> "int(10) unsigned NOT NULL default '0'"
		],
		'name'		=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable_sites']['name'],
			'exclude'		=> true,
			'search'		=> true,
			'sorting'		=> true,
			'flag'			=> 1,
			'inputType'		=> 'text',
			'eval'			=> ['mandatory' => true, 'maxlength' => 255],
			'sql'			=> "varchar(255) NOT NULL default ''"
		]
	],

	'palettes'	=> [
		'__selector__'		=> [],
		'default'			=> 'name'
	],
];