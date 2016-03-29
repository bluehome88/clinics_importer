<?php
/*
	perform importing Clinics
*/

class ICP_Practitioners{

    public function __construct() {
        $this->id = 'pract';
        $this->label = 'Pratitioners';

        add_filter('icp_configuration_tabs_array', array($this, 'add_configuration_page'), 4);
        add_action('icp_configuration_' . $this->id, array($this, 'render'));
        add_action('icp_configuration_save_' . $this->id, array($this, 'save'));
    }

    public function render() {
        
		include( PLUGIN_DIR . '/views/view-admin-icp-pract.php');
    }

    public function add_configuration_page( $pages ){

    	$pages[$this->id] = $this->label;
    	return $pages;
    }

}

return new ICP_Practitioners();