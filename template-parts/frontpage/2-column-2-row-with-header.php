<?php

?>
<?php
global $post;
$post_id = $post->ID;
$section_light_box_group_id = '2-column-2-row-w-header-lightbox-group';
$section_meta = get_post_meta($post_id);
$section_fields = array(
	'omni_section_id'                => 'omni_section_id',
	'omni_section_content_width'     => 'omni_section_content_width',
	'omni_section_header'            => 'omni_section_header',
	'omni_section_row_1_header'      => 'omni_section_row_1_header',
	'omni_section_row_1_content'     => 'omni_section_row_1_content',
	'omni_section_row_1_image'       => array(
		'height' => 335,
		'width'  => 480
	),
	'omni_section_row_1_link_text'     => 'omni_section_row_1_link_text',
	'omni_section_row_1_opt_in_enable' => 'omni_section_row_1_opt_in_enable',
	'omni_section_row_1_opt_in_type'   => 'omni_section_row_1_opt_in_type',
	'omni_section_row_1_lookbook'      => 'omni_section_row_1_lookbook',
	'omni_section_row_2_header'        => 'omni_section_row_2_header',
	'omni_section_row_2_content'       => 'omni_section_row_2_content',
	'omni_section_row_2_image'         => array(
		'height' => 335,
		'width'  => 480
	),
	'omni_section_row_2_link_text'  => 'omni_section_row_2_link_text',
	'omni_section_row_2_opt_in_enable' => 'omni_section_row_2_opt_in_enable',
	'omni_section_row_2_opt_in_type'   => 'omni_section_row_2_opt_in_type',
	'omni_section_row_2_lookbook'   => 'omni_section_row_2_lookbook'

);
$valid_section_meta = OmniCommon::omni_wp_theme_field_validation($post_id, $section_meta, $section_fields);
$section_header_array = explode(' ', $valid_section_meta['omni_section_header'][0]);
$section_head = '';
for($i = 0; $i < count($section_header_array); $i++) {
	if(0 == $i) {
		$section_head .= $section_header_array[$i] . '<br>';
	} else {
		$section_head .= $section_header_array[$i] . ' ';
	}
}

?>
<section id="<?php echo $valid_section_meta['omni_section_id'][0]; ?>" class="omni_2_col_2_row_header">
	<div class="omni_section_header_wrapper">
		<div class="container">
			<div class="col-12">
				<h2 class="omni_section_header">
					<?php echo $section_head; ?>
				</h2>
			</div>
		</div>
	</div>
	<div class="omni_section_row_1_wrapper omni_bg_color_light_gray">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-6">
					<div class="omni_row_image_wrapper">
						<?php echo OmniCore::omni_wp_theme_return_responsive_image_set_with_lightbox($valid_section_meta['omni_section_row_1_image'][0], 'omni-row-image', $section_light_box_group_id, 380, 315); ?>
					</div>
				</div>
				<div class="col-12 col-sm-6">
                    <div class="omni_row_content_outer_wrapper">
                        <div class="omni_row_content_inner_wrapper">
                            <h5 class="omni_side_header omni_color_dark_gray"><?php echo $valid_section_meta['omni_section_row_1_header'][0]; ?></h5>
                            <p class="omni_column_content omni_color_gray"><?php echo $valid_section_meta['omni_section_row_1_content'][0]; ?></p>
                            <?php

                                if($valid_section_meta['omni_section_row_1_opt_in_enable'][0]) :
	                                ?>
                                    <a href="javascript:void(0)" target="_blank" class="omni_btn_light omni_bg_color_light_gray"
                                       data-toggle="modal" data-target="#row_1_modal"><?php echo
                                        $valid_section_meta['omni_section_row_1_link_text'][0]; ?></a> <?php
                                else :
                                    ?> <a href="<?php echo $valid_section_meta['omni_section_row_1_lookbook'][0]; ?>" target="_blank" class="omni_btn_light omni_bg_color_light_gray"><?php echo $valid_section_meta['omni_section_row_1_link_text'][0]; ?></a> <?php
                                endif;
                            ?>

                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<div class="omni_section_row_2_wrapper omni_bg_color_light_gray">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-6 order-sm-first">
                    <div class="omni_row_content_outer_wrapper">
                        <div class="omni_row_content_inner_wrapper">
                            <h5 class="omni_side_header omni_color_dark_gray"><?php echo $valid_section_meta['omni_section_row_2_header'][0]; ?></h5>
                            <p class="omni_column_content omni_color_gray"><?php echo $valid_section_meta['omni_section_row_2_content'][0]; ?></p>
	                        <?php

	                        if($valid_section_meta['omni_section_row_2_opt_in_enable'][0]) :
		                        ?>
                                <a href="javascript:void(0)" target="_blank" class="omni_btn_light omni_bg_color_light_gray"
                                   data-toggle="modal" data-target="#row_2_modal"><?php echo
			                        $valid_section_meta['omni_section_row_2_link_text'][0]; ?></a> <?php
	                        else :
		                        ?> <a href="<?php echo $valid_section_meta['omni_section_row_2_lookbook'][0]; ?>" target="_blank" class="omni_btn_light omni_bg_color_light_gray"><?php echo $valid_section_meta['omni_section_row_2_link_text'][0]; ?></a> <?php
	                        endif;
	                        ?>
                        </div>
                    </div>
				</div>
				<div class="col-12 order-first col-sm-6">
					<div class="omni_row_image_wrapper">
						<?php echo OmniCore::omni_wp_theme_return_responsive_image_set_with_lightbox($valid_section_meta['omni_section_row_2_image'][0], 'omni-row-image', $section_light_box_group_id); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php if($valid_section_meta['omni_section_row_1_opt_in_enable'][0]) :

    switch ($valid_section_meta['omni_section_row_1_opt_in_type'][0]) {
        case 'zip':
	        OmniCommon::omni_wp_theme_render_zip_code_form($post_id, 'omni_section_row_1_lookbook', 'row_1_modal');
            break;
	    case 'email':
		    OmniCommon::omni_wp_theme_render_email_form($post_id, 'omni_section_row_1_lookbook', 'row_1_modal');
		    break;
    }

endif; ?>
<?php if($valid_section_meta['omni_section_row_2_opt_in_enable'][0]) :

	switch ($valid_section_meta['omni_section_row_2_opt_in_type'][0]) {
		case 'zip':
			OmniCommon::omni_wp_theme_render_zip_code_form($post_id, 'omni_section_row_2_lookbook', 'row_2_modal');
			break;
		case 'email':
			OmniCommon::omni_wp_theme_render_email_form($post_id, 'omni_section_row_2_lookbook', 'row_2_modal');
			break;
	}

endif; ?>
