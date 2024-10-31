<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'NPT_Taxonomy_Form' ) ) :
	
	class NPT_Taxonomy_Form extends NPT_Fields {
		
		/**
		 * input fields attributes for register taxonomy metabox
		 * fields will be generated according to following given attributes
		 * @since   1.0.0
		 * @return array[]
		 */
		public function npt_taxonomy_register_fields() {
			global $post;
			/**
			 * @since   1.0.0
			 * @var array $taxonomy
			 */
			$taxonomy = get_post_meta( $post->ID, 'npt_taxonomy', true );
			
			return $args = array(
				'slug'          => array(
					'label'             => esc_html__( 'Slug', 'npt' ),
					'type'              => 'text',
					'field'             => 'arguments',
					'group'             => 'register',
					'value'             => isset( $taxonomy[ 'slug' ] ) ? esc_attr( $taxonomy[ 'slug' ] ) : '',
					'key'               => 'slug',
					'name'              => 'slug',
					'id'                => 'slug',
					'placeholder'       => '(e.g. genre)',
					'maxlength'         => 32,
					'label_description' => esc_html__( 'Unique but must not exceed 32 characters and may only contain lowercase alphanumeric characters, dashes, and underscores.', 'npt' ),
					'alert'             => 'slug-alert',
					'required'          => true,
					'wrap'              => true,
				),
				'singular_name' => array(
					'label'             => esc_html__( 'Singular Name', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'register',
					'key'               => 'singular_name',
					'name'              => 'singular-name',
					'id'                => 'singular-name',
					'placeholder'       => '(e.g. Genre)',
					'label_description' => esc_html__( 'Singular name for one object of this taxonomy.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'singular_name' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'singular_name' ] ) : '',
					'required'          => true,
					'wrap'              => true,
				),
				'name'          => array(
					'label'             => esc_html__( 'Name', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'register',
					'key'               => 'name',
					'name'              => 'name',
					'id'                => 'name',
					'placeholder'       => '(e.g. Genres)',
					'label_description' => esc_html__( 'General plural name for the taxonomy.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'name' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'name' ] ) : '',
					'required'          => true,
					'wrap'              => true,
				),
				'description'   => array(
					'label'             => esc_html__( 'Description', 'npt' ),
					'type'              => 'textarea',
					'field'             => 'arguments',
					'group'             => 'register',
					'key'               => 'description',
					'name'              => 'description',
					'id'                => 'description',
					'label_description' => esc_html__( 'A short descriptive summary of what the taxonomy is for.', 'npt' ),
					'value'             => isset( $taxonomy[ 'description' ] ) ? esc_attr( $taxonomy[ 'description' ] ) : '',
					'required'          => false,
					'wrap'              => true,
				),
				'post_types'    => array(
					'label'             => esc_html__( 'Post Types', 'npt' ),
					'type'              => 'checkbox',
					'field'             => 'arguments',
					'group'             => 'register',
					'key'               => 'post_types',
					'name'              => 'post_types',
					'id'                => 'post_types',
					'label_description' => esc_html__( 'Add support for available registered post types. At least one is required.', 'npt' ) . '</br>' . esc_html__( 'By default only public post types are listed.', 'npt' ),
					'wrap'              => true,
					'options'           => npt_get_post_types( $taxonomy ),
				),
			
			);
		}
		
		/**
		 * input fields attributes for taxonomy labels metabox
		 * fields will be generated according to following given attributes
		 * @since   1.0.0
		 * @return array[]
		 */
		public function npt_taxonomy_labels_fields() {
			global $post;
			/**
			 * @since   1.0.0
			 * @var array $taxonomy
			 */
			$taxonomy = get_post_meta( $post->ID, 'npt_taxonomy', true );
			
			return $args = array(
				
				'buttons'                    => array(
					'label'             => esc_html__( 'Auto Populate labels', 'npt' ),
					'type'              => 'button',
					'field'             => 'button',
					'group'             => 'labels',
					'label_description' => esc_html__( 'Populate labels based on Register Taxonomy meta box values.', 'npt' ),
					'required'          => false,
					'wrap'              => true,
					'buttons'           => array(
						array( 'label' => 'Populate Labels', 'id' => 'auto-populate', 'href' => '#' ),
						array( 'label' => 'Clear Labels', 'id' => 'auto-clear', 'href' => '#' ),
					),
				),
				'menu_name'                  => array(
					'label'             => esc_html__( 'Menu Name', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'menu_name',
					'name'              => 'menu-name',
					'id'                => 'menu-name',
					'placeholder'       => '(e.g. Genres)',
					'label_description' => esc_html__( 'Label for the menu name.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'menu_name' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'menu_name' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( '%s', 'npt' ), 'item' ),
						'field' => 'name',
					),
				),
				'all_items'                  => array(
					'label'             => esc_html__( 'All Items', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'all_items',
					'name'              => 'all-items',
					'id'                => 'all-items',
					'placeholder'       => '(e.g. All Genres )',
					'label_description' => esc_html__( 'Label to signify all taxonomies in a submenu.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'all_items' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'all_items' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'All %s ', 'npt' ), 'item' ),
						'field' => 'name',
					),
				),
				'edit_item'                  => array(
					'label'             => esc_html__( 'Edit Item', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'edit_item',
					'name'              => 'edit-item',
					'id'                => 'edit-item',
					'placeholder'       => '(e.g. Edit Genre)',
					'label_description' => esc_html__( 'Label for editing a singular taxonomy.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'edit_item' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'edit_item' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Edit %s', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'view_item'                  => array(
					'label'             => esc_html__( 'View Item', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'view_item',
					'name'              => 'view-item',
					'id'                => 'view-item',
					'placeholder'       => '(e.g. View Genre)',
					'label_description' => esc_html__( 'Label for viewing a singular taxonomy.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'view_item' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'view_item' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'View %s', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'update_item'                => array(
					'label'             => esc_html__( 'Update Item', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'update_item',
					'name'              => 'update-item',
					'id'                => 'update-item',
					'placeholder'       => '(e.g. Update Genre)',
					'label_description' => esc_html__( 'Label for updating a singular taxonomy.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'update_item' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'update_item' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Update %s', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'add_new_item'               => array(
					'label'             => esc_html__( 'Add New Item', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'add_new_item',
					'name'              => 'add-new-item',
					'id'                => 'add-new-item',
					'placeholder'       => '(e.g. Add New Genre)',
					'label_description' => esc_html__( 'Label for adding a new singular taxonomy.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'add_new_item' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'add_new_item' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Add New %s', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'new_item_name'              => array(
					'label'             => esc_html__( 'New Item Name', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'new_item_name',
					'name'              => 'new-item-name',
					'id'                => 'new-item-name',
					'placeholder'       => '(e.g. New Genre)',
					'label_description' => esc_html__( 'Label for the new taxonomy name.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'new_item_name' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'new_item_name' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'New %s Name', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'parent_item'                => array(
					'label'             => esc_html__( 'Parent Item', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'parent_item',
					'name'              => 'parent-item',
					'id'                => 'parent-item',
					'placeholder'       => '(e.g. Parent Genre)',
					'label_description' => esc_html__( 'This label is only used for hierarchical taxonomies.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'parent_item' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'parent_item' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Parent %s', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'parent_item_colon'          => array(
					'label'             => esc_html__( 'Parent Item Colon:', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'parent_item_colon',
					'name'              => 'parent-item-colon',
					'id'                => 'parent-item-colon',
					'placeholder'       => '(e.g. Parent Genre:)',
					'label_description' => esc_html__( 'The same as ', 'npt' ) . '<b>' . esc_html__( 'Parent Item ', 'npt' ) . '</b>' . esc_html__( 'but with colon : in the end.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'parent_item_colon' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'parent_item_colon' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Parent %s:', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'search_items'               => array(
					'label'             => esc_html__( 'Search Items', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'search_items',
					'name'              => 'search-items',
					'id'                => 'search-items',
					'placeholder'       => '(e.g. Search Genres)',
					'label_description' => esc_html__( 'Label for searching plural taxonomies.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'search_items' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'search_items' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Search %s', 'npt' ), 'item' ),
						'field' => 'name',
					),
				),
				'popular_items'              => array(
					'label'             => esc_html__( 'Popular Items', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'popular_items',
					'name'              => 'popular-items',
					'id'                => 'popular-items',
					'placeholder'       => '(e.g. Popular Genres)',
					'label_description' => esc_html__( 'This label is only used for non-hierarchical taxonomies.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'popular_items' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'popular_items' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Popular %s', 'npt' ), 'item' ),
						'field' => 'name',
					),
				),
				'separate_items_with_commas' => array(
					'label'             => esc_html__( 'Separate Items with Commas', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'separate_items_with_commas',
					'name'              => 'separate-items-with-commas',
					'id'                => 'separate-items-with-commas',
					'placeholder'       => '(e.g. Separate genres with commas)',
					'label_description' => esc_html__( 'Label used in the meta box.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'separate_items_with_commas' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'separate_items_with_commas' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Separate %s with commas', 'npt' ), 'item' ),
						'field' => 'plural-slug',
					),
				),
				'add_or_remove_items'        => array(
					'label'             => esc_html__( 'Add or Remove Items', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'add_or_remove_items',
					'name'              => 'add-or-remove-items',
					'id'                => 'add-or-remove-items',
					'placeholder'       => '(e.g. Add or remove genres)',
					'label_description' => esc_html__( 'Label used in the meta box when JavaScript is disabled.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'add_or_remove_items' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'add_or_remove_items' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Add or remove %s', 'npt' ), 'item' ),
						'field' => 'plural-slug',
					),
				),
				'choose_from_most_used'      => array(
					'label'             => esc_html__( 'Choose From Most Used', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'choose_from_most_used',
					'name'              => 'choose-from-most-used',
					'id'                => 'choose-from-most-used',
					'placeholder'       => '(e.g. Choose from most used genres)',
					'label_description' => esc_html__( 'Label used in the meta box.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'choose_from_most_used' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'choose_from_most_used' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Choose from most used %s', 'npt' ), 'item' ),
						'field' => 'plural-slug',
					),
				),
				'not_found'                  => array(
					'label'             => esc_html__( 'Not Found', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'not_found',
					'name'              => 'not-found',
					'id'                => 'not-found',
					'placeholder'       => '(e.g. No books found)',
					'label_description' => esc_html__( 'Label used in the meta box and taxonomy list table.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'not_found' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'not_found' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'No %s found', 'npt' ), 'item' ),
						'field' => 'plural-slug',
					),
				),
				'no_terms'                   => array(
					'label'             => esc_html__( 'No Terms', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'no_terms',
					'name'              => 'no-terms',
					'id'                => 'no-terms',
					'placeholder'       => '(e.g. No genres)',
					'label_description' => esc_html__( 'Label used in the posts and media list tables.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'no_terms' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'no_terms' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'No %s', 'npt' ), 'item' ),
						'field' => 'plural-slug',
					),
				),
				'filter_by_item'             => array(
					'label'             => esc_html__( 'Filter By Item', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'filter_by_item',
					'name'              => 'filter-by-item',
					'id'                => 'filter-by-item',
					'placeholder'       => '(e.g. Filter by genre )',
					'label_description' => esc_html__( 'Label used in the posts list table.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'filter_by_item' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'filter_by_item' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Filter by %s', 'npt' ), 'item' ),
						'field' => 'slug',
					),
				),
				'items_list_navigation'      => array(
					'label'             => esc_html__( 'Items List Navigation', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'items_list_navigation',
					'name'              => 'items-list-navigation',
					'id'                => 'items-list-navigation',
					'placeholder'       => '(e.g. Genres list navigation )',
					'label_description' => esc_html__( 'Label for the table pagination hidden heading.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'items_list_navigation' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'items_list_navigation' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( '%s list navigation ', 'npt' ), 'item' ),
						'field' => 'name',
					),
				),
				'items_list'                 => array(
					'label'             => esc_html__( 'Items List', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'items_list',
					'name'              => 'items-list',
					'id'                => 'items-list',
					'placeholder'       => '(e.g. Books list )',
					'label_description' => esc_html__( 'Label for the table hidden heading.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'items_list' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'items_list' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( '%s list ', 'npt' ), 'item' ),
						'field' => 'name',
					),
				),
				'most_used'                  => array(
					'label'             => esc_html__( 'Most Used', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'most_used',
					'name'              => 'most-used',
					'id'                => 'most-used',
					'placeholder'       => '(e.g. Most Used )',
					'label_description' => esc_html__( 'Label for the attributes meta box.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'most_used' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'most_used' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => esc_attr__( 'Most Used', 'npt' ),
						'field' => 'singular-name',
					),
				),
				'back_to_items'              => array(
					'label'             => esc_html__( 'Back To Items', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'back_to_items',
					'name'              => 'back-to-items',
					'id'                => 'back-to-items',
					'placeholder'       => '(e.g. ← Back to genres )',
					'label_description' => esc_html__( 'Label displayed after a term has been updated.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'back_to_items' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'back_to_items' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( '← Back to %s ', 'npt' ), 'item' ),
						'field' => 'plural-slug',
					),
				),
				'item_link'                  => array(
					'label'             => esc_html__( 'Item Link', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'item_link',
					'name'              => 'item-link',
					'id'                => 'item-link',
					'placeholder'       => '(e.g. Genre link )',
					'label_description' => esc_html__( 'Used in the block editor. Title for a navigation link block variation.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'item_link' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'item_link' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( '%s link ', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'item_link_description'      => array(
					'label'             => esc_html__( 'Item Link Description', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'item_link_description',
					'name'              => 'item-link-description',
					'id'                => 'link-description',
					'placeholder'       => '(e.g. A link to a genre )',
					'label_description' => esc_html__( 'Used in the block editor. Description for a navigation link block variation.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'item_link_description' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'item_link_description' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'A link to a %s', 'npt' ), 'item' ),
						'field' => 'slug',
					),
				),
				'name_field_description'     => array(
					'label'             => esc_html__( 'Name Field Description', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'name_field_description',
					'name'              => 'name-field-description',
					'id'                => 'name-field-description',
					'placeholder'       => '(e.g. "The name is how it appears on your site" )',
					'label_description' => esc_html__( 'Description for the Name field on Edit Tags screen.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'name_field_description' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'name_field_description' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => esc_attr__( '"The name is how it appears on your site"', 'npt' ),
						'field' => 'slug',
					),
				),
				'slug_field_description'     => array(
					'label'             => esc_html__( 'Slug Field Description', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'slug_field_description',
					'name'              => 'slug-field-description',
					'id'                => 'slug-field-description',
					'placeholder'       => '(e.g. "The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens" )',
					'label_description' => esc_html__( 'Description for the Slug field on Edit Tags screen.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'slug_field_description' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'slug_field_description' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => esc_attr__( '"The "slug" is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens"', 'npt' ),
						'field' => 'slug',
					
					),
				),
				'parent_field_description'   => array(
					'label'             => esc_html__( 'Parent Field Description', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'parent_field_description',
					'name'              => 'parent-field-description',
					'id'                => 'parent-field-description',
					'placeholder'       => '(e.g. "Assign a parent term to create a hierarchy. The term Jazz, for example, would be the parent of Bebop and Big Band" )',
					'label_description' => esc_html__( 'Description for the Parent field on Edit Tags screen.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'parent_field_description' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'parent_field_description' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => esc_attr__( '"Assign a parent term to create a hierarchy. The term Jazz, for example, would be the parent of Bebop and Big Band"', 'npt' ),
						'field' => 'slug',
					
					),
				),
				'desc_field_description'     => array(
					'label'             => esc_html__( 'Description Field Description', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'desc_field_description',
					'name'              => 'desc-field-description',
					'id'                => 'desc-field-description',
					'placeholder'       => '(e.g. "The description is not prominent by default; however, some themes may show it" )',
					'label_description' => esc_html__( 'Description for the Description field on Edit Tags screen.', 'npt' ),
					'value'             => isset( $taxonomy[ 'labels' ][ 'desc_field_description' ] ) ? esc_attr( $taxonomy[ 'labels' ][ 'desc_field_description' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => esc_attr__( '"The description is not prominent by default; however, some themes may show it"', 'npt' ),
						'field' => 'slug',
					
					),
				),
			
			);
		}
		
		/**
		 * input fields attributes for taxonomy arguments metabox
		 * fields will be generated according to following given attributes
		 * @since   1.0.0
		 * @return array[]
		 */
		public function npt_taxonomy_arguments_fields() {
			global $post;
			/**
			 * @since   1.0.0
			 * @var array $taxonomy
			 */
			$taxonomy = get_post_meta( $post->ID, 'npt_taxonomy', true );
			$default  = false;
			if ( get_current_screen()->action == 'add' ) {
				$default = true;
			}
			
			return $args = array(
				'public'                => array(
					'label'             => esc_html__( 'Public', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'public' ] ) ? esc_attr( $taxonomy[ 'public' ] ) : false,
					'key'               => 'public',
					'name'              => 'public',
					'id'                => 'public',
					'label_description' => esc_html__( 'Whether a taxonomy is intended for use publicly either via the admin interface or by front-end users.', 'npt' ),
					'field_description' => esc_html__( 'default: true', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ) ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ), 'default' => $default ),
					),
				),
				'publicly_queryable'    => array(
					'label'             => esc_html__( 'Publicly Queryable', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'publicly_queryable' ] ) ? esc_attr( $taxonomy[ 'publicly_queryable' ] ) : false,
					'key'               => 'publicly_queryable',
					'name'              => 'publicly-queryable',
					'id'                => 'publicly-queryable',
					'label_description' => esc_html__( 'Whether the taxonomy is publicly queryable.', 'npt' ),
					'field_description' => esc_html__( 'default: true', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ) ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ), 'default' => $default ),
					),
				),
				'hierarchical'          => array(
					'label'             => esc_html__( 'Hierarchical', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'hierarchical' ] ) ? esc_attr( $taxonomy[ 'hierarchical' ] ) : false,
					'key'               => 'hierarchical',
					'name'              => 'hierarchical',
					'id'                => 'hierarchical',
					'label_description' => esc_html__( 'Whether the taxonomy is hierarchical.', 'npt' ),
					'field_description' => esc_html__( 'default: false', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ), 'default' => $default ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ) ),
					),
				),
				'show_ui'               => array(
					'label'             => esc_html__( 'Show UI', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'show_ui' ] ) ? esc_attr( $taxonomy[ 'show_ui' ] ) : false,
					'key'               => 'show_ui',
					'name'              => 'show-ui',
					'id'                => 'show-ui',
					'label_description' => esc_html__( 'Whether to generate and allow a UI for managing terms in this taxonomy in the admin.', 'npt' ),
					'field_description' => esc_html__( 'default: true', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ) ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ), 'default' => $default ),
					),
				),
				'show_in_menu'          => array(
					'label'             => esc_html__( 'Show in Menu', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'show_in_menu' ] ) ? esc_attr( $taxonomy[ 'show_in_menu' ] ) : false,
					'key'               => 'show_in_menu',
					'name'              => 'show-in-menu',
					'id'                => 'show-in-menu',
					'label_description' => esc_html__( 'Whether to show the taxonomy in the admin menu.', 'npt' ),
					'field_description' => esc_html__( 'default: true', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ) ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ), 'default' => $default ),
					),
				),
				'show_in_nav_menus'     => array(
					'label'             => esc_html__( 'Show in Nav Menu', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'show_in_nav_menus' ] ) ? esc_attr( $taxonomy[ 'show_in_nav_menus' ] ) : false,
					'key'               => 'show_in_nav_menus',
					'name'              => 'show-in-nav-menus',
					'id'                => 'show-in-nav-menus',
					'label_description' => esc_html__( 'Makes this taxonomy available for selection in navigation menus.', 'npt' ),
					'field_description' => esc_html__( 'default: true', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ) ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ), 'default' => $default ),
					),
				),
				'show_in_rest'          => array(
					'label'             => esc_html__( 'Show in REST API', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'show_in_rest' ] ) ? esc_attr( $taxonomy[ 'show_in_rest' ] ) : false,
					'key'               => 'show_in_rest',
					'name'              => 'show-in-rest',
					'id'                => 'show-in-rest',
					'label_description' => esc_html__( 'Whether to include the taxonomy in the REST API. Set this to true for the taxonomy to be available in the block editor.', 'npt' ),
					'field_description' => esc_html__( 'default: true', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ) ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ), 'default' => $default ),
					),
				),
				'rest_base'             => array(
					'label'             => esc_html__( 'Rest API Base Slug', 'npt' ),
					'type'              => 'text',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'rest_base' ] ) ? esc_attr( $taxonomy[ 'rest_base' ] ) : '',
					'key'               => 'rest_base',
					'name'              => 'rest-base',
					'id'                => 'rest-base',
					'placeholder'       => 'Slug to use in REST API URLs',
					'label_description' => esc_html__( 'To change the base url of REST API route.', 'npt' ),
					'wrap'              => true,
				),
				'rest_namespace'        => array(
					'label'             => esc_html__( 'Rest API Namespace', 'npt' ),
					'type'              => 'text',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'rest_namespace' ] ) ? esc_attr( $taxonomy[ 'rest_namespace' ] ) : '',
					'key'               => 'rest_namespace',
					'name'              => 'rest-namespace',
					'id'                => 'rest-namespace',
					'placeholder'       => 'Default: wp/v2',
					'label_description' => esc_html__( 'To change the namespace URL of REST API route.', 'npt' ),
					'wrap'              => true,
				),
				'rest_controller_class' => array(
					'label'             => esc_html__( 'Rest API Controller Class', 'npt' ),
					'type'              => 'text',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'rest_controller_class' ] ) ? esc_attr( $taxonomy[ 'rest_controller_class' ] ) : '',
					'key'               => 'rest_controller_class',
					'name'              => 'rest-controller-class',
					'id'                => 'rest-controller-class',
					'placeholder'       => 'Default: WP_REST_Terms_Controller',
					'label_description' => esc_html__( 'Read more about ', 'npt' ) . '<a target="_blank" href="https://developer.wordpress.org/reference/classes/wp_rest_terms_controller/">' . esc_html__( 'WP_REST_Terms_Controller', 'npt' ) . '</a>',
					'wrap'              => true,
				),
				'show_tagcloud'         => array(
					'label'             => esc_html__( 'Show Tagcloud', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'show_tagcloud' ] ) ? esc_attr( $taxonomy[ 'show_tagcloud' ] ) : false,
					'key'               => 'show_tagcloud',
					'name'              => 'show-tagcloud',
					'id'                => 'show-tagcloud',
					'label_description' => esc_html__( 'Whether to list the taxonomy in the Tag Cloud Widget controls.', 'npt' ),
					'field_description' => esc_html__( 'default: true', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ) ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ), 'default' => $default ),
					),
				),
				'show_in_quick_edit'    => array(
					'label'             => esc_html__( 'Show in quick edit', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'show_in_quick_edit' ] ) ? esc_attr( $taxonomy[ 'show_in_quick_edit' ] ) : false,
					'key'               => 'show_in_quick_edit',
					'name'              => 'show-in-quick-edit',
					'id'                => 'show-in-quick-edit',
					'label_description' => esc_html__( 'Whether to show the taxonomy in the quick/bulk edit panel.', 'npt' ),
					'field_description' => esc_html__( 'default: true', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ) ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ), 'default' => $default ),
					),
				),
				'show_admin_column'     => array(
					'label'             => esc_html__( 'Show in admin column', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'show_admin_column' ] ) ? esc_attr( $taxonomy[ 'show_admin_column' ] ) : false,
					'key'               => 'show_admin_column',
					'name'              => 'show-admin-column',
					'id'                => 'show-admin-column',
					'label_description' => esc_html__( 'Whether to display a column for the taxonomy on its post type listing screens.', 'npt' ),
					'field_description' => esc_html__( 'default: true', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ) ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ), 'default' => $default ),
					),
				),
				'meta_box_cb'           => array(
					'label'             => esc_html__( 'Metabox Callback', 'npt' ),
					'type'              => 'text',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'meta_box_cb' ] ) ? esc_attr( $taxonomy[ 'meta_box_cb' ] ) : '',
					'key'               => 'meta_box_cb',
					'name'              => 'meta-box-cb',
					'id'                => 'meta-box-cb',
					'placeholder'       => 'Default: null',
					'label_description' => esc_html__( 'Provide a callback function for the meta box display.', 'npt' ),
					'wrap'              => true,
				),
				'meta_box_sanitize_cb'  => array(
					'label'             => esc_html__( 'Sanitize Metabox Callback', 'npt' ),
					'type'              => 'text',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'meta_box_sanitize_cb' ] ) ? esc_attr( $taxonomy[ 'meta_box_sanitize_cb' ] ) : '',
					'key'               => 'meta_box_sanitize_cb',
					'name'              => 'meta-box-sanitize-cb',
					'id'                => 'meta-box-sanitize-cb',
					'placeholder'       => 'Default: null',
					'label_description' => esc_html__( 'Callback function for sanitizing taxonomy data saved from a meta box.', 'npt' ),
					'wrap'              => true,
				),
				'rewrite'               => array(
					'label'             => esc_html__( 'Rewrite', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'rewrite' ] ) ? esc_attr( $taxonomy[ 'rewrite' ] ) : false,
					'key'               => 'rewrite',
					'name'              => 'rewrite',
					'id'                => 'rewrite',
					'label_description' => esc_html__( 'Triggers the handling of rewrites for this taxonomy.', 'npt' ),
					'field_description' => esc_html__( 'default: true', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ) ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ), 'default' => $default ),
					),
				),
				'rewrite_slug'          => array(
					'label'             => esc_html__( 'Rewrite Slug', 'npt' ),
					'type'              => 'text',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'rewrite_slug' ] ) ? esc_attr( $taxonomy[ 'rewrite_slug' ] ) : '',
					'key'               => 'rewrite_slug',
					'name'              => 'rewrite-slug',
					'id'                => 'rewrite-slug',
					'placeholder'       => 'Default: Taxonomy Slug',
					'label_description' => esc_html__( 'Customize the permastruct slug.', 'npt' ),
					'wrap'              => true,
				),
				'with_front'            => array(
					'label'             => esc_html__( 'With Front', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'with_front' ] ) ? esc_attr( $taxonomy[ 'with_front' ] ) : false,
					'key'               => 'with_front',
					'name'              => 'with-front',
					'id'                => 'with-front',
					'label_description' => esc_html__( 'Should the permalink structure be prepended with the front base.', 'npt' ),
					'field_description' => esc_html__( 'default: true', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ) ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ), 'default' => $default ),
					),
				),
				'rewrite_hierarchical'  => array(
					'label'             => esc_html__( 'Rewrite Hierarchical', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'rewrite_hierarchical' ] ) ? esc_attr( $taxonomy[ 'rewrite_hierarchical' ] ) : false,
					'key'               => 'rewrite_hierarchical',
					'name'              => 'rewrite-hierarchical',
					'id'                => 'rewrite-hierarchical',
					'label_description' => esc_html__( 'Either hierarchical rewrite tag or not.', 'npt' ),
					'field_description' => esc_html__( 'default: false', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ), 'default' => $default ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ) ),
					),
				),
				'query_var'             => array(
					'label'             => esc_html__( 'Query Var', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'query_var' ] ) ? esc_attr( $taxonomy[ 'query_var' ] ) : false,
					'key'               => 'query_var',
					'name'              => 'query-var',
					'id'                => 'query-var',
					'label_description' => esc_html__( 'Sets the query var key for this taxonomy.', 'npt' ),
					'field_description' => esc_html__( 'default: true', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ) ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ), 'default' => $default ),
					),
				),
				'query_var_slug'        => array(
					'label'             => esc_html__( 'Query Var Slug', 'npt' ),
					'type'              => 'text',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'query_var_slug' ] ) ? esc_attr( $taxonomy[ 'query_var_slug' ] ) : false,
					'key'               => 'query_var_slug',
					'name'              => 'query-var-slug',
					'id'                => 'query-var-slug',
					'placeholder'       => 'Default: Taxonomy Slug',
					'label_description' => esc_html__( 'Sets custom query var key for this taxonomy.', 'npt' ),
					'wrap'              => true,
				),
				'default_term'          => array(
					'label'             => esc_html__( 'Default Term', 'npt' ),
					'type'              => 'text',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $taxonomy[ 'default_term' ] ) ? esc_attr( $taxonomy[ 'default_term' ] ) : '',
					'key'               => 'default_term',
					'name'              => 'default-term',
					'id'                => 'default-term',
					'placeholder'       => '(e.g. name, slug, description)',
					'label_description' => esc_html__( 'Default term to be used for the taxonomy.', 'npt' ) . '</br>' . esc_html__( 'You can set taxonomy name, slug and description, only name required slug and description are optional.', 'npt' ),
					'wrap'              => true,
				),
			);
		}
		
		/**
		 * all fields of register taxonomy metabox based on attribute "group"
		 * @since   1.0.0
		 * @return array
		 */
		public function get_taxonomy_register_fields() {
			$args   = $this->npt_taxonomy_register_fields();
			$fields = array();
			foreach ( $args as $arg ) {
				if ( $arg[ 'group' ] == 'register' ) {
					$fields[] = $arg;
				}
			}
			
			return $fields;
		}
		
		/**
		 * all fields of taxonomy label metabox based on attribute "group"
		 * @since   1.0.0
		 * @return array
		 */
		public function get_taxonomy_labels_fields() {
			$args   = $this->npt_taxonomy_labels_fields();
			$fields = array();
			foreach ( $args as $arg ) {
				if ( $arg[ 'group' ] == 'labels' ) {
					$fields[] = $arg;
				}
			}
			
			return $fields;
		}
		
		/**
		 * all fields of taxonomy arguments metabox based on attribute "group"
		 * @since   1.0.0
		 * @return array
		 */
		public function get_taxonomy_arguments_fields() {
			$args   = $this->npt_taxonomy_arguments_fields();
			$fields = array();
			foreach ( $args as $arg ) {
				if ( $arg[ 'group' ] == 'arguments' ) {
					$fields[] = $arg;
				}
			}
			
			return $fields;
		}
		
		/**
		 * Generate register taxonomy metabox form
		 * @since   1.0.0
		 * @return void
		 */
		public function register_taxonomy_form() {
			
			echo $this->get_container_start( 'settings' );
			$args = $this->npt_taxonomy_register_fields();
			foreach ( $args as $arg ) {
				if ( $arg[ 'type' ] == 'text' ) {
					echo $this->get_text_field( $arg );
				}
				if ( $arg[ 'type' ] == 'checkbox' ) {
					echo $this->get_checkbox_field( $arg );
				}
				if ( $arg[ 'type' ] == 'textarea' ) {
					echo $this->get_textarea_field( $arg );
				}
			}
			echo $this->get_container_end();
		}
		
		/**
		 * Generate taxonomy labels metabox form
		 * @since   1.0.0
		 * @return void
		 */
		public function taxonomy_labels_form() {
			
			echo $this->get_container_start( 'settings', 'field-labels' );
			$args = $this->npt_taxonomy_labels_fields();
			foreach ( $args as $arg ) {
				if ( $arg[ 'type' ] == 'text' ) {
					echo $this->get_text_field( $arg );
				}
				if ( $arg[ 'type' ] == 'button' ) {
					echo $this->get_button_field( $arg );
				}
			}
			echo $this->get_container_end();
		}
		
		/**
		 * Generate taxonomy arguments metabox form
		 * @since   1.0.0
		 * @return void
		 */
		public function taxonomy_arguments_form() {
			echo $this->get_container_start( 'settings', 'field-arguments' );
			$args = $this->npt_taxonomy_arguments_fields();
			foreach ( $args as $arg ) {
				if ( $arg[ 'type' ] == 'text' ) {
					echo $this->get_text_field( $arg );
				}
				if ( $arg[ 'type' ] == 'select' ) {
					echo $this->get_select_field( $arg );
				}
				if ( $arg[ 'type' ] == 'checkbox' ) {
					echo $this->get_checkbox_field( $arg );
				}
			}
			echo $this->get_container_end();
		}
	}
endif;