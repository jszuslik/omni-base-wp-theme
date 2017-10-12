<?php

if ( function_exists('omni_require_file') ) {

	/**
	 * Load Classes
	 */
	omni_require_file( OMNI_CORE_PATH . 'OmniSetup.php');
	omni_require_file( OMNI_CORE_PATH . 'bootstrap-navigation/WP_Bootstrap_Navwalker.php');
	omni_require_file( OMNI_CORE_PATH . 'customizer/default/OmniDefault.php');
	omni_require_file( OMNI_CORE_PATH . 'customizer/OmniCustomizer.php');
	omni_require_file( OMNI_CORE_PATH . 'OmniCore.php');
	omni_require_file(OMNI_CORE_PATH . 'widgets/OmniWidgetInit.php');
	omni_require_file( OMNI_CORE_PATH . 'common/OmniCommon.php');

	// Custom hooks
	omni_require_file( OMNI_CORE_PATH . 'hook/OmniCustomHook.php');
	omni_require_file( OMNI_CORE_PATH . 'hook/OmniStructureHook.php');
}