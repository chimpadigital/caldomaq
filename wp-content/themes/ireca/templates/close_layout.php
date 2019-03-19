<?php 

function ireca_close_layout($special_layout){
	
	// Close layout
	wp_reset_postdata();
	$main_layout = $special_layout ? $special_layout : ireca_get_current_main_layout();
	$width_sidebar = ireca_width_sidebar($special_layout);
	?>

	<?php if( $main_layout != 'fullwidth' ){ ?>	
		</div>
	<?php } ?>


	<?php if( $main_layout == "right_sidebar" || $main_layout == "left_sidebar" ){ ?>
	    <div class="<?php echo esc_attr($width_sidebar); ?>">
	       <?php get_sidebar(); ?>
	    </div>
	<?php } ?>

	<?php if( $main_layout != 'fullwidth' ){ ?>	
		</div></div></section>
	<?php } ?>

	<?php 

}

add_action( 'ireca_close_layout', 'ireca_close_layout', 10, 1 );










