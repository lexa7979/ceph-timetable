<?php

$new_items = [
	'title_legend'	=> 'Raumdaten',

	'new'			=> ['Neuer Raum',		'Neuen Raum registrieren'],
	'edit'			=> ['Raumdaten ändern', 'Daten des Raums mit ID %s ändern'],
	'copy'			=> ['Raum duplizieren',	'Raum mit ID %s duplizieren'],
	'delete'		=> ['Raum löschen',		'Raum mit ID %s löschen'],
	'show'			=> ['Raumdetails',		'Details des Raums mit ID %s betrachten'],
	'roomnumber'	=> ['Raumnummer',		'Welche Bezeichnung hat der Raum?'],

	'editheader'	=> ['Gebäude ändern',		'Gebäudedaten ändern'],
	'pastenew'		=> ['Raum oben einfügen',	'Neuen Raum am Listenanfang einfügen'],
	'pasteafter'	=> ['Raum hier einfügen',	'Neuen Raum hinter diesem Eintrag einfügen'],
];
foreach ($new_items as $key => $value) $GLOBALS['TL_LANG']['tl_timetable_rooms'][$key] = $value;
