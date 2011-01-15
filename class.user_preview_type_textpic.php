<?php

require_once(t3lib_extMgm::extPath('dam').'lib/class.tx_dam_db.php');
require_once(t3lib_extMgm::extPath('templavoila') . 'classes/preview/class.tx_templavoila_preview_type_text.php');

class user_preview_type_textpic extends tx_templavoila_preview_type_text {

    function render_previewContent ($row, $table, $output, $alreadyRendered, &$ref) {
	$alreadyRendered = true;

	$damFiles = tx_dam_db::getReferencedFiles('tt_content', $row['uid'], 'tx_damttcontent_files');
	$row['tx_damttcontent_files'] = implode(',', $damFiles[files]);

	$thumbnail = '<strong>'.$GLOBALS['LANG']->sL(t3lib_BEfunc::getItemLabel('tt_content','image'),1).'</strong><br />';
	$thumbnail .= t3lib_BEfunc::thumbCode($row, 'tt_content', 'tx_damttcontent_files', $ref->doc->backPath);

	$label = $this->getPreviewLabel();
	$data = $this->getPreviewData($row);

	if ($ref->currentElementBelongsToCurrentPage) {
		$text = $ref->link_edit('<strong>'. $label .'</strong> ' . $data ,'tt_content',$row['uid']);
	} else {
		$text = '<strong>'. $label .'</strong> ' . $data;
	}

	return '
            <table width="100%">
                <tr>
                    <td valign="top" width="60%">' . $text . '</td>
                    <td valign="top">' . $thumbnail . '</td>
                </tr>
            </table>';
    }

}

?>
