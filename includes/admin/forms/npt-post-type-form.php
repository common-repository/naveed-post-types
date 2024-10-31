<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'NPT_Post_Type_Form' ) ) :
	
	class NPT_Post_Type_Form extends NPT_Fields {
		
		/**
		 * input fields attributes for register post type metabox
		 * fields will be generated according to following given attributes
		 * @since   1.0.0
		 * @return array[]
		 */
		public function npt_post_type_register_fields() {
			global $post;
			/**
			 * @since   1.0.0
			 * @var array $post_type
			 */
			$post_type = get_post_meta( $post->ID, 'npt_post_type', true );
			
			return $args = array(
				'slug'          => array(
					'label'             => esc_html__( 'Slug', 'npt' ),
					'type'              => 'text',
					'field'             => 'arguments',
					'group'             => 'register',
					'value'             => isset( $post_type[ 'slug' ] ) ? esc_attr( $post_type[ 'slug' ] ) : '',
					'key'               => 'slug',
					'name'              => 'slug',
					'id'                => 'slug',
					'placeholder'       => '(e.g. book)',
					'maxlength'         => 20,
					'label_description' => esc_html__( 'Unique but must not exceed 20 characters and may only contain lowercase alphanumeric characters, dashes, and underscores.', 'npt' ),
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
					'placeholder'       => '(e.g. Book)',
					'label_description' => esc_html__( 'Singular name for one object of this post type.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'singular_name' ] ) ? esc_attr( $post_type[ 'labels' ][ 'singular_name' ] ) : '',
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
					'placeholder'       => '(e.g. Books)',
					'label_description' => esc_html__( 'General plural name for the post type.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'name' ] ) ? esc_attr( $post_type[ 'labels' ][ 'name' ] ) : '',
					'required'          => true,
					'wrap'              => true,
				),
				'menu_icon'     => array(
					'label'             => esc_html__( 'Menu Icon', 'npt' ),
					'type'              => 'radio',
					'field'             => 'arguments',
					'group'             => 'register',
					'key'               => 'menu_icon',
					'name'              => 'menu-icon',
					'id'                => 'menu-icon',
					'class'             => 'form-control icon-field',
					'label_description' => esc_html__( 'Icon of the post type shown in the menu.', 'npt' ),
					'value'             => isset( $post_type[ 'menu_icon' ] ) ? esc_attr( $post_type[ 'menu_icon' ] ) : '',
					'required'          => false,
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
					'label_description' => esc_html__( 'A short descriptive summary of what the post type is.', 'npt' ),
					'value'             => isset( $post_type[ 'description' ] ) ? esc_attr( $post_type[ 'description' ] ) : '',
					'required'          => false,
					'wrap'              => true,
				),
			
			);
		}
		
		/**
		 * input fields attributes for post type labels metabox
		 * fields will be generated according to following given attributes
		 * @since   1.0.0
		 * @return array[]
		 */
		public function npt_post_type_labels_fields() {
			global $post;
			/**
			 * @since   1.0.0
			 * @var array $post_type
			 */
			$post_type = get_post_meta( $post->ID, 'npt_post_type', true );
			
			return $args = array(
				
				'buttons'                  => array(
					'label'             => esc_html__( 'Auto Populate labels', 'npt' ),
					'type'              => 'button',
					'field'             => 'button',
					'group'             => 'labels',
					'label_description' => esc_html__( 'Populate labels based on Register Post Type meta box values.', 'npt' ),
					'required'          => false,
					'wrap'              => true,
					'buttons'           => array(
						array( 'label' => 'Populate Labels', 'id' => 'auto-populate', 'href' => '#' ),
						array( 'label' => 'Clear Labels', 'id' => 'auto-clear', 'href' => '#' ),
					),
				),
				'menu_name'                => array(
					'label'             => esc_html__( 'Menu Name', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'menu_name',
					'name'              => 'menu-name',
					'id'                => 'menu-name',
					'placeholder'       => '(e.g. Books)',
					'label_description' => esc_html__( 'Label for the menu name.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'menu_name' ] ) ? esc_attr( $post_type[ 'labels' ][ 'menu_name' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( '%s', 'npt' ), 'item' ),
						'field' => 'name',
					),
				),
				'add_new'                  => array(
					'label'             => esc_html__( 'Add New', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'add_new',
					'name'              => 'add-new',
					'id'                => 'add-new',
					'placeholder'       => '(e.g. Add New)',
					'label_description' => esc_html__( 'Used in the admin menu for displaying post types.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'add_new' ] ) ? esc_attr( $post_type[ 'labels' ][ 'add_new' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => esc_attr__( 'Add New', 'npt' ),
						'field' => 'name',
					),
				),
				'add_new_item'             => array(
					'label'             => esc_html__( 'Add New Item', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'add_new_item',
					'name'              => 'add-new-item',
					'id'                => 'add-new-item',
					'placeholder'       => '(e.g. Add New Book)',
					'label_description' => esc_html__( 'Label for adding a new singular post type.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'add_new_item' ] ) ? esc_attr( $post_type[ 'labels' ][ 'add_new_item' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Add New %s', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'edit_item'                => array(
					'label'             => esc_html__( 'Edit Item', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'edit_item',
					'name'              => 'edit-item',
					'id'                => 'edit-item',
					'placeholder'       => '(e.g. Edit Book)',
					'label_description' => esc_html__( 'Label for editing a singular post type.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'edit_item' ] ) ? esc_attr( $post_type[ 'labels' ][ 'edit_item' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Edit %s', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'new_item'                 => array(
					'label'             => esc_html__( 'New Item', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'new_item',
					'name'              => 'new-item',
					'id'                => 'new-item',
					'placeholder'       => '(e.g. New Book)',
					'label_description' => esc_html__( 'Label for the new post type page title.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'new_item' ] ) ? esc_attr( $post_type[ 'labels' ][ 'new_item' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'New %s', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'view_item'                => array(
					'label'             => esc_html__( 'View Item', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'view_item',
					'name'              => 'view-item',
					'id'                => 'view-item',
					'placeholder'       => '(e.g. View Book)',
					'label_description' => esc_html__( 'Label for viewing a singular post type.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'view_item' ] ) ? esc_attr( $post_type[ 'labels' ][ 'view_item' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'View %s', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'view_items'               => array(
					'label'             => esc_html__( 'View Items', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'view_items',
					'name'              => 'view-items',
					'id'                => 'view-items',
					'placeholder'       => '(e.g. View Books)',
					'label_description' => esc_html__( 'Label for viewing post type archives.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'view_items' ] ) ? esc_attr( $post_type[ 'labels' ][ 'view_items' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'View %s', 'npt' ), 'item' ),
						'field' => 'name',
					),
				),
				'search_items'             => array(
					'label'             => esc_html__( 'Search Items', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'search_items',
					'name'              => 'search-items',
					'id'                => 'search-items',
					'placeholder'       => '(e.g. Search Books)',
					'label_description' => esc_html__( 'Label for searching plural items.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'search_items' ] ) ? esc_attr( $post_type[ 'labels' ][ 'search_items' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Search %s', 'npt' ), 'item' ),
						'field' => 'name',
					),
				),
				'not_found'                => array(
					'label'             => esc_html__( 'Not Found', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'not_found',
					'name'              => 'not-found',
					'id'                => 'not-found',
					'placeholder'       => '(e.g. No books found)',
					'label_description' => esc_html__( 'Label used when no post types are found.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'not_found' ] ) ? esc_attr( $post_type[ 'labels' ][ 'not_found' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'No %s found', 'npt' ), 'item' ),
						'field' => 'plural-slug',
					),
				),
				'not_found_in_trash'       => array(
					'label'             => esc_html__( 'Not Found in Trash', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'not_found_in_trash',
					'name'              => 'not-found-in-trash',
					'id'                => 'not-found-in-trash',
					'placeholder'       => '(e.g. No books found in Trash)',
					'label_description' => esc_html__( 'Label used when no post types are in the Trash.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'not_found_in_trash' ] ) ? esc_attr( $post_type[ 'labels' ][ 'not_found_in_trash' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'No %s found in Trash', 'npt' ), 'item' ),
						'field' => 'plural-slug',
					),
				),
				'parent_item_colon'        => array(
					'label'             => esc_html__( 'Parent Item', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'parent_item_colon',
					'name'              => 'parent-item-colon',
					'id'                => 'parent-item-colon',
					'placeholder'       => '(e.g. Parent Book:)',
					'label_description' => esc_html__( 'Label used to prefix parents of hierarchical post types.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'parent_item_colon' ] ) ? esc_attr( $post_type[ 'labels' ][ 'parent_item_colon' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Parent %s:', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'all_items'                => array(
					'label'             => esc_html__( 'All Items', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'all_items',
					'name'              => 'all-items',
					'id'                => 'all-items',
					'placeholder'       => '(e.g. All Books )',
					'label_description' => esc_html__( 'Label to signify all post types in a submenu link.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'all_items' ] ) ? esc_attr( $post_type[ 'labels' ][ 'all_items' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'All %s', 'npt' ), 'item' ),
						'field' => 'name',
					),
				),
				'archives'                 => array(
					'label'             => esc_html__( 'Archives', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'archives',
					'name'              => 'archives',
					'id'                => 'archives',
					'placeholder'       => '(e.g. Book Archives )',
					'label_description' => esc_html__( 'Label for archives in nav menus.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'archives' ] ) ? esc_attr( $post_type[ 'labels' ][ 'archives' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( '%s Archives', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'attributes'               => array(
					'label'             => esc_html__( 'Attributes', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'attributes',
					'name'              => 'attributes',
					'id'                => 'attributes',
					'placeholder'       => '(e.g. Book Attributes )',
					'label_description' => esc_html__( 'Label for the attributes meta box.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'attributes' ] ) ? esc_attr( $post_type[ 'labels' ][ 'attributes' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( '%s Attributes', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'insert_into_item'         => array(
					'label'             => esc_html__( 'Insert Into Items', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'insert_into_item',
					'name'              => 'insert-into-item',
					'id'                => 'insert-into-item',
					'placeholder'       => '(e.g. Insert into book )',
					'label_description' => esc_html__( 'Label for the media frame button.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'insert_into_item' ] ) ? esc_attr( $post_type[ 'labels' ][ 'insert_into_item' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Insert into %s', 'npt' ), 'item' ),
						'field' => 'slug',
					),
				),
				'uploaded_to_this_item'    => array(
					'label'             => esc_html__( 'Uploaded to this item', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'uploaded_to_this_item',
					'name'              => 'uploaded-to-this-item',
					'id'                => 'uploaded-to-this-item',
					'placeholder'       => '(e.g. Uploaded to this book )',
					'label_description' => esc_html__( 'Label for the media frame filter.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'uploaded_to_this_item' ] ) ? esc_attr( $post_type[ 'labels' ][ 'uploaded_to_this_item' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Uploaded to this %s', 'npt' ), 'item' ),
						'field' => 'slug',
					),
				),
				'featured_image'           => array(
					'label'             => esc_html__( 'Featured Image', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'featured_image',
					'name'              => 'featured-image',
					'id'                => 'featured-image',
					'placeholder'       => '(e.g. Book featured image )',
					'label_description' => esc_html__( 'Label for the featured image meta box title.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'featured_image' ] ) ? esc_attr( $post_type[ 'labels' ][ 'featured_image' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( '%s featured image', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'set_featured_image'       => array(
					'label'             => esc_html__( 'Set Featured Image', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'set_featured_image',
					'name'              => 'set-featured-image',
					'id'                => 'set-featured-image',
					'placeholder'       => '(e.g. Set book featured image )',
					'label_description' => esc_html__( 'Label for setting the featured image.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'set_featured_image' ] ) ? esc_attr( $post_type[ 'labels' ][ 'set_featured_image' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Set %s featured image', 'npt' ), 'item' ),
						'field' => 'slug',
					),
				),
				'remove_featured_image'    => array(
					'label'             => esc_html__( 'Remove Featured Image', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'remove_featured_image',
					'name'              => 'remove-featured-image',
					'id'                => 'remove-featured-image',
					'placeholder'       => '(e.g. Remove book featured image )',
					'label_description' => esc_html__( 'Label for removing the featured image.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'remove_featured_image' ] ) ? esc_attr( $post_type[ 'labels' ][ 'remove_featured_image' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Remove %s featured image', 'npt' ), 'item' ),
						'field' => 'slug',
					),
				),
				'use_featured_image'       => array(
					'label'             => esc_html__( 'Use Featured Image', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'use_featured_image',
					'name'              => 'use-featured-image',
					'id'                => 'use-featured-image',
					'placeholder'       => '(e.g. Use book featured image )',
					'label_description' => esc_html__( 'Label in the media frame for using a featured image.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'use_featured_image' ] ) ? esc_attr( $post_type[ 'labels' ][ 'use_featured_image' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Use %s featured image', 'npt' ), 'item' ),
						'field' => 'slug',
					),
				),
				'filter_items_list'        => array(
					'label'             => esc_html__( 'Filter Items List', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'filter_items_list',
					'name'              => 'filter-items-list',
					'id'                => 'filter-items-list',
					'placeholder'       => '(e.g. Filter book list )',
					'label_description' => esc_html__( 'Label for the table views hidden heading.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'filter_items_list' ] ) ? esc_attr( $post_type[ 'labels' ][ 'filter_items_list' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'Filter %s list', 'npt' ), 'item' ),
						'field' => 'slug',
					),
				),
				'items_list_navigation'    => array(
					'label'             => esc_html__( 'Items List Navigation', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'items_list_navigation',
					'name'              => 'items-list-navigation',
					'id'                => 'items-list-navigation',
					'placeholder'       => '(e.g. Books list navigation )',
					'label_description' => esc_html__( 'Label for the table pagination hidden heading.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'items_list_navigation' ] ) ? esc_attr( $post_type[ 'labels' ][ 'items_list_navigation' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( '%s list navigation', 'npt' ), 'item' ),
						'field' => 'name',
					),
				),
				'items_list'               => array(
					'label'             => esc_html__( 'Items List', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'items_list',
					'name'              => 'items-list',
					'id'                => 'items-list',
					'placeholder'       => '(e.g. Books list )',
					'label_description' => esc_html__( 'Label for the table hidden heading.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'items_list' ] ) ? esc_attr( $post_type[ 'labels' ][ 'items_list' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( '%s list', 'npt' ), 'item' ),
						'field' => 'name',
					),
				),
				'item_published'           => array(
					'label'             => esc_html__( 'Item Published', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'item_published',
					'name'              => 'item-published',
					'id'                => 'item-published',
					'placeholder'       => '(e.g. Book published )',
					'label_description' => esc_html__( 'Label used when a post type is published.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'item_published' ] ) ? esc_attr( $post_type[ 'labels' ][ 'item_published' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( '%s published', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'item_published_privately' => array(
					'label'             => esc_html__( 'Item Published privately', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'item_published_privately',
					'name'              => 'item-published-privately',
					'id'                => 'item-published-privately',
					'placeholder'       => '(e.g. Book published privately )',
					'label_description' => esc_html__( 'Label used when a post type is published with private visibility.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'item_published_privately' ] ) ? esc_attr( $post_type[ 'labels' ][ 'item_published_privately' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( '%s published privately', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'item_reverted_to_draft'   => array(
					'label'             => esc_html__( 'Item Reverted to Draft', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'item_reverted_to_draft',
					'name'              => 'item-reverted-to-draft',
					'id'                => 'reverted-to-draft',
					'placeholder'       => '(e.g. Book reverted to draft )',
					'label_description' => esc_html__( 'Label used when a post type is switched to a draft.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'item_reverted_to_draft' ] ) ? esc_attr( $post_type[ 'labels' ][ 'item_reverted_to_draft' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( '%s reverted to draft', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'item_scheduled'           => array(
					'label'             => esc_html__( 'Item Scheduled', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'item_scheduled',
					'name'              => 'item-scheduled',
					'id'                => 'scheduled',
					'placeholder'       => '(e.g. Book scheduled )',
					'label_description' => esc_html__( 'Label used when a post type is scheduled for publishing.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'item_scheduled' ] ) ? esc_attr( $post_type[ 'labels' ][ 'item_scheduled' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( '%s scheduled', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'item_updated'             => array(
					'label'             => esc_html__( 'Item Updated', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'item_updated',
					'name'              => 'item-updated',
					'id'                => 'updated',
					'placeholder'       => '(e.g. Book updated )',
					'label_description' => esc_html__( 'Label used when a post type is updated.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'item_updated' ] ) ? esc_attr( $post_type[ 'labels' ][ 'item_updated' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( '%s updated', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'item_link'                => array(
					'label'             => esc_html__( 'Item Link', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'item_link',
					'name'              => 'item-link',
					'id'                => 'item-link',
					'placeholder'       => '(e.g. Book link )',
					'label_description' => esc_html__( 'Title for a navigation link block variation.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'item_link' ] ) ? esc_attr( $post_type[ 'labels' ][ 'item_link' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( '%s link', 'npt' ), 'item' ),
						'field' => 'singular-name',
					),
				),
				'item_link_description'    => array(
					'label'             => esc_html__( 'Item Link Description', 'npt' ),
					'type'              => 'text',
					'field'             => 'labels',
					'group'             => 'labels',
					'key'               => 'item_link_description',
					'name'              => 'item-link-description',
					'id'                => 'link-description',
					'placeholder'       => '(e.g. A link to a book )',
					'label_description' => esc_html__( 'Description for a navigation link block variation.', 'npt' ),
					'value'             => isset( $post_type[ 'labels' ][ 'item_link_description' ] ) ? esc_attr( $post_type[ 'labels' ][ 'item_link_description' ] ) : '',
					'required'          => false,
					'wrap'              => true,
					'data'              => array(
						'label' => sprintf( esc_attr__( 'A link to a %s', 'npt' ), 'item' ),
						'field' => 'slug',
					),
				),
			
			);
		}
		
		/**
		 * input fields attributes for post type arguments metabox
		 * fields will be generated according to following given attributes
		 * @since   1.0.0
		 * @return array[]
		 */
		public function npt_post_type_arguments_fields() {
			global $post;
			/**
			 * @since   1.0.0
			 * @var array $post_type
			 */
			$post_type      = get_post_meta( $post->ID, 'npt_post_type', true );
			$npt_taxonomies = npt_get_object_taxonomies( $post_type );
			if ( $npt_taxonomies ) {
				$add_more_text = '+ Add More NPT Taxonomies';
			} else {
				$add_more_text = '+ Add NPT Taxonomies';
			}
			$default = false;
			if ( get_current_screen()->action == 'add' ) {
				$default = true;
			}
			
			return $args = array(
				'public'                => array(
					'label'             => esc_html__( 'Public', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $post_type[ 'public' ] ) ? esc_attr( $post_type[ 'public' ] ) : false,
					'key'               => 'public',
					'name'              => 'public',
					'id'                => 'public',
					'label_description' => esc_html__( 'Whether a post type is intended for use publicly either via the admin interface or by front-end users.', 'npt' ),
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
					'value'             => isset( $post_type[ 'hierarchical' ] ) ? esc_attr( $post_type[ 'hierarchical' ] ) : false,
					'key'               => 'hierarchical',
					'name'              => 'hierarchical',
					'id'                => 'hierarchical',
					'label_description' => esc_html__( 'Whether the post type is hierarchical (e.g. page).', 'npt' ),
					'field_description' => esc_html__( 'default: false', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ), 'default' => $default ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ) ),
					),
				),
				'exclude_from_search'   => array(
					'label'             => esc_html__( 'Exclude From Search', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $post_type[ 'exclude_from_search' ] ) ? esc_attr( $post_type[ 'exclude_from_search' ] ) : false,
					'key'               => 'exclude_from_search',
					'name'              => 'exclude-from-search',
					'id'                => 'exclude-from-search',
					'label_description' => esc_html__( 'Whether to exclude posts with this post type from front end search results.', 'npt' ),
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
					'value'             => isset( $post_type[ 'publicly_queryable' ] ) ? esc_attr( $post_type[ 'publicly_queryable' ] ) : false,
					'key'               => 'publicly_queryable',
					'name'              => 'publicly-queryable',
					'id'                => 'publicly-queryable',
					'label_description' => esc_html__( 'Whether queries can be performed on the front end for the post type as part of parse_request().', 'npt' ),
					'field_description' => esc_html__( 'default: true', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ) ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ), 'default' => $default ),
					),
				),
				'show_ui'               => array(
					'label'             => esc_html__( 'Show UI', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $post_type[ 'show_ui' ] ) ? esc_attr( $post_type[ 'show_ui' ] ) : false,
					'key'               => 'show_ui',
					'name'              => 'show-ui',
					'id'                => 'show-ui',
					'label_description' => esc_html__( 'Whether to generate and allow a UI for managing this post type in the admin.', 'npt' ),
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
					'value'             => isset( $post_type[ 'show_in_menu' ] ) ? esc_attr( $post_type[ 'show_in_menu' ] ) : false,
					'key'               => 'show_in_menu',
					'name'              => 'show-in-menu',
					'id'                => 'show-in-menu',
					'label_description' => esc_html__( 'Where to show the post type in the admin menu.', 'npt' ),
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
					'value'             => isset( $post_type[ 'show_in_nav_menus' ] ) ? esc_attr( $post_type[ 'show_in_nav_menus' ] ) : false,
					'key'               => 'show_in_nav_menus',
					'name'              => 'show-in-nav-menus',
					'id'                => 'show-in-nav-menus',
					'label_description' => esc_html__( 'Makes this post type available for selection in navigation menus.', 'npt' ),
					'field_description' => esc_html__( 'default: true', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ) ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ), 'default' => $default ),
					),
				),
				'show_in_admin_bar'     => array(
					'label'             => esc_html__( 'Show in Admin Bar', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $post_type[ 'show_in_admin_bar' ] ) ? esc_attr( $post_type[ 'show_in_admin_bar' ] ) : false,
					'key'               => 'show_in_admin_bar',
					'name'              => 'show-in-admin-bar',
					'id'                => 'show-in-admin-bar',
					'label_description' => esc_html__( 'Makes this post type available via the admin bar.', 'npt' ),
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
					'value'             => isset( $post_type[ 'show_in_rest' ] ) ? esc_attr( $post_type[ 'show_in_rest' ] ) : false,
					'key'               => 'show_in_rest',
					'name'              => 'show-in-rest',
					'id'                => 'show-in-rest',
					'label_description' => esc_html__( 'Whether to include the post type in the REST API. Set this to true for the post type to be available in the block editor.', 'npt' ),
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
					'value'             => isset( $post_type[ 'rest_base' ] ) ? esc_attr( $post_type[ 'rest_base' ] ) : '',
					'key'               => 'rest_base',
					'name'              => 'rest-base',
					'id'                => 'rest-base',
					'placeholder'       => 'Slug to use in REST API URLs',
					'label_description' => esc_html__( 'To change the base URL of REST API route.', 'npt' ),
					'wrap'              => true,
				),
				'rest_namespace'        => array(
					'label'             => esc_html__( 'Rest API Namespace', 'npt' ),
					'type'              => 'text',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $post_type[ 'rest_namespace' ] ) ? esc_attr( $post_type[ 'rest_namespace' ] ) : '',
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
					'value'             => isset( $post_type[ 'rest_controller_class' ] ) ? esc_attr( $post_type[ 'rest_controller_class' ] ) : '',
					'key'               => 'rest_controller_class',
					'name'              => 'rest-controller-class',
					'id'                => 'rest-controller-class',
					'placeholder'       => 'Default: WP_REST_Posts_Controller',
					'label_description' => esc_html__( 'Read more about ', 'npt' ) . '<a target="_blank" href="https://developer.wordpress.org/reference/classes/wp_rest_posts_controller/">' . esc_html__( 'WP_REST_Posts_Controller', 'npt' ) . '</a>',
					'wrap'              => true,
				),
				'menu_position'         => [
					'label'             => esc_html__( 'Menu Position', 'npt' ),
					'type'              => 'text',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $post_type[ 'menu_position' ] ) ? esc_attr( $post_type[ 'menu_position' ] ) : '',
					'key'               => 'menu_position',
					'name'              => 'menu-position',
					'id'                => 'menu-position',
					'label_description' => esc_html__( 'The position in the menu order the post type should appear.', 'npt' ) . '<br>' . esc_html__( 'Range ( 5 - 100 ) Read more about ', 'npt' ) . ' <a target="_blank" href="https://developer.wordpress.org/reference/functions/register_post_type/#menu_position">' . esc_html__( 'Menu Position', 'npt' ) . '</a>',
					'wrap'              => true,
				],
				'capability_type'       => array(
					'label'             => esc_html__( 'Capability Type', 'npt' ),
					'type'              => 'text',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $post_type[ 'capability_type' ] ) ? esc_attr( $post_type[ 'capability_type' ] ) : 'post',
					'key'               => 'capability_type',
					'name'              => 'capability-type',
					'id'                => 'capability-type',
					'label_description' => esc_html__( 'The string to use to build the read, edit, and delete capabilities.  A comma-separated second value can be used for plural version. Default value is ', 'npt' ) . '<b>' . esc_html__( 'post', 'npt' ) . '</b>',
					'wrap'              => true,
				),
				'supports'              => array(
					'label'             => esc_html__( 'Supports', 'npt' ),
					'value'             => 'supports',
					'type'              => 'checkbox',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'key'               => 'supports',
					'name'              => 'supports',
					'id'                => 'supports',
					'label_description' => esc_html__( 'Controls that are available in the edit screen for the post type.', 'npt' ) . '</br></br>' . esc_html__( 'By default, only the ', 'npt' ) . '<b>' . esc_html__( 'Title ', 'npt' ) . '</b>' . esc_html__( ' field and ', 'npt' ) . '<b>' . esc_html__( 'Editor ', 'npt' ) . '</b>' . esc_html__( 'are shown if you do not want any default support please check ', 'npt' ) . '<b>' . esc_html__( 'None ', 'npt' ) . '</b>' . esc_html__( 'option.', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array(
							'value'   => 'title',
							'checked' => isset( $post_type[ 'supports' ] ) && in_array( 'title', $post_type[ 'supports' ] ) ? esc_attr( 'title' ) : '',
							'key'     => 'title',
							'name'    => 'title',
							'id'      => 'title',
							'label'   => esc_html__( 'Title', 'npt' ),
							'default' => $default,
						),
						array(
							'value'   => 'editor',
							'checked' => isset( $post_type[ 'supports' ] ) && in_array( 'editor', $post_type[ 'supports' ] ) ? esc_attr( 'editor' ) : '',
							'key'     => 'editor',
							'name'    => 'editor',
							'id'      => 'editor',
							'label'   => esc_html__( 'Editor', 'npt' ),
							'default' => $default,
						),
						array(
							'value'   => 'thumbnail',
							'checked' => isset( $post_type[ 'supports' ] ) && in_array( 'thumbnail', $post_type[ 'supports' ] ) ? esc_attr( 'thumbnail' ) : '',
							'key'     => 'thumbnail',
							'name'    => 'thumbnail',
							'id'      => 'thumbnail',
							'label'   => esc_html__( 'Featured Image', 'npt' ),
							'default' => false,
						),
						array(
							'value'   => 'excerpt',
							'checked' => isset( $post_type[ 'supports' ] ) && in_array( 'excerpt', $post_type[ 'supports' ] ) ? esc_attr( 'excerpt' ) : '',
							'key'     => 'excerpt',
							'name'    => 'excerpts',
							'id'      => 'excerpts',
							'label'   => esc_html__( 'Excerpt', 'npt' ),
							'default' => false,
						),
						array(
							'value'   => 'page-attributes',
							'checked' => isset( $post_type[ 'supports' ] ) && in_array( 'page-attributes', $post_type[ 'supports' ] ) ? esc_attr( 'page-attributes' ) : '',
							'key'     => 'page_attributes',
							'name'    => 'page-attributes',
							'id'      => 'page-attributes',
							'label'   => esc_html__( 'Page Attributes', 'npt' ),
							'default' => false,
						),
						array(
							'value'   => 'post-formats',
							'checked' => isset( $post_type[ 'supports' ] ) && in_array( 'post-formats', $post_type[ 'supports' ] ) ? esc_attr( 'post-formats' ) : '',
							'key'     => 'post_formats',
							'name'    => 'post-formats',
							'id'      => 'post-formats',
							'label'   => esc_html__( 'Post Formats', 'npt' ),
							'default' => false,
						),
						array(
							'value'   => 'author',
							'checked' => isset( $post_type[ 'supports' ] ) && in_array( 'author', $post_type[ 'supports' ] ) ? esc_attr( 'author' ) : '',
							'key'     => 'author',
							'name'    => 'author',
							'id'      => 'author',
							'label'   => esc_html__( 'Author', 'npt' ),
							'default' => false,
						),
						array(
							'value'   => 'revisions',
							'checked' => isset( $post_type[ 'supports' ] ) && in_array( 'revisions', $post_type[ 'supports' ] ) ? esc_attr( 'revisions' ) : '',
							'key'     => 'revisions',
							'name'    => 'revisions',
							'id'      => 'revisions',
							'label'   => esc_html__( 'Revisions', 'npt' ),
							'default' => false,
						),
						array(
							'value'   => 'comments',
							'checked' => isset( $post_type[ 'supports' ] ) && in_array( 'comments', $post_type[ 'supports' ] ) ? esc_attr( 'comments' ) : '',
							'key'     => 'comments',
							'name'    => 'comments',
							'id'      => 'comments',
							'label'   => esc_html__( 'Comments', 'npt' ),
							'default' => false,
						),
						array(
							'value'   => 'custom-fields',
							'checked' => isset( $post_type[ 'supports' ] ) && in_array( 'custom-fields', $post_type[ 'supports' ] ) ? esc_attr( 'custom-fields' ) : '',
							'key'     => 'custom_fields',
							'name'    => 'custom-fields',
							'id'      => 'custom-fields',
							'label'   => esc_html__( 'Custom Fields', 'npt' ),
							'default' => false,
						),
						array(
							'value'   => 'trackbacks',
							'checked' => isset( $post_type[ 'supports' ] ) && in_array( 'trackbacks', $post_type[ 'supports' ] ) ? esc_attr( 'trackbacks') : '',
							'key'     => 'trackbacks',
							'name'    => 'trackbacks',
							'id'      => 'trackbacks',
							'label'   => esc_html__( 'Trackbacks', 'npt' ),
							'default' => false,
						),
						array(
							'value'   => 'none',
							'checked' => isset( $post_type[ 'supports' ] ) && in_array( 'none', $post_type[ 'supports' ] ) ? esc_attr( 'none') : '',
							'key'     => 'none',
							'name'    => 'none',
							'id'      => 'none',
							'label'   => esc_html__( 'None', 'npt' ),
							'default' => false,
						),
					),
				),
				'register_meta_box_cb'  => array(
					'label'             => esc_html__( 'Metabox Callback', 'npt' ),
					'type'              => 'text',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $post_type[ 'register_meta_box_cb' ] ) ? esc_attr( $post_type[ 'register_meta_box_cb' ]) : '',
					'key'               => 'register_meta_box_cb',
					'name'              => 'register-meta-box-cb',
					'id'                => 'register-meta-box-cb',
					'placeholder'       => 'Default: null',
					'label_description' => esc_html__( 'Provide a callback function for meta boxes in the edit form.', 'npt' ),
					'wrap'              => true,
				),
				'has_archive'           => array(
					'label'             => esc_html__( 'Has Archive', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $post_type[ 'has_archive' ] ) ? esc_attr( $post_type[ 'has_archive' ]) : false,
					'key'               => 'has_archive',
					'name'              => 'has-archive',
					'id'                => 'has-archive',
					'label_description' => esc_html__( 'Whether or not the post type will have a post type archive URL.', 'npt' ),
					'field_description' => esc_html__( 'default: true', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ) ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ), 'default' => $default ),
					),
				),
				'rewrite'               => array(
					'label'             => esc_html__( 'Rewrite', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $post_type[ 'rewrite' ] ) ? esc_attr( $post_type[ 'rewrite' ]) : false,
					'key'               => 'rewrite',
					'name'              => 'rewrite',
					'id'                => 'rewrite',
					'label_description' => esc_html__( 'Triggers the handling of rewrites for this post type.', 'npt' ),
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
					'value'             => isset( $post_type[ 'rewrite_slug' ] ) ? esc_attr( $post_type[ 'rewrite_slug' ]) : '',
					'key'               => 'rewrite_slug',
					'name'              => 'rewrite-slug',
					'id'                => 'rewrite-slug',
					'placeholder'       => 'Default: Post Type Slug',
					'label_description' => esc_html__( 'Custom post type slug to use instead of the default.', 'npt' ),
					'wrap'              => true,
				),
				'with_front'            => array(
					'label'             => esc_html__( 'With Front', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $post_type[ 'with_front' ] ) ? esc_attr( $post_type[ 'with_front' ]) : false,
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
				'query_var'             => array(
					'label'             => esc_html__( 'Query Var', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $post_type[ 'query_var' ] ) ? esc_attr( $post_type[ 'query_var' ]) : false,
					'key'               => 'query_var',
					'name'              => 'query-var',
					'id'                => 'query-var',
					'label_description' => esc_html__( 'Sets the query_var key for this post type.', 'npt' ),
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
					'value'             => isset( $post_type[ 'query_var_slug' ] ) ? esc_attr( $post_type[ 'query_var_slug' ]) : '',
					'key'               => 'query_var_slug',
					'name'              => 'query-var-slug',
					'id'                => 'query-var-slug',
					'placeholder'       => 'Default: Post Type Slug',
					'label_description' => esc_html__( 'Custom query var slug to use instead of the default.', 'npt' ) . '</br>' . esc_html__( 'To use this ', 'npt' ) . '<b>' . esc_html__( 'Query Var ', 'npt' ) . '</b>' . esc_html__( 'should be true.', 'npt' ),
					'wrap'              => true,
				),
				'can_export'            => array(
					'label'             => esc_html__( 'Can Export', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $post_type[ 'can_export' ] ) ? esc_attr( $post_type[ 'can_export' ]) : false,
					'key'               => 'can_export',
					'name'              => 'can-export',
					'id'                => 'can-export',
					'label_description' => esc_html__( 'Can this post type be exported.', 'npt' ),
					'field_description' => esc_html__( 'default: true', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ) ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ), 'default' => $default ),
					),
				),
				'delete_with_user'      => array(
					'label'             => esc_html__( 'Delete with user', 'npt' ),
					'type'              => 'select',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'value'             => isset( $post_type[ 'delete_with_user' ] ) ? esc_attr( $post_type[ 'delete_with_user' ]) : false,
					'key'               => 'delete_with_user',
					'name'              => 'delete-with-user',
					'id'                => 'delete-with-user',
					'label_description' => esc_html__( 'Whether to delete posts of this type when deleting a user. If true, posts of this type belonging to the user will be moved to trash when then user is deleted.', 'npt' ),
					'field_description' => esc_html__( 'default: false', 'npt' ),
					'wrap'              => true,
					'options'           => array(
						array( 'option' => 0, 'text' => esc_attr__( 'False', 'npt' ), 'default' => $default ),
						array( 'option' => 1, 'text' => esc_attr__( 'True', 'npt' ) ),
					),
				),
				'taxonomies'            => array(
					'label'             => esc_html__( 'WP Core Taxonomies', 'npt' ),
					'value'             => 'taxonomies',
					'type'              => 'checkbox',
					'field'             => 'arguments',
					'group'             => 'arguments',
					'key'               => 'taxonomies',
					'name'              => 'taxonomies',
					'id'                => 'taxonomies',
					'label_description' => 'Add support for WordPress core taxonomies.',
					'wrap'              => true,
					'options'           => npt_get_taxonomies( $post_type ),
				),
				'npt_taxonomies'        => array(
					'label'             => esc_html__( 'NPT Taxonomies', 'npt' ),
					'value'             => 'taxonomies',
					'type'              => 'list',
					'field'             => 'list',
					'group'             => 'arguments',
					'key'               => 'taxonomies',
					'name'              => 'taxonomies',
					'id'                => 'taxonomies',
					'label_description' => 'Added support for NPT taxonomies.',
					'field_description' => '<a href="' . esc_url( admin_url( 'edit.php?post_type=npt-taxonomy' ) ) . '">' . esc_html__( $add_more_text, 'npt' ) . '</a>',
					'wrap'              => true,
					'options'           => npt_get_object_taxonomies( $post_type ),
				),
			);
		}
		
		/**
		 * all fields of register post type metabox based on attribute "group"
		 * @since   1.0.0
		 * @return array
		 */
		public function get_post_type_register_fields() {
			$args   = $this->npt_post_type_register_fields();
			$fields = array();
			foreach ( $args as $arg ) {
				if ( $arg[ 'group' ] == 'register' ) {
					$fields[] = $arg;
				}
			}
			
			return $fields;
		}
		
		/**
		 * all fields of post type labels metabox based on attribute "group"
		 * @since   1.0.0
		 * @return array
		 */
		public function get_post_type_labels_fields() {
			$args   = $this->npt_post_type_labels_fields();
			$fields = array();
			foreach ( $args as $arg ) {
				if ( $arg[ 'group' ] == 'labels' ) {
					$fields[] = $arg;
				}
			}
			
			return $fields;
		}
		
		/**
		 * all fields of post type attributes metabox based on attribute "group"
		 * @since   1.0.0
		 * @return array
		 */
		public function get_post_type_arguments_fields() {
			$args   = $this->npt_post_type_arguments_fields();
			$fields = array();
			foreach ( $args as $arg ) {
				if ( $arg[ 'group' ] == 'arguments' ) {
					$fields[] = $arg;
				}
			}
			
			return $fields;
		}
		
		/**
		 * Generate register post type metabox form
		 * @since   1.0.0
		 * @return void
		 */
		public function register_post_type_form() {
			
			echo $this->get_container_start( 'settings' );
			$args = $this->npt_post_type_register_fields();
			foreach ( $args as $arg ) {
				if ( $arg[ 'type' ] == 'text' ) {
					echo $this->get_text_field( $arg );
				}
				if ( $arg[ 'type' ] == 'radio' ) {
					echo $this->get_radio_field( $arg );
				}
				if ( $arg[ 'type' ] == 'textarea' ) {
					echo $this->get_textarea_field( $arg );
				}
			}
			echo $this->get_container_end();
		}
		
		/**
		 * Generate post type labels metabox form
		 * @since   1.0.0
		 * @return void
		 */
		public function post_type_labels_form() {
			
			echo $this->get_container_start( 'settings', 'field-labels' );
			$args = $this->npt_post_type_labels_fields();
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
		 * Generate post type arguments metabox form
		 * @since   1.0.0
		 * @return void
		 */
		public function post_type_arguments_form() {
			echo $this->get_container_start( 'settings', 'field-arguments' );
			$args = $this->npt_post_type_arguments_fields();
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
				if ( $arg[ 'type' ] == 'list' ) {
					echo $this->get_list_field( $arg );
				}
			}
			echo $this->get_container_end();
		}
	}
endif;