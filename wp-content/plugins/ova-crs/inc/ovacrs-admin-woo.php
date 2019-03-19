<?php
if ( !defined( 'ABSPATH' ) ) exit();


// ADD A PRODUCT TYPE **************************************/
add_filter( 'product_type_selector', 'ovacrs_add_custom_product_type', 10, 1 );
add_action( 'init', 'ovacrs_create_custom_product_type' );
// add_filter( 'product_type_options', 'ovacrs_rental_product_options', 8 );

function ovacrs_add_custom_product_type( $types ){
    $types[ 'ovacrs_car_rental' ] = esc_html__( 'Car Rental', 'ova-crs' );
    return $types;
}

function ovacrs_create_custom_product_type(){
     // declare the product class
     class WC_Product_Ovacrs_car_rental extends WC_Product{
        public function __construct( $product ) {
           $this->product_type = 'ovacrs_car_rental';
           parent::__construct( $product );
           // add additional functions here
        }

    }
}



// ADD CUSTOM FIELD PRODUCT TYPE **************************************/

// add the settings under ‘General’ sub-menu
add_action( 'woocommerce_product_options_general_product_data', 'ovacrs_add_custom_settings' );
add_action( 'woocommerce_process_product_meta', 'ovacrs_save_custom_settings' );


function ovacrs_add_custom_settings() {
    global $woocommerce, $post;
    include( OVACRS_PLUGIN_PATH.'/templates/ovacrs-custom-fields.php' );
}


// Save Custom Fields
function ovacrs_save_custom_settings( $post_id ){
  
  
  $ovacrs_regul_price_hour = $_POST['ovacrs_regul_price_hour'];
  update_post_meta( $post_id, 'ovacrs_regul_price_hour', esc_attr( $ovacrs_regul_price_hour) );

  // save custom field
  $ovacrs_car_count = $_POST['ovacrs_car_count'];
  update_post_meta( $post_id, 'ovacrs_car_count', esc_attr( $ovacrs_car_count) );


  $ovacrs_car_order = $_POST['ovacrs_car_order'] ? $_POST['ovacrs_car_order'] : 1;
  update_post_meta( $post_id, 'ovacrs_car_order', esc_attr( $ovacrs_car_order) );

  $ovacrs_id_vehicles = $_POST['ovacrs_id_vehicles'] ? $_POST['ovacrs_id_vehicles'] : '';
  update_post_meta( $post_id, 'ovacrs_id_vehicles', esc_attr( $ovacrs_id_vehicles) );

  
  $ovacrs_global_discount_price = $_POST['ovacrs_global_discount_price'];
  update_post_meta( $post_id, 'ovacrs_global_discount_price', $ovacrs_global_discount_price );


  $ovacrs_global_discount_duration_val = $_POST['ovacrs_global_discount_duration_val'];
  update_post_meta( $post_id, 'ovacrs_global_discount_duration_val', $ovacrs_global_discount_duration_val );

  $ovacrs_global_discount_duration_type = $_POST['ovacrs_global_discount_duration_type'];
  update_post_meta( $post_id, 'ovacrs_global_discount_duration_type', $ovacrs_global_discount_duration_type );

  // Price/Day
  $ovacrs_rt_price = $_POST['ovacrs_rt_price'];
  update_post_meta( $post_id, 'ovacrs_rt_price', $ovacrs_rt_price );

  // Price/Hour
  $ovacrs_rt_price_hour = $_POST['ovacrs_rt_price_hour'];
  update_post_meta( $post_id, 'ovacrs_rt_price_hour', $ovacrs_rt_price_hour );  

    

  $ovacrs_rt_startdate = $_POST['ovacrs_rt_startdate'];
  update_post_meta( $post_id, 'ovacrs_rt_startdate', $ovacrs_rt_startdate );

  $ovacrs_rt_enddate = $_POST['ovacrs_rt_enddate'];
  update_post_meta( $post_id, 'ovacrs_rt_enddate', $ovacrs_rt_enddate );


  $ovacrs_rt_discount = $_POST['ovacrs_rt_discount'];
  unset($ovacrs_rt_discount['ovacrs_key']);// Remove array has key is ovacrs_key 
  update_post_meta( $post_id, 'ovacrs_rt_discount', $ovacrs_rt_discount );

  $ovacrs_untime_startdate = $_POST['ovacrs_untime_startdate'];
  update_post_meta( $post_id, 'ovacrs_untime_startdate', $ovacrs_untime_startdate );

  $ovacrs_untime_enddate = $_POST['ovacrs_untime_enddate'];
  update_post_meta( $post_id, 'ovacrs_untime_enddate', $ovacrs_untime_enddate );

  $ovacrs_resource_name = $_POST['ovacrs_resource_name'];
  update_post_meta( $post_id, 'ovacrs_resource_name', $ovacrs_resource_name );

  
  
  $ovacrs_resource_id = $_POST['ovacrs_resource_id'];
  update_post_meta( $post_id, 'ovacrs_resource_id', $ovacrs_resource_id );
  
  $ovacrs_resource_price = $_POST['ovacrs_resource_price'];
  update_post_meta( $post_id, 'ovacrs_resource_price', $ovacrs_resource_price );



  $ovacrs_resource_duration_type = $_POST['ovacrs_resource_duration_type'];
  update_post_meta( $post_id, 'ovacrs_resource_duration_type', $ovacrs_resource_duration_type );


  $ovacrs_rent_day_min = $_POST['ovacrs_rent_day_min'];
  if( !empty( $ovacrs_rent_day_min ) ){
    update_post_meta( $post_id, 'ovacrs_rent_day_min', $ovacrs_rent_day_min );  
  }else{
    update_post_meta( $post_id, 'ovacrs_rent_day_min', 1 );  
  }

  $ovacrs_rent_hour_min = $_POST['ovacrs_rent_hour_min'];
  if( !empty( $ovacrs_rent_hour_min ) ){
    update_post_meta( $post_id, 'ovacrs_rent_hour_min', $ovacrs_rent_hour_min );  
  }else{
    update_post_meta( $post_id, 'ovacrs_rent_hour_min', 1 );  
  }

  $ovacrs_price_type = $_POST['ovacrs_price_type'];
  if( !empty( $ovacrs_price_type ) ){
    update_post_meta( $post_id, 'ovacrs_price_type', $ovacrs_price_type );  
  }else{
    update_post_meta( $post_id, 'ovacrs_price_type', 'mixed' );  
  }




  $ovacrs_features_desc = $_POST['ovacrs_features_desc'];
  update_post_meta( $post_id, 'ovacrs_features_desc', $ovacrs_features_desc );

  $ovacrs_features_label = $_POST['ovacrs_features_label'];
  update_post_meta( $post_id, 'ovacrs_features_label', $ovacrs_features_label );

  $ovacrs_features_icons = $_POST['ovacrs_features_icons'];
  update_post_meta( $post_id, 'ovacrs_features_icons', $ovacrs_features_icons );

  $ovacrs_features_special = $_POST['ovacrs_features_special'];
  update_post_meta( $post_id, 'ovacrs_features_special', $ovacrs_features_special );


  $ovacrs_other_features_name = $_POST['ovacrs_other_features_name'];
  update_post_meta( $post_id, 'ovacrs_other_features_name', $ovacrs_other_features_name );


  $ovacrs_video_link = $_POST['ovacrs_video_link'];
  update_post_meta( $post_id, 'ovacrs_video_link', $ovacrs_video_link );
  
  $ovacrs_location = $_POST['ovacrs_location'];
  update_post_meta( $post_id, 'ovacrs_location', $ovacrs_location );  


  $ovacrs_id_vehicles = $_POST['ovacrs_id_vehicles'];
  update_post_meta( $post_id, 'ovacrs_id_vehicles', $ovacrs_id_vehicles );  
    
  
}

/******************************************************************************/