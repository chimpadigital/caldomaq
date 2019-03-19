<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<?php
// Open layout
do_action('ireca_woo_open_layout');

?>



	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		
		/* Customize */
		remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20 );
		/* /Customize */

		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); 

			global $product;

			$is_produc_type = $product->is_type('ovacrs_car_rental') ? true : false ;

			if( $is_produc_type ){
				$rd_style = isset( $_GET['rd_style'] ) ? $_GET['rd_style'] : get_theme_mod( 'rd_style', 'single-product' );
				wc_get_template_part( 'rental/content', $rd_style ); 	
			}else{
				wc_get_template_part( 'content', 'single-product' ); 
			}
			

		endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	

<?php
// Close layout
do_action('ireca_woo_close_layout');

get_footer( 'shop' ); ?>
