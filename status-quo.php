<?php
/**
 * Plugin Name: Status Quo
 * Version: 0.1
 */

add_action( 'wp_ajax_status-quo', 'get_status_quo' );
add_action( 'wp_ajax_nopriv_status-quo', 'get_status_quo' );

function get_status_quo() {

	$upgrades = array(
		'core' => get_site_transient( 'update_core' ),
		'plugins' => get_site_transient( 'update_plugins' ),
		'themes' => get_site_transient( 'update_themes' ),
	);

	wp_send_json_success( $upgrades );
}
