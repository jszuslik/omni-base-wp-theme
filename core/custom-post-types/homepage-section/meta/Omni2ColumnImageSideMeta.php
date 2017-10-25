<?php
class Omni2ColumnImageSideMeta {

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
						'type'         => 'radio',
						'name'         => 'omni_section_side',
						'id'           => 'omni_section_side',
						'choices'      => OmniOptions::omni_wp_theme_get_alignment_options(),
						'label'        => __('Image on Left or Right Side', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
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
						'type'         => 'textarea',
						'name'         => 'omni_section_content',
						'id'           => 'omni_section_content',
						'label'        => __('Section Content', OMNI_TXT_DOMAIN),
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
				)
			)
		);

	}

	public function omni_wp_theme_add_meta_boxes() {
		$post_id = $_GET['post'];
		$template_slug = get_post_meta($post_id, '_template_type', true);
		if ('2-column-no-header-image-side-1' == $template_slug || '2-column-no-header-image-side-2' == $template_slug) :
			add_meta_box(
				'omni_hp_image_side_template',
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
					if('wp_editor' == $field['type'] || 'textarea' == $field['type']) {
						update_post_meta( $post_id, $field['id'], htmlspecialchars($_POST[$field['id']] ) );
					} elseif ('radio' == $field['type']) {
						update_post_meta( $post_id, $field['id'], sanitize_html_class($_POST[$field['id']] ) );
					} else {
						update_post_meta( $post_id, $field['id'], sanitize_text_field($_POST[$field['id']] ) );
					}
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
$omni_2_column_image_side_meta = new Omni2ColumnImageSideMeta();