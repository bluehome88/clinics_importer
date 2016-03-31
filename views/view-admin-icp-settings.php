<?php

	/*
		first Clinics tab for importing Practitioners
	*/
?>

<h3>Settings</h3>
<table class="form-table">

    <tbody>
    	<tr class="" valign="top">
        	<th scope="row" class="titledesc">Force Import</th>
            <td class="forminp forminp-checkbox">
                <fieldset>
					<legend class="screen-reader-text"><span>Force Import</span></legend>
					<label for="icp_force_import">
						<input name="icp_force_import" id="icp_force_import" value="<?php echo $icp_force_import;?>" type="checkbox" <? echo $icp_force_import_checked;?>> Yes                                    
                	</label>
                	<p class="description"></p>
            	</fieldset>
            </td>
        </tr>
		<tr valign="top">
            <th scope="row" class="titledesc">
        		<label for="icp_import_limit">Import limits per time</label>
            </th>
            <td class="forminp forminp-text">
            	<input name="icp_import_limit" id="icp_import_limit" style="" value="<?php echo $icp_import_limit?>" class="" type="text"> 
            	<span class="description"><br></span>                        
            </td>
        </tr>
   	</tbody>
</table>

<p class="submit">
    <?php wp_nonce_field( 'dac_admin_register_action', 'dac_admin_register_submit' ); ?>
    <input name="save" class="button-primary" value="Save changes" onclick="jQuery('.auto-select  option:enabled').prop('selected', true);" type="submit">
    <input name="subtab" id="last_tab" type="hidden">
    <input id="_wpnonce" name="_wpnonce" value="e50b9db122" type="hidden">
</p>
