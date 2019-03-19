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
class ovacrs_team extends Widget_Base {

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
		return 'ovacrs_team';
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
		return __( 'Team', 'ireca' );
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
				'team',
				[
					'label' => __( 'Team Items', 'ireca' ),
					'type' => Controls_Manager::REPEATER,
					'default' => [
						[
							'name' => __( 'Tony Chester', 'ireca' ),
							'job' => __( 'Web Developer', 'ireca' ),
							'desc' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'ireca' ),
							'image'	=> [ 'url' => Utils::get_placeholder_image_src() ],
							'link'	=> '#',
							'target'	=> '_self',
							'class' => '',
						],
						[
							'name' => __( 'Tony Chester', 'ireca' ),
							'job' => __( 'Web Developer', 'ireca' ),
							'desc' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'ireca' ),
							'image'	=> [ 'url' => Utils::get_placeholder_image_src() ],
							'link'	=> '#',
							'target'	=> '_self',
							'class' => '',
						],
					],
					'fields' => [
						[
							'name' => 'name',
							'label' => __( 'Name', 'ireca' ),
							'type' => Controls_Manager::TEXT,
							'default' => __( 'Tony Chester' , 'ireca' ),
							'dynamic' => [
								'active' => true,
							],
							'label_block' => true,
						],
						[
							'name' => 'job',
							'label' => __( 'Job', 'ireca' ),
							'type' => Controls_Manager::TEXT,
							'default' => __( 'Web Developer' , 'ireca' ),
							'dynamic' => [
								'active' => true,
							],
							'label_block' => true,
						],
						[
							'name' => 'image',
							'label' => __( 'Image', 'ireca' ),
							'type' => Controls_Manager::MEDIA,
							'default' => [
								'url' => Utils::get_placeholder_image_src(),
							],
							'dynamic' => [
								'active' => true,
							],
							'label_block' => true,
						],
						[
							'name' => 'desc',
							'label' => __( 'Content', 'ireca' ),
							'type' => Controls_Manager::WYSIWYG,
							'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'ireca' ),
							'show_label' => false,
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
							'name' => 'target',
							'label' => __( 'Target', 'ireca' ),
							'type' => Controls_Manager::SELECT,
							'default' => '_self',
							'options' => [
								'_self' => __( 'Same Window', 'ireca' ),
								'_blank'  => __( 'New Window', 'ireca' ),
								
							],
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
				'count',
				[
					'label' => __( 'Desktop: Total item each slide', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					'default' => 4
				]
			);

			$this->add_control(
				'count_ipad',
				[
					'label' => __( 'Ipad: Total item each slide', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					'default' => 2
				]
			);

			$this->add_control(
				'count_mobile',
				[
					'label' => __( 'Mobile: Total item each slide', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					'default' => 1
				]
			);


			$this->add_control(
				'auto_slider',
				[
					'label' => __( 'Auto Slider', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'true',
					'options' => [
						'true' => __( 'True', 'ireca' ),
						'false'  => __( 'False', 'ireca' ),
						
					],
				]
			);

			$this->add_control(
				'duration',
				[
					'label' => __( 'Duration', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					'description' => __("Duration of slider(ms). 1000ms = 1s",'ireca'),
					'default' => 3000
				]
			);

			$this->add_control(
				'pagination',
				[
					'label' => __( 'Dots Pagination', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'true',
					'options' => [
						'true' => __( 'True', 'ireca' ),
						'false'  => __( 'False', 'ireca' ),
						
					],
				]
			);

			$this->add_control(
				'loop',
				[
					'label' => __( 'Loop', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'true',
					'options' => [
						'true' => __( 'True', 'ireca' ),
						'false'  => __( 'False', 'ireca' ),
						
					],
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

		$html = '<div class="ovacrs_team owl-carousel '.$settings['class'].'" data-loop="'.$settings['loop'].'" data-auto_slider="'.$settings['auto_slider'].'" data-duration="'.$settings['duration'].'" data-pagination="'.$settings['pagination'].'" data-count="'.$settings['count'].'" data-count_ipad="'.$settings['count_ipad'].'" data-count_mobile="'.$settings['count_mobile'].'" >';

	       foreach ( $settings['team'] as $index => $item ) :

	       		$image = $item['image']['url'];
    

			    $html .= '<div class="item '.$item['class'].'">';

			    	$html .= '<img src="'.$image.'" alt="'.$item['name'].'">';

			    	if( $item['link'] != '' ){
			    		$html .= '<div class="name"><a href="'.$item['link'].'" target="'.$item['target'].'">'.$item['name'].'</a></div>';
			    	}else{
			    		$html .= '<div class="name">'.$item['name'].'</div>';
			    	}
			    	

			    	$html .= '<div class="job">'.$item['job'].'</div>';

			       	$html .= '<div class="desc">'.$item['desc'].'</div>';
			      
			    $html .= '</div>';

	       endforeach;
	      
	    $html .= '</div>';
	    
	    echo $html;
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<div class="ovacrs_team owl-carousel {{{ settings.class }}} " data-loop=" {{{ settings.loop }}} " data-auto_slider="{{{ settings.auto_slider }}} " data-duration="{{{ settings.duration }}}" data-pagination="{{{ settings.pagination }}}" data-count="{{{ settings.count }}}" data-count_ipad="{{{ settings.count_ipad }}}" data-count_mobile="{{{ settings.count_mobile }}}" >
			<# _.each( settings.team, function( item, index ) {  #>

				<div class="item {{{ item.class }}} ">
					
					<img src="{{{ item.image.url }}}" alt="{{{ item.name }}} ">

					<h3 class="name"><a href="{{{ item.link }}} ">{{{ item.name }}} </a></h3>

					<div class="job">{{{ item.job }}}</div>

					<div class="desc">{{{ item.desc }}}</div>

				</div>
				
			<# }); #>
		</div>
		<?php
	}
	
}
