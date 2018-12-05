<?php

$items = [
	'title_legend'		=> 'Kursdaten',
	'time_place_legend'	=> 'Zeit und Ort',

	'label'			=> ['Tanzkurs',			'Daten eines wöchentlichen Tanzkurses'],

	'new'			=> ['Neuer Kurs',		'Neuen Kurs registrieren'],
	'edit'			=> ['Kurs ändern',		'Daten des Kurses mit ID %s ändern'],
	'copy'			=> ['Kurs duplizieren', 'Kurs mit ID %s duplizieren'],
	'delete'		=> ['Kurs löschen',		'Kurs mit ID %s löschen'],
	'show'			=> ['Kursdetails',		'Details des Kurses mit ID %s betrachten'],

	'id'			=> ['Datensatznummer',	'ID des Datensatzes'],
	'tstamp'		=> ['Änderungsdatum',	'Datum und Uhrzeit der letzten Änderung'],
	'weekday'		=> ['Wochentag',		'Wählen Sie den Wochentag aus.'],
	'time'			=> ['Uhrzeit',			'Zu welcher Uhrzeit beginnt der Kurs?'],
	'duration'		=> ['Dauer',			'Wie lange (in Minuten) dauert der Kurs?'],
	'placement'		=> ['Platzierung',		'Hier können Sie bei Bedarf manuell festlegen, in welcher Zeile des Kursplans dieser Kurs angezeigt werden soll.'],
	'room'			=> ['Raum',				'In welchem Raum findet der Kurs statt?'],
	'teacher'		=> ['Tanzlehrer',		'Welcher Lehrer leitet den Kurs?'],
	'style'			=> ['Tanzstil',			'Was lernen die Teilnehmer im Kurs?'],
	'description'	=> ['Beschreibung',		'Geben Sie hier weitere Informationen über den Kurs an.'],
	'ages'			=> ['Altersgruppe',		'Für welche Altersgruppe ist der Kurs gedacht?'],
	'audience'		=> ['Zielgruppe',		'Für wen ist der Kurs geeignet?'],
	'is_forbeginners' => ['für Anfänger?',	'Ist der Kurs auch für Anfänger geeignet?'],
	'is_fullybooked'=> ['ausgebucht?',		'Ist der Kurs bereits ausgebucht?'],

	'children'		=> ['Kinder',			'Der Kurs ist für Kinder geeignet.'],
	'teenager'		=> ['Jugendliche',		'Der Kurs ist für Jugendliche geeignet.'],
	'adults'		=> ['Erwachsene',		'Der Kurs ist für Erwachsene geeignet.'],

	'is_forbeginners_switch'=> ['Fortgeschrittene',	'auch Anfänger'],
	'is_fullybooked_switch'	=> ['freie Plätze',		'ausgebucht'],

	'error_incomplete'	=> ['Fehler: Daten unvollständig',			'Fehler: Die Informationen im Datensatz sind unvollständig.'],
	'error_collision'	=> ['Fehler: Raumkollision',				'Achtung: Für diese Zeit sind mehr als ein Kurs im gleichen Raum registriert.'],
	'error_collision2'	=> ['Fehler: Kursplan ungenau',				'Achtung: Im Kursplan sind an gleicher Stelle weitere Kurse registriert. Im Plan können nicht alle Kurse angezeigt werden.'],
	'warning_teacher'	=> ['Warnung: Lehrer doppelt eingesetzt',	'Achtung: Dieser Lehrer ist für diese Zeit in mehr als einem Kurs registriert.'],
	'no_description'	=> ['(Beschreibung fehlt)',					'Sie haben noch keine Beschreibung eingegeben...'],
	'no_ages'			=> ['(Altersgruppe fehlt)',					'Sie haben noch keine Altersgruppe angegeben...'],

	'weekdays_set'	=> ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag', 'Sonntag'],
	'placing_set'	=> ['automatisch', '1 Uhr', '2 Uhr', '3 Uhr', '4 Uhr', '5 Uhr', '6 Uhr', '7 Uhr', '8 Uhr', '9 Uhr', '10 Uhr', '11 Uhr', '12 Uhr', '13 Uhr', '14 Uhr', '15 Uhr', '16 Uhr', '17 Uhr', '18 Uhr', '19 Uhr', '20 Uhr', '21 Uhr', '22 Uhr', '23 Uhr', '0 Uhr'],

	'roomlist_caption_site_room'	=> '%s: Raum %s',
	'roomlist_caption_room_site'	=> 'Raum %s (%s)',

	'format_frontend_time1'		=> 'ab %d.00',
	'format_frontend_time2'		=> '%d.%02d-%d.%02d Uhr',
	'format_frontend_manual'	=> 'manuell gesetzt',
];

foreach ($items as $key => $value) $GLOBALS['TL_LANG']['tl_timetable'][$key] = $value;
