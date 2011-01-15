<?php

/**
 * @ignore
 */
class user_eTypesExtraFormFields {

    function renderDAMExtra(&$params, &$tvObj) {
		$type = &$params['type'];
		$formFieldName = &$params['formFieldName'];
		if(is_array($params['curValue'])) {
			$curValue = &$params['curValue'];
		} else {
			$curValue = array();
		}

		if(empty($curValue['slide']))  $curValue['slide']  = '2';
		if(empty($curValue['random'])) $curValue['random'] = '2';

		switch($type)	{
			case 'dam_image':
				$output = '
					<table border="0" cellpadding="2" cellspacing="0">
						<tr>
							<td>Slide:</td>
							<td>
								<input type="radio" name="'.$formFieldName.'[slide]" value="1" '.($curValue['slide']==1 ? 'checked="checked"' : '').' /> On 
								<input type="radio" name="'.$formFieldName.'[slide]" value="2" '.($curValue['slide']==2 ? 'checked="checked"' : '').' /> Off 
							</td>
						</tr><tr>
							<td>Random:</td>
							<td>
								<input type="radio" name="'.$formFieldName.'[random]" value="1" '.($curValue['random']==1 ? 'checked="checked"' : '').' /> On 
								<input type="radio" name="'.$formFieldName.'[random]" value="2" '.($curValue['random']==2 ? 'checked="checked"' : '').' /> Off 
							</td>
						</tr>
						</tr><tr>
							<td>Reference Table:</td>
							<td>
								<input type="text" name="'.$formFieldName.'[refTable]" value="'.htmlspecialchars($curValue['refTable'] ? $curValue['refTable'] : 'tt_content').'" />
							</td>
						</tr>
						</tr><tr>
							<td>Show image at index:</td>
							<td>
								<input type="text" name="'.$formFieldName.'[atIndex]" value="'.htmlspecialchars($curValue['atIndex'] ? $curValue['atIndex'] : '').'" /><br/>(Values: Integer/"first"/"last")
							</td>
						</tr>
						</table>';
			break;
		}
		return $output;
    }

}

?>