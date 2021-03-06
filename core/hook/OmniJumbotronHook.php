<?php

class OmniJumbotronHook {

	public function __construct() {
		add_action('omni_wp_theme_action_before_homepage_sections', array($this, 'omni_wp_theme_display_jumbotron_if_enabled'));
	}

	public function omni_wp_theme_display_jumbotron_if_enabled() {
		$is_enabled = OmniCore::omni_wp_theme_get_option('jumbotron_switch');
		$jumbotron_type = OmniCore::omni_wp_theme_get_option('jumbotron_type');
		if($is_enabled) {
			switch($jumbotron_type) {
				case 'image':
					self::omni_wp_theme_display_image_jumbotron();
					break;
				case 'video':
					self::omni_wp_theme_display_video_jumbotron();
					break;
			}
		}
	}

	public function omni_wp_theme_display_image_jumbotron() {
		$image = OmniCore::omni_wp_theme_get_option('jumbotron_bg_image_upload');
		if($image) {
			$responsive_set = OmniCore::omni_wp_theme_return_responsive_image_set($image, 'omni-jumbotron');
        } else {
			$responsive_set = 'No Image';
        }

		$jumbotron_header = OmniCore::omni_wp_theme_get_option('jumbotron_header');
		$jumbotron_sub_header = OmniCore::omni_wp_theme_get_option('jumbotron_sub_header');
		$jumbotron_content = OmniCore::omni_wp_theme_get_option('jumbotron_content');
		?>
		<div class="jumbotron">
			<div class="jumbotron-image-wrapper">
				<?php echo $responsive_set; ?>
			</div>
			<div class="jumbotron-content-wrapper">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-4">
							<div class="jumbo-content-outer-wrapper">
								<div class="jumbo-content-inner-wrapper">
									<h2 class="jumbotron-header omni_color_white"><?php echo $jumbotron_header; ?></h2>
									<h3 class="jumbotron-sub-header omni_color_white"><?php echo $jumbotron_sub_header; ?></h3>
									<p class="jumbotron-content omni_color_gray"><?php echo $jumbotron_content; ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php }

	public function omni_wp_theme_display_video_jumbotron() {
	    $jumbotron_mp4 = OmniCore::omni_wp_theme_get_option('jumbotron_mp4_upload');
		$jumbotron_ogg = OmniCore::omni_wp_theme_get_option('jumbotron_ogg_upload');
		$jumbotron_image_callback = OmniCore::omni_wp_theme_get_option('jumbotron_img_cback_upload');
		if($jumbotron_image_callback) {
			$responsive_set = OmniCore::omni_wp_theme_return_responsive_image_set($jumbotron_image_callback, 'omni-jumbotron');
		} else {
			$responsive_set = 'No Image';
		}
		$jumbotron_header = OmniCore::omni_wp_theme_get_option('jumbotron_header');
		$jumbotron_sub_header = OmniCore::omni_wp_theme_get_option('jumbotron_sub_header');
		$jumbotron_content = OmniCore::omni_wp_theme_get_option('jumbotron_content');

	    ?>
        <div class="jumbotron">
            <div class="jumbotron-video-wrapper">
                <video class="video-background" preload="" muted="" autoplay="" loop="">
                    <source src="<?php echo wp_get_attachment_url($jumbotron_mp4); ?>" type="video/mp4">
                    <source src="<?php echo wp_get_attachment_url($jumbotron_ogg); ?>" type="video/ogg">
	                <?php echo $responsive_set; ?>
                </video>
            </div>
            <div class="jumbotron-content-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4">
                            <div class="jumbo-content-outer-wrapper">
                                <div class="jumbo-content-inner-wrapper">
                                    <h2 class="jumbotron-header omni_color_white"><?php echo $jumbotron_header; ?></h2>
                                    <h3 class="jumbotron-sub-header omni_color_white"><?php echo $jumbotron_sub_header; ?></h3>
                                    <p class="jumbotron-content omni_color_gray"><?php echo $jumbotron_content; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php }

}
$omni_jumbotron_hook = new OmniJumbotronHook();