<?php

class Status_Quo_Plugin {

	/**
	* @var Plugin
	*/
	public $plugin;

	/**
	* @var Plugin name
	*/
	public $name;

	/**
	* @var Plugin description
	*/
	public $description;

	/**
	* @var Version of the plugin running on the host site
	*/
	public $current;

	/**
	* @var Latest version of the plugin
	*/
	public $latest;

	/**
	* @var Minimum version of WordPress required to use plugin
	*/
	public $requires;

	/**
	* @var Latest version of WordPress plugin has been tested with
	*/
	public $tested;

	/**
	 * @var
	 */
	private $data;

	public function __construct( $plugin, $data ) {

		$this->data = get_site_transient( 'update_plugins' );

		$this->plugin = $plugin;
		$this->slug = $this->get_slug();


		$this->latest = $this->get_latest_version();
		$this->current = $data['Version'];

		$api = plugins_api( 'plugin_information', array( 'slug' => $this->slug ) );

		$this->requires = $api->requires;
		$this->tested = $api->tested;

		$this->name = $data['Name'];
		$this->description = $data['Description'];

	}

	/**
	 * @return mixed
	 */
	function get_latest_version() {

		if ( isset( $this->data->response[ $this->plugin ] ) ) {

			return $this->data->response[ $this->plugin ]->new_version;

		}

		return $this->data->no_update[ $this->plugin ]->new_version;

	}

	/**
	 * @return mixed
	 */
	function get_slug() {

		if ( isset( $this->data->response[ $this->plugin ] ) ) {

			return $this->data->response[ $this->plugin ]->slug;

		}

		return $this->data->no_update[ $this->plugin ]->slug;

	}
}



function get_plugin_status() {
	require_once( ABSPATH . 'wp-admin/includes/plugin-install.php' );

	$plugins = array();
	foreach ( (array) get_plugins() as $file => $data ) {
		$plugins[] = new Status_Quo_Plugin( $file, $data );
	}

	return $plugins;
}