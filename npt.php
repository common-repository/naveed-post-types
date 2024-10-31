<?php
/**
 * Plugin Name: Naveed Post Types
 * Plugin URI: #
 * Description: An elegant way to create custom post types and custom taxonomies in WordPress
 * Version: 1.2.0
 * Author: Naveed Anjum
 * Author URI: https://naveedanjum.info
 * Text Domain: npt
 */

/**
 * @since   1.0.0
 * @author  Naveed Anjum
 * @package NPT
 * @license GPL-2.0+
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'NPT' ) ) :

	class NPT {
		/** @var string The plugin version number. */
		var $version = '1.0.0';

		/** @var array The plugin settings array. */
		var $settings = array();

		/**
		 * __construct
		 * A dummy constructor to ensure NPT is only setup once.
		 * @since   1.0.0
		 *
		 *
		 * @return  void
		 */
		function __construct() {
			// Do nothing.
		}

		/**
		 * define
		 * Defines a constant if doesnt already exist.
		 * @since   1.0.0
		 *
		 * @param mixed $value The constant value.
		 * @param string $name The constant name.
		 *
		 * @return  void
		 */
		function define( $name, $value = true ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * initialize
		 * Sets up the NPT plugin.
		 * @since   1.0.0
		 *
		 * @param void
		 *
		 * @return  void
		 */
		public function initialize() {

			// Define constants.
			$this->define( 'NPT', true );
			$this->define( 'BR', '<br/>' );
			$this->define( 'NPT_PATH', plugin_dir_path( __FILE__ ) );
			$this->define( 'NPT_URL', plugin_dir_url( __FILE__ ) );
			$this->define( 'NPT_BASENAME', plugin_basename( __FILE__ ) );
			$this->define( 'NPT_VERSION', $this->version );

			// Define settings.
			$this->settings = array(
				'name'       => __( 'Naveed Post Types', 'npt' ),
				'slug'       => dirname( NPT_BASENAME ),
				'version'    => NPT_VERSION,
				'basename'   => NPT_BASENAME,
				'path'       => NPT_PATH,
				'file'       => __FILE__,
				'url'        => NPT_URL,
				'icon'       => NPT_URL . 'assets/images/npt.svg',
				'menu_page'  => 'naveed-post-types',
				'capability' => 'manage_options',
			);
			// Include functions.
			include_once NPT_PATH . 'includes/npt-functions.php';

			// Include admin.
			if ( is_admin() ) {
				include_once NPT_PATH . 'includes/admin/npt-admin.php';
				include_once NPT_PATH . 'includes/admin/npt-enqueue.php';
				include_once NPT_PATH . 'includes/npt-home.php';
				// Include fields.
				include_once NPT_PATH . 'includes/admin/fields/npt-field-wrap.php';
				include_once NPT_PATH . 'includes/admin/fields/npt-fields.php';
				// Include forms.
				include_once NPT_PATH . 'includes/admin/forms/npt-post-type-form.php';
				include_once NPT_PATH . 'includes/admin/forms/npt-taxonomy-form.php';
				// Include meta boxes.
				include_once NPT_PATH . 'includes/admin/meta-boxes/npt-post-type.php';
				include_once NPT_PATH . 'includes/admin/meta-boxes/npt-taxonomy.php';

				include_once NPT_PATH . 'includes/npt-svg-icons.php';
				include_once NPT_PATH . 'includes/ajax.php';

			}

			// Add actions.
			add_action( 'init', array( $this, 'register_post_types' ), 0 );
			add_action( 'init', array( $this, 'npt_register_post_types' ), 0 );
			add_action( 'init', array( $this, 'npt_register_taxonomies' ), 0 );
		}


		/**
		 * @since   1.0.0
		 * @return void
		 * @see npt-functions
		 */
		function register_post_types() {

			// Vars.
			$cap       = npt_get_setting( 'capability' );
			$menu_page = npt_get_setting( 'menu_page' );

			// Register the Post Type npt post type.
			register_post_type(
				'npt-post-type',
				array(
					'labels'          => array(
						'name'               => __( 'Post Types', 'npt' ),
						'singular_name'      => __( 'Post Type', 'npt' ),
						'add_new'            => __( 'Add New', 'npt' ),
						'add_new_item'       => __( 'Add New Post Type', 'npt' ),
						'edit_item'          => __( 'Edit Post Type', 'npt' ),
						'new_item'           => __( 'New Post Type', 'npt' ),
						'view_item'          => __( 'View Post Type', 'npt' ),
						'search_items'       => __( 'Search Post Types', 'npt' ),
						'not_found'          => __( 'No Post Types found', 'npt' ),
						'not_found_in_trash' => __( 'No Post Types found in Trash', 'npt' ),
					),
					'public'          => false,
					'hierarchical'    => true,
					'show_ui'         => true,
					'show_in_menu'    => $menu_page,
					'_builtin'        => false,
					'capability_type' => 'post',
					'capabilities'    => array(
						'edit_post'    => $cap,
						'delete_post'  => $cap,
						'edit_posts'   => $cap,
						'delete_posts' => $cap,
					),
					'supports'        => array( '' ),
					'rewrite'         => false,
					'query_var'       => false,
				)
			);

			// Register the Taxonomy npt post taxonomy.
			register_post_type(
				'npt-taxonomy',
				array(
					'labels'          => array(
						'name'               => __( 'Taxonomies', 'npt' ),
						'singular_name'      => __( 'Taxonomy', 'npt' ),
						'add_new'            => __( 'Add New', 'npt' ),
						'add_new_item'       => __( 'Add New Taxonomy', 'npt' ),
						'edit_item'          => __( 'Edit Taxonomy', 'npt' ),
						'new_item'           => __( 'New Taxonomy', 'npt' ),
						'view_item'          => __( 'View Taxonomy', 'npt' ),
						'search_items'       => __( 'Search Taxonomies', 'npt' ),
						'not_found'          => __( 'No Taxonomies found', 'npt' ),
						'not_found_in_trash' => __( 'No Taxonomies found in Trash', 'npt' ),
					),
					'public'          => false,
					'hierarchical'    => true,
					'show_ui'         => true,
					'show_in_menu'    => $menu_page,
					'_builtin'        => false,
					'capability_type' => 'post',
					'capabilities'    => array(
						'edit_post'    => $cap,
						'delete_post'  => $cap,
						'edit_posts'   => $cap,
						'delete_posts' => $cap,
					),
					'supports'        => array( '' ),
					'rewrite'         => false,
					'query_var'       => false,
				)
			);

		}

		/**
		 * Register all published npt-post-types to post types
		 * 
		 * @since   1.0.0
		 * @return void
		 */
		public function npt_register_post_types() {
			$args  = array(
				'post_type'   => 'npt-post-type',
				'post_status' => 'publish',
				'numberposts' => -1,
			);
			$posts = get_posts( $args );
			foreach ( $posts as $post ) {
				/**
				 * @var array $value
				 */
				$data = get_post_meta( $post->ID, 'npt_post_type', true );
				npt_post_types( $data );
			}
			npt_post_type_flush_rewriete_rules();
		}


		/**
		 * Register all published npt-taxonomies to taxonomies
		 * 
		 * @since   1.0.0
		 * @return void
		 */
		public function npt_register_taxonomies() {
			$args       = array(
				'post_type'   => 'npt-taxonomy',
				'post_status' => 'publish',
				'numberposts' => -1,
			);
			$taxonomies = get_posts( $args );
			foreach ( $taxonomies as $taxonomy ) {
				/**
				 * @var array $value
				 */
				$data = get_post_meta( $taxonomy->ID, 'npt_taxonomy', true );
				npt_taxonomes( $data );
			}
			npt_taxonomy_flush_rewriete_rules();
		}

		/**
		 * get_setting
		 * Returns a setting or null if doesn't exist.
		 * 
		 * @since   1.0.0
		 *
		 * @param string $name The setting name.
		 *
		 * @return  mixed
		 */
		function get_setting( string $name ) {
			return $this->settings[ $name ] ?? null;
		}

	}

	/**
	 * npt
	 * 
	 * @since   1.1.0
	 * @return  NPT
	 */
	function npt() {
		global $npt;

		// Instantiate only once.
		if ( ! isset( $npt ) ) {
			$npt = new NPT();
			$npt->initialize();
		}

		return $npt;
	}

	// Instantiate.
	npt();
endif;
