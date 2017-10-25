<?php


?>

<?php


global $post;
$post_id = $post->ID;
$section_light_box_group_id = '2-column-image-side';
$section_meta = get_post_meta($post_id);
$section_fields = array(
	'omni_section_side'             => 'omni_section_side',
	'omni_section_id'               => 'omni_section_id',
	'omni_section_content'               => 'omni_section_content',
	'omni_section_content_width'    => 'omni_section_content_width',
	'omni_section_header'           => 'omni_section_header',
	'omni_section_column_image'     => array(
		'height' => 605,
		'width'  => 415
	),
	'omni_section_link_text'        => 'omni_section_link_text',
	'omni_section_lookbook'         => 'omni_section_lookbook',
	'omni_section_intro_content'    => 'omni_section_intro_content'
);

$valid_section_meta = OmniCommon::omni_wp_theme_field_validation($post_id, $section_meta, $section_fields);

?>
<section id="<?php echo $valid_section_meta['omni_section_id'][0]; ?>" class="omni_2_column_image_side">
	<div class="<?php echo $valid_section_meta['omni_section_content_width'][0]; ?>">
		<div class="row">
			<?php if('right' == $valid_section_meta['omni_section_side'][0]) :  ?>
				<div class="col-6">
					<div class="omni_single_image_side">
						<div class="omni_single_image_side_inner_wrapper">
							<h5 class="omni_side_header"><?php echo $valid_section_meta['omni_section_header'][0]; ?></h5>
							<p class="omni_column_content omni_color_gray"><?php echo htmlspecialchars_decode($valid_section_meta['omni_section_content'][0]); ?></p>
							<a href="<?php echo $valid_section_meta['omni_section_lookbook'][0]; ?>" target="_blank" class="omni_btn_light"><?php echo $valid_section_meta['omni_section_link_text'][0]; ?></a>
						</div>
					</div>
				</div>
				<div class="col-1"></div>
				<div class="col-5">
					<div class="omni_single_image_side">
						<?php echo OmniCore::omni_wp_theme_return_responsive_image_set_with_lightbox($valid_section_meta['omni_section_column_image'][0], 'omni-column', $section_light_box_group_id); ?>
					</div>
				</div>
			<?php elseif ('left' == $valid_section_meta['omni_section_side'][0]) : ?>
				<div class="col-5">
					<div class="omni_single_image_side">
						<?php echo OmniCore::omni_wp_theme_return_responsive_image_set_with_lightbox($valid_section_meta['omni_section_column_image'][0], 'omni-column', $section_light_box_group_id); ?>
					</div>
				</div>
				<div class="col-1"></div>
				<div class="col-6">
					<div class="omni_single_image_side">
						<div class="omni_single_image_side_inner_wrapper">
							<h5 class="omni_side_header"><?php echo $valid_section_meta['omni_section_header'][0]; ?></h5>
							<p class="omni_column_content omni_color_gray"><?php echo htmlspecialchars_decode($valid_section_meta['omni_section_content'][0]); ?></p>
							<a href="<?php echo $valid_section_meta['omni_section_lookbook'][0]; ?>" target="_blank" class="omni_btn_light"><?php echo $valid_section_meta['omni_section_link_text'][0]; ?></a>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
