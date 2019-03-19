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
class ovacrs_thumbnail_info extends Widget_Base {

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
		return 'ovacrs_thumbnail_info';
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
		return __( 'Thumbnail Info', 'ireca' );
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
				'image',
				[
					'label' => __( 'Image Background', 'ireca' ),
					'type' => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
				]
			);

			
			$this->add_control(
				'title',
				[
					'label' => __( 'Title', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					'default' => __( 'Are you looking for a car?', 'ireca' )
				]
			);

			$this->add_responsive_control(
				'title_padding',
				[
					'label' => __( 'Padding', 'plugin-name' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			
			$this->add_control(
				'content',
				[
					'label' => __( 'Content', 'ireca' ),
					'type' => Controls_Manager::WYSIWYG,
					'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore', 'ireca' )
				]
			);

			$this->add_control(
				'icon',
				[
					'label' => __( 'Icon Font', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					'default' => 'fas fa-long-arrow-alt-right'
				]
			);
			$this->add_control(
				'link',
				[
					'label' => __( 'Link', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					'default' => '#'
				]
			);

			$this->add_control(
				'target',
				[
					'label' => __( 'Button Target', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => '_self',
					'options' => [
						'_self' => __( 'Same Window', 'ireca' ),
						'_blank'  => __( 'New Window', 'ireca' ),
						
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

		$html = '<div class="ovacrs_thumbnail_info '.$settings['class'].'" style="background: url( '.$settings['image']['url'].' )">';

       

	       $html .= '<div class="content content_hover">';

	          if( $settings['link'] != '' ){
	            $html .= '<div class="title"><a href="'.$settings['link'].'" target="'.$settings['target'].'">'.$settings['title'].'</a></div>';
	          }else{
	            $html .= '<div class="title">'.$settings['title'].'</div>';  
	          }
	          
	          $html .= '<div class="thum_bottom">';
	              $html .= '<div class="desc">'.$settings['content'].'</div>';
	              $html .= $settings['icon'] ? '<div class="icon"><a href="'.$settings['link'].'"  target="'.$settings['target'].'">
	                                <i class="'.$settings['icon'].'"></i></a></div>' : '';
	          $html .= '</div>';
	          

	       $html .= '</div>';
	      
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
		<div class="ovacrs_thumbnail_info {{{ settings.class }}}" style="background: url( {{{ settings.image.url }}} )">
			
			<div class="content">

				<div class="title"><a href=" {{{ settings.link }}}" target="{{{ settings.target }}}">{{{ settings.title }}}</a></div>
				
				<div class="thum_bottom">
					<div class="desc">{{{ settings.content }}}</div>
					<div class="icon">
						<a href="{{{ settings.link }}}"  target="{{{ settings.target }}}"><i class="{{{ settings.icon }}} "></i></a>
					</div>
				</div>

			</div>
		</div>
		<?php
	}
	
}
