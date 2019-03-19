<?php
defined( 'ABSPATH' ) || exit();

// Validate Rent Day Min
if ( ! function_exists( 'ovacrs_val_day_min' ) ) {
    function ovacrs_val_day_min( $ovacrs_pickoff_date, $ovacrs_pickup_date, $ovacrs_rent_day_min ){
        return ( $ovacrs_pickoff_date - $ovacrs_pickup_date ) < $ovacrs_rent_day_min*24*60*60 ? true : false;
    }
}

// Validate Rent Hour Min
if ( ! function_exists( 'ovacrs_val_hour_min' ) ) {
    function ovacrs_val_hour_min( $ovacrs_pickoff_date, $ovacrs_pickup_date, $ovacrs_rent_hour_min ){
        return ( $ovacrs_pickoff_date - $ovacrs_pickup_date ) < $ovacrs_rent_hour_min*60*60 ? true : false;
    }
}


// Get Order ID include Product ID
function ovacrs_get_orders_ids_by_product_id( $product_id, $order_status = array( 'wc-completed' ) ){
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

    return array_unique( $results );
}


// 0: Validate Booking Form And Rent Time
add_filter( 'woocommerce_add_to_cart_validation', 'ovacrs_validation_booking_form', 10, 5 );      
function ovacrs_validation_booking_form( $passed ) {

    // Check product type is ovacrs_car_rental
    $custom_product_type = filter_input( INPUT_POST, 'custom_product_type' );
    if( $custom_product_type != 'ovacrs_car_rental' ) return true;
    

    // Get Value From Booking Form
    $ovacrs_pickup_loc = trim( filter_input( INPUT_POST, 'ovacrs_pickup_loc' ) );
    $ovacrs_pickoff_loc = trim( filter_input( INPUT_POST, 'ovacrs_pickoff_loc' ) );
    $ovacrs_pickup_date = strtotime( filter_input( INPUT_POST, 'ovacrs_pickup_date' ) );
    $ovacrs_pickoff_date = strtotime( filter_input( INPUT_POST, 'ovacrs_pickoff_date' ) );
    $car_id = filter_input( INPUT_POST, 'car_id' );


    // Total Car in the Store
    $total_car_store = get_post_meta( $car_id, 'ovacrs_car_count', true );

    // Check Price Type
    $price_type = get_post_meta( $car_id, 'ovacrs_price_type', true );

    // Rent day min
    $ovacrs_rent_day_min = (int)get_post_meta( $car_id, 'ovacrs_rent_day_min', true );

    // Rent hour min
    $ovacrs_rent_hour_min = (int)get_post_meta( $car_id, 'ovacrs_rent_hour_min', true );


    // Error: Empty fields
    if( get_theme_mod( 'rd_bf_show_pickup_loc', 'true' ) == 'true' && empty( $ovacrs_pickup_loc ) ) {
        wc_clear_notices();
        echo wc_add_notice( __("Insert PickUp Location", 'ova-crs'), 'error');
        $passed = false;
    }

    if( get_theme_mod( 'rd_bf_show_pickoff_loc', 'true' ) == 'true' && empty( $ovacrs_pickoff_loc ) ) {
        wc_clear_notices();
        echo wc_add_notice( __("Insert PickOff Location", 'ova-crs'), 'error');
        $passed = false;
    }

    if ( empty( $ovacrs_pickup_date ) || empty( $ovacrs_pickoff_date ) ) {
        wc_clear_notices();
        echo wc_add_notice( __("Insert PickUp, PickOff date", 'ova-crs'), 'error');
        $passed = false;
    }

    // Error Pick Up Date > Pick Off Date
    if( $ovacrs_pickup_date >  $ovacrs_pickoff_date){
        wc_clear_notices();
        echo wc_add_notice( __("Pick-up Date must be greater than Drop-off Date", 'ova-crs'), 'error');
        $passed = false;
    }

    // Error Pick Up Date < Current Time
    if( $ovacrs_pickup_date < current_time('timestamp') ){
        wc_clear_notices();
        echo wc_add_notice( __("Pick-up Date must be greater than Current Time", 'ova-crs'), 'error');   
        $passed = false;
    }

    // Error Rent Time Min
    switch ($price_type) {
        case 'day':
            if( ovacrs_val_day_min( $ovacrs_pickoff_date, $ovacrs_pickup_date, $ovacrs_rent_day_min ) ){
                wc_clear_notices();
                echo wc_add_notice( sprintf( esc_html__( 'Rent Day Min: %d day', 'ova-crs' ), $ovacrs_rent_day_min ), 'error');   
                $passed = false;
            }
            break;

        case 'hour':
            if( ovacrs_val_hour_min( $ovacrs_pickoff_date, $ovacrs_pickup_date, $ovacrs_rent_hour_min ) ){
                wc_clear_notices();
                echo wc_add_notice( sprintf( esc_html__( 'Rent Hour Min %d hour', 'ova-crs' ), $ovacrs_rent_hour_min ), 'error');   
                $passed = false;
            }
            break;

        default:
            if( ovacrs_val_hour_min( $ovacrs_pickoff_date, $ovacrs_pickup_date, $ovacrs_rent_hour_min ) ){
                wc_clear_notices();
                echo wc_add_notice( sprintf( esc_html__( 'Rent Hour Min %d hour', 'ova-crs' ), $ovacrs_rent_hour_min ), 'error');   
                $passed = false;
            }
            break;
    }

    // Error: Unvailable time for renting
    $ovacrs_untime_startdate = get_post_meta( $car_id, 'ovacrs_untime_startdate', true );
    $ovacrs_untime_enddate = get_post_meta( $car_id, 'ovacrs_untime_enddate', true );
    if( $ovacrs_untime_startdate ){
        foreach ($ovacrs_untime_startdate as $key => $value) {
            if( ! ($ovacrs_pickoff_date < strtotime( $ovacrs_untime_startdate[$key] ) || strtotime( $ovacrs_untime_enddate[$key] ) < $ovacrs_pickup_date ) ){
                wc_clear_notices();
                echo wc_add_notice( esc_html__( 'This time is not available for renting', 'ova-crs' ), 'error');
                $passed = false;
                break;
            }
        }
    }
    


    // Compare Rent Day with database
    // Set the orders statuses
    $statuses = array( 'wc-completed', 'wc-processing', 'wc-on-hold' );
    $orders_ids = ovacrs_get_orders_ids_by_product_id( $car_id, $statuses );
    
    $car_in_store = get_post_meta( $car_id, 'ovacrs_car_count', true ); /* Get total car in store */
    $car_using_this_time = 0; /* Count car is using in time need to rent  */
    $cart_vehicle_rented_array = $store_vehicle_rented_array = array();
    $store_vehicle_rented_count = $cart_vehicle_rented_count = 0;

    



    // For Order ID
    foreach ($orders_ids as $key => $value) {
        
        // Get Order Detail by Order ID
        $order = wc_get_order($value);

        // Get Meta Data type line_item of Order
        $order_line_items = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
        

        // For Meta Data
        foreach ( $order_line_items as $item_id => $item ) {
            
            $ovacrs_pickup_date_store = $ovacrs_pickoff_date_store = $id_vehicle_rented = '';
            

            // Check Line Item have item ID is Car_ID
            if( $item->get_product_id() == $car_id ){

                // Get value of pickup date, pickoff date
                foreach ( $item->get_formatted_meta_data() as $meta_id => $meta ) {
                    if( $meta->key == 'ovacrs_pickup_date' ){
                        $ovacrs_pickup_date_store = strtotime( str_replace('/', '-', $meta->value) );
                    }
                    if( $meta->key == 'ovacrs_pickoff_date' ){
                        $ovacrs_pickoff_date_store = strtotime( str_replace('/', '-', $meta->value) );
                    }

                    if( $meta->key == 'id_vehicle' ){
                        $id_vehicle_rented = trim( $meta->value );
                    }

                }
                

                // Only compare date when "PickOff Date in Store" > "Current Time" becaue "PickOff Date Rent" have to > "Current Time"
                if( $ovacrs_pickoff_date_store >= current_time( 'timestamp' ) ){
                    if( ! ($ovacrs_pickoff_date <= $ovacrs_pickup_date_store || $ovacrs_pickoff_date_store <= $ovacrs_pickup_date ) ){
                        if( $id_vehicle_rented != '' ){
                            array_push( $store_vehicle_rented_array, $id_vehicle_rented );    
                        }
                        
                    }
                }
                
            }

        } 

    }

    if( $store_vehicle_rented_array != null ){
        $store_vehicle_rented_array = array_unique( $store_vehicle_rented_array );
        $store_vehicle_rented_count = count( $store_vehicle_rented_array );    
    }

    
    


    // Check Count car in Cart current
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
        if( $product_id == $car_id && !( $ovacrs_pickoff_date <= strtotime( $cart_item['ovacrs_pickup_date'] )  || strtotime( $cart_item['ovacrs_pickoff_date'] ) <= $ovacrs_pickup_date ) ){
            if( $cart_item['id_vehicle'] != ''  ){
                array_push( $cart_vehicle_rented_array, $cart_item['id_vehicle'] );    
            }
            
        }
    }
    if( $cart_vehicle_rented_array != null ){
        $cart_vehicle_rented_array = array_unique( $cart_vehicle_rented_array );
        $cart_vehicle_rented_count = count( $cart_vehicle_rented_array );
    }


    $id_rented = array_unique( array_merge( $store_vehicle_rented_array, $cart_vehicle_rented_array ) );

    
    if( count( $id_rented ) >= $total_car_store ){
        wc_clear_notices();
        echo wc_add_notice( esc_html__( 'Vehicle is unavailable for this time, Please book other time.', 'ova-crs' ), 'error');   
        $passed = false;
    }


    

    // Set id_vehicle_available
    if( !is_admin() ){
        
        $ovacrs_id_vehicles = is_array( get_post_meta( $car_id, 'ovacrs_id_vehicles', true ) ) ? get_post_meta( $car_id, 'ovacrs_id_vehicles', true ) : array();
        
        $id_vehicle_available = array_diff( $ovacrs_id_vehicles, $id_rented );
        


        $vehicle_avai = $id_vehicle_ok = '';
        $vehicle_avai_flag = false;
        $vehicle_untime_flag = true;

        if( get_theme_mod( 'use_loc_filter', 'true' ) == 'true' ){

            foreach ($id_vehicle_available as $key => $value) {

                $vehicle_avai = ovacrs_get_vehicle_loc_title($value);

                $id_vehicle_untime_startday = !empty( $vehicle_avai['untime'] ) ? strtotime( $vehicle_avai['untime']['startdate'] ) : '';
                $id_vehicle_untime_enddate  = !empty( $vehicle_avai['untime'] ) ? strtotime( $vehicle_avai['untime']['enddate'] ) : '';

                
                // Location is ok
                if( $ovacrs_pickup_loc == $vehicle_avai['loc'] ){

                    // Vehicle with Untime
                    if( ! ( $ovacrs_pickoff_date < $id_vehicle_untime_startday  ||  $id_vehicle_untime_enddate < $ovacrs_pickup_date  ) && $id_vehicle_untime_startday != '' && $id_vehicle_untime_enddate != '' ){
                        $vehicle_avai_flag = true;
                        $vehicle_untime_flag = false;
                    }else{
                        $vehicle_avai_flag = true;
                        $vehicle_untime_flag = true;
                        $id_vehicle_ok = $value;
                        break;    
                    }

                }

            }

            if( !$vehicle_untime_flag ){
                wc_clear_notices();
                echo wc_add_notice( esc_html__( 'This Vehicle is unavailable this time', 'ova-crs' ), 'error');   
                $passed = false;
            }elseif( $vehicle_avai_flag && $vehicle_untime_flag ){
                WC()->session->set( 'id_vehicle_available' , trim( $id_vehicle_ok ) );
            }else{
                wc_clear_notices();
                echo wc_add_notice( esc_html__( 'This Vehicle is unavailable at Pick-up location.', 'ova-crs' ), 'error');   
                $passed = false;
            }
        }else{
            foreach ($id_vehicle_available as $key => $value) {

                $vehicle_avai = ovacrs_get_vehicle_loc_title($value);

                $id_vehicle_untime_startday = !empty( $vehicle_avai['untime'] ) ? strtotime( $vehicle_avai['untime']['startdate'] ) : '';
                $id_vehicle_untime_enddate  = !empty( $vehicle_avai['untime'] ) ? strtotime( $vehicle_avai['untime']['enddate'] ) : '';


                if( ! ( $ovacrs_pickoff_date < $id_vehicle_untime_startday  ||  $id_vehicle_untime_enddate < $ovacrs_pickup_date  ) && $id_vehicle_untime_startday != '' && $id_vehicle_untime_enddate != '' ){
                    $vehicle_untime_flag = false;
                }else{
                    $vehicle_untime_flag = true;
                    WC()->session->set( 'id_vehicle_available' , trim( $value ) );
                    break;   
                }

                 
            }

            if( !$vehicle_untime_flag ){
                wc_clear_notices();
                echo wc_add_notice( esc_html__( 'This Vehicle is unavailable this time', 'ova-crs' ), 'error');   
                $passed = false;
            }

        }
        

    }

    return $passed;
}



// 1: Add Extra Data To Cart Item

add_filter( 'woocommerce_add_cart_item_data', 'ovacrs_add_extra_data_to_cart_item', 1, 10 );
function ovacrs_add_extra_data_to_cart_item( $cart_item_data, $product_id, $variation_id ) {

    
    $ovacrs_pickup_loc = filter_input( INPUT_POST, 'ovacrs_pickup_loc' );
    $ovacrs_pickoff_loc = filter_input( INPUT_POST, 'ovacrs_pickoff_loc' );
    $ovacrs_pickup_date = filter_input( INPUT_POST, 'ovacrs_pickup_date' );
    $ovacrs_pickoff_date = filter_input( INPUT_POST, 'ovacrs_pickoff_date' );

    $ovacrs_resource_checkboxs = isset( $_POST['ovacrs_resource_checkboxs'] ) ? $_POST['ovacrs_resource_checkboxs'] : '';
    
    
    if ( empty( $ovacrs_pickup_loc ) && empty( $ovacrs_pickoff_loc ) && empty( $ovacrs_pickup_date ) && empty( $ovacrs_pickoff_date ) ) {
        return $cart_item_data;
    }
    
    if( get_theme_mod( 'rd_bf_show_pickup_loc', 'true' ) == 'true' ){
        $cart_item_data['ovacrs_pickup_loc'] = $ovacrs_pickup_loc;    
    }

    if( get_theme_mod( 'rd_bf_show_pickoff_loc', 'true' ) == 'true' ){
        $cart_item_data['ovacrs_pickoff_loc'] = $ovacrs_pickoff_loc;    
    }
    
    
    $cart_item_data['ovacrs_pickup_date'] = $ovacrs_pickup_date;
    $cart_item_data['ovacrs_pickoff_date'] = $ovacrs_pickoff_date;
    $cart_item_data['resources'] = $ovacrs_resource_checkboxs;

    $id_vehicle_available = '';
    if( WC()->session->__isset( 'id_vehicle_available' ) ){
        $id_vehicle_available = WC()->session->get( 'id_vehicle_available' );
        WC()->session->__unset( 'id_vehicle_available' );
    }

    $cart_item_data['id_vehicle'] = trim( $id_vehicle_available );
 
    return $cart_item_data;
}
 



// 2: Display Extra Data in the Cart
add_filter( 'woocommerce_get_item_data', 'ovacrs_display_extra_data_cart', 10, 2 );
function ovacrs_display_extra_data_cart( $item_data, $cart_item ) {

    if( !$cart_item['data']->is_type('ovacrs_car_rental') ) return $item_data;

    if ( empty( $cart_item['ovacrs_pickup_loc'] ) && empty( $cart_item['ovacrs_pickoff_loc'] ) && empty( $cart_item['ovacrs_pickup_date'] ) && empty( $cart_item['ovacrs_pickoff_date'] ) ) {
        wc_clear_notices();
        wc_add_notice( __("Insert full data in booking form"), 'notice');
        return false;
    }

    if( get_theme_mod( 'rd_bf_show_pickup_loc', 'true' ) == 'true' ){
        $item_data[] = array(
            'key'     => esc_html__( 'Pick-up Location', 'ova-crs' ),
            'value'   => wc_clean( $cart_item['ovacrs_pickup_loc'] ),
            'display' => '',
        );
    }

    if( get_theme_mod( 'rd_bf_show_pickoff_loc', 'true' ) == 'true' ){
        $item_data[] = array(
            'key'     => esc_html__( 'Drop-off Location', 'ova-crs' ),
            'value'   => wc_clean( $cart_item['ovacrs_pickoff_loc'] ),
            'display' => '',
        );
    }


    $item_data[] = array(
        'key'     => esc_html__( 'Pick-up Date', 'ova-crs' ),
        'value'   => wc_clean( $cart_item['ovacrs_pickup_date'] ),
        'display' => '',
    );

    $item_data[] = array(
        'key'     => esc_html__( 'Drop-off Date', 'ova-crs' ),
        'value'   => wc_clean( $cart_item['ovacrs_pickoff_date'] ),
        'display' => '',
    );

    if( $cart_item['resources'] ){
        foreach ($cart_item['resources'] as $key_re => $value_re) {
            $item_data[] = array(
                'key'     => esc_html__( 'Extra Resource', 'ova-crs' ),
                'value'   => wc_clean( $value_re ),
                'display' => '',
            );
        }    
    }


    $item_data[] = array(
        'key'     => esc_html__( 'Id Vehicle', 'ova-crs' ),
        'value'   => wc_clean( trim( $cart_item['id_vehicle'] ) ),
        'display' => '',
    );
    
    
 
    return $item_data;
}
 



// 3: Save to Order
add_action( 'woocommerce_checkout_create_order_line_item', 'ovacrs_add_extra_data_to_order_items', 10, 4 );
function ovacrs_add_extra_data_to_order_items( $item, $cart_item_key, $values, $order ) {

    if ( empty( $values['ovacrs_pickup_loc'] ) && empty( $values['ovacrs_pickoff_loc'] ) && empty( $values['ovacrs_pickup_date'] ) && empty( $values['ovacrs_pickoff_date'] ) ) {
        return;
    }

    if( get_theme_mod( 'rd_bf_show_pickup_loc', 'true' ) == 'true' ){
        $item->add_meta_data( 'ovacrs_pickup_loc', $values['ovacrs_pickup_loc'] );
    }
    if( get_theme_mod( 'rd_bf_show_pickoff_loc', 'true' ) == 'true' ){
        $item->add_meta_data( 'ovacrs_pickoff_loc', $values['ovacrs_pickoff_loc'] );
    }
    $item->add_meta_data( 'ovacrs_pickup_date', $values['ovacrs_pickup_date'] );
    $item->add_meta_data( 'ovacrs_pickoff_date', $values['ovacrs_pickoff_date'] );


    $product_id = $item->get_product_id();
    $real_quantity = get_real_quantity( 1, $product_id, strtotime( $values['ovacrs_pickup_date'] ), strtotime( $values['ovacrs_pickoff_date'] ) );
    $item->add_meta_data( 'ovacrs_total_days', $real_quantity );

    $real_price = get_real_price( 1, $product_id, strtotime( $values['ovacrs_pickup_date'] ), strtotime( $values['ovacrs_pickoff_date'] ) );
    $item->add_meta_data( 'ovacrs_price_detail', $real_price );

    if( $values['resources'] ){
        foreach ($values['resources'] as $key_re => $value_re) {
            $item->add_meta_data( esc_html__( 'Extra Resource: ', 'ova-crs' ), $value_re );
        }    
    }
    
    $item->add_meta_data( 'id_vehicle', trim( $values['id_vehicle'] ) );
}
 



