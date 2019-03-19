<?php

// Location //////////////////////////////////////////////////////////////////////////////////
add_action( 'init', 'ovacrs_location',0 );
function ovacrs_location() {
    
    $labels = array(
        'name'               => esc_html__( 'Location', 'post type general name', 'ova-crs' ),
        'singular_name'      => esc_html__( 'Location', 'post type singular name', 'ova-crs' ),
        'menu_name'          => esc_html__( 'Location', 'admin menu', 'ova-crs' ),
        'name_admin_bar'     => esc_html__( 'Location', 'add new on admin bar', 'ova-crs' ),
        'add_new'            => esc_html__( 'Add New Location', 'Location', 'ova-crs' ),
        'add_new_item'       => esc_html__( 'Add New Location', 'ova-crs' ),
        'new_item'           => esc_html__( 'New Location', 'ova-crs' ),
        'edit_item'          => esc_html__( 'Edit Location', 'ova-crs' ),
        'view_item'          => esc_html__( 'View Location', 'ova-crs' ),
        'all_items'          => esc_html__( 'All Location', 'ova-crs' ),
        'search_items'       => esc_html__( 'Search Location', 'ova-crs' ),
        'parent_item_colon'  => esc_html__( 'Parent Location:', 'ova-crs' ),
        'not_found'          => esc_html__( 'No Location found.', 'ova-crs' ),
        'not_found_in_trash' => esc_html__( 'No Location found in Trash.', 'ova-crs' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'menu_icon'          => 'dashicons-format-gallery',
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'location' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'author', 'thumbnail', ),
    );

    register_post_type( 'location', $args );
}


// Vehicle
add_action( 'init', 'ovacrs_vehicle',0 );
function ovacrs_vehicle() {
    
    $labels = array(
        'name'               => esc_html__( 'ID Vehicle', 'post type general name', 'ova-crs' ),
        'singular_name'      => esc_html__( 'ID Vehicle', 'post type singular name', 'ova-crs' ),
        'menu_name'          => esc_html__( 'Manage ID Vehicle', 'admin menu', 'ova-crs' ),
        'name_admin_bar'     => esc_html__( 'ID Vehicle', 'add new on admin bar', 'ova-crs' ),
        'add_new'            => esc_html__( 'Add New ID Vehicle', 'ID Vehicle', 'ova-crs' ),
        'add_new_item'       => esc_html__( 'Add New Vehicle', 'ova-crs' ),
        'new_item'           => esc_html__( 'New ID Vehicle', 'ova-crs' ),
        'edit_item'          => esc_html__( 'Edit ID Vehicle', 'ova-crs' ),
        'view_item'          => esc_html__( 'View ID Vehicle', 'ova-crs' ),
        'all_items'          => esc_html__( 'All ID Vehicle', 'ova-crs' ),
        'search_items'       => esc_html__( 'Search ID Vehicle', 'ova-crs' ),
        'parent_item_colon'  => esc_html__( 'Parent ID Vehicle:', 'ova-crs' ),
        'not_found'          => esc_html__( 'No ID Vehicle found.', 'ova-crs' ),
        'not_found_in_trash' => esc_html__( 'No ID Vehicle found in Trash.', 'ova-crs' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'menu_icon'          => 'dashicons-format-gallery',
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'vehicle' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'author' ),
    );

    register_post_type( 'vehicle', $args );
}
