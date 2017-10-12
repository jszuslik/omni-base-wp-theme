<?php
/**
 * Callback functions for active_callback.
 *
 * @package Omni_WP_Theme
 */

class OmniCallback {

	public static function omni_wp_theme_is_jumbotron_image_active( $control ) {

		if ( $control->manager->get_setting('theme_options[show_jumbo_image]' ) ) {
			return true;
		} else {
			return false;
		}

	}

	public static function omni_wp_theme_is_news_ticker_active( $control ) {
		if ( $control->manager->get_setting( 'theme_options[show_ticker]' )->value() ) {
			return true;
		} else {
			return false;
		}
	}

}