<?php

if( !defined('ABSPATH')){
	exit;
}

class ICP_Admin_Menu{

	public function __construct(){

		add_action('init', array( $this, 'icp_add_menu'));
	}

	public function icp_add_menu(){

		add_submenu_page( 'edit.php?post_type=clinic', 'Import Data', 'Import Data', 'edit_posts', 'icp', array( $this, 'icp_admin_page') );
	}

	public function icp_admin_page()
	{
		require_once( PLUGIN_DIR . '/includes/class-admin-page.php');
		ICP_Admin_Page::render();
	}
}

return new ICP_Admin_Menu();
