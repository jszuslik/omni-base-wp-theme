<?php

class OmniVendorsSectionMeta {
	private $hp_section_meta_group;

	public function __construct() {
		add_action( 'add_meta_boxes', array($this, 'omni_wp_theme_add_meta_boxes') );
		add_action('save_post', array( $this, 'omni_wp_theme_save_meta_data' ) );
		add_action( 'wp_ajax_nopriv_omni_wp_theme_ajax_get_feed', array($this, 'omni_wp_theme_ajax_get_feed') );
		add_action( 'wp_ajax_omni_wp_theme_ajax_get_feed', array($this, 'omni_wp_theme_ajax_get_feed') );
		add_action('omni_wp_theme_action_display_vendor', array($this, 'omni_wp_theme_display_vendor_hook'), 10 );

		$this->hp_section_meta_group = array(
			array(
				'name'       => __('', OMNI_TXT_DOMAIN),
				'fields'     => array(
					array(
						'type'         => 'text',
						'name'         => 'omni_section_id',
						'id'           => 'omni_section_id',
						'label'        => __('Section ID', OMNI_TXT_DOMAIN),
						'description'  => 'This is used for one page navigation'
					),
					array(
						'type'         => 'select',
						'name'         => 'omni_section_content_width',
						'id'           => 'omni_section_content_width',
						'choices'      => OmniOptions::omni_wp_theme_get_primary_menu_width_options(),
						'label'        => __( 'Section Content Width', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'text',
						'name'         => 'omni_section_header',
						'id'           => 'omni_section_header',
						'label'        => __('Section Header', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
				)
			)
		);
	}

	public function omni_wp_theme_add_meta_boxes() {
		$post_id = 0;
		if(isset($_GET['post']))
			$post_id = $_GET['post'];
		$template_slug = get_post_meta($post_id, '_template_type', true);
		if ('omni-vendors' == $template_slug) :
			add_meta_box(
				'omni_hp_press_room_section_template',
				__('Header Settings', OMNI_TXT_DOMAIN),
				array($this, 'omni_wp_theme_render_meta_box'),
				'homepage_section',
				'normal',
				'default'
			);
		endif;
	}

	public function omni_wp_theme_render_meta_box($post) {

		echo OmniCore::omni_wp_theme_render_meta_boxes($this->hp_section_meta_group, get_post_meta($post->ID));
	}

	public function omni_wp_theme_save_meta_data($post_id) {
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST['omni_hp_section_nonce'] ) && wp_verify_nonce( $_POST['omni_hp_section_nonce'], basename
			(__FILE__) )	) ?	'true' :	'false';

		if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
			return;
		}

		foreach($this->hp_section_meta_group as $field_group) {
			foreach($field_group['fields'] as $field) {
				if ('check' == $field['type'] || 'enable_opt_in' == $field['type']) {
					foreach($field['choices'] as $key => $choice) {
						if(isset($_POST[$field['id']. '_' . $key])) {
							update_post_meta( $post_id, $field['id']. '_' . $key, $key  );
						} else {
							update_post_meta( $post_id, $field['id']. '_' . $key, '' );
						}
					}
				} elseif ('radio' == $field['type']) {
					update_post_meta( $post_id, $field['id'], sanitize_html_class($_POST[$field['id']] ) );
				} elseif (isset($_POST[$field['id']])) {
					update_post_meta( $post_id, $field['id'], sanitize_text_field($_POST[$field['id']] ) );
				}
			}
		}
	}

	public function omni_wp_theme_display_vendor_hook() {
		$args = array(
			'post_type'      => 'vendors',
			'posts_per_page' => -1
		);
		$vendors = get_posts($args);
		$info = 'No Vendors';

		if(0 < count($vendors)) :
			foreach ($vendors as $vendor) :
				$vendor_meta = get_post_meta($vendor->ID);
				$info = '<div class="col-6 col-sm-4">';
				$state = null;
				if(isset($vendor_meta['omni_vendor_state'])) {
					$state = $vendor_meta['omni_vendor_state'][0];
					$info .= '<h4 class="omni_vendor_state_header omni_color_gray">' . $state . '</h4>';
				}

				if(isset($vendor_meta['omni_vendor_name']) && '' != $vendor_meta['omni_vendor_name'][0])
					$info .= '<h5 class="omni_vendor_content omni_color_gray">' . $vendor_meta['omni_vendor_name'][0] . '</h5>';
				if(isset($vendor_meta['omni_vendor_address_1']) && '' != $vendor_meta['omni_vendor_address_1'][0])
					$info .= '<h5 class="omni_vendor_content omni_color_gray">' . $vendor_meta['omni_vendor_address_1'][0] . '</h5>';
				if(isset($vendor_meta['omni_vendor_address_2']) && '' != $vendor_meta['omni_vendor_address_2'][0])
					$info .= '<h5 class="omni_vendor_content omni_color_gray">' . $vendor_meta['omni_vendor_address_2'][0] . '</h5>';
				if(isset($vendor_meta['omni_vendor_city']) && '' != $vendor_meta['omni_vendor_city'][0]) {
					$info .= '<h5 class="omni_vendor_content omni_color_gray">' . $vendor_meta['omni_vendor_city'][0];
					if($state != null) {
						$info .= ', ' . $state;
					}

					if(isset($vendor_meta['omni_vendor_zip'])) {
						$info .= ' ' . $vendor_meta['omni_vendor_zip'][0];
					}

					$info .= '</h5>';
				}

				if(isset($vendor_meta['omni_vendor_phone']) && '' != $vendor_meta['omni_vendor_phone'][0]) {
					$info .= '<h5 class="omni_vendor_content omni_color_gray">Phone: ' . $vendor_meta['omni_vendor_phone'][0] . '</h5>';
				}
				if(isset($vendor_meta['omni_vendor_email']) && '' != $vendor_meta['omni_vendor_email'][0]) {
					$info .= '<h5 class="omni_vendor_content omni_color_gray">Email: ' . $vendor_meta['omni_vendor_email'][0] . '</h5>';
				}
				if(isset($vendor_meta['omni_vendor_fax']) && '' != $vendor_meta['omni_vendor_fax'][0]) {
					$info .= '<h5 class="omni_vendor_content omni_color_gray">Fax: ' . $vendor_meta['omni_vendor_fax'][0] . '</h5>';
				}


				$info .= '</div>';
			endforeach;
		endif;

		echo $info;
	}
}
$omni_vendors_section_meta = new OmniVendorsSectionMeta();