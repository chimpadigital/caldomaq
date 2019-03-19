<?php if ( !defined( 'ABSPATH' ) ) exit();

function get_all_rooms(){
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => '-1',
        'post_status'   => 'publish'
    );
    $rooms = new WP_Query( $args );
    return $rooms;
}


function get_all_locations(){
	$args = array(
        'post_type' => 'location',
        'posts_per_page' => '-1',
        'post_status'   => 'publish'
    );
    $location = new WP_Query( $args );
    return $location;	
}

require_once( OVACRS_PLUGIN_PATH.'/admin/class_render_table_booking.php' );
require_once( OVACRS_PLUGIN_PATH.'/admin/class_admin_ajax.php' );
require_once( OVACRS_PLUGIN_PATH.'/admin/class_display_table_booking.php' );




// Create Sub-Menu-Page in Woo
add_action('admin_menu', 'ovacrs_schedule_menu');
function ovacrs_schedule_menu() {
	add_submenu_page(
	    'edit.php?post_type=product',
	    __( 'Manage Booking', 'ova-crs' ),
	    __( 'Manage Booking', 'ova-crs' ),
	    'edit_posts',
	    'manage-booking',
	    'ovacrs_display_booking'
	);
}

// Add Css in admin
// add_action( 'admin_print_styles', 'load_custom_admin_css' );
add_action( 'admin_footer', 'hotel_add_scripts', 10, 2 );
function hotel_add_scripts(){

 wp_enqueue_style( 'ovacrs_woo_admin', home_url().'/wp-content/plugins/woocommerce/assets/css/admin.css');
 wp_enqueue_style( 'ovacrs_booking_admin', OVACRS_PLUGIN_URI.'/admin/admin-style.css');

 wp_enqueue_script('admin_script', OVACRS_PLUGIN_URI.'/admin/admin_script.js', array('jquery'),false,true);
}
