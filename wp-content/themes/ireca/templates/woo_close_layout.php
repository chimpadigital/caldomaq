<?php 
// Close layout
add_action( 'ireca_woo_close_layout',  'ireca_woo_close_layout' );

function ireca_woo_close_layout(){
	wp_reset_postdata();
	$main_layout = get_theme_mod('woo_layout','no_sidebar');
	$width_sidebar = ireca_woo_width_sidebar();
	?>

	<?php if( $main_layout != 'fullwidth' ){ ?>
	</div>
	<?php } ?>


	<?php if( $main_layout == "right_sidebar" || $main_layout == "left_sidebar" ){ ?>
	    <div class="<?php echo esc_attr($width_sidebar); ?>">
	       <?php get_sidebar('shop'); ?>
	    </div>
	<?php } ?>


	<?php if( $main_layout != 'fullwidth' && $main_layout != 'no_sidebar' ){ ?>
		</div></div></section>	
	<?php }else{ ?>
		</div></section>	
	<?php } ?>

<?php }