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
        add_action('icp_configuration_save_' . $this->id, array($this, 'save_settings'));
    }

    public function render() {

        if( isset($_POST['save']))
            $this->save_settings();

        $icp_force_import = get_option("icp_force_import");
        $icp_import_limit = get_option("icp_import_limit");

        $icp_force_import_checked = "";
        if( $icp_force_import == "yes")
            $icp_force_import_checked = "checked";
		include( PLUGIN_DIR . '/views/view-admin-icp-settings.php');
    }

    public function add_configuration_page( $pages ){

    	$pages[$this->id] = $this->label;
    	return $pages;
    }

    public function save_settings(){

        update_option("icp_force_import", isset($_REQUEST['icp_force_import']) ? 'yes' : 'no');
        update_option("icp_import_limit", $_REQUEST['icp_import_limit']) ;
    }
}

return new ICP_Settigns();