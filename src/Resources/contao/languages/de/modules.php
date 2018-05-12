<?php

$items = [
	'timetable'		=> ['Stundenplan',	'Dieses Modul dient dem Anlegen eines Stundenplans.'],
	'rooms'			=> ['Räume',		'Räume verwalten'],
	'teachers'		=> ['Tanzlehrer',	'Tanzlehrer verwalten'],
	'styles'		=> ['Tanzstile',	'Tanzstile verwalten'],
];
foreach ($items as $key => $value) $GLOBALS['TL_LANG']['MOD'][$key] = $value;

// $items = [
// ];
// foreach ($items as $key => $value) $GLOBALS['TL_LANG']['FMD'][$key] = $value;
