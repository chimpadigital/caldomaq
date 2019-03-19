<?php
add_action('wp_enqueue_scripts', 'ireca_theme_scripts_styles');
add_action('wp_enqueue_scripts', 'ireca_primary_color');




function ireca_theme_scripts_styles() {


    /* Google Font */
    wp_enqueue_style( 'ireca_fonts', ireca_customize_google_fonts(), array(), null );

    // enqueue the javascript that performs in-link comment reply fanciness
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' ); 
    }



    
    /* Add Javascript  */
    wp_enqueue_script('bootstrap', IRECA_URI.'/assets/plugins/bootstrap/js/bootstrap.bundle.min.js', array('jquery'),null,true);

   
    wp_enqueue_script('datetimepicker', IRECA_URI.'/assets/plugins/datetimepicker/jquery.datetimepicker.js', array('jquery'),null,true);
    wp_enqueue_script('select2', IRECA_URI.'/assets/plugins/select2/select2.min.js', array('jquery'),null,true);
    
    wp_enqueue_script('moment', IRECA_URI.'/assets/plugins/fullcalendar/moment.min.js', array('jquery'),null,true);
    wp_enqueue_script('fullcalendar', IRECA_URI.'/assets/plugins/fullcalendar/fullcalendar.min.js', array('jquery'),null,true);

    

    wp_enqueue_script('slick', IRECA_URI.'/assets/plugins/slick/slick.min.js', array('jquery'),null,true);

    if( ireca_check_https() ){
      wp_enqueue_script('prettyphoto', IRECA_URI.'/assets/plugins/prettyphoto/jquery.prettyPhoto_https.js', array('jquery'),null,true);  
    }else{
      wp_enqueue_script('prettyphoto', IRECA_URI.'/assets/plugins/prettyphoto/jquery.prettyPhoto.js', array('jquery'),null,true);
    }
    

    wp_enqueue_script('owl-carousel', IRECA_URI.'/assets/plugins/owl-carousel/owl.carousel.min.js', array('jquery'),null,true);

    wp_enqueue_script('validate', IRECA_URI.'/assets/plugins/jquery.validate.min.js', array('jquery'),null,true);

    wp_enqueue_script('waypoints', IRECA_URI.'/assets/plugins/waypoints.min.js', array('jquery'),null,true);
    wp_enqueue_script('scrollto', IRECA_URI.'/assets/plugins/scrollto.js', array('jquery'),null,true);


    wp_enqueue_script('ireca', IRECA_URI.'/assets/js/ireca.js', array('jquery'),null,true);


    /* Add Css  */
    wp_enqueue_style('bootstrap', IRECA_URI.'/assets/plugins/bootstrap/css/bootstrap.min.css', array(), null);

    
    wp_enqueue_style('select2', IRECA_URI.'/assets/plugins/select2/select2.min.css', array(),null);
    wp_enqueue_style('datetimepicker', IRECA_URI.'/assets/plugins/datetimepicker/jquery.datetimepicker.css', array(), null);

    
    wp_enqueue_style('fullcalendar_print', IRECA_URI.'/assets/plugins/fullcalendar/fullcalendar.print.min.css', array(), null, 'print');
    wp_enqueue_style('fullcalendar', IRECA_URI.'/assets/plugins/fullcalendar/fullcalendar.min.css', array(), null);

    wp_enqueue_script('locale-all', IRECA_URI.'/assets/plugins/fullcalendar/locale-all.js', array('jquery'),null,true);

    
    wp_enqueue_style('fontawesome', IRECA_URI.'/assets/plugins/font-awesome/css/all.min.css', array(), null);

    wp_enqueue_style('elegant_font', IRECA_URI.'/assets/plugins/elegant_font/style.css', array(), null);
    wp_enqueue_style('flaticon_car_service', IRECA_URI.'/assets/plugins/flaticon/car_service/flaticon.css', array(), null);
    wp_enqueue_style('flaticon_car2', IRECA_URI.'/assets/plugins/flaticon/car2/flaticon.css', array(), null);
    wp_enqueue_style('flaticon_essential_set', IRECA_URI.'/assets/plugins/flaticon/essential_set/flaticon.css', array(), null);
    
    // Slick
    wp_enqueue_style('slick_main', IRECA_URI.'/assets/plugins/slick/slick.css', array(), null );
    wp_enqueue_style('slick_theme', IRECA_URI.'/assets/plugins/slick/slick-theme.css', array(), null );

    
    
    
    wp_enqueue_style('owl-carousel', IRECA_URI.'/assets/plugins/owl-carousel/assets/owl.carousel.min.css', array(), null);
    

    wp_enqueue_style('ireca_default', IRECA_URI.'/assets/css/default.css', array(), null);
    wp_enqueue_style('ireca_custom', IRECA_URI.'/assets/css/custom.css', array(), null);



    wp_enqueue_style('prettyphoto', IRECA_URI.'/assets/plugins/prettyphoto/css/prettyPhoto.css', array(), null);

    if ( is_child_theme() ) {
      wp_enqueue_style( 'parent_style', trailingslashit( get_template_directory_uri() ) . 'style.css', array(), null );
    }

    if (is_rtl()) {
        wp_enqueue_style('ireca_rtl', IRECA_URI.'/rtl.css', array(), null);
    }

    wp_enqueue_style( 'ireca_style', get_stylesheet_uri(), array(), null );



}




function ireca_primary_color(){

  $main_color_cmb2 = get_post_meta( ireca_get_current_id(), 'ireca_met_main_color', true  );
  $second_color_cmb2 = get_post_meta( ireca_get_current_id(), 'ireca_met_second_color', true  );

  $main_color = ($main_color_cmb2 != '') ? $main_color_cmb2 : get_theme_mod('main_color', '#e9a31b');
  $second_color = ($second_color_cmb2 != '') ? $second_color_cmb2 : get_theme_mod('second_color', '#e82930');

  $body_font = str_replace('ovatheme_','',get_theme_mod('body_font', 'Poppins'));
  $heading_font = str_replace('ovatheme_','',get_theme_mod('heading_font', 'Teko'));

  $custom_css = "
    body,
    .slide_info,
    slide_info_2,
    .slide_feature,
    .slider3_price .time,
    .ireca_service .content h3,
    .rental_item .ireca_btn.price .time,
    .rental_item .wrap_btn .btn_price .text,
    .ovacrs_heading2 h3 span,
    .ovacrs_heading2 .desc,
    .ovacrs_heading4 h3 span,
    .ovacrs_heading4 .desc,
    .woocommerce .related.products ul li h2.woocommerce-loop-product__title
    
    {
      font-family: {$body_font}, sans-serif;
    }

    .ireca_info2 .info .heading,
    .ireca-cart-wrapper.style2 .heading,
    .slide_info .price,
    .slide_info_2 .price,
    .tparrows.ireca.tp-leftarrow .slide_ireca_title,
    .tparrows.ireca.tp-rightarrow .slide_ireca_title,
    .slider3_price .amount,
    .ovacrs_heading1 h3,
    .rental_item .ireca_btn.btn_price .amount,
    .ovacrs_heading2 h3,
    .ovacrs_heading4 h3,
    .ovacrs_support h3,
    .ovacrs_btn_action .desc,
    .ovacrs_why .number,
    .ova_blog .content .ova_media .post_date .day,
    .rental_item.style2 .content .price .woocommerce-Price-amount,
    .ovacrs_product_filter ul.nav.style2 li a,
    .ovacrs_service_full .title,
    .ovacrs_product_slider .price .amount,
    .ovacrs_product_slider .wrap_item .bottom .title a,
    .ovacrs_product_slider ul.nav li a,
    .ovacrs_skill .ovacrs_count,
    .rental_item.style4 .content .price .woocommerce-Price-amount,
    .ovacrs_info .title,
    .woo_rent_top h1.product_title,
    .ireca_woo_price,
    .ovacrs_price_rent .nav,
    .ovacrs_price_rent .collapse_content .price .amount,
    .fc-toolbar h2,
    .fc-day-header,
    .ireca_booking_form h3.title,
    .single-product .woocommerce-tabs ul.tabs li a,
    .woocommerce .related.products h2,
    .woocommerce .related.products ul li .price,
    .woocommerce-Reviews-title,
    .rental_cat_heading_section h1,
    .sidebar .widget h4.widget-title,
    .rental_help label,
    .rental_item.list_product_style1 .content .price .amount,
    .rental_item.list_product_style1 .content .price .time,
    ul.products li.ireca_product .price,
    .ireca_detail_shop .price,
    .ireca_page_cart .cart-collaterals .cart_totals h2,
    .ireca_page_cart .cart-collaterals .cart_totals table.shop_table tr th,
    .ireca_page_cart .woocommerce-cart-form table.shop_table thead th,
    .woocommerce table.shop_table_responsive tr td::before, 
    .woocommerce-page table.shop_table_responsive tr td::before,
    .ova-page-section h2.page-title,
    .heading_page h1.page-title,
    .woocommerce-checkout #customer_details .woocommerce-billing-fields h3,
    .woocommerce-checkout #customer_details .woocommerce-additional-fields h3,
    h3#order_review_heading,
    #order_review table.shop_table thead th,
    #order_review table.shop_table tfoot tr th,
    h2.woocommerce-order-details__title,
    h2.woocommerce-column__title,
    #comments h4.block-title,
    .ireca_service_item h3,
    .ovacrs_heading3 h3.title,
    .img_skew .content h3.title span,
    .img_skew .wrap_desc .contact .phone,
    .img_skew .wrap_desc .contact .email,
    .ovacrs_about_info .title,
    .ovacrs_about_info .number,
    .ireca_get_in_touch h3.title,
    .footer-widget-title,
    .woocommerce div.product p.price, .woocommerce div.product span.price,
    article.post-wrap .wrap_content .post_date .time .day,
    h2.page_default_title,
    .woocommerce-account .woocommerce h2,
    #review_form #respond .comment-reply-title,
    h3.heading-post-title,
    article.post-wrap .post-tag .ovatags


    {
      font-family: {$heading_font}, sans-serif; 
    }


    .ovacrs_btn_action a.ireca_btn:hover,
    .ovatheme_header_default nav.navbar li.active>a,
    .ovacrs_thumbnail_info .content .title a:hover,
    .ovacrs_thumbnail_info .content a:hover i,
    .ova_blog .content .bottom .title a:hover,
    .ova_blog .content .read_more:hover,
    .rental_item .wrap_btn a.btn_price .wrap_content .amount,
    .rental_item .content .woocommerce-product-rating .star-rating span:before,
    .ovacrs_btn_action .desc,
    .ovacrs_why:hover .number,
    .ovacrs_product_filter ul.nav.style2 li a.active + .total_items,
    .ovacrs_product_filter ul.nav.style2 li a:hover + .total_items,
    .rental_item.style2 .content .price .woocommerce-Price-amount,
    .ovacrs_service_full .content .wrap_service .item .name a:hover,
    .ireca_info2 .icon i,
    .ovacrs_product_slider .price .amount,
    .ovacrs_product_slider .wrap_item .bottom .content .price .amount,
    .ovacrs_product_slider .item .wrap_item .bottom .content .price .amount,
    .ovacrs_team .item .job,
    .woocommerce-pagination ul.page-numbers li a, .woocommerce-pagination ul.page-numbers li span,
    .ovacrs_skill .ovacrs_count,
    .rental_item.style4 .content .price .woocommerce-Price-amount,
    .rental_item.list_product_style1 .content .price .amount,
    .woocommerce .woocommerce-product-rating .star-rating,
    .woocommerce .star-rating span::before, .woocommerce p.stars a,
    .ireca-thumbnails button.owl-next:hover,
    .ireca-thumbnails button.owl-prev:hover,
    .ovacrs_price_rent .collapse_content .price .amount,
    ul.products li .price .amount,
    ul.products li.ireca_product .price ins .woocommerce-Price-amount,
    .ireca_detail_shop .price ins .woocommerce-Price-amount,
    .img_skew .wrap_desc .contact .phone,
    .ireca_service_repair i,
    .rental_help .wrap_phone .phone,
    .woocommerce-MyAccount-navigation ul li.is-active a,
    footer.footer a.link_find_map ,
    footer.footer_v2 h4.footer-widget-title,
    footer.footer_v2 .footer_col1 .ireca_info  i,
    footer.footer_v2 .footer_col1  .ireca_info.mob_yellow  i,
    .woocommerce-pagination ul.page-numbers li a.prev:before, 
    .woocommerce-pagination ul.page-numbers li span.prev:before,
    .woocommerce-pagination ul.page-numbers li a.next:before, 
    .woocommerce-pagination ul.page-numbers li span.next:before,
    .woocommerce p.stars a:before,
    .woocommerce div.product p.price, .woocommerce div.product span.price,
    .ova_menu ul.dropdown-menu li.active>a,
    .result_search h2.post-title a:hover,
    .post_recommend h3.post-title a:hover,
    .ovacrs_product_filter ul.nav.style2 li .total_items.current

    {
      color: {$main_color};
    }

    .ireca_service:hover i:before,
    .ovacrs_heading2 h3 span,
    .rental_item .content h3.title a:hover,
    .slide_info_2 .price,
    .ovacrs_team .item .name a:hover,
    .ireca_woo_price .amount,
    .ovacrs_price_rent .nav:before,
    .ovacrs_price_rent .nav,
    ul.products li.ireca_product h2.woocommerce-loop-product__title:hover,
    .woocommerce .related.products ul li .star-rating span::before,
    a:hover,
    .slide_info .price,
    .sidebar ul li a:hover,
    article.post-wrap .post-readmore a:hover,
    article.post-wrap .post-meta .post-meta-content .right a:hover,
    article.post-wrap .post-tag a:hover,
    a,
    article.post-wrap h2.post-title a:hover
    
    {
      color: {$second_color};  
    }
    

    .ireca-cart-wrapper .buttons a.button,
    .slide_feature i:before,
    .ireca_service:hover .line,
    .ovacrs_product_filter ul.nav.styl1 li a:hover,
    .ovacrs_product_filter ul.nav.styl1 li a.active,
    .ovacrs_product_filter ul.nav.styl1 li a.current,
    .ovacrs_support .line,
    .ova_blog .content .ova_media .post_date:after,
    .ova_blog .content .read_more:before,
    .ova_blog .view_all .wrap_a .ireca_btn,
    .ovacrs_heading1.border_left_right span:before,
    .ovacrs_heading1.border_left_right span:after,
    .ova_mailchimp .submit,
    .ovacrs_service_full .title,
    .ova_blog.style2 .content .read_more:hover:before,
    .search_slide.home_search .s_submit .wrap_btn button,
    .ireca_wd_search form .s_submit button.submit,
    .woo_rent_top .booking_btn,
    .ovacrs_price_rent .collapse_content .price_table table thead,
    .ireca__product_calendar ul.intruction li .yellow,
    .ireca_booking_form button.submit,
    .request_booking button.submit,
    .woocommerce #review_form #respond .form-submit input,
    .woocommerce .related.products ul li .onsale,
    ul.products li.ireca_product .onsale,
    .woocommerce a.button, .woocommerce button.button,
    .ireca_page_cart .cart-collaterals .cart_totals .wc-proceed-to-checkout a,
    .ireca_page_cart .woocommerce-cart-form table.shop_table tbody tr td button.button:hover,
    #order_review button.button,
    .ovacrs_heading3 h3.title.border_yes span:before,
    .ireca_service_card a:hover,
    .ireca_contact .wpcf7-submit,
    article.post-wrap .post-readmore a:before,
    .ireca_get_in_touch h3,
    .ireca_get_in_touch .fields .wpcf7-submit:hover,
    .footer_default .footer_social ul.ireca_socials li a:hover,
    footer.footer_v2 .social_copyright .footer_social ul.ireca_socials li a:hover,
    #scrollUp
    {
      background-color: {$main_color};
    }

    .ovacrs_product_filter ul.nav li a:hover,
    .ovacrs_product_filter ul.nav li a.active,
    .ova_blog .view_all .wrap_a .ireca_btn,
    .ireca-cart-wrapper .buttons a,
    .ireca-cart-wrapper .buttons a:hover,
    .search_slide.home_search .s_submit .wrap_btn button,
    .ireca_wd_search form .s_submit .wrap_btn:after,
    .ireca_wd_search form .s_submit button.submit,
    .woo_rent_top .booking_btn,
    .woocommerce a.button, .woocommerce button.button,
    .ireca_page_cart .cart-collaterals .cart_totals .wc-proceed-to-checkout a,
    .ireca_page_cart .woocommerce-cart-form table.shop_table tbody tr td button.button:hover,
    #order_review button.button,
    .ireca_service_card a:hover,
    .ireca_contact .wpcf7-submit,
    .ireca_get_in_touch .fields .wpcf7-submit:hover,
    .footer_default .footer_col1 .textwidget a.link_find_map:after
    {
      border-color: {$main_color};
    }

    .ireca_detail_shop .cart .single_add_to_cart_button:hover{
        border-color: {$main_color}!important;   
        background-color: {$main_color}!important;   
    }

    .ovacrs_service_full .title:after{
      border-bottom-color: {$main_color};
    }




    .ireca-cart-wrapper .cart-total .items,
    .ireca-cart-wrapper .buttons a.checkout,
    .header1_home_icon .wrap_icon:before,
    .rental_item .wrap_btn:hover a.btn_price,
    .rental_item .wrap_btn:hover,
    .ovacrs_testimonial.owl-carousel .owl-dots button.owl-dot.active,
    .ova_blog .view_all .wrap_a .ireca_btn:hover,
    .ovacrs_service_full .sub_title,
    .wrap_slide2_nav .content .bg,
    .ovacrs_product_slider .wrap_item .bottom .content .title,
    .ovacrs_product_slider .rental_item .wrap_item .bottom .content .title,
    .rental_item.style4 .ireca_btn:hover,
    .ovacrs_product_filter .owl-carousel .owl-dots button.owl-dot.active,
    .ovacrs_product_slider .item .wrap_item .bottom .content .title,
    .ovacrs_team .owl-dots button.owl-dot.active,
    .ovacrs_heading4 .desc .hight,
    .ovacrs_heading4 .desc .hight:after,
    .search_slide.home_search .s_submit .wrap_btn button:hover,
    .ireca_wd_search form .s_submit button.submit:hover,
    .woo_rent_top .booking_btn:hover,
    .woo_rent_top .video_product:hover,
    
    
    .ireca_booking_form button.submit:hover,
    .request_booking button.submit:hover,
    .woocommerce #review_form #respond .form-submit input:hover,
    .woocommerce a.button:hover, .woocommerce button.button:hover,
    .ireca_page_cart .cart-collaterals .cart_totals .wc-proceed-to-checkout a:hover,
    .ireca_page_cart .woocommerce-cart-form table.shop_table tbody tr td button.button,
    #order_review button.button:hover,
    .ireca_contact .wpcf7-submit:hover,
    .pagination-wrapper .blog_pagination ul.pagination li.active a, .pagination-wrapper .blog_pagination ul.pagination li:hover a,
    .rental_help .ireca_btn:hover,
    .woocommerce .ireca-cart-wrapper .cart-total .items, 
    .ireca-cart-wrapper .cart-total .items,
    .rental_item.style3 .cover_img .button_rent a

    {
      background-color: {$second_color};
    }


    .rental_item .wrap_btn:hover,
    .ireca_detail_shop .cart .single_add_to_cart_button,
    #commentform #submit.submit:hover
    {
     background-color: {$second_color}!important; 
    }

    .rental_item .wrap_btn:hover,
    .ova_blog .view_all .wrap_a .ireca_btn:hover,
    .rental_item.style4 .ireca_btn:hover,
    .ireca-cart-wrapper .buttons a.checkout,
    .ireca-cart-wrapper .buttons a.checkout:hover,
    .search_slide.home_search .s_submit .wrap_btn button:hover,
    .ireca_wd_search form .s_submit button.submit:hover,
    .woo_rent_top .booking_btn:hover,
    .woocommerce a.button:hover, .woocommerce button.button:hover,
    .ireca_page_cart .cart-collaterals .cart_totals .wc-proceed-to-checkout a:hover,
    .ireca_page_cart .woocommerce-cart-form table.shop_table tbody tr td button.button,
    #order_review button.button:hover,
    .ireca_contact .wpcf7-submit:hover,
    .rental_help .ireca_btn:hover,
    .pagination-wrapper .blog_pagination ul.pagination li.active a, 
    .pagination-wrapper .blog_pagination ul.pagination li:hover a
    {
      border-color: {$second_color};
    }

    .ireca_detail_shop .cart .single_add_to_cart_button,
    #commentform #submit.submit:hover{
        border-color: {$second_color}!important;   
    }

    .ovacrs_service_full .sub_title:after
    {
      border-top-color: {$second_color};
    }


    .wrap_slide2_nav .content:before,
    .wrap_slide2_nav .content:after,
    .ovacrs_product_slider .wrap_item .bottom .content .title:before,
    .ovacrs_product_slider .wrap_item .bottom .content .title:after,
    .ovacrs_product_slider .item .wrap_item .bottom .content .title:before,
    .ovacrs_product_slider .item .wrap_item .bottom .content .title:after
    {
      border-bottom-color: {$second_color};
    }

    

    .fc-unthemed td.fc-today{
        background: #f3f3f3;
    }
    @media (max-width: 991.98px){
        .bg_support {     
            background: none!important;   
            background-color: {$second_color}!important;
        }
    }

    @-moz-document url-prefix(){
        .ovatheme_header_version2 nav.navbar::before {
            border-top: 72px solid #343434;
        }
        .ovatheme_header_version2 nav.navbar::after {
          
            border-top: 72px solid #343434;
          
        }
        .ovatheme_header_version3 .ova_menu nav.navbar::before {
            
            border-bottom: 72px solid #2d5685;
            
        }
    }
    .map-info-window .buttons a:hover,
    .map-info-window .caption-title a{
        color: {$main_color};
    }

  ";
  wp_add_inline_style( 'ireca_style', $custom_css );
    
}




/* Google Font */
function ireca_customize_google_fonts() {
    $fonts_url = '';

    $body_font = get_theme_mod('body_font', 'Poppins');
    $heading_font = get_theme_mod('heading_font', 'Teko');
    
    $body_font_c = _x( 'on', $body_font.': on or off', 'ireca');
    $heading_font_c = _x( 'on', $heading_font.': on or off', 'ireca' );

 
    if ( 'off' !== $body_font_c || 'off' !== $heading_font_c ) {
        $font_families = array();
 
        if ( 'off' !== $body_font_c && strpos($body_font,'ovatheme_') === false ) {
            $font_families[] = $body_font.':100,200,300,400,500,600,700,800,900"';
        }
 
        if ( 'off' !== $heading_font_c  && strpos($heading_font,'ovatheme_') === false ) {
            $font_families[] = $heading_font.':100,200,300,400,500,600,700,800,900';
        }
        

        if($font_families != null){
          $query_args = array(
              'family' => urlencode( implode( '|', $font_families ) ),
              'subset' => urlencode( 'latin,latin-ext' ),
          );  
          $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }
        
 
        
    }
 
    return esc_url_raw( $fonts_url );
}






/************************************************************************************************/
/************************************************************************************************/

function ireca_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb; // returns an array with the rgb values
}













