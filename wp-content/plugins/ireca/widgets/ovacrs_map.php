<?php
namespace Ireca\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Base_Multiple;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class ovacrs_map extends Widget_Base {

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
		return 'ovacrs_map';
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
		return __( 'Vehicle Map', 'ireca' );
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

	public function get_script_depends() {
		return [ 'ireca-elementor', 'markerclusterer', 'ova-google-maps-api' ];
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

			$taxonomy     = 'product_cat';
			  $orderby      = 'name';  
			  $show_count   = 0;      // 1 for yes, 0 for no
			  $pad_counts   = 0;      // 1 for yes, 0 for no
			  $hierarchical = 1;      // 1 for yes, 0 for no  
			  $title        = '';  
			  $empty        = 0;

			  $args = array(
			         'taxonomy'     => $taxonomy,
			         'orderby'      => $orderby,
			         'show_count'   => $show_count,
			         'pad_counts'   => $pad_counts,
			         'hierarchical' => $hierarchical,
			         'title_li'     => $title,
			         'hide_empty'   => $empty
			  );
			$all_categories = get_categories( $args );

			$cat_array = array('' => esc_html__('All', 'ireca'));
			foreach ($all_categories as $key => $value) {
				$cat_array[$value->slug] =	$value->cat_name;
			}

			$this->add_control(
				'cat_map',
				[
					'label' => __( 'Choose a Category to display', 'ireca' ),
					'description' => __( 'Empty to display full', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => '',
					'options' => $cat_array,
				]
			);

			$this->add_control(
				'height_map',
				[
					'label' => __( 'HEIGHT', 'ireca' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 100,
					'step' => 1,
					'default' => 500,
				]
			);
			$this->add_control(
				'zoom_map',
				[
					'label' => __( 'Zoom', 'ireca' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 20,
					'step' => 1,
					'default' => 10,
				]
			);
			$this->add_control(
				'readmore_text',
				[
					'label' => __( 'Read More', 'ireca' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Rent It', 'ireca' )
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
		$args_cat = $vehicles = $id_vehicle_array = $attr_map = array();

		/* Get Vehicle //////////////////////////////////////////////////////////*/
		$args_basic = array(
			'post_type'	=> 'product',
			'posts_per_page'	=> '-1',
			'post_status'	=> 'publish',
		);
		
		if( $settings['cat_map'] ){
			$args_cat = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'product_cat',
						'field'    => 'slug',
						'terms'    => $settings['cat_map'],
					),
				),
			);
		}

		$args = array_merge( $args_basic, $args_cat );


		$i = 0;

		$products = new \WP_Query( $args );
		
		if ( $products->have_posts() ) : while ( $products->have_posts() ) : $products->the_post();

			global $post;
			
			$vehicle_array = get_post_meta( $post->ID, 'ovacrs_id_vehicles', true );

			if( !empty( $vehicle_array ) && is_array($vehicle_array) ){

				// Price of Product
				$price = '';
				$price_type = get_post_meta( $post->ID, 'ovacrs_price_type', true );
				$price_hour = 	get_post_meta( $post->ID, 'ovacrs_regul_price_hour', true );
				$price_day = 	get_post_meta( $post->ID, '_regular_price', true );
				switch ($price_type) {

					case 'hour':
						$price .= wc_price( $price_hour ).' '.esc_html__( '/ Hour', 'ireca' );
						break;

					case 'day':
						$price .= wc_price( $price_day ).' '.esc_html__( '/ Day', 'ireca' );
						break;

					case 'mixed':
						$price .= wc_price( $price_hour ).' '.esc_html__( '/ Hour', 'ireca' );
						$price .= ' - '.wc_price( $price_day ).' '.esc_html__( '/ Day', 'ireca' );
						break;
					default:
						$price = '';
						break;
				}

				// Feature Product
				$ovacrs_features_desc = get_post_meta( $post->ID, 'ovacrs_features_desc', true );
				$ovacrs_features_icons = get_post_meta( $post->ID, 'ovacrs_features_icons', true );
				$vehi_features = '';
				$f = 0;
				if( $ovacrs_features_desc ){
					foreach ($ovacrs_features_desc as $key => $value) {
						$vehi_features .= '<td><i class="'.$ovacrs_features_icons[$key].'"></i>'.$ovacrs_features_desc[$key].'</td>';
						$f++;
						if( $f == 3 )	break;
					}
				}
				

				// Push data to vehicles array
				foreach ($vehicle_array as $key => $value) {
					$vehicles[$i]['id_veh'] = $id_vehicle_array[] = $value;
					$vehicles[$i]['title'] = get_the_title();
					$vehicles[$i]['img'] = wp_get_attachment_url(get_post_thumbnail_id());
					$vehicles[$i]['url'] = get_the_permalink();
					$vehicles[$i]['price'] = $price;
					$vehicles[$i]['feature'] = $vehi_features;
				}


				$i++;
				

			}


		endwhile;endif; wp_reset_postdata();



		/* Get ID vehicle //////////////////////////////////////////////////////////*/
		$id_vehicle_detail = array();
		$args_id_vehicle = array(
			'post_type'	=> 'vehicle',
			'posts_per_page'	=> '-1',
			'post_status'	=> 'publish',
			'meta_query' => array(
				array(
					'key'     => 'ireca_met_id_vehicle',
					'value'   => $id_vehicle_array,
					'compare' => 'IN',
				),
			),
		);


		

		$k = 0;
		$id_vehicles = new \WP_Query( $args_id_vehicle );

		if ( $id_vehicles->have_posts() ) : while ( $id_vehicles->have_posts() ) : $id_vehicles->the_post();

			global $post;
			
			$loop_id_vehicle = get_post_meta( $post->ID, 'ireca_met_id_vehicle', true ) ? get_post_meta( $post->ID, 'ireca_met_id_vehicle', true ) : '';
			
			$id_vehicle_lat_lon	= get_post_meta( $post->ID, 'ireca_met_vehicle_address', true );
			$id_vehicle_lat = isset( $id_vehicle_lat_lon['latitude'] ) && $id_vehicle_lat_lon['latitude'] != '' ? $id_vehicle_lat_lon['latitude'] : '' ;
			$id_vehicle_lon = isset( $id_vehicle_lat_lon['longitude'] ) && $id_vehicle_lat_lon['longitude'] != '' ? $id_vehicle_lat_lon['longitude'] : '' ;

			if( !empty( $vehicles ) ){
				foreach ($vehicles as $key => $value) {
					if( $loop_id_vehicle  == $value['id_veh'] && $id_vehicle_lat != '' && $id_vehicle_lon!= '' ){

						$id_vehicle_detail[$k]['title'] = $value['title'];
						$id_vehicle_detail[$k]['img'] = $value['img'];
						$id_vehicle_detail[$k]['url'] = $value['url'];
						$id_vehicle_detail[$k]['price'] = $value['price'];
						$id_vehicle_detail[$k]['feature'] = $value['feature'];
						$id_vehicle_detail[$k]['lat'] = $id_vehicle_lat;
						$id_vehicle_detail[$k]['lon'] = $id_vehicle_lon;
						$k++;
					}
				}
			}
			

		endwhile;endif; wp_reset_postdata();

		$attr_map['readmore_text'] = $settings['readmore_text'];
		$attr_map['zoom_map'] =  $settings['zoom_map'];
		$attr_map['icon1'] = plugins_url( '/assets/img/m1.png', ELEMENTOR_IRECA__FILE__ );
		$attr_map['icon2'] = plugins_url( '/assets/img/m2.png', ELEMENTOR_IRECA__FILE__ );
		$attr_map['icon3'] = plugins_url( '/assets/img/m3.png', ELEMENTOR_IRECA__FILE__ );
		$attr_map['icon4'] = plugins_url( '/assets/img/m4.png', ELEMENTOR_IRECA__FILE__ );
		$attr_map['icon5'] = plugins_url( '/assets/img/m5.png', ELEMENTOR_IRECA__FILE__ );

		wp_localize_script( 'ireca', 'vehicle_data', json_encode( $id_vehicle_detail ) );
		wp_localize_script( 'ireca', 'attr_map', json_encode( $attr_map ) );
		
		wp_enqueue_script( 'ireca' );



		echo '<div id="map" style="height: '.$settings['height_map'].'px; width: 100%;"></div>';
   
	}



}
