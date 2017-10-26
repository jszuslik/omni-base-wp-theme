<?php
include_once( ABSPATH . 'wp-admin/includes/admin.php' );
define('ALLOW_UNFILTERED_UPLOADS', true);

class OmniCommon {

    public function __construct() {
        add_action( 'wp_footer', array($this, 'omni_wp_theme_add_fancybox_script_to_footer'));
    }


	public function omni_wp_theme_add_fancybox_script_to_footer() { ?>
        <script>
            $(document).ready(function() {
                $(".omni-fancybox-button").fancybox({
                    prevEffect		: 'none',
                    nextEffect		: 'none',
                    closeBtn		: false,
                    helpers		: {
                        title	: { type : 'inside' },
                        buttons	: {}
                    }
                });
            });
        </script>
    <?php }

	public static function omni_wp_theme_get_new_ticker_content() {
		$tickers = self::omni_wp_theme_news_ticker_details();
		if ( empty( $tickers ) ) {
			return;
		}

		ob_start();
		?>
		<div id="news-ticker" style="display: inline-block;">
			<div class="news-ticker-inner-wrap">
				<?php foreach ( $tickers as $key => $ticker ) : ?>
					<div class="list">
						<a href="<?php echo esc_url( $ticker['link'] ); ?>" class="alert-link"><?php echo esc_html(
						        $ticker['text']
                            ); ?></a>
					</div>
				<?php endforeach ?>
			</div> <!-- .news-ticker-inner-wrap -->
		</div><!-- #news-ticker -->
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

	public static function omni_wp_theme_news_ticker_details() {

		$output = array();

		$ticker_category = OmniCore::omni_wp_theme_get_option( 'ticker_category' );
		$ticker_number   = OmniCore::omni_wp_theme_get_option( 'ticker_number' );

		$qargs = array(
			'posts_per_page' => $ticker_number
		);
		if ( $ticker_category > 0 ) {
			$qargs['cat'] = $ticker_category ;
		}
		// p($qargs);
		$all_posts = get_posts( $qargs );
        // p($all_posts);
		if ( $all_posts ) {
			$i = 0;
			foreach ( $all_posts as $post ) {
				$output[$i]['text'] = apply_filters( 'the_title', $post->post_title );
				$output[$i]['link'] = get_permalink( $post->ID );
				$i++;
			}
		}

		return $output;

	}

	public static function omni_wp_theme_field_validation($post_id, $meta, $fields) {
        foreach ($fields as $field => $value) {
            // p($field);
            if (!array_key_exists($field, $meta)) {
                update_post_meta($post_id, $field, self::omni_wp_theme_get_default_meta($field, $value, $post_id));
            }
        }
        return get_post_meta($post_id);
    }

    private static function omni_wp_theme_get_default_meta($field, $value, $post_id) {
        $default = 'No Value In Field';
        switch($field) {
            case 'omni_section_id':
                return 'default';
            case 'omni_section_content_width':
                return 'container';
	        case 'omni_section_header':
		        return 'Default Header';
	        case 'omni_section_column_image':
		        return self::omni_wp_theme_upload_image('http://via.placeholder.com/' . $value['width']. 'x' . $value['height']. '.png', $post_id);
	        case 'omni_section_background_image':
		        return self::omni_wp_theme_upload_image('http://via.placeholder.com/' . $value['width']. 'x' . $value['height']. '.png', $post_id);
	        case 'omni_section_content':
		        return 'No content';
            case 'omni_section_small_header':
                return 'No Content';
	        case 'omni_section_large_header':
		        return 'No Content';
	        case 'omni_section_link_text':
		        return 'No Content';
	        case 'omni_section_lookbook':
		        return self::omni_wp_theme_upload_image('http://www.pdf995.com/samples/pdf.pdf', $post_id);
	        case 'omni_section_intro_headline':
		        return 'No Content';
	        case 'omni_section_intro_content':
		        return 'No Content';
	        case 'omni_section_side':
		        return 'left';
            case 'omni_section_row_1_header':
                return 'Default Row 1 Header';
	        case 'omni_section_row_1_content':
		        return 'Default Row 1 Content';
	        case 'omni_section_row_1_image':
		        return self::omni_wp_theme_upload_image('http://via.placeholder.com/' . $value['width']. 'x' . $value['height']. '.png', $post_id);
	        case 'omni_section_row_1_link_text':
		        return 'No Content';
	        case 'omni_section_row_1_lookbook':
		        return self::omni_wp_theme_upload_image('http://www.pdf995.com/samples/pdf.pdf', $post_id);
	        case 'omni_section_row_2_header':
		        return 'Default Row 2 Header';
	        case 'omni_section_row_2_content':
		        return 'Default Row 2 Content';
	        case 'omni_section_row_2_image':
		        return self::omni_wp_theme_upload_image('http://via.placeholder.com/' . $value['width']. 'x' . $value['height']. '.png', $post_id);
	        case 'omni_section_row_2_link_text':
		        return 'No Content';
	        case 'omni_section_row_2_lookbook':
		        return self::omni_wp_theme_upload_image('http://www.pdf995.com/samples/pdf.pdf', $post_id);
//            case 'omni_section_row_1_opt_in_enable':
//                return false;
	        case 'omni_section_row_1_opt_in_type':
		        return '';
	        case 'omni_section_row_2_opt_in_enable':
		        return false;
	        case 'omni_section_row_2_opt_in_type':
		        return '';
            default:
                return $default;
        }
    }

    private static function omni_wp_theme_upload_image($url, $post_id) {
	    $image = "";
	    if($url != "") {

		    $file = array();
		    $file['name'] = $url;
		    $file['tmp_name'] = download_url($url);

		    if (is_wp_error($file['tmp_name'])) {
			    @unlink($file['tmp_name']);
			    var_dump( $file['tmp_name']->get_error_messages( ) );
		    } else {
			    $attachmentId = media_handle_sideload($file, $post_id);

			    if ( is_wp_error($attachmentId) ) {
				    @unlink($file['tmp_name']);
				    var_dump( $attachmentId->get_error_messages( ) );
			    } else {
				    $image = wp_get_attachment_url( $attachmentId );
			    }
		    }
	    }
	    return $image;
    }

}