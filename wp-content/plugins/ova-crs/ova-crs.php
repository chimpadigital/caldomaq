<?php
/*
Plugin Name: OvaTheme CRS
Plugin URI: http://ovatheme.com
Description: OvaTheme CRS.
Author: Ovatheme
Version: 1.2.4
Author URI: http://ovatheme.com
*/
if ( !defined( 'ABSPATH' ) ) exit();


if( !class_exists( 'OVACRS' ) ){

	 class OVACRS{

		/**
		 * OVACRS Constructor
		 */

		public function __construct(){
			
				$this->define_constants();
				$this->includes();
				add_action('init',array($this, 'ovacrs_manage_booking' ) );
		}


		/**
		 * Define constants
		 */
		public function define_constants(){
			define( 'OVACRS_PLUGIN_FILE', __FILE__ );
			define( 'OVACRS_PLUGIN_URI', plugin_dir_url( __FILE__ ) );
			define( 'OVACRS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
			load_plugin_textdomain( 'ova-crs', false, basename( dirname( __FILE__ ) ) .'/languages' ); 
		}

		


		/**
		 * Include files
		 */

		public function includes(){
				
			// Funciton
			require_once( OVACRS_PLUGIN_PATH.'/inc/ovacrs-functions.php' );

			// Loader Template
			require_once( OVACRS_PLUGIN_PATH.'/inc/ovacrs-load-temp.php' );


			// Add taxonomy type
			require_once( OVACRS_PLUGIN_PATH.'/inc/ovacrs-taxonomy.php' );

			// Add Js Css
			require_once( OVACRS_PLUGIN_PATH.'/inc/ovacrs-assets.php' );
			
			// Make Custom Product Type WooCommerce
			require_once( OVACRS_PLUGIN_PATH.'/inc/ovacrs-admin-woo.php' );
			
			// Cart
			require_once( OVACRS_PLUGIN_PATH.'/inc/ovacrs-cart.php' );

			// Calculate Before add to cart
			require_once( OVACRS_PLUGIN_PATH.'/inc/ovacrs-cus-cal-cart.php' );

			// Get order
			require_once( OVACRS_PLUGIN_PATH.'/inc/ovacrs-get-data.php' );

			// Add tab beside description
			require_once( OVACRS_PLUGIN_PATH.'/inc/ovacrs-contact-tab.php' );			

			// Filter name
			require_once( OVACRS_PLUGIN_PATH.'/inc/ovacrs_filters.php' );

			

			// Register Custom Post Type
			require_once( OVACRS_PLUGIN_PATH.'/custom-post-type/register_cpt.php' );			

			// Register Widget
			require_once( OVACRS_PLUGIN_PATH.'/widgets/register_wd.php' );

			// Shortcode
			require_once( OVACRS_PLUGIN_PATH.'/shortcodes/shortcodes.php' );
			require_once( OVACRS_PLUGIN_PATH.'/shortcodes/vc_shortcodes.php' );

			// Add field to category
			require_once( OVACRS_PLUGIN_PATH.'/inc/ovacrs-add-field-woocat.php' );
				
		}

		public function ovacrs_manage_booking(){
			if( current_user_can( 'administrator' ) || current_user_can('edit_posts') ){
				require_once( OVACRS_PLUGIN_PATH.'/admin/init.php' );
			}
		}




	}
}

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	new OVACRS();
}


?>
