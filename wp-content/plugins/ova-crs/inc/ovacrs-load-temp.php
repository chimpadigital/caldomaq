<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

class ovacrs_load_template {

	
	/**
	 * The Constructor
	 */
	public function __construct() {

		add_filter( 'template_include', array( $this, 'ovacrs_template_loader' ) );
		
	}

	public function ovacrs_template_loader( $template ) {

		$search = isset( $_REQUEST['ovacrs_search'] ) ? esc_html( $_REQUEST['ovacrs_search'] ) : '';

		$request_booking = isset( $_REQUEST['request_booking'] ) ? esc_html( $_REQUEST['request_booking'] ) : '';

		if( $search != ''){
			ovacrs_get_template( 'search.php' );
			exit();
		}

		if( $request_booking != ''){
			if( ovacrs_request_booking( $_REQUEST ) ){
				$thank_page = ( get_theme_mod( 'rd_rbf_thank_page', '' ) != '' ) ? get_theme_mod( 'rd_rbf_thank_page', '' ) : home_url('/');
				wp_redirect( $thank_page );
			}else{
				$error_page = ( get_theme_mod( 'rd_rbf_error_page', '' ) != '' ) ? get_theme_mod( 'rd_rbf_error_page', '' ) : home_url('/');
				wp_redirect( $error_page );
			}
			exit();
		}

		return $template;

	}


}

new ovacrs_load_template();
