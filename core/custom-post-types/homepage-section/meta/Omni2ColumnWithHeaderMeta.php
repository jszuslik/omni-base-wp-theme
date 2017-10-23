<?php

class Omni2ColumnWithHeaderMeta {

	private $hp_section_meta_groups;

	public function __construct() {
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
						'type'         => 'select',
						'name'         => 'omni_section_content_width',
						'id'           => 'omni_section_content_width',
						'choices'      => OmniOptions::omni_wp_theme_get_primary_menu_width_options(),
						'label'        => __( 'Section Content Width', OMNI_TXT_DOMAIN),
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
					array(
						'type'         => 'text',
						'name'         => 'omni_section_header',
						'id'           => 'omni_section_header',
						'label'        => __('Section Header', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'image',
						'name'         => 'omni_section_column_image',
						'id'           => 'omni_section_column_image',
						'btn_id'       => 'omni_section_btn_column_image',
						'label'        => __('Column Image', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'text',
						'name'         => 'omni_section_small_header',
						'id'           => 'omni_section_small_header',
						'label'        => __('Section Column Small Header', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'text',
						'name'         => 'omni_section_large_header',
						'id'           => 'omni_section_large_header',
						'label'        => __('Section Column Large Header', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'text',
						'name'         => 'omni_section_link_text',
						'id'           => 'omni_section_link_text',
						'label'        => __('Section Column CTA Text', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'image',
						'name'         => 'omni_section_lookbook',
						'id'           => 'omni_section_lookbook',
						'btn_id'       => 'omni_section_btn_lookbook',
						'btn_text'     => __('Choose or Upload a File', OMNI_TXT_DOMAIN),
						'label'        => __('Section Column CTA File', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'text',
						'name'         => 'omni_section_intro_headline',
						'id'           => 'omni_section_intro_headline',
						'label'        => __('Section Intro Headline', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'textarea',
						'name'         => 'omni_section_intro_content',
						'id'           => 'omni_section_intro_content',
						'label'        => __('Section Intro Content', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
				)
			)
		);
	}

	public function omni_wp_theme_add_meta_boxes() {
		$post_id = $_GET['post'];
		$template_slug = get_post_meta($post_id, '_template_type', true);
		if ('2-column-with-header' == $template_slug) :
			add_meta_box(
				'omni_hp_2_column_with_header_section_template',
				__('Section Settings', OMNI_TXT_DOMAIN),
				array($this, 'omni_wp_theme_render_meta_box'),
				'homepage_section',
				'normal',
				'default'
			);
		endif;
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
$omni_homepage_section = new Omni2ColumnWithHeaderMeta();