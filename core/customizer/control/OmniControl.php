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

		$this->json()['value'] = $this->value();
		$this->json()['link']  = $this->get_link();
		$this->json()['id']    = $this->id;
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