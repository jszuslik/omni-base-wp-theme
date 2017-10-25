<?php

class OmniHomepageSectionHook {

	public function __construct() {
		add_action('omni_wp_theme_action_homepage_sections', array($this, 'omni_wp_theme_add_active_homepage_sections'), 1 );
	}

	public function omni_wp_theme_add_active_homepage_sections() {
		global $post;
		$orig_post = $post;
		$active_sections = OmniCore::omni_wp_theme_get_active_homepage_sections();
		// p($active_sections);

		if ( ! empty( $active_sections ) ) {
			echo '<div id="front-page-home-sections" class="widget-area">';
			foreach ( $active_sections as $section ) {
				$post = get_post($section['post_id']);
				get_template_part( $section['template'] );
			}
			echo '</div><!-- #front-page-home-sections -->';
		}

		$post = $orig_post;

	}

}
$omni_hompage_section_hook = new OmniHomepageSectionHook();