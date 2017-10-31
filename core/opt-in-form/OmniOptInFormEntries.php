<?php

class OmniOptInFormEntries {

	public function __construct() {

	}

	public static function omni_wp_theme_add_opt_in_entry($entry) {
		global $wpdb;
		$table_name = $wpdb->prefix . 'omni_opt_in';
		$wpdb->insert(
			$table_name,
			array(
				'time'       => $entry['time'],
				'value'      => $entry['value'],
				'type'       => $entry['type'],
				'ip_address' => $entry['ip_address']
			),
			array(
				'%s',
				'%s',
				'%s',
				'%s'
			)
		);

		return $wpdb->insert_id;
	}

}