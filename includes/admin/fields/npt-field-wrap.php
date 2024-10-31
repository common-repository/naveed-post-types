<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'NPT_Field_Wrap' ) ) :

	class NPT_Field_Wrap {

		/**
		 * input field defaults parameters.
		 *
		 * @param array $defaults Arguments to use with the input.
		 *
		 * @return array input parameters.
		 * @since 1.0.0
		 */
		public function get_default_input_parameters( $defaults = array() ) {
			return array_merge(
				array(
					'label'             => '',
					'type'              => '',
					'name'              => '',
					'id'                => '',
					'class'             => '',
					'placeholder'       => '',
					'maxlength'         => '',
					'label_description' => '',
					'field_description' => '',
					'alert'             => '',
					'required'          => '',
					'wrap'              => '',
				),
				(array) $defaults
			);
		}

		/**
		 * @param $id
		 * @param $class
		 *
		 * @return string
		 */
		public function get_container_start( $class = '', $id = '' ) {
			$container_class = $class ? 'class="'.$class.'"' : '';
			$container_id = $id ? 'id="'.$id.'"' : '';
			return '<div ' . $container_class .' '. $container_id . '>';
		}

		/**
		 * @return string
		 */
		public function get_container_end() {
			return '</div>';
		}
		
		/**
		 * Return a placeholder attribute for a specified value.
		 *
		 * @param string $text Text to place in the placeholder attribute.
		 *
		 * @return string $value Placeholder attribute.
		 * @since 1.0.0
		 */
		public function get_placeholder( $text = '' ) {
			return 'placeholder="' . esc_attr( $text ) . '"';
		}
		
		/**
		 * Return <label> tag with for attribute and its value.
		 * @since 1.0.0
		 * @param string $label
		 * @param string $for
		 * @return string $value '<label>' tag with filled out parts.
		 */
		public function get_label( $for = '', $label = '' ) {
			return '<label for="' . esc_attr( $for ) . '">' . wp_strip_all_tags( $label ) . '</label>';
		}

		public function get_icon_label( $for = '', $label = '' ) {
			return '<label for="' . esc_attr( $for ) . '">' . $label . '</label>';
		}

		/**
		 * Return a '<span>' to indicate required status, with class attribute.
		 * @return string Span tag.
		 * @since 1.0.0
		 */
		public function get_required() {
			return ' <span class="required">*</span>';
		}

		/**
		 * Return a '<span>' to indicate alert message, with class and id attribute.
		 * @return string <span> tag.
		 * @since 1.0.0
		 */
		public function get_alert( $id = '', $class = '' ) {
			$container_class = $class ? 'class="'.$class.'"' : '';
			$container_id = $id ? 'id="'.$id.'"' : '';
			return ' <span ' . $container_class . ' ' . $container_id . '></span>';
		}

		/**
		 * Return a maxlength attribute with a specified length.
		 *
		 * @param string $length How many characters the max length should be set to.
		 *
		 * @return string $value Maxlength attribute.
		 * @since 1.0.0
		 */
		public function get_maxlength( $length = '' ) {
			return 'maxlength="' . esc_attr( $length ) . '"';
		}

		/**
		 * Return a '<small>' tag with description.
		 * @return string p tag.
		 * @since 1.0.0
		 */
		public function get_label_description( $text = '' ) {
			return '<p class="description">' . $text . '</p>';
		}

		/**
		 * Return a '<p>' tag with description.
		 * @return string p tag.
		 * @since 1.0.0
		 */
		public function get_field_description( $text = '' ) {
			return '<p class="description"><i>' . $text . '</i></p>';
		}

		/**
		 * Return a html attribute denoting a required field.
		 *
		 * @param bool $required Whether the field is required.
		 *
		 * @return string `Required` attribute.
		 * @since 1.0.0
		 */
		public function get_required_attribute( $required = false ) {
			$attr = '';
			if ( $required ) {
				$attr .= 'required="true"';
			}

			return $attr;
		}

		/**
		 * Display a '<img>' tag with icon attribute.
		 * @return string '<img>' tag with icon attribute.
		 * @since 1.0.0
		 */
		public function get_icon( $icon, $id = '' ) {
			$container_id = $id ? 'id="'.$id.'"' : '';
			return '<span ' . $container_id . '>' . get_npt_svg_icon( $icon, 30, '#1d2327' ) . '</span>';
		}

		/**
		 * @param $link_text
		 * @param $href
		 * @param $class
		 *
		 * @return string
		 */
		public function get_link( $link_text, $href, $class = '' ) {
			$container_class = $class ? 'class="'.$class.'"' : '';
			return '<a href="' . esc_attr( $href ) . '" ' . $container_class . '>' . esc_attr( $link_text ) . '</a>';
		}

		public function get_button( $link_text, $href, $id = '' ) {
			$container_id = $id ? 'id="'.$id.'"' : '';
			return '<a href="' . esc_attr( $href ) . '" ' . $container_id . '>' . esc_attr( $link_text ) . '</a>';
		}

	}
endif;