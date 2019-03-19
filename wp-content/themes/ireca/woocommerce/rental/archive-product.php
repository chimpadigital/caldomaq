<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

$header_version = get_theme_mod( 'rl_header', 'default' );

get_header( $header_version );

?>
<div class="archive_rental"><div class="container">
	

		<?php if( get_theme_mod( 'rl_show_search', 'true' ) == 'true' ){ ?>
			<div class="ireca_wd_search">
				<?php echo do_shortcode( '[ovacrs_search /]' ); ?>
			</div>
		<?php } ?>

		<?php /**
		 * Hook: woocommerce_before_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 * @hooked WC_Structured_Data::generate_website_data() - 30
		 */
		

		?>

		<div class="row">
			<?php 

			$rl_type = isset( $_GET['rl_type'] ) ? $_GET['rl_type'] : get_theme_mod( 'rl_type', '2columns' ); ?>
			<?php if( $rl_type != '3columns' ){ ?>
				<?php if( $rl_type == '2columns' ){ ?>
					<div class="col-lg-8 col-md-12"><div class="row">
				<?php }else{ ?>
					<div class="col-lg-8 col-md-12">
				<?php } ?>
				
			<?php } ?>

				<?php
				if ( woocommerce_product_loop() ) { ?>

						<?php if( $rl_type != '3columns' && $rl_type != '2columns' ){ ?>
							<div class="row">
						<?php } ?>
						<div class="container">
							
								<?php
								/**
								 * Hook: woocommerce_before_shop_loop.
								 *
								 * @hooked wc_print_notices - 10
								 * @hooked woocommerce_result_count - 20
								 * @hooked woocommerce_catalog_ordering - 30
								 */
								do_action( 'woocommerce_before_shop_loop' );?>
							
						</div>
						<?php if( $rl_type != '3columns' && $rl_type != '2columns' ){ ?>
							</div>
						<?php } ?>
					

							<?php if ( wc_get_loop_prop( 'total' ) ) {
								while ( have_posts() ) {
									the_post();

									/**
									 * Hook: woocommerce_shop_loop.
									 *
									 * @hooked WC_Structured_Data::generate_product_data() - 10
									 */
									do_action( 'woocommerce_shop_loop' );

									wc_get_template_part( 'rental/content', 'product_'.$rl_type );
								}
							}
							

							/**
							 * Hook: woocommerce_after_shop_loop.
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
							?>
						
						
					
					
					

					<?php
					
				} else {
					/**
					 * Hook: woocommerce_no_products_found.
					 *
					 * @hooked wc_no_products_found - 10
					 */
					do_action( 'woocommerce_no_products_found' );
				}

				/**
				 * Hook: woocommerce_after_main_content.
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				 ?>
		

			<?php if( $rl_type != '3columns' ){ ?>
				<?php if( $rl_type == '2columns' ){ ?>	
					</div></div>
				<?php }else{ ?>
					</div>
				<?php } ?>
				
			<?php } ?>

			<?php if( $rl_type != '3columns' ){ ?>
				<div class="col-lg-4 col-md-12">
					<?php if( is_active_sidebar('rental-sidebar') ){ ?>
						<div id="sidebar" class="rental_sidebar sidebar">
							<?php dynamic_sidebar('rental-sidebar'); ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>

		</div>

</div></div>

<?php /**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */


get_footer( 'shop' );

