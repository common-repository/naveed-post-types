<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function npt_post_type_meta_box() {
	new NPT_Post_Type_Meta_Box();
}

add_action( 'load-post.php', 'npt_post_type_meta_box' );
add_action( 'load-post-new.php', 'npt_post_type_meta_box' );

if ( ! class_exists( 'NPT_Post_Type_Meta_Box' ) ) :

	class NPT_Post_Type_Meta_Box extends NPT_Post_Type_Form {

		public function __construct() {
			add_action( 'add_meta_boxes', array( $this, 'npt_add_meta_box' ) );
			add_action( 'save_post', array( $this, 'npt_save_post_type' ) );
		}

		/**
		 * @return void
		 */
		public function npt_add_meta_box() {
			add_meta_box(
				'npt-register-post-type-postbox',
				__( 'Register Post Type', 'npt' ),
				array( $this, 'render_register_meta_box_content' ),
				'npt-post-type',
				'advanced',
				'high'
			);
			add_meta_box(
				'npt-post-type-labels-postbox',
				__( 'Post Type Labels', 'npt' ),
				array( $this, 'render_labels_meta_box_content' ),
				'npt-post-type',
				'advanced',
				'high'
			);
			add_meta_box(
				'npt-post-type-arguments-postbox',
				__( 'Post Type Arguments', 'npt' ),
				array( $this, 'render_arguments_meta_box_content' ),
				'npt-post-type',
				'advanced',
				'high'
			);
			remove_meta_box(
				'slugdiv',
				'npt-post-type',
				'normal'
			);
		}


		/**
		 * @param $post_id
		 *
		 * @return void
		 */
		public function npt_save_post_type( $post_id ) {
			if ( ! isset( $_POST['npt-post-type-nonce'] ) ) {
				return $post_id;
			}

			$nonce = $_POST['npt-post-type-nonce'];

			if ( ! wp_verify_nonce( $nonce, 'npt-post-type' ) ) {
				return $post_id;
			}

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return $post_id;
			}

			if ( 'npt-post-type' == $_POST['post_type'] ) {
				$cap = npt_get_setting( 'capability' );
				if ( ! current_user_can( $cap, $post_id ) ) {
					return $post_id;
				}
			}
			if ( ! wp_is_post_revision( $post_id ) ) {
				$post_name  = isset( $_POST['slug'] ) ? sanitize_text_field( $_POST['slug'] ) : false;
				$post_title = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : false;
				global $wpdb;
				$where = array( 'ID' => $post_id );
				$wpdb->update( $wpdb->posts, array( 'post_name' => $post_name, 'post_title' => $post_title ), $where );

			}

			$register_metabox  = $this->get_post_type_register_fields();
			$labels_metabox    = $this->get_post_type_labels_fields();
			$arguments_metabox = $this->get_post_type_arguments_fields();

			$labels_array[]     = array_merge(
				npt_get_text_fields( $register_metabox, 'labels' ),
				npt_get_text_fields( $labels_metabox, 'labels' )
			);
			$labels_array_merge = call_user_func_array( 'array_merge', $labels_array );
			$labels_with_key[]  = array( 'labels' => $labels_array_merge );
			$labels             = call_user_func_array( 'array_merge', $labels_with_key );

			$arguments_array[] = array_merge(
				npt_get_text_fields( $register_metabox, 'arguments' ),
				npt_get_textarea_fields( $register_metabox, 'arguments' ),
				npt_get_radio_fields( $register_metabox, 'arguments' ),
				npt_get_text_fields( $arguments_metabox, 'arguments' ),
				npt_get_select_fields( $arguments_metabox, 'arguments' ),
				npt_get_checkbox_fields( $arguments_metabox, 'arguments', 'supports' ),
				npt_get_checkbox_fields( $arguments_metabox, 'arguments', 'taxonomies' ),
				$labels
			);
			$data              = call_user_func_array( 'array_merge', $arguments_array );

			update_post_meta( $post_id, 'npt_post_type', $data );
		}

		/**
		 * Render register meta box form
		 *
		 * @since   1.0.0
		 *
		 * @return void
		 */
		public function render_register_meta_box_content() {
			wp_nonce_field( 'npt-post-type', 'npt-post-type-nonce' );
			$this->register_post_type_form();
		}

		/**
		 * Render labels meta box form
		 *
		 * @since   1.0.0
		 *
		 * @return void
		 */
		public function render_labels_meta_box_content() {
			wp_nonce_field( 'npt-post-type', 'npt-post-type-nonce' );
			$this->post_type_labels_form();
		}

		/**
		 * Render arguments meta box form
		 *
		 * @since   1.0.0
		 *
		 * @return void
		 */
		public function render_arguments_meta_box_content() {
			wp_nonce_field( 'npt-post-type', 'npt-post-type-nonce' );
			$this->post_type_arguments_form();
		}

	}
endif;