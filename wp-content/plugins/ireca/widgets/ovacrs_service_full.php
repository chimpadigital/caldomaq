<?php
namespace Ireca\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class ovacrs_service_full extends Widget_Base {

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
		return 'ovacrs_service_full';
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
		return __( 'Service Full', 'ireca' );
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
	// public function get_script_depends() {
	// 	return [ 'ireca' ];
	// }

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
				'title',
				[
					'label' => __( 'Title', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					"default" => __( 'Our services', 'irece' )
				]
			);

			$this->add_control(
				'sub_title',
				[
					'label' => __( 'Sub title', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					"default" => __( 'We provide best services', 'irece' )
				]
			);

			$this->add_control(
				'image',
				[
					'label' => __( 'Image', 'ireca' ),
					'type' => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'service',
				[
					'label' => __( 'Service Item', 'ireca' ),
					'type' => Controls_Manager::REPEATER,
					'default' => [
						[
							'name' => __( 'OIL CHANGES', 'ireca' ),
							'link'	=> '#',
							'desc' => __( 'Voluptatem perspiciatis sed ut unde omnis iste natus error sit acantium dolore', 'ireca' ),
							'icon'	=> 'carflaticon-car-oil',
							'class' => '',
						],
						[
							'title' => __( 'OIL CHANGES', 'ireca' ),
							'link'	=> '#',
							'desc' => __( 'Voluptatem perspiciatis sed ut unde omnis iste natus error sit acantium dolore', 'ireca' ),
							'icon'	=> 'carflaticon-car-oil',
							'class' => '',
						],
						
					],
					'fields' => [
						[
							'name' => 'name',
							'label' => __( 'Title', 'ireca' ),
							'type' => Controls_Manager::TEXT,
							'default' => __( 'OIL CHANGES' , 'ireca' ),
							'dynamic' => [
								'active' => true,
							],
							'label_block' => true,
						],
						[
							'name' => 'link',
							'label' => __( 'Link', 'ireca' ),
							'type' => Controls_Manager::TEXT,
							'default' => '#',
							'dynamic' => [
								'active' => true,
							],
							'label_block' => true,
						],
						[
							'name' => 'desc',
							'label' => __( 'Description', 'ireca' ),
							'type' => Controls_Manager::TEXT,
							'default' => __( 'Voluptatem perspiciatis sed ut unde omnis iste natus error sit acantium dolore' , 'ireca' ),
							'dynamic' => [
								'active' => true,
							],
							'label_block' => true,
						],
						[
							'name' => 'icon',
							'label' => __( 'Icon font', 'ireca' ),
							'type' => Controls_Manager::TEXT,
							'default' => __( 'carflaticon-car-oil' , 'ireca' ),
							'dynamic' => [
								'active' => true,
							],
							'label_block' => true,
						],
						[
							'name' => 'class',
							'label' => __( 'Class', 'ireca' ),
							'type' => Controls_Manager::TEXT,
							'dynamic' => [
								'active' => true,
							],
							'label_block' => true,
						],
					],
					'title_field' => '{{{ name }}}',
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

		$html = '<div class="ovacrs_service_full '.$settings['class'].'">';

			$html .= '<div class="heading justify-content-between ">';
				$html .= '<h3 class="title">'.$settings['title'].'</h3>';
				$html .= '<div class="sub_title">'.$settings['sub_title'].'</div>';
			$html .= '</div>';

			
			
			$html .= '<div class="container">';

				$html .= '<div class="content">';

					$html .= '<div class="img d-none d-lg-block"><img src="'.$settings['image']['url'].'" alt="'.$settings['title'].'" /></div>';

					$html .= '<div class="wrap_service row">'; $a = 0;
						foreach ( $settings['service'] as $index => $item ) :
							
							
							if( $a == 2 ) $a = 0;
							if( $a == 0 ){
								$html .= '<div class="col-lg-4 d-none d-lg-block"></div>';
							}
							$a++;

						    $html .= '<div class="col-lg-4 col-md-6"><div class="item '.$item['class'].'">';

						       $html .= '<div class="icon align-items-center"><i class="'.$item['icon'].'"></i></div>';

						       $html .= '<div class="info">';
						       	if( $item['link'] != '' ){
						       		$html .= '<h3 class="name"><a href="'.$item['link'].'">'.$item['name'].'</a></h3>';	
						       	}else{
						       		$html .= '<h3 class="name">'.$item['name'].'</h3>';
						       	}
						          
						          $html .= '<div class="desc">'.$item['desc'].'</div>';
						        $html .= '</div>';
						      
						    $html .= '</div></div>'; // Col-md

				        endforeach;
			    	$html .= '</div>'; // wrap_service

		    	$html .= '</div>'; // content	   
				
			$html .= '</div>';	
		$html .= '</div>';

		echo $html;
	}

	
}
