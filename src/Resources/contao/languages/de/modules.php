<?php

$item_group = [
	'MOD' => [
		'timetable'		=> ['Kursplan',		'Dieses Modul dient dem Anlegen eines Stundenplans.'],
		'rooms'			=> ['Räume',		'Gebäude und Räume verwalten'],
		'teachers'		=> ['Lehrer',		'Tanzlehrer verwalten'],
		'styles'		=> ['Tanzstile',	'Tanzstile verwalten'],
		'courses'		=> ['Kurse',		'Tanzkurse verwalten'],
	],
	// 'FMD' => [
	// ],
];
foreach ($item_group as $type => $items) foreach ($items as $key => $value) $GLOBALS['TL_LANG'][$type][$key] = $value;

// foreach ($items['MOD'] as $key => $value) $GLOBALS['TL_LANG']['MOD'][$key] = $value;
// foreach ($items['FMD'] as $key => $value) $GLOBALS['TL_LANG']['FMD'][$key] = $value;
