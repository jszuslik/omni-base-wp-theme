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
		// Primary Menu Alignment
		$wp_customize->add_setting( 'theme_options[footer_menu_alignment]',
			array(
				'default'     => $this->default['footer_menu_alignment'],
				'capability'  => 'edit_theme_options',
				'sanitize_callback' => array('OmniSanitize', 'omni_wp_theme_sanitize_select')
			)
		);
		$wp_customize->add_control( 'theme_options[footer_menu_alignment]',
			array(
				'label'    => __( 'Primary Menu Alignment', OMNI_TXT_DOMAIN ),
				'section'  => 'section_footer',
				'type'     => 'select',
				'choices'  => OmniOptions::omni_wp_theme_get_primary_menu_alignment_options(),
				'priority' => 100
			)
		);
	}

}
$omni_footer_option = new OmniFooterOption();