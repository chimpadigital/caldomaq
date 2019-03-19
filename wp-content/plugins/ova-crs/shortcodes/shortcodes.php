<?php if ( !defined( 'ABSPATH' ) ) exit();

add_filter( 'widget_text', 'do_shortcode' );


add_shortcode('ovacrs_info', 'ovacrs_info');
function ovacrs_info($atts, $content = null) {

      $atts = extract( shortcode_atts(
        array(
            'icon'  => '',
            'text'  => '',
            'class'   => '',
        ), $atts) );

    $html = '<span class="ireca_info '.$class.'">';
        $html .= '<i class="'.$icon.'"></i>';
        $html .= '<span class="text">'.$text.'</span>';
    $html .= '</span>';

    return $html;

}

add_shortcode('ovacrs_info2', 'ovacrs_info2');
function ovacrs_info2($atts, $content = null) {

      $atts = extract( shortcode_atts(
        array(
            'icon'  => '',
            'heading' => '',
            'text'  => '',
            'class'   => '',
        ), $atts) );

    $html = '<div class="ireca_info2 d-flex '.$class.'">';
        
        $html .= '<div class="icon">';
        $html .= '<i class="'.$icon.'"></i>';
        $html .= '</div>';
        
        $html .= '<div class="info">';
        $html .= '<span class="heading">'.$heading.'</span>';
        $html .= '<span class="text">'.$text.'</span>';
        $html .= '</div>';
        
    $html .= '</div>';

    return $html;

}


add_shortcode('ovacrs_social', 'ovacrs_social');
function ovacrs_social($atts, $content = null) {

      $atts = extract( shortcode_atts(
        array(
            'class'   => '',
        ), $atts) );

    $html = '<ul class="ireca_socials '.$class.'">';
    	$html .= do_shortcode( $content );
    $html .= '</ul>';

    return $html;

}

add_shortcode('ovacrs_social_item', 'ovacrs_social_item');
function ovacrs_social_item($atts, $content = null) {

      $atts = extract( shortcode_atts(
        array(
            'icon'  => '',
            'link'  => '',
            'name'  => '',
            'class'  => '',
        ), $atts) );

    $html = '<li class="d-inline"><a href="'.$link.'" class="'.$class.'" target="_blank">';
        $html .= $icon != '' ? '<i class="'.$icon.'"></i>' : '';
        $html .= $name != '' ? $name : '';
    $html .= '</a></li>';

    return $html;

}


add_shortcode('ovacrs_mini_cart', 'ovacrs_mini_cart');
function ovacrs_mini_cart($atts, $content = null) {

      $atts = extract( shortcode_atts(
        array(
            'style' => 'style1',
            'class'  => '',
        ), $atts) );
      ob_start();
?>
    <?php if(class_exists('Woocommerce')){ ?>

        <?php if( $style == 'style1' ){ ?>
            <div class="ireca-cart-wrapper  style1">
                <div class="cart-total">
                    <i class="icon_bag_alt"></i>
                    <span class="items">
                        <?php echo (WC()->cart->get_cart_contents_count( ) > 1) ? WC()->cart->get_cart_contents_count( ) : WC()->cart->get_cart_contents_count( ); ?>
                    </span>
                </div>
                <div class="ireca_minicart">
                    <?php woocommerce_mini_cart(); ?>
                </div>
            </div>
        <?php }else if( $style == 'style2' ){ ?>
            
            <div class="ireca-cart-wrapper style2">

                <div class="d-flex">
                    <div class="label">
                        <div class="heading"><?php esc_html_e( 'My Cart', 'ova-crs' ); ?></div>
                        <div class="info"><?php printf( "Your cart is <span>%d</span> item", WC()->cart->get_cart_contents_count(), 'ova-crs'  ); ?>      </div>
                    </div>
                    <div class="cart-total">
                        <i class="icon_bag_alt"></i>
                        <span class="items">
                            <?php echo (WC()->cart->get_cart_contents_count( ) > 1) ? WC()->cart->get_cart_contents_count( ) : WC()->cart->get_cart_contents_count( ); ?>
                        </span>
                    </div>
                </div>
                <div class="ireca_minicart">
                    <?php woocommerce_mini_cart(); ?>
                </div>
            </div>

        <?php }else{ ?>
            <div class="ireca-cart-wrapper style2 style3">

                <div class="d-flex">
                    <div class="label">
                        <div class="info"><?php printf( "Your cart is <span>%d</span> item",  WC()->cart->get_cart_contents_count() , 'ova-crs'  ); ?>      </div>
                    </div>
                    <div class="cart-total">
                        <i class="icon_bag_alt"></i>
                        <span class="items">
                            <?php echo (WC()->cart->get_cart_contents_count( ) > 1) ? WC()->cart->get_cart_contents_count( ) : WC()->cart->get_cart_contents_count( ); ?>
                        </span>
                    </div>
                </div>
                <div class="ireca_minicart">
                    <?php woocommerce_mini_cart(); ?>
                </div>
            </div>
        <?php } ?>

    <?php } ?>
 <?php return ob_get_clean();

}




// Account
add_shortcode('ovacrs_account', 'ovacrs_account');
function ovacrs_account($atts, $content = null) {

      $atts = extract( shortcode_atts(
        array(
            'login_link'  => '',
            'login_text'  => '',
            'register_link'  => '',
            'register_text'  => '',
            'show_slash' => true
        ), $atts) );

    $html = '<div class="ireca_account">';
    if( !is_user_logged_in() ){
        $html .= '<a href="'.$login_link.'">'.$login_text.'</a>';
        $html .= $show_slash ? '<span></span>' : '';
        $html .= '<a href="'.$register_link.'">'.$register_text.'</a>';    
    }else{
        $wp_current_user = wp_get_current_user();
        $html .=   '<a href='.get_edit_user_link().'>'.esc_html('Welcome ', 'ova-crs').$wp_current_user->user_login.'</a>';
    }
    
    $html .= '</div>';

    return $html;

}


// Search Woo
add_shortcode('ovacrs_search_woo', 'ovacrs_search_woo');
function ovacrs_search_woo($atts, $content = null) {

      $atts = extract( shortcode_atts(
        array(
            'class'  => '',
        ), $atts) );
      ob_start();
?>
    <?php if(class_exists('Woocommerce')){ ?>
        <div class="ovacrs_searchwoo">
            <i class="icon_search"></i>
            <form role="search" method="get" class="woocommerce-product-search d-flex <?php echo esc_url($class); ?>" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
                <label class="screen-reader-text"><?php _e( 'Search for:', 'ova-crs' ); ?></label>
                <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'ova-crs' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'ova-crs' ); ?>" />
                <input type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'ova-crs' ); ?>" />
                <input type="hidden" name="post_type" value="product" />
            </form>    
        </div>
        
    <?php } ?>
 <?php return ob_get_clean();

}



// feature

add_shortcode('ovacrs_service', 'ovacrs_service');
function ovacrs_service($atts, $content = null) {

      $atts = extract( shortcode_atts(
        array(
            'icon'  => '',
            'title' => '',
            'title_link' => '',
            'target'    => '_self',
            'show_line' => 'yes',
            'class'  => '',
        ), $atts) );
      
      $html = '<div class="ireca_service '.$class.'">';
        
        $html .= '<i class="'.$icon.'"></i>';
        $html .= '<div class="content">';
            if( $title_link != '' ){
                $html .= $title ? '<h3><a target="'.$target.'" href="'.$title_link.'">'.$title.'</a></h3>' : '';
            }else{
                $html .= $title ? '<h3>'.$title.'</h3>' : '';    
            }
            
            $html .= $content ? '<div class="desc">'.do_shortcode( $content ).'</div>' : '';
            $html .= $show_line == 'yes' ? '<div class="line"></div>': '';
        $html .= '</div>';

      $html .= '</div>';



      return $html;
   

}


// divide

add_shortcode('ovacrs_divide', 'ovacrs_divide');
function ovacrs_divide($atts, $content = null) {

      $atts = extract( shortcode_atts(
        array(
            'img'  => '',
            'class'  => '',
        ), $atts) );

    $img = wp_get_attachment_url( $img, 'full' ) ? wp_get_attachment_url( $img, 'full' ) : '';  
      
    $html = '<div class="ireca_devide '.$class.'">';

        $html .= '<img src="'.$img.'" alt="'.esc_html__( 'logo', 'ova-crs' ).'" />';
        
    $html .= '</div>';



      return $html;
   

}




// Product Filter
add_shortcode('ovacrs_product_filter', 'ovacrs_product_filter');
function ovacrs_product_filter($atts, $content = null) {

      $atts = extract( shortcode_atts(
        array(
            'array_slug'  => '',
            "filters"  => 'rent',
            'order' => 'DESC',
            'orderby' => 'id',
            'tab_active'    => '',
            "show_tab"  => "yes",
            "align_nav" => "justify-content-end",
            "product_style" => 'style1',
            "total_columns_slide"    => '2',
            "total_items_column" => '1',
            "total_items_cat" => "100",
            "butotn_text"   => 'Rent It',
            "show_nav"  => "yes",
            "icon_nav"   => '',
            "auto_slide" => "false",
            "show_thumbnail" => 'yes',
            "show_price" => 'yes',
            "show_time_rental" => "yes",
            "show_title" => 'yes',
            "show_rating_star" => 'yes',
            "show_rating_text" => 'yes',
            "show_feature" => 'yes',
            'class'  => '',

        ), $atts) );

       

        $categories = get_categories( 
                array(
                'type'                     => 'product',
                'child_of'                 => 0,
                'parent'                   => '',
                'orderby'                  => 'name',
                'order'                    => 'ASC',
                'hide_empty'               => 1,
                'hierarchical'             => 1,
                'exclude'                  => '',
                'include'                  => '',
                'number'                   => '',
                'taxonomy'                 => 'product_cat',
                'pad_counts'               => false 

              )
         );


        $array_slug = explode( ',', trim( $array_slug ) );

    
      
    $html = '<div class="woocommerce ovacrs_product_filter '.$class.'">';

        // Nav
        if( $show_tab == 'yes' ){
            $html .= '<ul class="nav nav-pills '.$align_nav.'" id="pills-tab" role="tablist">';

                    for( $i=0; $i < count($array_slug); $i++ ){

                      foreach ($categories as $key => $cat) {

                        if(trim( $array_slug[$i] ) == $cat->slug){

                            $item_active = ($cat->slug == $tab_active) ? ' active ':'';
                            $html .= '<li class="nav-item '.$cat->slug.' ">
                                        <a class="nav-link '.$item_active.'" id="'.$cat->slug.'-tab" data-toggle="pill" href="#'.$cat->slug.'" role="tab" aria-controls="'.$cat->slug.'" aria-selected="true">'.$cat->name.'</a>
                                    </li>';

                        }

                      }

                    }
            $html .= '</ul>';
        }

        // Content
        $html .= '<div class="tab-content" id="pills-tabContent">';

                for( $i=0; $i < count($array_slug); $i++ ){

                    foreach ($categories as $key => $cat) {

                        if(trim( $array_slug[$i] ) == $cat->slug){

                            $item_active = ($cat->slug == $tab_active) ? ' show active ':'';

                            

                            $html .= '<div class="tab-pane fade '.$item_active.'" id="'.$cat->slug.'" role="tabpanel" aria-labelledby="'.$cat->slug.'-tab">';

                                $args_basic = array(
                                    'post_type' => 'product',
                                    'post_status' => 'publish',
                                    'posts_per_page' => $total_items_cat,
                                    'order' => $order
                                );

                                
                                if( $orderby == 'id' ){

                                    $args_orderby = array( 'orderby' => 'id' );

                                }else if ( $orderby == 'order' ){

                                    $args_orderby = array( 'orderby' => 'meta_value_num', 'meta_key' => 'ovacrs_car_order' );

                                }else if( $orderby == 'total_sales' ){

                                    $args_orderby = array( 'orderby' => 'meta_value_num', 'meta_key' => 'total_sales' );

                                }else if( $orderby == 'rating' ){
                                    $args_orderby = array( 'orderby' => 'meta_value_num', 'meta_key' => '_wc_average_rating' );                                    
                                }

                                 

                                

                                if( $filters == 'rent' ){

                                    $args_filters = array(
                                        'tax_query' => array(
                                            'relation' => 'AND',
                                            array(
                                                'taxonomy' => 'product_cat',
                                                'field'    => 'slug',
                                                'terms'    => $cat->slug,
                                            ),
                                            array(
                                                'taxonomy' => 'product_type',
                                                'field'    => 'slug',
                                                'terms'    => 'ovacrs_car_rental'
                                            )
                                        ),

                                    );

                                }else if( $filters == 'sell' ){

                                    $args_filters = array(
                                        'tax_query' => array(
                                            'relation' => 'AND',
                                            array(
                                                'taxonomy' => 'product_cat',
                                                'field'    => 'slug',
                                                'terms'    => $cat->slug,
                                            ),
                                            array(
                                                'taxonomy' => 'product_type',
                                                'field'    => 'slug',
                                                'terms'    => 'ovacrs_car_rental',
                                                'operator' => 'NOT IN', 
                                            )
                                        ),

                                    );

                                }else{

                                    $args_filters = array(
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'product_cat',
                                                'field'    => 'slug',
                                                'terms'    => $cat->slug,
                                            )
                                        ),

                                    );
                                }


                                $args_product = array_merge_recursive( $args_basic, $args_orderby, $args_filters );

                                $ireca_products = new WP_Query($args_product);


                                    // Navigation Top
                                    if( $show_nav == 'yes' && ( $ireca_products->post_count > $total_items_column * $total_columns_slide ) ){
                                        $html .= '<div class="wrap_nav top d-block d-lg-none"><div class="ireca_nav">
                                                    <a class="carousel-control-prev" href="#carousel'.$cat->slug.'" role="button" data-slide="prev">
                                                        <i class="fas fa-caret-left"></i>
                                                    </a>
                                                    <div class="icon_nav">
                                                        <i class="'.$icon_nav.'"></i>
                                                        <span>'.esc_html__('Available', 'ova-crs').' <strong class="total_items">'.$ireca_products->post_count.'</strong> '.esc_html__('items', 'ova-crs').'</span>
                                                    </div>
                                                    
                                                    <a class="carousel-control-next" href="#carousel'.$cat->slug.'" role="button" data-slide="next">
                                                        <i class="fas fa-caret-right"></i>
                                                    </a>
                                            </div></div>';
                                    }


                               

                                $html .= '<div class="owl-carousel owl-theme '.$cat->slug.'" data-total_columns_slide="'.$total_columns_slide.'">';
                                  
                                    

                                    $group_slide = $t_items_cat = 1;
                                      
                                      if( $ireca_products->have_posts() ): while( $ireca_products->have_posts() ):  $ireca_products->the_post();

                                            global $product;


                                            $img  = wp_get_attachment_image_url( get_post_thumbnail_id(), 'large' );

                                            $rating_count = $product->get_rating_count();
                                            $review_count = $product->get_review_count();
                                            $average      = $product->get_average_rating();

                                                if( $group_slide == $total_items_column + 1 ){ $group_slide = 1; }
                                                if( $group_slide == 1 ){
                                                    $html .= '<div class="group_slide">';
                                                }

                                                    if( $product_style == 'style1' ){

                                                        $html .= '<div class="item '.$product_style.'">';

                                                            $html .= '<div class="wrap_img">';
                                                                       $html .= ( $show_thumbnail == 'yes' ) ? '<img src="'.$img.'" alt="'.get_the_title().'">' : '';
                                                                       $class_make_top = ( $show_thumbnail == 'yes' ) ? 'bottom':'no_margin';
                                                                       
                                                                       $html .= '<div class="'.$class_make_top.'">';
                                                                            
                                                                            if( $show_price == 'yes' ){

                                                                                $is_produc_type = $product->is_type('ovacrs_car_rental') ? true : false ;

                                                                                $html .= '<div class="wrap_btn">
                                                                                    <a href="'.get_the_permalink().'" class="ireca_btn  btn_tran dashed btn_white btn_price"><span class="wrap_content">';
                                                                                        if( ovacrs_get_price_type( get_the_id() ) == 'days' ){
                                                                                            $html .= '<span class="amount">'.ovacrs_get_price_day( get_the_id() ).'</span>';
                                                                                            $html .= ( $show_time_rental == 'yes' && $is_produc_type ) ? '<span class="time">'.esc_html__( '/ Day', 'ova-crs' ).'</span>' : '';
                                                                                        }else if( ovacrs_get_price_type( get_the_id() ) == 'hours' ){
                                                                                            $html .= '<span class="amount">'.ovacrs_get_price_hour( get_the_id() ).'</span>';
                                                                                            $html .= ( $show_time_rental == 'yes' && $is_produc_type ) ? '<span class="time">'.esc_html__( '/ Hour', 'ova-crs' ).'</span>' : '';
                                                                                        }else{
                                                                                            $html .= '<span class="amount">'.ovacrs_get_price_day( get_the_id() ).'</span>';
                                                                                            $html .= ( $show_time_rental == 'yes' && $is_produc_type ) ? '<span class="time">'.esc_html__( '/ Day', 'ova-crs' ).'</span>' : '';
                                                                                        }
                                                                                        
                                                                                        $html .= '<span class="text">'.$butotn_text.'</span>
                                                                                    </span></a>
                                                                                </div>';
                                                                            }

                                                                        $html .= '</div>

                                                                    </div>'; // /wrap_img
                                                                    
                                                                    $show_price_no = ( $show_price == 'no' ) ? 'show_price_no' : '';

                                                            $html .= '<div class="content '.$show_price_no.'">';

                                                                $html .= ( $show_title == 'yes' ) ? '<h3 class="title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>' : '';


                                                                $html .= '<div class="woocommerce-product-rating">';

                                                                    if( $show_rating_star == 'yes' ){
                                                                        $html .= wc_get_rating_html( $average, $rating_count );    
                                                                    }
                                                                    

                                                                    if( comments_open() && $show_rating_text == 'yes' ){
                                                                        $html .= '<span class="count">'.$review_count.'</span>'.esc_html__( ' reviews', 'ova-crs' );  
                                                                    }

                                                                $html .= '</div>';

                                                                if( $show_feature == 'yes' ){
                                                                    $html .= '<div class="features"><div class="container-fluid"><div class="row">';

                                                                            $features = get_post_meta( get_the_id(), 'ovacrs_features_special', true );
                                                                            $icon = get_post_meta( get_the_id(), 'ovacrs_features_icons', true );
                                                                            $desc = get_post_meta( get_the_id(), 'ovacrs_features_desc', true );
                                                                            $d = 0;
                                                                            if( $features ){
                                                                                foreach ($features as $key => $value) {
                                                                                    if( $value == 'yes' && trim( $desc[$key] ) != '' && trim( $icon[$key] ) != '' ){
                                                                                        $class = ($d%2) ? 'eve' : 'odd';
                                                                                        $html .= '<div class="col-md-6 feature-item '.$class.'">';
                                                                                            $html .= '<i class="'.$icon[$key].'"></i>';
                                                                                            $html .= '<span class="desc">'.$desc[$key].'</span>';
                                                                                        $html .= '</div>';
                                                                                        $d++;
                                                                                    }
                                                                                }
                                                                            }
                                                                            
                                                                    $html .= '</div></div></div>'; // /row // container-fluid
                                                                }

                                                            $html .= '</div>'; // /content

                                                        $html .= '</div>'; // /item

                                                    }else if( $product_style == 'style2' ){

                                                    }




                                                if( $group_slide == $total_items_column  || $t_items_cat == $ireca_products->post_count ){        
                                                    $html .= '</div>'; // /Slide
                                                }

                                         
                                            $group_slide++;
                                            $t_items_cat++;

                                        endwhile; endif; wp_reset_postdata();



                                
                                    $html .= '</div>'; // /owl-carousel

                                if( $show_nav == 'yes' && ( $ireca_products->post_count > $total_items_column * $total_columns_slide ) ){
                                     $html .= '<div class="wrap_nav"><div class="ireca_nav">
                                                <a class="carousel-control-prev" href="#carousel'.$cat->slug.'" role="button" data-slide="prev">
                                                    <i class="fas fa-caret-left"></i>
                                                </a>
                                                <div class="icon_nav">
                                                    <i class="'.$icon_nav.'"></i>
                                                    <span>'.esc_html__('Available', 'ova-crs').' <strong class="total_items">'.$ireca_products->post_count.'</strong> '.esc_html__('items', 'ova-crs').'</span>

                                                </div>
                                                
                                                <a class="carousel-control-next" href="#carousel'.$cat->slug.'" role="button" data-slide="next">
                                                    <i class="fas fa-caret-right"></i>
                                                </a>
                                        </div></div>';
                                }

                                
                            $html .= '</div>'; // tab-pane

                            

                           

                        } // End if   
                    } //End Foreach
                }   // End for
                
        $html .= '</div>'; // /tab-content


        
    $html .= '</div>'; // .ovacrs_product_filter



    return $html;
   

}



// Heading 1

add_shortcode('ovacrs_heading1', 'ovacrs_heading1');
function ovacrs_heading1($atts, $content = null) {

      $atts = extract( shortcode_atts(
        array(
            'title'  => '',
            'style' => 'style1',
            'class'  => '',
        ), $atts) );

    $fix_style2 = ( $style == 'style2' ) ? 'd-flex justify-content-between' : '';
      
    $html = '<div class="ovacrs_heading1 '.$class.' '.$style.' '.$fix_style2.'">';

        $html .= '<h3 class="title">'.$title.'</h3>';
        $html .= '<div class="desc">'.do_shortcode( $content ).'</div>';
        
    $html .= '</div>';



      return $html;
   

}



add_shortcode('ovacrs_heading2', 'ovacrs_heading2');
function ovacrs_heading2($atts, $content = null) {

      $atts = extract( shortcode_atts(
        array(
            'title'  => '',
            'highlight_title'  => '',
            'highlight_icon'    => '',
            'class'  => '',
        ), $atts) );

    
      
    $html = '<div class="ovacrs_heading2 '.$class.'">';

        $html .= $title ? '<h3 class="title">'.$title.'<span>'.$highlight_title.'<i class="'.$highlight_icon.'"></i></span></h3>' : '';
        $html .= '<div class="desc">'.do_shortcode( $content ).'</div>';
        
    $html .= '</div>';



      return $html;
   

}



add_shortcode('ovacrs_support', 'ovacrs_support');
function ovacrs_support($atts, $content = null) {

      $atts = extract( shortcode_atts(
        array(
            'title'  => '',
            'show_line'  => 'yes',
            'text_color' => 'dark',
            'class'  => '',
        ), $atts) );

    
      
    $html = '<div class="ovacrs_support '.$class.' '.$text_color.'">';

        $html .= $title ? '<h3 class="title">'.$title.'</h3>' : '';
        $html .= $content ? '<div class="desc">'.do_shortcode( $content ).'</div>' : '';

        $html .= $show_line == 'yes' ? '<span class="line"></span>' : '';
    
    $html .= '</div>';



      return $html;
   

}

add_shortcode('ovacrs_btn_action', 'ovacrs_btn_action');
function ovacrs_btn_action($atts, $content = null) {

      $atts = extract( shortcode_atts(
        array(
            'title'  => '',
            'btn_text' => '',
            'btn_link' => '',
            'btn_target' => '',
            'text_color' => 'dark',
            'class'  => '',
        ), $atts) );

    
      
    $html = '<div class="ovacrs_btn_action '.$class.' '.$text_color.'">';

        $html .= $title ? '<h3 class="title">'.$title.'</h3>' : '';
        $html .= $content ? '<div class="desc">'.do_shortcode( $content ).'</div>' : '';

        $html .= $btn_text ? '<a class="ireca_btn btn_tran" href="'.$btn_link.'" target="'.$btn_target.'">'.$btn_text.'</a>' : '';
    
    $html .= '</div>';



      return $html;
   

}

add_shortcode('ovacrs_why', 'ovacrs_why');
function ovacrs_why($atts, $content = null) {

      $atts = extract( shortcode_atts(
        array(
            'number'  => '',
            'title' => '',
            'link'  => '',
            'target' => '',
            'class'  => '',
        ), $atts) );
    
      
    $html = '<div class="ovacrs_why '.$class.'">';

        $html .= '<span class="number">'.$number.'</span>';

        $html .= '<div class="content">';

            if( $link != '' ){
                $html .= $title ? '<h3 class="title"><a href="'.$link.'" target="'.$target.'">'.$title.'</a></h3>' : '';
            }else{
                $html .= $title ? '<h3 class="title">'.$title.'</h3>' : '';
            }

            $html .= $content ? '<div class="desc">'.do_shortcode( $content ).'</div>' : '';

        $html .= '</div>';
    
    $html .= '</div>';



    return $html;
   

}




add_shortcode('ovacrs_testimonial', 'ovacrs_testimonial');
function ovacrs_testimonial($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'count'  => '2',
      'auto_slider' => 'true',
      'duration'    => '3000',
      'pagination'  => 'true',
      'loop'        => 'true',
      'class' => '',
    ), $atts) );

    

    $html = '<div class="ovacrs_testimonial owl-carousel '.$class.'" data-loop="'.$loop.'" data-auto_slider="'.$auto_slider.'" data-duration="'.$duration.'" data-pagination="'.$pagination.'" data-count="'.$count.'">';

       $html .= do_shortcode( $content );
      
    $html .= '</div>';
    
    return $html;
}

add_shortcode('ovacrs_testimonial_item', 'ovacrs_testimonial_item');
function ovacrs_testimonial_item($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'image'  => '',
      'name'  => '',
      'job'  => '',
      'desc'  => '',
      
      'class' => '',
    ), $atts) );

    $image = wp_get_attachment_url( $image, 'full' ) ? wp_get_attachment_url( $image, 'full' ) : '';
    

    $html = '<div class="item '.$class.'">';

       $html .= '<div class="desc">'.$desc.'</div>';

       $html .= '<div class="author">';

        $html .= '<img src="'.$image.'" alt="'.$name.'">';

        $html .= '<div class="info">';
          $html .= '<div class="name">'.$name.'</div>';
          $html .= '<div class="job">'.$job.'</div>';
        $html .= '</div>'; 

       $html .= '</div>';
      
    $html .= '</div>';
    
    return $html;
}

add_shortcode('ovacrs_thumbnail_info', 'ovacrs_thumbnail_info');
function ovacrs_thumbnail_info($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'image'  => '',
      'title'  => '',
      'icon'  => '',
      'link'  => '',
      'target'  => '_self',
      'class' => '',
    ), $atts) );

    $image = wp_get_attachment_url( $image, 'full' ) ? wp_get_attachment_url( $image, 'full' ) : '';
    

    $html = '<div class="ovacrs_thumbnail_info '.$class.'" style="background: url( '.$image.' )">';

       

       $html .= '<div class="content">';

          if( $link != '' ){
            $html .= '<div class="title"><a href="'.$link.'" target="'.$target.'">'.$title.'</a></div>';
          }else{
            $html .= '<div class="title">'.$title.'</div>';  
          }
          
          $html .= '<div class="thum_bottom">';
              $html .= '<div class="desc">'.do_shortcode( $content ).'</div>';
              $html .= $icon ? '<div class="icon"><a href="'.$link.'"  target="'.$target.'">
                                <i class="'.$icon.'"></i></a></div>' : '';
          $html .= '</div>';
          

       $html .= '</div>';
      
    $html .= '</div>';
    
    return $html;
}

add_shortcode('ovacrs_help', 'ovacrs_help');
function ovacrs_help($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'label'  => '',
      'phone'  => '',
      'mail'  => '',
      'btn_text'  => '',
      'btn_link'  => '',
      'target'  => '_self',
      'class' => '',
    ), $atts) );

    $html = '<div class="rental_help">';
        $html .= '<label>'.$label.'</label>';

        $html .= '<div class="wrap_phone">';
            $html .= str_replace( '}', '</div>', str_replace('{', '<div class="phone">', $phone ) );
        $html .= '</div>';

        $html .= '<div class="wrap_mail">';
            $html .= str_replace( '}', '</div>', str_replace('{', '<div class="mail">', $mail ) );
        $html .= '</div>';

        $html .= '<a href="'.$btn_link.'" target="'.$target.'" class="ireca_btn btn_tran">'.$btn_text.'</a>';

    $html .= '</div>';
    
    return $html;
}





add_shortcode( 'ovacrs_search', 'ovacrs_search' );
function ovacrs_search( $atts, $content = null ){

    $atts = extract( shortcode_atts(
    array(
        'show_pickup_loc' => '',
        'show_dropoff_loc' => '',
        'show_pickup_date' => '',
        'show_dropoff_date' => '',
        'show_cat' => '',
        'show_type' => '',
        'pickup_loc_required' => '',
        'dropoff_loc_required' => '',
        'pickup_date_required' => '',
        'dropoff_date_required' => '',
        'category_required' => '',
        'type_required' => '',
        'dateformat' => '',
        'hour_default'  => '',
        'time_step' => '',
        'class'   => '',
    ), $atts) );

    $show_pickup_loc = $show_pickup_loc == '' ? get_theme_mod( 'rl_search_show_pickup_loc', 'false' ) : $show_pickup_loc;
    $show_dropoff_loc = $show_dropoff_loc == '' ? get_theme_mod( 'rl_search_show_pickoff_loc', 'false' ) : $show_dropoff_loc;
    $show_pickup_date = $show_pickup_date == '' ? get_theme_mod( 'rl_search_show_pickup_date', 'true' ) : $show_pickup_date;
    $show_dropoff_date = $show_dropoff_date == '' ? get_theme_mod( 'rl_search_show_pickoff_date', 'true' ) : $show_dropoff_date;
    $show_cat = $show_cat == '' ? get_theme_mod( 'rl_search_show_cat', 'true' ) : $show_cat;
    $show_type = $show_type == '' ? get_theme_mod( 'rl_search_show_type', 'true' ) : $show_type;
    
    if( $pickup_loc_required == '' ){
        $pickup_loc_required = get_theme_mod( 'rl_search_pickup_loc_r', 'false' ) == 'true' ? 'required' : '';
    }
    
    if( $dropoff_loc_required == '' ){
        $dropoff_loc_required = get_theme_mod( 'rl_search_pickoff_loc_r', 'false' ) == 'true' ? 'required' : '';
    }
    if( $pickup_date_required == '' ){
        $pickup_date_required = get_theme_mod( 'rl_search_pickup_date_r', 'true' ) == 'true' ? 'required' : '';    
    }
    
    if( $dropoff_date_required == '' ){
        $dropoff_date_required = get_theme_mod( 'rl_search_pickoff_date_r', 'true' ) == 'true' ? 'required' : '';
    }

    if( $category_required == '' ){
        $category_required = get_theme_mod( 'rl_search_cat_r', 'false' ) == 'true' ? 'required' : '';
    }

    if( $type_required == '' ){
        $type_required = get_theme_mod( 'rl_search_type_r', 'false' ) == 'true' ? 'required' : '';
    }

    $pickup_loc = isset( $_GET["ovacrs_pickup_loc"] ) ? $_GET["ovacrs_pickup_loc"] : '';
    $pickoff_loc = isset( $_GET["ovacrs_pickoff_loc"] ) ? $_GET["ovacrs_pickoff_loc"] : '';
    $pickup_date = isset( $_GET["ovacrs_pickup_date"] ) ? $_GET["ovacrs_pickup_date"] : '';
    $pickoff_date = isset( $_GET["ovacrs_pickoff_date"] ) ? $_GET["ovacrs_pickoff_date"] : '';
    $cat = isset( $_GET["cat"] ) ? $_GET["cat"] : '';
    $product_type = isset( $_GET["product_type"] ) ? $_GET["product_type"] : '';

    
    

    $dateformat = $dateformat == '' ? get_theme_mod( 'rl_bf_dateformat', 'Y-m-d H:i A' ) : $dateformat;
    $hour_default = $hour_default == '' ? get_theme_mod( 'rl_bf_hour_default', '09:00' ) : $hour_default;
    $time_step = $time_step == '' ? get_theme_mod( 'rl_bf_time_step', '30' ) : $time_step;

    $cat_ids = get_theme_mod( 'rl_search_remove_cat', '' );
    $type_ids = get_theme_mod( 'rl_search_remove_type', '' );

    $html = '<form action="'.home_url('/').'" class="'.$class.' ovacrs_search row" method="get" enctype="multipart/form-data" data-mesg_required="'.esc_html__( 'This field is required.', 'ova-crs' ).'">
            <div class="wrap_content">';


                $html .= ($show_pickup_loc == 'true') ? '<div class="s_field col">
                    <label>'.esc_html__( 'Pick-up Location', 'ova-crs' ).'</label>
                    '.ovacrs_get_locations_html( $class = 'ovacrs_pickup_loc', $required = $pickup_loc_required, $seleted = $pickup_loc ).'
                </div>' : '';
                
                $html .= ($show_dropoff_loc == 'true') ? '<div class="s_field col">
                    <label>'. esc_html__( 'Drop-off Location', 'ova-crs' ) .'</label>
                    '.ovacrs_get_locations_html( $class = 'ovacrs_pickoff_loc', $required = $dropoff_loc_required, $seleted = $pickoff_loc ).'
                </div>' : '';
                
                $html .= ($show_pickup_date == 'true') ? '<div class="s_field col">
                    <label>'. esc_html__( 'Pick-up Date', 'ova-crs' ) .'</label>
                    <input type="text" name="ovacrs_pickup_date" value="'.$pickup_date.'" onkeydown="return false" class="'.$pickup_date_required.' ovacrs_datetimepicker" placeholder="'.esc_html__( 'Pick-up Date', 'ova-crs' ).'"  autocomplete="off" data-hour_default="'.esc_attr( $hour_default ).'" data-time_step="'.esc_attr( $time_step ).'" data-dateformat="'.esc_attr( $dateformat ).'" />
                </div>' : '';
                
                $html .= ($show_dropoff_date == 'true') ? '<div class="s_field col">
                    <label>'. esc_html__( 'Drop-off Date', 'ova-crs' ) .'</label>
                    <input type="text" name="ovacrs_pickoff_date" value="'.$pickoff_date.'" onkeydown="return false" class="'.$dropoff_date_required.' ovacrs_datetimepicker" placeholder="'.esc_html__( 'Pick-off Date', 'ova-crs' ).'"  autocomplete="off" data-hour_default="'.esc_attr( $hour_default ).'" data-time_step="'.esc_attr( $time_step ).'" data-dateformat="'.esc_attr( $dateformat ).'"/>
                </div>' : '';


                $html .= ($show_cat == 'true') ? '<div class="s_field col">
                    <label>'.esc_html__( 'Category', 'ova-crs' ).'</label>
                    '.ovacrs_cat_rental( $cat, $required = $category_required, $cat_ids ).'</div>' : '';
                
                
                $html .= ($show_type == 'true') ? '<div class="s_field col">
                    <label>'.esc_html__( 'Type', 'ova-crs' ).'</label>
                    '.ovacrs_type_rental( $product_type, $required = $type_required, $type_ids ).'</div>' : '';

            $html .= '</div>    
            <div class="s_submit">
                    <input type="hidden" name="ovacrs_search" value="search_item" />
                    <input type="hidden" name="post_type" value="product" />
                    <div class="wrap_btn">
                        <span class="wrap_btn_2">
                            <button class="ireca_btn btn_tran submit" type="submit">'.esc_html__( 'Find Our More', 'ova-crs ' ).'</button>
                        </span>
                        
                    </div>
            </div>
            

            </form>
            ';
            return $html;
}


add_shortcode('ovacrs_list_cat', 'ovacrs_list_cat');
function ovacrs_list_cat($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'child_of' => 0,
      'depth'   => 0,
      'exclude'  => '',
      'show_count' => 1,
      'hide_empty' => 0,
      'class' => '',
    ), $atts) );

     $args = array(
        'child_of'            => $child_of,
        'current_category'    => 0,
        'depth'               => $depth,
        'echo'                => 0,
        'exclude'             => $exclude,
        'exclude_tree'        => '',
        'feed'                => '',
        'feed_image'          => '',
        'feed_type'           => '',
        'hide_empty'          => $hide_empty,
        'hide_title_if_empty' => false,
        'hierarchical'        => true,
        'order'               => 'ASC',
        'orderby'             => 'name',
        'separator'           => '<br />',
        'show_count'          => $show_count,
        'show_option_all'     => '',
        'show_option_none'    => __( 'No categories' ),
        'style'               => 'list',
        'taxonomy'            => 'product_cat',
        'title_li'            => '',
        'use_desc_for_title'  => 1,
    );

    $html = '<ul class="rental_list '.$class.'">';
        $html .= wp_list_categories($args);
    $html .= '</ul>';

    return $html;
    
    
}



add_shortcode('ovacrs_working_hour', 'ovacrs_working_hour');
function ovacrs_working_hour($atts, $content = null) {

    $atts = extract( shortcode_atts(
    array(
      'title' => '',
      'desc'   => '',
      'class' => '',
    ), $atts) );

    
    $html = '<div class="ovacrs_working_hour '.$class.'">';
        $html .= '<div class="title">'.$title.'</div>';
        $html .= '<div class="desc">'.$desc.'</div>';
    $html .= '</div>';

    return $html;
    
    
}









