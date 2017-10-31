<?php
global $post;
$post_id = $post->ID;
$section_meta = get_post_meta($post_id);
$section_fields = array(
	'omni_section_id'                => 'omni_section_id',
	'omni_section_content_width'     => 'omni_section_content_width',
	'omni_section_header'            => 'omni_section_header'
);
$valid_section_meta = OmniCommon::omni_wp_theme_field_validation($post_id, $section_meta, $section_fields);

?>

<section id="<?php echo $valid_section_meta['omni_section_id'][0]; ?>" class="omni_vendors">
	<div class="<?php echo $valid_section_meta['omni_section_content_width'][0]; ?>">
		<div class="row">
			<div class="col-12">
				<h4 class="omni_single_header omni_text_center omni_press_room_header omni_color_gray"><?php echo
					$valid_section_meta['omni_section_header'][0]; ?></h4>
			</div>
		<?php

			do_action('omni_wp_theme_action_display_vendor');

		?>

		</div>
	</div>
</section>
