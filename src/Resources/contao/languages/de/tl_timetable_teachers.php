<?php

$new_items = [
	'title_legend'	=> 'Lehrerdaten',

	'new'			=> ['Neuer Lehrer',			'Neuen Lehrer registrieren'],
	'edit'			=> ['Lehrer ändern',		'Daten des Lehrers mit ID %s ändern'],
	'copy'			=> ['Lehrer duplizieren',	'Lehrer mit ID %s duplizieren'],
	'delete'		=> ['Lehrer löschen',		'Lehrer mit ID %s löschen'],
	'show'			=> ['Lehrerdetails',		'Details des Lehrers mit ID %s betrachten'],

	'delete_'		=> ['Löschen nicht möglich', 'Lehrer mit ID %s wird im Kursplan benutzt und kann daher nicht gelöscht werden'],

	'id'			=> ['Datensatznummer',		'ID des Datensatzes'],
	'tstamp'		=> ['Änderungsdatum',		'Datum und Uhrzeit der letzten Änderung'],
	'name'			=> ['Lehrername',			'Welchen Namen hat der Lehrer?'],
];
foreach ($new_items as $key => $value) $GLOBALS['TL_LANG']['tl_timetable_teachers'][$key] = $value;
