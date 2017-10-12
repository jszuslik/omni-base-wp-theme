<?php

class OmniCustomizer {

	public function __construct() {
		add_action( 'customize_register', array($this, 'omni_customize_register') );
	}

	public function omni_customize_register( $wp_customize ) {

		// Load custom controls.
		omni_require_file(OMNI_CORE_PATH . 'customizer/control/OmniControl.php');
		$wp_customize->register_control_type( 'Omni_Heading_Control' );

		// Load customize options
		omni_require_file(OMNI_CORE_PATH . 'options/OmniOptions.php');

		// Load customize sanitize
		omni_require_file(OMNI_CORE_PATH . 'customizer/sanitize/OmniSanitize.php');

		// Load customize callback
		omni_require_file(OMNI_CORE_PATH . 'customizer/callback/OmniCallback.php');

		$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

		// Load customize option
		omni_require_file(OMNI_CORE_PATH . 'customizer/option/OmniOption.php');

	}

}
$omni_customizer = new OmniCustomizer();