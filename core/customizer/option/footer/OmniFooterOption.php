<?php

class OmniFooterOption {

	private $default = null;

	public function __construct() {
		$this->default = OmniDefault::omni_wp_theme_default_theme_options();
		$this->omni_wp_theme_add_footer_options();
	}

	public function omni_wp_theme_add_footer_options() {
		global $wp_customize;
		// Header Section
		$wp_customize->add_section( 'section_footer' ,
			array(
				'title' => __('Footer Options', OMNI_TXT_DOMAIN),
				'priority' => 100,
				'capability' => 'edit_theme_options',
				'panel' => 'theme_option_panel'
			)
		);
		// Footer Background Width
		$wp_customize->add_setting( 'theme_options[footer_bg_width]',
			array(
				'default'     => $this->default['footer_bg_width'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => array('OmniSanitize', 'omni_wp_theme_sanitize_select')
			)
		);
		$wp_customize->add_control( 'theme_options[footer_bg_width]',
			array(
				'label'    => __( 'Footer Background Width', OMNI_TXT_DOMAIN ),
				'section'  => 'section_footer',
				'type'     => 'select',
				'choices'  => OmniOptions::omni_wp_theme_get_primary_menu_width_options(),
				'priority' => 100
			)
		);
		// Footer Background
		$wp_customize->add_setting( 'theme_options[footer_bg_color_select]',
			array(
				'default'     => $this->default['footer_bg_color_select'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => array('OmniSanitize', 'omni_wp_theme_sanitize_select')
			)
		);
		$wp_customize->add_control( 'theme_options[footer_bg_color_select]',
			array(
				'label'    => __( 'Footer Background Color', OMNI_TXT_DOMAIN ),
				'section'  => 'section_footer',
				'type'     => 'select',
				'choices'  => OmniOptions::omni_wp_theme_get_bg_color_options(),
				'priority' => 100
			)
		);
		// Footer Background Image Upload
		$wp_customize->add_setting( 'theme_options[footer_bg_image_upload]',
			array(
				'default'     => $this->default['footer_bg_image_upload'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'theme_options[footer_bg_image_upload]',
				array(
					'label'      => __( 'Footer Background Image', OMNI_TXT_DOMAIN ),
					'section'    => 'section_footer',
					'settings'   => 'theme_options[footer_bg_image_upload]',
					'priority'   => 100,
					'active_callback' => array( 'OmniCallback', 'omni_wp_theme_is_footer_bg_image')
				)
			)
		);
		// Footer Background Color
		$wp_customize->add_setting( 'theme_options[footer_bg_color]',
			array(
				'default'           => $this->default['footer_bg_color'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_attr',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control( $wp_customize, 'theme_options[footer_bg_color]',
				array(
					'label'    => __( 'Footer Background Custom Color', OMNI_TXT_DOMAIN),
					'section'  => 'section_footer',
					'settings' => 'theme_options[footer_bg_color]',
					'priority'   => 100,
					'active_callback' => array( 'OmniCallback', 'omni_wp_theme_is_footer_bg_color')
				)
			)
		);
		// Footer Background Width
		$wp_customize->add_setting( 'theme_options[footer_content_width]',
			array(
				'default'     => $this->default['footer_content_width'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => array('OmniSanitize', 'omni_wp_theme_sanitize_select')
			)
		);
		$wp_customize->add_control( 'theme_options[footer_content_width]',
			array(
				'label'    => __( 'Footer Content Width', OMNI_TXT_DOMAIN ),
				'section'  => 'section_footer',
				'type'     => 'select',
				'choices'  => OmniOptions::omni_wp_theme_get_primary_menu_width_options(),
				'priority' => 100
			)
		);
		// Footer Text Color
		$wp_customize->add_setting( 'theme_options[footer_text_color]',
			array(
				'default'           => $this->default['footer_text_color'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'esc_attr',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control( $wp_customize, 'theme_options[footer_text_color]',
				array(
					'label'    => __( 'Footer Text Color', OMNI_TXT_DOMAIN),
					'section'  => 'section_footer',
					'settings' => 'theme_options[footer_text_color]',
					'priority'   => 100
				)
			)
		);
		// Footer Social Icons
		$wp_customize->add_setting( 'theme_options[show_social_in_footer]',
			array(
				'default'           => $this->default['show_social_in_footer'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => array( 'OmniSanitize', 'omni_wp_theme_sanitize_checkbox'),
			)
		);
		$wp_customize->add_control( 'theme_options[show_social_in_footer]',
			array(
				'label'    => __( 'Show Social Icons in Footer', OMNI_TXT_DOMAIN ),
				'section'  => 'section_footer',
				'type'     => 'checkbox',
				'priority' => 100,
			)
		);
		// Footer Copyright
		$wp_customize->add_setting( 'theme_options[footer_copyright]',
			array(
				'default'           => $this->default['footer_copyright'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( 'theme_options[footer_copyright]',
			array(
				'label'           => __( 'Footer Copyright', OMNI_TXT_DOMAIN ),
				'section'         => 'section_footer',
				'type'            => 'text',
				'priority'        => 100
			)
		);
	}

}
$omni_footer_option = new OmniFooterOption();