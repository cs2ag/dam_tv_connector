<?php

/**
 * @ignore
 */
class ux_tx_templavoila_cm1 extends tx_templavoila_cm1 {


	/**
	 * Main function, adding items to the click menu array.
	 *
	 * @param	object		Reference to the parent object of the clickmenu class which calls this function
	 * @param	array		The current array of menu items - you have to add or remove items to this array in this function. Thats the point...
	 * @param	string		The database table OR filename
	 * @param	integer		For database tables, the UID
	 * @return	array		The modified menu array.
	 */
	function main(&$backRef, $menuItems, $table, $uid) {
		
		$cmLevel = $backRef->cmLevel;
		if ($backRef->cmLevel==1 AND t3lib_div::_GP('subname')=='tx_dam_cm_file')	{
			$backRef->cmLevel = 0;
		}

			// this is second level menu from DAM records
		if ($fileDAM = t3lib_div::_GP('txdamFile')) {
			$table = $fileDAM;
		}
		
		$cm = parent::main($backRef, $menuItems, $table, $uid);
		
		$backRef->cmLevel = $cmLevel;
		return $cm;
	}


}

?>
