<?php

class OmniHomepageOption {

	private $default = null;

	private $sections = null;

	public function __construct() {
		$this->default = OmniDefault::omni_wp_theme_default_theme_options();
		$this->sections = OmniCore::omni_wp_theme_get_option('num_of_homepage_sections');
		$this->omni_wp_theme_add_homepage_options();
	}

	public function omni_wp_theme_add_homepage_options() {
		global $wp_customize;
		// Add Panel.
		$wp_customize->add_panel( 'homepage_option_panel',
			array(
				'title'      => __( 'Homepage Sections', OMNI_TXT_DOMAIN ),
				'priority'   => 100,
				'capability' => 'edit_theme_options',
			)
		);

		// Homepage Options
		$wp_customize->add_section( 'manage_sections' ,
			array(
				'title' => __('Manage Sections', OMNI_TXT_DOMAIN),
				'priority' => 100,
				'capability' => 'edit_theme_options',
				'panel' => 'homepage_option_panel'
			)
		);

		// Setting homepage_sections.
		$wp_customize->add_setting( 'theme_options[homepage_sections]',
			array(
				'default'           => $this->default['homepage_sections'],
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => array( 'OmniSanitize', 'omni_wp_theme_sanitize_homepage_sections'),
			)
		);
		$wp_customize->add_control(
			new Omni_Homepage_Section_Manager_Control(
				$wp_customize,
				'theme_options[homepage_sections]',
				array(
					'label'    => __( 'Reorder/toggle sections', OMNI_TXT_DOMAIN ),
					'section'  => 'manage_sections',
					'settings' => 'theme_options[homepage_sections]',
					'priority' => 100,
					'choices'  => OmniOptions::omni_wp_theme_get_home_section_posts(),
				)
			)
		);

		// Homepage Options
		$wp_customize->add_section( 'section_homepage' ,
			array(
				'title' => __('Homepage Options', OMNI_TXT_DOMAIN),
				'priority' => 100,
				'capability' => 'edit_theme_options',
				'panel' => 'homepage_option_panel'
			)
		);

		// Number of homepage sections
		$wp_customize->add_setting( 'theme_options[num_of_homepage_sections]',
			array(
			    'default'     => $this->default['num_of_homepage_sections'],
			    'capability'  => 'edit_theme_options',
			    'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control( 'theme_options[num_of_homepage_sections]',
			array(
			    'label'    => __( 'Number of Sections (Not Including Jumbotron)', OMNI_TXT_DOMAIN ),
			    'section'  => 'section_homepage',
			    'type'     => 'number',
			    'priority' => 100
			)
		);

//		for ( $i = 0; $i < $this->sections; $i++) {
//			$count = $i + 1;
//			$wp_customize->add_section( 'section_homepage_' . $count ,
//				array(
//					'title' => __('Home Section ' . $count, OMNI_TXT_DOMAIN),
//					'priority' => 100,
//					'capability' => 'edit_theme_options',
//					'panel' => 'homepage_option_panel'
//				)
//			);
//
//			// Section Background Width
//			$wp_customize->add_setting( 'theme_options[hp_section_bg_width_'. $count . ']',
//				array(
//					'default'     => 'container',
//					'capability'  => 'edit_theme_options',
//					'sanitize_callback' => array('OmniSanitize', 'omni_wp_theme_sanitize_select')
//				)
//			);
//			$wp_customize->add_control( 'theme_options[hp_section_bg_width_'. $count . ']',
//				array(
//					'label'    => __( 'Section Background Width', OMNI_TXT_DOMAIN ),
//					'section'  => 'section_homepage_' . $count,
//					'type'     => 'select',
//					'choices'  => OmniOptions::omni_wp_theme_get_primary_menu_width_options(),
//					'priority' => 100
//				)
//			);
//			// Section Background Width
//			$wp_customize->add_setting( 'theme_options[hp_content_width_'. $count . ']',
//				array(
//					'default'     => 'container',
//					'capability'  => 'edit_theme_options',
//					'sanitize_callback' => array('OmniSanitize', 'omni_wp_theme_sanitize_select')
//				)
//			);
//			$wp_customize->add_control( 'theme_options[hp_content_width_'. $count . ']',
//				array(
//					'label'    => __( 'Section Content Width', OMNI_TXT_DOMAIN ),
//					'section'  => 'section_homepage_' . $count,
//					'type'     => 'select',
//					'choices'  => OmniOptions::omni_wp_theme_get_primary_menu_width_options(),
//					'priority' => 100
//				)
//			);
//
//			// Section Background Color Select
//			$wp_customize->add_setting( 'theme_options[hp_section_bg_color_select_' . $count . ']',
//				array(
//					'default'     => $this->default['hp_section_bg_color'],
//					'capability'  => 'edit_theme_options',
//					'sanitize_callback' => array('OmniSanitize', 'omni_wp_theme_sanitize_select')
//				)
//			);
//			$wp_customize->add_control( 'theme_options[hp_section_bg_color_select_' . $count . ']',
//				array(
//					'label'    => __( 'Section Background', OMNI_TXT_DOMAIN ),
//					'section'  => 'section_homepage_' . $count,
//					'type'     => 'select',
//					'choices'  => OmniOptions::omni_wp_theme_get_bg_color_options(),
//					'priority' => 100
//				)
//			);
//			// Section Background Image Upload
//			$wp_customize->add_setting( 'theme_options[hp_section_bg_image_upload_' . $count . ']',
//				array(
//					'default'     => '',
//					'capability'  => 'edit_theme_options',
//					'sanitize_callback' => 'esc_attr'
//				)
//			);
//			$wp_customize->add_control(
//				new Omni_Homepage_Section_Background_Image_Control(
//					$wp_customize,
//					'theme_options[hp_section_bg_image_upload_' . $count . ']',
//					array(
//						'label'      => __( 'Section Background Image', OMNI_TXT_DOMAIN ),
//						'section'  => 'section_homepage_' . $count,
//						'settings'   => 'theme_options[hp_section_bg_image_upload_' . $count . ']',
//						'priority'   => 100,
//						'parent_check' => 'hp_section_bg_color_select_' . $count
//					)
//				)
//			);
//
//			// Section Background Color
//			$wp_customize->add_setting( 'theme_options[hp_section_bg_color_' . $count .']',
//				array(
//					'default'           => '#fff',
//					'capability'        => 'edit_theme_options',
//					'sanitize_callback' => 'esc_attr',
//				)
//			);
//			$wp_customize->add_control(
//				new Omni_Homepage_Section_Background_Color_Control( $wp_customize, 'theme_options[hp_section_bg_color_' . $count .']',
//					array(
//						'label'    => __( 'Section Background Custom Color', OMNI_TXT_DOMAIN),
//						'section'  => 'section_homepage_' . $count,
//						'settings' => 'theme_options[hp_section_bg_color_' . $count .']',
//						'priority'   => 100,
//						'parent_check' => 'hp_section_bg_color_select_' . $count
//					)
//				)
//			);
//
//			// Rows in section
//			$wp_customize->add_setting('theme_options[hp_section_rows_' . $count . ']',
//				array(
//					'default'       => 1,
//					'capability'        => 'edit_theme_options',
//					'sanitize_callback' => 'absint',
//				)
//			);
//			$wp_customize->add_control( 'theme_options[hp_section_rows_' . $count . ']',
//				array(
//					'label'    => __( 'Number of Rows', OMNI_TXT_DOMAIN ),
//					'section'  => 'section_homepage_' . $count,
//					'type'     => 'number',
//					'priority' => 100
//				)
//			);
//
//		}
	}
}
$omni_homepage_option = new OmniHomepageOption();