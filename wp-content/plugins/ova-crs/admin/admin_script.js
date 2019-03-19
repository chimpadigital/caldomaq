jQuery(document).on('change',  '.update_order_status', function(e){
	
	var order_status_text = jQuery(this).children("option:selected").html();
	var new_order_status_val = jQuery(this).children("option:selected").val();

	var prompt_ask = confirm("Do you want to "+order_status_text+' Booking ?');

	if (prompt_ask == true && new_order_status_val != '') {

		var order_id = jQuery(this).data('order_id');
		
		var new_order_status_class = jQuery(this).children("option:selected").val().replace( 'wc-', '' );
		

		

		var order_status_place = jQuery(this).closest('.order_status').find('.order-status');
		var order_status_place_text = jQuery(this).closest('.order_status').find('.order-status span');
		
			var data = {
				'action': 'update_order_status_woo',
				'order_id': order_id,
				'new_order_status': new_order_status_val
			}

			jQuery.post( ajaxurl, data, function( response ) {
				// append_place.append(response);
				order_status_place.attr('class', '');
				order_status_place.addClass('order-status tips status-'+new_order_status_class);
				order_status_place_text.html(new_order_status_class);
				
				
			});
	}
	e.preventDefault();
});

jQuery('.date_book').each(function(){
    var today = new Date();
    var datePickerOptions = {
        dateFormat: 'yy-m-d',
        firstDay: 1,
        changeMonth: true,
        changeYear: true
    }
    jQuery(this).datetimepicker(datePickerOptions);
});
