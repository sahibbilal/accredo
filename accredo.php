<?php

/**
Plugin Name: Accredo
Plugin URI: ###
description: Accredo Products Import.
Version: 1.0.0
Author: WFAC
License: GPLv2 or later
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 *plugin version.
 */
define( 'ACCREDO_SB_VERSION', '1.0' );
/**
 * Plugin activator function
 */
function ACCREDO_SB_Activate() {
    
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-accredo-sb-activator.php';
    ACCREDO_SB_Activator::activate();

}

/**
 *Plugin deactivator function
 */
function ACCREDO_SB_Deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-accredo-sb-deactivator.php';
	ACCREDO_SB_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'ACCREDO_SB_Activate' );
register_deactivation_hook( __FILE__, 'ACCREDO_SB_Deactivate' );

require plugin_dir_path( __FILE__ ) . 'includes/class-accredo-sb.php';

/**
 * Start plugin's execution.
 *
 */
function run_WTS_BOOKING_CENTER_max() {

    $main = new ACCREDO_SB();
    $main->max_run();
}
run_WTS_BOOKING_CENTER_max();

