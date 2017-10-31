<?php

class OmniVendorPostType {

	private $vendor_meta_group;
	private $vendors_post_type;

	public function __construct() {
		add_action( 'init', array($this, 'vendors_post_type'), 0 );
		$post_id = 0;
		if(isset($_GET['post'])) {
			$post_id = $_GET['post'];
			$this->vendors_post_type = get_post_type($post_id);
		} elseif(isset($_GET['post_type'])) {
			$this->vendors_post_type = $_GET['post_type'];
		}

		add_action( 'add_meta_boxes', array($this, 'omni_wp_theme_add_meta_boxes') );
		add_action('save_post', array( $this, 'omni_wp_theme_save_meta_data' ) );

		$this->vendor_meta_group = array(
			array(
				'name'       => __('', OMNI_TXT_DOMAIN),
				'fields'     => array(
					array(
						'type'         => 'text',
						'name'         => 'omni_vendor_name',
						'id'           => 'omni_vendor_name',
						'label'        => __('Vendor Name', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'text',
						'name'         => 'omni_vendor_address_1',
						'id'           => 'omni_vendor_address_1',
						'label'        => __('Vendor Address 1', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'text',
						'name'         => 'omni_vendor_address_2',
						'id'           => 'omni_vendor_address_2',
						'label'        => __('Vendor Address 2', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'text',
						'name'         => 'omni_vendor_city',
						'id'           => 'omni_vendor_city',
						'label'        => __('Vendor City', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'select',
						'name'         => 'omni_vendor_state',
						'id'           => 'omni_vendor_state',
						'choices'      => OmniOptions::omni_wp_theme_display_states(),
						'label'        => __( 'State', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'text',
						'name'         => 'omni_vendor_zip',
						'id'           => 'omni_vendor_zip',
						'label'        => __('Vendor Postal Code', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'text',
						'name'         => 'omni_vendor_phone',
						'id'           => 'omni_vendor_phone',
						'label'        => __('Vendor Phone Number', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'text',
						'name'         => 'omni_vendor_email',
						'id'           => 'omni_vendor_email',
						'label'        => __('Vendor E-mail Address', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
					array(
						'type'         => 'text',
						'name'         => 'omni_vendor_fax',
						'id'           => 'omni_vendor_fax',
						'label'        => __('Vendor Fax Number', OMNI_TXT_DOMAIN),
						'description'  => ''
					),
				)
			)
		);
	}

	public function vendors_post_type() {

		$labels = array(
			'name'                  => _x( 'Vendors', 'Post Type General Name', 'vendors' ),
			'singular_name'         => _x( 'Vendor', 'Post Type Singular Name', 'vendors' ),
			'menu_name'             => __( 'Vendors', 'vendors' ),
			'name_admin_bar'        => __( 'Vendor', 'vendors' ),
			'archives'              => __( 'Vendor Archives', 'vendors' ),
			'attributes'            => __( 'Vendor Attributes', 'vendors' ),
			'parent_item_colon'     => __( 'Parent Vendor:', 'vendors' ),
			'all_items'             => __( 'All Vendors', 'vendors' ),
			'add_new_item'          => __( 'Add New Vendor', 'vendors' ),
			'add_new'               => __( 'Add New', 'vendors' ),
			'new_item'              => __( 'New Vendor', 'vendors' ),
			'edit_item'             => __( 'Edit Vendor', 'vendors' ),
			'update_item'           => __( 'Update Vendor', 'vendors' ),
			'view_item'             => __( 'View Vendor', 'vendors' ),
			'view_items'            => __( 'View Vendors', 'vendors' ),
			'search_items'          => __( 'Search Vendor', 'vendors' ),
			'not_found'             => __( 'Not found', 'vendors' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'vendors' ),
			'featured_image'        => __( 'Featured Image', 'vendors' ),
			'set_featured_image'    => __( 'Set featured image', 'vendors' ),
			'remove_featured_image' => __( 'Remove featured image', 'vendors' ),
			'use_featured_image'    => __( 'Use as featured image', 'vendors' ),
			'insert_into_item'      => __( 'Insert into vendor', 'vendors' ),
			'uploaded_to_this_item' => __( 'Uploaded to this vendor', 'vendors' ),
			'items_list'            => __( 'Vendors list', 'vendors' ),
			'items_list_navigation' => __( 'Vendors list navigation', 'vendors' ),
			'filter_items_list'     => __( 'Filter vendors list', 'vendors' ),
		);
		$args = array(
			'label'                 => __( 'Vendor', 'vendors' ),
			'description'           => __( 'Vendor', 'vendors' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'revisions', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'rewrite'               => false,
			'capability_type'       => 'page',
			'show_in_rest'          => false,
		);
		register_post_type( 'vendors', $args );

	}

	public function omni_wp_theme_add_meta_boxes() {
		add_meta_box(
			'omni_vendors_template',
			__('Vendor Info', OMNI_TXT_DOMAIN),
			array($this, 'omni_wp_theme_render_vendor_info_meta_box'),
			'vendors',
			'normal',
			'default'
		);
	}

	public function omni_wp_theme_render_vendor_info_meta_box($post) {
		echo OmniCore::omni_wp_theme_render_meta_boxes($this->vendor_meta_group, get_post_meta($post->ID));
	}

	public function omni_wp_theme_save_meta_data($post_id) {

			$is_autosave = wp_is_post_autosave( $post_id );
			$is_revision = wp_is_post_revision( $post_id );
			$is_valid_nonce = ( isset( $_POST['omni_vendors_nonce'] ) && wp_verify_nonce( $_POST['omni_vendors_nonce'],
			                                                                              basename
				(__FILE__) )	) ?	'true' :	'false';

			if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
				return;
			}

			foreach($this->vendor_meta_group as $field_group) {
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

}
$omni_vendor_post_type = new OmniVendorPostType();