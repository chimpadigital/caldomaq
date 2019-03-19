<?php $post_id = get_the_ID(); ?>



	
<div class="options_group show_if_ovacrs_car_rental">

	<!-- Price hour -->
	<?php  woocommerce_wp_text_input(
	  array(
	   'id'                => 'ovacrs_regul_price_hour',
	   'class'             => 'short wc_input_price',
	   'label'             => __( 'Regular price / Hour', 'ova-crs' ),
	   'placeholder'       => '',
	   'desc_tip'    => 'true',
	   'description'       => __( 'Regular price by hour', 'ova-crs' ),
	   'type'              => 'text'
	   ));

	?>

	<!-- Price Type -->
	<?php  woocommerce_wp_select(
	  array(
	   'id'                => 'ovacrs_price_type',
	   'label'             => __( 'Price Type', 'ova-crs' ),
	   'placeholder'       => '',
	   'desc_tip'    => 'true',
	   'description'       => __( 'Rent by Hour, Day, or Mixed (Hour and Day)', 'ova-crs' ),
	   'options'			=> array(
	   		'mixed'	=> esc_html__( 'Mixed (Day and Hour)', 'ova-crs' ),
	   		'hour'	=> esc_html__( 'Hour', 'ova-crs' ),
	   		'day'	=> esc_html__( 'Day', 'ova-crs' )
	   )
	   ));
	?>

	<!-- Total Vehicle -->
	<?php  woocommerce_wp_text_input(
	  array(
	   'id'                => 'ovacrs_car_count',
	   'class'             => 'short',
	   'label'             => __( 'Inventory Vehicle', 'ova-crs' ),
	   'placeholder'       => '',
	   'desc_tip'    => 'true',
	   'description'       => __( 'Total number of vehicles in the store', 'ova-crs' ),
	   'type'              => 'number'
	   ));
	?>

	<!-- ID Vehicles -->
	<!-- Feature -->
	<div class="ovacrs-form-field ">
  		<?php include( OVACRS_PLUGIN_PATH.'/templates/ovacrs_id_vehicle.php' ); ?>
	</div>
	
	

	
	 <?php  woocommerce_wp_text_input(
	  array(
	   'id'                => 'ovacrs_car_order',
	   'class'             => 'short ',
	   'label'             => __( 'Order at frontend', 'ova-crs' ),
	   'placeholder'       => '1',
	   'desc_tip'    => 'true',
	   'description'       => __( 'Use in some elements', 'ova-crs' ),
	   'type'              => 'number'
	   ));
	?>
	
	<!-- Video Link -->
	<div class="ovacrs-form-field ">
		<br/><strong class="ovacrs_heading_section"><?php esc_html_e('Video', 'ova-crs'); ?></strong>
		<?php woocommerce_wp_text_input(
				  array(
				   'id'                => 'ovacrs_video_link',
				   'class'             => 'short ',
				   'label'             => esc_html__( 'Youtute Link', 'ova-crs' ),
				   'placeholder'		=> esc_html__( 'https://www.youtube.com/watch?v=YTT62UdAILs&t=3s', 'ova-crs' ),
				   'description'       => esc_html__( 'Insert youtube link like: https://www.youtube.com/watch?v=YTT62UdAILs&t=3s', 'ova-crs' ),
				   'desc_tip'    => 'true',
				   'type'              => 'text'
				)); ?>
	</div>


	

	<!-- Feature -->
	<div class="ovacrs-form-field ">
  		<br/><strong class="ovacrs_heading_section"><?php esc_html_e('Features', 'ova-crs'); ?></strong>
  		<?php include( OVACRS_PLUGIN_PATH.'/templates/ovacrs_features.php' ); ?>
	</div>

	<!-- Other Feature -->
	<div class="ovacrs-form-field ">
  		<br/><strong class="ovacrs_heading_section"><?php esc_html_e('Other Features', 'ova-crs'); ?></strong>
  		<?php include( OVACRS_PLUGIN_PATH.'/templates/ovacrs_other_features.php' ); ?>
	</div>




	<!-- Global Discount -->
	<div class="ovacrs-form-field ">
  		<br/><strong class="ovacrs_heading_section"><?php esc_html_e('Setup price by rent duration (PD)', 'ova-crs'); ?></strong>
  		<?php include( OVACRS_PLUGIN_PATH.'/templates/ovacrs_global_discount.php' ); ?>
	</div>



	<!-- Price by range time -->
	<div class="ovacrs-form-field ">
		<br/><strong class="ovacrs_heading_section"><?php esc_html_e('Special Time (ST)', 'ova-crs'); ?></strong>
		<span class="ovacrs_right"><?php esc_html_e( 'Note: ST doesnt use PD, it will use PST', 'ova-crs' ); ?></span>
		<?php include( OVACRS_PLUGIN_PATH.'/templates/ovacrs_rt.php' ); ?>
	</div>

	

	<!-- Resources -->
	<div class="ovacrs-form-field ">
  		<br/><strong class="ovacrs_heading_section"><?php esc_html_e('Resources', 'ova-crs'); ?></strong>
  		<?php include( OVACRS_PLUGIN_PATH.'/templates/ovacrs_resources.php' ); ?>
	</div>


	<!-- unavailable time -->
	<div class="ovacrs-form-field">
		<br/><strong class="ovacrs_heading_section"><?php esc_html_e( 'Unavailable Time (UT)', 'ova-crs' ); ?></strong>
		<?php include( OVACRS_PLUGIN_PATH.'/templates/ovacrs_untime.php' ); ?>
	</div>

	<!-- Rent min -->
	<div class="ovacrs-form-field">
		<br/><strong class="ovacrs_heading_section"><?php esc_html_e( 'Rent Time Min', 'ova-crs' ); ?></strong>
		<?php include( OVACRS_PLUGIN_PATH.'/templates/ovacrs_rent_time_min.php' ); ?>
	</div>	

	





</div>