<?php 
defined( 'ABSPATH' ) || exit();
function set_price_by_global_discount($product_id, $ovacrs_global_discount_duration_val = array(), $price_type, $rent_time ){

     if( $ovacrs_global_discount_duration_val ){

        foreach ($ovacrs_global_discount_duration_val as $key_dur => $value_dur) {
           $ovacrs_global_discount_duration_type = get_post_meta( $product_id, 'ovacrs_global_discount_duration_type', true );
           if( $ovacrs_global_discount_duration_type[$key_dur] == $price_type && $rent_time >=  $value_dur){
                $ovacrs_global_discount_price = get_post_meta( $product_id, 'ovacrs_global_discount_price', true );
                return $ovacrs_global_discount_price[$key_dur];

           }
        }
    }

    return false;

}


function set_price_by_rt_discount( $ovacrs_rt_discount_duration_val = array(), $ovacrs_rt_discount_duration_type = array(), $ovacrs_rt_discount_duration_price = array(), $price_type, $rent_time ){
    
    if( $ovacrs_rt_discount_duration_val ){
        foreach ($ovacrs_rt_discount_duration_val as $key_dur => $value_dur) {
           if( $ovacrs_rt_discount_duration_type[$key_dur] == $price_type && $rent_time >=  $value_dur){
                return $ovacrs_rt_discount_duration_price[$key_dur];

           }
        }
    }

    return false;

}

// YOu have to insert unistamp time
function get_time_bew_2day( $start, $end ){

    $rent_time_day_raw = ( $end - $start )/(24*60*60);
    $rent_time_hour_raw = ( $end - $start )/(60*60);
    $rent_time_day = ceil( $rent_time_day_raw );
    $rent_time_hour = ceil ( $rent_time_hour_raw );

    return array( 'rent_time_day_raw' => $rent_time_day_raw, 'rent_time_hour_raw' => $rent_time_hour_raw, 'rent_time_day' => $rent_time_day, 'rent_time_hour' => $rent_time_hour );
    
}


// Quantity in Global
function ovacrs_quantity_global( $product_id, $rent_time ){
    
    $price_type = get_post_meta( $product_id, 'ovacrs_price_type', true );
    if( $price_type == 'day' ){
        return (int)$rent_time['rent_time_day'];
    }else if( $price_type == 'hour' ){
        return (int)$rent_time['rent_time_hour'];
    }else{
        if( $rent_time['rent_time_day_raw'] < 1 ){
            return (int)$rent_time['rent_time_hour'];
        }else{
            return (int)$rent_time['rent_time_day'];
        }
    }
}

// Price in Global
function ovacrs_price_global( $product_id, $rent_time ){

    $price_type = get_post_meta( $product_id, 'ovacrs_price_type', true );

    $ovacrs_global_discount_duration_val = get_post_meta( $product_id, 'ovacrs_global_discount_duration_val', true );
    if( $ovacrs_global_discount_duration_val ){ arsort( $ovacrs_global_discount_duration_val ); }
    
    if( $price_type == 'day' ){

        // Set Price by Global Discount
        $gl_price = get_post_meta( $product_id, '_regular_price', true );
        if( $ovacrs_global_discount_duration_val ){
            $gl_set_price = set_price_by_global_discount( $product_id, $ovacrs_global_discount_duration_val, $price_type='days', $rent_time['rent_time_day'] );
            $gl_price = ( $gl_set_price != false ) ? $gl_set_price : $gl_price;
        }
        return $gl_price;

    }else if( $price_type == 'hour' ){

        $gl_price = get_post_meta( $product_id, 'ovacrs_regul_price_hour', true );

        if( $ovacrs_global_discount_duration_val ){
            $gl_set_price = set_price_by_global_discount( $product_id, $ovacrs_global_discount_duration_val, $price_type='hours', $rent_time['rent_time_hour'] );
            $gl_price = ( $gl_set_price != false ) ? $gl_set_price : $gl_price;
        }
        return $gl_price;

    }else{ // Price type is Mixed

        if( $rent_time['rent_time_day_raw'] < 1 ){

            $gl_price = get_post_meta( $product_id, 'ovacrs_regul_price_hour', true );
            if( $ovacrs_global_discount_duration_val ){
                $gl_set_price = set_price_by_global_discount( $product_id, $ovacrs_global_discount_duration_val, $price_type='hours', $rent_time['rent_time_hour'] );
                $gl_price = ( $gl_set_price != false ) ? $gl_set_price : $gl_price;
            }
            return $gl_price;

        }else{

            $gl_price = get_post_meta( $product_id, '_regular_price', true );

            if( $ovacrs_global_discount_duration_val ){
                $gl_set_price = set_price_by_global_discount( $product_id, $ovacrs_global_discount_duration_val, $price_type='days', $rent_time['rent_time_day'] );
                $gl_price = ( $gl_set_price != false ) ? $gl_set_price : $gl_price;
            }
            return $gl_price;
        }
    }

}

// Calculate in Special Time ( Range Time )
function ovacrs_price_special_time( $product_id, $rent_time, $key_rt ){

    
    $ovacrs_rt_startdate = get_post_meta( $product_id, 'ovacrs_rt_startdate', true );
    $ovacrs_rt_price = get_post_meta( $product_id, 'ovacrs_rt_price', true );
    $ovacrs_rt_price_hour = get_post_meta( $product_id, 'ovacrs_rt_price_hour', true );
    $ovacrs_rt_discount = get_post_meta( $product_id, 'ovacrs_rt_discount', true );

    $price_type = get_post_meta( $product_id, 'ovacrs_price_type', true );
    
    if( $ovacrs_rt_startdate[$key_rt] ){
        
            


            // Check if PickUp Date bettwen date of Range Time
            if( $price_type == 'day' ){

                $rt_price = $ovacrs_rt_price[$key_rt];
                // Return ST Price Discount
                if( isset( $ovacrs_rt_discount[$key_rt] ) ){
                    $ovacrs_rt_discount_duration_val = $ovacrs_rt_discount[$key_rt]['duration'];
                    arsort($ovacrs_rt_discount_duration_val);

                    $ovacrs_rt_discount_duration_type = $ovacrs_rt_discount[$key_rt]['duration_type'];
                    $ovacrs_rt_discount_duration_price = $ovacrs_rt_discount[$key_rt]['price'];
                    $st_set_price = set_price_by_rt_discount($ovacrs_rt_discount_duration_val, $ovacrs_rt_discount_duration_type, $ovacrs_rt_discount_duration_price, $price_type='days', $rent_time['rent_time_day'] );
                    $rt_price = $st_set_price != false ? $st_set_price : $rt_price;
                }

                return $rt_price;
                

            }else if( $price_type == 'hour' ){

                $rt_price = $ovacrs_rt_price_hour[$key_rt];

                // Set Price by RT(ST) Discount
                if( isset( $ovacrs_rt_discount[$key_rt] ) ){
                    $ovacrs_rt_discount_duration_val = $ovacrs_rt_discount[$key_rt]['duration'];
                    arsort($ovacrs_rt_discount_duration_val);
                    $ovacrs_rt_discount_duration_type = $ovacrs_rt_discount[$key_rt]['duration_type'];
                    $ovacrs_rt_discount_duration_price = $ovacrs_rt_discount[$key_rt]['price'];
                    $st_set_price =  set_price_by_rt_discount( $ovacrs_rt_discount_duration_val, $ovacrs_rt_discount_duration_type, $ovacrs_rt_discount_duration_price, $price_type='hours', $rent_time['rent_time_hour'] );
                    $rt_price = $st_set_price != false ? $st_set_price : $rt_price;
                }

                return $rt_price;

            }else{ // Price type is Mixed

                if( $rent_time['rent_time_day_raw'] < 1 ){

                    $rt_price = $ovacrs_rt_price_hour[$key_rt];
                    // Set Price by RT(ST) Discount
                    if( isset( $ovacrs_rt_discount[$key_rt] ) ){
                        $ovacrs_rt_discount_duration_val = $ovacrs_rt_discount[$key_rt]['duration'];
                        arsort($ovacrs_rt_discount_duration_val);
                        $ovacrs_rt_discount_duration_type = $ovacrs_rt_discount[$key_rt]['duration_type'];
                        $ovacrs_rt_discount_duration_price = $ovacrs_rt_discount[$key_rt]['price'];
                        $st_set_price = set_price_by_rt_discount( $ovacrs_rt_discount_duration_val, $ovacrs_rt_discount_duration_type, $ovacrs_rt_discount_duration_price, $price_type='hours', $rent_time['rent_time_hour'] );
                        $rt_price = $st_set_price != false ? $st_set_price : $rt_price;
                    }

                    return $rt_price;

                }else{

                    $rt_price = $ovacrs_rt_price[$key_rt];
                    // Set Price by RT(ST) Discount
                    if( isset( $ovacrs_rt_discount[$key_rt] ) ){
                        $ovacrs_rt_discount_duration_val = $ovacrs_rt_discount[$key_rt]['duration'];
                        arsort($ovacrs_rt_discount_duration_val);

                        $ovacrs_rt_discount_duration_type = $ovacrs_rt_discount[$key_rt]['duration_type'];
                        $ovacrs_rt_discount_duration_price = $ovacrs_rt_discount[$key_rt]['price'];
                        $st_set_price = set_price_by_rt_discount( $ovacrs_rt_discount_duration_val, $ovacrs_rt_discount_duration_type, $ovacrs_rt_discount_duration_price, $price_type='days', $rent_time['rent_time_day'] );
                        $rt_price = $st_set_price != false ? $st_set_price : $rt_price;
                    }

                    return $rt_price;

                }
            }
        
    } // endif
}





// Custom Calculate Total Add To Cart
add_action( 'woocommerce_before_calculate_totals',  'ovacrs_woocommerce_before_calculate_totals' , 10, 1); 
function ovacrs_woocommerce_before_calculate_totals( $cart_object ){

    foreach ( $cart_object->get_cart() as $cart_item_key => $cart_item) {
        
        // Check custom product type is ovacrs_car_rental
        if( !$cart_item['data']->is_type('ovacrs_car_rental') ) continue;

    	$product_id = $cart_item['product_id'];

        // Calculate Rent Time
    	$ovacrs_pickup_date = strtotime( $cart_item['ovacrs_pickup_date'] );
    	$ovacrs_pickoff_date = strtotime( $cart_item['ovacrs_pickoff_date'] );

        $rent_time = get_time_bew_2day( $ovacrs_pickup_date, $ovacrs_pickoff_date );

    	
    	// Get Range Time or ST
    	$ovacrs_rt_startdate = get_post_meta( $product_id, 'ovacrs_rt_startdate', true );
    	$ovacrs_rt_enddate = get_post_meta( $product_id, 'ovacrs_rt_enddate', true );
    	


        /* Table Price - Global *******************************************/
        $gl_price = ovacrs_price_global( $product_id, $rent_time );
        $gl_quantity = ovacrs_quantity_global( $product_id, $rent_time );
        
        $quantity = $gl_quantity;
        $line_total = $gl_price * $gl_quantity;
        

        /* Table Price - Special Time ( Range Time) *******************************************/
        if( $ovacrs_rt_startdate ){
            foreach ($ovacrs_rt_startdate as $key_rt => $value_rt) {

                // If Special_Time_Start_Date <= pickup_date && pickoff_date <= Special_Time_End_Date
                if( $ovacrs_pickup_date >= strtotime( $ovacrs_rt_startdate[$key_rt] ) && $ovacrs_pickoff_date <= strtotime( $ovacrs_rt_enddate[$key_rt] ) ){

                    $rt_price = ovacrs_price_special_time( $product_id, $rent_time, $key_rt );
                    $rt_quantity = ovacrs_quantity_global( $product_id, $rent_time );
                    
                    $quantity = $rt_quantity;
                    $line_total = $rt_price * $rt_quantity;

                    break;

                }else if( $ovacrs_pickup_date < strtotime( $ovacrs_rt_startdate[$key_rt] ) && $ovacrs_pickoff_date <= strtotime( $ovacrs_rt_enddate[$key_rt] ) && $ovacrs_pickoff_date >= strtotime( $ovacrs_rt_startdate[$key_rt] ) ){
                    
                    
                    $gl_quantity_array = get_time_bew_2day( $ovacrs_pickup_date, strtotime( $ovacrs_rt_startdate[$key_rt] ) );
                    $gl_price = ovacrs_price_global( $product_id, $gl_quantity_array );
                    $gl_quantity = ovacrs_quantity_global( $product_id, $gl_quantity_array );

                    $rt_quantity_array = get_time_bew_2day( strtotime( $ovacrs_rt_startdate[$key_rt] ), $ovacrs_pickoff_date );
                    $rt_price = ovacrs_price_special_time( $product_id, $rt_quantity_array, $key_rt );
                    $rt_quantity = ovacrs_quantity_global( $product_id, $rt_quantity_array );

                    $quantity = $gl_quantity + $rt_quantity;
                    $line_total = $gl_price * $gl_quantity + $rt_quantity * $rt_price;
                    
                    break;

                }else if( $ovacrs_pickup_date >= strtotime( $ovacrs_rt_startdate[$key_rt] ) && $ovacrs_pickup_date <= strtotime( $ovacrs_rt_enddate[$key_rt] ) && $ovacrs_pickoff_date >= strtotime( $ovacrs_rt_enddate[$key_rt] ) ){

                    $rt_quantity_array = get_time_bew_2day( $ovacrs_pickup_date, strtotime( $ovacrs_rt_enddate[$key_rt] ) );
                    $rt_price = ovacrs_price_special_time( $product_id, $rt_quantity_array, $key_rt );
                    $rt_quantity = ovacrs_quantity_global( $product_id, $rt_quantity_array );

                    $gl_quantity_array = get_time_bew_2day( strtotime( $ovacrs_rt_enddate[$key_rt] ), $ovacrs_pickoff_date );
                    $gl_price = ovacrs_price_global( $product_id, $gl_quantity_array );
                    $gl_quantity = ovacrs_quantity_global( $product_id, $gl_quantity_array );
                    
                    $quantity = $gl_quantity + $rt_quantity;
                    $line_total = $gl_price * $gl_quantity + $rt_quantity * $rt_price;

                    break;

                }else if( $ovacrs_pickup_date < strtotime( $ovacrs_rt_startdate[$key_rt] ) && $ovacrs_pickoff_date > strtotime( $ovacrs_rt_enddate[$key_rt] ) ){

                    $gl_rent_time_1 = get_time_bew_2day( $ovacrs_pickup_date, strtotime( $ovacrs_rt_startdate[$key_rt] ) );
                    $gl_quantity_1 = ovacrs_quantity_global( $product_id, $gl_rent_time_1 );

                    $gl_rent_time_3 = get_time_bew_2day( strtotime( $ovacrs_rt_enddate[$key_rt] ), $ovacrs_pickoff_date );
                    $gl_quantity_3 = ovacrs_quantity_global( $product_id, $gl_rent_time_3 );

                    $gl_quantity = $gl_quantity_1 + $gl_quantity_3;



                    $rt_rent_time_2 = get_time_bew_2day( strtotime( $ovacrs_rt_startdate[$key_rt] ), strtotime( $ovacrs_rt_enddate[$key_rt] ) );
                    $rt_quantity = ovacrs_quantity_global( $product_id, $rt_rent_time_2 );

                    
                    $gl_price = ovacrs_price_global( $product_id, $gl_rent_time_1 );
                    $rt_price = ovacrs_price_special_time( $product_id, $rt_rent_time_2, $key_rt );

                    $quantity = $gl_quantity + $rt_quantity;

                    $line_total = $gl_price * $gl_quantity + $rt_quantity * $rt_price;

                    break;

                }

            }
        }


        /* Price = Price + Resource Price - by Resource ********************************************/
        $cart_re = $cart_item['resources'];
        $resource_id = get_post_meta( $product_id, 'ovacrs_resource_id', true );
        $resource_price = get_post_meta( $product_id, 'ovacrs_resource_price', true );
        $resource_duration_type = get_post_meta( $product_id, 'ovacrs_resource_duration_type', true );

        if( $cart_re ){
            foreach ( $cart_re as $key_c_re => $value_c_re) {
                foreach ($resource_id as $key_id => $value_id) {
                    if( $key_c_re ==  $value_id ){

                        if( $resource_duration_type[$key_id] == 'total' ){
                            $line_total = $line_total + $resource_price[$key_id];
                        }else if( $resource_duration_type[$key_id] == 'days' ){

                            $line_total = $line_total + $resource_price[$key_id] * $quantity;
                            
                        }if( $resource_duration_type[$key_id] == 'hours' ){

                            if( $rent_time['rent_time_day_raw'] < 1 ){
                                $line_total = $line_total + $resource_price[$key_id] * $quantity;
                            }else{
                                $line_total = $line_total + $resource_price[$key_id] * $quantity*24;
                            }

                        }
                        

                    }
                }
            }
        }


        

        $cart_item['data']->set_price( $line_total );
        $cart_object->cart_contents[ $cart_item_key ]['quantity'] = 1;


    } // End foreach

    
}









