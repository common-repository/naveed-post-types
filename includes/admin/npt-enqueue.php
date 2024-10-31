<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'NPT_Enqueue' ) ) :
	
	class NPT_Enqueue {
		/**
		 * __construct
		 *
		 * @param void
		 *
		 * @return  void
		 * @since   1.0.0
		 *
		 */
		function __construct() {
			
			add_action( 'admin_enqueue_scripts', array( $this, 'npt_admin_style' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'npt_admin_script' ) );
		}
		
		
		/**
		 * Including CSS file
		 *
		 * @return void
		 */
		function npt_admin_style() {
			
			/**
			 * Settings current screen object
			 *
			 * @var object
			 */
			
			$current_screen = get_current_screen();
			
			// check if current page is 'toplevel_page_na-cpt-dashboard', 'na-post-types_page_na-cpt-add-new' and load CSS file
			if ( npt_screen( $current_screen ) ) {
				$url = npt_get_setting('url' );
				//enqueue CSS file
				wp_enqueue_style( 'na-cpt-admin-style', $url . 'assets/css/npt-admin.css' );
			}
		}
		
		/**
		 * Including JS file
		 *
		 * @return void
		 */
		function npt_admin_script() {
			
			/**
			 * Settings current screen object
			 *
			 * @var object
			 */
			$current_screen = get_current_screen();
			
			// check if current page is 'naveed-post-types', 'npt-post-type', 'npt-taxonomy' and load  JS file
			if ( npt_screen( $current_screen ) ) {
				$url = npt_get_setting('url' );
				//Register JS file
				wp_register_script( 'npt-admin-script', $url . 'assets/js/npt-admin.js' );
				
				// Localize main script and nonce
				wp_localize_script( 'npt-admin-script', 'NPT_Ajax', array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'nonce'   => wp_create_nonce( 'npt_nonce' )
				) );
				
				// To enqueue the JS file.
				wp_enqueue_script( 'npt-admin-script' );
				wp_enqueue_script( 'jquery' );
			}
		}
	}
	
	new NPT_Enqueue();
endif;