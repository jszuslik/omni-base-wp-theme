<?php
/**
 * Sanitization Functions
 *
 * @package Omni_WP_Theme
 */

class OmniSanitize {

	public static function omni_wp_theme_sanitize_select( $input, $setting ) {

		//Ensure input is a slug
		$input = sanitize_key( $input );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	public static function omni_wp_theme_sanitize_checkbox($checked) {
		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}

}