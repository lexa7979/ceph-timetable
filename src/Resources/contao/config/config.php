<?php

//$GLOBALS[?TL_HOOKS?][?processFormData?][] =[?mybundle.listener.process_form_data?, ?onProcessFormData?];

/**
 * Add back end modules
 */
$GLOBALS['BE_MOD']['timetable'] = [
	'sites'		=> [
		'tables' 	=> ['tl_timetable_sites', 'tl_timetable_rooms'],
		'icon'   	=> 'bundles/cepharumtimetable/home.gif',
	],
	'people'	=> [
		'tables'	=> ['tl_timetable_people'],
		'icon'		=> 'bundles/cepharumtimetable/home.gif',
	],
	'styles'	=> [
		'tables'	=> ['tl_timetable_styles'],
		'icon'		=> 'bundles/cepharumtimetable/home.gif',
	],
];

// $GLOBALS['BE_MOD']['content']['sites'] = [
// 	'tables' 	=> ['tl_timetable_sites', 'tl_timetable_rooms'],
// 	'icon'   	=> 'bundles/cepharumtimetable/home.gif',
// ];
// $GLOBALS['BE_MOD']['content']['people'] = [
// 	'tables'	=> ['tl_timetable_people'],
// 	'icon'		=> 'bundles/cepharumtimetable/home.gif',
// ];
// $GLOBALS['BE_MOD']['content']['styles'] = [
// 	'tables'	=> ['tl_timetable_styles'],
// 	'icon'		=> 'bundles/cepharumtimetable/home.gif',
// ];

/**
 * Front end modules
 * /
array_insert($GLOBALS['FE_MOD'], 4, array
(
	'xing' => array
	(
		'xinglist'   => 'BugBuster\Xing\ModuleXingList'
	)
));
*/
