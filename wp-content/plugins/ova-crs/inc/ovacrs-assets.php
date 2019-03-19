<?php defined( 'ABSPATH' ) || exit();

if( !class_exists( 'OVACRS_Assets' ) ){
	class OVACRS_Assets{

		public function __construct(){
			add_action( 'admin_footer', array( $this, 'ovacrs_enqueue_scripts' ), 10, 2 );
		}

		public function ovacrs_enqueue_scripts(){
			
			// Date Time Picker
			wp_enqueue_script('datetimepicker', OVACRS_PLUGIN_URI.'assets/plugins/datetimepicker/jquery.datetimepicker.js', array('jquery'), null, true );
			
			wp_enqueue_script('ova_crs', OVACRS_PLUGIN_URI.'assets/ova-crs.js', array('jquery'), null, true );


			// Admin Css
			wp_enqueue_style('datetimepicker', OVACRS_PLUGIN_URI.'/assets/plugins/datetimepicker/jquery.datetimepicker.css', array(), null);
			wp_enqueue_style('ovacrs-default', OVACRS_PLUGIN_URI.'/assets/ovacrs_admin.css', array(), null);

			
		}


	}
	new OVACRS_Assets();
}
