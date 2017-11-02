<?php

class OmniCore {

	public static function omni_wp_theme_get_option( $key ) {
		$default_options = OmniDefault::omni_wp_theme_default_theme_options();

		if ( empty( $key ) ) {
			return null;
		}

		$theme_options = (array) get_theme_mod('theme_options');
		$theme_options = wp_parse_args( $theme_options, $default_options );

		$value = null;

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;
	}

	public static function omni_wp_theme_get_image_id_by_url( $image_url ) {
		global $wpdb;
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
		return $attachment[0];
	}

	public static function omni_wp_theme_return_responsive_image_set_with_lightbox( $image_url, $image_size = 'full',
		$lightbox_group_id = 'default-lightbox', $width = 'auto', $height = 'auto', $img_fluid = true ) {
		$image_id = self::omni_wp_theme_get_image_id_by_url($image_url);
		$image_size_url = wp_get_attachment_image_src($image_id, $image_size);
		$orig_image_url = wp_get_attachment_url($image_id);
		$image_srcset = wp_get_attachment_image_srcset($image_id, $image_size);

		$image = '<a data-lightbox="' . $lightbox_group_id . '" href="' . $orig_image_url . '">';
		if ($img_fluid) {
			$image .= '<img src="' . $image_size_url[0] . '" srcset="' . $image_srcset . '" class="img-fluid" width="' .$width.'" height="'.$height.'">';
		} else {
			$image .= '<img src="' . $image_size_url[0] . '" srcset="' . $image_srcset . '" width="' .$width.'" height="'.$height.'">';
		}
		$image .= '</a>';

		return $image;
	}
	public static function omni_wp_theme_return_responsive_image_set( $image_url, $image_size = 'full' ) {
		$image_id = self::omni_wp_theme_get_image_id_by_url($image_url);

		$image_size_url = wp_get_attachment_image_src($image_id, $image_size);
		$image_srcset = wp_get_attachment_image_srcset($image_id, $image_size);

		$image = '<img src="' . $image_size_url[0] . '" srcset="' . $image_srcset . '" class="img-fluid">';

		return $image;
	}

	public static function omni_wp_theme_echo_no_gutters( $key ) {
		$value = self::omni_wp_theme_get_option($key);
		if ($value == 'container-fluid') {
			return 'no-gutters';
		} else {
			return '';
		}
	}

	public static function omni_wp_theme_branding_image_or_color() {

		$type = self::omni_wp_theme_get_option('branding_bg_color_select');
		switch ($type) {
			case '-custom-image':
				$image = self::omni_wp_theme_get_option('branding_bg_image_upload');
				return 'style="background-image: url(\'' . $image . '\')"';
			case '-custom-color':
				$color = self::omni_wp_theme_get_option('branding_bg_color');
				return 'style="background-color: ' . $color . '"';
			default:
				return '';
		}

	}

	public static function omni_wp_theme_footer_image_or_color() {

		$type = self::omni_wp_theme_get_option('footer_bg_color_select');
		switch ($type) {
			case '-custom-image':
				$image = self::omni_wp_theme_get_option('footer_bg_image_upload');
				return 'style="background-image: url(\'' . $image . '\')"';
			case '-custom-color':
				$color = self::omni_wp_theme_get_option('footer_bg_color');
				return 'style="background-color: ' . $color . '"';
			default:
				return '';
		}

	}

	public static function omni_wp_theme_get_active_homepage_sections() {
		$output = array();

		$homepage_sections_raw = (array) self::omni_wp_theme_get_option('homepage_sections');
		// p($homepage_sections_raw);

		if( ! empty( $homepage_sections_raw ) ) {
			$default_sections = OmniOptions::omni_wp_theme_get_home_sections_options();
			// p($default_sections);
			foreach ($homepage_sections_raw as $key) {
				// p($key);
				if ( isset( $default_sections[$key] ) ) {
					$output[ $key ] = $default_sections[ $key ];
					$output[ $key ]['post_id'] = self::omni_wp_theme_get_post_id_by_slug($key);
				}
			}
		}
		// p($output);
		return $output;
	}

	public static function omni_wp_theme_get_post_id_by_slug( $slug ) {

		$args = array(
			'name'       => $slug,
			'post_type'  => 'homepage_section'
		);
		$posts = get_posts($args);
		return $posts[0]->ID;
	}

	public static function omni_wp_theme_render_meta_boxes($field_array, $stored_page_meta) {
		// p($stored_page_meta);

		$fields = '';

		foreach($field_array as $field_group) {
			$fields .= '<div class="inside">';
			$fields .= '<h2>' . $field_group['name'] . '</h2>';
			foreach($field_group['fields'] as $field) {
				$value = null;
				$choices = null;
				$enabled = '';
				$type = $field['type'];
				$name = $field['name'];
				$id = $field['id'];
				$label = $field['label'];
				$btn_id = null;
				$btn_text = __( 'Choose or Upload an Image', OMNI_TXT_DOMAIN);
				if(isset($field['btn_text']))
					$btn_text = $field['btn_text'];
				if(isset($field['btn_id']))
					$btn_id = $field['btn_id'];
				if(isset($field['choices']))
					$choices = $field['choices'];
				if('check' == $type || 'enable_opt_in' == $type) {
					$value = array();
					foreach ($choices as $key => $choice) {
						if(isset($stored_page_meta[$id.'_'.$key])) {
							$value[$id.'_'.$key] = $stored_page_meta[$id.'_'.$key][0];
						}
					}
				} else {
					if(isset($stored_page_meta[$id])) {
						$value = $stored_page_meta[$id];
					}
				}
				if(isset($field['target']))
					$target = $field['target'];
				if('opt_in_options' == $type) {
					if(isset($field['enabled'])) {
						$enabled = $field['enabled'];
					}
				}

				// p($value);
				$description = $field['description'];
				switch($type){
					case 'text':
						$fields .= '<div id="omni_admin_text_'. $name . '">';
						$fields .= '<label>' . $label . '</label>';
						$fields .= '<p><input type="' . $type . '" name="' . $name . '" id="' . $id . '" value="' . $value[0] . '" style="width: 100%" /></p>';
						$fields .= '</div>';
						break;
					case 'textarea':
						$fields .= '<div id="omni_admin_textarea_'. $name . '">';
						$fields .= '<label>' . $label . '</br><small>' . $description . '</small></label>';
						$fields .= '<p><textarea name="' . $name . '" id="' . $id . '" rows="4" style="width:100%">' . $value[0] . '</textarea></p>';
						$fields .= '</div>';
						break;
					case 'image':
						$fields .= '<div id="omni_admin_image_upload_'. $name . '">';
						$fields .= '<label>' . $label . '</label><br><small>' . $description . '</small>';
						$fields .= '<input type="text" name="' . $name . '" id="upload_image" value="' . $value[0] . '" style="width: 100%" /><br>';
						$fields .= '<input type="button" id="upload_image_button" class="button nrw_button" value="'. $btn_text .'"/></p>';
						$fields .= '</div>';
						break;
					case 'select':
						$fields .= '<div id="omni_admin_select_'. $name . '">';
						$fields .= '<label>' . $label . '</label><br><small>' . $description . '</small>';
						$fields .= '<p><select name="' . $name . '" id="' . $id . '" style="width: 150px">';
						$fields .= '<option>-- Select --</option>';
						foreach ($choices as $key => $choice) :
							if ($key == $value[0]) :
								$fields .= '<option value="'. $key . '" selected="selected">' . $choice . '</option>';
							else :
								$fields .= '<option value="'. $key . '">' . $choice . '</option>';
							endif;
						endforeach;
						$fields .= '</select></p>';
						$fields .= '</div>';
						break;
					case 'wp_editor':
						wp_editor( htmlspecialchars_decode($value[0]), $name, $settings = array
						('textarea_name'=>$name, 'wpautop' => false) );
						break;
					case 'radio':
						$fields .= '<div id="omni_admin_radio_'. $name . '">';
						$fields .= '<label>' . $label . '</label><br><small>' . $description . '</small>';
						foreach ($choices as $key => $choice) {
							if ( $value[0] == $key ) {
								$fields .= '<input type="radio" name="' . $name . '" value="' . $key . '" checked="checked">' . $choice . '<br>';
							} else {
								$fields .= '<input type="radio" name="' . $name . '" value="' . $key . '">' . $choice . '<br>';
							}
						}
						$fields .= '</div><br>';
						break;
					case 'check':
						$fields .= '<div id="omni_admin_checkbox_'. $name . '">';
						$fields .= '<label>' . $label . '</label><br><small>' . $description . '</small>';
						$count = 0;
						foreach ($choices as $key => $choice) {
							if ($value[$id.'_'.$key][0] == $key) {
								$fields .= '<input type="checkbox" name="' . $name . '_' . $key . '" value="' . $key . '" checked="checked">' . $choice . '<br>';
							} else {
								$fields .= '<input type="checkbox" name="' . $name . '_' . $key . '" value="' . $key . '">' . $choice . '<br>';
							}
							$count++;
						}
						$fields .= '</div><br>';
						break;
					case 'enable_opt_in':
						$fields .= '<div id="omni_admin_enable_opt_in_'. $name . '">';
						$fields .= '<label>' . $label . '</label><br><small>' . $description . '</small>';
						$count = 0;
						foreach ($choices as $key => $choice) {
							if ($value[$id.'_'.$key] == $key) {

								$fields .= '<input type="checkbox" name="' . $name . '_' . $key . '" value="' . $key
								           . '" checked="checked" data-target="#omni_admin_radio_'. $target . '">' .
								           $choice . '<br>';
							} else {
								$fields .= '<input type="checkbox" name="' . $name . '_' . $key . '" value="' . $key
								           . '" data-target="#omni_admin_radio_'. $target . '">' . $choice . '<br>';
							}
							$count++;
						}
						$fields .= '</div><br>';
						break;
					case 'opt_in_options':
						$hidden = '';
						$is_enabled = $stored_page_meta[$enabled];
						if('enable' != $is_enabled[0]) {
							$hidden = 'class="hidden"';
						}
						$fields .= '<div id="omni_admin_radio_'. $name . '" ' . $hidden . '>';
						$fields .= '<label>' . $label . '</label><br><small>' . $description . '</small>';
						foreach ($choices as $key => $choice) {
							if ( $value[0] == $key ) {
								$fields .= '<input type="radio" name="' . $name . '" value="' . $key . '" checked="checked">' . $choice . '<br>';
							} else {
								$fields .= '<input type="radio" name="' . $name . '" value="' . $key . '">' . $choice . '<br>';
							}
						}
						$fields .= '</div><br>';
						break;
				}
			}
			$fields .= '</div>';
		}
		return $fields;
	}

}