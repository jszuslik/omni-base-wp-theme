<?php

class Omni2Col2RowHeaderMeta {
	private $hp_section_header_meta_groups;
	private $hp_section_row_1_meta_groups;
	private $hp_section_row_2_meta_groups;

	public function __construct() {
		add_action( 'add_meta_boxes', array($this, 'omni_wp_theme_add_meta_boxes') );
		add_action('save_post', array( $this, 'omni_wp_theme_save_meta_data' ) );
		add_action('admin_print_styles', array( $this, 'omni_wp_theme_meta_image_enqueue'));

		$this->hp_section_header_meta_groups = array(
			array(
				'name'       => __('Section Header', OMNI_TXT_DOMAIN),
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
		$this->hp_section_row_1_meta_groups = array(
			array(
				'name'       => __('Row 1', OMNI_TXT_DOMAIN),
				'fields'     => array(
					array(
						'type'         => 'text',
						'name'         => 'omni_section_row_1_header',
						'id'           => 'omni_section_row_1_header',
						'label'        => __('Row 1 Header', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'textarea',
						'name'         => 'omni_section_row_1_content',
						'id'           => 'omni_section_row_1_content',
						'label'        => __('Row 1 Content', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'image',
						'name'         => 'omni_section_row_1_image',
						'id'           => 'omni_section_row_1_image',
						'btn_id'       => 'omni_section_btn_row_1_image',
						'label'        => __('Row 1 Image', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'text',
						'name'         => 'omni_section_row_1_link_text',
						'id'           => 'omni_section_row_1_link_text',
						'label'        => __('Row 1 Button Text', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'image',
						'name'         => 'omni_section_row_1_lookbook',
						'id'           => 'omni_section_row_1_lookbook',
						'btn_id'       => 'omni_section_btn_row_1_lookbook',
						'btn_text'     => __('Choose or Upload a File', OMNI_TXT_DOMAIN),
						'label'        => __('Row 1 File', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
				)
			)
		);
		$this->hp_section_row_2_meta_groups = array(
			array(
				'name'       => __('Row 2', OMNI_TXT_DOMAIN),
				'fields'     => array(
					array(
						'type'         => 'text',
						'name'         => 'omni_section_row_2_header',
						'id'           => 'omni_section_row_2_header',
						'label'        => __('Row 2 Header', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'textarea',
						'name'         => 'omni_section_row_2_content',
						'id'           => 'omni_section_row_2_content',
						'label'        => __('Row 2 Content', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'image',
						'name'         => 'omni_section_row_2_image',
						'id'           => 'omni_section_row_2_image',
						'btn_id'       => 'omni_section_btn_row_2_image',
						'label'        => __('Row 2 Image', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'text',
						'name'         => 'omni_section_row_2_link_text',
						'id'           => 'omni_section_row_2_link_text',
						'label'        => __('Row 2 Button Text', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'image',
						'name'         => 'omni_section_row_2_lookbook',
						'id'           => 'omni_section_row_2_lookbook',
						'btn_id'       => 'omni_section_btn_row_2_lookbook',
						'btn_text'     => __('Choose or Upload a File', OMNI_TXT_DOMAIN),
						'label'        => __('Row 2 File', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
				)
			)
		);
	}

	public function omni_wp_theme_add_meta_boxes() {
		$post_id = $_GET['post'];
		$template_slug = get_post_meta($post_id, '_template_type', true);
		if ('2-column-2-row-with-header' == $template_slug) :
			add_meta_box(
				'omni_hp_2_column_with_header_section_template',
				__('Header Settings', OMNI_TXT_DOMAIN),
				array($this, 'omni_wp_theme_render_header_meta_box'),
				'homepage_section',
				'normal',
				'default'
			);
			add_meta_box(
				'omni_hp_2_column_with_row_1_section_template',
				__('Row 1 Settings', OMNI_TXT_DOMAIN),
				array($this, 'omni_wp_theme_render_row_1_meta_box'),
				'homepage_section',
				'normal',
				'default'
			);
			add_meta_box(
				'omni_hp_2_column_with_row_2_section_template',
				__('Row 2 Settings', OMNI_TXT_DOMAIN),
				array($this, 'omni_wp_theme_render_row_2_meta_box'),
				'homepage_section',
				'normal',
				'default'
			);
		endif;
	}

	public function omni_wp_theme_render_header_meta_box($post) {

		echo OmniCore::omni_wp_theme_render_meta_boxes($this->hp_section_header_meta_groups, get_post_meta($post->ID));
	}

	public function omni_wp_theme_render_row_1_meta_box($post) {

		echo OmniCore::omni_wp_theme_render_meta_boxes($this->hp_section_row_1_meta_groups, get_post_meta($post->ID));
	}

	public function omni_wp_theme_render_row_2_meta_box($post) {

		echo OmniCore::omni_wp_theme_render_meta_boxes($this->hp_section_row_2_meta_groups, get_post_meta($post->ID));
	}

	public function omni_wp_theme_save_meta_data($post_id) {
		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST['omni_hp_section_nonce'] ) && wp_verify_nonce( $_POST['omni_hp_section_nonce'], basename
			(__FILE__) )	) ?	'true' :	'false';

		if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
			return;
		}

		foreach($this->hp_section_header_meta_groups as $field_group) {
			foreach($field_group['fields'] as $field) {
				if (isset($_POST[$field['id']])) {
					update_post_meta( $post_id, $field['id'], sanitize_text_field($_POST[$field['id']] ) );
				}
			}
		}
		foreach($this->hp_section_row_1_meta_groups as $field_group) {
			foreach($field_group['fields'] as $field) {
				if (isset($_POST[$field['id']])) {
					update_post_meta( $post_id, $field['id'], sanitize_text_field($_POST[$field['id']] ) );
				}
			}
		}
		foreach($this->hp_section_row_2_meta_groups as $field_group) {
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
$omni_2_col_2_row_header_meta = new Omni2Col2RowHeaderMeta();