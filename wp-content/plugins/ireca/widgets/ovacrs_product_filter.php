<?php
namespace Ireca\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class ovacrs_product_filter extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'ovacrs_product_filter';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Product Filter', 'ireca' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'ovatheme' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'ireca-elementor' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */

	

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ireca' ),
			]
		);

			$this->add_control(
				'array_slug',
				[
					'label' => __( 'Slug Category', 'ireca' ),
					'Separator' => __( 'Example: ', 'ireca' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'tab_active',
				[
					'label' => __( 'Active Category', 'ireca' ),
					'description' => __( 'Insert Slug of Category', 'ireca' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'filters',
				[
					'label' => __( 'Filter', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'rent',
					'options' => [
						'rent' => __( 'For Renting', 'ireca' ),
						'sell'  => __( 'For Selling', 'ireca' ),
						'both'  => __( 'Both (Rent, Sell)', 'ireca' ),
						
					],

				]
			);

			$this->add_control(
				'orderby',
				[
					'label' => __( 'Order by', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'order',
					'options' => [
						'order'  => __( 'Custom Order', 'ireca' ),
						'id' => __( 'ID', 'ireca' ),
						'total_sales'  => __( 'Total Sales', 'ireca' ),
						'rating'  => __( 'Rating', 'ireca' ),
					],

				]
			);

			$this->add_control(
				'order',
				[
					'label' => __( 'Order', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'DESC',
					'options' => [
						'DESC'  => __( 'Decrease', 'ireca' ),
						'ASC' => __( 'Ascending', 'ireca' ),
						
					],

				]
			);

			$this->add_control(
				'total_items_cat',
				[
					'label' => __( 'Total items in each category', 'ireca' ),
					'type' => Controls_Manager::NUMBER,
					'description' => __( 'Insert -1 to display all items in a category', 'ireca' ),
					'min' => -1,
					"default" => 100
				]
			);

			

			

			$this->add_control(
				'auto_slide',
				[
					'label' => __( 'Auto Slide', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					"description" => __( 'Insert false : not auto . Insert number integer (ms) for auto. Example 5000 ', 'ireca' ),
					"default" => "false"
				]
			);

			

			$this->add_control(
				'class',
				[
					'label' => __( 'Class', 'ireca' ),
					'type' => Controls_Manager::TEXT,
				]
			);

		$this->end_controls_section();




		$this->start_controls_section(
			'section_product',
			[
				'label' => __( 'Product Settings', 'ireca' ),
			]
		);

			$this->add_control(
				'product_style',
				[
					'label' => __( 'Product Style', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'style1',
					'options' => [
						'style1'  => __( 'Style 1', 'ireca' ),
						'style2' => __( 'Style 2', 'ireca' ),
						'style3' => __( 'Style 3', 'ireca' ),
						'style4' => __( 'Style 4', 'ireca' ),
					],

				]
			);

			$this->add_control(
				'total_columns_slide',
				[
					'label' => __( 'Total columns in each slide', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => '2',
					'options' => [
						'2'  => __( '2 items', 'ireca' ),
						'3' => __( '3 items', 'ireca' ),
						'4' => __( '4 items', 'ireca' ),
					],

				]
			);

			$this->add_control(
				'total_items_column',
				[
					'label' => __( 'Total items in each column', 'ireca' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					"default" => 1
				]
			);

			

			$this->add_control(
				'total_feature_dis',
				[
					'label' => __( 'Total features will display', 'ireca' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					"default" => 6
				]
			);

			$this->add_control(
				'butotn_text',
				[
					'label' => __( 'Button Text when hover price', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					"default" => __( 'Rent it', 'ireca' ),
				]
			);


		$this->end_controls_section();


		$this->start_controls_section(
			'section_tab',
			[
				'label' => __( 'Tab Settings', 'ireca' ),
			]
		);

			$this->add_control(
				'show_tab',
				[
					'label' => __( 'Show tab', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes'  => __( 'Yes', 'ireca' ),
						'no' => __( 'No', 'ireca' ),
						
					],

				]
			);

			$this->add_control(
				'align_tab',
				[
					'label' => __( 'Align Tab', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'justify-content-end',
					'options' => [
						'justify-content-end'  => __( 'Right', 'ireca' ),
						'justify-content-center' => __( 'Center', 'ireca' ),
						'' => __( 'Left', 'ireca' ),
						
					],

				]
			);

			$this->add_control(
				'style_tab',
				[
					'label' => __( 'Style Tab', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'style1',
					'options' => [
						'style1'  => __( 'Style 1', 'ireca' ),
						'style2' => __( 'Style 2', 'ireca' )
					],

				]
			);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_nav',
			[
				'label' => __( 'Navigation Settings', 'ireca' ),
			]
		);

			$this->add_control(
				'show_nav',
				[
					'label' => __( 'Show Navigation', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes'  => __( 'Yes', 'ireca' ),
						'no' => __( 'No', 'ireca' ),
						
					],

				]
			);

			$this->add_control(
				'icon_nav',
				[
					'label' => __( 'Icon at Navigation', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					"description" => __( 'Insert Font Class', 'ireca' ),
					"default" => "fas fa-car"
				]
			);

			$this->add_control(
				'show_available',
				[
					'label' => __( 'Show available total items', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes'  => __( 'Yes', 'ireca' ),
						'no' => __( 'No', 'ireca' ),
						
					],

				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_dots',
			[
				'label' => __( 'Dots Navigation Settings', 'ireca' ),
			]
		);

			$this->add_control(
				'show_dots',
				[
					'label' => __( 'Show Dots Navigation', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'false',
					'options' => [
						'false' => __( 'No', 'ireca' ),
						'true'  => __( 'Yes', 'ireca' ),
						
						
					],

				]
			);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_show_hide',
			[
				'label' => __( 'Show/Hide Field', 'ireca' ),
			]
		);
			

			$this->add_control(
				'show_thumbnail',
				[
					'label' => __( 'Show Thumbnail', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes'  => __( 'Yes', 'ireca' ),
						'no' => __( 'No', 'ireca' ),
						
					],

				]
			);

			$this->add_control(
				'show_price',
				[
					'label' => __( 'Show Price', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes'  => __( 'Yes', 'ireca' ),
						'no' => __( 'No', 'ireca' ),
						
					],

				]
			);

			$this->add_control(
				'show_time_rental',
				[
					'label' => __( 'Show Time Rental (/Day, /Hour)', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes'  => __( 'Yes', 'ireca' ),
						'no' => __( 'No', 'ireca' ),
						
					],

				]
			);

			$this->add_control(
				'show_title',
				[
					'label' => __( 'Show Title', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes'  => __( 'Yes', 'ireca' ),
						'no' => __( 'No', 'ireca' ),
						
					],

				]
			);

			$this->add_control(
				'show_rating_star',
				[
					'label' => __( 'Show Rating Star', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes'  => __( 'Yes', 'ireca' ),
						'no' => __( 'No', 'ireca' ),
						
					],

				]
			);

			$this->add_control(
				'show_rating_text',
				[
					'label' => __( 'Show Rating Text', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes'  => __( 'Yes', 'ireca' ),
						'no' => __( 'No', 'ireca' ),
						
					],

				]
			);

			$this->add_control(
				'show_attribute',
				[
					'label' => __( 'Show Attribute', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes'  => __( 'Yes', 'ireca' ),
						'no' => __( 'No', 'ireca' ),
						
					],

				]
			);


			$this->add_control(
				'show_feature',
				[
					'label' => __( 'Show Feature', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes'  => __( 'Yes', 'ireca' ),
						'no' => __( 'No', 'ireca' ),
						
					],

				]
			);

		$this->end_controls_section();

		
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings();

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

         $rand = 'time'.rand().'_s';


        $array_slug = explode( ',', trim( $settings['array_slug'] ) );

        

        $html = '<div class="woocommerce ovacrs_product_filter '.$settings['class'].'">';

	        // Nav
	        if( $settings['show_tab'] == 'yes' ){
	            $html .= '<ul class="nav nav-pills '.$settings['align_tab'].' '.$settings['style_tab'].'"  role="tablist">';

	                    for( $i=0; $i < count($array_slug); $i++ ){

	                      foreach ($categories as $key => $cat) {

	                        if(trim( $array_slug[$i] ) == $cat->slug){

	                            $item_active = ($cat->slug == $settings['tab_active']) ? ' current ':'';
	                            $aria_true = ($cat->slug == $settings['tab_active']) ? 'aria-selected="true"' : 'aria-selected="false"';
	                            $html .= '<li class="nav-item '.$cat->slug.' ">
	                                        <a class="nav-link '.$item_active.'" id="'.$cat->slug.'-tab-'.$rand.'" data-toggle="tab" href="#'.$cat->slug.$rand.'" role="tab" '.$aria_true.'>'.$cat->name.'</a>
	                                        <span class="total_items '.$item_active.' '.$cat->slug.'"></span>
	                                    </li>';

	                        }

	                      }

	                    }
	            $html .= '</ul>';
	        }

	        // Content
	        $html .= '<div class="tab-content" >';

	                for( $i=0; $i < count($array_slug); $i++ ){

	                    foreach ($categories as $key => $cat) {

	                        if(trim( $array_slug[$i] ) == $cat->slug){

	                            $item_active = ($cat->slug == $settings['tab_active']) ? ' show active ':'';

	                            

	                            $html .= '<div class="tab-pane fade '.$item_active.'" id="'.$cat->slug.$rand.'" role="tabpanel" >';

	                                $args_basic = array(
	                                    'post_type' => 'product',
	                                    'post_status' => 'publish',
	                                    'posts_per_page' => $settings['total_items_cat'],
	                                    'order' => $settings['order']
	                                );

	                                
	                                if( $settings['orderby'] == 'id' ){

	                                    $args_orderby = array( 'orderby' => 'id' );

	                                }else if ( $settings['orderby'] == 'order' ){

	                                    $args_orderby = array( 'orderby' => 'meta_value_num', 'meta_key' => 'ovacrs_car_order' );

	                                }else if( $settings['orderby'] == 'total_sales' ){

	                                    $args_orderby = array( 'orderby' => 'meta_value_num', 'meta_key' => 'total_sales' );

	                                }else if( $settings['orderby'] == 'rating' ){
	                                    $args_orderby = array( 'orderby' => 'meta_value_num', 'meta_key' => '_wc_average_rating' );                                    
	                                }

	                                 

	                                

	                                if( $settings['filters'] == 'rent' ){

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

	                                }else if( $settings['filters'] == 'sell' ){

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

	                                $ireca_products = new \WP_Query($args_product);


	                                    // Navigation Top
	                                    if( $settings['show_nav'] == 'yes' && ( $ireca_products->post_count > $settings['total_items_column'] * $settings['total_columns_slide'] ) ){
	                                        $html .= '<div class="wrap_nav top d-block d-lg-none"><div class="ireca_nav">
	                                                    <a class="carousel-control-prev" href="#carousel'.$cat->slug.'" role="button" data-slide="prev">
	                                                        <i class="fas fa-caret-left"></i>
	                                                    </a>';

	                                                    if( $settings['icon_nav'] != '' || $settings['show_available'] == 'yes' ){
			                                                $html .= '<div class="icon_nav">';
			                                                    $html .= $settings['icon_nav'] != '' ? '<i class="'.$settings['icon_nav'].'"></i>' : '';
			                                                    $html .= $settings['show_available'] == 'yes' ? '<span>'.esc_html__('Available', 'ireca').' <strong class="total_items">'.$ireca_products->post_count.'</strong> '.esc_html__('items', 'ireca').'</span>' : '';
			                                                $html .= '</div>';
		                                                }

	                                                   
	                                                    
	                                                    $html .= '<a class="carousel-control-next" href="#carousel'.$cat->slug.'" role="button" data-slide="next">
	                                                        <i class="fas fa-caret-right"></i>
	                                                    </a>
	                                            </div></div>';
	                                    }


	                               
	                               
									

	                                $html .= '<div class="owl-carousel owl-theme '.$cat->slug.'" data-total_columns_slide="'.$settings['total_columns_slide'].'" data-show_dots="'.$settings['show_dots'].'" data-cat_slug="'.$cat->slug.'" data-total_items="'.str_pad($ireca_products->post_count, 2, 0, STR_PAD_LEFT).'" >';
	                                  
	                                    

	                                    $group_slide = $t_items_cat = 1;
	                                      
	                                      if( $ireca_products->have_posts() ): while( $ireca_products->have_posts() ):  $ireca_products->the_post();

	                                            global $product;


	                                            $img  = wp_get_attachment_image_url( get_post_thumbnail_id(), 'large' );
	                                            $img_ireca_list  = wp_get_attachment_image_url( get_post_thumbnail_id(), 'ireca_list' );
												$img_vehicle_m  = wp_get_attachment_image_url( get_post_thumbnail_id(), 'vehicle_m' );

	                                            $rating_count = $product->get_rating_count();
	                                            $review_count = $product->get_review_count();
	                                            $average      = $product->get_average_rating();

	                                                if( $group_slide == $settings['total_items_column'] + 1 ){ $group_slide = 1; }
	                                                if( $group_slide == 1 ){
	                                                    $html .= '<div class="group_slide">';
	                                                }

	                                                    if( $settings['product_style'] == 'style1' ){


	                                                        $html .= '<div class="rental_item item '.$settings['product_style'].'">';

	                                                            $html .= '<div class="wrap_img">';
	                                                                       $html .= ( $settings['show_thumbnail'] == 'yes' ) ? '<img src="'.$img.'" srcset="'.esc_url( $img_vehicle_m ).' 600w, '.esc_url( $img_ireca_list ).' 350w" sizes="(max-width: 600px) 100vw, 600px" alt="'.get_the_title().'">' : '';
	                                                                       $class_make_top = ( $settings['show_thumbnail'] == 'yes' ) ? 'bottom':'no_margin';
	                                                                       
	                                                                       $html .= '<div class="'.$class_make_top.'">';
	                                                                            
	                                                                            if( $settings['show_price'] == 'yes' ){

	                                                                                $is_produc_type = $product->is_type('ovacrs_car_rental') ? true : false ;

	                                                                                $html .= '<div class="wrap_btn">
	                                                                                    <a href="'.get_the_permalink().'" class="ireca_btn  btn_tran dashed btn_white btn_price"><span class="wrap_content">';

	                                                                                    	if( $is_produc_type ){
	                                                                                    		if( ovacrs_get_price_type( get_the_id() ) == 'day' ){
			                                                                                        $html .= '<span class="amount">'.ovacrs_get_price_day( get_the_id() ).'</span>';
			                                                                                        $html .= ( $settings['show_time_rental'] == 'yes' && $is_produc_type ) ? '<span class="time">'.esc_html__( '/ Day', 'ireca' ).'</span>' : '';
			                                                                                    }else if( ovacrs_get_price_type( get_the_id() ) == 'hour' ){
			                                                                                        $html .= '<span class="amount">'.ovacrs_get_price_hour( get_the_id() ).'</span>';
			                                                                                        $html .= ( $settings['show_time_rental'] == 'yes' && $is_produc_type ) ? '<span class="time">'.esc_html__( '/ Hour', 'ireca' ).'</span>' : '';
			                                                                                    }else if( ovacrs_get_price_type( get_the_id() ) == 'mixed' ) {
			                                                                                        $html .= '<span class="amount">'.ovacrs_get_price_day( get_the_id() ).'</span>';
			                                                                                        $html .= ( $settings['show_time_rental'] == 'yes' && $is_produc_type ) ? '<span class="time">'.esc_html__( '/ Day', 'ireca' ).'</span>' : '';
			                                                                                    }	
	                                                                                    	}else{

	                                                                                    		$html .= $product->get_price_html();

	                                                                                    	}
	                                                                                        
	                                                                                        $html .= '<span class="text">'.$settings['butotn_text'].'</span>
	                                                                                    </span></a>
	                                                                                </div>';
	                                                                            }

	                                                                        $html .= '</div>

	                                                                    </div>'; // /wrap_img
	                                                                    
	                                                                    $show_price_no = ( $settings['show_price'] == 'no' ) ? 'show_price_no' : '';

	                                                            $html .= '<div class="content '.$show_price_no.'">';

	                                                                $html .= ( $settings['show_title'] == 'yes' ) ? '<h3 class="title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>' : '';


	                                                                if( $settings['show_rating_star'] == 'yes' || $settings['show_rating_text'] == 'yes' ){

		                                                                $html .= '<div class="woocommerce-product-rating">';

		                                                                    if( $settings['show_rating_star'] == 'yes' ){
		                                                                        $html .= wc_get_rating_html( $average, $rating_count );    
		                                                                    }

		                                                                    if( comments_open() && $settings['show_rating_text'] == 'yes' ){
		                                                                        $html .= '<span class="count">'.$review_count.'</span>'.esc_html__( ' reviews', 'ireca' );  
		                                                                    }

		                                                                $html .= '</div>';
	                                                            	}


	                                                                // Show attribute
	                                                                if( $settings['show_attribute'] == 'yes'  ){
		                                                               	$attributes = $product->get_attributes();
		                                                               	foreach ( $attributes as $attribute ) :
		                                                               		
		                                                               		$values = array();

																			if ( $attribute->is_taxonomy() ) {
																				$attribute_taxonomy = $attribute->get_taxonomy_object();
																				$attribute_values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

																				foreach ( $attribute_values as $attribute_value ) {
																					$value_name = esc_html( $attribute_value->name );

																					if ( $attribute_taxonomy->attribute_public ) {
																						$values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
																					} else {
																						$values[] = $value_name;
																					}
																				}
																			} else {
																				$values = $attribute->get_options();

																				foreach ( $values as &$value ) {
																					$value = make_clickable( esc_html( $value ) );
																				}
																			}

																			$html .= '<div class="product_attr"><span class="label">'.wc_attribute_label( $attribute->get_name() ).': </span><span class="value">'.apply_filters( 'woocommerce_attribute',  wptexturize( implode( ', ', $values ) ) , $attribute, $values ).'</span></div>';
																			
		                                                               	endforeach;
	                                                               	}
	                                                               	// /Show attribute



	                                                                if( $settings['show_feature'] == 'yes' ){
	                                                                    $html .= '<div class="features"><div class="container-fluid"><div class="row">';

	                                                                            $features = get_post_meta( get_the_id(), 'ovacrs_features_special', true );
	                                                                            $icon = get_post_meta( get_the_id(), 'ovacrs_features_icons', true );
	                                                                            $desc = get_post_meta( get_the_id(), 'ovacrs_features_desc', true );
	                                                                            $d = 0;
	                                                                            $total_feature_dis = $settings['total_feature_dis'];
	                                                                            

	                                                                            if( $features ){
	                                                                                foreach ($features as $key => $value) {
	                                                                                    if( $value == 'yes' && trim( $desc[$key] ) != '' && trim( $icon[$key] ) != '' ){
	                                                                                        $class = ($d%2) ? 'eve' : 'odd';
	                                                                                        $html .= '<div class="feature-item '.$class.'">';
	                                                                                            $html .= '<i class="'.$icon[$key].'"></i>';
	                                                                                            $html .= '<span class="desc">'.$desc[$key].'</span>';
	                                                                                        $html .= '</div>';
	                                                                                        
	                                                                                        $d++;

	                                                                                        if( $d >= $total_feature_dis ) break;
	                                                                                    }
	                                                                                }
	                                                                            }
	                                                                            
	                                                                    $html .= '</div></div></div>'; // /row // container-fluid
	                                                                }

	                                                            $html .= '</div>'; // /content

	                                                        $html .= '</div>'; // /item

	                                                    }else if( $settings['product_style'] == 'style2' ){

	                                                    	$html .= '<div class="rental_item item '.$settings['product_style'].'">';

	                                                    		/* Image */
	                                                            $html .= '<div class="wrap_img">';
	                                                                    $html .= ( $settings['show_thumbnail'] == 'yes' ) ? '<img src="'.$img.'" srcset="'.esc_url( $img_ireca_list ).' 600w, '.esc_url( $img_ireca_list ).' 350w" sizes="(max-width: 600px) 100vw, 600px" alt="'.get_the_title().'">' : '';
	                                                            $html .= '</div>'; 
	                                                            /* Image */
	                                                                    
	                                                            $show_price_no = ( $settings['show_price'] == 'no' ) ? 'show_price_no' : '';

	                                                            $html .= '<div class="content '.$show_price_no.'">';


	                                                            	/* Price */
                                                                        if( $settings['show_price'] == 'yes' ){

                                                                            $is_produc_type = $product->is_type('ovacrs_car_rental') ? true : false ;

                                                                            $html .= '<div class="price">';

                                                                            	if( $is_produc_type ){
                                                                            		if( ovacrs_get_price_type( get_the_id() ) == 'day' ){
                                                                                        $html .= '<span class="amount">'.ovacrs_get_price_day( get_the_id() ).'</span>';
                                                                                        $html .= ( $settings['show_time_rental'] == 'yes' && $is_produc_type ) ? '<span class="time">'.esc_html__( '/ Day', 'ireca' ).'</span>' : '';
                                                                                    }else if( ovacrs_get_price_type( get_the_id() ) == 'hour' ){
                                                                                        $html .= '<span class="amount">'.ovacrs_get_price_hour( get_the_id() ).'</span>';
                                                                                        $html .= ( $settings['show_time_rental'] == 'yes' && $is_produc_type ) ? '<span class="time">'.esc_html__( '/ Hour', 'ireca' ).'</span>' : '';
                                                                                    }else if( ovacrs_get_price_type( get_the_id() ) == 'mixed' ) {
                                                                                        $html .= '<span class="amount">'.ovacrs_get_price_day( get_the_id() ).'</span>';
                                                                                        $html .= ( $settings['show_time_rental'] == 'yes' && $is_produc_type ) ? '<span class="time">'.esc_html__( '/ Day', 'ireca' ).'</span>' : '';
                                                                                    }
                                                                            	}else{
                                                                            		$html .= $product->get_price_html();
                                                                            	}
                                                                                    
                                                                                    	
                                                                                    
                                                                                    
                                                                            $html .= '</div>';
                                                                        }
                                                                    /* /Price */

	                                                                $html .= ( $settings['show_title'] == 'yes' ) ? '<h3 class="title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>' : '';

	                                                                if( $settings['show_rating_star'] == 'yes' || $settings['show_rating_text'] == 'yes' ){
		                                                                $html .= '<div class="woocommerce-product-rating">';

		                                                                    if( $settings['show_rating_star'] == 'yes' ){
		                                                                        $html .= wc_get_rating_html( $average, $rating_count );    
		                                                                    }
		                                                                    

		                                                                    if( comments_open() && $settings['show_rating_text'] == 'yes' ){
		                                                                        $html .= '<span class="count">'.$review_count.'</span>'.esc_html__( ' reviews', 'ireca' );  
		                                                                    }

		                                                                $html .= '</div>';
	                                                            	}


	                                                               	// Show attribute
	                                                               	if( $settings['show_attribute'] == 'yes' ){
		                                                               	$attributes = $product->get_attributes();
		                                                               	foreach ( $attributes as $attribute ) :
		                                                               		
		                                                               		$values = array();

																			if ( $attribute->is_taxonomy() ) {
																				$attribute_taxonomy = $attribute->get_taxonomy_object();
																				$attribute_values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

																				foreach ( $attribute_values as $attribute_value ) {
																					$value_name = esc_html( $attribute_value->name );

																					if ( $attribute_taxonomy->attribute_public ) {
																						$values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
																					} else {
																						$values[] = $value_name;
																					}
																				}
																			} else {
																				$values = $attribute->get_options();

																				foreach ( $values as &$value ) {
																					$value = make_clickable( esc_html( $value ) );
																				}
																			}

																			$html .= '<div class="product_attr"><span class="label">'.wc_attribute_label( $attribute->get_name() ).': </span><span class="value">'.apply_filters( 'woocommerce_attribute',  wptexturize( implode( ', ', $values ) ) , $attribute, $values ).'</span></div>';
																			
		                                                               	endforeach;
	                                                               }
	                                                               	// /Show attribute

	                                                                if( $settings['show_feature'] == 'yes' ){
	                                                                    $html .= '<div class="features"><div class="container-fluid"><div class="row">';

	                                                                            $features = get_post_meta( get_the_id(), 'ovacrs_features_special', true );
	                                                                            $icon = get_post_meta( get_the_id(), 'ovacrs_features_icons', true );
	                                                                            $desc = get_post_meta( get_the_id(), 'ovacrs_features_desc', true );
	                                                                            $d = 0;
	                                                                            if( $features ){
	                                                                                foreach ($features as $key => $value) {
	                                                                                    if( $value == 'yes' && trim( $desc[$key] ) != '' && trim( $icon[$key] ) != '' ){
	                                                                                        $class = ($d%2) ? 'eve' : 'odd';
	                                                                                        $html .= '<div class="feature-item '.$class.'">';
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

	                                                    }else if( $settings['product_style'] == 'style3' ){

	                                                    	$html .= '<div class="rental_item item '.$settings['product_style'].'">';

	                                                            $html .= '<div class="wrap_img">';

	                                                            			if( $settings['show_thumbnail'] == 'yes' ){
	                                                            				$html .= '<div class="cover_img">
		                                                            						<img  src="'.$img.'" srcset="'.esc_url( $img_vehicle_m ).' 600w, '.esc_url( $img_ireca_list ).' 350w" sizes="(max-width: 600px) 100vw, 600px" alt="'.get_the_title().'">
		                                                            						<span class="mask"></span>
		                                                            						<div class="button_rent"><a href="'.get_the_permalink().'" class="text"><span>'.$settings['butotn_text'].'</span></a></div>
	                                                            						</div>';
	                                                            			}
	                                                                       
	                                                                       $class_make_top = ( $settings['show_thumbnail'] == 'yes' ) ? 'bottom':'no_margin';
	                                                                       
	                                                                       $html .= '<div class="'.$class_make_top.'">';
	                                                                            
	                                                                            if( $settings['show_price'] == 'yes' ){

	                                                                                $is_produc_type = $product->is_type('ovacrs_car_rental') ? true : false ;

	                                                                                $html .= '<div class="wrap_btn">
	                                                                                    <a href="'.get_the_permalink().'" class="ireca_btn  btn_tran dashed btn_white btn_price"><span class="wrap_content">';

	                                                                                    	if( $is_produc_type ){
	                                                                                    		if( ovacrs_get_price_type( get_the_id() ) == 'day' ){
			                                                                                        $html .= '<span class="amount">'.ovacrs_get_price_day( get_the_id() ).'</span>';
			                                                                                        $html .= ( $settings['show_time_rental'] == 'yes' && $is_produc_type ) ? '<span class="time">'.esc_html__( '/ Day', 'ireca' ).'</span>' : '';
			                                                                                    }else if( ovacrs_get_price_type( get_the_id() ) == 'hour' ){
			                                                                                        $html .= '<span class="amount">'.ovacrs_get_price_hour( get_the_id() ).'</span>';
			                                                                                        $html .= ( $settings['show_time_rental'] == 'yes' && $is_produc_type ) ? '<span class="time">'.esc_html__( '/ Hour', 'ireca' ).'</span>' : '';
			                                                                                    }else if( ovacrs_get_price_type( get_the_id() ) == 'mixed' ) {
			                                                                                        $html .= '<span class="amount">'.ovacrs_get_price_day( get_the_id() ).'</span>';
			                                                                                        $html .= ( $settings['show_time_rental'] == 'yes' && $is_produc_type ) ? '<span class="time">'.esc_html__( '/ Day', 'ireca' ).'</span>' : '';
			                                                                                    }	
	                                                                                    	}else{

	                                                                                    		$html .= $product->get_price_html();

	                                                                                    	}
	                                                                                        
	                                                                                        $html .= '
	                                                                                    </span></a>
	                                                                                </div>';
	                                                                            }

	                                                                        $html .= '</div>

	                                                                    </div>'; // /wrap_img
	                                                                    
	                                                                    $show_price_no = ( $settings['show_price'] == 'no' ) ? 'show_price_no' : '';

	                                                            $html .= '<div class="content '.$show_price_no.'">';

	                                                               


	                                                                if( $settings['show_rating_star'] == 'yes' || $settings['show_rating_text'] == 'yes' ){

		                                                                $html .= '<div class="woocommerce-product-rating">';

		                                                                    if( $settings['show_rating_star'] == 'yes' ){
		                                                                        $html .= wc_get_rating_html( $average, $rating_count );    
		                                                                    }

		                                                                    if( comments_open() && $settings['show_rating_text'] == 'yes' ){
		                                                                        $html .= '<span class="count">'.$review_count.'</span>'.esc_html__( ' reviews', 'ireca' );  
		                                                                    }

		                                                                $html .= '</div>';
	                                                            	}

	                                                            	 $html .= ( $settings['show_title'] == 'yes' ) ? '<h3 class="title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>' : '';


	                                                                // Show attribute
	                                                                if( $settings['show_attribute'] == 'yes'  ){
		                                                               	$attributes = $product->get_attributes();
		                                                               	foreach ( $attributes as $attribute ) :
		                                                               		
		                                                               		$values = array();

																			if ( $attribute->is_taxonomy() ) {
																				$attribute_taxonomy = $attribute->get_taxonomy_object();
																				$attribute_values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

																				foreach ( $attribute_values as $attribute_value ) {
																					$value_name = esc_html( $attribute_value->name );

																					if ( $attribute_taxonomy->attribute_public ) {
																						$values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
																					} else {
																						$values[] = $value_name;
																					}
																				}
																			} else {
																				$values = $attribute->get_options();

																				foreach ( $values as &$value ) {
																					$value = make_clickable( esc_html( $value ) );
																				}
																			}

																			$html .= '<div class="product_attr"><span class="label">'.wc_attribute_label( $attribute->get_name() ).': </span><span class="value">'.apply_filters( 'woocommerce_attribute',  wptexturize( implode( ', ', $values ) ) , $attribute, $values ).'</span></div>';
																			
		                                                               	endforeach;
	                                                               	}
	                                                               	// /Show attribute



	                                                                if( $settings['show_feature'] == 'yes' ){
	                                                                    $html .= '<div class="features"><div class="container-fluid"><div class="row">';

	                                                                            $features = get_post_meta( get_the_id(), 'ovacrs_features_special', true );
	                                                                            $icon = get_post_meta( get_the_id(), 'ovacrs_features_icons', true );
	                                                                            $desc = get_post_meta( get_the_id(), 'ovacrs_features_desc', true );

	                                                                            $d = 0; $k = 0;
	                                                                            $total_feature_dis = $settings['total_feature_dis'];
	                                                                            

	                                                                            if( $features ){
	                                                                                foreach ($features as $key => $value) {
	                                                                                    if( $value == 'yes' && trim( $desc[$key] ) != '' && trim( $icon[$key] ) != '' ){
	                                                                                    	
	                                                                                    	if( $k == 0 || $k == 2 ){
	                                                                                    		$html .= '<div class="wrap_item ">';
	                                                                                    	}

	                                                                                        
	                                                                                        $html .= '<div class="feature-item ">';
	                                                                                            $html .= '<i class="'.$icon[$key].'"></i>';
	                                                                                            $html .= '<span class="desc">'.$desc[$key].'</span>';
	                                                                                        $html .= '</div>';

	                                                                                        $k++;
	                                                                                        if( $k == 2 ) $k = 0 ;
	                                                                                        if( $k == 0 || $d == $total_feature_dis ){
	                                                                                        	$html .= '</div>';
	                                                                                        }

	                                                                                        $d++;

	                                                                                        if( $d >= $total_feature_dis ) break;
	                                                                                    }
	                                                                                }
	                                                                            }
	                                                                            
	                                                                    $html .= '</div></div></div>'; // /row // container-fluid
	                                                                }

	                                                            $html .= '</div>'; // /content

	                                                        $html .= '</div>'; // /item
	                                                    }else if( $settings['product_style'] == 'style4' ){

	                                                    	$html .= '<div class="rental_item item '.$settings['product_style'].'">';

	                                                    		/* Image */
	                                                            $html .= '<div class="wrap_img">';
	                                                                    $html .= ( $settings['show_thumbnail'] == 'yes' ) ? '<img src="'.$img.'" srcset="'.esc_url( $img_vehicle_m ).' 600w, '.esc_url( $img_ireca_list ).' 350w" sizes="(max-width: 600px) 100vw, 600px"  alt="'.get_the_title().'">' : '';
	                                                            $html .= '</div>'; 
	                                                            /* Image */
	                                                                    
	                                                            $show_price_no = ( $settings['show_price'] == 'no' ) ? 'show_price_no' : '';

	                                                            $html .= '<div class="content '.$show_price_no.'">';


	                                                            	/* Price */
                                                                        if( $settings['show_price'] == 'yes' ){

                                                                            $is_produc_type = $product->is_type('ovacrs_car_rental') ? true : false ;

                                                                            $html .= '<div class="price">';

                                                                            	if( $is_produc_type ){
                                                                            		if( ovacrs_get_price_type( get_the_id() ) == 'day' ){
                                                                                        $html .= '<span class="amount">'.ovacrs_get_price_day( get_the_id() ).'</span>';
                                                                                        $html .= ( $settings['show_time_rental'] == 'yes' && $is_produc_type ) ? '<span class="time">'.esc_html__( '/ Day', 'ireca' ).'</span>' : '';
                                                                                    }else if( ovacrs_get_price_type( get_the_id() ) == 'hour' ){
                                                                                        $html .= '<span class="amount">'.ovacrs_get_price_hour( get_the_id() ).'</span>';
                                                                                        $html .= ( $settings['show_time_rental'] == 'yes' && $is_produc_type ) ? '<span class="time">'.esc_html__( '/ Hour', 'ireca' ).'</span>' : '';
                                                                                    }else if( ovacrs_get_price_type( get_the_id() ) == 'mixed' ) {
                                                                                        $html .= '<span class="amount">'.ovacrs_get_price_day( get_the_id() ).'</span>';
                                                                                        $html .= ( $settings['show_time_rental'] == 'yes' && $is_produc_type ) ? '<span class="time">'.esc_html__( '/ Day', 'ireca' ).'</span>' : '';
                                                                                    }
                                                                            	}else{
                                                                            		$html .= $product->get_price_html();
                                                                            	}
                                                                                    
                                                                                    	
                                                                                    
                                                                                    
                                                                            $html .= '</div>';
                                                                        }
                                                                    /* /Price */

	                                                                $html .= ( $settings['show_title'] == 'yes' ) ? '<h3 class="title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>' : '';

	                                                                if( $settings['show_rating_star'] == 'yes' || $settings['show_rating_text'] == 'yes' ){
		                                                                $html .= '<div class="woocommerce-product-rating">';

		                                                                    if( $settings['show_rating_star'] == 'yes' ){
		                                                                        $html .= wc_get_rating_html( $average, $rating_count );    
		                                                                    }
		                                                                    

		                                                                    if( comments_open() && $settings['show_rating_text'] == 'yes' ){
		                                                                        $html .= '<span class="count">'.$review_count.'</span>'.esc_html__( ' reviews', 'ireca' );  
		                                                                    }

		                                                                $html .= '</div>';
	                                                            	}


	                                                               	// Show attribute
	                                                               	if( $settings['show_attribute'] == 'yes' ){
		                                                               	$attributes = $product->get_attributes();
		                                                               	foreach ( $attributes as $attribute ) :
		                                                               		
		                                                               		$values = array();

																			if ( $attribute->is_taxonomy() ) {
																				$attribute_taxonomy = $attribute->get_taxonomy_object();
																				$attribute_values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

																				foreach ( $attribute_values as $attribute_value ) {
																					$value_name = esc_html( $attribute_value->name );

																					if ( $attribute_taxonomy->attribute_public ) {
																						$values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
																					} else {
																						$values[] = $value_name;
																					}
																				}
																			} else {
																				$values = $attribute->get_options();

																				foreach ( $values as &$value ) {
																					$value = make_clickable( esc_html( $value ) );
																				}
																			}

																			$html .= '<div class="product_attr"><span class="label">'.wc_attribute_label( $attribute->get_name() ).': </span><span class="value">'.apply_filters( 'woocommerce_attribute',  wptexturize( implode( ', ', $values ) ) , $attribute, $values ).'</span></div>';
																			
		                                                               	endforeach;
	                                                               }
	                                                               	// /Show attribute

	                                                                if( $settings['show_feature'] == 'yes' ){
	                                                                    $html .= '<div class="features"><div class="container-fluid"><div class="row">';

	                                                                            $features = get_post_meta( get_the_id(), 'ovacrs_features_special', true );
	                                                                            $icon = get_post_meta( get_the_id(), 'ovacrs_features_icons', true );
	                                                                            $desc = get_post_meta( get_the_id(), 'ovacrs_features_desc', true );
	                                                                            $d = 0;
	                                                                            if( $features ){
	                                                                                foreach ($features as $key => $value) {
	                                                                                    if( $value == 'yes' && trim( $desc[$key] ) != '' && trim( $icon[$key] ) != '' ){
	                                                                                        $class = ($d%2) ? 'eve' : 'odd';
	                                                                                        $html .= '<div class="feature-item '.$class.'">';
	                                                                                            $html .= '<i class="'.$icon[$key].'"></i>';
	                                                                                            $html .= '<span class="desc">'.$desc[$key].'</span>';
	                                                                                        $html .= '</div>';
	                                                                                        $d++;
	                                                                                    }
	                                                                                }
	                                                                            }
	                                                                            
	                                                                    $html .= '</div></div></div>'; // /row // container-fluid
	                                                                }

	                                                                /* Button text */
	                                                                $html .= ( $settings['butotn_text'] != '' ) ? '<a href="'.get_the_permalink().'" class="ireca_btn"><span>'.$settings['butotn_text'].'</span><i class="arrow_right"></i></a>' : '';

	                                                            $html .= '</div>'; // /content

	                                                        $html .= '</div>'; // /item

	                                                    }




	                                                if( $group_slide == $settings['total_items_column']  || $t_items_cat == $ireca_products->post_count ){        
	                                                    $html .= '</div>'; // /Slide
	                                                }

	                                         
	                                            $group_slide++;
	                                            $t_items_cat++;

	                                        endwhile; endif; wp_reset_postdata();



	                                
	                                    $html .= '</div>'; // /owl-carousel

	                                if( $settings['show_nav'] == 'yes' && ( $ireca_products->post_count > $settings['total_items_column'] * $settings['total_columns_slide'] ) ){
	                                     $html .= '<div class="wrap_nav"><div class="ireca_nav">
	                                                
	                                                <a class="carousel-control-prev" href="#carousel'.$cat->slug.'" role="button" data-slide="prev">
	                                                    <i class="fas fa-caret-left"></i>
	                                                </a>';

	                                                if( $settings['icon_nav'] != '' || $settings['show_available'] == 'yes' ){
		                                                $html .= '<div class="icon_nav">';
		                                                    $html .= $settings['icon_nav'] != '' ? '<i class="'.$settings['icon_nav'].'"></i>' : '';
		                                                    $html .= $settings['show_available'] == 'yes' ? '<span>'.esc_html__('Available', 'ireca').' <strong class="total_items">'.$ireca_products->post_count.'</strong> '.esc_html__('items', 'ireca').'</span>' : '';
		                                                $html .= '</div>';
	                                                }
	                                                
	                                                $html .= '<a class="carousel-control-next" href="#carousel'.$cat->slug.'" role="button" data-slide="next">
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



	   	echo $html;



	}

	
	
}
