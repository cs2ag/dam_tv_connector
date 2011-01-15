<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2006-2010 Christian Welzel (gawain@camlann.de)
*  All rights reserved
*
*  This script is part of the Typo3 project. The Typo3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * @author	Christian Welzel <gawain@camlann.de>
 */

class tx_damtvc_tsfe {

	/**
	 * Used to fetch a file list for TypoScript cObjects
	 *
	 *	tt_content.textpic.20.imgList >
	 *	tt_content.textpic.20.imgList.cObject = USER
	 *	tt_content.textpic.20.imgList.cObject {
	 *		userFunc = tx_dam_divFe->fetchFileList
	 *
	 * @param	mixed		$content: ...
	 * @param	array		$conf: ...
	 * @return	string		comma list of files with path
	 * @see dam_ttcontent extension
	 */
	function fetchFileList ($content, $conf) {
		$files = array();

// Check and initialise configuration values

		$filePath = $this->cObj->stdWrap($conf['additional.']['filePath'],$conf['additional.']['filePath.']);
		$fileList = trim($this->cObj->stdWrap($conf['additional.']['fileList'],$conf['additional.']['fileList.']));
		$refField = trim($this->cObj->stdWrap($conf['refField'],$conf['refField.']));
		$refTable = trim($this->cObj->stdWrap($conf['refTable'],$conf['refTable.']));
		$random = trim($this->cObj->stdWrap($conf['random'],$conf['random.']));
		$slide = trim($this->cObj->stdWrap($conf['slide'],$conf['slide.']));
		$atIndex = trim($this->cObj->stdWrap($conf['atIndex'],$conf['atIndex.']));
		$fileList = t3lib_div::trimExplode(',',$fileList);

		if(empty($refTable))
			$refTable = 'tt_content';

// Extract list of files from the additional file list

		foreach ($fileList as $file) {
			if ($file) {
				$files[] = $filePath.$file;
			}
		}

// Get list of files from the DAM
// Slide up the rootline if activated and reference table is pages
// (since the id is taken from the rootline, the reference table can obviously only be pages)

		if ($slide && $refTable == 'pages') {

// Get the rootline

			$rootline = $GLOBALS['TSFE']->sys_page->getRootLine($this->cObj->parentRecord['data']['uid']);

// Move up the rootpage until a non-empty reference to files is found

			foreach ($rootline as $page) {
				$damFiles = tx_dam_db::getReferencedFiles($refTable, $page['uid'], $refField);
				if (!empty($damFiles['files'])) break;
			}
		}
		else {
			$uid = $this->cObj->parentRecord['data']['uid'];

			if(isset($this->cObj->parentRecord['data']['_LOCALIZED_UID'])) {
				$uid = $this->cObj->parentRecord['data']['_LOCALIZED_UID'];
			}
			else if(isset($this->cObj->parentRecord['data']['_ORIG_uid'])) {
				$uid = $this->cObj->parentRecord['data']['_ORIG_uid'];
			}

			$damFiles = tx_dam_db::getReferencedFiles($refTable, $uid, $refField);
		}

// Merge both lists of files

		$files = array_merge($files, $damFiles['files']);

// If there's more than 1 file and the random parameter has been set, choose a random file from the list

		$numFiles = count($files);
		if(!empty($atIndex)) {
			switch($atIndex) {
			case 'first': $files = array($files[0]); break;
			case 'last':  $files = array($files[$numFiles-1]); break;
			default:      $files = array($files[intval($atIndex)]); break;
			}
		}

		$numFiles = count($files);
		if ($numFiles > 1 && !empty($random)) {
			$randomPointer = rand(0, $numFiles - 1);
			$randomFile = array($files[$randomPointer]);
			$files = $randomFile;
		}

// Return the list of files

		return implode(',',$files);
	}


}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dam_tv_connector/class.tx_damtvc_tsfe.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/dam_tv_connector/class.tx_damtvc_tsfe.php']);
}

?>