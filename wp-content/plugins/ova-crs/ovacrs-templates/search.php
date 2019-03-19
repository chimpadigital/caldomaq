<?php if ( !defined( 'ABSPATH' ) ) { exit; }

get_header( 'default' );

do_action('ireca_woo_open_layout', 'fullwidth', '');


?>
<div class="row"><div class="woocommerce rental_search_page archive_rental ">

	<?php if( get_theme_mod( 'rl_show_search', 'true' ) == 'true' ){ ?>
		<div class="ireca_wd_search">
			<?php echo do_shortcode( '[ovacrs_search /]' ); ?>
		</div>
	<?php } ?>





<?php 

$rental_products = ovacrs_search_vehicle( $_GET ); 
if( $rental_products != false){
?>

<div class="list_products row">
	<?php if ( $rental_products->have_posts() ) : while ( $rental_products->have_posts() ) : $rental_products->the_post();

		global $product;

		$img  = wp_get_attachment_image_url( get_post_thumbnail_id(), 'large' );

		$rating_count = $product->get_rating_count();
		$review_count = $product->get_review_count();
		$average      = $product->get_average_rating();
	?>
		<div class="rental_item item style1 col-lg-4 col-md-6">

		    <div class="wrap_img">
		       <img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title(); ?>">

		       <div class="bottom">
		            

		                <?php $is_produc_type = $product->is_type('ovacrs_car_rental') ? true : false ; ?>

		                <div class="wrap_btn">
		                    <a href="<?php the_permalink(); ?> " class="ireca_btn  btn_tran dashed btn_white btn_price"><span class="wrap_content">

		                    	<?php if( $is_produc_type ){
		                    		if( ovacrs_get_price_type( get_the_id() ) == 'day' ){ ?>
		                                <span class="amount"><?php echo ovacrs_get_price_day( get_the_id() ) ?></span>
		                                <span class="time"><?php esc_html_e( '/ Day', 'ova-crs' ); ?> </span>
		                            <?php }else if( ovacrs_get_price_type( get_the_id() ) == 'hour' ){ ?>
		                                <span class="amount"><?php echo ovacrs_get_price_hour( get_the_id() ); ?> </span>
		                                <span class="time"><?php esc_html_e( '/ Hour', 'ova-crs' ); ?></span>
		                            <?php }else if( ovacrs_get_price_type( get_the_id() ) == 'mixed' ) { ?>
		                                <span class="amount"><?php echo ovacrs_get_price_day( get_the_id() ); ?> </span>
		                                <span class="time"><?php esc_html_e( '/ Day', 'ova-crs' ); ?></span>
		                            <?php }	
		                    	}else{

		                    		echo $product->get_price_html();

		                    	}
		                        ?>
		                        <span class="text"><?php esc_html_e( 'Rent It', 'ova-crs' ); ?></span>
		                    </span></a>
		                </div>
		            

		        </div>

		    </div>
		            


		    <div class="content ">

		        <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>


		        <div class="woocommerce-product-rating">
		                
		            <?php echo wc_get_rating_html( $average, $rating_count ); ?>
		            <?php if( comments_open() ){ ?>
		                <span class="count"><?php echo $review_count; ?> </span><?php esc_html_e( ' reviews', 'ova-crs' ); ?>
		            <?php } ?>

		        </div>
		    	


		        <!-- Show attribute -->
		        <?php $total_attribute = get_theme_mod( 'rl_search_total_attribute', '0' );
    		    if( $total_attribute > 0 ){

	    		    $attributes = $product->get_attributes();
			       	foreach ( $attributes as $attribute ) :
			       		
			       		$values = array();

						if ( $attribute->is_taxonomy() ) {
							$attribute_taxonomy = $attribute->get_taxonomy_object();
							$attribute_values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

							foreach ( $attribute_values as $attribute_value ) {
								$value_name = esc_html( $attribute_value->name );

								if ( $attribute_taxonomy->attribute_public ) {
									$values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
								} else {
									$values[] = $value_name;
								}
							}
						} else {
							$values = $attribute->get_options();

							foreach ( $values as &$value ) {
								$value = make_clickable( esc_html( $value ) );
							}
						}?>
						<?php if( !empty( $values ) ){ ?>
						<div class="product_attr"><span class="label"><?php echo wc_attribute_label( $attribute->get_name() ) ?> : </span><span class="value"><?php echo apply_filters( 'woocommerce_attribute',  wptexturize( implode( ', ', $values ) ) , $attribute, $values ); ?><span></div>
						<?php } ?>
						
			       	<?php endforeach; 

		       } ?>

		        <?php $total_features = get_theme_mod( 'rl_search_total_features', '6' );
                if( (int)$total_features > 0 ){ ?>

	            <div class="features"><div class="container-fluid"><div class="row">

	                    <?php
	                    $features = get_post_meta( get_the_id(), 'ovacrs_features_special', true );
	                    $icon = get_post_meta( get_the_id(), 'ovacrs_features_icons', true );
	                    $desc = get_post_meta( get_the_id(), 'ovacrs_features_desc', true );
	                    $d = 0;
	                    if( $features ){
	                        foreach ($features as $key => $value) {
	                            if( $value == 'yes' && trim( $desc[$key] ) != '' && trim( $icon[$key] ) != '' ){
	                                $class = ($d%2) ? 'eve' : 'odd'; ?>
	                                <div class="feature-item <?php echo esc_attr( $class ); ?> ">
	                                <i class="<?php echo esc_attr( $icon[$key] ); ?>"> </i>
	                                <span class="desc"><?php echo esc_attr( $desc[$key] ); ?></span>
	                                </div>
	                                <?php $d++;
	                                if( $d >= $total_features ) break;
	                            }
	                        }
	                    } ?>
	                    
	            </div></div></div>

	            <?php } ?>


	             <?php $total_other_features = get_theme_mod( 'rl_search_total_other_features', '4' ); ?>
	            <?php if( (int)$total_other_features > 0 ){ ?>
	                <div class="other_features"><div class="container-fluid"><div class="row">
	                    <?php 
	                        $d = 0;
	                        $other_features = get_post_meta( get_the_id(), 'ovacrs_other_features_name', true );

	                        if( $other_features ){
	                            foreach ($other_features as $key => $value) {
	                                if( $value != '' ){ ?>
	                                    <div class="item">
	                                        <i class="icon_check"></i>
	                                        <span class="other-feature-item"><?php echo esc_html($value); ?></span>    
	                                    </div>
	                                    
	                                    <?php $d++;
	                                    if( $d >= $total_other_features ) break;
	                                }
	                            }
	                        }
	                     ?>
	                </div></div></div>
	            <?php } ?>
		        

		    </div>

		</div>

	<?php endwhile; ?>

		<div class="container"></div>
		<nav class="woocommerce-pagination-search">
			<?php //ovacrs_pagination_theme( $rental_products );   ?>
			<?php 

			$big = 999999999; // need an unlikely integer

			$args = array(
				'base'               => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'             => '?paged=%#%',
				'current' => max( 1, get_query_var('paged') ),
				'total' => $rental_products->max_num_pages,
				'show_all'           => false,
				'end_size'           => 1,
				'mid_size'           => 2,
				'prev_next'          => true,
				'prev_text'          => '<i class="arrow_carrot-left"></i>',
				'next_text'          => '<i class="arrow_carrot-right"></i>',
				'type'               => 'plain',
				'add_args'           => false,
				'add_fragment'       => '',
				'before_page_number' => '',
				'after_page_number'  => ''
			);

			echo paginate_links( $args );

			 ?>
		</nav>
	
	<?php else :
		esc_html_e( 'Not Found', 'ova-crs' );
	endif; wp_reset_postdata();
	?>
	
</div>

<?php }else{ ?>
	<?php esc_html_e( 'Not Found Vehicle', 'ova-crs' ); ?>
<?php } ?>

</div></div>

<?php 
do_action('ireca_woo_close_layout');
get_footer();