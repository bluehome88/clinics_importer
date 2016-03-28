<?php
/**
 * Plugin Name: Import Clinics and Pratitioners
 * Version: 1.0
 * Description: Import Clinnics and Partitioners from CSV file depends on Doctors or Clinics Management Plugin.
 * Author: Yakov(Bluehome)
 */

/**************
 * CONSTANTS
 **************/

if ( ! defined( 'ABSPATH' ) ) { 
    exit;
}

if ( ! in_array( 'sitenex-dac/sitenex-dac.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
  return;
}

?>