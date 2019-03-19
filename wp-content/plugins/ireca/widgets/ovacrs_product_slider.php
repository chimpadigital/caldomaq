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
class ovacrs_product_slider extends Widget_Base {

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
		return 'ovacrs_product_slider';
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
		return __( 'Product Slider', 'ireca' );
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
				'search_by',
				[
					'label' => __( 'Search By', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'type',
					'options' => [
						'type'  => __( 'Type', 'ireca' ),
						'product_cat' => __( 'Category', 'ireca' ),
					],
					'description' => __( 'Type: Find in Products >> Type <br/> Category: Find in Products >> Categories ', 'ireca' ),
				]
			);


			$this->add_control(
				'array_slug',
				[
					'label' => __( 'Slug Category/Type', 'ireca' ),
					'Separator' => __( 'Example: ', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					'description' => __( 'Type: Find Slug column in Products >> Type <br/> Category: Find in Products >> Categories ', 'ireca' ),
				]
			);

			$this->add_control(
				'tab_active',
				[
					'label' => __( 'Active Category/Type', 'ireca' ),
					'description' => __( 'Insert Slug of Category', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					'description' => __( 'Type: Find Slug column in Products >> Type <br/> Category: Find in Products >> Categories ', 'ireca' ),
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
					'description' => __( 'Insert -1 to display all items in category', 'ireca' ),
					'min' => -1,
					"default" => 100
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
				'always_show_info',
				[
					'label' => __( 'Always Show Price, Title', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'no_always_show_info',
					'options' => [
						'no_always_show_info' => __( 'No', 'ireca' ),
						'always_show_info'  => __( 'Yes', 'ireca' ),
						
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
				'slidestoshow',
				[
					'label' => __( 'Total main slide in Slide', 'ireca' ),
					'type' => Controls_Manager::NUMBER,
					'min' => 1,
					'default' => 3,
					

				]
			);

			$this->add_control(
				'centermode',
				[
					'label' => __( 'Allow a part image at left, right of slide', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'true',
					'options' => [
						'true'  => __( 'Yes', 'ireca' ),
						'false' => __( 'No', 'ireca' )
					],
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
				'tab_show_image',
				[
					'label' => __( 'Show Image', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes'  => __( 'Yes', 'ireca' ),
						'no' => __( 'No', 'ireca' )
					],

				]
			);

			$this->add_control(
				'tab_show_title',
				[
					'label' => __( 'Show title', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes'  => __( 'Yes', 'ireca' ),
						'no' => __( 'No', 'ireca' )
					],

				]
			);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_slider',
			[
				'label' => __( 'Slider Settings', 'ireca' ),
			]
		);

			$this->add_control(
				'show_nav',
				[
					'label' => __( 'Show Navigation', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'false',
					'options' => [
						'false'  => __( 'No', 'ireca' ),
						'true' => __( 'Yes', 'ireca' ),
						
					],

				]
			);

			$this->add_control(
				'show_dots',
				[
					'label' => __( 'Show Dots', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'true',
					'options' => [
						'true' => __( 'Yes', 'ireca' ),
						'false'  => __( 'No', 'ireca' )
					],

				]
			);

			$this->add_control(
				'autoplay',
				[
					'label' => __( 'Autoplay', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'false',
					'options' => [
						'false' => __( 'No', 'ireca' ),
						'true'  => __( 'Yes', 'ireca' )
					],

				]
			);

			$this->add_control(
				'autoplayspeed',
				[
					'label' => __( 'Autoplay Speed (ms)', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					'description' => __( 'Example: 3000 (ms)', 'ireca' ),
					'default' => '3000'
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
                'taxonomy'                 => $settings['search_by'],
                'pad_counts'               => false 

              )
         );

         $rand = 'time'.rand().'_s';


        $array_slug = explode( ',', trim( $settings['array_slug'] ) );

        

        $html = '<div class="woocommerce ovacrs_product_slider '.$settings['class'].'">';

	        // Nav
	        if( $settings['show_tab'] == 'yes' ){
	            $html .= '<ul class="nav nav-pills '.$settings['align_tab'].' "  role="tablist">';

	                    for( $i=0; $i < count($array_slug); $i++ ){

	                      foreach ($categories as $key => $cat) {

	                        if(trim( $array_slug[$i] ) == $cat->slug){

	                        	if( $settings['search_by'] == 'type' ){
	                        		
	                        			$cat_image_url = function_exists('z_taxonomy_image_url') ? z_taxonomy_image_url( $cat->term_id ) : '';
	                        		
	                        	}else{
	                        		$cat_thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
	    							$cat_image_url = wp_get_attachment_url( $cat_thumbnail_id );	
	                        	}
	                        	

	                            $item_active = ($cat->slug == $settings['tab_active']) ? ' active ':'';
	                            $html .= '<li class="nav-item '.$cat->slug.' ">
	                                        <a class="nav-link '.$item_active.'" id="'.$cat->slug.'-tab-'.$rand.'" data-toggle="pill" href="#'.$cat->slug.$rand.'" role="tab"  aria-selected="true">';
	                                        		$html .= ( $cat_image_url && $settings['tab_show_image'] == 'yes' ) ? '<div class="wrap_img"><img src="'.$cat_image_url.'" alt="'.$cat->name.'" /></div>' : '';
	                                        	$html .= ( $settings['tab_show_title'] == 'yes' ) ? '<span>'.$cat->name.'</span>' : '';
	                                        	$html .= '</a>
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

	                            

	                            $html .= '<div class="tab-pane fade '.$item_active.'" id="'.$cat->slug.$rand.'" role="tabpanel">';

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
	                                                'taxonomy' => $settings['search_by'],
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
	                                                'taxonomy' => $settings['search_by'],
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
	                                                'taxonomy' => $settings['search_by'],
	                                                'field'    => 'slug',
	                                                'terms'    => $cat->slug,
	                                            )
	                                        ),

	                                    );
	                                }


	                                $args_product = array_merge_recursive( $args_basic, $args_orderby, $args_filters );

	                                $ireca_products = new \WP_Query($args_product);
	                               
									

	                                $html .= '<div class="ovacrs_product_slider_slick '.$cat->slug.'" data-total_item = '.$ireca_products->post_count.' data-slidestoshow="'.$settings['slidestoshow'].'" data-centermode="'.$settings['centermode'].'" data-autoplay="'.$settings['autoplay'].'" data-autoplayspeed="'.$settings['autoplayspeed'].'" data-show_nav="'.$settings['show_nav'].'" data-show_dots="'.$settings['show_dots'].'">';

	                                      if( $ireca_products->have_posts() ): while( $ireca_products->have_posts() ):  $ireca_products->the_post();

	                                            global $product;

	                                            $img  = wp_get_attachment_image_url( get_post_thumbnail_id(), 'large' );
	                                            

                                                    $html .= '<div class="item"><div class="wrap_item">';
                                                                   
                                                                   $html .= '<img src="'.$img.'" alt="'.get_the_title().'">';
                                                                       
                                                                    $html .= '<div class="bottom '.$settings['always_show_info'].'"><div class="content">';

	                                                                    if( $settings['show_price'] == 'yes' ){

	                                                                    	$html .= '<div class="price">';

		                                                                        $is_produc_type = $product->is_type('ovacrs_car_rental') ? true : false ;

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

	                                                                    $html .= ( $settings['show_title'] == 'yes' ) ? '<h3 class="title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>' : '';

                                                                    $html .= '</div></div>'; // /content /bottom

                                                    $html .= '</div></div>'; // /item

	                                              

	                                        endwhile; endif; wp_reset_postdata();



	                                
	                                    $html .= '</div>'; // /ovacrs_product_slider_slick

	                               

	                                
	                            $html .= '</div>'; // tab-pane

	                            

	                           

	                        } // End if   
	                    } //End Foreach
	                }   // End for
	                
	        $html .= '</div>'; // /tab-content



	        
	    $html .= '</div>'; // /ovacrs_product_slider



	   	echo $html;



	}

	
	
}
