<?php

class OmniHeaderCustomHook {

	public function __construct() {
		add_action('omni_wp_theme_action_before', array($this, 'omni_wp_theme_skip_to_content'), 15);
		add_action('omni_wp_theme_action_before_header', array($this, 'omni_wp_theme_header_top_content'), 5);
		add_action('omni_wp_theme_action_header', array($this, 'omni_wp_theme_header_branding'), 10);
		add_filter ( 'nav_menu_css_class', array($this, 'omni_wp_theme_social_menu_item_classes'), 10, 4 );
	}

	public function omni_wp_theme_skip_to_content() { ?>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', OMNI_TXT_DOMAIN ); ?></a>
	<?php }

	public function omni_wp_theme_header_top_content() {
			if (OmniCore::omni_wp_theme_get_option('fixed_header')) : ?>
                <div class="fixed-top">
            <?php endif;
		$show_ticker = OmniCore::omni_wp_theme_get_option('show_ticker');
		?>
		<?php if ( true === $show_ticker ) : ?>
			<?php $ticker_color = OmniCore::omni_wp_theme_get_option('ticker_color'); ?>

		<div class="tophead ticker<?php echo $ticker_color; ?>">
			<div class="container">
                <div class="top-news">
                    <div class="ticker" role="alert">
                        <span class="top-news-title">
                            <?php $ticker_title = OmniCore::omni_wp_theme_get_option( 'ticker_title' );  ?>
                            <?php echo ( ! empty( $ticker_title ) ) ? esc_html( $ticker_title ) : '&nbsp;'; ?>
                        </span>
                        <?php echo OmniCommon::omni_wp_theme_get_new_ticker_content(); ?>
                    </div>
                </div>
			</div>
		</div>
		<?php endif; ?>
	<?php }

	public function omni_wp_theme_social_menu_item_classes($classes, $item, $args) {
	    if($args->menu->slug === 'social-media-menu') {
		    $classes[] = 'social-link-item';
        }
	    return $classes;
    }

	public function omni_wp_theme_header_branding() {
        $menu_alignment = OmniCore::omni_wp_theme_get_option('primary_menu_alignment');
        switch ($menu_alignment) {
            case 'under':
                $this->omni_wp_theme_under_menu_branding();
                break;
	        case 'inline':
		        $this->omni_wp_theme_inline_menu_branding();
		        break;
        }
    }


    public function omni_wp_theme_inline_menu_branding() { ?>
        <div class="om-menu-wrapper">
            <div class="<?php echo OmniCore::omni_wp_theme_get_option('branding_bg_width'); ?> <?php echo
            OmniCore::omni_wp_theme_echo_no_gutters('branding_bg_width') ?>">
                <nav class="navbar navbar-expand-md navbar-dark bg<?php echo OmniCore::omni_wp_theme_get_option('branding_bg_color_select'); ?>" <?php echo OmniCore::omni_wp_theme_branding_image_or_color(); ?> >
                    <div class="<?php echo OmniCore::omni_wp_theme_get_option('branding_header_width'); ?> <?php echo
	                OmniCore::omni_wp_theme_echo_no_gutters('branding_header_width') ?>">
	                <?php if(!has_custom_logo()) { ?>
                        <a class="navbar-brand" href="/"><h1><?php bloginfo('name'); ?></h1></a>
	                <?php } else { ?>
		                <?php the_custom_logo(); ?>
	                <?php } ?>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
				    <?php
				    wp_nav_menu(
					    array(
						    'theme_location'	=> 'primary',
						    'depth'				=> 2,
						    'container'			=> 'div',
						    'container_class'	=> 'collapse navbar-collapse',
						    'container_id'		=> 'navbarSupportedContent',
						    'menu_class'		=> 'navbar-nav mr-auto',
						    'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
						    'walker'			=> new WP_Bootstrap_Navwalker()
					    )
				    );
				    ?>
                    </div>
                </nav>

            </div>
        </div>
    <?php }

	public function omni_wp_theme_top_menu_branding() {

	}

	public function omni_wp_theme_under_menu_branding() { ?>
        <div class="branding-wrapper">
            <div class="container">
                <div class="site-branding">
					<?php if(!has_custom_logo()) { ?>
                        <a class="navbar-brand" href="/"><h1><?php bloginfo('name'); ?></h1></a>
					<?php } else { ?>
						<?php the_custom_logo(); ?>
					<?php } ?>
                </div>
				<?php if ( true === OmniCore::omni_wp_theme_get_option( 'show_social_in_header' )  ) : ?>
                    <div class="social-navigation header">
						<?php the_widget( 'OmniSocialWidget' ); ?>
                    </div>
				<?php endif; ?>
            </div>
        </div>

        <div class="om-menu-wrapper">
            <div class="<?php echo OmniCore::omni_wp_theme_get_option('primary_menu_width') ?>">
                <nav class="navbar navbar-expand-md navbar-light bg-light">
                    <a class="navbar-brand d-block d-md-none" href="#">Logo</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
					<?php
					wp_nav_menu(
						array(
							'theme_location'	=> 'primary',
							'depth'				=> 2,
							'container'			=> 'div',
							'container_class'	=> 'collapse navbar-collapse',
							'container_id'		=> 'navbarSupportedContent',
							'menu_class'		=> 'navbar-nav mr-auto',
							'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
							'walker'			=> new WP_Bootstrap_Navwalker()
						)
					);
					?>
                </nav>

            </div>
        </div>
	<?php }
}
$omni_custom_hook = new OmniHeaderCustomHook();