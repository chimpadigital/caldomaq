<?php

// Get all file name in header
if( !function_exists( 'ireca_load_header' )):
function ireca_load_header(){
	$files = array(
        'default' => esc_html__("default","ireca"), 
        'version1' => esc_html__("version1","ireca"),
        'version2' => esc_html__("version2","ireca"),
        'version3' => esc_html__("version3","ireca"),
        'version4' => esc_html__("version4","ireca")
    );
	return $files;
}
endif;

// Set header in metabox default
if( !function_exists( 'ireca_load_header_metabox' )):
function ireca_load_header_metabox(){
    $files = array(
        'global' => esc_html__("Global in Customizer","ireca") ,
        'default' => esc_html__("default","ireca" ),
        'version1' => esc_html__("version1","ireca"),
        'version2' => esc_html__("version2","ireca"),
        'version3' => esc_html__("version3","ireca"),
        'version4' => esc_html__("version4","ireca"),
    );
    return $files;
}
endif;




// Get all file name in footer
if( !function_exists( 'ireca_load_footer' )):
function ireca_load_footer(){
	$files = array(
        'default' => esc_html__("default","ireca"),
        'version1' => esc_html__("version1", "ireca"),
        'version2' => esc_html__("version2","ireca")
    );
	return $files;
}
endif;

// Set footer in metabox default
if( !function_exists( 'ireca_load_footer_metabox' )):
function ireca_load_footer_metabox(){
    $files = array(
        'global' => esc_html__("Global in Customizer","ireca"),
        'default' => esc_html__("default","ireca"),
        'version1' => esc_html__("version1","ireca"),
        'version2' => esc_html__("version2","ireca")
    );
    return $files;
}
endif;



/********************************************************************/
/********************************************************************/
// Get current header
if( !function_exists( 'ireca_get_current_header' )):
function ireca_get_current_header(){

    // Get header from Post / Page setting
    $current_id = ireca_get_current_id();

	// Get header default from customizer
	$customizer_header = get_theme_mod('header_version','default');
    $meta_header = get_post_meta($current_id,'ireca_met_header_version', 'true');

  	$header = ( $current_id != '' && $meta_header != 'global' && $meta_header != '' ) ? $meta_header : $customizer_header;
	return $header;
}
endif;

// Get current footer
if( !function_exists( 'ireca_get_current_footer' )):
function ireca_get_current_footer(){

    // Get footer from Post / Page setting
    $current_id = ireca_get_current_id();

	// Get header default from customizer
	$customizer_footer = get_theme_mod('footer_version','default');
    $meta_footer =  get_post_meta($current_id,'ireca_met_footer_version', 'true');
	
  	$footer = ( $current_id != '' && $meta_footer != 'global'  && $meta_footer != '' ) ? $meta_footer : $customizer_footer;
	
    return $footer;
}
endif;


// Get current main layout
if( !function_exists( 'ireca_get_current_main_layout' )):
function ireca_get_current_main_layout(){

    // Get mainlayout from Post / Page setting
    $current_id = ireca_get_current_id();

    // Get header default from customizer
    $customizer_main_layout = get_theme_mod('main_layout','right_sidebar');
    $meta_main_layout = get_post_meta($current_id,'ireca_met_main_layout', 'true');
    
    $mainlayout = ( $current_id != '' && $meta_main_layout != 'global' && $meta_main_layout != '' ) ? $meta_main_layout : $customizer_main_layout;

    return $mainlayout;
}
endif;

// Get current width site
if( !function_exists( 'ireca_get_current_width_site' )):
function ireca_get_current_width_site(){

    // Get mainlayout from Post / Page setting
    $current_id = ireca_get_current_id();

    // Get header default from customizer
    $customizer_width_site = get_theme_mod('width_site','wide');
    $meta_width_site = get_post_meta($current_id,'ireca_met_width_site', 'true');
    
    $width_site = ( $current_id != '' && $meta_width_site != 'global' && $meta_width_site != '' ) ? $meta_width_site : $customizer_width_site;
    return $width_site;
}
endif;

// Get current ID of post/page, etc
if( !function_exists( 'ireca_get_current_id' )):
function ireca_get_current_id(){
	
    $current_page_id = '';
    // Get The Page ID You Need
    if(class_exists("woocommerce")) {
        if( is_shop() ){
            $current_page_id  =  get_option ( 'woocommerce_shop_page_id' );
        }elseif(is_cart()) {
            $current_page_id  =  get_option ( 'woocommerce_cart_page_id' );
        }elseif(is_checkout()){
            $current_page_id  =  get_option ( 'woocommerce_checkout_page_id' );
        }elseif(is_account_page()){
            $current_page_id  =  get_option ( 'woocommerce_myaccount_page_id' );
        }elseif(is_view_order_page()){
            $current_page_id  = get_option ( 'woocommerce_view_order_page_id' );
        }
    }
    if($current_page_id=='') {
        if ( is_home () && is_front_page () ) {
            $current_page_id = '';
        } elseif ( is_home () ) {
            $current_page_id = get_option ( 'page_for_posts' );
        } elseif ( is_search () || is_category () || is_tag () || is_tax () || is_archive() ) {
            $current_page_id = '';
        } elseif ( !is_404 () ) {
           $current_page_id = get_the_id();
        } 
    }

    return $current_page_id;
}
endif;




// Get width sidebar
if( !function_exists( 'ireca_width_sidebar' )):
function ireca_width_sidebar($special_layout){
    $main_layout = $special_layout ? $special_layout : ireca_get_current_main_layout();
    $sidebar_column = get_theme_mod('sidebar_column','4');
    
    $col_width_sidebar = '';

    if($main_layout == 'left_sidebar'){
        switch ($sidebar_column) {

            case 1:
                $col_width_sidebar = 'col-lg-1 col-md-12 order-lg-0 order-md-1 left_sidebar';
                break;
            case 2:
                $col_width_sidebar = 'col-lg-2 col-md-12 order-lg-0 order-md-1 left_sidebar';
                break;
            case 3:
                $col_width_sidebar = 'col-lg-3 col-md-12 order-lg-0 order-md-1 left_sidebar';
                break;
            case 4:
                $col_width_sidebar = 'col-lg-4 col-md-12 order-lg-0 order-md-1 left_sidebar';
                break;
            case 5:
                $col_width_sidebar = 'col-lg-5 col-md-12 order-lg-0 order-md-1 left_sidebar';
                break;
            case 6:
                $col_width_sidebar = 'col-lg-6 col-md-12 order-lg-0 order-md-1 left_sidebar';
                break;
            default:
                $col_width_sidebar = 'col-lg-4 col-md-12 order-lg-0 order-md-1 left_sidebar';
                break;
        }


    }else if($main_layout == 'right_sidebar'){

        switch ($sidebar_column) {
            case 1:
                $col_width_sidebar = 'col-lg-1 col-md-12 right_sidebar';
                break;
            case 2:
                $col_width_sidebar = 'col-lg-2 col-md-12 right_sidebar';
                break;
            case 3:
                $col_width_sidebar = 'col-lg-3 col-md-12 right_sidebar';
                break;
            case 4:
                $col_width_sidebar = 'col-lg-4 col-md-12 right_sidebar';
                break;
            case 5:
                $col_width_sidebar = 'col-lg-5 col-md-12 right_sidebar';
                break;
            case 6:
                $col_width_sidebar = 'col-lg-6 col-md-12 right_sidebar';
                break;
            default:
                $col_width_sidebar = 'col-lg-4 col-md-12 right_sidebar';
                break;
        }

    }else if($main_layout == 'no_sidebar' || $main_layout == 'fullwidth'){

        $col_width_sidebar = '';

    }
    
    return $col_width_sidebar;
}
endif;

// Get main sidebar
if( !function_exists( 'ireca_width_main_content' )):
function ireca_width_main_content($special_layout){
    $main_layout = $special_layout != '' ? $special_layout : ireca_get_current_main_layout();
    $main_column = get_theme_mod('main_column','8');

    $col_width_main = '';

    if($main_layout == 'left_sidebar'){

        switch ($main_column) {
            case 6:
                $col_width_main = 'col-lg-6 col-md-12 order-lg-1  order-md-0 left_sidebar';
                break;
            case 7:
                $col_width_main = 'col-lg-7 col-md-12   order-lg-1  order-md-0 left_sidebar';
                break;
            case 8:
                $col_width_main = 'col-lg-8 col-md-12   order-lg-1  order-md-0 left_sidebar';
                break;
            case 9:
                $col_width_main = 'col-lg-9 col-md-12   order-lg-1  order-md-0 left_sidebar';
                break;
            case 10:
                $col_width_main = 'col-lg-10 col-md-12   order-lg-1  order-md-0 left_sidebar';
                break;
            case 11:
                $col_width_main = 'col-lg-11 col-md-12   order-lg-1  order-md-0 left_sidebar';    
                break;
            default:
                $col_width_main = 'col-lg-8 col-md-12   order-lg-1  order-md-0 left_sidebar';
                break;
        }

    }else if($main_layout == 'right_sidebar'){

        switch ($main_column) {
            case 6:
                $col_width_main = 'col-lg-6 col-md-12 right_sidebar';
                break;
            case 7:
                $col_width_main = 'col-lg-7 col-md-12 right_sidebar';
                break;
            case 8:
                $col_width_main = 'col-lg-8 col-md-12 right_sidebar';
                break;
            case 9:
                $col_width_main = 'col-lg-9 col-md-12 right_sidebar';
                break;
            case 10:
                $col_width_main = 'col-lg-10 col-md-12 right_sidebar';
                break;
            case 11:
                $col_width_main = 'col-lg-11 col-md-12 right_sidebar';    
                break;
            default:
                $col_width_main = 'col-lg-8 col-md-12 right_sidebar';
                break;
        }

    }else if($main_layout == 'no_sidebar'){

        $col_width_main = 'col-md-12';

    }else if($main_layout == 'fullwidth'){

        $col_width_main = '';

    }

    return $col_width_main;

}
endif;



// Get Woo width sidebar
if( !function_exists( 'ireca_woo_width_sidebar' )):
function ireca_woo_width_sidebar(){
    $main_layout = get_theme_mod('woo_layout','no_sidebar');
    $sidebar_column = get_theme_mod('woo_sidebar_column','4');
    
    $col_width_sidebar = '';

    if($main_layout == 'left_sidebar'){
        switch ($sidebar_column) {

            case 1:
                $col_width_sidebar = 'col-lg-1 col-md-12 order-lg-0 order-md-1 woo_left_sidebar';
                break;
            case 2:
                $col_width_sidebar = 'col-lg-2 col-md-12 order-lg-0 order-md-1 woo_left_sidebar';
                break;
            case 3:
                $col_width_sidebar = 'col-lg-3 col-md-12 order-lg-0 order-md-1 woo_left_sidebar';
                break;
            case 4:
                $col_width_sidebar = 'col-lg-4 col-md-12 order-lg-0 order-md-1 woo_left_sidebar';
                break;
            case 5:
                $col_width_sidebar = 'col-lg-5 col-md-12 order-lg-0 order-md-1 woo_left_sidebar';
                break;
            case 6:
                $col_width_sidebar = 'col-lg-6 col-md-12 order-lg-0 order-md-1 woo_left_sidebar';
                break;
            default:
                $col_width_sidebar = 'col-lg-4 col-md-12 order-lg-0 order-md-1 woo_left_sidebar';
                break;
        }


    }else if($main_layout == 'right_sidebar'){

        switch ($sidebar_column) {
            case 1:
                $col_width_sidebar = 'col-lg-1 col-md-12 woo_right_sidebar';
                break;
            case 2:
                $col_width_sidebar = 'col-lg-2 col-md-12 woo_right_sidebar';
                break;
            case 3:
                $col_width_sidebar = 'col-lg-3 col-md-12 woo_right_sidebar';
                break;
            case 4:
                $col_width_sidebar = 'col-lg-4 col-md-12 woo_right_sidebar';
                break;
            case 5:
                $col_width_sidebar = 'col-lg-5 col-md-12 woo_right_sidebar';
                break;
            case 6:
                $col_width_sidebar = 'col-lg-6 col-md-12 woo_right_sidebar';
                break;
            default:
                $col_width_sidebar = 'col-lg-4 col-md-12 woo_right_sidebar';
                break;
        }

    }else if($main_layout == 'no_sidebar' || $main_layout == 'fullwidth'){

        $col_width_sidebar = '';

    }
    
    return $col_width_sidebar;
}
endif;

// Get woo main sidebar
if( !function_exists( 'ireca_woo_width_main_content' )):
function ireca_woo_width_main_content(){
    $main_layout = get_theme_mod('woo_layout','no_sidebar');
    $main_column = get_theme_mod('woo_main_column','8');

    $col_width_main = '';

    if($main_layout == 'left_sidebar'){

        switch ($main_column) {
            case 6:
                $col_width_main = 'col-lg-6 col-md-12 order-lg-1 order-md-0 woo_left_sidebar';
                break;
            case 7:
                $col_width_main = 'col-lg-7 col-md-12 order-lg-1 order-md-0 woo_left_sidebar';
                break;
            case 8:
                $col_width_main = 'col-lg-8 col-md-12 order-lg-1 order-md-0 woo_left_sidebar';
                break;
            case 9:
                $col_width_main = 'col-lg-9 col-md-12 order-lg-1 order-md-0 woo_left_sidebar';
                break;
            case 10:
                $col_width_main = 'col-lg-10 col-md-12 order-lg-1 order-md-0 woo_left_sidebar';
                break;
            case 11:
                $col_width_main = 'col-lg-11 col-md-12 order-lg-1 order-md-0 woo_left_sidebar';
                break;
            default:
                $col_width_main = 'col-lg-8 col-md-12 order-lg-1 order-md-0 woo_left_sidebar';
                break;
        }

    }else if($main_layout == 'right_sidebar'){

        switch ($main_column) {
            case 6:
                $col_width_main = 'col-lg-6 col-md-12 woo_right_sidebar';
                break;
            case 7:
                $col_width_main = 'col-lg-7 col-md-12 woo_right_sidebar';
                break;
            case 8:
                $col_width_main = 'col-lg-8 col-md-12 woo_right_sidebar';
                break;
            case 9:
                $col_width_main = 'col-lg-9 col-md-12 woo_right_sidebar';
                break;
            case 10:
                $col_width_main = 'col-lg-10 col-md-12 woo_right_sidebar';
                break;
            case 11:
                $col_width_main = 'col-lg-11 col-md-12 woo_right_sidebar'; 
                break;
            default:
                $col_width_main = 'col-lg-8 col-md-12 woo_right_sidebar';
                break;
        }

    }else if($main_layout == 'no_sidebar'){

        $col_width_main = 'col-md-12';

    }else if($main_layout == 'fullwidth'){

        $col_width_main = '';

    }

    return $col_width_main;

}
endif;

if( !function_exists( 'ireca_pagination_theme' )):
function ireca_pagination_theme() {
           
    if( is_singular() )
        return;
 
    global $wp_query;
 
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
 
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo wp_kses( __( '<div class="blog_pagination"><ul class="pagination">','ireca' ), true ) . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li class="prev page-numbers">%s</li>' . "\n", get_previous_posts_link('<i class="fa fa-chevron-left"></i>') );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
 
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo wp_kses( __('<li><span class="pagi_dots">...</span></li>', 'ireca' ) , true);
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo wp_kses( __('<li><span class="pagi_dots">...</span></li>', 'ireca' ) , true) . "\n";
 
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li class="next page-numbers">%s</li>' . "\n", get_next_posts_link('<i class="fa fa-chevron-right"></i>') );
 
    echo wp_kses( __( '</ul></div>', 'ireca' ), true ) . "\n";
 
}
endif;



/* Setup Theme */
/* Add theme support */
add_action('after_setup_theme', 'ireca_theme_support', 10);
add_filter('oembed_result', 'ireca_framework_fix_oembeb', 10 );
add_filter('paginate_links', 'ireca_fix_pagination_error',10);
add_action( 'admin_enqueue_scripts', 'ireca_wpadminjs' ); 

function ireca_theme_support(){

    if ( ! isset( $content_width ) ) $content_width = 900;

    add_theme_support('title-tag');

    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );

    // Switches default core markup for search form, comment form, and comments    
    // to output valid HTML5.
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'script', 'style' ) );

    /* See http://codex.wordpress.org/Post_Formats */
    add_theme_support( 'post-formats', array( 'image', 'gallery', 'audio', 'video') );

    add_theme_support( 'post-thumbnails' );
    
    add_theme_support( 'custom-header' );
    add_theme_support( 'custom-background');

    add_image_size( 'ireca_list', '350', false );
    add_image_size( 'ireca_m', '600', false );

    add_theme_support( 'woocommerce' );
    
}



function ireca_framework_fix_oembeb( $url ){
    $array = array (
        'webkitallowfullscreen'     => '',
        'mozallowfullscreen'        => '',
        'frameborder="0"'           => '',
        '</iframe>)'        => '</iframe>'
    );
    $url = strtr( $url, $array );

    if ( strpos( $url, "<embed src=" ) !== false ){
        return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $url);
    }
    elseif ( strpos ( $url, 'feature=oembed' ) !== false ){
        return str_replace( 'feature=oembed', 'feature=oembed&amp;wmode=opaque', $url );
    }
    else{
        return $url;
    }
}


// Fix pagination
function ireca_fix_pagination_error($link) {
    return str_replace('#038;', '&', $link);
}

function ireca_wpadminjs() {

    wp_enqueue_style('ireca_fixcssadmin', IRECA_URI.'/extend/cssadmin.css',  false, '1.0');
}


add_filter( 'woocommerce_product_description_heading', 'ireca_remove_product_description_heading' );
function ireca_remove_product_description_heading() {
 return '';
}


add_action( 'woocommerce_before_cart', 'ireca_woocommerce_before_cart', 10, 1 ); 
function ireca_woocommerce_before_cart(){
    echo '<div class="ireca_page_cart">';
}

add_action( 'woocommerce_after_cart', 'ireca_woocommerce_after_cart', 10, 1 ); 
function ireca_woocommerce_after_cart(){
    echo '</div>';
}

add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
    // Change the breadcrumb delimeter from '/' to '>'
    $defaults['delimiter'] = ' > ';
    return $defaults;
}


add_filter( 'woocommerce_output_related_products_args', 'ireca_related_products_args' );
  function ireca_related_products_args( $args ) {
    $args['posts_per_page'] = 3; // 4 related products
    $args['columns'] = 3; // arranged in 2 columns
    return $args;
}



function ireca_get_header_bg(){

    $bg_url = get_post_meta( ireca_get_current_id(), 'ireca_met_bg_header', true );
    $bg_class = ( $bg_url != '' ) ? 'bg_header' : '';

    if ( is_category() ){

        if (function_exists('z_taxonomy_image_url')) $bg_url = z_taxonomy_image_url();
        $bg_class = ( $bg_url != '' ) ? 'bg_header' : '';
 
    }

    // Product Category Woo
    if( class_exists( 'woocommerce' ) ){
        if ( is_product_category() ){
            global $wp_query;
            $cat = $wp_query->get_queried_object();

            $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );

            $bg_url = wp_get_attachment_url( $thumbnail_id );
            $bg_class = ( $bg_url != '' ) ? 'bg_header' : '';

        }
    }


    return array( 'bg_url' => $bg_url, 'bg_class' => $bg_class );


}


function ireca_heading_title(){
    ob_start(); ?>

    

        <?php if( class_exists( 'woocommerce' ) && is_woocommerce()  ){  ?>
            
            <?php if ( is_product_category() ){ ?>

                <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                    <?php woocommerce_page_title(); ?>
                <?php endif; ?>
                
            <?php }else if( is_product() ){ 
                $product = wc_get_product( get_the_id() );
                if( !$product->is_type( 'ovacrs_car_rental' ) ){
                    the_title();
                }
            }else{
                the_title(); 
            }

            ?>
            
        <?php }else{

            if ( is_home() ) { ?>

                <?php esc_html_e( 'Blog', 'ireca' ) ?>

            <?php }elseif ( is_search () ) { ?>

                <?php esc_html_e( 'Search', 'ireca' ); ?>

            <?php }elseif( is_category() ){ ?>

                <?php echo single_cat_title() ?>

            <?php }elseif( is_tag() ){ ?>

                <?php esc_html_e( 'Tag', 'ireca' ) ?>

            <?php }elseif( is_tax () || is_archive() ){ ?>

                <?php the_archive_title() ?>

            <?php }else if( is_single() ){ ?>
            
                <?php esc_html_e( 'Post Detail', 'ireca' ); ?>

            <?php }else if( is_single() ){ ?>

                <?php esc_html_e( 'Post Detail', 'ireca' ); ?>    
            <?php }else if ( !is_404 () ) { ?>

                <?php if( get_post_meta(  ireca_get_current_id() ,'ireca_met_page_heading', true ) != 'no' ){ ?>
                    <?php the_title(); ?>
                <?php } ?>

            <?php }else if( is_404() ){ ?>
                <?php esc_html_e( '404 Page', 'ireca' ); ?>
            <?php } ?>

        <?php } ?>

     <?php return ob_get_clean();
}

function ireca_breadcrumbs_header(){
    if( ! ( class_exists( 'woocommerce' ) && is_woocommerce() ) ){
        if( get_post_meta(  ireca_get_current_id() ,'ireca_met_show_breadcrumbs', true ) != 'no' ){
            ireca_breadcrumbs();
        }
    }else if( is_product() ){

        $product = wc_get_product( get_the_id() );
        if( !$product->is_type( 'ovacrs_car_rental' ) ){
            do_action( 'woocommerce_before_main_content' );
        }
    }else{
        do_action( 'woocommerce_before_main_content' );
    }
}



/* Check HTTPs */
function ireca_check_https() {
    
    if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
        return true; 
    }
    return false;
}
