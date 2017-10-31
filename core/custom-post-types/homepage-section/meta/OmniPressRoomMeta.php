<?php

class OmniPressRoomMeta {

	private $hp_section_meta_group;

	public function __construct() {
		add_action( 'add_meta_boxes', array($this, 'omni_wp_theme_add_meta_boxes') );
		add_action('save_post', array( $this, 'omni_wp_theme_save_meta_data' ) );
		add_action( 'wp_ajax_nopriv_omni_wp_theme_ajax_get_feed', array($this, 'omni_wp_theme_ajax_get_feed') );
		add_action( 'wp_ajax_omni_wp_theme_ajax_get_feed', array($this, 'omni_wp_theme_ajax_get_feed') );

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
						'type'         => 'text',
						'name'         => 'omni_section_header',
						'id'           => 'omni_section_header',
						'label'        => __('Section Header', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'text',
						'name'         => 'omni_section_feed_url',
						'id'           => 'omni_section_feed_url',
						'label'        => __('Post Feed URL', OMNI_TXT_DOMAIN),
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
		if ('press-room' == $template_slug) :
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


	public function omni_wp_theme_ajax_get_feed() {
		echo get_bloginfo( 'title' );
		die();
	}

}
$omni_press_room_meta = new OmniPressRoomMeta();