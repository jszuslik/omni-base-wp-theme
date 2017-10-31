<?php

class OmniInternalCSS {

	public function __construct() {
		add_action( 'wp_head', array( $this, 'omni_wp_theme_add_styles'));
	}

	public function omni_wp_theme_add_styles() { ?>
		<style>
			<?php if (OmniCore::omni_wp_theme_get_option('branding_link_color')) { ?>
			.navbar-dark .navbar-nav .nav-link {
				color: <?php echo OmniCore::omni_wp_theme_get_option('branding_link_color'); ?>;
			}
			<?php } ?>
		</style>
	<?php }

}
$omni_internal_css = new OmniInternalCSS();