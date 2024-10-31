<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Plutus_MetaBox_Fields' ) ):
	class Plutus_MetaBox_Fields {

		public static $post_id = 0;
		public static $type = 'post';

		public static function html_field( $field, $post_id, $type = 'post' ) {
			$defaults = array(
				'id'          => '',
				'type'        => '',
				'name'        => '',
				'desc'        => '',
				'std'         => '',
				'placeholder' => '',
				'min'         => '',
				'max'         => '',
				'style'       => '',
				'options'     => array(),
			);

			self::$post_id = $post_id;
			self::$type    = $type;

			$field = wp_parse_args( $field, $defaults );

			if ( isset( $field['hidden'] ) ) {
				$hidden_value = self::get_value_input( $field['hidden'][0] );

				if( 'plutus_recipe_ingredients_type' == $field['hidden'][0] && ! $hidden_value && plutus_recipe_get_option( 'plutus_recipe_use_ricktext' )  ){
					$hidden_value = 'wysiwyg';
				}

				if ( $field['hidden'][1] == '==' && $hidden_value == $field['hidden'][2] ) {
					$field['style'] .= ' plutus-hidden';
				} elseif ( $field['hidden'][1] == '!=' && $hidden_value != $field['hidden'][2] ) {
					$field['style'] .= ' plutus-hidden';
				}
			}

			switch ( $field['type'] ) {
				case 'text':
					self::html_field_text( $field );
					break;
				case 'hidden':
					self::html_field_hidden( $field );
					break;
				case 'number':
					self::html_field_number( $field );
					break;
				case 'textarea':
					self::html_field_textarea( $field );
					break;
				case 'wysiwyg':
					self::html_field_wysiwyg( $field );
					break;
				case 'checkbox':
					self::html_field_checkbox( $field );
					break;
				case 'select':
					self::html_field_select( $field );
					break;
				case 'image_select':
					self::html_field_image_select( $field );
					break;
				case 'color':
					self::html_field_color( $field );
					break;
				case 'image':
					self::html_field_image( $field );
					break;
				case 'images':
					self::html_field_images( $field );
					break;
				case 'custom_html':
					self::html_field_custom_html( $field );
					break;
				case 'srart_accordion':
					self::html_field_srart_accordion( $field );
					break;
				case 'end_accordion':
					self::html_field_end_accordion( $field );
					break;
			}
		}

		private static function get_value_input( $field_id ) {
			$output = get_post_meta( self::$post_id, 'plutus_recipe_data', true );

			return isset( $output[ $field_id ] ) ? $output[ $field_id ] : '';
		}

		private static function html_field_text( $field ) {
			self::html_field_div_before( $field['id'], $field['style'] );

			if ( isset( $field['name'] ) && $field['name'] ) {
				echo '<div class="plutus-mb-labeldesc">';
				self::html_field_label( $field );
				echo '</div>';
			}
			echo '<div class="plutus-mb-input">';

			printf( '<input %s type="text" placeholder="%s" name="%s" id="%s" value="%s">',
				self::html_attr_input( $field ),
				isset( $field['placeholder'] ) ? $field['placeholder'] : '',
				$field['id'],
				$field['id'],
				self::get_value_input( $field['id'] )
			);

			self::html_field_desc( $field['desc'] );
			echo '</div>';

			self::html_field_div_after();
		}
		private static function html_field_hidden( $field ) {
			$value = self::get_value_input( $field['id'] );
			printf( '<input type="hidden" name="%s" id="%s" value="%s">',
				$field['id'],
				$field['id'],
				$value
			);
		}

		private static function html_field_number( $field ) {
			self::html_field_div_before( $field['id'], $field['style'] );

			echo '<div class="plutus-mb-labeldesc">';
			self::html_field_label( $field );
			echo '</div>';
			echo '<div class="plutus-mb-input">';
			printf( '<input %s type="number" name="%s" id="%s" value="%s">',
				self::html_attr_input( $field ),
				$field['id'],
				$field['id'],
				self::get_value_input( $field['id'] )
			);

			self::html_field_desc( $field['desc'] );
			echo '</div>';

			self::html_field_div_after();
		}

		private static function html_field_textarea( $field ) {
			self::html_field_div_before( $field['id'], $field['style'] );

			if ( isset( $field['name'] ) && $field['name'] ) {
				echo '<div class="plutus-mb-labeldesc">';
				self::html_field_label( $field );
				self::html_field_desc( $field['desc'] );
				echo '</div>';
			}

			echo '<div class="plutus-mb-input">';

			printf( '<textarea %s name="%s" id="%s" placeholder="%s">%s</textarea>',
				self::html_attr_input( $field ),
				$field['id'],
				$field['id'],
				$field['placeholder'],
				self::get_value_input( $field['id'] )
			);
			echo '</div>';

			self::html_field_div_after();
		}

		private static function html_field_wysiwyg( $field ) {
			echo '<div class="plutus-metabox-row ' . esc_attr( $field['id'] ) . ( $field['style'] ? ' ' . $field['style'] : '' ) . '">';

			if ( isset( $field['name'] ) && $field['name'] ) {
				echo '<div class="plutus-mb-labeldesc">';
				self::html_field_label( $field );
				self::html_field_desc( $field['desc'] );
				echo '</div>';
			}

			echo '<div class="plutus-mb-input">';

			$content = self::get_value_input( $field['id'] );

			$field['options']['textarea_name'] = $field['id'];
			$field['options']['dfw']           = isset( $field['1'] ) ? $field['1'] : '';

			if ( ! isset( $field['options']['editor_height'] ) ) {
				$field['options']['editor_height'] = '250';
			}

			if ( isset(  $field['options']['textarea_rows'] ) &&  $field['options']['textarea_rows'] ) {
				$field['options']['textarea_rows'] = '10';
			}

			wp_editor( $content, $field['id'], $field['options'] );

			echo '</div>';

			self::html_field_div_after();
		}

		private static function html_field_checkbox( $field ) {
			self::html_field_div_before( $field['id'], $field['style'] );

			echo '<div class="plutus-mb-labeldesc">';
			self::html_field_label( $field );
			echo '</div>';
			echo '<div class="plutus-mb-input">';

			$selected = self::get_value_input( $field['id'] );

			printf( '<input %s name="%s" id="%s"  type="checkbox" %s value="1">',
				self::html_attr_input( $field ),
				$field['id'],
				$field['id'],
				checked( $selected, 1, false )
			);
			self::html_field_desc( $field['desc'] );
			echo '</div>';

			self::html_field_div_after();
		}

		private static function html_field_select( $field ) {
			self::html_field_div_before( $field['id'], $field['style'] );

			echo '<div class="plutus-mb-labeldesc">';
			self::html_field_label( $field );

			echo '</div>';
			echo '<div class="plutus-mb-input">';
			printf( '<select %s name="%s" id="%s">%s',
				self::html_attr_input( $field ),
				$field['id'],
				$field['id'],
				''
			);
			$options  = $field['options'];
			$selected = self::get_value_input( $field['id'] );

			foreach ( (array) $options as $param_name => $param_value ) {
				?>
				<option value="<?php echo esc_attr( $param_name ); ?>" <?php selected( $selected, $param_name, true ); ?>><?php echo esc_html( $param_value ); ?></option><?php
			}
			echo '</select>';
			self::html_field_desc( $field['desc'] );

			echo '</div>';

			self::html_field_div_after();
		}

		private static function html_field_image_select( $field ) {
			self::html_field_div_before( $field['id'], $field['style'] );

			echo '<div class="plutus-mb-labeldesc">';
			self::html_field_label( $field );
			self::html_field_desc( $field['desc'] );
			echo '</div>';
			echo '<div class="plutus-mb-input">';

			$value_current = self::get_value_input( $field['id'] );

			if ( ! $value_current && $field['std'] ) {
				$value_current = $field['std'];
			}

			echo '<div class="plutus-image-select-wrap">';
			$options = $field['options'];
			$tpl     = '<label class="plutus-image-select"><img src="%s"><input type="%s" %s class="plutus-image_select" name="%s" value="%s"%s></label>';

			$value_current = (array) $value_current;
			foreach ( (array) $options as $value => $image ) {
				printf(
					$tpl,
					$image,
					'radio',
					self::html_attr_input( $field ),
					$field['id'],
					$value,
					checked( in_array( $value, $value_current ), true, false )
				);
			}
			echo '</div>';
			echo '</div>';

			self::html_field_div_after();
		}

		private static function html_field_color( $field ) {
			self::html_field_div_before( $field['id'], $field['style'] );

			echo '<div class="plutus-mb-labeldesc">';
			self::html_field_label( $field );
			echo '</div>';
			echo '<div class="plutus-mb-input">';

			printf( '<input class="plutus-color-picker" type="text" %s name="%s" id="%s" value="%s">',
				self::html_attr_input( $field ),
				$field['id'],
				$field['id'],
				self::get_value_input( $field['id'] )
			);
			self::html_field_desc( $field['desc'] );
			echo '</div>';

			self::html_field_div_after();
		}

		private static function html_field_image( $field ) {
			self::html_field_div_before( $field['id'], $field['style'] );

			echo '<div class="plutus-mb-labeldesc">';
			self::html_field_label( $field );
			self::html_field_desc( $field['desc'] );
			echo '</div>';

			$img_id = self::get_value_input( $field['id'] );
			$url    = wp_get_attachment_thumb_url( $img_id );
			?>
			<div class="plutus-mb-input plutus-widget-image media-widget-control">
				<input name="<?php echo esc_attr( $field['id'] ); ?>" type="hidden" class="plutus-widget-image__input" value="<?php echo esc_attr( $img_id ); ?>">
				<img src="<?php echo esc_url( $url ); ?>" class="plutus-widget-image__image<?php echo esc_attr( $img_id ? '' : ' hidden' ); ?>">
				<div class="placeholder <?php echo esc_attr( $url ? 'hidden' : '' ); ?>"><?php _e( 'No image selected', 'plutus-recipe-pro' ); ?></div>
				<button class="button plutus-widget-image__select"><?php esc_html_e( 'Select', 'plutus-recipe-pro' ); ?></button>
				<button class="button plutus-widget-image__remove"><?php esc_html_e( 'Remove', 'plutus-recipe-pro' ); ?></button>
			</div>
			<?php
			self::html_field_div_after();
		}

		private static function html_field_images( $field ) {
			self::html_field_div_before( $field['id'], $field['style'] );

			echo '<div class="plutus-mb-labeldesc">';
			self::html_field_label( $field );
			self::html_field_desc( $field['desc'] );
			echo '</div>';

			$img_ids = self::get_value_input( $field['id'] );

			echo '<div class="plutus-mb-input plutus-widget-images media-widget-control">';
			echo '<ul class="plutus-images-list" data-fieldid ="' . $field['id'] . '">';
			if ( $img_ids ) {
				foreach ( (array) $img_ids as $img_id_key => $img_id ) {
					$url = wp_get_attachment_thumb_url( $img_id );

					if ( ! $url ) {
						continue;
					}

					echo '<li>';
					echo '<input type="hidden" name="' . $field['id'] . '[' . $img_id_key . ']" value="' . esc_attr( $img_id ) . '">';
					echo '<img class="image-preview" src="' . $url . '">';
					echo '<div class="actions"><a href="#" class="remove-image delete" data-fieldid ="' . $field['id'] . '"><span class="dashicons dashicons-no-alt"></span></a></div>';
					echo '</li>';
				}
			}
			echo '</ul>';
			echo '<a class="plutus-add-images button" href="#" data-fieldid ="' . $field['id'] . '" data-uploader-title="' . esc_html__( 'Add image(s)', 'plutus-recipe-pro' ) . '" data-uploader-button-text="' . esc_html__( 'Add image(s)', PLUTUS_RECIPE_PRO ) . '">' . esc_html__( 'Add image(s)', PLUTUS_RECIPE_PRO ) . '</a>';
			echo '</div>'; // end plutus-widget-images

			self::html_field_div_after();
		}

		private static function html_field_custom_html( $field ) {
			echo '<div class="plutus-metabox-row">';
			echo wp_kses_post( $field['std'] );
			self::html_field_div_after();
		}

		private static function html_field_srart_accordion( $field ) {
			echo '<div class="plutus-accordion-name ' . $field['std'] . '"><h3>' . $field['name'] . '</h3><span class="handle-repeater"></span></div>';
			echo '<div class="plutus-panel-accordion">';
		}

		private static function html_field_end_accordion( $field ) {
			echo '</div>';
		}

		private static function html_field_div_before( $field_id, $style ) {
			echo '<div id="' . esc_attr( $field_id ) . '" class="plutus-metabox-row ' . esc_attr( $field_id ) . ( $style ? ' ' . $style : $style ) . '">';
		}

		private static function html_field_div_after() {
			echo '</div>';
		}

		private static function html_field_label( $field ) {
			echo '<label for="' . esc_attr( $field['id'] ) . '" class="plutus-metabox-label ' . esc_attr( $field['id'] ) . 'label">' . esc_attr( $field['name'] ) . '</label>';
		}

		private static function html_field_desc( $desc ) {
			echo '<span class="plutus-metabox-desc">' . $desc . '</span>';
		}

		private static function html_attr_input( $field ) {
			$html  = '';
			$attrs = isset( $field['attrs'] ) ? $field['attrs'] : array();
			foreach ( (array) $attrs as $attr_key => $attr_value ) {
				$html .= ' ' . $attr_key . '="' . $attr_value . '"';
			}

			return $html;
		}


	}
endif;