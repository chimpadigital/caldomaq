<?php
// Display Manage Booking
function ovacrs_display_booking(){
	//Create an instance of our package class...
    $manage_booking = new List_Booking();
    //Fetch, prepare, sort, and filter our data...
    $manage_booking->prepare_items();

    $all_rooms = get_all_rooms();

    $current_room_id = isset( $_POST['room_id'] ) ? $_POST['room_id'] : '';
    $room_code = isset( $_POST['room_code'] ) ? $_POST['room_code'] : '';
    
    $check_in_out = isset($_POST['check_in_out'] ) ? $_POST['check_in_out'] : '';
    $filter_order_status = isset($_POST['filter_order_status'] ) ? $_POST['filter_order_status'] : '';
   
    
    $from_day = isset( $_POST['from_day'] ) ? $_POST['from_day'] : '';
    $to_day = isset( $_POST['to_day'] ) ? $_POST['to_day'] : '';
    

    $all_locations = get_all_locations();
    $current_pickup_loc = isset( $_POST['pickup_loc'] ) ? $_POST['pickup_loc'] : '';
    $current_pickoff_loc = isset( $_POST['pickoff_loc'] ) ? $_POST['pickoff_loc'] : '';

    $all_vehicles = ovacrs_get_all_id_vehicles();

?>
<div class="wrap">
    <form id="booking-filter" method="POST" action="<?php echo home_url('/').'wp-admin/edit.php?post_type=product&page=manage-booking'; ?>">
    	<h2><?php esc_html_e( 'Manage Booking', 'ova-hotel' ); ?></h2>
    	<div class="booking_filter">
    		
            <select name="check_in_out">
                <option value=""><?php esc_html_e( '-- All --', 'ova-hotel' ); ?></option>
                <option value="check_in" <?php echo ( $check_in_out == 'check_in' ) ? 'selected' : ''; ?> ><?php esc_html_e( 'Check-in date', 'ova-hotel' ); ?></option>
                <option value="check_out" <?php echo ( $check_in_out == 'check_out' ) ? 'selected' : ''; ?>><?php esc_html_e( 'Check-out date', 'ova-hotel' ); ?></option>
            </select>

    		<input type="text" name="from_day" value="<?php echo $from_day ?>" placeholder="<?php esc_html_e('From day', 'ova-hotel'); ?>" class="ovacrs_rt_startdate date_book" autocomplete="off"/>
    		
    		<?php esc_html_e('to','ova-hotel'); ?>
    		
    		<input type="text" name="to_day" value="<?php echo $to_day ?>" placeholder="<?php esc_html_e('To day', 'ova-hotel'); ?>" class="ovacrs_rt_enddate date_book" autocomplete="off" />


          

            <select name="room_code">
                <option value="" <?php selected( '', $room_code, 'selected'); ?>><?php esc_html_e( '-- ID Vehicle --', 'ova-hotel' ); ?></option>
                <?php 
                    if ( $all_vehicles->have_posts() ) : while ( $all_vehicles->have_posts() ) : $all_vehicles->the_post(); ?>
                        <?php $id_vehicle = get_post_meta( get_the_id(), 'ireca_met_id_vehicle', true ); ?>
                        <option value="<?php echo $id_vehicle; ?>" <?php selected( $id_vehicle, $room_code, 'selected'); ?>><?php the_title(); ?></option>
                    <?php endwhile;endif;wp_reset_postdata();
                ?>
                
            </select> 
    		
    		

            <select name="pickup_loc">
                <option value="" <?php selected( '', $current_pickup_loc, 'selected'); ?>><?php esc_html_e( '-- Pickup Location --', 'ova-hotel' ); ?></option>
                <?php 
                    if ( $all_locations->have_posts() ) : while ( $all_locations->have_posts() ) : $all_locations->the_post(); ?>
                        <option value="<?php the_title(); ?>" <?php selected( get_the_title(), $current_pickup_loc, 'selected'); ?>><?php the_title(); ?></option>
                    <?php endwhile;endif;wp_reset_postdata();
                ?>
                
            </select> 

            <select name="pickoff_loc">
                <option value="" <?php selected( '', $current_pickoff_loc, 'selected'); ?>><?php esc_html_e( '-- Pickoff Location --', 'ova-hotel' ); ?></option>
                <?php 
                    if ( $all_locations->have_posts() ) : while ( $all_locations->have_posts() ) : $all_locations->the_post(); ?>
                        <option value="<?php the_title(); ?>" <?php selected( get_the_title(), $current_pickoff_loc, 'selected'); ?>><?php the_title(); ?></option>
                    <?php endwhile;endif;wp_reset_postdata();
                ?>
                
            </select> 

    		<select name="room_id">
    			<option value="" <?php selected( '', $current_room_id, 'selected'); ?>><?php esc_html_e( '-- Choose Vehicle --', 'ova-hotel' ); ?></option>
    			<?php 
    				if ( $all_rooms->have_posts() ) : while ( $all_rooms->have_posts() ) : $all_rooms->the_post(); ?>
    					<option value="<?php the_id(); ?>" <?php selected( get_the_id(), $current_room_id, 'selected'); ?>><?php the_title(); ?></option>
    				<?php endwhile;endif;wp_reset_postdata();
    			?>
    			
    		</select>

            <select name="filter_order_status">
                <option value=""><?php esc_html_e( '-- Order Status --', 'ova-hotel' ); ?></option>
                <option value="wc-completed" <?php echo ( $filter_order_status == 'wc-completed' ) ? 'selected' : ''; ?> ><?php esc_html_e( 'Completed', 'ova-hotel' ); ?></option>
                <option value="wc-processing" <?php echo ( $filter_order_status == 'wc-processing' ) ? 'selected' : ''; ?>><?php esc_html_e( 'Processing', 'ova-hotel' ); ?></option>
                <option value="wc-on-hold" <?php echo ( $filter_order_status == 'wc-on-hold' ) ? 'selected' : ''; ?>><?php esc_html_e( 'On hold', 'ova-hotel' ); ?></option>
                <option value="wc-cancelled" <?php echo ( $filter_order_status == 'wc-cancelled' ) ? 'selected' : ''; ?>><?php esc_html_e( 'Cancel', 'ova-hotel' ); ?></option>
                
            </select>
    		

    		

			&nbsp;&nbsp;&nbsp;
			<button type="submit" class="button"><?php esc_html_e( 'Filter', 'ova-hotel' ); ?></button>

    	</div>
        <!-- For plugins, we also need to ensure that the form posts back to our current page -->
        <input type="hidden" name="post_type" value="product" />
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
        <!-- Now we can render the completed list table -->
        <?php $manage_booking->display() ?>
    </form>
</div>
<?php }
