<?php
/*
Plugin Name: OvaTheme Ireca
Plugin URI: http://ovatheme.com
Description: ELementor use in IReca Theme
Author: Ovatheme
Version: 1.0.2
Author URI: http://ovatheme.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'ELEMENTOR_IRECA__FILE__', __FILE__ );

include dirname( __FILE__ ) . '/plugin.php';
include dirname( __FILE__ ) . '/ireca-search-widget/ireca-search-widget.php';

load_plugin_textdomain( 'ireca', false, basename( dirname( __FILE__ ) ) .'/languages' );


function ireca_elementor_widget_categories( $elements_manager ) {

	$elements_manager->add_category(
		'ovatheme',
		[
			'title' => __( 'Ovatheme', 'ireca' ),
			'icon' => 'fa fa-plug',
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'ireca_elementor_widget_categories' );


function ireca_html_widget_title( $title ) {
	$title = str_replace( '{{', '<i class="', $title );
	$title = str_replace( '}}', '"></i>', $title );
	return $title;
}
add_filter( 'widget_title', 'ireca_html_widget_title' );



