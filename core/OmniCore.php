<?php

class OmniCore {

	public static function omni_wp_theme_get_option( $key ) {
		$default_options = OmniDefault::omni_wp_theme_default_theme_options();

		if ( empty( $key ) ) {
			return null;
		}

		$theme_options = (array) get_theme_mod('theme_options');
		$theme_options = wp_parse_args( $theme_options, $default_options );

		$value = null;

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;
	}

}