<?php 

defined( 'ABSPATH' ) || exit();

if( !class_exists( 'hozing_admin_ajax' ) ){

	class hozing_admin_ajax{
		
		public function __construct(){
			$this->init();

			
		}

		public function init(){

			// Define All Ajax function
			$arr_ajax =  array(
				'update_order_status_woo'
			);

			foreach($arr_ajax as $val){
				add_action( 'wp_ajax_'.$val, array( $this, $val ) );
				add_action( 'wp_ajax_nopriv_'.$val, array( $this, $val ) );
			}
		}


		/**
		 * Schedule Ajax
		 */
		public static function update_order_status_woo(){

			$order_id = $_POST['order_id'];
			$new_order_status = $_POST['new_order_status'];

			$order = new WC_Order($order_id);
			if( $order->update_status($new_order_status)){
				echo 'true';
			}else{
				echo 'false';	
			}
			
			wp_die();
		}


	}

	new hozing_admin_ajax();

}

?>