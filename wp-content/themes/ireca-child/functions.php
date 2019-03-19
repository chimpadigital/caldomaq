<?php
/**
 * Setup ireca Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function ireca_child_theme_setup() {
	load_child_theme_textdomain( 'ireca-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'ireca_child_theme_setup' );


// Add Code is here.

// Add Parent Style
add_action( 'wp_enqueue_scripts', 'ireca_child_scripts' );
function ireca_child_scripts() {
    wp_enqueue_style( 'parent_style', get_template_directory_uri(). '/style.css' );
}
