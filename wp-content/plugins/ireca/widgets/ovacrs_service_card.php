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
class ovacrs_service_card extends Widget_Base {

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
		return 'ovacrs_service_card';
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
		return __( 'Service Card', 'ireca' );
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
		return [ 'ovacrs_service_card' ];
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
			'img',
			[
				'label' => __( 'Image', 'ireca' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'skew_img',
			[
				'label' => __( 'Skew Image', 'ireca' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'skew_img',
				'options' => [
					'skew_img' => __( 'Yes', 'ireca' ),
					'no_skew_img'  => __( 'no', 'ireca' ),
					
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'ireca' ),
				'type' => Controls_Manager::TEXT,
				"default" => __( 'Business rental', 'ireca' ),
			]
		);

		$this->add_control(
			'desc',
			[
				'label' => __( 'Description', 'ireca' ),
				'type' => Controls_Manager::WYSIWYG,
				"default" => __( 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque ', 'ireca' ),
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label' => __( 'Text', 'ireca' ),
				'type' => Controls_Manager::TEXT,
				"default" => 'View Detail',
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' => __( 'Link', 'ireca' ),
				'type' => Controls_Manager::TEXT,
				"default" => '#',
			]
		);
		$this->add_control(
			'btn_target',
			[
				'label' => __( 'Target', 'ireca' ),
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


		$html = '<div class="ireca_service_card '.$settings['class'].'">';
        
	        $html .= '<img src="'.$settings['img']['url'].'"></img>';

	        $html .= $settings['skew_img'] == 'skew_img' ? '<div class="bg_white_skew"></div>': '';

	        $html .= '<div class="content '.$settings['skew_img'].'">';

	        	$html .= $settings['title'] ? '<h3 class="title">'.$settings['title'].'</h3>' : '';    

	        	$html .= $settings['desc'] ? '<div class="desc">'.do_shortcode( $settings['desc'] ).'</div>' : '';

	            
	            $html .= $settings['btn_link'] ? '<a class="ireca_btn ireca_tran" target="'.$settings['btn_target'].'" href="'.$settings['btn_link'].'"><i class="arrow_carrot-right_alt2"></i>'.$settings['btn_text'].'</a>' : '';
	            
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
		<div class="ireca_service_card {{{ settings.class }}} ">
			<img src="{{{ settings.img.url }}}"></img>

			<# if( settings.skew_img == 'skew_img' ){ #> 
				<div class="bg_white_skew"></div>
			<# } #>
			

			<div class="content {{{ settings.skew_img }}} ">
				<h3 class="title">{{{ settings.title }}}</h3>
				<div class="desc">{{{ settings.desc }}}</div>
				<a class="ireca_btn ireca_tran" target="{{{ settings.btn_target }}}" href="{{{ settings.btn_link }}}">{{{ settings.btn_text }}}</a>
			</div>
		</div>
		<?php
	}
}
