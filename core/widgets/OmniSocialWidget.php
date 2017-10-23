<?php

class OmniSocialWidget extends OmniWidgetBase {

	public function __construct() {
		$opts = array(
			'classname'                   => 'omni_wp_theme_widget_social',
			'description'                 => __( 'Displays social icons.', OMNI_TXT_DOMAIN ),
			'customize_selective_refresh' => true,
		);
		$fields = array(
			'title' => array(
				'label' => __( 'Title:', OMNI_TXT_DOMAIN ),
				'type'  => 'text',
				'class' => 'widefat',
			),
		);

		if ( false === has_nav_menu( 'social' ) ) {
			$fields['message'] = array(
				'label' => __( 'Social menu is not set. Please create menu and assign it to Social Menu.', OMNI_TXT_DOMAIN ),
				'type'  => 'message',
				'class' => 'widefat',
			);
		}

		parent::__construct( 'omni-wp-theme-social', __( 'Social Icons', OMNI_TXT_DOMAIN ), $opts, array(), $fields );

	}

	function widget( $args, $instance ) {

		$params = $this->get_params( $instance );

		echo $args['before_widget'];

		if ( ! empty( $params['title'] ) ) {
			echo $args['before_title'] . $params['title'] . $args['after_title'];
		}

		if ( has_nav_menu( 'social' ) ) {
			wp_nav_menu(
				array(
					'menu_class' => 'social-link-list',
					'theme_location' => 'social',
					'container'      => false,
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				)
			);
		}

		echo $args['after_widget'];

	}

}