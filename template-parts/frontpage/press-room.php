<?php

?>
<?php

global $post;
$post_id = $post->ID;
$section_meta = get_post_meta($post_id);
$section_fields = array(
	'omni_section_id'                => 'omni_section_id',
	'omni_section_content_width'     => 'omni_section_content_width',
	'omni_section_header'            => 'omni_section_header',
	'omni_section_feed_url'          => 'omni_section_feed_url'
);
$valid_section_meta = OmniCommon::omni_wp_theme_field_validation($post_id, $section_meta, $section_fields);

?>
<section id="<?php echo $valid_section_meta['omni_section_id'][0]; ?>" class="omni_press_room">
	<div class="<?php echo $valid_section_meta['omni_section_content_width'][0]; ?>">
		<div class="row">
			<div class="col-12">
				<h4 class="omni_single_header omni_text_center omni_press_room_header omni_color_gray"><?php echo
					$valid_section_meta['omni_section_header'][0]; ?></h4>
			</div>
		</div>
	</div>
	<div class="<?php echo $valid_section_meta['omni_section_content_width'][0]; ?>">
		<div id="feed_posts" class="row">
		</div>
	</div>
</section>



<?php
omni_wp_theme_insert_feed_script($valid_section_meta['omni_section_feed_url'][0]);

function omni_wp_theme_insert_feed_script($url) { ?>
	<script>
        jQuery(document).ready(function($) {
            event.preventDefault();
            var feed_div = $('#feed_posts');
            $.getJSON('<?php echo $url; ?>', function(data) {
                $.each(data, function(key, val) {
                    feed_div.append('<div class="col-12 col-sm-6">\n' +
                        '\t\t\t\t<div class="omni_press_room_article_wrapper">\n' +
                        '\t\t\t\t\t<div class="omni_press_room_image_wrapper">\n' +
                        '\t\t\t\t\t\t<img class="img-fluid" src="' + val.post_image  + '" width="360px" height="200px">\n' +
                        '\t\t\t\t\t</div>\n' +
                        '\t\t\t\t\t<div class="omni_press_room_article_content_wrapper">\n' +
                        '\t\t\t\t\t\t<h4 class="omni_single_header omni_article_headline omni_color_gray">' + val.post_title + '</h4>\n' +
                        '\t\t\t\t\t\t<p class="omni_column_content omni_article_content omni_color_gray">' + val.post_content + '</p>\n' +
                        '\t\t\t\t\t</div>\n' +
                        '\t\t\t\t\t<div class="omni_article_link_wrapper">\n' +
                        '\t\t\t\t\t\t<a href="' + val.guid + '" target="_blank" class="omni_btn_light">Read More</a>\n' +
                        '\t\t\t\t\t</div>\n' +
                        '\t\t\t\t</div>\n' +
                        '\t\t\t</div>');
                });

            });

        });
	</script>
<?php }
