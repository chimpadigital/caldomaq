<?php if( get_theme_mod( 'rd_show_calendar', 'true' ) == 'true' ){ ?>
	<?php 
	$post_id = get_the_id();
	
	$statuses = array( 'wc-completed', 'wc-processing', 'wc-on-hold' );
	$order_date = get_order_rent_time( $post_id, $statuses );


	if( $order_date ){
			wp_localize_script( 'ireca', 'order_time', $order_date );
			wp_enqueue_script( 'ireca' );

	} 



	$nav_month = get_theme_mod( 'rd_ca_nav_month', 'true' ) == 'true' ? 'month' : '';
	$nav_week = get_theme_mod( 'rd_ca_nav_week', 'true' ) == 'true' ? 'agendaWeek' : '';
	$nav_day = get_theme_mod( 'rd_ca_nav_day', 'true' ) == 'true' ? 'agendaDay' : '';
	$nav_list = get_theme_mod( 'rd_ca_nav_list', 'true' ) == 'true' ? 'listWeek' : '';
	$nav =  $nav_month.','.$nav_week.','.$nav_day.','.$nav_list;

	$default_view = ( get_theme_mod( 'rd_ca_default_view', 'month' ) != '' ) ? get_theme_mod( 'rd_ca_default_view', 'month' ) : 'month';
	?>

	
	<div id="calendar" class="ireca__product_calendar" data-nav="<?php echo esc_attr( $nav ); ?>" data-default_view="<?php echo esc_attr( $default_view ); ?>" data-more_text="<?php esc_html_e( 'more', 'ireca' ); ?>">
	
		<ul class="intruction">
			<li>
				<span class="pink"></span>
				<span class="white"></span>
				<span><?php esc_html_e( 'Avaiable','ireca' ) ?></span>		
			</li>
			
			<li>
				<span class="yellow"></span>
				<span><?php esc_html_e( 'Rent full day: No . Rent Hour: Yes','ireca' ) ?></span>		
			</li>
		</ul>

	</div>

<?php } ?>