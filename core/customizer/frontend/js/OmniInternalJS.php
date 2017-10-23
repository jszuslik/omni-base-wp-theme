<?php

class OmniInternalJS {

	private $defaults;

	public function __construct() {
		if(OmniCore::omni_wp_theme_get_option('show_ticker')) {
			add_action( 'wp_footer', array($this, 'omni_wp_theme_enable_news_slider') );
		}
	}


	public function omni_wp_theme_enable_news_slider() { ?>
		<script type="text/javascript">
			jQuery(document).ready( function($) {
                $('.news-ticker-inner-wrap').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    fade: true,
                    cssEase: 'linear',
	                arrows: false
                });
			});
		</script>
	<?php }
}
$omni_internal_js = new OmniInternalJS();