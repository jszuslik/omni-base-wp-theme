<?php

class OmniHeaderOption {

	private $default = null;

	public function __construct() {
		$this->default = OmniDefault::omni_wp_theme_default_theme_options();
		$this->omni_wp_theme_add_header_options();
	}

	public function omni_wp_theme_add_header_options() {
		global $wp_customize;
		// Header Section
		$wp_customize->add_section( 'section_header' ,
			array(
				'title' => __('Header Options', OMNI_TXT_DOMAIN),
				'priority' => 100,
				'capability' => 'edit_theme_options',
				'panel' => 'theme_option_panel'
			)
		);
		// Primary Menu Alignment
		$wp_customize->add_setting( 'theme_options[primary_menu_alignment]',
			array(
				'default'     => $this->default['primary_menu_alignment'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => array('OmniSanitize', 'omni_wp_theme_sanitize_select')
			)
		);
		$wp_customize->add_control( 'theme_options[primary_menu_alignment]',
			array(
				'label'    => __( 'Primary Menu Alignment', OMNI_TXT_DOMAIN ),
				'section'  => 'section_header',
				'type'     => 'select',
				'choices'  => OmniOptions::omni_wp_theme_get_primary_menu_alignment_options(),
				'priority' => 100
			)
		);

		// Branding Background Width
		$wp_customize->add_setting( 'theme_options[branding_bg_width]',
			array(
				'default'     => $this->default['branding_bg_width'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => array('OmniSanitize', 'omni_wp_theme_sanitize_select')
			)
		);
		$wp_customize->add_control( 'theme_options[branding_bg_width]',
			array(
				'label'    => __( 'Branding Background Width', OMNI_TXT_DOMAIN ),
				'section'  => 'section_header',
				'type'     => 'select',
				'choices'  => OmniOptions::omni_wp_theme_get_primary_menu_width_options(),
				'priority' => 100
			)
		);
		// Branding Container Width
		$wp_customize->add_setting( 'theme_options[branding_header_width]',
			array(
				'default'     => $this->default['branding_header_width'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => array('OmniSanitize', 'omni_wp_theme_sanitize_select')
			)
		);
		$wp_customize->add_control( 'theme_options[branding_header_width]',
			array(
				'label'    => __( 'Branding Container Width', OMNI_TXT_DOMAIN ),
				'section'  => 'section_header',
				'type'     => 'select',
				'choices'  => OmniOptions::omni_wp_theme_get_primary_menu_width_options(),
				'priority' => 100
			)
		);
		// Branding Background Color Select
		$wp_customize->add_setting( 'theme_options[branding_bg_color_select]',
			array(
				'default'     => $this->default['branding_bg_color_select'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => array('OmniSanitize', 'omni_wp_theme_sanitize_select')
			)
		);
		$wp_customize->add_control( 'theme_options[branding_bg_color_select]',
			array(
				'label'    => __( 'Branding Background', OMNI_TXT_DOMAIN ),
				'section'  => 'section_header',
				'type'     => 'select',
				'choices'  => OmniOptions::omni_wp_theme_get_bg_color_options(),
				'priority' => 100
			)
		);
		// Branding Background Image Upload
		$wp_customize->add_setting( 'theme_options[branding_bg_image_upload]',
			array(
				'default'     => $this->default['branding_bg_image_upload'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'theme_options[branding_bg_image_upload]',
				array(
					'label'      => __( 'Branding Background Image', OMNI_TXT_DOMAIN ),
					'section'    => 'section_header',
					'settings'   => 'theme_options[branding_bg_image_upload]',
					'priority'   => 100,
					'active_callback' => array( 'OmniCallback', 'omni_wp_theme_is_branding_bg_image')
				)
			)
		);

		// Branding Background Color
		$wp_customize->add_setting( 'theme_options[branding_bg_color]',
			array(
				'default'           => $this->default['branding_bg_color'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_attr',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control( $wp_customize, 'theme_options[branding_bg_color]',
				array(
					'label'    => __( 'Branding Background Custom Color', OMNI_TXT_DOMAIN),
					'section'  => 'section_header',
					'settings' => 'theme_options[branding_bg_color]',
					'priority'   => 100,
					'active_callback' => array( 'OmniCallback', 'omni_wp_theme_is_branding_bg_color')
				)
			)
		);
		// Branding Background Color
		$wp_customize->add_setting( 'theme_options[branding_link_color]',
			array(
				'default'           => $this->default['branding_link_color'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_attr',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control( $wp_customize, 'theme_options[branding_link_color]',
				array(
					'label'    => __( 'Branding Link Text Color', OMNI_TXT_DOMAIN),
					'section'  => 'section_header',
					'settings' => 'theme_options[branding_link_color]',
					'priority'   => 100
				)
			)
		);

		//Branding Header Padding Top
		$wp_customize->add_setting( 'theme_options[branding_pad_top]',
			array(
				'default'         => $this->default['branding_pad_top'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Omni_Header_Padding_Control( $wp_customize, 'theme_options[branding_pad_top]',
				 array(
					 'label'    => __('Branding Header Padding', OMNI_TXT_DOMAIN),
					 'description' => __('Top', OMNI_TXT_DOMAIN),
					 'section'  => 'section_header',
					 'settings' => 'theme_options[branding_pad_top]',
					 'priority' => 100
				 )
			)
		);
		//Branding Header Padding Right
		$wp_customize->add_setting( 'theme_options[branding_pad_right]',
			array(
				'default'         => $this->default['branding_pad_right'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Omni_Header_Padding_Control( $wp_customize, 'theme_options[branding_pad_right]',
				 array(
					 'description' => __('Right', OMNI_TXT_DOMAIN),
					 'section'  => 'section_header',
					 'settings' => 'theme_options[branding_pad_right]',
					 'priority' => 100
				 )
			)
		);
		//Branding Header Padding Bottom
		$wp_customize->add_setting( 'theme_options[branding_pad_bottom]',
			array(
				'default'         => $this->default['branding_pad_bottom'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Omni_Header_Padding_Control( $wp_customize, 'theme_options[branding_pad_bottom]',
				 array(
					 'description' => __('Bottom', OMNI_TXT_DOMAIN),
					 'section'  => 'section_header',
					 'settings' => 'theme_options[branding_pad_bottom]',
					 'priority' => 100
				 )
			)
		);
		//Branding Header Padding Left
		$wp_customize->add_setting( 'theme_options[branding_pad_left]',
			array(
				'default'         => $this->default['branding_pad_left'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Omni_Header_Padding_Control( $wp_customize, 'theme_options[branding_pad_left]',
				 array(
					 'description' => __('Left', OMNI_TXT_DOMAIN),
					 'section'  => 'section_header',
					 'settings' => 'theme_options[branding_pad_left]',
					 'priority' => 100
				 )
			)
		);

		// Primary Menu Width
		$wp_customize->add_setting( 'theme_options[primary_menu_width]',
			array(
				'default'     => $this->default['primary_menu_width'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => array('OmniSanitize', 'omni_wp_theme_sanitize_select')
			)
		);
		$wp_customize->add_control( 'theme_options[primary_menu_width]',
			array(
				'label'    => __( 'Primary Menu Width', OMNI_TXT_DOMAIN ),
				'section'  => 'section_header',
				'type'     => 'select',
				'choices'  => OmniOptions::omni_wp_theme_get_primary_menu_width_options(),
				'priority' => 100,
				'active_callback' => array( 'OmniCallback', 'omni_wp_theme_is_menu_alignment_non_inline')
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
				'label'    => __( 'Show Tagline', OMNI_TXT_DOMAIN ),
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
				'label'    => __( 'Show News Ticker', OMNI_TXT_DOMAIN ),
				'section'  => 'section_header',
				'type'     => 'checkbox',
				'priority' => 100,
			)
		);

		$wp_customize->add_setting( 'theme_options[ticker_color]',
			array(
				'default'     => $this->default['ticker_color'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => array('OmniSanitize', 'omni_wp_theme_sanitize_select')
			)
		);
		$wp_customize->add_control( 'theme_options[ticker_color]',
			array(
				'label'    => __( 'Ticker Color', OMNI_TXT_DOMAIN ),
				'section'  => 'section_header',
				'type'     => 'select',
				'choices'  => OmniOptions::omni_wp_theme_get_bs_color_options(),
				'priority' => 100,
				'active_callback' => array( 'OmniCallback', 'omni_wp_theme_is_news_ticker_active')
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
		$wp_customize->add_setting( 'theme_options[ticker_category]',
			array(
				'default'           => $this->default['ticker_category'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new Omni_Dropdown_Taxonomies_Control( $wp_customize, 'theme_options[ticker_category]',
				array(
					'label'           => __( 'Ticker Category', OMNI_TXT_DOMAIN ),
					'section'         => 'section_header',
					'settings'        => 'theme_options[ticker_category]',
					'priority'        => 100,
					'active_callback' => array( 'OmniCallback', 'omni_wp_theme_is_news_ticker_active'),
				)
			)
		);
		// Setting ticker_number.
		$wp_customize->add_setting( 'theme_options[ticker_number]',
			array(
				'default'           => $this->default['ticker_number'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => array( 'OmniSanitize', 'omni_wp_theme_sanitize_positive_integer'),
			)
		);
		$wp_customize->add_control( 'theme_options[ticker_number]',
			array(
				'label'           => __( 'Number of Posts', OMNI_TXT_DOMAIN ),
				'section'         => 'section_header',
				'type'            => 'number',
				'priority'        => 100,
				'active_callback' => array( 'OmniCallback', 'omni_wp_theme_is_news_ticker_active'),
				'input_attrs'     => array( 'min' => 1, 'max' => 20, 'style' => 'width: 55px;' ),
			)
		);

		$wp_customize->add_setting( 'theme_options[show_social_in_header]',
			array(
				'default'           => $this->default['show_social_in_header'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => array( 'OmniSanitize', 'omni_wp_theme_sanitize_checkbox'),
			)
		);
		$wp_customize->add_control( 'theme_options[show_social_in_header]',
			array(
				'label'    => __( 'Show Social Icons in Header', OMNI_TXT_DOMAIN ),
				'section'  => 'section_header',
				'type'     => 'checkbox',
				'priority' => 100,
			)
		);
	}

}
$omni_header_option = new OmniHeaderOption();