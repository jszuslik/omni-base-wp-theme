<?php
/**
 * Created by PhpStorm.
 * User: joshua.szuslik
 * Date: 10/12/2017
 * Time: 10:20 AM
 */

class OmniOption {

	private $default = null;
	private $omni_customize = null;

	public function __construct() {
		$this->default = OmniDefault::omni_wp_theme_default_theme_options();
		$this->omni_wp_theme_add_theme_options();
		// p($wp_customize);
	}

	public function omni_wp_theme_add_theme_options() {
		global $wp_customize;
		// Add Panel.
		$wp_customize->add_panel( 'theme_option_panel',
			array(
			  'title'      => __( 'Theme Options', OMNI_TXT_DOMAIN ),
			  'priority'   => 100,
			  'capability' => 'edit_theme_options',
			)
		);
		// Header Section
		$wp_customize->add_section( 'section_header' ,
			array(
				'title' => __('Header Options', OMNI_TXT_DOMAIN),
				'priority' => 100,
				'capability' => 'edit_theme_options',
				'panel' => 'theme_option_panel'
			)
		);
		// Setting show_title.
		$wp_customize->add_setting( 'theme_options[show_title]',
			array(
				'default'           => $this->default['show_title'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => array( 'OmniSanitize', 'omni_wp_theme_sanitize_checkbox'),
			)
		);

		$wp_customize->add_control( 'theme_options[show_title]',
			array(
				'label'    => __( 'Show Site Title', OMNI_TXT_DOMAIN ),
				'section'  => 'section_header',
				'type'     => 'checkbox',
				'priority' => 100,
			)
		);

		// Setting show_tagline.
		$wp_customize->add_setting( 'theme_options[show_tagline]',
			array(
				'default'           => $this->default['show_tagline'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => array( 'OmniSanitize', 'omni_wp_theme_sanitize_checkbox'),
			)
		);
		$wp_customize->add_control( 'theme_options[show_tagline]',
			array(
				'label'    => __( 'Show Tagline', 'university-hub-pro' ),
				'section'  => 'section_header',
				'type'     => 'checkbox',
				'priority' => 100,
			)
		);

// Setting show_ticker.
		$wp_customize->add_setting( 'theme_options[show_ticker]',
			array(
				'default'           => $this->default['show_ticker'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => array( 'OmniSanitize', 'omni_wp_theme_sanitize_checkbox'),
			)
		);
		$wp_customize->add_control( 'theme_options[show_ticker]',
			array(
				'label'    => __( 'Show News Ticker', 'university-hub-pro' ),
				'section'  => 'section_header',
				'type'     => 'checkbox',
				'priority' => 100,
			)
		);

		// Setting ticker_title.
		$wp_customize->add_setting( 'theme_options[ticker_title]',
			array(
				'default'           => $this->default['ticker_title'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( 'theme_options[ticker_title]',
			array(
			    'label'           => __( 'Ticker Title', OMNI_TXT_DOMAIN ),
			    'section'         => 'section_header',
			    'type'            => 'text',
			    'priority'        => 100,
			    'active_callback' => array( 'OmniCallback', 'omni_wp_theme_is_news_ticker_active'),
			)
		);


	}

}
$omni_option = new OmniOption();