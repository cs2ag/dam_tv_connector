<?php

/**
 * @ignore
 */
class user_eTypesConfGen {

    function handleDAM(&$params, &$tvObj) {
		$elArray = &$params['elArray'];
		$key = &$params['key'];

		switch($elArray[$key]['tx_templavoila']['eType']) {
		    case 'dam_image':
			$refTable = $elArray[$key]['tx_templavoila']['eType_EXTRA']['refTable'];
			$damArray = &txdam_getMediaTCA('image_field', $key);

			$elArray[$key]['TCEforms']['config'] = $damArray['config'];
			$elArray[$key]['tx_templavoila']['TypoScript_constants'] = array(
			    'table'   => htmlspecialchars($refTable ? $refTable : 'tt_content'),
			    'atIndex' => htmlspecialchars($elArray[$key]['tx_templavoila']['eType_EXTRA']['atIndex']),
			    'slide'   => ($elArray[$key]['tx_templavoila']['eType_EXTRA']['slide']  == 1 ? '1' : '0'),
			    'random'  => ($elArray[$key]['tx_templavoila']['eType_EXTRA']['random'] == 1 ? '1' : '0'),
			);
			$elArray[$key]['tx_templavoila']['TypoScript'] = '
10 = IMGTEXT
10 < tt_content.image.20
10.imgList.cObject.refTable = {$table}
10.imgList.cObject.refField = '.$key.'
10.imgList.cObject.random   = {$random}
10.imgList.cObject.slide    = {$slide}
10.imgList.cObject.atIndex  = {$atIndex}
10.imgList.cObject.userFunc = tx_damtvc_tsfe->fetchFileList
';
			break;
		    case 'dam_media':
			$damArray = &txdam_getMediaTCA('media_field', $key);
			$elArray[$key]['TCEforms']['config'] = $damArray['config'];
			$elArray[$key]['tx_templavoila']['TypoScript'] = '
10 < tt_content.uploads.20
10.dam.damIdentField = '. $key .'
';
			break;
		}
    }
}

?>