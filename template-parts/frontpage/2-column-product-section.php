<?php


?>

<?php


global $post;
$post_id = $post->ID;
$section_light_box_group_id = '2-column-product-section-group';
$section_meta = get_post_meta($post_id);
$section_fields = array(
	'omni_section_id'               => 'omni_section_id',
	'omni_section_content_width'    => 'omni_section_content_width',
	'omni_section_header'           => 'omni_section_header',
	'omni_section_column_image'     => array(
	                                    'height' => 400,
                                        'width'  => 170
                                    ),
	'omni_section_content'          => 'omni_section_content'
);
$valid_section_meta = OmniCommon::omni_wp_theme_field_validation($post_id, $section_meta, $section_fields);

?>
<section id="<?php echo $valid_section_meta['omni_section_id'][0]; ?>" class="omni_2_column_product_section">
	<div class="<?php echo $valid_section_meta['omni_section_content_width'][0]; ?>">
		<div class="row">
			<div class="col-6">
				<div class="product-content-outer-wrapper">
					<div class="product-content-inner-wrapper">
						<h3 class="product-content-header"><?php echo $valid_section_meta['omni_section_header'][0]; ?></h3>
						<p class="omni_column_content omni_color_gray"><?php echo
							$valid_section_meta['omni_section_content'][0]; ?></p>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="product-image-outer-wrapper">
					<div class="product-image-inner-wrapper">
						<?php echo OmniCore::omni_wp_theme_return_responsive_image_set_with_lightbox($valid_section_meta['omni_section_column_image'][0], 'omni-column', $section_light_box_group_id); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
