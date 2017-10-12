<?php

class OmniDefault {

	public static function omni_wp_theme_default_theme_options() {

		$defaults = array();

		// Header.
		$defaults['show_title']                 = true;
		$defaults['show_tagline']               = true;
		$defaults['show_ticker']                = true;
		$defaults['ticker_title']               = __( 'News:', OMNI_TXT_DOMAIN );
		$defaults['ticker_category']            = 0;
		$defaults['ticker_number']              = 3;


		// Pass through filter.
		$defaults = apply_filters( 'omni_wp_theme_filter_default_theme_options', $defaults );
		return $defaults;
	}

}