<?php

/*
	includes general functions for ICP module
*/

function icp_log( $content )
{
	$log_content = date("Y-m-d:h-i-s") . " : " . $content ."\n\r";
	error_log( $log_content, 3, PLUGIN_DIR."/log.txt");
}

function fiu_upload_file(){

    // please insert size checking codes here

    if( !isset($_FILES['file']['name']) || $_FILES['file']['type'] != "text/csv" ){
    	echo "error";
    	exit;
    }

	if( !file_exists( UPLOAD_DIR )){
		mkdir( UPLOAD_DIR, 0777 );
	}

	$dest_path = UPLOAD_DIR.mktime()."-".$_FILES['file']['name'];
	move_uploaded_file($_FILES['file']['tmp_name'], $dest_path);

	icp_log("function,php(28) CSV file was Uploaded ");

	// import Clinics from Uploaded file
	if( $_POST['type'] == "clinics"){
		require_once( PLUGIN_DIR . '/includes/class-import-clinics.php');
		ICP_Clinics::processCSV( $dest_path );
	}
	else
	{
		require_once( PLUGIN_DIR . '/includes/class-import-pract.php');
		ICP_Practitioners::processCSV( $dest_path );
	}
    exit();
}

add_action('wp_ajax_fiu_upload_file', 'fiu_upload_file');
add_action('wp_ajax_nopriv_fiu_upload_file', 'fiu_upload_file');

// Parsing CSV file to Array
function getArrayFromCSV( $filePath = '' ){

    $arrData = array();
    $arrKeys = array();

    $data = file_get_contents($filePath);

    $rows = explode( ',","', $data );
    $index = -1;
    foreach( $rows as $key => $row){

        if( !$row )
            continue;

        $arrTemp = explode( "," , $row );
        // set key
        if( empty($arrKeys)){
            foreach ( $arrTemp  as $key => $value) 
                if( trim($value)!="" ) $arrKeys[] = trim( $value );
        }
        else
        {
            $arrTemp = array();
            $temp = explode( ',' , $row );

            $merge = "";
            foreach( $temp as $k => $v ){
                if( $v == "")
                    continue;

                if( substr( $v, 0, 1) =='"' && substr($v, -1) != '"'){
                     $merge .= $v;
                     continue;
                }

                if( substr( $v, 0, 1) !='"' && substr($v, -1) == '"'){
                    $merge .= ",".$v;
                    $v = $merge; $merge = "";
                }

                if( $merge ){
                    $merge .= ",". $v;
                    continue;
                }


                $arrTemp[] = $v;
            }

            if( sizeof($arrTemp) != sizeof($arrKeys) )
                continue;

            foreach ( $arrTemp as $key => $value) {
                if( $arrKeys[$key] != "" )
                    $arrData[$index][$arrKeys[$key]] = $value;
            }
        }
        $index++;
    }
	unlink( $filePath );
	return $arrData;
}

function Generate_Featured_Image( $image_url, $post_id  ){

    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($image_url);
    $filename = basename($image_url);
    if(wp_mkdir_p($upload_dir['path']))     $file = $upload_dir['path'] . '/' . $filename;
    else                                    $file = $upload_dir['basedir'] . '/' . $filename;
    file_put_contents($file, $image_data);

    $wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    $res1= wp_update_attachment_metadata( $attach_id, $attach_data );
    $res2= set_post_thumbnail( $post_id, $attach_id );
}
