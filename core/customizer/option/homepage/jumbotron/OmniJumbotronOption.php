<?php

class OmniJumbotronOption {

	private $default = null;

	public function __construct() {
		$this->default = OmniDefault::omni_wp_theme_default_theme_options();
		$this->omni_wp_theme_add_jumbo_options();
	}

	public function omni_wp_theme_add_jumbo_options() {
		global $wp_customize;
		// Jumbotron Section
		$wp_customize->add_section( 'section_jumbotron' ,
			array(
				'title' => __('Jumbotron Options', OMNI_TXT_DOMAIN),
				'priority' => 90,
				'capability' => 'edit_theme_options',
				'panel' => 'homepage_option_panel'
			)
		);

		// Turn on/off home page Jumbotron
		$wp_customize->add_setting( 'theme_options[jumbotron_switch]',
			array(
				'default'     => $this->default['jumbotron_switch'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => array( 'OmniSanitize', 'omni_wp_theme_sanitize_checkbox'),
			)
		);
		$wp_customize->add_control( 'theme_options[jumbotron_switch]',
			array(
				'label'    => __( 'Enable Jumbotron', OMNI_TXT_DOMAIN ),
				'section'  => 'section_jumbotron',
				'type'     => 'checkbox',
				'priority' => 100
			)
		);
		// Is Jumbotron image or video
		$wp_customize->add_setting( 'theme_options[jumbotron_type]',
			array(
				'default'      => $this->default['jumbotron_type'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => array('OmniSanitize', 'omni_wp_theme_sanitize_select')
			)
		);
		$wp_customize->add_control( 'theme_options[jumbotron_type]',
			array(
				'label'    => __( 'Jumbotron Type', OMNI_TXT_DOMAIN ),
				'section'  => 'section_jumbotron',
				'type'     => 'select',
				'choices'  => OmniOptions::omni_wp_theme_select_jumbotron_type_options(),
				'priority' => 100,
				'active_callback' => array( 'OmniCallback', 'omni_wp_theme_is_jumbotron_enabled')
			)
		);
		$wp_customize->add_setting( 'theme_options[jumbotron_bg_image_upload]',
			array(
				'default'     => $this->default['jumbotron_bg_image_upload'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => 'esc_attr'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'theme_options[jumbotron_bg_image_upload]',
				array(
					'label'      => __( 'Jumbotron Background Image', OMNI_TXT_DOMAIN ),
					'section'    => 'section_jumbotron',
					'settings'   => 'theme_options[jumbotron_bg_image_upload]',
					'priority'   => 100,
					'active_callback' => array( 'OmniCallback', 'omni_wp_theme_is_jumbotron_enabled')
				)
			)
		);
		$wp_customize->add_setting( 'theme_options[jumbotron_header]',
			array(
				'default'     => $this->default['jumbotron_header'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( 'theme_options[jumbotron_header]',
			array(
				'label'    => __( 'Jumbotron Header', OMNI_TXT_DOMAIN ),
				'section'  => 'section_jumbotron',
				'type'     => 'text',
				'priority' => 100,
				'active_callback' => array( 'OmniCallback', 'omni_wp_theme_is_jumbotron_enabled')
			)
		);
		$wp_customize->add_setting( 'theme_options[jumbotron_sub_header]',
            array(
                'default'     => $this->default['jumbotron_sub_header'],
                'capability'  => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            )
		);
		$wp_customize->add_control( 'theme_options[jumbotron_sub_header]',
			array(
				'label'    => __( 'Jumbotron Sub Header', OMNI_TXT_DOMAIN ),
				'section'  => 'section_jumbotron',
				'type'     => 'text',
				'priority' => 100,
				'active_callback' => array( 'OmniCallback', 'omni_wp_theme_is_jumbotron_enabled')
			)
		);
		$wp_customize->add_setting( 'theme_options[jumbotron_content]',
			array(
				'default'     => $this->default['jumbotron_content'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control( 'theme_options[jumbotron_content]',
			array(
				'label'    => __( 'Jumbotron Content', OMNI_TXT_DOMAIN ),
				'section'  => 'section_jumbotron',
				'type'     => 'textarea',
				'priority' => 100,
				'active_callback' => array( 'OmniCallback', 'omni_wp_theme_is_jumbotron_enabled')
			)
		);
	}

}
$omni_jumbotron_option = new OmniJumbotronOption();