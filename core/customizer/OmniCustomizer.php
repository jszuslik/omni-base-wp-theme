<?php

class OmniCustomizer {

	public function __construct() {
		add_action( 'customize_register', array($this, 'omni_customize_register') );
		add_action( 'customize_controls_enqueue_scripts', array($this, 'omni_wp_theme_customize_controls_register_scripts'), 0 );
		add_filter('upload_mimes', array($this, 'omni_wp_theme_cc_mime_types') );
	}

	public function omni_customize_register( $wp_customize ) {

		// Load custom controls.
		omni_require_file(OMNI_CORE_PATH . 'customizer/control/OmniControl.php');
		$wp_customize->register_control_type( 'Omni_Heading_Control' );
		$wp_customize->register_control_type( 'Omni_Dropdown_Taxonomies_Control' );
		$wp_customize->register_control_type( 'Omni_Header_Padding_Control' );
		$wp_customize->register_control_type( 'Omni_Homepage_Section_Background_Color_Control' );
		$wp_customize->register_control_type( 'Omni_Homepage_Section_Background_Image_Control' );
		$wp_customize->register_control_type( 'Omni_Homepage_Section_Manager_Control' );


		// Load customize sanitize
		omni_require_file(OMNI_CORE_PATH . 'customizer/sanitize/OmniSanitize.php');

		// Load customize callback
		omni_require_file(OMNI_CORE_PATH . 'customizer/callback/OmniCallback.php');

		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

		// Load customize option
		omni_require_file(OMNI_CORE_PATH . 'customizer/option/OmniOption.php');
		omni_require_file(OMNI_CORE_PATH . 'customizer/option/header/OmniHeaderOption.php');
		omni_require_file(OMNI_CORE_PATH . 'customizer/option/footer/OmniFooterOption.php');
		omni_require_file(OMNI_CORE_PATH . 'customizer/option/homepage/OmniHomepageOption.php');
		omni_require_file(OMNI_CORE_PATH . 'customizer/option/homepage/jumbotron/OmniJumbotronOption.php');

	}

	function omni_wp_theme_customize_controls_register_scripts() {

		// $min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_register_script( 'omni-wp-theme-customize-controls', get_template_directory_uri() . '/assets/js/customize-controls.js', array( 'jquery', 'customize-controls', 'jquery-ui-core', 'jquery-ui-sortable' ), '1.0.0', true );
		wp_register_style( 'omni-wp-theme-css-customize-controls', get_template_directory_uri() . '/assets/css/customize-controls.css' );

	}

	public function omni_wp_theme_cc_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}


}
$omni_customizer = new OmniCustomizer();