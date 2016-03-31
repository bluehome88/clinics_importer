<?php

class ICP_Admin_Page{

	public static function render(){

		$current_tab = !empty( $_REQUEST['tab']) ? sanitize_title( $_REQUEST['tab']) : 'clinics';

		require_once( PLUGIN_DIR . '/includes/class-import-clinics.php');
		require_once( PLUGIN_DIR . '/includes/class-import-pract.php');
		require_once( PLUGIN_DIR . '/includes/class-import-settings.php');

		$tabs = apply_filters("icp_configuration_tabs_array", array());
		include( PLUGIN_DIR . '/views/view-admin-main.php');
	}
}