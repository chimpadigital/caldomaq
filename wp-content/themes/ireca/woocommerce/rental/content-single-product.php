<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

$post_id = get_the_id();



if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );

?>



<!-- Customize -->
<?php 
$bg_header = get_post_meta( $post_id, 'ireca_met_bg_header', true );
$class_bg_header = ( $bg_header != '' ) ? 'bg_header' : ''; ?>
 
<div class="woo_rent_top <?php echo esc_attr($class_bg_header); ?>">
	<div class="left">
		<?php 
		if( get_theme_mod( 'rd_show_title', 'true' ) == 'true' ){
			woocommerce_template_single_title(); 
		}
		?>

		<?php 
			if( get_theme_mod( 'rd_show_breadcrumbs', 'true' ) == 'true' ){
				woocommerce_breadcrumb();
			}
		?>	
	</div>
	<div class="right">

		<?php if( get_theme_mod( 'rd_show_act_booking', 'true' ) == 'true' ){ ?>	
			<a href="#ireca_booking_form" class="ireca_btn booking_btn scroll"><i class="icon_tag_alt"></i><?php esc_html_e( 'Booking Now', 'ireca' ); ?></a>
		<?php } ?>

		<?php if( get_theme_mod( 'rd_show_video_btn', 'true' ) == 'true' ){ ?>	
			<?php $video_url = get_post_meta( $post_id, 'ovacrs_video_link', true ); ?>
			<?php if( $video_url != '' ){ ?>
				<a href="<?php echo esc_url($video_url); ?>" data-rel="videoprettyPhoto" class="video_product"><i class="icon_film"></i></a>
			<?php } ?>
		<?php } ?>
	</div>
	
</div>
<!-- /Customize -->

<?php 
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

?>


<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
	
		
		
					<?php
						/**
						 * Hook: woocommerce_before_single_product_summary.
						 *
						 * @hooked woocommerce_show_product_sale_flash - 10
						 * @hooked woocommerce_show_product_images - 20
						 */
						if( get_theme_mod( 'rd_show_images', 'true' ) == 'true' ){
							remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
							do_action( 'woocommerce_before_single_product_summary' );
						}

						
					?>
		
			
			
				<div class="summary entry-summary">
					<?php
						/**
						 * Hook: woocommerce_single_product_summary.
						 *
						 * @hooked woocommerce_template_single_title - 5
						 * @hooked woocommerce_template_single_rating - 10
						 * @hooked woocommerce_template_single_price - 10
						 * @hooked woocommerce_template_single_excerpt - 20
						 * @hooked woocommerce_template_single_add_to_cart - 30
						 * @hooked woocommerce_template_single_meta - 40
						 * @hooked woocommerce_template_single_sharing - 50
						 * @hooked WC_Structured_Data::generate_product_data() - 60
						 */
						
						if( get_theme_mod( 'rd_show_price', 'true' ) == 'true' ){


							$price_type = get_post_meta( $post_id, 'ovacrs_price_type', true );
							$price_hour = 	get_post_meta( $post_id, 'ovacrs_regul_price_hour', true );
							$price_day = 	get_post_meta( $post_id, '_regular_price', true );

							if( $price_type == 'hour' ){ ?>
								<div class="ireca_woo_price">
									<span class="amount"><?php echo wc_price( $price_hour ); ?></span>
									<span class="label"><?php esc_html_e( '/ Hour', 'ireca' ); ?></span>
								</div>
							<?php }if( $price_type == 'day' ){	 ?>
								<div class="ireca_woo_price">
									<span class="amount"><?php echo wc_price( $price_day ); ?></span>
									<span class="label"><?php esc_html_e( '/ Day', 'ireca' ); ?></span>
								</div>
							<?php }if( $price_type == 'mixed' ){ ?>
								<div class="ireca_woo_price">
									<span class="amount"><?php echo wc_price( $price_hour ); ?></span>
									<span class="label"><?php esc_html_e( '/ Hour', 'ireca' ); ?></span>
								</div>
								<div class="ireca_woo_price">
									<span class="amount"><?php echo wc_price( $price_day ); ?></span>
									<span class="label"><?php esc_html_e( '/ Day', 'ireca' ); ?></span>
								</div>
							<?php }

						}
						
						if( get_theme_mod( 'rd_show_rating', 'true' ) =='true' ){
							woocommerce_template_single_rating();
						}
						if( get_theme_mod( 'rd_show_excerpt', 'true' ) =='true' ){
							woocommerce_template_single_excerpt();
						}
						
						wc_get_template_part( 'rental/ovacrs-features' );
						
					?>
				</div>
		

	

	<?php 
	wc_get_template_part( 'rental/ovacrs-item-info' );

	wc_get_template_part( 'rental/ovacrs-calendar' );

	if( get_theme_mod( 'rd_show_booking_form', 'true' ) == 'true' ){
		wc_get_template_part( 'rental/ovacrs-booking-form' );
	}
	
	

	
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */

		remove_action( 'woocommerce_after_single_product_summary' , 'woocommerce_upsell_display', 15 );
		if( get_theme_mod( 'rd_show_related', 'true' ) == 'false' ){
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		}


		do_action( 'woocommerce_after_single_product_summary' );
		
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>


