<?php

//$GLOBALS['TL_HOOKS']['processFormData'][] =['mybundle.listener.process_form_data', 'onProcessFormData'];

// Add back end modules
array_insert($GLOBALS['BE_MOD'], 1, [
	'timetable' => [
		'rooms'		=> ['tables' => ['tl_timetable_sites', 'tl_timetable_rooms'],	'icon' => 'home.gif'],
		'teachers'	=> ['tables' => ['tl_timetable_teachers'],						'icon' => 'home.gif'],
		'styles'	=> ['tables' => ['tl_timetable_styles'],						'icon' => 'home.gif'],
		'courses'	=> ['tables' => ['tl_timetable'],								'icon' => 'home.gif'],
	]
]);

// Front end module(s):
array_insert($GLOBALS['FE_MOD'], 3, [
	// Group title:
	'Cepharum' => [
		// Module title(s) and corresponding class name(s):
		'timetableview' => 'Cepharum\Timetable\ModuleTimetable',
	]
]);

// Style sheet
if (TL_MODE == 'BE')
{
	$GLOBALS['TL_CSS'][] = 'bundles/cepharumtimetable/style.css|static';
}
