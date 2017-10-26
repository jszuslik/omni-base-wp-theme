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

            <?php
                $header_padding_top = OmniCore::omni_wp_theme_get_option('branding_pad_top');
                $header_padding_right = OmniCore::omni_wp_theme_get_option('branding_pad_right');
                $header_padding_bottom = OmniCore::omni_wp_theme_get_option('branding_pad_bottom');
                $header_padding_left = OmniCore::omni_wp_theme_get_option('branding_pad_left');
            ?>
            @media (min-width: 768px) {
                .navbar {
                    padding: <?php echo $header_padding_top . 'px ' . $header_padding_right . 'px ' .
                                        $header_padding_bottom . 'px ' . $header_padding_left . 'px'; ?>;
                }
            }
		</style>
	<?php }

}
$omni_internal_css = new OmniInternalCSS();