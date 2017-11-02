<?php

class OmniWidgetInit {

	public function __construct() {
		add_action( 'widgets_init', array($this, 'omni_wp_theme_widgets_init') );
		add_action( 'widgets_init', array($this, 'omni_wp_theme_load_widgets') );
	}

	public function omni_wp_theme_load_widgets() {
		register_widget( 'OmniSocialWidget');
	}

	public function omni_wp_theme_widgets_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Primary Sidebar', OMNI_TXT_DOMAIN ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here to appear in your Primary Sidebar.', OMNI_TXT_DOMAIN ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
}
$omni_widget_init = new OmniWidgetInit();