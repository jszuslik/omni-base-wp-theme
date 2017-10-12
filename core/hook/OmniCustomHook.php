<?php

class OmniCustomHook {

	public function __construct() {
		add_action('omni_wp_theme_action_before', array($this, 'omni_wp_theme_skip_to_content'), 15);
		add_action('omni_wp_theme_action_before_header', array($this, 'omni_wp_theme_header_top_content'), 5);
	}

	public function omni_wp_theme_skip_to_content() { ?>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', OMNI_TXT_DOMAIN ); ?></a>
	<?php }

	public function omni_wp_theme_header_top_content() {
		$show_ticker = OmniCore::omni_wp_theme_get_option('show_ticker'); ?>
		<div class="tophead">
			<div class="container">
				<?php if ( true === $show_ticker ) : ?>
					<div class="top-news">
						<span class="top-news-title">
							<?php $ticker_title = OmniCore::omni_wp_theme_get_option( 'ticker_title' );  ?>
							<?php echo ( ! empty( $ticker_title ) ) ? esc_html( $ticker_title ) : '&nbsp;'; ?>
						</span>
						<?php echo OmniCommon::omni_wp_theme_get_new_ticker_content(); ?>
					</div>
				<?php endif; ?>

				

			</div>
		</div>
	<?php }
}
$omni_custom_hook = new OmniCustomHook();