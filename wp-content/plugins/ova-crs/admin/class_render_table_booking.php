<?php if ( !defined( 'ABSPATH' ) ) exit();

if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class List_Booking extends WP_List_Table {

    function __construct(){

        global $page;

        
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'bookings',     //singular name of the listed records
            'plural'    => 'bookings',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        
    }

    function column_default($item, $column_name){
        switch($column_name){
            case 'id':
            case 'customer':
            case 'check-in':
            case 'check-out':
            case 'pickup-loc':
            case 'pickoff-loc':
            case 'room-code':
            case 'room-name':
            case 'order_status':
            case 'order_id':
                return $item[$column_name];
            default:
                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }

    function column_order_status($item){

        switch ($item['order_status']) {
            case 'processing':
                $order_status_text = esc_html__( 'Processing', 'ova-hotel' );
                break;
            case 'completed':
                $order_status_text = esc_html__( 'Completed', 'ova-hotel' );
                break;
            case 'on-hold':
                $order_status_text = esc_html__( 'On hold', 'ova-hotel' );
                break;
            case 'cancelled':
                $order_status_text = esc_html__( 'Cancel', 'ova-hotel' );
                break;            
            
            default:
                $order_status_text = esc_html__( 'Update Order', 'ova-hotel' );
                break;
        }
        
        //Build row actions
        $selected_action = sprintf( '<select ="update_order_status" class="update_order_status" data-order_id="'.$item['id'].'">
            <option value="">'.esc_html__( 'Update Status', 'ova-hotel' ).'</option>
            <option value="wc-completed">'.esc_html__( 'Completed', 'ova-hotel' ).'</option>
            <option value="wc-processing">'.esc_html__( 'Processing', 'ova-hotel' ).'</option>
            <option value="wc-on-hold">'.esc_html__( 'On hold', 'ova-hotel' ).'</option>
            <option value="wc-cancelled">'.esc_html__( 'Cancel', 'ova-hotel' ).'</option>
        </select>' );

        return sprintf('<span>%1$s</span>%2$s',
            '<mark class="order-status status-'.$item['order_status'].' tips"><span>'.$order_status_text.'</span></mark>',
            $selected_action
        );
        
        
    }

    function column_id($item){
    	//Build row actions
        
    	return sprintf('<span>%1$s</span>',
            '<a target="_blank" href="'.home_url('/').'wp-admin/post.php?post='.$item['id'].'&action=edit">'.$item['id'].'</a>'
        );
    }

    

    

    function get_columns(){
        $columns = array(
            'id'     	=> __( 'Order ID','ova-hotel' ),
            'customer'  => __( 'Customer','ova-hotel' ),
            'check-in'	=> __( 'Check-in','ova-hotel' ),
            'check-out'	=> __( 'Check-out','ova-hotel' ),
            'pickup-loc'  => __( 'Pickup Location','ova-hotel' ),
            'pickoff-loc' => __( 'Pickoff Location','ova-hotel' ),
            'room-code'	=> __( 'ID Vehicle','ova-hotel' ),
            'room-name'	=> __( 'Vehicle','ova-hotel' ),
            'order_status'    => __( 'Order Status','ova-hotel' ),
          
        );
        return $columns;
    }

    function get_sortable_columns() {
        $sortable_columns = array(
            'id'    		=> array('id',true),
            'customer' 		=> array('customer',false),
            'check-in'     	=> array('check-in',false),  //true means it's already sorted
            'check-out'     => array('check-out',false),  //true means it's already sorted
            'pickup-loc'      => array('pickup-loc',false),  //true means it's already sorted
            'pickoff-loc'     => array('pickoff-loc',false),  //true means it's already sorted
            'room-code'		=> array('room-code',false),  //true means it's already sorted
            'room-name'		=> array('room-name',false),  //true means it's already sorted
            'order_status'  		=> array('order_status',false),
            
        );
        return $sortable_columns;
    }



    function prepare_items() {
        global $wpdb; //This is used only if making any database queries

        /**
         * First, lets decide how many records per page to show
         */
        $per_page = '20';
        
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);
        
        // $this->process_bulk_action();

        $data = array();

        $filter_order_status =  isset( $_POST['filter_order_status'] ) ? $_POST['filter_order_status'] : '';

        if( $filter_order_status != '' ){
            $order_status = array( $filter_order_status );
        }else{
            $order_status = array( 'wc-processing','wc-completed', 'wc-half-completed', 'wc-on-hold', 'wc-cancelled' );    
        }

        

        $room_query = ( isset( $_POST['room_id'] ) && $_POST['room_id'] != '' ) ? 'AND order_item_meta.meta_value = '.$_POST['room_id'] : '';


        $result = $wpdb->get_col("
	        SELECT Distinct order_items.order_id
	        FROM {$wpdb->prefix}woocommerce_order_items as order_items
	        LEFT JOIN {$wpdb->prefix}woocommerce_order_itemmeta as order_item_meta ON order_items.order_item_id = order_item_meta.order_item_id
	        LEFT JOIN {$wpdb->posts} AS posts ON order_items.order_id = posts.ID
	        WHERE posts.post_type = 'shop_order'
	        AND posts.post_status IN ( '" . implode( "','", $order_status ) . "' )
	        AND order_items.order_item_type = 'line_item'
	        AND order_item_meta.meta_key = '_product_id'
	        $room_query
	    ");

        $room_code_filter = isset( $_POST['room_code'] ) ? $_POST['room_code'] : '';

	    $from_day = isset( $_POST['from_day'] ) ? strtotime( $_POST['from_day'] ) : '';
    	$to_day = isset( $_POST['to_day'] ) ? strtotime( $_POST['to_day'] ) : '';
	    
	    $check_in_out = isset( $_POST['check_in_out'] ) ? $_POST['check_in_out'] : '';
        $check = $check_in_flag = $check_out_flag = $pickup_loc_flag = $pickoff_loc_flag = true;


        $current_pickup_loc = isset( $_POST['pickup_loc'] ) ? $_POST['pickup_loc'] : '';
        $current_pickoff_loc = isset( $_POST['pickoff_loc'] ) ? $_POST['pickoff_loc'] : '';

	    foreach ($result as $key => $value) {

	        // Get Order Detail by Order ID
	        $order = wc_get_order($value);
	        

	        // Get Meta Data type line_item of Order
	        $order_line_items = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );

	        
	       
	        // For Meta Data
	        foreach ( $order_line_items as $item_id => $item ) {

	            $room_check_in = $room_check_out = $room_code = $pickup_loc = $pickoff_loc = '';

	            $room_name = $item->get_name();
	            

	            // Get value of check-in, check-out
	            foreach ( $item->get_formatted_meta_data() as $meta_id => $meta ) {

	                if( $meta->key == 'ovacrs_pickup_date' ){
	                    $room_check_in = date( get_option('date_format') .' - g:i A', strtotime( str_replace('/', '-', $meta->value) ) );
	                }
	                if( $meta->key == 'ovacrs_pickoff_date' ){
	                    $room_check_out = date( get_option('date_format').' - g:i A', strtotime( str_replace('/', '-', $meta->value) ) );
	                }
	                
	                if( $meta->key == 'id_vehicle' ){
	                    
	                    if( $room_code_filter != '' && $room_code_filter == $meta->value ){
	                    	$room_code = $meta->value;
	                    }else if( $room_code_filter == '' ){
	                    	$room_code = $meta->value;
	                    }
	                }

                    if( $meta->key == 'ovacrs_pickup_loc' ){
                        $pickup_loc = $meta->value;
                    }
                    if( $meta->key == 'ovacrs_pickoff_loc' ){
                        $pickoff_loc = $meta->value;
                    }


	            }

                $room_check_in_timep = strtotime( $room_check_in );
                $room_check_out_timep = strtotime( $room_check_out );

                if( $check_in_out == 'check_in' && $from_day != '' && $to_day != '' ){
                    $check = ( $from_day <=  $room_check_in_timep && $room_check_in_timep <= $to_day ) ? true : false;
                }else if( $check_in_out == 'check_out' ){
                    $check = ( $from_day <=  $room_check_out_timep &&  $room_check_out_timep <= $to_day ) ? true : false;
                }else if( $from_day != '' && $to_day != '' ){
                    $check_in_flag = ( $from_day <=  $room_check_in_timep && $room_check_in_timep <= $to_day ) ? true : false;
                    $check_out_flag = ( $from_day <=  $room_check_out_timep &&  $room_check_out_timep <= $to_day ) ? true : false;
                }

                if( $current_pickup_loc != '' && $pickup_loc != $current_pickup_loc ){
                    $pickup_loc_flag = false;
                }else{
                    $pickup_loc_flag = true;
                }

                if( $current_pickoff_loc != '' && $pickoff_loc != $current_pickoff_loc ){
                    $pickoff_loc_flag = false;
                }else{
                    $pickoff_loc_flag = true;
                }
                


	            if( $room_code && $check && $check_in_flag && $check_out_flag && $pickup_loc_flag && $pickoff_loc_flag ){
	            	$data[] = array(
		                'id'            => $order->get_ID(),
		                'customer'     	=> $order->get_formatted_billing_full_name(),
		                'check-in'      => $room_check_in,
		                'check-out'    	=> $room_check_out,
                        'pickup-loc'      => $pickup_loc,
                        'pickoff-loc'     => $pickoff_loc,
		                'room-code'		=> $room_code,
		                'room-name'		=> $room_name,
		                'order_status'   => $order->get_status(),
		                
		            );
	            }
	            
	            
	        }
	    }



       $sortable = $this->get_sortable_columns();
       function get_sortable_columns() {
          $sortable_columns = array(
            'id'  => array('id',false),
            'created' => array('created',false)
          );
          return $sortable_columns;
        }


        function usort_reorder($a,$b){
            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'id'; //If no sort, default to title
            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; //If no order, default to asc
            $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
            return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
        }
        //usort($data, 'usort_reorder');

        
        $current_page = $this->get_pagenum();
        
        $total_items = count($data);
        
       
        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
       
        $this->items = $data;
        
       
        $this->set_pagination_args( array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
        ) );
    }


}
