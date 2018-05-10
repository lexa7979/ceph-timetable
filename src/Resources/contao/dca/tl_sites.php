<?php

$GLOBALS['TL_DCA']['tl_sites'] = [
	'config' => [
		'dataContainer' => 'Table',
		//'switchToEdit' => true,		// sorting mode 4 only...
		'enableVersioning' => true,		// ???
		'sql' => [
			'keys' => [
				'id' => 'primary',
			]
		]
	],
	'list' => [
		'sorting' => [
			'mode' => 1,
			'fields' => ['description'],
			//'headerFields' => ['description'],	// sorting mode 4 only...
			'flag' => 1,
			'panelLayout' => 'debug;filter;sort,search,limit',
		],
		'label' => [
			'fields' => ['name'],
			'format' => '%s',
			'showColumns' => true,
		],
		'global_operations' => [
		],
		'operations' => [
			'edit' => [
				'label' => &$GLOBALS['TL_LANG']['tl_sites']['edit'],
				'href' => 'table=tl_sites',
				'icon' => 'edit.gif'
			],
			'editheader' => [
				'label' => &$GLOBALS['TL_LANG']['tl_sites']['editheader'],
				'href' => 'act=edit',
				'icon' => 'header.gif',
			],
			'copy' => [
				'label' => &$GLOBALS['TL_LANG']['tl_sites']['copy'],
				'href' => 'act=copy',
				'icon' => 'copy.gif',
			],
			'delete' => [
				'label' => &$GLOBALS['TL_LANG']['tl_sites']['delete'],
				'href' => 'act=delete',
				'icon' => 'delete.gif',
				'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
			],
			'show' => [
				'label' => &$GLOBALS['TL_LANG']['tl_sites']['show'],
				'href' => 'act=show',
				'icon' => 'show.gif'
			]
		]
	],
	'palettes' => [
		'__selector__' => [],
		'default' => 'description'
		// 'default' => '
		//     brand,
		//     name,
		//     alias'
	],
	'subpalettes' => [
		'' => ''
	],
	'fields' => [
		'id' => [
			'sql' => "int(10) unsigned NOT NULL auto_increment"
		],
		'tstamp' => [
			'sql' => "int(10) unsigned NOT NULL default '0'"
		],
		'description' => [
			'label' => &$GLOBALS['TL_LANG']['tl_sites']['description'],
			'exclude' => true,
			'search' => true,
			'sorting' => true,
			'flag' => 1,
			'inputType' => 'text',
			'eval' => ['mandatory' => true, 'maxlength' => 255],
			'sql' => "varchar(255) NOT NULL default ''"
		],
		// 'name' => [
		//     'label' => &$GLOBALS['TL_LANG']['tl_car']['name'],
		//     'exclude' => true,
		//     'search' => true,
		//     'sorting' => true,
		//     'flag' => 1,
		//     'inputType' => 'text',
		//     'eval' => ['mandatory' => true, 'maxlength' => 255],
		//     'sql' => "varchar(255) NOT NULL default ''"
		// ],
		// 'brand' => [
		//     'label' => &$GLOBALS['TL_LANG']['tl_car']['brand'],
		//     'exclude' => true,
		//     'search' => true,
		//     'sorting' => true,
		//     'flag' => 1,
		//     'inputType' => 'text',
		//     'eval' => ['mandatory' => true, 'maxlength' => 255],
		//     'sql' => "varchar(255) NOT NULL default ''"
		// ],
		// 'alias' => [
		//     'label' => &$GLOBALS['TL_LANG']['tl_car']['alias'],
		//     'exclude' => true,
		//     'search' => true,
		//     'inputType' => 'text',
		//     'eval' => ['rgxp' => 'alias', 'unique' => true, 'maxlength' => 128, 'tl_class' => 'w50'],
		//     'save_callback' => [
		//         function ($varValue, DataContainer $dataContainer)
		//         {
		//             return \System::getContainer()->get('xuad_car.datacontainer.car')->generateAlias($varValue, $dataContainer);
		//         }
		//     ],
		//     'sql' => "varchar(128) COLLATE utf8_bin NOT NULL default ''"
		// ],
	]
];
