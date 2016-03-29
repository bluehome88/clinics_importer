<?php
/*
	perform importing Clinics
*/

class ICP_Settigns{

    public function __construct() {
        $this->id = 'settings';
        $this->label = 'Settigns';

        add_filter('icp_configuration_tabs_array', array($this, 'add_configuration_page'), 4);
        add_action('icp_configuration_' . $this->id, array($this, 'render'));
        add_action('icp_configuration_save_' . $this->id, array($this, 'save'));
    }

    public function render() {
        
		include( PLUGIN_DIR . '/views/view-admin-icp-settings.php');
    }

    public function add_configuration_page( $pages ){

    	$pages[$this->id] = $this->label;
    	return $pages;
    }

}

return new ICP_Settigns();