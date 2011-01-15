<?php

if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/templavoila/class.tx_templavoila_cm1.php'] = t3lib_extMgm::extPath('dam_tv_connector').'/class.ux_tx_templavoila_cm1.php';

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['templavoila']['cm1']['eTypesConfGen']['dam_image'] = 'EXT:dam_tv_connector/class.user_eTypesConfGen.php:&user_eTypesConfGen->handleDAM';
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['templavoila']['cm1']['eTypesConfGen']['dam_media'] = 'EXT:dam_tv_connector/class.user_eTypesConfGen.php:&user_eTypesConfGen->handleDAM';

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['templavoila']['cm1']['eTypesExtraFormFields']['dam_image'] = 'EXT:dam_tv_connector/class.user_eTypesExtraFormFields.php:&user_eTypesExtraFormFields->renderDAMExtra';
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['templavoila']['cm1']['eTypesExtraFormFields']['dam_media'] = 'EXT:dam_tv_connector/class.user_eTypesExtraFormFields.php:&user_eTypesExtraFormFields->renderDAMExtra';

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['templavoila']['mod1']['renderPreviewContent']['textpic'] = 'EXT:dam_tv_connector/class.user_preview_type_textpic.php:&user_preview_type_textpic';
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['templavoila']['mod1']['renderPreviewContent']['image']   = 'EXT:dam_tv_connector/class.user_preview_type_image.php:&user_preview_type_image';

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['templavoila']['mod1']['renderPreviewDataClass']['tx_dam'] = 'EXT:dam_tv_connector/class.user_preview_type_image.php:&user_preview_type_image';

t3lib_extMgm::addTypoScript($_EXTKEY,'setup','
	includeLibs.tx_damtvc_tsfe = EXT:dam_tv_connector/class.tx_damtvc_tsfe.php
    ',43);


?>