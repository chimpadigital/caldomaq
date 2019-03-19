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
class ovacrs_text_support extends Widget_Base {

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
		return 'ovacrs_text_support';
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
		return __( 'Text Support', 'ireca' );
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
		return [ '' ];
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
				]
			);

			$this->add_control(
				'content',
				[
					'label' => __( 'Content', 'ireca' ),
					'type' => Controls_Manager::WYSIWYG,
				]
			);


			$this->add_control(
				'show_line',
				[
					'label' => __( 'Show line', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes' => __( 'Yes', 'ireca' ),
						'no'  => __( 'No', 'ireca' ),
						
					],
				]
			);

			$this->add_control(
				'text_color',
				[
					'label' => __( 'Text color', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'dark',
					'options' => [
						'dark' => __( 'Dark', 'ireca' ),
						'white'  => __( 'White', 'ireca' ),
						
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

		$html = '<div class="ovacrs_support '.$settings['class'].' '.$settings['text_color'].'">';

        $html .= $settings['title'] ? '<h3 class="title">'.$settings['title'].'</h3>' : '';
        $html .= $settings['content'] ? '<div class="desc">'.$settings['content'].'</div>' : '';

        $html .= $settings['show_line'] == 'yes' ? '<span class="line"></span>' : '';
    
    	$html .= '</div>';



      echo $html;
	}

	protected function _content_template() {
		?>
		<div class="ovacrs_support {{{ settings.class }}}  {{{ settings.text_color }}} ">
			<h3 class="title">{{{ settings.title }}}</h3>
			<div class="desc">{{{ settings.content }}}</div>
			<# if( settings.show_line == 'yes' ){ #>
				<span class="line"></span>
			<# } #>
		</div>
		<?php
	}

	
}
