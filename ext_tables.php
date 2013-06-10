<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Fluid Pages: PAGE');

t3lib_div::loadTCA('pages');
t3lib_extMgm::addTCAcolumns('pages', array(
	'tx_fed_page_controller_action' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:fluidpages/Resources/Private/Language/locallang.xml:pages.tx_fed_page_controller_action',
		'config' => array (
			'type' => 'user',
			'userFunc' => 'Tx_Fluidpages_Backend_PageLayoutSelector->renderField'
		)
	),
        'tx_fed_page_flexform_override' => array (
                'displayCond' => array('AND'=> array('FIELD:tx_fed_page_controller_action:=:')),
                'exclude' => 1,
                'label' => 'LLL:EXT:fluidpages/Resources/Private/Language/locallang.xml:pages.tx_fed_page_flexform_override',
                'config' => array (
                   'type' => 'check'
               )	
        ),
	'tx_fed_page_flexform' => Array (
                'displayCond' => array('OR'=> array('FIELD:tx_fed_page_controller_action:!=:',
                                            'FIELD:tx_fed_page_flexform_override:=:1')),
		'exclude' => 1,
		'label' => 'LLL:EXT:fluidpages/Resources/Private/Language/locallang.xml:pages.tx_fed_page_flexform',
		'config' => array (
			'type' => 'flex',
		)
	),
	'tx_fed_page_controller_action_sub' => array (
		'exclude' => 1,
		'label' => 'LLL:EXT:fluidpages/Resources/Private/Language/locallang.xml:pages.tx_fed_page_controller_action_sub',
		'config' => array (
			'type' => 'user',
			'userFunc' => 'Tx_Fluidpages_Backend_PageLayoutSelector->renderField'
		)
	),
        'tx_fed_page_flexform_override_sub' => array (
                'displayCond' => array('AND'=> array('FIELD:tx_fed_page_controller_action_sub:=:')),
                'exclude' => 1,
                'label' => 'LLL:EXT:fluidpages/Resources/Private/Language/locallang.xml:pages.tx_fed_page_flexform_override_sub',
                'config' => array (
                   'type' => 'check'
               )	
        ),
	'tx_fed_page_flexform_sub' => Array (
                'displayCond' => array('OR'=> array('FIELD:tx_fed_page_controller_action_sub:!=:',
                                            'FIELD:tx_fed_page_flexform_override_sub:=:1')),
		'exclude' => 1,
		'label' => 'LLL:EXT:fluidpages/Resources/Private/Language/locallang.xml:pages.tx_fed_page_flexform_sub',
		'config' => array (
			'type' => 'flex',
		)
	),
), 1);
$TCA['pages']['ctrl']['requestUpdate'] .= ',tx_fed_page_flexform_override,tx_fed_page_flexform_override_sub';
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['fluidpages']['setup'] = unserialize($_EXTCONF);
$doktypes = '0,1,4';
$fields = 'tx_fed_page_controller_action,tx_fed_page_flexform_override,tx_fed_page_flexform,tx_fed_page_controller_action_sub,tx_fed_page_flexform_override_sub,tx_fed_page_flexform_sub';
$position = 'before:layout';
$additionalDoktypes = trim($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['fluidpages']['setup']['doktypes'], ',');
t3lib_extMgm::addToAllTCAtypes(
	'pages',
	$fields,
	$doktypes,
	$position
);

if (FALSE === empty($additionalDoktypes)) {
	$fields = '--div--;LLL:EXT:fluidpages/Resources/Private/Language/locallang.xml:pages.tx_fed_page_layoutselect,' . $fields;
	t3lib_extMgm::addToAllTCAtypes(
		'pages',
		$fields,
		$additionalDoktypes
	);
}
