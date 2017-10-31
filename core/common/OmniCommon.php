<?php
include_once( ABSPATH . 'wp-admin/includes/admin.php' );
define('ALLOW_UNFILTERED_UPLOADS', true);

class OmniCommon {

    public function __construct() {
	    add_action( 'wp_ajax_nopriv_omni_wp_theme_record_zip_code', array($this, 'omni_wp_theme_record_zip_code') );
	    add_action( 'wp_ajax_omni_wp_theme_record_zip_code', array($this, 'omni_wp_theme_record_zip_code') );
	    add_action( 'wp_ajax_nopriv_omni_wp_theme_record_email', array($this, 'omni_wp_theme_record_email') );
	    add_action( 'wp_ajax_omni_wp_theme_record_email', array($this, 'omni_wp_theme_record_email') );
	    add_action( 'wp_enqueue_scripts', array($this, 'omni_wp_theme_localize_custom_script') );
    }

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
            case 'omni_section_row_1_opt_in_enable':
                return '';
	        case 'omni_section_row_1_opt_in_type':
		        return '';
	        case 'omni_section_row_2_opt_in_enable':
		        return '';
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

    public static function omni_wp_theme_setup_dispatch_file($link) {

        $file = path_join(WP_CONTENT_DIR, ltrim(substr($link, strlen(WP_CONTENT_URL)), '/'));
        self::omni_wp_theme_dispatch_file($file);

    }

    private static function omni_wp_theme_dispatch_file($file) {
	    if (headers_sent()) {
		    trigger_error(__FUNCTION__ . ": Cannot dispatch file $file, headers already sent.");
		    return;
	    }

	    if (!is_readable($file)) {
		    trigger_error(__FUNCTION__ . ": Cannot dispatch file $file, file is not readable.");
		    return;
	    }

	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream'); // http://stackoverflow.com/a/20509354
	    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($file));

	    ob_end_clean();
	    readfile($file);
	    exit;
    }

    public static function omni_wp_theme_render_zip_code_form($post_id, $meta_id, $row_id) {
        ?>
        <div class="modal fade" id="<?php echo $row_id; ?>" tabindex="-1" role="dialog"
             aria-labelledby="row_1_modal_label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title">Please Enter Your Zip Code</h5>
                        <form id="omni_zip_form" class="omni_zip_form">
                            <input type="hidden" id="<?php echo $row_id; ?>_omni_zip_post_id" class="omni_form_zip_post_id" value="<?php echo
                            $post_id; ?>">
                            <input type="hidden" id="<?php echo $row_id; ?>_omni_zip_meta_id" class="omni_form_zip_meta_id" value="<?php echo
                            $meta_id; ?>">
                            <div class="input">
                                <input type="text" class="omni_form_zip" pattern="(\d{5}([\-]\d{4})?)" id="<?php echo $row_id; ?>_zip_code" placeholder="Enter Your Zip Code - 55555-xxxx" required>
                                <label for="zip_code"></label>
                            </div>
                            <button type="submit" class="omni_modal_button">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
    }

	public static function omni_wp_theme_render_email_form($post_id, $meta_id, $row_id) {
		?>
        <div class="modal fade" id="<?php echo $row_id; ?>" tabindex="-1" role="dialog" aria-labelledby="row_2_modal_label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title">Please Enter Your Email Address</h5>
                        <form id="omni_email_form" class="omni_email_form">
                            <input type="hidden" id="<?php echo $row_id; ?>_omni_email_post_id" class="omni_form_email_post_id" value="<?php
                            echo
                            $post_id; ?>">
                            <input type="hidden" id="<?php echo $row_id; ?>_omni_email_meta_id" class="omni_form_email_meta_id" value="<?php
                            echo
                            $meta_id; ?>">
                            <div class="input">
                                <input type="email" class="omni_form_email" id="<?php echo $row_id; ?>_omni_email" placeholder="Enter Your Email Address" required>
                                <label for="omni_email"></label>
                            </div>
                            <button type="submit" class="omni_modal_button">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}

    public static function omni_wp_theme_record_zip_code() {

        $data = array(
	        'post_id'    => filter_var($_POST['post_id'], FILTER_SANITIZE_STRING),
	        'meta_id'    => filter_var($_POST['meta_id'], FILTER_SANITIZE_STRING),
	        'value'      => filter_var($_POST['zip_code'], FILTER_SANITIZE_EMAIL),
	        'type'       => filter_var('zip_code', FILTER_SANITIZE_STRING),
            'ip_address' => self::omni_wp_theme_get_real_ip_addr(),
            'time'       => date('Y-m-d H:i:s', time())
        );

        $response_msg = 'Thanks for your submission';

        if(!OmniOptInFormEntries::omni_wp_theme_add_opt_in_entry($data)) {
	        $response_msg = 'There was an error with your submission';
        }

	    $link = get_post_meta($data['post_id'], $data['meta_id'], true);
        $response = json_encode(
                array(
                    'url' => $link,
                    'file' => path_join(WP_CONTENT_DIR, ltrim(substr($link, strlen(WP_CONTENT_URL)), '/')),
                    'thanks' => $response_msg
                )
        );
        echo $response;
	    die();
    }

	public static function omni_wp_theme_record_email() {

		$data = array(
			'post_id'    => filter_var($_POST['post_id'], FILTER_SANITIZE_STRING),
			'meta_id'    => filter_var($_POST['meta_id'], FILTER_SANITIZE_STRING),
			'value'      => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
			'type'       => filter_var('email', FILTER_SANITIZE_STRING),
			'ip_address' => self::omni_wp_theme_get_real_ip_addr(),
			'time'       => date('Y-m-d H:i:s', time())
		);

		$response_msg = 'Thanks for your submission';

		if(!OmniOptInFormEntries::omni_wp_theme_add_opt_in_entry($data)) {
			$response_msg = 'There was an error with your submission';
		}

		$link = get_post_meta($data['post_id'], $data['meta_id'], true);
		$response = json_encode(
			array(
				'url' => $link,
				'file' => path_join(WP_CONTENT_DIR, ltrim(substr($link, strlen(WP_CONTENT_URL)), '/')),
				'thanks' => $response_msg
			)
		);
		echo $response;
		die();
	}

    public function omni_wp_theme_localize_custom_script() {
	    wp_enqueue_script( 'omni-forms-script',get_template_directory_uri() . '/admin/js/form-ajax.js', array('jquery'), false, true  );

	    wp_localize_script( 'omni-forms-script', 'omni_custom_ajax', array(
		    'ajax_url' => admin_url('admin-ajax.php')
	    ));
    }

    public static function omni_wp_theme_get_real_ip_addr() {
	    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip=$_SERVER['HTTP_CLIENT_IP'];
	    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    } else {
		    $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
    }


}
$omni_common = new OmniCommon();