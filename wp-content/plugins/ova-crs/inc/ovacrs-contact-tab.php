<?php defined( 'ABSPATH' ) || exit();

function woo_new_product_tab( $tabs ) {
	
	// Adds the new tab
	if( get_theme_mod( 'rd_show_request_booking', 'true' ) == 'true' ){
		$tabs['ovacrs_contact'] = array(
			'title' 	=> esc_html__( 'Request for booking', 'ova-crs' ),
			'priority' 	=> get_theme_mod( 'rd_rbf_order_tab', 11 ),
			'callback' 	=> 'ovacrs_woo_new_product_tab_content'
		);
	}

	return $tabs;

}

function ovacrs_woo_new_product_tab_content() { ?>
	
	
	<?php $product_id = get_the_id(); ?>
	<div class="request_booking">
		<h4 class="title">
			<?php esc_html_e( 'Send your requirement to us. We will check email and contact you soon.', 'ova-crs' ); ?>
		</h4>
		<form class="form" id="request_booking" action="<?php echo home_url('/'); ?>" method="post" enctype="multipart/form-data" data-mesg_required="<?php esc_html_e( 'This field is required.', 'ova-crs' ); ?>">

			<div class="row wrap_fields">

				
				<div class="col-md-3 rb_field">
					<label><?php esc_html_e( 'Name', 'ova-crs' ); ?></label>
					<input type="text" class="required" name="name" placeholder="<?php esc_html_e( 'John Doe', 'ova-crs' ); ?> ">	
				</div>
				
				<div class="col-md-3 rb_field">
					<label><?php esc_html_e( 'Email', 'ova-crs' ); ?></label>
					<input type="text" class="required" name="email" placeholder="<?php esc_html_e( 'sample@yourcompany.com', 'ova-crs' ); ?> ">	
				</div>
				
				<?php if( get_theme_mod( 'rd_rbf_show_number', 'true' ) == 'true' ){ ?>
				<div class="col-md-3 rb_field">
					<label><?php esc_html_e( 'Number', 'ova-crs' ); ?></label>
					<input type="text" name="number" placeholder="<?php esc_html_e( '+66-4545688', 'ova-crs' ); ?> ">
				</div>
				<?php } ?>

				<?php if( get_theme_mod( 'rd_rbf_show_address', 'true' ) == 'true' ){ ?>
					<div class="col-md-3 rb_field">
						<label><?php esc_html_e( 'Address', 'ova-crs' ); ?></label>
						<input type="text" name="address" placeholder="<?php esc_html_e( 'Address', 'ova-crs' ); ?> ">	
					</div>
				<?php } ?>

				
				<?php if( get_theme_mod( 'rd_rbf_show_pickup_loc', 'true' ) == 'true' ){ ?>
				<div class="col-md-3 rb_field">
					<label><?php esc_html_e( 'Pick-up Location', 'ova-crs' ); ?></label>
					<?php echo ovacrs_get_locations_html( $name = 'ovacrs_pickup_loc' ); ?>
				</div>
				<?php } ?>

				<?php if( get_theme_mod( 'rd_rbf_show_pickoff_loc', 'true' ) == 'true' ){ ?>
				<div class="col-md-3 rb_field">
					<label><?php esc_html_e( 'Drop-off Location', 'ova-crs' ); ?></label>
					<?php echo ovacrs_get_locations_html( $name = 'ovacrs_pickoff_loc' ); ?>
				</div>
				<?php } ?>


				<?php 
					$hour_default = get_theme_mod( 'rd_bf_hour_default', '09:00' ); 
					$time_step = get_theme_mod( 'rd_bf_time_step', '30' ); 
					$dateformat = get_theme_mod( 'rd_bf_dateformat', 'Y-m-d H:i' );
				?>

				<div class="col-md-3 rb_field">
					<label><?php esc_html_e( 'Pick-up Date', 'ova-crs' ); ?></label>
					<input type="text" onkeydown="return false" name="pickup_date" data-hour_default="<?php echo esc_attr( $hour_default ); ?>" data-time_step="<?php echo esc_attr( $time_step ); ?>" data-dateformat="<?php echo esc_attr( $dateformat ); ?>"  class="required ovacrs_datetimepicker" placeholder="<?php echo esc_attr( $dateformat ); ?> " autocomplete="off">	
				</div>

				<div class="col-md-3 rb_field">
					<label><?php esc_html_e( 'Drop-off Date', 'ova-crs' ); ?></label>
					<input type="text" name="pickoff_date" onkeydown="return false" data-hour_default="<?php echo esc_attr( $hour_default ); ?>" data-time_step="<?php echo esc_attr( $time_step ); ?>" data-dateformat="<?php echo esc_attr( $dateformat ); ?>"  class="required ovacrs_datetimepicker" placeholder="<?php echo esc_attr( $dateformat ); ?>" autocomplete="off">	
				</div>

			</div>


			
			<?php if( get_theme_mod( 'rd_rbf_show_extra_source', 'true' ) == 'true' ){ ?>
				<?php $ovacrs_resource_name = get_post_meta( $product_id, 'ovacrs_resource_name', true ); 
					if( $ovacrs_resource_name ){

						$ovacrs_resource_price = get_post_meta( $product_id, 'ovacrs_resource_price', true ); 
						$ovacrs_resource_duration_val = get_post_meta( $product_id, 'ovacrs_resource_duration_val', true ); 
						$ovacrs_resource_duration_type = get_post_meta( $product_id, 'ovacrs_resource_duration_type', true ); 
						$ovacrs_resource_id = get_post_meta( $product_id, 'ovacrs_resource_id', true ); 
				?>
				<div class="ireca_extra_service">
					<label><?php esc_html_e( 'Extra Service', 'ova-crs' ); ?></label>
			
					<div class="row-fluid ovacrs_resource"><div class="row">
						<?php foreach ($ovacrs_resource_name as $key => $value) { ?>
							<div class="item col-lg-4 col-md-6">
								
									<div class="left">
										<?php $ovacrs_resource_key = $ovacrs_resource_id[$key]; ?>
										<input type="checkbox" name="ovacrs_resource_checkboxs[]" value="<?php echo $ovacrs_resource_name[$key];  ?>" >
										<?php esc_html_e( $ovacrs_resource_name[$key] ); ?>
									</div>
									<div class="right">
										<div class="resource">
											<span class="dur_price"><?php echo wc_price( $ovacrs_resource_price[$key] ); ?></span>
											<span class="slash">/</span>
											<span class="dur_val"><?php echo $ovacrs_resource_duration_val ? esc_html__( $ovacrs_resource_duration_val[$key] ) : ''; ?></span>
											<span class="dur_type">
												<?php
													if( $ovacrs_resource_duration_type[$key] == 'hours' ){
														esc_html_e( 'Hour(s)', 'ova-crs' );
													}else if( $ovacrs_resource_duration_type[$key] == 'days' ){
														esc_html_e( 'Day(s)', 'ova-crs' );
													}if( $ovacrs_resource_duration_type[$key] == 'total' ){
														esc_html_e( 'Total', 'ova-crs' );
													}
												?>
											</span>
										</div>
									</div>

							
							</div>
						<?php } ?>
						
					</div></div>
				</div>

			<?php } } ?>


			<?php if( get_theme_mod( 'rd_rbf_show_extra_info', 'true' ) == 'true' ){ ?>
				<div class="extra">
					<textarea name="extra" cols="50" rows="5" placeholder="<?php esc_html_e( 'Extra Information', 'ova-crs' ); ?>"></textarea>
				</div>
			<?php } ?>



			
			
			<input type="hidden" name="request_booking" value="request_booking" />
			
			<button type="submit" class="submit btn_tran"><?php esc_html_e( 'Send', 'ova-crs' ); ?> </button>
			
		</form>
	</div>
	
	
<?php }



