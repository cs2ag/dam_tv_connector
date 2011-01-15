<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

if (TYPO3_MODE === 'BE')	{

	// add the new field presets to the user prefs
	t3lib_extMgm::addUserTSConfig('
		templavoila.eTypes {
		    eType {
			dam_image {
			    label = DAM Image
			}
			dam_media {
			    label = DAM Media
			}
		    }
		    defaultTypes_misc := addToList(dam_image,dam_media)
		}
	');

}

?>
