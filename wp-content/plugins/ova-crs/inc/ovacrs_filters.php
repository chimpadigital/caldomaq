<?php if ( !defined( 'ABSPATH' ) ) exit();


add_filter( 'woocommerce_display_item_meta', 'ovacrs_filter_woocommerce_display_item_meta', 10, 3 ); 
function ovacrs_filter_woocommerce_display_item_meta( $html, $item, $args ) { 
    
    $html = str_replace('ovacrs_pickup_loc', esc_html__(' Pick-up Location ', 'ova-crs') , $html );
	$html = str_replace('ovacrs_pickoff_loc', esc_html__(' Drop-off Location ', 'ova-crs') , $html );
	$html = str_replace('ovacrs_pickup_date', esc_html__(' Pick-up date ', 'ova-crs') , $html );
	$html = str_replace('ovacrs_pickoff_date', esc_html__(' Drop-off date ', 'ova-crs') , $html );
    $html = str_replace('ovacrs_total_days', esc_html__(' Total Days ', 'ova-crs') , $html );
    $html = str_replace('ovacrs_price_detail', esc_html__(' Price Detail ', 'ova-crs') , $html );
    
	return $html;
}; 
         




function ovacrs_text_time( $price_type, $rent_time ){
	if( $price_type == 'day' ){
		$text = esc_html__( 'Day(s)', 'ova-crs' );
	}else if( $price_type == 'hour' ){
		$text = esc_html__( 'Hour(s)', 'ova-crs' );
	}else if( $price_type == 'mixed' && $rent_time['rent_time_day_raw'] < 1){
		$text = esc_html__( 'Hour(s)', 'ova-crs' );
	}else if( $price_type == 'mixed' && $rent_time['rent_time_day_raw'] >= 1){
		$text = esc_html__( 'Day(s)', 'ova-crs' );
	}
	return $text;
}

function ovacrs_text_time_gl( $price_type, $rent_time ){
	if( $price_type == 'day' ){
		$text = esc_html__( 'Regular Day(s)', 'ova-crs' );
	}else if( $price_type == 'hour' ){
		$text = esc_html__( 'Regular Hour(s)', 'ova-crs' );
	}else if( $price_type == 'mixed' && $rent_time['rent_time_day_raw'] < 1){
		$text = esc_html__( 'Regular Hour(s)', 'ova-crs' );
	}else if( $price_type == 'mixed' && $rent_time['rent_time_day_raw'] >= 1){
		$text = esc_html__( 'Regular Day(s)', 'ova-crs' );
	}
	return $text;
}

function ovacrs_text_time_rt( $price_type, $rent_time ){
	if( $price_type == 'day' ){
		$text = esc_html__( 'Special Day(s)', 'ova-crs' );
	}else if( $price_type == 'hour' ){
		$text = esc_html__( 'Special Hour(s)', 'ova-crs' );
	}else if( $price_type == 'mixed' && $rent_time['rent_time_day_raw'] < 1){
		$text = esc_html__( 'Special Hour(s)', 'ova-crs' );
	}else if( $price_type == 'mixed' && $rent_time['rent_time_day_raw'] >= 1){
		$text = esc_html__( 'Special Day(s)', 'ova-crs' );
	}
	return $text;
}


// Get Real Quantity 
function get_real_quantity( $product_quantity, $product_id, $ovacrs_pickup_date, $ovacrs_pickoff_date  ){
        
        $rent_time = get_time_bew_2day( $ovacrs_pickup_date, $ovacrs_pickoff_date );
        $price_type = get_post_meta( $product_id, 'ovacrs_price_type', true );

        /* Global */
        $gl_quantity = ovacrs_quantity_global( $product_id, $rent_time );
        $product_quantity = $gl_quantity.' '.ovacrs_text_time( $price_type , $rent_time);
        

        // Display for case: PickUp/PickOff in Special Time
        $ovacrs_rt_startdate = get_post_meta( $product_id, 'ovacrs_rt_startdate', true );
        $ovacrs_rt_enddate = get_post_meta( $product_id, 'ovacrs_rt_enddate', true );
        
        

        if( $ovacrs_rt_startdate ){
            foreach ($ovacrs_rt_startdate as $key_rt => $value_rt) {

                // If Special_Time_Start_Date <= pickup_date && pickoff_date <= Special_Time_End_Date
                if( $ovacrs_pickup_date >= strtotime( $ovacrs_rt_startdate[$key_rt] ) && $ovacrs_pickoff_date <= strtotime( $ovacrs_rt_enddate[$key_rt] ) ){

                    $rt_quantity = ovacrs_quantity_global( $product_id, $rent_time );
                    $product_quantity = $rt_quantity.' '.ovacrs_text_time_rt( $price_type, $rent_time );

                }elseif( $ovacrs_pickup_date < strtotime( $ovacrs_rt_startdate[$key_rt] ) && $ovacrs_pickoff_date <= strtotime( $ovacrs_rt_enddate[$key_rt] ) && $ovacrs_pickoff_date >= strtotime( $ovacrs_rt_startdate[$key_rt] ) ){
                    
                    $gl_quantity_array = get_time_bew_2day( $ovacrs_pickup_date, strtotime( $ovacrs_rt_startdate[$key_rt] ) );
                    $gl_quantity = ovacrs_quantity_global( $product_id, $gl_quantity_array );

                    $rt_quantity_array = get_time_bew_2day( strtotime( $ovacrs_rt_startdate[$key_rt] ), $ovacrs_pickoff_date );
                    $rt_quantity = ovacrs_quantity_global( $product_id, $rt_quantity_array );
                    
                    $product_quantity = $gl_quantity.' '.ovacrs_text_time_gl( $price_type , $rent_time).'<br/>'.$rt_quantity.' '.ovacrs_text_time_rt( $price_type , $rent_time);

                }else if( $ovacrs_pickup_date >= strtotime( $ovacrs_rt_startdate[$key_rt] ) && $ovacrs_pickup_date <= strtotime( $ovacrs_rt_enddate[$key_rt] ) && $ovacrs_pickoff_date >= strtotime( $ovacrs_rt_enddate[$key_rt] ) ){

                    $rt_quantity_array = get_time_bew_2day( $ovacrs_pickup_date, strtotime( $ovacrs_rt_enddate[$key_rt] ) );
                    $rt_quantity = ovacrs_quantity_global( $product_id, $rt_quantity_array );

                    $gl_quantity_array = get_time_bew_2day( strtotime( $ovacrs_rt_enddate[$key_rt] ), $ovacrs_pickoff_date );
                    $gl_quantity = ovacrs_quantity_global( $product_id, $gl_quantity_array );

                    $product_quantity = $gl_quantity.' '.ovacrs_text_time_gl( $price_type, $rent_time ).'<br/> '.$rt_quantity.' '.ovacrs_text_time_rt( $price_type, $rent_time );

                }else if( $ovacrs_pickup_date < strtotime( $ovacrs_rt_startdate[$key_rt] ) && $ovacrs_pickoff_date > strtotime( $ovacrs_rt_enddate[$key_rt] ) ){

                    // Time section 1
                    $gl_rent_time_1 = get_time_bew_2day( $ovacrs_pickup_date, strtotime( $ovacrs_rt_startdate[$key_rt] ) );
                    $gl_quantity_1 = ovacrs_quantity_global( $product_id, $gl_rent_time_1 );

                    $gl_rent_time_3 = get_time_bew_2day( strtotime( $ovacrs_rt_enddate[$key_rt] ), $ovacrs_pickoff_date );
                    $gl_quantity_3 = ovacrs_quantity_global( $product_id, $gl_rent_time_3 );

                    $rt_rent_time_2 = get_time_bew_2day( strtotime( $ovacrs_rt_startdate[$key_rt] ), strtotime( $ovacrs_rt_enddate[$key_rt] ) );
                    $rt_quantity_2 = ovacrs_quantity_global( $product_id, $rt_rent_time_2 );

                    $gl_quantity = $gl_quantity_1 + $gl_quantity_3;

                    $product_quantity = $rt_quantity_2.' '.ovacrs_text_time_rt( $price_type, $rent_time ).'<br/> '.$gl_quantity.' '.ovacrs_text_time_gl( $price_type, $rent_time );

                }

            }
        }

    return $product_quantity; 
}


// Get Real Price
function get_real_price( $product_price, $product_id, $ovacrs_pickup_date, $ovacrs_pickoff_date ){
        
        $rent_time = get_time_bew_2day( $ovacrs_pickup_date, $ovacrs_pickoff_date );
        $price_type = get_post_meta( $product_id, 'ovacrs_price_type', true );
        
        $ovacrs_rt_startdate = get_post_meta( $product_id, 'ovacrs_rt_startdate', true );
        $ovacrs_rt_enddate = get_post_meta( $product_id, 'ovacrs_rt_enddate', true );


        // Global
        $gl_price = ovacrs_price_global( $product_id, $rent_time );
        $product_price = wc_price( $gl_price );
        

        if( $ovacrs_rt_startdate ){
            foreach ($ovacrs_rt_startdate as $key_rt => $value_rt) {

                // If Special_Time_Start_Date <= pickup_date && pickoff_date <= Special_Time_End_Date
                if( $ovacrs_pickup_date >= strtotime( $ovacrs_rt_startdate[$key_rt] ) && $ovacrs_pickoff_date <= strtotime( $ovacrs_rt_enddate[$key_rt] ) ){

                    $rt_price = ovacrs_price_special_time( $product_id, $rent_time, $key_rt );

                    $product_price = wc_price( $rt_price ).' '.ovacrs_text_time_rt( $price_type, $rent_time );

                    break;
                
                }else if( $ovacrs_pickup_date < strtotime( $ovacrs_rt_startdate[$key_rt] ) && $ovacrs_pickoff_date <= strtotime( $ovacrs_rt_enddate[$key_rt] ) && $ovacrs_pickoff_date >= strtotime( $ovacrs_rt_startdate[$key_rt] ) ){
                    
                    
                    $gl_quantity_array = get_time_bew_2day( $ovacrs_pickup_date, strtotime( $ovacrs_rt_startdate[$key_rt] ) );
                    $gl_price = ovacrs_price_global( $product_id, $gl_quantity_array );

                    $rt_quantity_array = get_time_bew_2day( strtotime( $ovacrs_rt_startdate[$key_rt] ), $ovacrs_pickoff_date );
                    $rt_price = ovacrs_price_special_time( $product_id, $rt_quantity_array, $key_rt );

                    $product_price = wc_price( $gl_price ).' '.ovacrs_text_time_gl( $price_type, $rent_time ).'<br/>'.wc_price( $rt_price ).' '.ovacrs_text_time_rt( $price_type, $rent_time );

                    break;
                    

                }else if( $ovacrs_pickup_date >= strtotime( $ovacrs_rt_startdate[$key_rt] ) && $ovacrs_pickup_date <= strtotime( $ovacrs_rt_enddate[$key_rt] ) && $ovacrs_pickoff_date >= strtotime( $ovacrs_rt_enddate[$key_rt] ) ){

                    
                    $rt_quantity_array = get_time_bew_2day( $ovacrs_pickup_date, strtotime( $ovacrs_rt_enddate[$key_rt] ) );
                    $rt_price = ovacrs_price_special_time( $product_id, $rt_quantity_array, $key_rt );
                    

                    $gl_quantity_array = get_time_bew_2day( strtotime( $ovacrs_rt_enddate[$key_rt] ), $ovacrs_pickoff_date );
                    $gl_price = ovacrs_price_global( $product_id, $gl_quantity_array );
                    
                    
                    $product_price = wc_price( $gl_price ).' '.ovacrs_text_time_gl( $price_type, $rent_time ).'<br/>'.wc_price( $rt_price ).' '.ovacrs_text_time_rt( $price_type, $rent_time );

                    break;

                }else if( $ovacrs_pickup_date < strtotime( $ovacrs_rt_startdate[$key_rt] ) && $ovacrs_pickoff_date > strtotime( $ovacrs_rt_enddate[$key_rt] ) ){

                    // Time section 1
                    $gl_quantity_array = get_time_bew_2day( $ovacrs_pickup_date, strtotime( $ovacrs_rt_startdate[$key_rt] ) );
                    $gl_price = ovacrs_price_global( $product_id, $gl_quantity_array );


                    $rent_time_2 = get_time_bew_2day( strtotime( $ovacrs_rt_startdate[$key_rt] ), strtotime( $ovacrs_rt_enddate[$key_rt] ) );
                    $rt_price = ovacrs_price_special_time( $product_id, $rent_time_2, $key_rt );

                    $product_price = wc_price( $rt_price ).' '.ovacrs_text_time_rt( $price_type, $rent_time ).'<br/>'.wc_price( $gl_price ).' '.ovacrs_text_time_gl( $price_type, $rent_time );

                    break;

                }

            }
        }
        
    
    

    return $product_price; 
}


// Filter Quantity for Cart

add_filter( 'woocommerce_widget_cart_item_quantity', 'ovacrs_woocommerce_widget_cart_item_quantity', 10, 3 );
function ovacrs_woocommerce_widget_cart_item_quantity( $product_quantity,  $cart_item, $cart_item_key ) {

    if( $cart_item['data']->is_type('ovacrs_car_rental') ){
        
        $product_id = $cart_item['product_id'];
        $ovacrs_pickup_date = strtotime( $cart_item['ovacrs_pickup_date'] );
        $ovacrs_pickoff_date = strtotime( $cart_item['ovacrs_pickoff_date'] );

        return '× '.get_real_quantity( $product_quantity, $product_id, $ovacrs_pickup_date, $ovacrs_pickoff_date );     

    }else{

        return $product_quantity;

    }
    
}; 


add_filter( 'woocommerce_cart_item_quantity', 'ovacrs_filter_woocommerce_cart_item_quantity', 10, 3 ); 
function ovacrs_filter_woocommerce_cart_item_quantity( $product_quantity, $cart_item_key, $cart_item ) {

    if( $cart_item['data']->is_type('ovacrs_car_rental') ){
        
        $product_id = $cart_item['product_id'];
        $ovacrs_pickup_date = strtotime( $cart_item['ovacrs_pickup_date'] );
        $ovacrs_pickoff_date = strtotime( $cart_item['ovacrs_pickoff_date'] );

        return get_real_quantity( $product_quantity, $product_id, $ovacrs_pickup_date, $ovacrs_pickoff_date );     

    }else{

        return $product_quantity;

    }
    
}; 




// Filter Quantity for Checkout
add_filter( 'woocommerce_checkout_cart_item_quantity', 'ovacrs_woocommerce_checkout_cart_item_quantity', 10, 3 );
function ovacrs_woocommerce_checkout_cart_item_quantity( $product_quantity, $cart_item, $cart_item_key ){

    if( $cart_item['data']->is_type('ovacrs_car_rental') ){
        
        $product_id = $cart_item['product_id'];
        $ovacrs_pickup_date = strtotime( $cart_item['ovacrs_pickup_date'] );
        $ovacrs_pickoff_date = strtotime( $cart_item['ovacrs_pickoff_date'] );

        return '<span class="ovacrs_qty">'.get_real_quantity( $product_quantity, $product_id, $ovacrs_pickup_date, $ovacrs_pickoff_date ).'</span>';     

    }else{

        return $product_quantity;

    }

}



// Filter Price for Cart
add_filter( 'woocommerce_cart_item_price', 'ovacrs_filter_woocommerce_cart_item_price', 10, 3 ); 
function ovacrs_filter_woocommerce_cart_item_price( $product_price, $cart_item, $cart_item_key ) {

    if( $cart_item['data']->is_type('ovacrs_car_rental') ){
        
        $product_id = $cart_item['product_id'];
        $ovacrs_pickup_date = strtotime( $cart_item['ovacrs_pickup_date'] );
        $ovacrs_pickoff_date = strtotime( $cart_item['ovacrs_pickoff_date'] );

        return get_real_price( $product_price, $product_id, $ovacrs_pickup_date, $ovacrs_pickoff_date );
    }else{
        return $product_price;
    }
    

}

// Filter Quantity for Order detail after checkout
add_filter( 'woocommerce_order_item_quantity_html', 'ovacrs_woocommerce_order_item_quantity_html', 10, 2 ); 
function ovacrs_woocommerce_order_item_quantity_html( $quantity, $item ){
    
    $product_id = $item->get_product_id();
    $product = wc_get_product( $product_id );

    if( $product->is_type( 'ovacrs_car_rental' ) ){

        foreach ( $item->get_formatted_meta_data() as $meta_id => $meta ) {
            if( $meta->key == 'ovacrs_pickup_date' ){
                $ovacrs_pickup_date = strtotime( $meta->value ) ;
            }
            if( $meta->key == 'ovacrs_pickoff_date' ){
                $ovacrs_pickoff_date = strtotime( $meta->value );
            }
        }

        return '<span class="ovacrs_qty">'.get_real_quantity( $quantity, $product_id, $ovacrs_pickup_date, $ovacrs_pickoff_date ).'</span>';
    }

    return $quantity;
    
}



add_filter( 'woocommerce_order_item_display_meta_key', 'ovacrs_change_order_item_meta_title', 20, 3 );

/**
 * Changing a meta title
 * @param  string        $key  The meta key
 * @param  WC_Meta_Data  $meta The meta object
 * @param  WC_Order_Item $item The order item object
 * @return string        The title
 */
function ovacrs_change_order_item_meta_title( $key, $meta, $item ) {
    
    // By using $meta-key we are sure we have the correct one.
    if ( 'ovacrs_pickup_loc' === $meta->key ) { $key = esc_html__(' Pick-up Location ', 'ova-crs'); }
    if ( 'ovacrs_pickoff_loc' === $meta->key ) { $key = esc_html__(' Drop-off Location ', 'ova-crs'); }
    if ( 'ovacrs_pickup_date' === $meta->key ) { $key = esc_html__(' Pick-up date ', 'ova-crs'); }
    if ( 'ovacrs_pickoff_date' === $meta->key ) { $key = esc_html__(' Drop-off date ', 'ova-crs'); }
    if ( 'ovacrs_total_days' === $meta->key ) { $key = esc_html__(' Total Days ', 'ova-crs'); }
    if ( 'ovacrs_price_detail' === $meta->key ) { $key = esc_html__(' Price Detail ', 'ova-crs'); }
    if ( 'id_vehicle' === $meta->key ) { $key = esc_html__(' ID Vehicle ', 'ova-crs'); }
    
     
    return $key;
}

add_filter( 'woocommerce_order_item_display_meta_value', 'change_order_item_meta_value', 20, 3 );

/**
 * Changing a meta value
 * @param  string        $value  The meta value
 * @param  WC_Meta_Data  $meta   The meta object
 * @param  WC_Order_Item $item   The order item object
 * @return string        The title
 */
function change_order_item_meta_value( $value, $meta, $item ) {
    
    // By using $meta-key we are sure we have the correct one.
    if ( 'ovacrs_pickup_loc' === $meta->key ) { $key = esc_html__(' Pick-up Location ', 'ova-crs'); }
    if ( 'ovacrs_pickoff_loc' === $meta->key ) { $key = esc_html__(' Drop-off Location ', 'ova-crs'); }
    if ( 'ovacrs_pickup_date' === $meta->key ) { $key = esc_html__(' Pick-up date ', 'ova-crs'); }
    if ( 'ovacrs_pickoff_date' === $meta->key ) { $key = esc_html__(' Drop-off date ', 'ova-crs'); }
    if ( 'ovacrs_total_days' === $meta->key ) { $key = esc_html__(' Total Days ', 'ova-crs'); }
    if ( 'ovacrs_price_detail' === $meta->key ) { $key = esc_html__(' Price Detail ', 'ova-crs'); }
    if ( 'id_vehicle' === $meta->key ) { $key = esc_html__(' ID Vehicle ', 'ova-crs'); }
     
    return $value;
}


