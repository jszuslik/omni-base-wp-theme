<?php

if ( function_exists('omni_require_file') ) {

	omni_require_file(OMNI_CORE_PATH . 'widgets/OmniWidgetBase.php');
	omni_require_file(OMNI_CORE_PATH . 'widgets/OmniSocialWidget.php');

}

class OmniWidgetInit {

	public function __construct() {
		add_action( 'widgets_init', array($this, 'omni_wp_theme_load_widgets') );
	}

	public function omni_wp_theme_load_widgets() {
		register_widget( 'OmniSocialWidget');
	}
}
$omni_widget_init = new OmniWidgetInit();