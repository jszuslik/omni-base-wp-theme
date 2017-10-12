<?php


class OmniOptions {
	
	public static function omni_theme_get_global_layout_options() {
		
		$choices = array(
			'left-sidebar'            => esc_html__( 'Primary Sidebar - Content', OMNI_TXT_DOMAIN ),
			'right-sidebar'           => esc_html__( 'Content - Primary Sidebar', OMNI_TXT_DOMAIN ),
			'three-columns'           => esc_html__( 'Three Columns ( Secondary - Content - Primary )', OMNI_TXT_DOMAIN ),
			'three-columns-pcs'       => esc_html__( 'Three Columns ( Primary - Content - Secondary )', OMNI_TXT_DOMAIN ),
			'three-columns-cps'       => esc_html__( 'Three Columns ( Content - Primary - Secondary )', OMNI_TXT_DOMAIN ),
			'three-columns-psc'       => esc_html__( 'Three Columns ( Primary - Secondary - Content )', OMNI_TXT_DOMAIN ),
			'three-columns-pcs-equal' => esc_html__( 'Three Columns ( Equal Primary - Content - Secondary )', OMNI_TXT_DOMAIN ),
			'three-columns-scp-equal' => esc_html__( 'Three Columns ( Equal Secondary - Content - Primary )', OMNI_TXT_DOMAIN ),
			'no-sidebar'              => esc_html__( 'No Sidebar', OMNI_TXT_DOMAIN ),
		);

		$output = apply_filters('omni_theme_filter_layout_options', $choices);
		return $output;
		
	}

}