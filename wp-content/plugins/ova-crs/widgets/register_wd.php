<?php 
if ( !defined( 'ABSPATH' ) ) exit();

add_action( 'widgets_init', 'ovacrs_widgets_init' );
function ovacrs_widgets_init() {
  
  $header1_top_left = array(
    'name' => esc_html__( 'Header 1 Top Left', 'ova-crs'),
    'id' => "header1_top_left",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => "</h4>",
  );
  register_sidebar( $header1_top_left );

  $header1_top_center = array(
    'name' => esc_html__( 'Header 1 Top Center', 'ova-crs'),
    'id' => "header1_top_center",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => "</h4>",
  );
  register_sidebar( $header1_top_center );


  $header1_top_right = array(
    'name' => esc_html__( 'Header 1 Top Right', 'ova-crs'),
    'id' => "header1_top_right",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $header1_top_right );


  $header1_beside_logo = array(
    'name' => esc_html__( 'Header 1 Beside Logo', 'ova-crs'),
    'id' => "header1_beside_logo",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $header1_beside_logo );

  $header1_cart_icon = array(
    'name' => esc_html__( 'Header 1 Cart', 'ova-crs'),
    'id' => "header1_cart_icon",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $header1_cart_icon );

  $header1_home_icon = array(
    'name' => esc_html__( 'Header 1 home icon', 'ova-crs'),
    'id' => "header1_home_icon",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $header1_home_icon );

  $header1_search = array(
    'name' => esc_html__( 'Header 1 Search', 'ova-crs'),
    'id' => "header1_search",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $header1_search );



  $header2_left_logo = array(
    'name' => esc_html__( 'Header 2 Left Logo', 'ova-crs'),
    'id' => "header2_left_logo",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $header2_left_logo );

  $header2_right_logo = array(
    'name' => esc_html__( 'Header 2 Right Logo', 'ova-crs'),
    'id' => "header2_right_logo",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $header2_right_logo );


  $header3_info = array(
    'name' => esc_html__( 'Header 3 Info', 'ova-crs'),
    'id' => "header3_info",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $header3_info );

  $header3_cart = array(
    'name' => esc_html__( 'Header 3 Cart', 'ova-crs'),
    'id' => "header3_cart",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $header3_cart );

  $header3_search = array(
    'name' => esc_html__( 'Header 3 Search', 'ova-crs'),
    'id' => "header3_search",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $header3_search );


  $header4_phone = array(
    'name' => esc_html__( 'Header 4 Phone', 'ova-crs'),
    'id' => "header4_phone",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $header4_phone );


  $header4_social = array(
    'name' => esc_html__( 'Header 4 Social', 'ova-crs'),
    'id' => "header4_social",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $header4_social );


  $header4_cart = array(
    'name' => esc_html__( 'Header 4 cart', 'ova-crs'),
    'id' => "header4_cart",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $header4_cart );


  $header_d_t_left = array(
    'name' => esc_html__( 'Header Default Top Left', 'ova-crs'),
    'id' => "header_d_t_left",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $header_d_t_left );

  $header_d_t_right = array(
    'name' => esc_html__( 'Header Default Top Right', 'ova-crs'),
    'id' => "header_d_t_right",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $header_d_t_right );

  $header_d_t_cart = array(
    'name' => esc_html__( 'Header Default Cart', 'ova-crs'),
    'id' => "header_d_t_cart",
    'class' => '',
    'before_widget' => '<div class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $header_d_t_cart );

  




  $args_woo = array(
    'name' => esc_html__( 'Woocommerce Sidebar', 'ova-crs'),
    'id' => "woo-sidebar",
    'description' => esc_html__( 'Woocommerce Sidebar', 'ova-crs' ),
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget woo_widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $args_woo );


  $args_woo = array(
    'name' => esc_html__( 'Rental Sidebar', 'ova-crs'),
    'id' => "rental-sidebar",
    'description' => esc_html__( 'Rental Sidebar', 'ova-crs' ),
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget woo_widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $args_woo );


  $args_woo = array(
    'name' => esc_html__( 'FAQ Sidebar', 'ova-crs'),
    'id' => "faq-sidebar",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget faq-widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $args_woo );




$footer_info = array(
    'name' => esc_html__( 'Footer Info', 'ova-crs'),
    'id' => "footer_info",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget  %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="footer-widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $footer_info );

  $footer_col1 = array(
    'name' => esc_html__( 'Footer Column 1', 'ova-crs'),
    'id' => "footer_col1",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget  %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="footer-widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $footer_col1 );

  $footer_col2 = array(
    'name' => esc_html__( 'Footer Column 2', 'ova-crs'),
    'id' => "footer_col2",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget  %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="footer-widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $footer_col2 );

  $footer_col3 = array(
    'name' => esc_html__( 'Footer Column 3', 'ova-crs'),
    'id' => "footer_col3",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget  %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="footer-widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $footer_col3 );

  $footer_col4 = array(
    'name' => esc_html__( 'Footer Column 4', 'ova-crs'),
    'id' => "footer_col4",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget  %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="footer-widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $footer_col4 );

  $footer_social = array(
    'name' => esc_html__( 'Footer Social', 'ova-crs'),
    'id' => "footer_social",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget  %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="footer-widget-title" >',
    'after_title' => "</h4>",
  );
  register_sidebar( $footer_social );

  $args_woo = array(
    'name' => esc_html__( 'Woocommerce Sidebar', 'ireca'),
    'id' => "woo-sidebar",
    'description' => esc_html__( 'Woocommerce Sidebar', 'ireca' ),
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget woo_widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => "</h4>",
  );
  register_sidebar( $args_woo );

  

}

