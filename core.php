<?php

class Status_Quo_Core {

	/**
	 * @var Current version of WordPress
	 */
	public $current;

	/**
	 * @var Latest version of WordPress
	 */
	public $latest;

	/**
	 * @var Required PHP version
	 */
	public $php_version;

	/**
	 * @var Required MySQL version
	 */
	public $mysql_version;

	public function __construct() {

		$core = get_site_transient( 'update_core' );

		$this->current = $core->updates[0]->current;
		$this->latest = $core->updates[0]->version;
		$this->php_version = $core->updates[0]->php_version;
		$this->mysql_version = $core->updates[0]->mysql_version;

	}

}

function get_core_status() {

	return new Status_Quo_Core();

}