<?php

class OmniOption {

	private $default = null;

	public function __construct() {
		$this->default = OmniDefault::omni_wp_theme_default_theme_options();
		$this->omni_wp_theme_add_theme_options();
	}

	public function omni_wp_theme_add_theme_options() {
		global $wp_customize;
		// Add Panel
		$wp_customize->add_section('site_info_panel',
			array(
				'title'    => __( 'Contact Info', OMNI_TXT_DOMAIN),
				'priority' => 90,
				'capability' => 'edit_theme_options',
			)
		);
		// Setting contact_number
		$wp_customize->add_setting('theme_options[contact_number]',
			array(
				'default'           => $this->default['contact_number'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control('theme_options[contact_number]',
			array(
				'label'    => __( 'Contact Number', OMNI_TXT_DOMAIN ),
				'section'  => 'site_info_panel',
				'type'     => 'text',
				'priority' => 100
			)
		);
		// Setting contact_email
		$wp_customize->add_setting('theme_options[contact_email]',
			array(
				'default'           => $this->default['contact_email'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control('theme_options[contact_email]',
			array(
				'label'    => __( 'Contact Email', OMNI_TXT_DOMAIN ),
				'section'  => 'site_info_panel',
				'type'     => 'text',
				'priority' => 100
			)
		);

		// Setting contact_address_1
		$wp_customize->add_setting('theme_options[contact_address_1]',
			array(
				'default'           => $this->default['contact_address_1'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control('theme_options[contact_address_1]',
			array(
				'label'    => __( 'Contact Address 1', OMNI_TXT_DOMAIN ),
				'section'  => 'site_info_panel',
				'type'     => 'text',
				'priority' => 100
			)
		);

		// Setting contact_address_2
		$wp_customize->add_setting('theme_options[contact_address_2]',
			array(
			'default'           => $this->default['contact_address_2'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control('theme_options[contact_address_2]',
			array(
				'label'    => __( 'Contact Address 2', OMNI_TXT_DOMAIN ),
				'section'  => 'site_info_panel',
				'type'     => 'text',
				'priority' => 100
			)
		);

		// Add Panel.
		$wp_customize->add_panel( 'theme_option_panel',
			array(
			  'title'      => __( 'Theme Options', OMNI_TXT_DOMAIN ),
			  'priority'   => 100,
			  'capability' => 'edit_theme_options',
			)
		);
	}

}
$omni_option = new OmniOption();