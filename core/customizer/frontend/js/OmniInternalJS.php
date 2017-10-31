<?php

class OmniInternalJS {

	private $defaults;

	public function __construct() {
		if(OmniCore::omni_wp_theme_get_option('show_ticker')) {
			add_action( 'wp_footer', array($this, 'omni_wp_theme_enable_news_slider') );
		}
		if(OmniCore::omni_wp_theme_get_option('fixed_header')) {
			add_action( 'wp_footer', array($this, 'omni_wp_theme_enable_shrink_header') );
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

	public function omni_wp_theme_enable_shrink_header() { ?>
        <script type="text/javascript">
            jQuery(document).on("scroll", function(){
                if
                (jQuery(document).scrollTop() > 100){
                    jQuery(".navbar").addClass("shrink");
                }
                else
                {
                    jQuery(".navbar").removeClass("shrink");
                }
            });
        </script>

    <?php }
}
$omni_internal_js = new OmniInternalJS();