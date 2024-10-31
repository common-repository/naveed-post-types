<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'NPT_Admin' ) ) :
	
	class NPT_Admin {
		
		/**
		 * Constructor.
		 * @since   1.0.0
		 * @param void
		 * @return  void
		 */
		function __construct() {
			// Add actions.
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			add_action( 'current_screen', array( $this, 'current_screen' ) );
		}
		
		/**
		 * Adds the NPT menu item.
		 * @since   1.0.0
		 * @param void
		 * @return  void
		 */
		public function admin_menu() {
			
			// Vars.
			$slug = npt_get_setting( 'menu_page' );
			$cap  = npt_get_setting( 'capability' );
			$icon = npt_get_setting( 'icon' );
			
			// Add menu items.
			add_menu_page( __( 'Post Types', 'npt' ), __( 'Post Types', 'npt' ), $cap, $slug, false, $icon, 80 );
			add_submenu_page( $slug, __( 'Register', 'npt' ), __( 'Register New', 'npt' ), $cap, $slug, array( $this, 'npt_dashboard_page_callback' ), 0 );
		}
		
		function npt_dashboard_page_callback() {
			npt_add_new_page();
		}
		
		/**
		 * Adds custom functionality to "NPT" admin pages.
		 * @since   1.0.0
		 * @param void
		 * @return  void
		 */
		function current_screen( $screen ) {
			
			// Determine if the current page being viewed is "NPT" related.
			if ( npt_screen( $screen ) ) {
				add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ) );
				add_action( 'admin_enqueue_scripts', array( $this, 'npt_disable_auto_save' ) );
				add_action( 'in_admin_header', array( $this, 'npt_admin_header' ) );
			}
		}
		
		/**
		 * Print admin bar
		 * @since   1.0.0
		 * @return  void
		 */
		function npt_admin_header() {
			$screen = get_current_screen();
			?>
			<div class = "npt-admin-bar" id = "poststuff">
				<div class = "npt-header">
					<div class = "npt-container npt-flex">
						<img src = "<?php echo npt_get_setting( 'url' ) . 'assets/images/npt-logo.svg'; ?>" alt="npt-logo"><h1>Naveed Post Types</h1>
						<ul class = "npt-nav-list">
							<li class = "nav-item <?php if ( $screen->id == 'toplevel_page_naveed-post-types' ) {
								echo esc_html( 'active' );
							} ?>"><a href = "<?php echo admin_url( 'admin.php?page=naveed-post-types' ); ?>">Home</a></li>
							<li class = "nav-item <?php if ( $screen->id == 'edit-npt-post-type' || $screen->id == 'npt-post-type' ) {
								echo esc_html( 'active' );
							} ?>"><a href = "<?php echo admin_url( 'edit.php?post_type=npt-post-type' ); ?>">Post Types</a></li>
							<li class = "nav-item <?php if ( $screen->id == 'edit-npt-taxonomy' || $screen->id == 'npt-taxonomy' ) {
								echo esc_html( 'active' );
							} ?>"><a href = "<?php echo admin_url( 'edit.php?post_type=npt-taxonomy' ); ?>">Taxonomies</a></li>
						</ul>
					</div>
				</div>
			</div>
			<?php
		}
		
		/**
		 * Modifies the admin footer text.
		 * @since   1.0.0
		 * @param string $text The admin footer text.
		 * @return  string
		 */
		function admin_footer_text( $text ) {
			// Use RegExp to append "ACF" after the <a> element allowing translations to read correctly.
			return preg_replace( '/(<a[\S\s]+?\/a>)/', '$1 ' . __( 'and', 'sop' ) . ' <a href="https://naveedanjum.info" target="_blank">Naveed Post Types</a>', $text, 1 );
		}
		
		/**
		 * Disable auto save drafts
		 * @since   1.0.0
		 * @return void
		 */
		function npt_disable_auto_save() {
			wp_dequeue_script( 'autosave' );
		}
	}
	
	new NPT_Admin();
endif;