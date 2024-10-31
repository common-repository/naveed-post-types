<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'NPT_Fields' ) ) :

	class NPT_Fields extends NPT_Field_Wrap {

		/**
		 * Return a text input.
		 *
		 * @param array $args Arguments to use with the text input.
		 *
		 * @return string Complete text `<input>` with proper attributes.
		 * @since 1.0.0
		 */
		public function get_text_field( $args = array() ) {
			$defaults = $this->get_default_input_parameters(
				array(
					'type' => ''
				)
			);
			$args     = wp_parse_args( $args, $defaults );

			$value = '';
			if ( $args['wrap'] ) {
				$value .= $this->get_container_start( 'npt-field-wrap' );
				$value .= $this->get_container_start( 'npt-label' );
				$value .= $this->get_label( $args['name'], $args['label'] );
				if ( $args['required'] ) {
					$value .= $this->get_required();
				}
				if ( $args['label_description'] ) {
					$value .= $this->get_label_description( $args['label_description'] );
				}
				$value .= $this->get_container_end();
				$value .= $this->get_container_start( 'npt-field' );
			}
			$value .= '<input type="' . $args['type'] . '" id="' . $args['id'] . '" name="' . $args['name'] . '" value="' .
			          $args['value']
			          . '"';
			if ( $args['maxlength'] ) {
				$value .= $this->get_maxlength( $args['maxlength'] );
			}
			if ( $args['placeholder'] ) {
				$value .= $this->get_placeholder( $args['placeholder'] );
			}
			$value .= $this->get_required_attribute( $args['required'] );
			if ( ! empty( $args['data'] ) ) {
				foreach ( $args['data'] as $data_key => $data_value ) {
					$value .= 'data-' . $data_key . '="' . $data_value . '"';
				}
			}
			$value .= ' />';
			if ( $args['field_description'] ) {
				$value .= $this->get_field_description( $args['field_description'] );
			}
			if ( $args['alert'] ) {
				$value .= $this->get_alert( $args['alert'] );
			}
			if ( $args['wrap'] ) {
				$value .= $this->get_container_end();
				$value .= $this->get_container_end();
			}

			return $value;
		}

		/**
		 * Return a text input.
		 *
		 * @param array $args Arguments to use with the text input.
		 *
		 * @return string Complete text `<input>` with proper attributes.
		 * @since 1.0.0
		 */
		public function get_textarea_field( $args = array() ) {
			$defaults = $this->get_default_input_parameters(
				array(
					'rows' => '',
					'cols' => '',
				)
			);
			$args     = wp_parse_args( $args, $defaults );

			$value = '';
			if ( $args['wrap'] ) {

				$value .= $this->get_container_start( 'npt-field-wrap' );
				$value .= $this->get_container_start( 'npt-label' );
				$value .= $this->get_label( $args['name'], $args['label'] );
				if ( $args['required'] ) {
					$value .= $this->get_required();
				}
				if ( $args['label_description'] ) {
					$value .= $this->get_label_description( $args['label_description'] );
				}
				if ( $args['alert'] ) {
					$value .= $this->get_alert( $args['alert'] );
				}
				$value .= $this->get_container_end();
				$value .= $this->get_container_start( 'npt-field' );
			}
			$value .= $this->get_container_start( 'text-area' );
			$value .= '<textarea id="' . $args['id'] . '" name="' . $args['name'] . '" rows="' . $args['rows'] . '" cols="' . $args['cols'] . '">' . $args['value'] . '</textarea>';
			if ( $args['field_description'] ) {
				$value .= $this->get_field_description( $args['field_description'] );
			}
			$value .= $this->get_container_end();
			if ( $args['wrap'] ) {
				$value .= $this->get_container_end();
				$value .= $this->get_container_end();
			}

			return $value;
		}

		/**
		 * Return a text input.
		 *
		 * @param array $args Arguments to use with the text input.
		 *
		 * @return string Complete text `<input>` with proper attributes.
		 * @since 1.0.0
		 */
		public function get_radio_field( $args = array() ) {
			$defaults = $this->get_default_input_parameters(
				array(
					'wrap' => '',
				)
			);
			$args     = wp_parse_args( $args, $defaults );
			$arr      = new NPT_SVG_Icons();

			$icons = $arr::$icons;

			$value = '';
			if ( $args['wrap'] == true ) {

				$value .= $this->get_container_start( 'npt-field-wrap' );
				$value .= $this->get_container_start( 'npt-label' );
				$value .= $this->get_label( $args['name'], $args['label'] );
				if ( $args['label_description'] ) {
					$value .= $this->get_label_description( $args['label_description'] );
				}
				$value .= $this->get_container_end();
				$value .= $this->get_container_start( 'npt-field icon-button' );
				$value .= $this->get_container_start( 'menu-icon' );
				$value .= $this->get_icon( $args['value'], 'icon-url' );
				$value .= $this->get_container_start( 'icon-div' );
				if ( $args['value'] ) {
					$value .= $this->get_link( 'Change Icon', '#', 'button-text' );
				} else {
					$value .= $this->get_link( 'Select Icon', '#', 'button-text' );
				}
				$value .= $this->get_container_end();

				$value .= $this->get_container_end();
				if ( $args['field_description'] ) {
					$value .= $this->get_field_description( $args['field_description'] );
				}
			}
			$value .= $this->get_container_start( 'section-icon hide-icon-section' );
			$value .= $this->get_container_start( 'table-icon' );
			foreach ( $icons as $key => $icon ) {
				$checked = ( $args['value'] == $key ) ? 'checked' : '';
				$value   .= $this->get_container_start( 'menu-icons' );
				$value   .= '<input type="radio" class="' . $args['class'] . '" id ="' . $key . '" name="' . $args['name'] . '" value="' .
				            $key . '" ' . $checked . '>';
				$value   .= $this->get_icon_label( $key, get_npt_svg_icon( $key, 25, '#1d2327' ) );
				$value   .= $this->get_container_end();
			}
			if ( $args['wrap'] ) {
				$value .= $this->get_container_end();
				$value .= $this->get_container_end();
				$value .= $this->get_container_end();
				$value .= $this->get_container_end();
			}

			return $value;
		}

		/**
		 * Return a text input.
		 *
		 * @param array $args Arguments to use with the text input.
		 *
		 * @return string Complete text `<input>` with proper attributes.
		 * @since 1.0.0
		 */
		public function get_list_field( $args = array() ) {
			$defaults = $this->get_default_input_parameters(
				array(
					'wrap' => '',
				)
			);
			$args     = wp_parse_args( $args, $defaults );
			$value    = '';
			if ( $args['wrap'] == true ) {

				$value .= $this->get_container_start( 'npt-field-wrap' );
				$value .= $this->get_container_start( 'npt-label' );
				$value .= $this->get_label( $args['name'], $args['label'] );
				if ( $args['label_description'] ) {
					$value .= $this->get_label_description( $args['label_description'] );
				}
				$value .= $this->get_container_end();
				$value .= $this->get_container_start( 'npt-field' );


			}
			$value .= '<ul>';
			foreach ( $args['options'] as $val ) {
				$value .= '<li class="npt-tax-label">' . $val['label'] . '<a class = "npt-tax-link" href="' . $val['link'] . '">Edit</a></li>';

			}
			$value .= '</ul>';
			if ( $args['field_description'] ) {
				$value .= $this->get_field_description( $args['field_description'] );
			}
			if ( $args['wrap'] ) {
				$value .= $this->get_container_end();
				$value .= $this->get_container_end();
			}

			return $value;
		}

		/**
		 * Return a populated `<select>` input.
		 *
		 * @param array $args Arguments to use with the `<select>` input.
		 *
		 * @return string $value Complete <select> input with options and selected attribute.
		 * @since 1.0.0
		 */
		public function get_select_field( $args = array() ) {
			$defaults = $this->get_default_input_parameters(
				array( 'options' => array() )
			);
			$args     = wp_parse_args( $args, $defaults );
			$value    = '';
			if ( $args['wrap'] ) {
				$value .= $this->get_container_start( 'npt-field-wrap' );
				$value .= $this->get_container_start( 'npt-label' );
				$value .= $this->get_label( $args['name'], $args['label'] );
				if ( $args['label_description'] ) {
					$value .= $this->get_label_description( $args['label_description'] );
				}
				$value .= $this->get_container_end();
				$value .= $this->get_container_start( 'npt-field' );
			}
			$value .= '<select id="' . $args['id'] . '" name="' . $args['name'] . '">';
			if ( ! empty( $args['options'] ) && is_array( $args['options'] ) ) {
				foreach ( $args['options'] as $val ) {
					$selected = '';
					if ( array_key_exists( 'default', $val ) && $val['default'] ) {
						$selected = 'selected="selected"';
					}
					if ( $args['value'] ) {
						$selected = 'selected="selected"';
					}
					$value .= '<option value="' . $val['option'] . '" ' . $selected . ' >' . $val['text'] . '</option>';
				}
				$value .= '</select>';
			}
			if ( $args['field_description'] ) {
				$value .= $this->get_field_description( $args['field_description'] );
			}

			if ( $args['wrap'] ) {
				$value .= $this->get_container_end();
				$value .= $this->get_container_end();
			}

			return $value;
		}

		/**
		 * Return a checkbox `<input>`.
		 *
		 * @param array $args Arguments to use with the checkbox input.
		 *
		 * @return string $value Complete checkbox `<input>` with proper attributes.
		 * @since 1.0.0
		 */
		public function get_checkbox_field( $args = array() ) {
			$defaults = $this->get_default_input_parameters(
				array(
					'value'   => '',
					'default' => false,
				)
			);
			$args     = wp_parse_args( $args, $defaults );
			$value    = '';

			if ( $args['wrap'] ) {
				$value .= $this->get_container_start( 'npt-field-wrap' );
				$value .= $this->get_container_start( 'npt-label' );
				$value .= $this->get_label( $args['name'], $args['label'] );
				if ( $args['required'] ) {
					$value .= $this->get_required();
				}
				if ( $args['label_description'] ) {
					$value .= $this->get_label_description( $args['label_description'] );
				}
				if ( $args['alert'] ) {
					$value .= $this->get_alert( $args['alert'] );
				}
				$value .= $this->get_container_end();
				$value .= $this->get_container_start( 'npt-field' );
				$value .= $this->get_container_start( 'checkboxes' );
			}
			foreach ( $args['options'] as $val ) {
				$value .= $this->get_container_start( 'checkbox' );
				if ( isset( $val['checked'] ) && $val['value'] !== $val['checked'] && ! $val['default'] ) {
					$value .= '<input type="checkbox" id="' . $val['id'] . '" name="' . $val['name'] . '" value="' . $val['value'] . '"/>';
				} else {
					$value .= '<input type="checkbox" id="' . $val['id'] . '" name="' . $val['name'] . '" value="' . $val['value'] . '" checked="checked"/>';
				}

				$value .= $this->get_label( $val['id'], $val['label'] );
				$value .= $this->get_container_end();
			}
			$value .= $this->get_container_end();
			if ( $args['field_description'] ) {
				$value .= $this->get_field_description( $args['field_description'] );
			}
			if ( $args['wrap'] ) {
				$value .= $this->get_container_end();
				$value .= $this->get_container_end();
			}

			return $value;
		}

		/**
		 * Return a text input.
		 *
		 * @param array $args Arguments to use with the text input.
		 *
		 * @return string Complete text `<input>` with proper attributes.
		 * @since 1.0.0
		 */
		public function get_button_field( $args = array() ) {
			$defaults = $this->get_default_input_parameters(
				array(
					'type' => '',
				)
			);
			$args     = wp_parse_args( $args, $defaults );

			$value = '';
			if ( $args['wrap'] ) {
				$value .= $this->get_container_start( 'npt-field-wrap' );
				$value .= $this->get_container_start( 'npt-label' );
				$value .= $this->get_label( $args['name'], $args['label'] );
				if ( $args['label_description'] ) {
					$value .= $this->get_label_description( $args['label_description'] );
				}
				$value .= $this->get_container_end();
				$value .= $this->get_container_start( 'npt-field' );
			}
			$value .= $this->get_container_start( 'button-div' );
			if ( ! empty( $args['buttons'] ) && is_array( $args['buttons'] ) ) {
				foreach ( $args['buttons'] as $val ) {
					$value .= $this->get_button( $val['label'], $val['href'], $val['id'] );
				}
			}
			$value .= $this->get_container_end();
			if ( $args['field_description'] ) {
				$value .= $this->get_field_description( $args['field_description'] );
			}
			if ( $args['wrap'] ) {
				$value .= $this->get_container_end();
				$value .= $this->get_container_end();
			}

			return $value;
		}
	}
endif;