<?php

// Reference: https://docs.contao.org/books/api/dca/reference.html

$GLOBALS['TL_DCA']['tl_timetable_styles'] = [

	// Table configuration:
	'config'	=> [
		'dataContainer'		=> 'Table',
		'enableVersioning'	=> false,
		'sql'				=> ['keys' => ['id' => 'primary']],
	],

	// Structure within database:
	'fields'	=> [
		'id'		=> [
			'sql'			=> "int(10) unsigned NOT NULL auto_increment"
		],
		'name'		=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable_styles']['name'],
			'exclude'		=> true,
			'search'		=> true,
			'sorting'		=> true,
			'flag'			=> 1,
			'inputType'		=> 'text',
			'eval'			=> ['mandatory' => true, 'maxlength' => 255],
			'sql'			=> "varchar(255) NOT NULL default ''",
		],
		'background'=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable_styles']['background'],
			'exclude'		=> true,
			'search'		=> true,
			'sorting'		=> true,
			'flag'			=> 1,
			'inputType'		=> 'text',
			'eval'			=> ['minlength' => 6, 'colorpicker' => true],
			'sql'			=> "varchar(6) NOT NULL DEFAULT '000000'",
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
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_styles']['edit'],
				'href'		=> 'act=edit',
				'icon'		=> 'edit.gif',
			],
			'copy'		=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_styles']['copy'],
				'href'		=> 'act=copy',
				'icon'		=> 'copy.gif',
			],
			'delete'	=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_styles']['delete'],
				'href'		=> 'act=delete',
				'icon'		=> 'delete.gif',
				'attributes'=> 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
				'button_callback'
							=> array('Cepharum\Timetable\TimetableStylesBackend', 'generateDeleteButton'),
			],
			'show'		=> [
				'label'		=> &$GLOBALS['TL_LANG']['tl_timetable_styles']['show'],
				'href'		=> 'act=show',
				'icon'		=> 'show.gif'
			]
		]
	],

	'palettes'	=> [
		'__selector__'		=> [],
		'default'			=> 'name,background'
	],
];
