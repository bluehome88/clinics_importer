<?php

/*
	perform importing Clinics
*/

class ICP_Clinics{

    public function __construct() {
        $this->id = 'clinics';
        $this->label = 'Clinics';

        add_filter('icp_configuration_tabs_array', array($this, 'add_configuration_page'), 4);
        add_action('icp_configuration_' . $this->id, array($this, 'render'));
        add_action('icp_configuration_save_' . $this->id, array($this, 'save'));
    }

    public function render() {
        
		include( PLUGIN_DIR . '/views/view-admin-icp-clinics.php');
    }

    public function add_configuration_page( $pages ){

    	$pages[$this->id] = $this->label;
    	return $pages;
    }

    public function processCSV( $file_path ){

        icp_log( "includes/class-import-clinics.php(31) Importing Clinics Started");
        $arrClinics = getArrayFromCSV( $file_path );
        
        //echo json_encode( $clinic[0] );

        foreach( $arrClinics as $key => $clinic)
        {
            $userID = get_current_user_id();
            $clinicData = array(
                "post_title"        => $clinic['Clinic Name'], // have to chagned
                "post_status"       => "publish",
                "post_type"         => "clinic",
                "post_author"       => $userID
            );
global $wpdb;
$posttitle = $clinic['Clinic Name'];
$postid = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_title = '" . $posttitle . "'" );
print_r( get_post_meta($postid));

/*   
    Clinic Link
    - Clinic Name
    Rating
    - Logo
    - Phone
    Website
    - address
    - opening Hours
    - Description
    Acredited date
    Treatments
    Map Image

            $clinic_id = wp_insert_post( $clinicData );

            Generate_Featured_Image($clinic['Logo'], $clinic_id);

            $clinicMeta = array(
                "_dac_logo"         => $clinic['Logo'],
                "_dac_phone_number" => $clinic['Phone'],
                "_dac_clinic_location"  => $clinic['address'],
                "_dac_clinic_working_hours" => "9AM - 7PM",
                "_dac_about_me"     => $clinic['Description'],
                "_dac_days_full"    => date("y-m-d"),
                //"_dac_profession"   => array("Surgeon"),        // no CSV
                //"_dac_date_of_birth"        => "08/07/2016",    // no CSV
                );

            foreach ($clinicMeta as $key => $value) {
                if( !add_post_meta( $clinic_id, $key, $value ) )
                    update_post_meta( $clinic_id, $key, $value );
            }  
*/
            return;  
        }    
    }
}

return new ICP_Clinics();