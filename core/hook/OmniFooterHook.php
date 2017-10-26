<?php
class OmniFooterHook {

	public function __construct() {
		add_action('omni_wp_theme_action_footer', array($this, 'omni_wp_theme_footer'), 10);
		add_filter ( 'nav_menu_css_class', array($this, 'omni_wp_theme_footer_menu_item_classes'), 10, 4 );
	}

	public function omni_wp_theme_footer()  { ?>
		<footer>
			<div class="<?php echo OmniCore::omni_wp_theme_get_option('footer_bg_width'); ?> <?php echo OmniCore::omni_wp_theme_echo_no_gutters('footer_bg_width') ?>">
				<div class="omni_footer_wrapper bg<?php echo OmniCore::omni_wp_theme_get_option('footer_bg_color_select'); ?>" <?php echo OmniCore::omni_wp_theme_footer_image_or_color(); ?>>
					<div class="<?php echo OmniCore::omni_wp_theme_get_option('footer_content_width'); ?> <?php echo OmniCore::omni_wp_theme_echo_no_gutters('footer_content_width') ?>">
						<?php
							wp_nav_menu(
								array(
									'theme_location'    => 'footer',
									'depth'             => 1,
									'container'         => 'div',
									'container_class'   => 'omni_footer_menu_container',
									'menu_class'        => 'omni_footer_menu'
								)
							);
						?>
						<?php if ( true === OmniCore::omni_wp_theme_get_option( 'show_social_in_footer' )  ) : ?>
                            <div class="social-navigation footer">
								<?php the_widget( 'OmniSocialWidget' ); ?>
                            </div>
						<?php endif; ?>
					</div>
		<?php if ( '' != OmniCore::omni_wp_theme_get_option( 'footer_copyright' )  ) : ?>
                    <div class="omni_copyright_wrapper">
                        <p class="omni_copyright omni_color_gray">&copy; <?php echo date("Y"); ?> <?php echo OmniCore::omni_wp_theme_get_option('footer_copyright') ?></p>
                    </div>
		<?php endif; ?>
				</div>
			</div>
		</footer>
	<?php }

	public function omni_wp_theme_footer_menu_item_classes($classes, $item, $args) {
		if($args->menu->slug === 'footer-menu') {
			$classes[] = 'omni_footer_link_item';
		}
		return $classes;
	}

}
$omni_footer_hook = new OmniFooterHook();