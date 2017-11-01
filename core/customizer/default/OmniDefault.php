<?php

class OmniDefault {

	public static function omni_wp_theme_default_theme_options() {

		$defaults = array();

		// Header.
		$defaults['fixed_header']                 = false;
		$defaults['primary_menu_alignment']       = 'under';
		$defaults['primary_menu_width']           = 'container';
		$defaults['branding_bg_width']            = 'container-fluid';
		$defaults['branding_header_width']        = 'container';
		$defaults['branding_bg_color_select']     = 'bg-dark';
		$defaults['branding_navbar_color_select'] = 'navbar-dark';
		$defaults['branding_bg_image_upload']     = '';
		$defaults['branding_bg_color']            = '#000';
		$defaults['branding_link_color']          = '#fff';
		$defaults['branding_pad_top']             = 0;
		$defaults['branding_pad_right']           = 0;
		$defaults['branding_pad_bottom']          = 0;
		$defaults['branding_pad_left']            = 0;
		$defaults['show_title']                   = true;
		$defaults['show_tagline']                 = true;
		$defaults['show_ticker']                  = true;
		$defaults['ticker_title']                 = __( 'News:', OMNI_TXT_DOMAIN );
		$defaults['ticker_category']              = 0;
		$defaults['ticker_number']                = 3;
		$defaults['ticker_color']                 = '-primary';
		$defaults['ticker_category']              = 0;
		$defaults['ticker_number']                = 3;
		$defaults['ticker_outer_width']           = 'full';
		$defaults['ticker_inner_width']           = 'container';
		$defaults['show_social_in_header']        = false;
		$defaults['contact_number']               = '';
		$defaults['contact_email']                = '';
		$defaults['contact_address_1']            = '';
		$defaults['contact_address_2']            = '';
		$defaults['jumbotron_switch']             = false;
		$defaults['jumbotron_type']               = 'image';
		$defaults['jumbotron_bg_image_upload']    = '';
		$defaults['jumbotron_mp4_upload']         = '';
		$defaults['jumbotron_ogg_upload']         = '';
		$defaults['jumbotron_img_cback_upload']   = '';
		$defaults['jumbotron_header']             = '';
		$defaults['jumbotron_sub_header']         = '';
		$defaults['jumbotron_content']            = '';

		$defaults['num_of_homepage_sections']     = 10;
		$defaults['hp_section_bg_color']          = '-primary';
		$defaults['homepage_sections']            = array( 'call-to-action', 'news-and-events', 'latest-news' );

		$defaults['footer_bg_width']              = 'container-fluid';
		$defaults['footer_content_width']         = 'container';
		$defaults['footer_bg_color_select']       = '-primary';
		$defaults['footer_bg_image_upload']       = '';
		$defaults['footer_bg_color']              = '#000';
		$defaults['footer_text_color']            = '#fff';
		$defaults['show_social_in_footer']        = false;
		$defaults['footer_copyright']             = '';



		// Pass through filter.
		$defaults = apply_filters( 'omni_wp_theme_filter_default_theme_options', $defaults );
		return $defaults;
	}

}