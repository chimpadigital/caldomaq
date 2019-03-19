<?php
	if(defined('IRECA_URL') 	== false) 	define('IRECA_URL', get_template_directory());
	if(defined('IRECA_URI') 	== false) 	define('IRECA_URI', get_template_directory_uri());

	load_theme_textdomain( 'ireca', IRECA_URL . '/languages' );
	
	// require libraries, function
	require( IRECA_URL.'/framework/init.php' );

	// Add js, css
	require( IRECA_URL.'/extend/add_js_css.php' );

	// register menu, widget
	require( IRECA_URL.'/extend/register_menu_widget.php' );

	require( IRECA_URL.'/templates/open_layout.php' );
	require( IRECA_URL.'/templates/close_layout.php' );

	require( IRECA_URL.'/templates/woo_open_layout.php' );
	require( IRECA_URL.'/templates/woo_close_layout.php' );
	

	// require menu
	require_once (IRECA_URL.'/extend/ova_walker_nav_menu.php');

	// require content
	require_once (IRECA_URL.'/content/define_blocks_content.php');
	
	// require breadcrumbs
	require( IRECA_URL.'/extend/breadcrumbs.php' );

	
	
	// Require customize
	if( is_user_logged_in() ){
		require( IRECA_URL.'/framework/customize_google_font/customizer_google_font.php' );
		require( IRECA_URL.'/extend/customizer.php' );
	}

	// Require metabox
	if( is_admin() ){
		require( IRECA_URL.'/extend/custom_metabox/add_custom_metabox.php' );
		require( IRECA_URL.'/extend/metabox.php' );
		// Require TGM
		require_once ( IRECA_URL.'/extend/active_plugins.php' );		
	}