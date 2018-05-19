<?php

$new_items = [
	'title_legend'	=> 'Kursdaten',

	'new'			=> ['Neuer Kurs',		'Neuen Kurs registrieren'],
	'edit'			=> ['Kurs ändern',		'Daten des Kurses mit ID %s ändern'],
	'copy'			=> ['Kurs duplizieren', 'Kurs mit ID %s duplizieren'],
	'delete'		=> ['Kurs löschen',		'Kurs mit ID %s löschen'],
	'show'			=> ['Kursdetails',		'Details des Kurses mit ID %s betrachten'],

	'id'			=> ['Datensatznummer',	'ID des Datensatzes'],
	'tstamp'		=> ['Änderungsdatum',	'Datum und Uhrzeit der letzten Änderung'],
	'weekday'		=> ['Wochentag',		'Wählen Sie den Wochentag aus.'],
	'time'			=> ['Uhrzeit',			'Um welche Uhrzeit beginnt der Kurstermin?'],
	'room'			=> ['Raum',				'In welchem Raum findet der Kurs statt?'],
	'teacher'		=> ['Tanzlehrer',		'Welcher Lehrer leitet den Kurs?'],
	'style'			=> ['Tanzstil',			'Was lernen die Teilnehmer im Kurs?'],
	'description'	=> ['Beschreibung',		'Geben Sie hier weitere Informationen über den Kurs an.'],
	'ages'			=> ['Altersgruppe',		'Für welche Altersgruppe ist der Kurs gedacht?'],
	'is_forbeginners' => ['für Anfänger?',	'Ist der Kurs auch für Anfänger geeignet?'],
	'is_fullybooked'=> ['ausgebucht?',		'Ist der Kurs bereits ausgebucht?'],

	'is_forbeginners_switch'=> ['Fortgeschrittene',	'Anfänger'],
	'is_fullybooked_switch'	=> ['freie Plätze',		'ausgebucht'],

	'weekdays_set'	=> ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag'],
];
foreach ($new_items as $key => $value) $GLOBALS['TL_LANG']['tl_timetable'][$key] = $value;
