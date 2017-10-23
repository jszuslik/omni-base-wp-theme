<?php
/**
 * Custom Customizer Controls.
 *
 * @package Omni_Theme
 */

if( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Customize Control for Heading.
 *
 * @since 0.0.1
 *
 * @see WP_Customize_Control
 */
class Omni_Heading_Control extends WP_Customize_Control {

	/**
	 * Control type
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'heading';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since 0.0.1
	 */
	public function to_json() {
		parent::to_json();

		$this->json['value'] = $this->value();
		$this->json['link']  = $this->get_link();
		$this->json['id']    = $this->id;
	}

	/**
	 * Content template.
	 *
	 * @since 0.0.1
	 */
	public function content_template() {
		?>
        <# if ( data.label ) { #>
            <h3><span class="customize-control-title">{{ data.label }}</span></h3>
            <# } #>
                <# if ( data.description ) { #>
                    <span class="description customize-control-description">{{ data.description }}</span>
                    <# } #>
		<?php
	}

	/**
	 * Render content.
	 *
	 * @since 0.0.1
	 */
	public function render_content() {}
}

class Omni_Dropdown_Taxonomies_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'dropdown-taxonomies';

	/**
	 * Taxonomy.
	 *
	 * @access public
	 * @var string
	 */
	public $taxonomy = '';

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    Optional. Arguments to override class property defaults.
	 */
	public function __construct( $manager, $id, $args = array() ) {

		$our_taxonomy = 'category';
		if ( isset( $args['taxonomy'] ) ) {
			$taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
			if ( true === $taxonomy_exist ) {
				$our_taxonomy = esc_attr( $args['taxonomy'] );
			}
		}
		$args['taxonomy'] = $our_taxonomy;

		$this->taxonomy = esc_attr( $our_taxonomy );

		$tax_args = array(
			'hierarchical' => 0,
			'taxonomy'     => $this->taxonomy,
		);
		// $all_taxonomies = get_categories( $tax_args );
        $all_taxonomies = get_categories($tax_args);

		$choices = array();
		$choices[0] = esc_html__( '&mdash; Select &mdash;', OMNI_TXT_DOMAIN );

		if ( ! empty( $all_taxonomies ) && ! is_wp_error( $all_taxonomies ) ) {
			foreach ( $all_taxonomies as $tax ) {
				$choices[ $tax->term_id ] = $tax->name;
			}
		}

		$this->choices = $choices;

		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since 1.0.0
	 */
	public function to_json() {
		parent::to_json();

		$this->json['choices'] = $this->choices;
		$this->json['link']    = $this->get_link();
		$this->json['value']   = $this->value();
		$this->json['id']      = $this->id;
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {

		wp_enqueue_style( 'omni-wp-theme-css-customize-controls' );
		wp_enqueue_script( 'omni-wp-theme-customize-controls' );

	}

	/**
	 * Content template.
	 *
	 * @since 1.0.0
	 */
	public function content_template() {
		?>
			<label>
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
			<select {{{ data.link }}} name="_customize-{{ data.type }}-{{ data.id }}" id="{{ data.id }}">
				<# _.each( data.choices, function( label, choice ) { #>

					<option value="{{ choice }}"
					<# if ( choice === data.value ) { #>
					    selected="selected"
					<# } #>>{{{ label }}}</option>
				<# } ) #>
			</select>
			</label>
		<?php
	}

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {}
}

class Omni_Header_Padding_Control extends WP_Customize_Control {

    /**
	 * Control type
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'header-padding';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since 0.0.1
	 */
	public function to_json() {
		parent::to_json();

		$this->json['value'] = $this->value();
		$this->json['link']  = $this->get_link();
		$this->json['id']    = $this->id;
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {

		wp_enqueue_style( 'omni-wp-theme-css-customize-controls' );
		wp_enqueue_script( 'omni-wp-theme-customize-controls' );

	}

	/**
	 * Content template.
	 *
	 * @since 1.0.0
	 */
	public function content_template() {
		?>
			<label>
			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
			<# } #>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>
			    <input type="number" id="{{ data.id }}" name="{{ data.id }}" value="{{data.value}}"
			    class="omni-header-padding-input">
			</label>
		<?php
	}

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {}

}

class Omni_Homepage_Section_Background_Color_Control extends WP_Customize_Color_Control {

    private $parent_check;



    /**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    Optional. Arguments to override class property defaults.
	 */
	public function __construct( $manager, $id, $args = array() ) {
	    if (key_exists('parent_check', $args)) {
	        $this->parent_check = $args['parent_check'];
	    }

	    parent::__construct( $manager, $id, $args );
	}

    public function enqueue() {
        parent::enqueue();
    }

    public function render_content() {}

    public function content_template() {
        parent::content_template();
    }

	function active_callback(){
        if(OmniCore::omni_wp_theme_get_option($this->parent_check) == '-custom-color') {
            return true;
        } else {
            return false;
        }
    }

}

class Omni_Homepage_Section_Background_Image_Control extends WP_Customize_Image_Control {

    private $parent_check;
    /**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    Optional. Arguments to override class property defaults.
	 */
	public function __construct( $manager, $id, $args = array() ) {
	    if (key_exists('parent_check', $args)) {
	        $this->parent_check = $args['parent_check'];
	    }

	    parent::__construct( $manager, $id, $args );
	}

	function active_callback(){
        if(OmniCore::omni_wp_theme_get_option($this->parent_check) == '-custom-image') {
            return true;
        } else {
            return false;
        }
    }
}

class Omni_Homepage_Section_Manager_Control extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'section-manager';

	/**
	 * Arguments.
	 *
	 * @access public
	 * @var array
	 */
	public $args = array();

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {

		wp_enqueue_style( 'omni-wp-theme-css-customize-controls' );
		wp_enqueue_script( 'omni-wp-theme-customize-controls' );

		wp_localize_script( 'omni-wp-theme-customize-controls', 'omni_update_menu_order', array(
		        'ajax_url' => admin_url('admin-ajax.php')
        ));

	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since 1.0.0
	 */
	public function to_json() {
	    //p($this->choices);
		parent::to_json();
		$this->json['value']   = ! is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value();
		$this->json['choices'] = $this->choices;
		$this->json['link']    = $this->get_link();
		$this->json['id']      = $this->id;
	}

	/**
	 * Content template.
	 *
	 * @since 1.0.0
	 */
	public function content_template() {
		?>
        <# if ( ! data.choices ) {
                return;
                } #>

            <# if ( data.label ) { #>
                <span class="customize-control-title">{{ data.label }}</span>
                <# } #>

                    <# if ( data.description ) { #>
                        <span class="description customize-control-description">{{{ data.description }}}</span>
                        <# } #>

                            <ul class="section-list">
                                <# _.each( data.choices, function( item, choice ) { #>
                                    <li>
                                        <label>
                                            <i class="dashicons dashicons-move"></i>
                                            <span>{{ item.label }}</span>
                                            <input type="checkbox" class="section-item-checkbox" value="{{ choice }}"
                                            data-order="{{ item.menu_order }}" data-post_id="{{ item.post_id }}" <#
                                                    if (
                                                    -1 !== data.value
                                                    .indexOf(
                                                    choice ) ) { #>
                                                checked="checked" <# } #> />
                                        </label>
                                    </li>
                                    <# } ) #>
                            </ul>
		<?php
	}

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {}

}