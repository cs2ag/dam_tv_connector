<?php

########################################################################
# Extension Manager/Repository config file for ext "dam_tv_connector".
#
# Auto generated 08-10-2010 20:03
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'DAM-Templavoila connector',
	'description' => 'adds DAM entries to the editing types of templavoila backend module',
	'category' => 'module',
	'shy' => 0,
	'version' => '0.2.0',
	'dependencies' => 'dam,templavoila,css_filelinks,dam_filelinks,dam_ttcontent',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'alpha',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 0,
	'lockType' => '',
	'author' => 'Christian Welzel',
	'author_email' => 'gawain@camlann.de',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'dam' => '1.0.0',
			'templavoila' => '1.5.0',
			'css_filelinks' => '0.2.5',
			'dam_filelinks' => '0.3.3',
			'dam_ttcontent' => '1.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:11:{s:9:"ChangeLog";s:4:"3169";s:24:"class.tx_damtvc_tsfe.php";s:4:"28ed";s:28:"class.user_eTypesConfGen.php";s:4:"5923";s:36:"class.user_eTypesExtraFormFields.php";s:4:"574d";s:33:"class.user_preview_type_image.php";s:4:"29af";s:35:"class.user_preview_type_textpic.php";s:4:"38d3";s:31:"class.ux_tx_templavoila_cm1.php";s:4:"2d4d";s:12:"ext_icon.gif";s:4:"9a7f";s:17:"ext_localconf.php";s:4:"ee7d";s:14:"ext_tables.php";s:4:"44bf";s:14:"doc/manual.sxw";s:4:"29e9";}',
	'suggests' => array(
	),
);

?>