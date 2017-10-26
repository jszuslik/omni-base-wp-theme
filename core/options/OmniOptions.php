<?php


class OmniOptions {
	
	public static function omni_theme_get_global_layout_options() {
		
		$choices = array(
			'left-sidebar'            => __( 'Primary Sidebar - Content', OMNI_TXT_DOMAIN ),
			'right-sidebar'           => __( 'Content - Primary Sidebar', OMNI_TXT_DOMAIN ),
			'three-columns'           => __( 'Three Columns ( Secondary - Content - Primary )', OMNI_TXT_DOMAIN ),
			'three-columns-pcs'       => __( 'Three Columns ( Primary - Content - Secondary )', OMNI_TXT_DOMAIN ),
			'three-columns-cps'       => __( 'Three Columns ( Content - Primary - Secondary )', OMNI_TXT_DOMAIN ),
			'three-columns-psc'       => __( 'Three Columns ( Primary - Secondary - Content )', OMNI_TXT_DOMAIN ),
			'three-columns-pcs-equal' => __( 'Three Columns ( Equal Primary - Content - Secondary )', OMNI_TXT_DOMAIN ),
			'three-columns-scp-equal' => __( 'Three Columns ( Equal Secondary - Content - Primary )', OMNI_TXT_DOMAIN ),
			'no-sidebar'              => __( 'No Sidebar', OMNI_TXT_DOMAIN ),
		);

		$output = apply_filters('omni_theme_filter_layout_options', $choices);
		return $output;
		
	}

	public static function omni_wp_theme_get_bs_color_options() {

		$choices = array(
			'-primary'       => __( 'Primary', OMNI_TXT_DOMAIN ),
			'-secondary'     => __('Secondary', OMNI_TXT_DOMAIN ),
			'-success'       => __('Success', OMNI_TXT_DOMAIN ),
			'-danger'        => __('Danger', OMNI_TXT_DOMAIN ),
			'-warning'       => __('Warning', OMNI_TXT_DOMAIN ),
			'-info'          => __('Info', OMNI_TXT_DOMAIN ),
			'-light'         => __('Light', OMNI_TXT_DOMAIN ),
			'-dark'          => __('Dark', OMNI_TXT_DOMAIN ),
		);

		$output = apply_filters('omni_theme_filter_ticker_color_options', $choices);
		return $output;

	}

	public static function omni_wp_theme_get_primary_menu_alignment_options() {

		$choices = array(
			'under'       => __('Menu Under Branding', OMNI_TXT_DOMAIN),
			'inline'      => __('Menu Inline With Branding', OMNI_TXT_DOMAIN),
			'top'         => __('Menu Above Branding', OMNI_TXT_DOMAIN)
		);

		$output = apply_filters('omni_theme_filter_menu_alignment_options', $choices);
		return $output;

	}

	public static function omni_wp_theme_get_primary_menu_width_options() {

		$choices = array(
			'container'          => __('Contained', OMNI_TXT_DOMAIN),
			'container-fluid'    => __('Full Width', OMNI_TXT_DOMAIN)
		);

		$output = apply_filters('omni_theme_filter_menu_width_options', $choices);
		return $output;
	}

	public static function omni_wp_theme_get_bg_color_options() {

		$choices = array(
			'-primary'       => __( 'Primary', OMNI_TXT_DOMAIN ),
			'-secondary'     => __('Secondary', OMNI_TXT_DOMAIN ),
			'-success'       => __('Success', OMNI_TXT_DOMAIN ),
			'-danger'        => __('Danger', OMNI_TXT_DOMAIN ),
			'-warning'       => __('Warning', OMNI_TXT_DOMAIN ),
			'-info'          => __('Info', OMNI_TXT_DOMAIN ),
			'-light'         => __('Light', OMNI_TXT_DOMAIN ),
			'-dark'          => __('Dark', OMNI_TXT_DOMAIN ),
			'-custom-image'  => __('Image', OMNI_TXT_DOMAIN),
			'-custom-color'  => __('Custom Color', OMNI_TXT_DOMAIN)
		);

		$output = apply_filters('omni_theme_filter_bg_color_options', $choices);
		return $output;

	}

	public static function omni_wp_theme_select_jumbotron_type_options() {

		$choices = array(
			'image'          => __( 'Image Background', OMNI_TXT_DOMAIN),
			'video'          => __( 'Video Background', OMNI_TXT_DOMAIN)
		);

		$output = apply_filters('omni_theme_filter_jumbotron_type_options', $choices);
		return $output;

	}

	public static function omni_wp_theme_get_home_sections_options() {

		$choices = array(
			'2-column-with-header' => array(
				'label'    => __( '2 Column With Header', OMNI_TXT_DOMAIN ),
				'template' => 'template-parts/frontpage/2-column-with-header',
			),
			'press-room' => array(
				'label'    => __( 'Press Room', OMNI_TXT_DOMAIN ),
				'template' => 'template-parts/frontpage/press-room',
			),
			'2-column-2-row-with-header' => array(
				'label'    => __( '2 Column 2 Row With Header', OMNI_TXT_DOMAIN ),
				'template' => 'template-parts/frontpage/2-column-2-row-with-header',
			),
			'2-column-no-header-image-side-1' => array(
				'label'    => __( '2 Column No Header Image Side', OMNI_TXT_DOMAIN ),
				'template' => 'template-parts/frontpage/2-column-no-header-image-side',
			),
			'2-column-no-header-image-side-2' => array(
				'label'    => __( '2 Column No Header Image Side', OMNI_TXT_DOMAIN ),
				'template' => 'template-parts/frontpage/2-column-no-header-image-side',
			),
			'single-image-background' => array(
				'label'    => __( 'Single Image Background', OMNI_TXT_DOMAIN ),
				'template' => 'template-parts/frontpage/single-image-background',
			),
			'2-column-product-section' => array(
				'label'    => __( '2 Column Product Section', OMNI_TXT_DOMAIN ),
				'template' => 'template-parts/frontpage/2-column-product-section',
			),
			'full-width-image-section' => array(
				'label'    => __( 'Full Width Image Section', OMNI_TXT_DOMAIN ),
				'template' => 'template-parts/frontpage/full-width-image-section',
			),
		);
		$output = apply_filters( 'omni_wp_theme_filter_home_sections_options', $choices );
		return $output;

	}

	public static function omni_wp_theme_get_home_section_posts() {

		$args = array(
			'posts_per_page'  => -1,
			'post_type'       => 'homepage_section',
			'orderby'         => 'menu_order',
			'order'           => 'ASC'
		);
		$posts = get_posts($args);
		// p($posts);

		$choices = array();

		foreach ($posts as $post) :

			$choices[$post->post_name] = array(
				'label'      => $post->post_title,
				'template'   => get_post_meta($post->ID, "_template_type", true),
				'menu_order' => $post->menu_order,
				'post_id'    => $post->ID
			);

		endforeach;

		$output = apply_filters( 'omni_wp_theme_filter_home_section_posts', $choices );
		// p($output);
		return $output;
	}
	public static function omni_wp_theme_get_alignment_options() {
		$choices = array(
			'left'    => __('Left', OMNI_TXT_DOMAIN),
			'right'   => __('Right', OMNI_TXT_DOMAIN)
		);

		$output = apply_filters('omni_wp_theme_filter_alignment_options', $choices);
		return $output;
	}
	public static function omni_wp_theme_enable_opt_in() {
		$choices = array(
			'enable'    => __('Enable Opt In', OMNI_TXT_DOMAIN)
		);
		$output = apply_filters('omni_wp_theme_filter_opt_in_options', $choices);
		return $output;
	}
	public static function omni_wp_theme_opt_in_options() {
		$choices = array(
			'zip'    => __('Zip Code Opt In', OMNI_TXT_DOMAIN),
			'email'  => __('Email Opt In', OMNI_TXT_DOMAIN)
		);
		$output = apply_filters('omni_wp_theme_filter_opt_in_options', $choices);
		return $output;
	}

}