console.log("script.js file was loaded");

jQuery(document).ready(function(){

	// upload clinics files
	jQuery(document).on('click', '#submit', function(e){

	    e.preventDefault();

	    var fd = new FormData();
	    var file = jQuery(document).find('input[type="file"]');
	    var type = jQuery("#data_type").val();

	    var individual_file = file[0].files[0];
	    fd.append("file", individual_file);
	    fd.append("type", type);  
	    fd.append('action', 'fiu_upload_file');  

       	jQuery("#uploading_message").css("display", "block");
		jQuery("#success_message").css("display", "none");

	    jQuery.ajax({

	        type: 'POST',
	        url: ajaxurl,
	        data: fd,
	        contentType: false,
	        processData: false,
	        success: function(response){

	            console.log(response);
            	jQuery("#uploading_message").css("display", "none");

	            if( response == "error" ){
	            	jQuery("#success_message").html( "Error!" );
	            	jQuery("#success_message").css("display", "block");
	            }
	            else
	            {
	            	/*data = jQuery.parseJSON(response);
					for (var key in data) {
		                content = "<tr><td>"+key;
		                content += "</td><td>";
		                content += data[key];
		                content += "</td></tr>";
		                jQuery(content).appendTo("#success_message");
		            }*/
		            jQuery("<div>"+response+"</div>").appendTo("#success_message");
		           	//jQuery("#success_message").html(response);
		           	jQuery("#success_message").css("display", "block");

	            
	            }

	        }
	    });
	});


});