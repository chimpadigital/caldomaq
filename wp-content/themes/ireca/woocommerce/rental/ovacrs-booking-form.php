<?php $post_id = get_the_id(); ?>
<div class="ireca_booking_form" id="ireca_booking_form">
	<h3 class="title"><?php esc_html_e( 'Booking Form', 'ireca' ); ?></h3>
	<form class="form" id="booking_form" action="<?php home_url('/'); ?>" method="post" enctype="multipart/form-data" data-mesg_required="<?php esc_html_e( 'This field is required.', 'ireca' ); ?>">

		<div class="row wrap_fields">
			
			<?php if( get_theme_mod( 'rd_bf_show_pickup_loc', 'true' ) == 'true' ){ ?>
				<div class="col-md-3 rb_field">
					<label><?php esc_html_e( 'Pick-up Location', 'ireca' ); ?></label>
					<?php echo ovacrs_get_locations_html( $class = 'ovacrs_pickup_loc', $required = 'required' ); ?>
					
				</div>
			<?php } ?>


			<?php if( get_theme_mod( 'rd_bf_show_pickoff_loc', 'true' ) == 'true' ){ ?>
			<div class="col-md-3 rb_field">
				<label><?php esc_html_e( 'Drop-off Location', 'ireca' ); ?></label>
				<?php echo ovacrs_get_locations_html( $class = 'ovacrs_pickoff_loc', $required = 'required' ); ?>
			</div>
			<?php } ?>
			
			<div class="col-md-3 rb_field">
				<?php $hour_default = get_theme_mod( 'rd_bf_hour_default', '09:00' ); 
				$time_step = get_theme_mod( 'rd_bf_time_step', '30' ); 
				$dateformat = get_theme_mod( 'rd_bf_dateformat', 'Y-m-d H:i' );
				?>
				<label><?php esc_html_e( 'Pick-up Date', 'ireca' ); ?></label>
				<input type="text" onkeydown="return false" name="ovacrs_pickup_date" data-hour_default="<?php echo esc_attr( $hour_default ); ?>" data-time_step="<?php echo esc_attr( $time_step ); ?>"   data-dateformat="<?php echo esc_attr( $dateformat ); ?>" class="required ovacrs_datetimepicker" placeholder="<?php echo esc_attr( $dateformat ); ?>" autocomplete="off" />
			</div>

			<div class="col-md-3 rb_field">
				<label><?php esc_html_e( 'Drop-off Date', 'ireca' ); ?></label>
				<input type="text" name="ovacrs_pickoff_date" onkeydown="return false"  data-hour_default="<?php echo esc_attr( $hour_default ); ?>" data-time_step="<?php echo esc_attr( $time_step ); ?>" data-dateformat="<?php echo esc_attr( $dateformat ); ?>" class="required ovacrs_datetimepicker" placeholder="<?php echo esc_attr( $dateformat ); ?>"   autocomplete="off"/>
			</div>

		</div>

		
		<?php 
			if( get_theme_mod( 'rd_bf_show_extra_resource', 'true' ) == 'true' ){
			$ovacrs_resource_name = get_post_meta( $post_id, 'ovacrs_resource_name', true ); 
			if( $ovacrs_resource_name ){

				$ovacrs_resource_price = get_post_meta( $post_id, 'ovacrs_resource_price', true ); 
				$ovacrs_resource_duration_val = get_post_meta( $post_id, 'ovacrs_resource_duration_val', true ); 
				$ovacrs_resource_duration_type = get_post_meta( $post_id, 'ovacrs_resource_duration_type', true ); 
				$ovacrs_resource_id = get_post_meta( $post_id, 'ovacrs_resource_id', true ); 
		?>
			<div class="ireca_extra_service">
				<label><?php esc_html_e( 'Extra Service', 'ireca' ); ?></label>
						
					<div class="row ovacrs_resource">
						<?php foreach ($ovacrs_resource_name as $key => $value) { ?>
							<div class="item col-lg-4 col-md-6">
								
									<div class="left">
										<?php $ovacrs_resource_key = $ovacrs_resource_id[$key]; ?>
										<input type="checkbox" name="ovacrs_resource_checkboxs[<?php echo esc_attr( $ovacrs_resource_key ); ?>]" value="<?php echo esc_attr( $ovacrs_resource_name[$key] );  ?>" >
										<?php echo esc_html( $ovacrs_resource_name[$key] ); ?>
									</div>
									<div class="right">
										<div class="resource">
											<span class="dur_price"><?php echo wc_price( $ovacrs_resource_price[$key] ); ?></span>
											<span class="slash">/</span>
											<span class="dur_val"><?php if ( $ovacrs_resource_duration_val != '' )echo esc_html( $ovacrs_resource_duration_val[$key] ); ?></span>
											<span class="dur_type">
												<?php
													if( $ovacrs_resource_duration_type[$key] == 'hours' ){
														esc_html_e( 'Hour(s)', 'ireca' );
													}else if( $ovacrs_resource_duration_type[$key] == 'days' ){
														esc_html_e( 'Day(s)', 'ireca' );
													}if( $ovacrs_resource_duration_type[$key] == 'total' ){
														esc_html_e( 'Total', 'ireca' );
													}
												?>
											</span>
										</div>
									</div>

							
							</div>
						<?php } ?>
					</div>
			</div>
		<?php } } ?>
		

		<button type="submit" class="submit btn_tran"><?php esc_html_e( 'Booking', 'ireca' ); ?></button>

		<input type="hidden" name="car_id" value="<?php echo get_the_id(); ?>" />
		<?php $ovacrs_car_rental = 'ovacrs_car_rental'; ?>
		<input type="hidden" name="custom_product_type" value="<?php echo esc_attr( $ovacrs_car_rental ); ?>" />

		<input type="hidden" name="add-to-cart" value="<?php echo get_the_id(); ?>" />

		<input type="hidden" name="quantity" value="1" />

		

	</form>

</div>




