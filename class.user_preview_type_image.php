<?php

require_once(t3lib_extMgm::extPath('dam').'lib/class.tx_dam_db.php');
require_once(t3lib_extMgm::extPath('templavoila') . 'classes/preview/class.tx_templavoila_preview_type_text.php');

class user_preview_type_image extends tx_templavoila_preview_type_text {
    protected $previewField = 'tx_damttcontent_files';

    function render_previewContent ($row, $table, $output, $alreadyRendered, &$ref) {

	$alreadyRendered = true;

	$damFiles = tx_dam_db::getReferencedFiles('tt_content', $row['uid'], 'tx_damttcontent_files');
	$row['tx_damttcontent_files'] = implode(',', $damFiles[files]);

	$label = $this->getPreviewLabel();

	if ($ref->currentElementBelongsToCurrentPage) {
		$label = $ref->link_edit('<strong>' . $label . '</strong>' ,'tt_content',$row['uid']);
	} else {
		$label = '<strong>' . $label . '</strong>';
	}
	$thumbnail = t3lib_BEfunc::thumbCode ($row, 'tt_content', 'tx_damttcontent_files', $ref->doc->backPath);

        return '
            <table>
                <tr>
                    <td valign="top">' . $label . '</td>
                    <td valign="top">' . $thumbnail . '</td>
                </tr>
            </table>';

    }

    function render_previewData_typeDb ($fieldValue, $fieldData, $uid, $table, &$ref) {

        $TCEformsConfiguration = $fieldData['TCEforms']['config'];
        $TCEformsLabel = $ref->localizedFFLabel($fieldData['TCEforms']['label'], 1);

        $previewContent = '';
        if ($fieldValue > 0) {
            $previewContent .= '<strong>'.$TCEformsLabel.'</strong> ';
            $damFiles = tx_dam_db::getReferencedFiles($table, $uid, $TCEformsConfiguration['MM_match_fields']['ident']);
            $row['dummyFieldName'] = implode(',', $damFiles['files']);
            $previewContent .= t3lib_BEfunc::thumbCode($row, '', 'dummyFieldName', $ref->doc->backPath);
            $previewContent .= '<br />';
        }

        return $previewContent;
    }
}

?>
