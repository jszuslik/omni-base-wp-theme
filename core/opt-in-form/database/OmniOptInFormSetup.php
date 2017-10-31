<?php

class OmniOptInFormSetup {

	private $omni_opt_in_version;

	public function __construct() {
		$this->omni_opt_in_version = '2.0';
		add_action('after_setup_theme', array($this, 'omni_wp_theme_opt_in_upgrade_check'));
	}

	public function omni_wp_theme_opt_in_upgrade_check() {
		if(!get_site_option('omni_opt_in_table_version')){
			$this->omni_wp_theme_add_version_option();
		}
		if (get_site_option('omni_opt_in_table_version') != $this->omni_opt_in_version) {
			$this->omni_wp_theme_table_install();
		}
	}

	public function omni_wp_theme_table_install() {
		global $wpdb;

		$table_name = $wpdb->prefix . 'omni_opt_in';
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			value varchar(50) NOT NULL,
			type  tinytext NOT NULL,
			ip_address varchar(50) DEFAULT '' NOT NULL,
			PRIMARY KEY (id)		
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta($sql);
		update_option( 'omni_opt_in_table_version', $this->omni_opt_in_version );
	}

	public function omni_wp_theme_add_version_option() {
		add_option('omni_opt_in_table_version', $this->omni_opt_in_version);
	}

}
$omni_opt_in_form_setup = new OmniOptInFormSetup();