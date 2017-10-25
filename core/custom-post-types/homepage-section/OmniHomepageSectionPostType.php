<?php
/**
 * Created by PhpStorm.
 * User: joshua.szuslik
 * Date: 10/17/2017
 * Time: 8:18 PM
 */

class OmniHomepageSectionPostType {

	public function __construct() {
		add_action( 'init', array($this, 'homepage_sections_post_type'), 0 );
		add_filter( 'after_setup_theme', array($this, 'omni_wp_theme_auto_create_initial_posts') );

		add_action( 'add_meta_boxes', array($this, 'omni_wp_theme_add_template_select_meta_box') );

		add_action('save_post', array($this, 'omni_wp_theme_hp_section_template_save'), 1);

		add_action( 'wp_ajax_nopriv_omni_wp_theme_ajax_update_post_menu_order', array($this, 'omni_wp_theme_ajax_update_post_menu_order') );
		add_action( 'wp_ajax_omni_wp_theme_ajax_update_post_menu_order', array($this, 'omni_wp_theme_ajax_update_post_menu_order') );
	}

	// Register Custom Post Type
	public function homepage_sections_post_type() {

		$labels = array(
			'name'                  => _x( 'Homepage Sections', 'Post Type General Name', 'omni-wp-theme' ),
			'singular_name'         => _x( 'Homepage Section', 'Post Type Singular Name', 'omni-wp-theme' ),
			'menu_name'             => __( 'Homepage Sections', 'omni-wp-theme' ),
			'name_admin_bar'        => __( 'Homepage Section', 'omni-wp-theme' ),
			'archives'              => __( 'Homepage Sections Archives', 'omni-wp-theme' ),
			'attributes'            => __( 'Homepage Sections Attributes', 'omni-wp-theme' ),
			'parent_item_colon'     => __( 'Parent Homepage Section:', 'omni-wp-theme' ),
			'all_items'             => __( 'All Homepage Sections', 'omni-wp-theme' ),
			'add_new_item'          => __( 'Add New Homepage Section', 'omni-wp-theme' ),
			'add_new'               => __( 'Add New Homepage Section', 'omni-wp-theme' ),
			'new_item'              => __( 'New Homepage Section', 'omni-wp-theme' ),
			'edit_item'             => __( 'Edit Homepage Section', 'omni-wp-theme' ),
			'update_item'           => __( 'Update Homepage Section', 'omni-wp-theme' ),
			'view_item'             => __( 'View Homepage Section', 'omni-wp-theme' ),
			'view_items'            => __( 'View Homepage Sections', 'omni-wp-theme' ),
			'search_items'          => __( 'Search Homepage Section', 'omni-wp-theme' ),
			'not_found'             => __( 'Not found', 'omni-wp-theme' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'omni-wp-theme' ),
			'featured_image'        => __( 'Featured Image', 'omni-wp-theme' ),
			'set_featured_image'    => __( 'Set featured image', 'omni-wp-theme' ),
			'remove_featured_image' => __( 'Remove featured image', 'omni-wp-theme' ),
			'use_featured_image'    => __( 'Use as featured image', 'omni-wp-theme' ),
			'insert_into_item'      => __( 'Insert into Homepage Section', 'omni-wp-theme' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Homepage Section', 'omni-wp-theme' ),
			'items_list'            => __( 'Homepage Sections list', 'omni-wp-theme' ),
			'items_list_navigation' => __( 'Homepage Sections list navigation', 'omni-wp-theme' ),
			'filter_items_list'     => __( 'Filter Homepage Sections list', 'omni-wp-theme' ),
		);
		$args = array(
			'label'                 => __( 'Homepage Section', 'omni-wp-theme' ),
			'description'           => __( 'Homepage Section', 'omni-wp-theme' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'revisions', 'page-attributes', ),
			'taxonomies'            => array( 'homepage_section' ),
			'hierarchical'          => false,
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => false,
			'rewrite'               => false,
			'capability_type'       => 'page',
			'show_in_rest'          => false,
		);
		register_post_type( 'homepage_section', $args );

	}

	public function omni_wp_theme_auto_create_initial_posts() {

		$init_posts = array(
			array(
				'post_id'     => -1,
				'author_id'   => 1,
				'slug'        => '2-column-with-header',
				'title'       => __('2 Column With Header', OMNI_TXT_DOMAIN),
				'menu_order'  => 1
			),
			array(
				'post_id'   => -1,
				'author_id' => 1,
				'slug'      => 'full-width-image-section',
				'title'     => __('Full Width Image Section', OMNI_TXT_DOMAIN),
				'menu_order'  => 2
			),
			array(
				'post_id'   => -1,
				'author_id' => 1,
				'slug'      => '2-column-product-section',
				'title'     => __('2 Column Product Section', OMNI_TXT_DOMAIN),
				'menu_order'  => 3
			),
			array(
				'post_id'   => -1,
				'author_id' => 1,
				'slug'      => 'single-image-background',
				'title'     => __('Single Image Background', OMNI_TXT_DOMAIN),
				'menu_order'  => 4
			),
			array(
				'post_id'   => -1,
				'author_id' => 1,
				'slug'      => '2-column-no-header-image-side-1',
				'title'     => __('2 Column No Header Image Side 1', OMNI_TXT_DOMAIN),
				'menu_order'  => 5
			),
			array(
				'post_id'   => -1,
				'author_id' => 1,
				'slug'      => '2-column-no-header-image-side-2',
				'title'     => __('2 Column No Header Image Side 2', OMNI_TXT_DOMAIN),
				'menu_order'  => 6
			),
			array(
				'post_id'   => -1,
				'author_id' => 1,
				'slug'      => '2-column-2-row-with-header',
				'title'     => __('2 Column 2 Row With Header', OMNI_TXT_DOMAIN),
				'menu_order'  => 7
			),
			array(
				'post_id'   => -1,
				'author_id' => 1,
				'slug'      => 'press-room',
				'title'     => __('Press Room', OMNI_TXT_DOMAIN),
				'menu_order'  => 8
			),
		);

		foreach ($init_posts as $init_post) :

			$posts = get_posts(
				array(
                   'name' => $init_post['slug'],
                   'posts_per_page' => 1,
                   'post_type' => 'homepage_section',
                   'post_status' => 'publish'
               ));
			if ( ! $posts) :
				$post_id = wp_insert_post(
					array(
						'comment_status'   => 'closed',
						'ping_status'      => 'closed',
						'post_author'      => $init_post['author_id'],
						'post_name'        => $init_post['slug'],
						'post_title'       => $init_post['title'],
						'post_status'      => 'publish',
						'post_type'        => 'homepage_section',
						'menu_order'       => $init_post['menu_order']
					)
				);
			if( '2-column-no-header-image-side-1' == $init_post['slug'] || '2-column-no-header-image-side-2' == $init_post['slug']){
				update_post_meta($post_id, "_template_type", '2-column-no-header-image-side');
			} else {
				update_post_meta($post_id, "_template_type", $init_post['slug']);
            }

			endif;
		endforeach;

	}

	public function omni_wp_theme_add_template_select_meta_box() {
		add_meta_box(
				'omni_hp_section_templates',
					__('Select Section Template', OMNI_TXT_DOMAIN),
					array($this, 'omni_wp_theme_hp_section_render_template_select'),
			'homepage_section',
			'side',
			'default'
		);
	}

	public function omni_wp_theme_hp_section_render_template_select($post) {

		$choices = OmniOptions::omni_wp_theme_get_home_sections_options();
//		p($choices);
		echo '<input type="hidden" name="template_type_nonce" id="template_type_nonce" value="' .
		     wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
		// p($post->ID);
		// p(get_post_meta($post->ID, "_template_type", true));
		?>
			<select id="_template_type" name="_template_type">
				<?php
				foreach ($choices as $key => $choice) :

					$value = get_post_meta($post->ID, "_template_type", true);
					if ( $value == $key ) :
					?>
						<option selected value="<?php echo $key; ?>"><?php echo $choice['label']; ?></option>
					<?php else : ?>
						<option value="<?php echo $key; ?>"><?php echo $choice['label']; ?></option>
				<?php endif; endforeach; ?>
			</select>
	<?php }

	public function omni_wp_theme_hp_section_template_save($post_id) {

		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ 'template_type_nonce'] ) && wp_verify_nonce( $_POST['template_type_nonce'], basename( __FILE__ ) ) ) ? 'true' : 'false';

		// Exits script depending on save status
		if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
			return;
		}

		$template_type = '';
		if(isset($_POST["_template_type"])) {
			$template_type = $_POST["_template_type"];
		}
		update_post_meta($post_id, "_template_type", $template_type);

	}

	public function omni_wp_theme_ajax_update_post_menu_order() {
	    global $wpdb;
        $post = get_post($_POST['post_id']);
		//echo $post->post_name . ' - ' . $post->menu_order;

        $menu_order = $_POST['menu_order'];

        $wpdb->update($wpdb->posts, array( 'menu_order' => $menu_order), array('ID' => $post->ID));

		die();
    }

}
$omni_homepage_section_post_type = new OmniHomepageSectionPostType();