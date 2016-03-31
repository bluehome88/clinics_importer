<?php

	/*
		Second Praritioners tab for importing Pratitioners
	*/
	wp_nonce_field('ajax_file_nonce', 'security');
?>

<div class="pract_tab">
	<h2>Importing Practitioners</h2>
	<div class="file_upload">

		<form id="file_form">
		    <input type="hidden" name="action" value="my_file_upload">
		    <label for="file_upload">It's a file upload...</label>
		    <input type="file" name="file_upload">
		    <input type="submit" value="Go" id="submit">
		    <input type="hidden" id="data_type" value="pract"/>
		</form>

		<div id="uploading_message" style="display:none;">
			CSV file Uploading...
		</div>

		<div id="success_message" style="display:none;">
		</div>

	</div>

	<div class="impported_lists">

	</div>	
</div>	



