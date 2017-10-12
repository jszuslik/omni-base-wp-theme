<?php

class OmniSetup {
	public function __construct() {
		add_action('after_setup_theme', array($this, 'omni_theme_setup'));
		add_action( 'wp_head', array($this, 'omni_javascript_detection'), 0 );
		add_action( 'wp_enqueue_scripts', array($this, 'omni_scripts') );
	}

	public function omni_theme_setup() {
		/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
		load_theme_textdomain( OMNI_TXT_DOMAIN );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_image_size('omni-logo', 250, 250);

		// Add theme support for Custom Logo.
		add_theme_support( 'custom-logo', array(
			'size' => 'omni-logo',
			'flex-width' => true
		) );

		register_nav_menus(
			array(
				'primary' => __('Primary Menu', OMNI_TXT_DOMAIN),
				'footer' => __('Footer Menu', OMNI_TXT_DOMAIN),
				'social' => __('Social Media Menu', OMNI_TXT_DOMAIN),
			)
		);

		$starter_content = array(
			'nav_menus' => array(
				'primary' => array(
					'name' => __('Primary Menu', OMNI_TXT_DOMAIN),
					'items' => array(
						'link_home'
					),
				),
				'footer' => array(
					'name' => __('Footer Menu', OMNI_TXT_DOMAIN),
					'items' => array(
						'link_home'
					),
				),
				'social' => array(
					'name' => __('Social Media Menu', OMNI_TXT_DOMAIN),
					'items' => array(
						'link_facebook',
						'link_twitter',
						'link_pinterest',
						'link_instagram',
						'link_houzz'
					)
				)
			)
		);

		$starter_content = apply_filters( 'omni-wp-theme_starter_content', $starter_content );

		add_theme_support( 'starter-content', $starter_content );

	}

	/**
	 * Handles JavaScript detection.
	 *
	 * Adds a `js` class to the root `<html>` element when JavaScript is detected
	 *
	 */
	public function omni_javascript_detection() {
		echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function omni_scripts() {
		wp_enqueue_style( 'omni-style', get_stylesheet_uri() );

		wp_enqueue_script('omni-script', get_template_directory_uri() . '/assets/js/scripts.min.js', array('jquery'), false, true);
	}

}
$omni_setup = new OmniSetup();