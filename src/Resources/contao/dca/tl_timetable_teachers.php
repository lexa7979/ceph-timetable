<?php

// Reference: https://docs.contao.org/books/api/dca/reference.html

$GLOBALS['TL_DCA']['tl_timetable_teachers'] = [

	// Table configuration:
	'config'	=> [
		'dataContainer'		=> 'Table',
		'enableVersioning'	=> true,
		'sql'				=> ['keys' => ['id' => 'primary']]
	],

	// Structure within database:
	'fields'	=> [
		'id'		=> [
			'sql'			=> "int(10) unsigned NOT NULL auto_increment"
		],
		'name'		=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable_teachers']['name'],
			'exclude'		=> true,
			'search'		=> true,
			'sorting'		=> true,
			'flag'			=> 1,
			'inputType'		=> 'text',
			'eval'			=> ['mandatory' => true, 'maxlength' => 255],
			'sql'			=> "varchar(255) NOT NULL default ''"
		],
		'tstamp'	=> [
			'sql'			=> "int(10) unsigned NOT NULL default '0'"
		],
	],

	// Listing records:
	'list'		=> [
		'sorting'	=> [
			'mode'			=> 1,		// "Records are sorted by a fixed field"
			'flag'			=> 1,		// "Sort by initial letter ascending"
			'panelLayout'	=> 'filter;sort,search,limit',
			'fields'		=> ['name']
		],
		'label'		=> [
			'fields'		=> ['name'],
			'showColumns'	=> true,
			'format'		=> '%s'
		],
		'global_operations'=> [
		],
		'operations'=> [
			'edit'		=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_teachers']['edit'],
				'href'		=> 'act=edit',
				'icon'		=> 'edit.gif'
			],
			'copy'		=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_teachers']['copy'],
				'href'		=> 'act=copy',
				'icon'		=> 'copy.gif'
			],
			'delete'	=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_teachers']['delete'],
				'href'		=> 'act=delete',
				'icon'		=> 'delete.gif',
				'attributes'=> 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			],
			'show'		=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_teachers']['show'],
				'href'		=> 'act=show',
				'icon'		=> 'show.gif'
			]
		]
	],

	'palettes'	=> [
		'__selector__'		=> [],
		'default'			=> 'name'
	],
];
