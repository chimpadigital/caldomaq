<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
// get categories
$terms = wp_get_post_terms( $post->ID, 'product_cat', array("fields" => "all") );

if( $terms ){

	foreach ($terms as $key => $value) {
		$ovacrs_cat_dis = get_term_meta($value->term_id, 'ovacrs_cat_dis', false);

		if( in_array( 'rental', $ovacrs_cat_dis) ){
			wc_get_template( 'rental/archive-product.php' );
			exit();
		}else{
			wc_get_template( 'archive-product.php' );
			
			exit();
		}
	}

}else{
	wc_get_template( 'rental/archive-product.php' );
}






