/* product type specific options */

    /* Init Date Time Picket */
    jQuery('.datetimepicker').each(function(){
        var today = new Date();
        var datePickerOptions = {
            dateFormat: 'yy-m-d',
            firstDay: 1,
            minDate: today,
            changeMonth: true,
            changeYear: true
        }
        jQuery(this).datetimepicker(datePickerOptions);
    });


    
    

    /* Display Custom Field in Car Rental ***********************************************************/
    jQuery( 'body' ).on( 'woocommerce-product-type-change', function( event, select_val, select ) {

        if ( select_val == 'ovacrs_car_rental' ) {
            jQuery( '.show_if_ovacrs_car_rental' ).show();
            jQuery( '.product_data_tabs .general_options' ).show();
            jQuery( 'ul.product_data_tabs li' ).removeClass('active');
            jQuery( 'ul.product_data_tabs li.general_options' ).addClass('active');
            jQuery( '#shipping_product_data' ).css('display', 'none');
            jQuery( '#general_product_data' ).css('display', 'block');

            
            /* for Price tab */
            jQuery(' ul.product_data_tabs li.general_tab').addClass('show_if_variable_bulk').show();
            jQuery('#general_product_data .pricing').addClass('show_if_variable_bulk').show();

            
            /* For sale off */
            jQuery('#general_product_data ._sale_price_field').hide();
            jQuery('#general_product_data .sale_price_dates_fields').hide();

            jQuery('#general_product_data .pricing').css('border-bottom','none');

            
            
            

            /* Append text to _regular_price_field */
            jQuery( '#general_product_data ._regular_price_field label' ).first().append( '<span> / Day</span>' );

            /*for Inventory tab */
            jQuery( 'ul.product_data_tabs li.inventory_tab' ).show();
            jQuery('.inventory_options').addClass('show_if_variable_bulk').show();
            jQuery('#inventory_product_data ._manage_stock_field').addClass('show_if_variable_bulk').show();
            jQuery('#inventory_product_data ._sold_individually_field').parent().addClass('show_if_variable_bulk').show();
            jQuery('#inventory_product_data ._sold_individually_field').addClass('show_if_variable_bulk').show();
            
        } else if ( select_val == 'grouped' ) {
            jQuery( '.show_if_ovacrs_car_rental' ).hide();
            jQuery( '.product_data_tabs .general_options' ).hide();

        }else{
            jQuery( '.show_if_ovacrs_car_rental' ).hide();
            jQuery( '#general_product_data ._regular_price_field label span' ).hide();
            jQuery('#general_product_data ._sale_price_field').show();
            jQuery('#general_product_data .sale_price_dates_fields').show();
            jQuery('#general_product_data .pricing').css('border-bottom','1px solid #eee');
            
        }

    });

    /* Display Attributes tab */
    jQuery( '.add_extra_features' ).click(function(e){
        e.preventDefault();
        jQuery( '.product_data_tabs li' ).removeClass('active');
        jQuery( '.product_data_tabs .attribute_options' ).addClass('active');
        jQuery( '#general_product_data' ).hide();
        jQuery( '#product_attributes' ).show();

    });

    
    /* Discount ********************************************************** */
    /* Remove tr discount */
    jQuery( '#general_product_data' ).on('click', '.ovacrs_global_discount .delete', function(e){
        e.preventDefault();
        jQuery(this).closest('.row_discount').remove();
    });

    /* Add extra field discount */
    jQuery( '.ovacrs_global_discount a.insert_discount' ).click(function(e){
        e.preventDefault();
        var html = jQuery(this).data('row');
        jQuery(this).closest('.ovacrs_global_discount').find('tbody').append(html);
    });
    


    /* Range Time with price ***********************************************************/

    /* Total RT Row */
    function total_rt_row(){
        return jQuery('.ovacrs_rt .row_rt_record').length; /* Total Row RT */
    }

    /* Sort pos of Rt Row and Rt discount */
    function sort_rt(){

        /* Sort RT */
        var k = 0;
        jQuery('.ovacrs_rt .row_rt_record').each(function(){
            /* set again post for each rt row */
            jQuery(this).attr('data-pos', k);
            k++;
        });

        /* Sort RT Discount */
        var total_rt_row = jQuery('.ovacrs_rt .row_rt_record').length;
        for( var i = 0; i < total_rt_row; i++ ){
            jQuery( '.wrap_rt .row_rt_record' ).each(function(){
                if( jQuery(this).attr('data-pos') == i ){
                    jQuery(this).find('tbody.real .ovacrs_rt_discount_price').attr('name', 'ovacrs_rt_discount['+i+'][price][]');
                    jQuery(this).find('tbody.real .ovacrs_rt_discount_duration').attr('name', 'ovacrs_rt_discount['+i+'][duration][]');
                    jQuery(this).find('tbody.real .ovacrs_rt_discount_duration_type').attr('name', 'ovacrs_rt_discount['+i+'][duration_type][]');    
                }
            });
        }
    }

    
    /* Add RT Record */
    jQuery( '.ovacrs_rt a.insert_rt_record' ).click(function(e){
        e.preventDefault();
        var html = jQuery(this).data('row');

        
        var rt_total = total_rt_row(); /* Total Row RT */
        html = html.replace( 'data-pos=""', 'data-pos="'+rt_total+'"'  ); /* Add position for each Rt record */

        jQuery(this).closest('.ovacrs_rt').find('tbody').first().append(html);
    });

    /* Remove RT Record */
    jQuery( '#general_product_data' ).on('click', '.ovacrs_rt .delete_rt', function(e){
        e.preventDefault();
        jQuery(this).closest('.row_rt_record').remove();
        sort_rt();
    });


    /* Add RT Discount  */
    jQuery( '#general_product_data' ).on( 'click', 'a.insert_rt_discount', function(e){
        e.preventDefault();
        var html = jQuery(this).find('.wrap_rt_discount tbody').html();

        var pos_rt = jQuery(this).closest( '.row_rt_record' ).data('pos'); /* Get position of RT */
        html = html.replace( /ovacrs_key/g, pos_rt ); /* Replace all key to position of RT */

        jQuery(this).closest('.ovacrs_rt_discount').find('tbody').first().append(html);
        
    }); 

    /* Remove RT Discount */
    jQuery( '#general_product_data' ).on('click', '.ovacrs_rt .delete_discount', function(e){
        e.preventDefault();
        jQuery(this).closest('.tr_rt_discount').remove();
    });




    
    /* Unavailable Time ***********************************************************/
    /* Add UnTime */
    jQuery( '.ovacrs_rt_untime a.insert_rt_untime' ).click(function(e){
        e.preventDefault();
        var html = jQuery(this).data('row');
        jQuery(this).closest('.ovacrs_rt_untime').find('tbody').append(html);

    });

    /* Remove UnTime */
    jQuery( '#general_product_data' ).on('click', '.delete_untime', function(e){
        e.preventDefault();
        jQuery(this).closest('.tr_rt_untime').remove();
    });



    /* Resources ***********************************************************/
    /* Add Resources */
    jQuery( '.ovacrs_resources a.insert_resources' ).click(function(e){
        e.preventDefault();
        var html = jQuery(this).data('row');
        jQuery(this).closest('.ovacrs_resources').find('tbody').append(html);

    });

    /* Remove Resources */
    jQuery( '#general_product_data' ).on('click', '.delete_resource', function(e){
        e.preventDefault();
        jQuery(this).closest('.tr_rt_resource').remove();
    });


    /* Features ***********************************************************/
    /* Add Features */
    jQuery( '.ovacrs_features a.insert_rt_feature' ).click(function(e){
        e.preventDefault();
        var html = jQuery(this).data('row');
        jQuery(this).closest('.ovacrs_features').find('tbody').append(html);

    });
    /* Remove Resources */
    jQuery( '#general_product_data' ).on('click', '.delete_feature', function(e){
        e.preventDefault();
        jQuery(this).closest('.tr_rt_feature').remove();
    });


    /* Other Features ***********************************************************/
    /* Add Other Features */
    jQuery( '.ovacrs_other_features a.insert_rt_other_feature' ).click(function(e){
        e.preventDefault();
        var html = jQuery(this).data('row');
        jQuery(this).closest('.ovacrs_other_features').find('tbody').append(html);

    });
    /* Remove Resources */
    jQuery( '#general_product_data' ).on('click', '.delete_other_feature', function(e){
        e.preventDefault();
        jQuery(this).closest('.tr_rt_other_feature').remove();
    });

    


    


    




