<?php

class OmniSetup {

	private $production;

	public function __construct() {
		$this->production = false;

		add_action('after_setup_theme', array($this, 'omni_theme_setup'));
		add_action( 'wp_head', array($this, 'omni_javascript_detection'), 0 );
		add_action( 'wp_enqueue_scripts', array($this, 'omni_scripts') );
		add_filter( 'get_custom_logo', array($this, 'omni_wp_theme_change_logo_class') );
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

		add_theme_support( 'customize-selective-refresh-widgets' );

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
		add_image_size('2-column-with-header-bg', 1900);
		add_image_size('2-column-with-header-column', 540, 811);
		add_image_size('omni-jumbotron', 1900);
		add_image_size('omni-banner', 1900);
		add_image_size('omni-column', 170, 400);
		add_image_size('omni-single-bg', 1900, 999);
		add_image_size('omni-single-column', 415, 605);
		add_image_size('omni-row-image', 480, 335);

		add_filter( 'meta_content', 'wptexturize'        );
		add_filter( 'meta_content', 'convert_smilies'    );
		add_filter( 'meta_content', 'convert_chars'      );
		add_filter( 'meta_content', 'wpautop'            );
		add_filter( 'meta_content', 'shortcode_unautop'  );
		add_filter( 'meta_content', 'prepend_attachment' );
		add_filter( 'meta_content', 'do_shortcode');

		// Add theme support for Custom Logo.
		add_theme_support( 'custom-logo', array(
			'size' => 'omni-logo',
			'flex-width' => true,
			'flex-height' => true
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

		// Enable support for footer widgets.
		add_theme_support( 'footer-widgets', 4 );

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
		if ($this->production) {
			wp_enqueue_script('omni-script', get_template_directory_uri() . '/assets/js/scripts.min.js', array('jquery'), false, false);
		} else {
			wp_enqueue_script('omni-script', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), false, true);
		}
		wp_enqueue_style('omni-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,700,700i|Roboto:400,400i,500,500i,700,700i');

	}

	public function omni_wp_theme_change_logo_class( $html ) {

		$html = str_replace( 'custom-logo', 'omni-custom-logo-style-svg', $html );
		$html = str_replace( 'custom-logo-link', 'omni-custom-logo-style-svg', $html );

		return $html;
	}

}
$omni_setup = new OmniSetup();