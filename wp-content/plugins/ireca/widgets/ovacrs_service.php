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
class ovacrs_service extends Widget_Base {

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
		return 'ovacrs_service';
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
		return __( 'Service', 'ireca' );
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
		return [ 'ovacrs_service' ];
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
			'title',
			[
				'label' => __( 'Title', 'ireca' ),
				'type' => Controls_Manager::TEXT,
				"default" => __( 'Car Support', 'ireca' ),
			]
		);

		$this->add_control(
			'title_link',
			[
				'label' => __( 'Link', 'ireca' ),
				'type' => Controls_Manager::TEXT,
				"default" => '#',
			]
		);
		$this->add_control(
			'target',
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
			'icon',
			[
				'label' => __( 'Icon Font', 'ireca' ),
				'type' => Controls_Manager::TEXT,
				"default" => 'flaticon-diamond',
			]
		);

		$this->add_control(
			'content',
			[
				'label' => __( 'Content', 'ireca' ),
				'type' => Controls_Manager::WYSIWYG,
				"default" => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'ireca' ),
			]
		);

		$this->add_control(
			'show_line',
			[
				'label' => __( 'Show line', 'ireca' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'ireca' ),
				'label_off' => __( 'Hide', 'ireca' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'ireca' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => __( 'Style 1', 'ireca' ),
					'style2'  => __( 'Style 2', 'ireca' ),
					
				],
			]
		);

		$this->add_control(
			'show_border',
			[
				'label' => __( 'Show border', 'ireca' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'show_border',
				'options' => [
					'show_border' => __( 'Yes', 'ireca' ),
					'no_show_border'  => __( 'no', 'ireca' ),
					
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


		$html = '<div class="ireca_service '.$settings['class'].' '.$settings['style'].' '.$settings['show_border'].'">';
        
	        $html .= '<i class="'.$settings['icon'].'"></i>';
	        $html .= '<div class="content">';
	            if( $settings['title_link'] != '' ){
	                $html .= $settings['title'] ? '<h3><a target="'.$settings['target'].'" href="'.$settings['title_link'].'">'.$settings['title'].'</a></h3>' : '';
	            }else{
	                $html .= $settings['title'] ? '<h3>'.$settings['title'].'</h3>' : '';    
	            }
	            
	            $html .= $settings['content'] ? '<div class="desc">'.do_shortcode( $settings['content'] ).'</div>' : '';
	            $html .= $settings['show_line'] == 'yes' ? '<div class="line"></div>': '';
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
		<div class="ireca_service {{{ settings.class }}} {{{ settings.style }}} {{{ settings.show_border }}} ">
			<i class="{{{ settings.icon }}}"></i>
			<div class="content">
				<h3><a target="{{{ settings.target }}}" href="{{{ settings.title_link }}}">{{{ settings.title }}}</a></h3>
				<div class="desc">{{{ settings.content }}}</div>
				<# if ( settings.show_line == 'yes' ) { #>
				<div class="line"></div>
				<# } #>
			</div>
		</div>
		<?php
	}
}
