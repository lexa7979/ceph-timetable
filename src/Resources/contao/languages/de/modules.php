<?php

$item_group = [
	'MOD' => [
		'timetable'		=> ['Kursplan',		'Dieses Modul dient dem Anlegen eines Stundenplans.'],
		'rooms'			=> ['Räume',		'Gebäude und Räume verwalten'],
		'teachers'		=> ['Lehrer',		'Tanzlehrer verwalten'],
		'styles'		=> ['Tanzstile',	'Tanzstile verwalten'],
		'courses'		=> ['Kurse',		'Tanzkurse verwalten'],
	],
	'FMD' => [
		'timetableview'	=> ['Kursplan',		'Fügt der Seite einen Kursplan hinzu.'],
	],
];
foreach ($item_group as $type => $items) foreach ($items as $key => $value) $GLOBALS['TL_LANG'][$type][$key] = $value;
