<?php

namespace Cepharum\Timetable;

$GLOBALS['TL_DCA']['tl_timetable'] = [

	// Contao reference: https://docs.contao.org/books/api/dca/reference.html

	// Table configuration:
	'config' 	=> [
		'label'				=> &$GLOBALS['TL_LANG']['tl_timetable']['label'],
		'dataContainer'		=> 'Table',
		'enableVersioning'	=> false,
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
			'eval'			=> ['tl_class' => 'w50'],
			'sql'			=> "int(4) NOT NULL default '0'",
		],
		'time'		=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable']['time'],
			'exclude'		=> true,
			'search'		=> true,
			// 'sorting'		=> true,
			'flag'			=> 11,							// "Sort ascending"
			'inputType'		=> 'text',
			'eval'			=> ['rgxp' => 'time', 'tl_class' => 'w50'],
			'sql'			=> "int(18) NOT NULL default '43200'",
		],
		'duration'	=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable']['duration'],
			'default'		=> '60',
			'exclude'		=> true,
			'search'		=> true,
			'flag'			=> 11,
			'inputType'		=> 'text',
			'eval'			=> ['rgxp' => 'natural', 'tl_class' => 'w50'],
			'sql'			=> "int(8) NOT NULL default '60'",
		],
		'room'		=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable']['room'],
			'exclude'		=> true,
			'search'		=> true,
			// 'sorting'		=> true,
			'flag'			=> 1,							// "Sort by initial letter ascending"
			'inputType'		=> 'select',
			'foreignKey'	=> 'tl_timetable_rooms.roomnumber',	// Get options from a database table
			'options_callback'
							=> ['Cepharum\Timetable\TimetableBackend', 'listRooms'],
			'sql'			=> "int(10) unsigned NOT NULL default '0'",
			'eval'			=> ['tl_class' => 'w50'],
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
			'eval'			=> ['tl_class' => 'w50'],
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
			'eval'			=> ['tl_class' => 'w50'],
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
			'eval'			=> ['tl_class' => 'w50'],
			'sql'			=> "varchar(255) NOT NULL default ''"
		],
		'ages'		=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable']['ages'],
			'exclude'		=> true,
			'search'		=> true,
			// 'sorting'		=> true,
			'flag'			=> 1,							// "Sort by initial letter ascending"
			'inputType'		=> 'text',
			'eval'			=> ['tl_class' => 'w50'],
			'sql'			=> "varchar(255) NOT NULL default ''"
		],
		'audience'		=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable']['audience'],
			'default'		=> array('children', 'teenager', 'adults'),
			'exclude'		=> true,
			'inputType'		=> 'checkboxWizard',
			'options'		=> array('children', 'teenager', 'adults'),
			'eval'			=> array('multiple' => true, 'tl_class' => 'wizard m12'),
			'reference'		=> &$GLOBALS['TL_LANG']['tl_timetable'],
			'sql'			=> "varchar(255) NOT NULL default ''"
		],
		'is_forbeginners'=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable']['is_forbeginners'],
			'exclude'		=> true,
			'search'		=> true,
			// 'sorting'		=> true,
			'flag'			=> 11,							// "Sort ascending"
			'inputType'		=> 'checkbox',
			'eval'			=> ['tl_class' => 'w50'],
			'sql'			=> "char(1) NOT NULL default ''"
		],
		'is_fullybooked'=> [
			'label'			=> &$GLOBALS['TL_LANG']['tl_timetable']['is_fullybooked'],
			'exclude'		=> true,
			'search'		=> true,
			// 'sorting'		=> true,
			'flag'			=> 11,							// "Sort ascending"
			'inputType'		=> 'checkbox',
			'eval'			=> ['tl_class' => 'w50'],
			'sql'			=> "char(1) NOT NULL default ''"
		],
		'tstamp'	=> [
			'sql'			=> "int(10) unsigned NOT NULL default '0'",
		],
	],

	// Listing records:
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

	// Structure of input form:
	'palettes' 	=> [
		'__selector__'		=> [],
		'default'			=> '{time_place_legend},weekday,room,time,duration;{title_legend},audience,style,teacher,description,ages,is_fullybooked,is_forbeginners',
	],
];
