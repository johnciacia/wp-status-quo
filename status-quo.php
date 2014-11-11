<?php
/**
 * Plugin Name: Status Quo
 * Version: 0.1
 */


require_once( __DIR__ . '/core.php' );
require_once( __DIR__ . '/plugin.php' );

add_action( 'wp_ajax_status-quo', 'get_status_quo' );
add_action( 'wp_ajax_nopriv_status-quo', 'get_status_quo' );

function get_status_quo() {

	$upgrades = array(
		'meta' => array(
			'name' => get_bloginfo('name'),
			'description' => get_bloginfo('description'),
			'php_version' => phpversion(),
			'mysql_version' => wp_check_php_mysql_versions(),
		),
		'core' => get_core_status(),
		'plugins' => get_plugin_status(),
//		'themes' => get_site_transient( 'update_themes' ),
	);

	wp_send_json_success( $upgrades );
}

//add_action( 'wp_ajax_status-quo-update', 'update_plugin' );
//add_action( 'wp_ajax_nopriv_status-quo-update', 'update_plugin' );
//
//function update_plugin() {
//
//	include_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
//
//	$plugin = 'hello.php';
//	$upgrader = new Plugin_Upgrader( new Plugin_Upgrader_Skin() );
//	$upgrader->upgrade($plugin);
//}
//
