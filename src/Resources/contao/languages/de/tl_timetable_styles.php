<?php

$items = [
	'title_legend'	=> 'Tanzstil',

	'new'			=> ['Neuer Tanzstil',		'Neuen Tanzstil registrieren'],
	'edit'			=> ['Tanzstil ändern',		'Daten des Tanzstils mit ID %s ändern'],
	'copy'			=> ['Tanzstil duplizieren',	'Tanzstil mit ID %s duplizieren'],
	'delete'		=> ['Tanzstil löschen',		'Tanzstil mit ID %s löschen'],
	'show'			=> ['Tanzstildetails',		'Details des Tanzstils mit ID %s betrachten'],

	'delete_'		=> ['Löschen nicht möglich', 'Tanzstil mit ID %s wird im Kursplan benutzt und kann daher nicht gelöscht werden'],

	'id'			=> ['Datensatznummer',		'ID des Datensatzes'],
	'tstamp'		=> ['Änderungsdatum',		'Datum und Uhrzeit der letzten Änderung'],
	'name'			=> ['Bezeichnung',			'Wie heißt der Tanzstil?'],
	'background'	=> ['Hintergrundfarbe',		'Geben den RBG-Code der Hintergrundfarbe an (z.B. "00FF00" für grün), die im Kursplan für diesen Tanzstil genutzt werden soll.'],
];

foreach ($items as $key => $value) $GLOBALS['TL_LANG']['tl_timetable_styles'][$key] = $value;
