<?php
/**
 * Plugin Name: Import Clinics and Pratitioners
 * Version: 1.0
 * Description: Import Clinnics and Partitioners from CSV file depends on Doctors or Clinics Management Plugin.
 * Author: Bluehome88
 */
/* Abbreviatoin of this plugin: ICP( import clinics and practitioners)*/

if ( ! defined( 'ABSPATH' ) ) { 
    exit;
}

define("PLUGIN_DIR", dirname(__FILE__));

if ( ! in_array( 'sitenex-dac/sitenex-dac.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	return;
}


class ICP {

	public function __construct(){

		$this->includes();
	}

	private function includes(){

		require_once( PLUGIN_DIR . "/includes/settings.php");
		require_once( PLUGIN_DIR . "/includes/functions.php");
		require_once( PLUGIN_DIR . "/includes/class-admin-menu.php" );

		// load css file
		$plugins_url = trailingslashit( plugins_url() ) . trailingslashit( PLUGIN_DIR_NAME );
		$css_src = $plugins_url . 'css/style.css';
		wp_enqueue_style( 'icp-style', $css_src, array(), PLUGIN_VERSION );

		// load js file
		$js_src = $plugins_url . 'js/script.js';
		wp_enqueue_script( 'icp-style', $js_src, array(), PLUGIN_VERSION );

	}
}

$icp = new ICP();