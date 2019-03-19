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
class ovacrs_info extends Widget_Base {

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
		return 'ovacrs_info';
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
		return __( 'Info', 'ireca' );
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
					'default' => __( 'Title', 'ireca' ),
				]
			);

			$this->add_control(
				'show_line',
				[
					'label' => __( 'Show line', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes' => __( 'True', 'ireca' ),
						'no'  => __( 'False', 'ireca' ),
						
					],
				]
			);

			$this->add_control(
				'color',
				[
					'label' => __( 'Color', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'dark',
					'options' => [
						'dark' => __( 'Dark', 'ireca' ),
						'white'  => __( 'White', 'ireca' ),
						
					],
				]
			);

			$this->add_control(
				'desc',
				[
					'label' => __( 'Description', 'ireca' ),
					'type' => Controls_Manager::WYSIWYG,
					'default' => __( 'Description', 'ireca' ),
				]
			);

			$this->add_control(
				'link',
				[
					'label' => __( 'Link', 'ireca' ),
					'type' => Controls_Manager::TEXT,
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

		$html = '<div class="ovacrs_info '.$settings['class'].' '.$settings['color'].' ">';
			if( $settings['link'] != '' ){
				$html .= $settings['title'] ? '<h3 class="title"><a href="'.$settings['link'].'" target="'.$settings['target'].'">'.$settings['title'].'</a></h3>' : '';
			}else{
				$html .= $settings['title'] ? '<h3 class="title">'.$settings['title'].'</h3>' : '';	
			}
			
			$html .= ( $settings['show_line'] == 'yes' ) ? '<div class="line"></div>' : '';
			$html .= $settings['desc'] ? '<div class="desc">'.$settings['desc'].'</div>' : '';
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
		<div class="ovacrs_info {{{ settings.class }}} {{{ settings.color }}}">
			
			<h3 class="title"><a href="{{{ settings.link }}}" target="{{{ settings.target }}}">{{{ settings.title }}} </h3>

			<# if( settings.show_line == 'yes' ) { #>
				<div class="line"></div>
			<# } #>

			<div class="desc">{{{ settings.desc }}}</div>

		</div>
		<?php
	}
}
