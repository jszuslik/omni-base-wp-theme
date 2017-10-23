<?php


?>
<?php


global $post;
$post_id = $post->ID;
$section_meta = get_post_meta($post_id);
$section_fields = array(
	'omni_section_id' => 'omni_section_id',
	'omni_section_background_image' => array(
		'height' => 556,
		'width'  => 1900
	)
);
$valid_section_meta = OmniCommon::omni_wp_theme_field_validation($post_id, $section_meta, $section_fields);
$responsive_bg_set = OmniCore::omni_wp_theme_return_responsive_image_set($valid_section_meta['omni_section_background_image'][0], 'omni-banner');
?>
<section id="<?php echo $valid_section_meta['omni_section_id'][0]; ?>" class="omni_full_width_image_section">
	<div class="container-fluid no-gutters">
		<div class="col-12">
			<?php echo $responsive_bg_set; ?>
		</div>
	</div>
</section>
