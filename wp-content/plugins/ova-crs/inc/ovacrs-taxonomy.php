<?php if ( !defined( 'ABSPATH' ) ) exit();

// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'ovacrs_create_type_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function ovacrs_create_type_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Types', 'taxonomy general name', 'ova-crs' ),
		'singular_name'     => _x( 'type', 'taxonomy singular name', 'ova-crs' ),
		'search_items'      => __( 'Search Types', 'ova-crs' ),
		'all_items'         => __( 'All Type', 'ova-crs' ),
		'parent_item'       => __( 'Parent Type', 'ova-crs' ),
		'parent_item_colon' => __( 'Parent Type:', 'ova-crs' ),
		'edit_item'         => __( 'Edit Type', 'ova-crs' ),
		'update_item'       => __( 'Update Type', 'ova-crs' ),
		'add_new_item'      => __( 'Add New Type', 'ova-crs' ),
		'new_item_name'     => __( 'New Type Name', 'ova-crs' ),
		'menu_name'         => __( 'Type', 'ova-crs' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'type' ),
	);

	register_taxonomy( 'type', array( 'product' ), $args );

	
}
