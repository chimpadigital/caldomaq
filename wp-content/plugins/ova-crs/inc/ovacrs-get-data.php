<?php if ( !defined( 'ABSPATH' ) ) exit();

/**
 * Returns every date between two dates as an array
 * @param string $startDate the start of the date range
 * @param string $endDate the end of the date range
 * @param string $format DateTime format, default is Y-m-d
 * @return array returns every date between $startDate and $endDate, formatted as "Y-m-d"
 */


function ovacrs_createDatefull($start, $end, $format = "Y-m-d"){
    
    $dates = array();
    while($start <= $end){
        array_push( $dates, date( $format, $start) );
        $start += 86400;
    }

    return $dates;
} 

function total_between_2_days( $start, $end){
    return floor( abs( strtotime($end) - strtotime($start) ) / (60*60*24) );
}




function ovacrs_array_flatten($array) { 
  if (!is_array($array)) { 
    return FALSE; 
  } 
  $result = array(); 
  foreach ($array as $key => $value) { 
    if (is_array($value)) { 
      $result = array_merge($result, ovacrs_array_flatten($value)); 
    } 
    else { 
      $result[$key] = $value; 
    } 
  } 
  return $result; 
}



function get_order_rent_time( $product_id, $order_status = array( 'wc-completed' ) ){


	global $wpdb;

	$order_date = $order_date_bg = $dates_avaiable = array();
    $total_each_day = array();

    $count_car_in_store = get_post_meta( $product_id, 'ovacrs_car_count', true );
    
    $orders_ids = $wpdb->get_col("
        SELECT Distinct order_items.order_id
        FROM {$wpdb->prefix}woocommerce_order_items as order_items
        LEFT JOIN {$wpdb->prefix}woocommerce_order_itemmeta as order_item_meta ON order_items.order_item_id = order_item_meta.order_item_id
        LEFT JOIN {$wpdb->posts} AS posts ON order_items.order_id = posts.ID
        WHERE posts.post_type = 'shop_order'
        AND posts.post_status IN ( '" . implode( "','", $order_status ) . "' )
        AND order_items.order_item_type = 'line_item'
        AND order_item_meta.meta_key = '_product_id'
        AND order_item_meta.meta_value = '$product_id'
    ");


    foreach ($orders_ids as $key => $value) {

        // Get Order Detail by Order ID
        $order = wc_get_order($value);

        // Get Meta Data type line_item of Order
        $order_line_items = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
       
        // For Meta Data
        foreach ( $order_line_items as $item_id => $item ) {

            $ovacrs_pickup_date_store = $ovacrs_pickoff_date_store = '';

            // Get value of pickup date, pickoff date
            foreach ( $item->get_formatted_meta_data() as $meta_id => $meta ) {
                if( $meta->key == 'ovacrs_pickup_date' ){
                    $ovacrs_pickup_date_store = strtotime( str_replace('/', '-', $meta->value) );
                }
                if( $meta->key == 'ovacrs_pickoff_date' ){
                    $ovacrs_pickoff_date_store = strtotime( str_replace('/', '-', $meta->value) );
                }
            }

            if( $ovacrs_pickoff_date_store >= current_time( 'timestamp' ) ){ 


                $start_date = date( 'Y-m-d', $ovacrs_pickup_date_store );
                $end_date = date( 'Y-m-d', $ovacrs_pickoff_date_store );

                $total_between_2_days = total_between_2_days( $start_date, $end_date );



                if( $total_between_2_days == 0 ){ // In a day

                    $item =  array(  'start' => date( 'Y-m-d H:i', $ovacrs_pickup_date_store ),
                             'end' => date( 'Y-m-d H:i', $ovacrs_pickoff_date_store ),
                             'title' => date_i18n( 'H:i', $ovacrs_pickup_date_store ).'-'.date_i18n( 'H:i', $ovacrs_pickoff_date_store )
                     );
                    array_push( $dates_avaiable, $item );
                    array_push( $total_each_day, date( 'Y-m-d', $ovacrs_pickup_date_store )  );

                }else if( $total_between_2_days == 1 ) { // 2 day beside

                    $item =  array(  'start' => date( 'Y-m-d H:i', $ovacrs_pickup_date_store ),
                             'end' => date( 'Y-m-d 24:00', $ovacrs_pickup_date_store ),
                             'title' => date_i18n( 'H:i', $ovacrs_pickup_date_store ).esc_html__(' 24:00', 'ova-crs')
                     );
                    array_push( $dates_avaiable, $item ); 


                    $item =  array(  'start' => date( 'Y-m-d 00:00', $ovacrs_pickoff_date_store ),
                             'end' => date( 'Y-m-d H:i', $ovacrs_pickoff_date_store ),
                             'title' => esc_html__('00:00 ', 'ova-crs').date_i18n( 'H:i', $ovacrs_pickoff_date_store )
                     );
                    array_push( $dates_avaiable, $item ); 


                    array_push( $total_each_day, date( 'Y-m-d', $ovacrs_pickup_date_store )  );
                    array_push( $total_each_day, date( 'Y-m-d', $ovacrs_pickoff_date_store )  );


                }else{ // from 3 days 

                    $item =  array(  'start' => date( 'Y-m-d H:i', $ovacrs_pickup_date_store ),
                             'end' => date( 'Y-m-d 24:00', $ovacrs_pickup_date_store ),
                             'title' => date_i18n( 'H:i', $ovacrs_pickup_date_store ).esc_html__(' 24:00', 'ova-crs')
                     );
                    array_push( $dates_avaiable, $item ); 


                    $item =  array(  'start' => date( 'Y-m-d 00:00', $ovacrs_pickoff_date_store ),
                             'end' => date( 'Y-m-d H:i', $ovacrs_pickoff_date_store ),
                             'title' => esc_html__('00:00 ', 'ova-crs').date_i18n( 'H:i', $ovacrs_pickoff_date_store )
                     );
                    array_push( $dates_avaiable, $item );


                    array_push( $total_each_day, date( 'Y-m-d', $ovacrs_pickup_date_store )  );
                    array_push( $total_each_day, date( 'Y-m-d', $ovacrs_pickoff_date_store )  );


                    $date_between_start_end = ovacrs_createDatefull( strtotime( $start_date ), strtotime( $end_date ), $format='Y-m-d' );

                    // Remove first and last array
                    array_shift( $date_between_start_end ); 
                    array_pop( $date_between_start_end );

                    foreach ( $date_between_start_end as $key => $value) {

                        $item =  array(  'start' => $value,
                                 'end' => $value,
                                 'title' => esc_html__('00:00 24:00 ', 'ova-crs')
                         );
                        array_push( $dates_avaiable, $item );

                        array_push( $total_each_day, $value  );
                    }

                }

                

            }
        }
    }
   

    $order_date_bg = ovacrs_array_flatten( $total_each_day );
    $count_values = array_count_values( $order_date_bg );


    $bg_rented = get_theme_mod( 'main_color', '#e9a31b' );
    foreach ($count_values as $key => $value) {
        if( $value >= $count_car_in_store ){
            $item =  array(  'start' => $key,
                             'end' => $key,
                             'rendering' => 'background',
                             'color' => $bg_rented,
                             'overlap' => false,
                             'title' => '',
                             
                     );
            array_push( $dates_avaiable, $item );
        }
    }

    return json_encode( $dates_avaiable );

}




function ovacrs_get_orders_by_product_id( $product_id, $order_status = array( 'wc-completed' ) ){
    global $wpdb;
    
    $results = $wpdb->get_col("
        SELECT order_items.order_id
        FROM {$wpdb->prefix}woocommerce_order_items as order_items
        LEFT JOIN {$wpdb->prefix}woocommerce_order_itemmeta as order_item_meta ON order_items.order_item_id = order_item_meta.order_item_id
        LEFT JOIN {$wpdb->posts} AS posts ON order_items.order_id = posts.ID
        WHERE posts.post_type = 'shop_order'
        AND posts.post_status IN ( '" . implode( "','", $order_status ) . "' )
        AND order_items.order_item_type = 'line_item'
        AND order_item_meta.meta_key = '_product_id'
        AND order_item_meta.meta_value = '$product_id'
    ");

    return $results;
}


// Search Form
function ovacrs_search_vehicle( $data_search ){

    $pickup_loc = isset( $data_search['ovacrs_pickup_loc'] ) ? $data_search['ovacrs_pickup_loc']: '';
    $pickoff_loc = isset( $data_search['ovacrs_pickoff_loc'] ) ? $data_search['ovacrs_pickoff_loc']: '';
    $ovacrs_pickup_date = isset( $data_search['ovacrs_pickup_date'] )  ? strtotime( $data_search['ovacrs_pickup_date'] ) : '';
    $ovacrs_pickoff_date = isset( $data_search['ovacrs_pickoff_date'] ) ? strtotime( $data_search['ovacrs_pickoff_date'] ) : '';

    $category = isset( $data_search['cat'] ) ? $data_search['cat'] : '';
    $product_type = isset( $data_search['product_type'] ) ? $data_search['product_type'] : '';

    $statuses = array( 'wc-completed', 'wc-processing', 'wc-on-hold' );

    $error = array();

    $items_id = array();

    $args_base = array(
        'post_type' => 'product',
        'posts_per_page' => '-1',
        'post_status' => 'publish'
    );

    $arg_cat = ( $category != '' ) ? array(
        'taxonomy' => 'product_cat',
        'field' => 'slug',
        'terms' => $category
    ) : array('');

    $arg_type = ( $product_type != '' ) ? array(
        'taxonomy' => 'type',
        'field' => 'slug',
        'terms' => $product_type
    ) : array('');


    if( $arg_cat != '' && $arg_type != '' ){
        $args_cat = array(
            'tax_query' => array(
                'relation'  => 'AND',
                $arg_cat,
                $arg_type
            )
        );
    }else{
        $args_cat = array(
            'tax_query' => array(
                array_merge( $arg_cat, $arg_type )
            )
        );
    }
    

    $args = array_merge_recursive( $args_base, $args_cat );

    // Get All products
    $items = new WP_Query( $args );

    if ( $items->have_posts() ) : while ( $items->have_posts() ) : $items->the_post();
        
        $id = get_the_id();
        
        $car_using_this_time = 0;

        $ovacrs_pickup_date_store = $ovacrs_pickoff_date_store = '';

        // Total Car in the Store
        $total_car_store = get_post_meta( $id, 'ovacrs_car_count', true ) ? get_post_meta( $id, 'ovacrs_car_count', true ) : 0;
        
        $orders_ids = ovacrs_get_orders_by_product_id( $id, $statuses );

        // For Order ID
        foreach ($orders_ids as $key => $value) {

            // Get Order Detail by Order ID
            $order = wc_get_order($value);

            // Get Meta Data type line_item of Order
            $order_items = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
           
            // For Meta Data
            foreach ( $order_items as $item_id => $item ) {

                // Check Line Item have item ID is Car_ID
                if( $item->get_product_id() == $id ){

                    // Get value of pickup date, pickoff date
                    foreach ( $item->get_formatted_meta_data() as $meta_id => $meta ) {
                        if( $meta->key == 'ovacrs_pickup_date' ){
                            $ovacrs_pickup_date_store = strtotime( str_replace('/', '-', $meta->value) );
                        }
                        if( $meta->key == 'ovacrs_pickoff_date' ){
                            $ovacrs_pickoff_date_store = strtotime( str_replace('/', '-', $meta->value) );
                        }
                    }

                    // Only compare date when "PickOff Date in Store" > "Current Time" becaue "PickOff Date Rent" have to > "Current Time"
                    if( $ovacrs_pickoff_date_store >= current_time( 'timestamp' ) ){
                        
                        // Check rent time
                        if( ! ($ovacrs_pickoff_date < $ovacrs_pickup_date_store || $ovacrs_pickoff_date_store < $ovacrs_pickup_date ) ){
                            $car_using_this_time++;
                        }

                    }
                    
                }

            }

        }

        if( $car_using_this_time < $total_car_store ){

            $vehicle_avai = array();
            $vehicle_avai_flag = false;
            $vehicle_untime_flag = true;
            $product_untime_flag = true;

            if( $pickup_loc != '' && get_theme_mod( 'use_loc_filter_search', 'true' ) == 'true' ){

                $id_vehicle_available = get_post_meta( $id, 'ovacrs_id_vehicles', true );

                if( is_array( $id_vehicle_available ) ){
                    foreach ($id_vehicle_available as $key => $value) {

                        $vehicle_avai = ovacrs_get_vehicle_loc_title($value);

                        $id_vehicle_untime_startday = !empty( $vehicle_avai['untime'] ) ? strtotime( $vehicle_avai['untime']['startdate'] ) : '';
                        $id_vehicle_untime_enddate  = !empty( $vehicle_avai['untime'] ) ? strtotime( $vehicle_avai['untime']['enddate'] ) : '';

                        if( $pickup_loc == $vehicle_avai['loc'] ){

                            if( ! ( $ovacrs_pickoff_date < $id_vehicle_untime_startday  ||  $id_vehicle_untime_enddate < $ovacrs_pickup_date  ) && $id_vehicle_untime_startday != '' && $id_vehicle_untime_enddate != '' ){
                                $vehicle_untime_flag = false;
                                $vehicle_avai_flag = true;

                            }else{
                                $vehicle_untime_flag = true;
                                $vehicle_avai_flag = true;
                                break;    
                            }

                            

                        }
                    }
                }

                if( $vehicle_avai_flag && $vehicle_untime_flag ){

                    // Check Product Untime
                    $product_untime_startdate = get_post_meta( $id, 'ovacrs_untime_startdate', true );
                    $product_untime_enddate = get_post_meta( $id, 'ovacrs_untime_enddate', true );

                    if( $product_untime_startdate && $product_untime_enddate ){
                        foreach ($product_untime_startdate as $key => $value) {
                            if( ! ($ovacrs_pickoff_date < strtotime( $product_untime_startdate[$key] ) || strtotime( $product_untime_enddate[$key] ) < $ovacrs_pickup_date ) ){
                                $product_untime_flag = false;
                                break;
                            }
                        }
                    }
                    if( $product_untime_flag ){
                        array_push($items_id, $id);    
                    }
                    
                }
                    
                   
            }else{

                $id_vehicle_available = get_post_meta( $id, 'ovacrs_id_vehicles', true );

                if( is_array( $id_vehicle_available ) ){

                    foreach ($id_vehicle_available as $key => $value) {

                        $vehicle_avai = ovacrs_get_vehicle_loc_title($value);

                        $id_vehicle_untime_startday = !empty( $vehicle_avai['untime'] ) ? strtotime( $vehicle_avai['untime']['startdate'] ) : '';
                        $id_vehicle_untime_enddate  = !empty( $vehicle_avai['untime'] ) ? strtotime( $vehicle_avai['untime']['enddate'] ) : '';


                        if( ! ( $ovacrs_pickoff_date < $id_vehicle_untime_startday  ||  $id_vehicle_untime_enddate < $ovacrs_pickup_date  ) && $id_vehicle_untime_startday != '' && $id_vehicle_untime_enddate != '' ){
                            $vehicle_untime_flag = false;
                        }else{
                            // Check Product Untime
                            $product_untime_startdate = get_post_meta( $id, 'ovacrs_untime_startdate', true );
                            $product_untime_enddate = get_post_meta( $id, 'ovacrs_untime_enddate', true );

                            if( $product_untime_startdate && $product_untime_enddate ){
                                foreach ($product_untime_startdate as $key => $value) {
                                    if( ! ($ovacrs_pickoff_date < strtotime( $product_untime_startdate[$key] ) || strtotime( $product_untime_enddate[$key] ) < $ovacrs_pickup_date ) ){
                                        $product_untime_flag = false;
                                        break;
                                    }
                                }
                            }
                            if( $product_untime_flag ){
                                array_push($items_id, $id);
                                break;   
                            }
                            
                        }
                    }
                }

            }
            

            
        }


    endwhile; else :
        return $items_id;
    endif; wp_reset_postdata();
    

    if( $items_id ){

        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

        $args_product = array(
            'post_type' => 'product',
            'posts_per_page' => 6,
            'paged' => $paged,
            'post_status' => 'publish',
            'post__in' => $items_id
        );

        $rental_products = new WP_Query( $args_product );
        return $rental_products;

    }

    return false;


}




// Check Rent by Day or Hour or both
function ovacrs_get_price_type( $post_id ){
    return get_post_meta( $post_id, 'ovacrs_price_type', true ) ;
}

// Get value rent day
function ovacrs_get_price_day( $post_id ){
    return wc_price( get_post_meta( $post_id, '_regular_price', true ) );
}

// Get value hour day
function ovacrs_get_price_hour( $post_id ){
    return wc_price( get_post_meta( $post_id, 'ovacrs_regul_price_hour', true ) );
}



// Get all location
function ovacrs_get_locations(){
    $locations = new WP_Query(
        array(
            'post_type' => 'location',
            'post_status' => 'publish',
            'posts_per_page' => '-1'
        )
    );

    return $locations;

}

function ovacrs_get_locations_array(){
    $locations = new WP_Query(
        array(
            'post_type' => 'location',
            'post_status' => 'publish',
            'posts_per_page' => '-1'
        )
    );
    $html = array();
    if($locations->have_posts() ) : while ( $locations->have_posts() ) : $locations->the_post();
        global $post;
        $html[ trim( get_the_title() )] = trim( get_the_title() );
    endwhile; endif;wp_reset_postdata();

    return $html;

}



function ovacrs_get_locations_html( $name = '', $required = 'required', $selected = '' ){
    $locations = new WP_Query(
        array(
            'post_type' => 'location',
            'post_status' => 'publish',
            'posts_per_page' => '-1'
        )
    );

    $html = '<select name="'.$name.'" class="'.$required.'" >
        <option value="">'. esc_html__('Select Location', 'ova-crs').'</option>';
        if($locations->have_posts() ) : while ( $locations->have_posts() ) : $locations->the_post();
            global $post;
            $active = ( trim( get_the_title() ) === trim( $selected ) ) ? 'selected="selected"' : '';
            $html .= '<option value="'.get_the_title().'" '.$active.'>'.get_the_title().'</option>';
        endwhile; endif;wp_reset_postdata();
    $html .= '</select>';

    return $html;


}

// Get all number plate
function ovacrs_get_all_id_vehicles(){
    $vehicle = new WP_Query(
        array(
            'post_type' => 'vehicle',
            'post_status' => 'publish',
            'posts_per_page' => '-1'
        )
    );

    return $vehicle;

}

function ovacrs_get_vehicle_loc_title( $id_metabox ){
    $vehicle_arr = array();
    $vehicle = new WP_Query(
        array(
            'post_type' => 'vehicle',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'meta_query' => array(
                array(
                    'key'     => 'ireca_met_id_vehicle',
                    'value'   => $id_metabox,
                    'compare' => '=',
                ),
            ),
        )
    );
    if($vehicle->have_posts() ) : while ( $vehicle->have_posts() ) : $vehicle->the_post();
        $vehicle_arr['loc'] = get_post_meta( get_the_id(), 'ireca_met_id_vehicle_location', true );
        $vehicle_arr['untime'] = get_post_meta( get_the_id(), 'ireca_met_id_vehicle_untime_from_day', true );
    endwhile;endif;wp_reset_postdata();
    return $vehicle_arr;
}


/* Request for booking */
function ovacrs_request_booking( $data ){

    $subject = esc_html__( "Request For Booking", 'ova-crs' );

    $body = '';

    $body .= esc_html__( 'Name: ', 'ova-crs' ).$data['name'].'<br/>';
    $body .= esc_html__( 'Email: ', 'ova-crs' ).$data['email'].'<br/>';

    if( get_theme_mod( 'rd_rbf_show_number', 'true' ) == 'true' ){
        $body .= esc_html__( 'Phone: ', 'ova-crs' ).$data['number'].'<br/>';
    }

    if( get_theme_mod( 'rd_rbf_show_address', 'true' ) == 'true' ){
        $body .= esc_html__( 'Address: ', 'ova-crs' ).$data['address'].'<br/>';
    }

    if( get_theme_mod( 'rd_rbf_show_pickup_loc', 'true' ) == 'true' ){
        $body .= esc_html__( 'Pick-up Location: ', 'ova-crs' ).$data['ovacrs_pickup_loc'].'<br/>';
    }

    if( get_theme_mod( 'rd_rbf_show_pickoff_loc', 'true' ) == 'true' ){
        $body .= esc_html__( 'Drop-off Location: ', 'ova-crs' ).$data['ovacrs_pickoff_loc'].'<br/>';
    }

    
    $body .= esc_html__( 'Pick-up Date: ', 'ova-crs' ).$data['pickup_date'].'<br/>';
    $body .= esc_html__( 'Drop-off Date: ', 'ova-crs' ).$data['pickoff_date'].'<br/>';
    

    if( get_theme_mod( 'rd_rbf_show_extra_source', 'true' ) == 'true' ){
        $body .= esc_html__( 'Resource: ', 'ova-crs' );
        $resource = $data['ovacrs_resource_checkboxs'] != '' ? implode(', ', $data['ovacrs_resource_checkboxs']) : '';
        $body .= $resource.'<br/>';
    }
    

    if( get_theme_mod( 'rd_rbf_show_extra_info', 'true' ) == 'true' ){
        $body .= esc_html__( 'Extra: ', 'ova-crs' ).$data['extra'].'<br/>';
    }

    $mail_to = array( get_option('admin_email'), $data['email'] );

    return ovacrs_ovacrs_sendmail( $mail_to, $subject, $body );

}


function ova_wp_mail_from(){
    return get_option('admin_email');
}

function ova_wp_mail_from_name(){
    return esc_html__("Request For Booking", 'ova-crs');
}

function ovacrs_ovacrs_sendmail( $mail_to, $subject, $body ){

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=".get_bloginfo( 'charset' )."\r\n";
    
    add_filter( 'wp_mail_from', 'ova_wp_mail_from' );
    add_filter( 'wp_mail_from_name', 'ova_wp_mail_from_name' );


    if( wp_mail($mail_to, $subject, $body, $headers ) ){
        $result = true;
    }else{
        $result = false;
    }

    remove_filter( 'wp_mail_from', 'ova_wp_mail_from');
    remove_filter( 'wp_mail_from_name', 'ova_wp_mail_from_name' );

    return $result;
}



/* Select html Category Rental */
function ovacrs_cat_rental( $selected, $required, $exclude_id ){
    $args = array(
        'show_option_all'    => '',
        'show_option_none'   => esc_html__( 'All Categories', 'ova-crs' ),
        'option_none_value'  => '',
        'orderby'            => 'ID',
        'order'              => 'ASC',
        'show_count'         => 0,
        'hide_empty'         => 0,
        'child_of'           => 0,
        'exclude'            => $exclude_id,
        'include'            => '',
        'echo'               => 0,
        'selected'           => $selected,
        'hierarchical'       => 1,
        'name'               => 'cat',
        'id'                 => '',
        'class'              => 'postform '.$required,
        'depth'              => 0,
        'tab_index'          => 0,
        'taxonomy'           => 'product_cat',
        'hide_if_empty'      => false,
        'value_field'        => 'slug',
    );
   
   return wp_dropdown_categories($args);
}


function ovacrs_type_rental( $selected, $required, $exclude_id ){
    $args = array(
        'show_option_all'    => '',
        'show_option_none'   => esc_html__( 'All Type', 'ova-crs' ),
        'option_none_value'  => '',
        'orderby'            => 'ID',
        'order'              => 'ASC',
        'show_count'         => 0,
        'hide_empty'         => 0,
        'child_of'           => 0,
        'exclude'            => $exclude_id,
        'include'            => '',
        'echo'               => 0,
        'selected'           => $selected,
        'hierarchical'       => 1,
        'name'               => 'product_type',
        'id'                 => '',
        'class'              => 'postform '.$required,
        'depth'              => 0,
        'tab_index'          => 0,
        'taxonomy'           => 'type',
        'hide_if_empty'      => false,
        'value_field'        => 'slug',
    );
   
   return wp_dropdown_categories($args);
}



function ovacrs_pagination_theme($ovacrs_query = null) {
    

    echo $ovacrs_query->max_num_pages.'x';

    /** Stop execution if there's only 1 page */
    if($ovacrs_query != null){
        if( $ovacrs_query->max_num_pages <= 1 )
        return; 
    }else if( $wp_query->max_num_pages <= 1 )
        return;



    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;


    

    if($ovacrs_query!=null){
        $max   = intval( $ovacrs_query->max_num_pages );
    }else{
        $max   = intval( $wp_query->max_num_pages );    
    }
    

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }


    echo '<nav class="woocommerce-pagination"><ul class="page-numbers">' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li class="prev page-numbers">%s</li>' . "\n", get_previous_posts_link('<i class="arrow_carrot-left"></i>') );

    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="current"' : 'page-numbers';

        printf( '<li><a href="%s" %s>%s</a></li>' . "\n",  esc_url( get_pagenum_link( 1 ) ), $class, '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>...</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="current"' : '';
        printf( '<li><a href="%s" %s>%s</a></li>' . "\n",  esc_url( get_pagenum_link( $link ) ), $class, $link );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>...</li>' . "\n";

        $class = $paged == $max ? ' class="current"' : '';
        printf( '<li><a href="%s" %s>%s</a></li>' . "\n",  esc_url( get_pagenum_link( $max ) ), $class, $max );
    }

    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li class="next page-numbers">%s</li>' . "\n", get_next_posts_link('<i class="arrow_carrot-right"></i>') );

    echo '</ul></nav>' . "\n";

}






