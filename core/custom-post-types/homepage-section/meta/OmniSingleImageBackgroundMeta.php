<?php

class OmniSingleImageBackgroundMeta {

	private $hp_section_meta_groups;
	private $template_slug;

	public function __construct() {
		$post_id = 0;
		if(isset($_GET['post'])) {
			$post_id = $_GET['post'];
			$this->template_slug = get_post_meta($post_id, '_template_type', true);
		} else {
			$this->template_slug;
		}
		if ('single-image-background' == $this->template_slug) :
			add_action( 'add_meta_boxes', array($this, 'omni_wp_theme_add_meta_boxes') );
			add_action('save_post', array( $this, 'omni_wp_theme_save_meta_data' ) );
			add_action('admin_print_styles', array( $this, 'omni_wp_theme_meta_image_enqueue'));

			$this->hp_section_meta_groups = array(
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
							'type'         => 'text',
							'name'         => 'omni_section_header',
							'id'           => 'omni_section_header',
							'label'        => __('Section Header', OMNI_TXT_DOMAIN),
							'description'  => ''
						),
						array(
							'type'         => 'text',
							'name'         => 'omni_section_sub_header',
							'id'           => 'omni_section_sub_header',
							'label'        => __('Section Sub Header', OMNI_TXT_DOMAIN),
							'description'  => ''
						),
						array(
							'type'         => 'textarea',
							'name'         => 'omni_section_content',
							'id'           => 'omni_section_content',
							'label'        => __('Section Content', OMNI_TXT_DOMAIN),
							'description'  => ''
						),
						array(
							'type'         => 'image',
							'name'         => 'omni_section_background_image',
							'id'           => 'omni_section_background_image',
							'btn_id'       => 'omni_section_btn_background_image',
							'label'        => __('Section Background Image', OMNI_TXT_DOMAIN),
							'description'  => ''
						),
					)
				)
			);
		endif;

	}

	public function omni_wp_theme_add_meta_boxes() {
		add_meta_box(
			'omni_hp_single_image_bg_template',
			__('Section Settings', OMNI_TXT_DOMAIN),
			array($this, 'omni_wp_theme_render_meta_box'),
			'homepage_section',
			'normal',
			'default'
		);
	}

	public function omni_wp_theme_render_meta_box($post) {

		echo OmniCore::omni_wp_theme_render_meta_boxes($this->hp_section_meta_groups, get_post_meta($post->ID));
	}

	public function omni_wp_theme_save_meta_data($post_id) {
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST['omni_hp_section_nonce'] ) && wp_verify_nonce( $_POST['omni_hp_section_nonce'], basename
			(__FILE__) )	) ?	'true' :	'false';

		if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
			return;
		}

		foreach($this->hp_section_meta_groups as $field_group) {
			foreach($field_group['fields'] as $field) {
				if (isset($_POST[$field['id']])) {
					update_post_meta( $post_id, $field['id'], sanitize_text_field($_POST[$field['id']] ) );
				}
			}
		}
	}
	public function omni_wp_theme_meta_image_enqueue(){
		wp_enqueue_media();
		// Registers and enqueues the required javascript.
		wp_register_script( 'omni-meta-box-image', get_template_directory_uri() . '/admin/js/admin-meta.js', array( 'jquery' ) );
		wp_localize_script( 'omni-meta-box-image', 'meta_image',
		                    array(
			                    'title' => __( 'Choose or Upload an Image', OMNI_TXT_DOMAIN ),
			                    'button' => __( 'Use this image', OMNI_TXT_DOMAIN ),
		                    )
		);
		wp_enqueue_script( 'omni-meta-box-image' );
	}

}
$omni_single_image_bg_meta = new OmniSingleImageBackgroundMeta();