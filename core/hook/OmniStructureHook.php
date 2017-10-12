<?php

class OmniStructureHook {

	public function __construct() {
		add_action('omni_wp_theme_action_doctype', array($this, 'omni_wp_theme_doctype'), 10 );
		add_action('omni_wp_theme_action_head', array($this, 'omni_wp_theme_head'), 10);
		add_action('omni_wp_theme_action_before', array($this, 'omni_wp_theme_page_start'), 10);
		add_action('omni_wp_theme_action_after', array($this, 'omni_wp_theme_page_end'), 10);
		add_action('omni_wp_theme_action_before_header', array($this, 'omni_wp_theme_header_start'), 10);
		add_action('omni_wp_theme_action_after_header', array($this, 'omni_wp_theme_header_end'), 10);
	}

	public function omni_wp_theme_doctype() {
		?> <!DOCTYPE HTML> <html <?php language_attributes(); ?>><?php
	}

	public function omni_wp_theme_head() { ?>
		<meta charset="<?php bloginfo( 'charset' ); ?>"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
<?php
	}

	public function omni_wp_theme_page_start() { ?>
		<div id="page" class="hfeed site">
	<?php }

	public function omni_wp_theme_page_end() { ?>
		</div>
	<?php }

	public function omni_wp_theme_header_start() { ?>
		<header id="masthead" class="site-header" role="banner">
			<div class="container">
	<?php }

	public function omni_wp_theme_header_end() { ?>
			</div><!-- .container -->
		</header><!-- #masthead -->
	<?php }

}
$omni_structure_hook = new OmniStructureHook();