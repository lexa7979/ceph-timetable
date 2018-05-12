<?php

$new_items = [
	'timetable'		=> ['Stundenplan',	'Dieses Modul dient dem Anlegen eines Stundenplans.'],
	'rooms'			=> ['Räume',		'Räume verwalten'],
	'teachers'		=> ['Tanzlehrer',	'Tanzlehrer verwalten'],
	'styles'		=> ['Tanzstile',	'Tanzstile verwalten'],
];

foreach ($new_items as $key => $value) $GLOBALS['TL_LANG']['MOD'][$key] = $value;

// $GLOBALS['TL_LANG']['MOD']['CepharumTimetable']['0']     = 'Cepharum Stundenplan';
// $GLOBALS['TL_LANG']['MOD']['CepharumTimetable']['1']     = 'Dieses Modul dient zum Anlegen eines Stundenplans.';


// $GLOBALS['TL_LANG']['FMD']['xinglist']['0'] = 'XING-Anzeige';
// $GLOBALS['TL_LANG']['FMD']['xinglist']['1'] = 'Dieses Modul dient zum Anzeigen eines XING-Banners.';
