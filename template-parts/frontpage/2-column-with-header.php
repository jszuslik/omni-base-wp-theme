<?php


?>
<?php


	global $post;
	$post_id = $post->ID;
	$section_light_box_group_id = '2-column-w-header-lightbox-group';
	$section_meta = get_post_meta($post_id);
	$section_fields = array(
        'omni_section_id'               => 'omni_section_id',
		'omni_section_content_width'    => 'omni_section_content_width',
		'omni_section_background_image' => array(
                                            'height' => 299,
                                            'width'  => 1900
                                        ),
		'omni_section_header'           => 'omni_section_header',
		'omni_section_column_image'     => array(
                                            'height' => 811,
                                            'width'  => 540
                                        ),
		'omni_section_small_header'     => 'omni_section_small_header',
		'omni_section_large_header'     => 'omni_section_large_header',
		'omni_section_link_text'        => 'omni_section_link_text',
		'omni_section_lookbook'         => 'omni_section_lookbook',
		'omni_section_intro_headline'   => 'omni_section_intro_headline',
		'omni_section_intro_content'    => 'omni_section_intro_content'
    );
    $valid_section_meta = OmniCommon::omni_wp_theme_field_validation($post_id, $section_meta, $section_fields);

    $section_bg_image_url = wp_get_attachment_image_src(OmniCore::omni_wp_theme_get_image_id_by_url($valid_section_meta['omni_section_background_image'][0]), '2-column-with-header-bg');

	$section_header = $valid_section_meta['omni_section_header'][0];
	$section_header_array = explode(' ', $section_header);
    $section_head = '';
	for ( $i = 0; $i < count($section_header_array); $i++) {
	    if ($i == 0) {
	        $section_head .= '<span class="section-header-start">' . $section_header_array[$i] . '</span> ';
        } else {
	        $section_head .= $section_header_array[$i] . ' ';
        }
    }


?>
<section id="<?php echo $valid_section_meta['omni_section_id'][0]; ?>" class="omni_2_column_w_header_bg"
         style="background-image: url('<?php echo $section_bg_image_url[0]; ?>')">
	<div class="<?php echo $valid_section_meta['omni_section_content_width'][0]; ?>">
		<div class="row">
			<div class="col-12">
				<h2 class="omni_2_column_w_header_header omni_color_white"><?php echo $section_head; ?></h2>
			</div>
			<div class="col-5">
				<div class="column-image-wrapper">
					<?php echo OmniCore::omni_wp_theme_return_responsive_image_set_with_lightbox($valid_section_meta['omni_section_column_image'][0], '2-column-with-header-column', $section_light_box_group_id, 'auto', 'auto', false); ?>
                </div>
			</div>
			<div class="col-7">
				<div class="section-2-column-w-header-top-content">
                    <h5 class="omni_column_header_small omni_color_white">
	                    <?php echo $valid_section_meta['omni_section_small_header'][0]; ?>
                    </h5>
                    <h3 class="omni_column_title omni_color_white">
	                    <?php echo $valid_section_meta['omni_section_large_header'][0]; ?>
                    </h3>
                    <h6>
                        <a class="omni_color_white" href="<?php echo $valid_section_meta['omni_section_lookbook'][0]; ?>" target="_blank">
                            <span>
                                <?php echo $valid_section_meta['omni_section_link_text'][0]; ?>
                            </span>
                        </a>
                    </h6>
                </div>
                <div class="section-2-column-w-header-bottom-content">
                    <h5 class="omni_column_header_small"><?php echo $valid_section_meta['omni_section_intro_headline'][0]; ?></h5>
                    <p class="omni_column_content omni_color_gray"><?php echo $valid_section_meta['omni_section_intro_content'][0]; ?></p>
                </div>
			</div>
		</div>
	</div>
</section>
