<?php
/**
 * Callback functions for active_callback.
 *
 * @package Omni_WP_Theme
 */

class OmniCallback {

	public static function omni_wp_theme_is_news_ticker_active( $control ) {
		if ( $control->manager->get_setting( 'theme_options[show_ticker]' )->value() ) {
			return true;
		} else {
			return false;
		}
	}

	public static function omni_wp_theme_is_menu_alignment_inline( $control ) {
		if ( $control->manager->get_setting( 'theme_options[primary_menu_alignment]' )->value() === 'inline') {
			return true;
		} else {
			return false;
		}
	}

	public static function omni_wp_theme_is_menu_alignment_non_inline( $control ) {
		if ( $control->manager->get_setting( 'theme_options[primary_menu_alignment]' )->value() != 'inline') {
			return true;
		} else {
			return false;
		}
	}

	public static function omni_wp_theme_is_branding_bg_image( $control ) {
		if ( $control->manager->get_setting( 'theme_options[branding_bg_color_select]' )->value() === '-custom-image') {
			return true;
		} else {
			return false;
		}
	}

	public static function omni_wp_theme_is_branding_bg_color( $control ) {
		if ( $control->manager->get_setting( 'theme_options[branding_bg_color_select]' )->value() === '-custom-color') {
			return true;
		} else {
			return false;
		}
	}

	public static function omni_wp_theme_is_jumbotron_enabled( $control ) {
		if ( $control->manager->get_setting( 'theme_options[jumbotron_switch]')->value()) {
			return true;
		} else {
			return false;
		}
	}

}