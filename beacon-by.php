<?php 
/*
	Plugin Name: Beacon Plugin
	Description: Create, Promote and Embed eBooks
	Version: 1.0
	Author: Beacon
	Author URI: http://beacon.by
    Plugin URI: http://beacon.by/wordpress/
	License: GPL v2 (or later)
	copyright 2015 beacon.by
*/


// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

require( 'config.php' );
require( 'classes/class.beacon_widget.php' );
require( 'classes/class.beacon_plugin.php' );



function beacon_register_widget() {

	register_widget( 'Beacon_widget' );
}


function beacon_row_meta( $links, $file ) {

	$plugin = plugin_basename(__FILE__);

	if ( $file == $plugin ) {

		$new_links = array(
					'<a href="admin.php?page=beaconby-help">Help</a>',
				);
		
		$links = array_merge( $links, $new_links );

	}

	return $links;
}


add_action( 'widgets_init', 'beacon_register_widget' );
add_action( 'admin_init', array( 'Beacon_plugin', 'init' ) );
add_action( 'admin_menu', array( 'Beacon_plugin', 'menu'));

add_filter( 'plugin_row_meta', 'beacon_row_meta', 10, 2);


register_activation_hook( __FILE__, array( 'Beacon_plugin', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Beacon_plugin', 'plugin_deactivation' ) );
