<?php

/**
 *  npt_get_setting
 *  alias of npt()->get_setting()
 * @since   1.0.0
 * @param $name
 * @return mixed|null $name
 */

function npt_get_setting( $name ) {
	return npt()->get_setting( $name );
}

/**
 * npt_screen
 * @since   1.0.0
 * @param   $screen
 * @return mixed|void $screen
 */
function npt_screen( $screen ) {
	if ( isset( $screen->post_type ) && $screen->post_type === 'npt-post-type' ) {
		return $screen;
	}
	if ( isset( $screen->post_type ) && $screen->post_type === 'npt-taxonomy' ) {
		return $screen;
	}
	if ( isset( $screen->base ) && $screen->base === 'toplevel_page_naveed-post-types' ) {
		return $screen;
	}
}

/**
 * get the list of WordPress core taxonomies.
 * @since   1.0.0
 * @param $post_type
 * @return array|mixed
 * @see     /naveed-post-type/includes/admin/forms/npt-post-type-form.php
 */
function npt_get_taxonomies( $post_type ) {
	$args            = array(
		'public' => true
	);
	$fields          = array();
	$taxonomy_fields = array();
	$taxonomies      = get_taxonomies( $args, 'objects' );
	unset( $taxonomies[ 'nav_menu' ], $taxonomies[ 'post_format' ] );
	foreach ( $taxonomies as $taxonomy ) {
		$core_taxonomies = in_array( $taxonomy->name, array( 'category', 'post_tag' ) ) ? __( '(WP Core)', 'npt' ) : '';
		if ( ! empty( $core_taxonomies ) ) {
			$fields[] = array(
				array(
					'value'   => $taxonomy->name,
					'checked' => isset( $post_type[ 'taxonomies' ] ) && in_array( $taxonomy->name, $post_type[ 'taxonomies' ] ) ? esc_attr( $taxonomy->name ) : '',
					'key'     => $taxonomy->name,
					'name'    => $taxonomy->name,
					'id'      => $taxonomy->name,
					'label'   => esc_html( $taxonomy->label ),
					'default' => false,
				)
			);
		}
		$taxonomy_fields = call_user_func_array( 'array_merge', $fields );
	}
	
	return $taxonomy_fields;
}

/**
 * simply attached NPT Taxonomies for npt-post-type
 * @since   1.0.0
 * @param $post_type
 * @return array|mixed
 * @see     /naveed-post-type/includes/admin/forms/npt-post-type-form.php
 */
function npt_get_object_taxonomies( $post_type ) {
	$fields          = array();
	$taxonomy_fields = array();
	if ( $post_type ) {
		$taxonomies = get_object_taxonomies( $post_type[ 'slug' ], 'objects' );
		unset( $taxonomies[ 'category' ], $taxonomies[ 'post_tag' ] );
		foreach ( $taxonomies as $taxonomy ) {
			$post_id         = get_page_by_path( $taxonomy->name, OBJECT, 'npt-taxonomy' );
			$selected_tax    = get_post( $post_id );
			$fields[]        = array(
				array(
					'link'  => get_edit_post_link( $post_id ),
					'label' => esc_html( $selected_tax->post_title ),
				)
			);
			$taxonomy_fields = call_user_func_array( 'array_merge', $fields );
		}
	}
	
	return $taxonomy_fields;
}

/**
 * Get the list all public post types
 * @since   1.0.0
 * @param $taxonomies
 * @return array|mixed
 * @see     /naveed-post-type/includes/admin/forms/npt-taxonomy-form.php
 */
function npt_get_post_types( $taxonomies ) {
	$args             = array(
		'public' => true,
	);
	$fields           = array();
	$post_type_fields = array();
	$post_types       = get_post_types( $args, 'objects' );
	foreach ( $post_types as $post ) {
		$core_label = in_array( $post->name, array( 'post', 'page', 'attachment' ) ) ? __( '(WP Core)', 'npt' ) : '';
		
		$fields[]         = array(
			array(
				'value'   => $post->name,
				'checked' => isset( $taxonomies[ 'post_types' ] ) && in_array( $post->name, $taxonomies[ 'post_types' ] ) ? esc_attr( $post->name ) : '',
				'key'     => $post->name,
				'name'    => $post->name,
				'id'      => $post->name,
				'label'   => esc_html( $post->labels->singular_name . ' ' . $core_label ),
				'default' => false,
			)
		);
		$post_type_fields = call_user_func_array( 'array_merge', $fields );
	}
	
	return $post_type_fields;
}

/**
 * Get all text fields
 * @see     /naveed-post-type/includes/admin/meta-boxes/
 * @since   1.0.0
 * @param $post_meta
 * @param $field
 * @return mixed
 */
function npt_get_text_fields( $post_meta, $field ) {
	$fields = array();
	foreach ( $post_meta as $val ) {
		if ( is_array( $val ) && $val[ 'field' ] == $field && $val[ 'type' ] == 'text' ) {
			$value    = isset( $_POST[ $val[ 'name' ] ] ) ? sanitize_text_field( $_POST[ $val[ 'name' ] ] ) : false;
			$fields[] = array( $val[ 'key' ] => $value );
		}
	}
	
	return call_user_func_array( 'array_merge', $fields );
}

/**
 * Get all radio fields
 * @see     /naveed-post-type/includes/admin/meta-boxes/
 * @since   1.0.0
 * @param $post_meta
 * @param $field
 * @return mixed
 */
function npt_get_radio_fields( $post_meta, $field ) {
	$fields = array();
	foreach ( $post_meta as $val ) {
		if ( is_array( $val ) && $val[ 'field' ] == $field && $val[ 'type' ] == 'radio' ) {
			$value    = isset( $_POST[ $val[ 'name' ] ] ) ? sanitize_text_field( $_POST[ $val[ 'name' ] ] ) : false;
			$fields[] = array( $val[ 'key' ] => $value );
		}
	}
	
	return call_user_func_array( 'array_merge', $fields );
}

/**
 * Get all textarea fields
 * @see     /naveed-post-type/includes/admin/meta-boxes/
 * @since   1.0.0
 * @param $post_meta
 * @param $field
 * @return mixed
 */
function npt_get_textarea_fields( $post_meta, $field ) {
	$fields = array();
	foreach ( $post_meta as $val ) {
		if ( is_array( $val ) && $val[ 'field' ] == $field && $val[ 'type' ] == 'textarea' ) {
			$value    = isset( $_POST[ $val[ 'name' ] ] ) ? sanitize_text_field( $_POST[ $val[ 'name' ] ] ) : false;
			$fields[] = array( $val[ 'key' ] => $value );
		}
	}
	
	return call_user_func_array( 'array_merge', $fields );
}

/**
 * Get all select fields
 * @see     /naveed-post-type/includes/admin/meta-boxes/
 * @since   1.0.0
 * @param $post_meta
 * @param $field
 * @return mixed
 */
function npt_get_select_fields( $post_meta, $field ) {
	$fields = array();
	foreach ( $post_meta as $val ) {
		if ( is_array( $val ) && $val[ 'field' ] == $field && $val[ 'type' ] == 'select' ) {
			$value    = isset( $_POST[ $val[ 'name' ] ] ) ? sanitize_text_field( $_POST[ $val[ 'name' ] ] ) : false;
			$fields[] = array( $val[ 'key' ] => (bool) $value );
		}
	}
	
	return call_user_func_array( 'array_merge', $fields );
}

/**
 * Get all checkbox fields
 * @see     /naveed-post-type/includes/admin/meta-boxes/
 * @since   1.0.0
 * @param $post_meta
 * @param $field
 * @param $key
 * @return mixed
 */
function npt_get_checkbox_fields( $post_meta, $field, $key ) {
	$fields = $group_fields = $array_merge_fields = array();
	foreach ( (array) $post_meta as $values ) {
		if ( is_array( $values ) && $values[ 'field' ] == $field && $values[ 'type' ] == 'checkbox' && $values[ 'key' ] == $key ) {
			foreach ( $values[ 'options' ] as $option ) {
				if ( is_array( $option ) && array_key_exists( 'name', $option ) ) {
					$value = isset( $_POST[ $option[ 'name' ] ] ) ? sanitize_text_field( $_POST[ $option[ 'name' ] ] ) : false;
					if ( $value ) {
						$fields[] = array( $value );
					}
					$array_merge_fields = call_user_func_array( 'array_merge', $fields );
				}
			}
			$group_fields[] = array( $values[ 'key' ] => $array_merge_fields );
		}
	}
	
	return call_user_func_array( 'array_merge', $group_fields );
}

/**
 * Function register_post_type labels and args
 * @since   1.0.0
 * @param $post_type
 * @return void
 */
function npt_post_types( $post_type ) {
	$labels = array(
		'singular_name'            => _x( $post_type[ 'labels' ][ 'singular_name' ], 'Post type general name', 'npt' ),
		'name'                     => _x( $post_type[ 'labels' ][ 'name' ], 'Post type singular name', 'npt' ),
		'menu_name'                => _x( $post_type[ 'labels' ][ 'menu_name' ], 'Admin Menu text', 'npt' ),
		'add_new'                  => _x( $post_type[ 'labels' ][ 'add_new' ], 'Add New text', 'npt' ),
		'add_new_item'             => __( $post_type[ 'labels' ][ 'add_new_item' ], 'npt' ),
		'edit_item'                => __( $post_type[ 'labels' ][ 'edit_item' ], 'npt' ),
		'new_item'                 => __( $post_type[ 'labels' ][ 'new_item' ], 'npt' ),
		'view_item'                => __( $post_type[ 'labels' ][ 'view_item' ], 'npt' ),
		'view_items'               => __( $post_type[ 'labels' ][ 'view_items' ], 'npt' ),
		'all_items'                => __( $post_type[ 'labels' ][ 'all_items' ], 'npt' ),
		'search_items'             => __( $post_type[ 'labels' ][ 'search_items' ], 'npt' ),
		'not_found'                => __( $post_type[ 'labels' ][ 'not_found' ], 'npt' ),
		'not_found_in_trash'       => __( $post_type[ 'labels' ][ 'not_found_in_trash' ], 'npt' ),
		'parent_item_colon'        => __( $post_type[ 'labels' ][ 'parent_item_colon' ], 'npt' ),
		'archives'                 => __( $post_type[ 'labels' ][ 'archives' ], 'npt' ),
		'attributes'               => __( $post_type[ 'labels' ][ 'attributes' ], 'npt' ),
		'insert_into_item'         => __( $post_type[ 'labels' ][ 'insert_into_item' ], 'npt' ),
		'uploaded_to_this_item'    => __( $post_type[ 'labels' ][ 'uploaded_to_this_item' ], 'npt' ),
		'featured_image'           => __( $post_type[ 'labels' ][ 'featured_image' ], 'npt' ),
		'set_featured_image'       => __( $post_type[ 'labels' ][ 'set_featured_image' ], 'npt' ),
		'remove_featured_image'    => __( $post_type[ 'labels' ][ 'remove_featured_image' ], 'npt' ),
		'use_featured_image'       => __( $post_type[ 'labels' ][ 'use_featured_image' ], 'npt' ),
		'filter_items_list'        => __( $post_type[ 'labels' ][ 'filter_items_list' ], 'npt' ),
		'items_list_navigation'    => __( $post_type[ 'labels' ][ 'items_list_navigation' ], 'npt' ),
		'items_list'               => __( $post_type[ 'labels' ][ 'items_list' ], 'npt' ),
		'item_published'           => __( $post_type[ 'labels' ][ 'item_published' ], 'npt' ),
		'item_published_privately' => __( $post_type[ 'labels' ][ 'item_published_privately' ], 'npt' ),
		'item_reverted_to_draft'   => __( $post_type[ 'labels' ][ 'item_reverted_to_draft' ], 'npt' ),
		'item_scheduled'           => __( $post_type[ 'labels' ][ 'item_scheduled' ], 'npt' ),
		'item_updated'             => __( $post_type[ 'labels' ][ 'item_updated' ], 'npt' ),
		'item_link'                => __( $post_type[ 'labels' ][ 'item_link' ], 'npt' ),
		'item_link_description'    => __( $post_type[ 'labels' ][ 'item_link_description' ], 'npt' ),
	);
	
	/**
	 * @var null|string $rest_base
	 */
	if ( empty( $post_type[ 'rest_base' ] ) ) {
		$rest_base = null;
	} else {
		$rest_base = $post_type[ 'rest_base' ];
	}
	
	/**
	 * @var null|string $rest_controller_class
	 */
	if ( empty( $post_type[ 'rest_controller_class' ] ) ) {
		$rest_controller_class = null;
	} else {
		$rest_controller_class = $post_type[ 'rest_controller_class' ];
	}
	
	/**
	 * @var null|string $rest_namespace
	 */
	if ( empty( $post_type[ 'rest_namespace' ] ) ) {
		$rest_namespace = null;
	} else {
		$rest_namespace = $post_type[ 'rest_namespace' ];
	}
	
	/**
	 * @var null|string $query_var
	 */
	$register_meta_box_cb = trim( $post_type[ 'register_meta_box_cb' ] );
	if ( empty( $register_meta_box_cb ) ) {
		$register_meta_box_cb = null;
	}
	
	/**
	 * @var bool|array $rewrite
	 */
	$rewrite_slug = $post_type[ 'rewrite_slug' ];
	$with_front   = (bool) $post_type[ 'with_front' ];
	$rewrite_val  = (bool) $post_type[ 'rewrite' ];
	if ( ! $rewrite_val ) {
		$rewrite_val = false;
	} else {
		if ( empty( $rewrite_slug ) ) {
			$output = $post_type[ 'slug' ];
		} else {
			$output = $rewrite_slug;
		}
		$rewrite_val = array( 'slug' => $output, 'with_front' => $with_front );
	}
	$rewrite = $rewrite_val;
	
	/**
	 * @var bool|string $query_var
	 */
	$query_var_slug = $post_type[ 'query_var_slug' ];
	if ( ! $post_type[ 'query_var' ] ) {
		$output = (bool) $post_type[ 'query_var' ];
	} else {
		if ( empty( $query_var_slug ) ) {
			$output = $post_type[ 'slug' ];
		} else {
			$output = $query_var_slug;
		}
	}
	$query_var = $output;
	
	/**
	 * @var bool|array $support
	 */
	if ( isset( $post_type[ 'supports' ] ) && is_array( $post_type[ 'supports' ] ) && in_array( 'none', $post_type[ 'supports' ], true ) ) {
		$support = false;
	} else {
		$support = $post_type[ 'supports' ];
	}
	
	$args = array(
		'labels'                => $labels,
		'description'           => $post_type[ 'description' ],
		'public'                => true,
		'hierarchical'          => (bool) $post_type[ 'hierarchical' ],
		'exclude_from_search'   => (bool) $post_type[ 'exclude_from_search' ],
		'publicly_queryable'    => (bool) $post_type[ 'publicly_queryable' ],
		'show_ui'               => (bool) $post_type[ 'show_ui' ],
		'show_in_menu'          => (bool) $post_type[ 'show_in_menu' ],
		'show_in_nav_menus'     => (bool) $post_type[ 'show_in_nav_menus' ],
		'show_in_admin_bar'     => (bool) $post_type[ 'show_in_admin_bar' ],
		'show_in_rest'          => (bool) $post_type[ 'show_in_rest' ],
		'menu_position'         => $post_type[ 'menu_position' ] == '' ? null : (int) $post_type[ 'menu_position' ],
		'menu_icon'             => npt_get_setting( 'url' ) . 'assets/images/' . $post_type[ 'menu_icon' ] . '.svg',
		'capability_type'       => $post_type[ 'capability_type' ] ? $post_type[ 'capability_type' ] : 'post',
		'supports'              => $support,
		'register_meta_box_cb'  => $register_meta_box_cb,
		'has_archive'           => (bool) $post_type[ 'has_archive' ],
		'rewrite'               => $rewrite,
		'rest_base'             => $rest_base,
		'rest_namespace'        => $rest_namespace,
		'rest_controller_class' => $rest_controller_class,
		'query_var'             => $query_var,
		'can_export'            => (bool) $post_type[ 'can_export' ],
		'delete_with_user'      => (bool) $post_type[ 'delete_with_user' ],
		'taxonomies'            => $post_type[ 'taxonomies' ],
	);
	register_post_type( $post_type[ 'slug' ], $args );
}

/**
 * Function register_taxonomy labels and args
 * @since   1.0.0
 * @param $taxonomy
 * @return void
 */
function npt_taxonomes( $taxonomy ) {
	$labels = array(
		'singular_name'              => _x( $taxonomy[ 'labels' ][ 'singular_name' ], 'Taxonomy singular name', 'npt' ),
		'name'                       => _x( $taxonomy[ 'labels' ][ 'name' ], 'Taxonomy general name', 'npt' ),
		'menu_name'                  => _x( $taxonomy[ 'labels' ][ 'menu_name' ], 'Admin Menu text', 'npt' ),
		'all_items'                  => __( $taxonomy[ 'labels' ][ 'all_items' ], 'npt' ),
		'edit_item'                  => __( $taxonomy[ 'labels' ][ 'edit_item' ], 'npt' ),
		'view_item'                  => __( $taxonomy[ 'labels' ][ 'view_item' ], 'npt' ),
		'update_item'                => __( $taxonomy[ 'labels' ][ 'update_item' ], 'npt' ),
		'add_new_item'               => __( $taxonomy[ 'labels' ][ 'add_new_item' ], 'npt' ),
		'new_item_name'              => __( $taxonomy[ 'labels' ][ 'new_item_name' ], 'npt' ),
		'parent_item'                => __( $taxonomy[ 'labels' ][ 'parent_item' ], 'npt' ),
		'parent_item_colon'          => __( $taxonomy[ 'labels' ][ 'parent_item_colon' ], 'npt' ),
		'search_items'               => __( $taxonomy[ 'labels' ][ 'search_items' ], 'npt' ),
		'popular_items'              => __( $taxonomy[ 'labels' ][ 'popular_items' ], 'npt' ),
		'separate_items_with_commas' => _x( $taxonomy[ 'labels' ][ 'separate_items_with_commas' ], 'Add New text', 'npt' ),
		'add_or_remove_items'        => __( $taxonomy[ 'labels' ][ 'add_or_remove_items' ], 'npt' ),
		'choose_from_most_used'      => __( $taxonomy[ 'labels' ][ 'choose_from_most_used' ], 'npt' ),
		'not_found'                  => __( $taxonomy[ 'labels' ][ 'not_found' ], 'npt' ),
		'no_terms'                   => __( $taxonomy[ 'labels' ][ 'no_terms' ], 'npt' ),
		'filter_by_item'             => __( $taxonomy[ 'labels' ][ 'filter_by_item' ], 'npt' ),
		'items_list_navigation'      => __( $taxonomy[ 'labels' ][ 'items_list_navigation' ], 'npt' ),
		'items_list'                 => __( $taxonomy[ 'labels' ][ 'items_list' ], 'npt' ),
		'most_used'                  => __( $taxonomy[ 'labels' ][ 'most_used' ], 'npt' ),
		'back_to_items'              => __( $taxonomy[ 'labels' ][ 'back_to_items' ], 'npt' ),
		'item_link'                  => __( $taxonomy[ 'labels' ][ 'item_link' ], 'npt' ),
		'item_link_description'      => __( $taxonomy[ 'labels' ][ 'item_link_description' ], 'npt' ),
		'name_field_description'     => __( $taxonomy[ 'labels' ][ 'name_field_description' ], 'npt' ),
		'slug_field_description'     => __( $taxonomy[ 'labels' ][ 'slug_field_description' ], 'npt' ),
		'parent_field_description'   => __( $taxonomy[ 'labels' ][ 'parent_field_description' ], 'npt' ),
		'desc_field_description'     => __( $taxonomy[ 'labels' ][ 'desc_field_description' ], 'npt' ),
	);
	
	/**
	 * @var string $rest_base
	 */
	if ( empty( $taxonomy[ 'rest_base' ] ) ) {
		$rest_base = null;
	} else {
		$rest_base = $taxonomy[ 'rest_base' ];
	}
	
	/**
	 * @var string $rest_controller_class
	 */
	if ( empty( $taxonomy[ 'rest_controller_class' ] ) ) {
		$rest_controller_class = null;
	} else {
		$rest_controller_class = $taxonomy[ 'rest_controller_class' ];
	}
	
	/**
	 * @var string $rest_namespace
	 */
	if ( empty( $taxonomy[ 'rest_namespace' ] ) ) {
		$rest_namespace = null;
	} else {
		$rest_namespace = $taxonomy[ 'rest_namespace' ];
	}
	
	/**
	 * @var null|string $meta_box_cb
	 */
	$meta_box_cb = trim( $taxonomy[ 'meta_box_cb' ] );
	if ( empty( $meta_box_cb ) ) {
		$meta_box_cb = null;
	}
	
	/**
	 * @var null|string $meta_box_sanitize_cb
	 */
	$meta_box_sanitize_cb = trim( $taxonomy[ 'meta_box_sanitize_cb' ] );
	if ( empty( $meta_box_sanitize_cb ) ) {
		$meta_box_sanitize_cb = null;
	}
	
	/**
	 * @var bool|array $rewrite
	 */
	$rewrite_slug         = $taxonomy[ 'rewrite_slug' ];
	$with_front           = (bool) $taxonomy[ 'with_front' ];
	$rewrite_hierarchical = (bool) $taxonomy[ 'rewrite_hierarchical' ];
	$rewrite_val          = (bool) $taxonomy[ 'rewrite' ];
	if ( ! $rewrite_val ) {
		$rewrite_val = false;
	} else {
		if ( empty( $rewrite_slug ) ) {
			$output = $taxonomy[ 'slug' ];
		} else {
			$output = $rewrite_slug;
		}
		$rewrite_val = array( 'slug' => $output, 'with_front' => $with_front, 'hierarchical' => $rewrite_hierarchical );
	}
	$rewrite = $rewrite_val;
	
	/**
	 * @var string $query_var
	 */
	$query_var_slug = $taxonomy[ 'query_var_slug' ];
	if ( ! $taxonomy[ 'query_var' ] ) {
		$output = (bool) $taxonomy[ 'query_var' ];
	} else {
		if ( empty( $query_var_slug ) ) {
			$output = $taxonomy[ 'slug' ];
		} else {
			$output = $query_var_slug;
		}
	}
	$query_var = $output;
	
	/**
	 * @var null|array $default_term
	 */
	$default_term = null;
	if ( ! empty( $taxonomy[ 'default_term' ] ) ) {
		$term_parts = explode( ',', $taxonomy[ 'default_term' ] );
		if ( ! empty( $term_parts[ 0 ] ) ) {
			$default_term[ 'name' ] = trim( $term_parts[ 0 ] );
		}
		if ( ! empty( $term_parts[ 1 ] ) ) {
			$default_term[ 'slug' ] = trim( $term_parts[ 1 ] );
		}
		if ( ! empty( $term_parts[ 2 ] ) ) {
			$default_term[ 'description' ] = trim( $term_parts[ 2 ] );
		}
	}
	
	$args = array(
		'labels'                => $labels,
		'description'           => $taxonomy[ 'description' ],
		'public'                => (bool) $taxonomy[ 'public' ],
		'publicly_queryable'    => (bool) $taxonomy[ 'publicly_queryable' ],
		'hierarchical'          => (bool) $taxonomy[ 'hierarchical' ],
		'show_ui'               => (bool) $taxonomy[ 'show_ui' ],
		'show_in_menu'          => (bool) $taxonomy[ 'show_in_menu' ],
		'show_in_nav_menus'     => (bool) $taxonomy[ 'show_in_nav_menus' ],
		'show_in_rest'          => (bool) $taxonomy[ 'show_in_rest' ],
		'rest_base'             => $rest_base,
		'rest_namespace'        => $rest_namespace,
		'rest_controller_class' => $rest_controller_class,
		'show_tagcloud'         => (bool) $taxonomy[ 'show_tagcloud' ],
		'show_in_quick_edit'    => (bool) $taxonomy[ 'show_in_quick_edit' ],
		'show_admin_column'     => (bool) $taxonomy[ 'show_admin_column' ],
		'meta_box_cb'           => $meta_box_cb,
		'meta_box_sanitize_cb'  => $meta_box_sanitize_cb,
		'rewrite'               => $rewrite,
		'query_var'             => $query_var,
		'default_term'          => $default_term,
	);
	register_taxonomy( $taxonomy[ 'slug' ], $taxonomy[ 'post_types' ], $args );
}

/**
 * check if new post type is published
 * then flush rewrite rules
 * @since   1.0.0
 * @return void
 */
function npt_post_type_flush_rewriete_rules() {
	$count_posts     = wp_count_posts( 'npt-post-type' );
	$published_posts = '';
	if ( $count_posts ) {
		$published_posts = $count_posts->publish;
	}
	$prv_published_posts = '';
	if ( get_option( 'npt_post_type_count' ) ) {
		$prv_published_posts = get_option( 'npt_post_type_count' );
	}
	if ( $published_posts !== $prv_published_posts ) {
		flush_rewrite_rules();
	}
	update_option( 'npt_post_type_count', $published_posts );
}

/**
 * check if new taxonomy is published
 * then flush rewrite rules
 * @since   1.0.0
 * @return void
 */
function npt_taxonomy_flush_rewriete_rules() {
	$count_posts     = wp_count_posts( 'npt-taxonomy' );
	$published_posts = '';
	if ( $count_posts ) {
		$published_posts = $count_posts->publish;
	}
	$prv_published_posts = '';
	if ( get_option( 'npt_taxonomy_count' ) ) {
		$prv_published_posts = get_option( 'npt_taxonomy_count' );
	}
	if ( $published_posts !== $prv_published_posts ) {
		flush_rewrite_rules();
	}
	update_option( 'npt_taxonomy_count', $published_posts );
}

/**
 * Adding custom columns in npt-post-type WP list table
 * @since   1.0.0
 * @param $columns
 * @return mixed
 */
function set_npt_post_type_custom_columns( $columns ) {
	unset( $columns[ 'date' ] );
	unset( $columns[ 'title' ] );
	$columns[ 'title' ]       = __( 'Post Type', 'npt' );
	$columns[ 'menu-label' ]  = __( 'Menu Label', 'npt' );
	$columns[ 'slug' ]        = __( 'Slug', 'npt' );
	$columns[ 'taxonomies' ]  = __( 'Taxonomies', 'npt' );
	$columns[ 'description' ] = __( 'Description', 'npt' );
	$columns[ 'date' ]        = __( 'Date', 'npt' );
	
	return $columns;
}

add_filter( 'manage_npt-post-type_posts_columns', 'set_npt_post_type_custom_columns', 10, 1 );

/**
 * Adding sortable custom columns in npt-post-type WP list table
 * @since   1.0.0
 * @param $columns
 * @return mixed
 */
function set_npt_post_type_sortable_columns( $columns ) {
	$columns[ 'title' ]       = __( 'Post Type', 'npt' );
	$columns[ 'menu-label' ]  = __( 'Menu Label', 'npt' );
	$columns[ 'slug' ]        = __( 'Slug', 'npt' );
	$columns[ 'taxonomies' ]  = __( 'Taxonomies', 'npt' );
	$columns[ 'description' ] = __( 'Description', 'npt' );
	$columns[ 'date' ]        = __( 'Date', 'npt' );
	
	return $columns;
}

add_filter( 'manage_edit-npt-post-type_sortable_columns', 'set_npt_post_type_sortable_columns', 10, 1 );
/**
 *  Adding custom columns content in npt-post-type WP list table
 * @since   1.0.0
 * @param $column
 * @param $post_id
 * @return void
 */
function npt_post_type_custom_column_content( $column, $post_id ) {
	
	switch ( $column ) {
		case 'menu-label' :
			$post_type = get_post_meta( $post_id, 'npt_post_type', true );
			if ( $post_type ) {
				echo '<span class="list-table-icon">' . get_npt_svg_icon( $post_type[ 'menu_icon' ], 18, '#50575e' ) . ' ' . esc_html( $post_type[ 'labels' ][ 'menu_name' ] ) . '</span>';
			} else {
				esc_html( 'Unable to get slug' );
			}
			break;
		case 'slug' :
			$post_type = get_post_meta( $post_id, 'npt_post_type', true );
			if ( $post_type[ 'slug' ] ) {
				echo esc_html( $post_type[ 'slug' ]);
			} else {
				_e( '<span aria-hidden="true">—</span>', 'npt' );
			}
			break;
		
		case 'taxonomies' :
			$post_type = get_post_meta( $post_id, 'npt_post_type', true );
			if ( $post_type ) {
				$taxonomies = get_object_taxonomies( $post_type[ 'slug' ], 'objects' );
				unset( $taxonomies[ 'category' ], $taxonomies[ 'post_tag' ] );
				if ( $post_type[ 'taxonomies' ] ) {
					foreach ( $post_type[ 'taxonomies' ] as $taxonomy ) {
						$tax_label = '';
						if ( $taxonomy == 'category' ) {
							$tax_label = 'Categories';
						}
						if ( $taxonomy == 'post_tag' ) {
							$tax_label = 'Post Tags';
						}
						echo '<span style="margin-right: 15px;">  ' . esc_html( $tax_label ) . ' </span>';
					}
				}
				foreach ( $taxonomies as $taxonomy ) {
					$npt_taxonomy_id = get_page_by_path( $taxonomy->name, OBJECT, 'npt-taxonomy' );
					$selected_tax    = get_post( $npt_taxonomy_id );
					echo '<a style="margin-right: 15px;" href="' . get_edit_post_link( $npt_taxonomy_id ) . '"> ' . esc_html( $selected_tax->post_title ) . ' </a>';
				}
			}
			if ( empty( $post_type[ 'taxonomies' ] ) && empty( $taxonomies ) ) {
				_e( '<span aria-hidden="true">—</span>', 'npt' );
			}
			break;
		
		case 'description' :
			$post_type = get_post_meta( $post_id, 'npt_post_type', true );
			if ( $post_type[ 'description' ] ) {
				echo esc_html( $post_type[ 'description' ] );
			} else {
				_e( '<span aria-hidden="true">—</span>', 'npt' );
			}
			break;
		
	}
}

add_action( 'manage_npt-post-type_posts_custom_column', 'npt_post_type_custom_column_content', 10, 2 );

/**
 * Adding custom columns in npt-taxonomy WP list table
 * @since   1.0.0
 * @param $columns
 * @return mixed
 */
function set_npt_taxonomy_custom_columns( $columns ) {
	unset( $columns[ 'date' ] );
	unset( $columns[ 'title' ] );
	$columns[ 'title' ]       = __( 'Taxonomy', 'npt' );
	$columns[ 'slug' ]        = __( 'Slug', 'npt' );
	$columns[ 'post-types' ]  = __( 'Post Types', 'npt' );
	$columns[ 'description' ] = __( 'Description', 'npt' );
	$columns[ 'date' ]        = __( 'Date', 'npt' );
	
	return $columns;
}

add_filter( 'manage_npt-taxonomy_posts_columns', 'set_npt_taxonomy_custom_columns', 10, 1 );

/**
 * Adding sortable custom columns in npt-taxonomy WP list table
 * @since   1.0.0
 * @param $columns
 * @return mixed
 */
function set_npt_taxonomy_sortable_columns( $columns ) {
	$columns[ 'title' ]       = __( 'Taxonomy', 'npt' );
	$columns[ 'slug' ]        = __( 'Slug', 'npt' );
	$columns[ 'post-types' ]  = __( 'Post Types', 'npt' );
	$columns[ 'description' ] = __( 'Description', 'npt' );
	$columns[ 'date' ]        = __( 'Date', 'npt' );
	
	return $columns;
}

add_filter( 'manage_edit-npt-taxonomy_sortable_columns', 'set_npt_taxonomy_sortable_columns', 10, 1 );

/**
 *  Adding custom columns content in npt-taxonomy WP list table
 * @since   1.0.0
 * @param $column
 * @param $post_id
 * @return void
 */
function npt_taxonomy_custom_column_content( $column, $post_id ) {
	
	switch ( $column ) {
		
		case 'slug' :
			$taxonomies = get_post_meta( $post_id, 'npt_taxonomy', true );
			if ( $taxonomies ) {
				echo esc_html( $taxonomies[ 'slug' ] );
			} else {
				_e( '<span aria-hidden="true">—</span>', 'npt' );
			}
			break;
		
		case 'post-types' :
			
			$taxonomies = get_post_meta( $post_id, 'npt_taxonomy', true );
			
			if ( $taxonomies ) {
				global $wp_taxonomies;
				$post_type = isset( $wp_taxonomies[ $taxonomies[ 'slug' ] ] ) ? $wp_taxonomies[ $taxonomies[ 'slug' ] ]->object_type : array();
				foreach ( $post_type as $post ) {
					if ( $post == 'page' || $post == 'post' || $post == 'attachment' ) {
						$post_type_label = '';
						if ( $post == 'page' ) {
							$post_type_label = 'Pages';
						}
						if ( $post == 'post' ) {
							$post_type_label = 'Posts';
						}
						if ( $post == 'attachment' ) {
							$post_type_label = 'Attachments';
						}
						echo '<span style="margin-right: 15px;">' . esc_html( $post_type_label) . '</span>';
					} else {
						$npt_post_type_id   = get_page_by_path( $post, OBJECT, 'npt-post-type' );
						$selected_post_type = get_post( $npt_post_type_id );
						echo '<a style="margin-right: 15px;" href="' . get_edit_post_link( $npt_post_type_id ) . '">' . esc_html( $selected_post_type->post_title ) . '</a>';
					}
				}
			} else {
				_e( '<span aria-hidden="true">—</span>', 'npt' );
			}
			break;
		
		case 'description' :
			$taxonomies = get_post_meta( $post_id, 'npt_taxonomy', true );
			if ( $taxonomies[ 'description' ] ) {
				echo $taxonomies[ 'description' ];
			} else {
				_e( '<span aria-hidden="true">—</span>', 'npt' );
			}
			break;
	}
}

add_action( 'manage_npt-taxonomy_posts_custom_column', 'npt_taxonomy_custom_column_content', 10, 2 );

/**
 * Return text encapsulated in HTML
 * @since   1.0.0
 * @param $text
 * @param $html_tag
 * @return string
 */
function npt_html( $text, $html_tag ) {
	return '<' . $html_tag . '>' . esc_html( $text ) . '</' . $html_tag . '>';
}

/**
 * Print singular or plural text on basics of register post types
 * @since   1.0.0
 * @param $singular_text
 * @param $plural_text
 * @param $post_type
 * @return string
 */
function npt_text_plusing( $singular_text, $plural_text, $post_type ) {
	$count = wp_count_posts( $post_type )->publish;
	if ( $count > 1 ) {
		$text = $plural_text;
	} else {
		$text = $singular_text;
	}
	
	return esc_html( $text );
}

/**
 * Print text if any post type or taxonomy is registered
 * @since   1.0.0
 * @param $text
 * @param $post_type
 * @return string
 */
function npt_have_post_text( $text, $post_type ) {
	$count    = wp_count_posts( $post_type )->publish;
	$hve_text = '';
	if ( $count > 0 ) {
		$hve_text = $text;
	}
	
	return esc_html( $hve_text );
}