<?php

$new_items = [
	'title_legend'	=> 'Gebäudedaten',

	'new'			=> ['Neues Gebäude',		'Neues Gebäude registrieren'],
	'edit'			=> ['Räume verwalten',		'Räume des Gebäudes mit ID %s verwalten'],
	'editheader'	=> ['Gebäudedaten ändern',	'Daten des Gebäudes mit ID %s ändern'],
	'copy'			=> ['Gebäude duplizieren',	'Gebäude mit ID %s duplizieren'],
	'delete'		=> ['Gebäude löschen',		'Gebäude mit ID %s löschen'],
	'show'			=> ['Gebäudedetails',		'Details des Gebäudes mit ID %s betrachten'],

	'id'			=> ['Datensatznummer',	'ID des Datensatzes'],
	'tstamp'		=> ['Änderungsdatum',	'Datum und Uhrzeit der letzten Änderung'],
	'name'			=> ['Gebäudename',		'Welchen Namen hat das Gebäude?'],
];
foreach ($new_items as $key => $value) $GLOBALS['TL_LANG']['tl_timetable_sites'][$key] = $value;
