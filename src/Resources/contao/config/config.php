<?php

//$GLOBALS[?TL_HOOKS?][?processFormData?][] =[?mybundle.listener.process_form_data?, ?onProcessFormData?];



/**
 * Add back end modules
 */
$GLOBALS['BE_MOD']['content']['sites'] = array
(
	'tables' => array('tl_sites'),
	'icon'   => 'bundles/cepharumtimetable/home.gif'
);

/**
 * Front end modules
 * /
array_insert($GLOBALS['FE_MOD'], 4, array
(
	'xing' => array
	(
		'xinglist'   => 'BugBuster\Xing\ModuleXingList'
	)
));
*/
