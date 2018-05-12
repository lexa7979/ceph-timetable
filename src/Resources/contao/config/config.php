<?php

//$GLOBALS['TL_HOOKS']['processFormData'][] =['mybundle.listener.process_form_data', 'onProcessFormData'];

/**
 * Add back end modules:
 */
array_insert($GLOBALS['BE_MOD'], 1, [
	'CepharumTimetable' => [
		'Sites and rooms' => [
			'tables' 	=> ['tl_timetable_sites', 'tl_timetable_rooms'],
			'icon'   	=> 'home.gif',
		],
		'Teachers' => [
			'tables'	=> ['tl_timetable_teachers'],
			'icon'		=> 'home.gif',
		],
		'Dancestyles'	=> [
			'tables'	=> ['tl_timetable_styles'],
			'icon'		=> 'home.gif',
		],
	]
]);

/**
 * Add front end module:
 */
if (! array_key_exists('Cepharum', $GLOBALS['FE_MOD']))
		$GLOBALS['FE_MOD']['Cepharum'] = array();
$GLOBALS['FE_MOD']['Cepharum']['Timetable'] = 'Cepharum\\TimetableBundle\\Module\\TimetableView';
