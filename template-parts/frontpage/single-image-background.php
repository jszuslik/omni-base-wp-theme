<?php

?>
<?php


global $post;
$post_id = $post->ID;
$section_meta = get_post_meta($post_id);
$section_fields = array(
	'omni_section_id'               => 'omni_section_id',
	'omni_section_content_width'    => 'omni_section_content_width',
	'omni_section_background_image' => array(
		'height' => 999,
		'width'  => 1900
	),
	'omni_section_header'           => 'omni_section_header',
	'omni_section_sub_header'           => 'omni_section_sub_header',
	'omni_section_content'           => 'omni_section_content',
);
 $valid_section_meta = OmniCommon::omni_wp_theme_field_validation($post_id, $section_meta, $section_fields);
 $responsive_bg_set = OmniCore::omni_wp_theme_return_responsive_image_set($valid_section_meta['omni_section_background_image'][0], 'omni-single-bg');
?>
<section id="<?php echo $valid_section_meta['omni_section_id'][0]; ?>" class="omni_full_width_image_section">
	<div class="<?php echo $valid_section_meta['omni_section_content_width'][0]; ?>">
        <div class="omni-single-image-wrapper">
			<?php echo $responsive_bg_set; ?>
        </div>
    </div>
    <div class="omni-single-content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="omni-single-content-outer-wrap">
                        <div class="omni-single-content-inner-wrap">
                            <h5 class="omni_single_header_small omni_color_white"><?php echo $valid_section_meta['omni_section_sub_header'][0]; ?></h5>
                            <h3 class="omni_single_title omni_color_white"><?php echo $valid_section_meta['omni_section_header'][0]; ?></h3>
                            <h5 class="omni_single_content omni_color_white"><?php echo $valid_section_meta['omni_section_content'][0]; ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</section>