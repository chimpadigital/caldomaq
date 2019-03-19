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
class ovacrs_btn_action extends Widget_Base {

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
		return 'ovacrs_btn_action';
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
		return __( 'Button Action', 'ireca' );
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
				]
			);

			$this->add_control(
				'content',
				[
					'label' => __( 'Phone', 'ireca' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'btn_text',
				[
					'label' => __( 'Button Text', 'ireca' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'btn_link',
				[
					'label' => __( 'Button Link', 'ireca' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'btn_target',
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
				'border_left',
				[
					'label' => __( 'Show Left Border', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'border_left',
					'options' => [
						'border_left' => __( 'Yes', 'ireca' ),
						'no_border_left'  => __( 'No', 'ireca' ),
						
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

		$html = '<div class="ovacrs_btn_action '.$settings['class'].' '.$settings['text_color'].' '.$settings['border_left'].'">';

        $html .= $settings['title']? '<h3 class="title">'.$settings['title'].'</h3>' : '';
        $html .= $settings['content'] ? '<div class="desc">'.$settings['content'].'</div>' : '';

        $html .= $settings['btn_text'] ? '<a class="ireca_btn btn_tran" href="'.$settings['btn_link'].'" target="'.$settings['btn_target'].'">'.$settings['btn_text'].'</a>' : '';
    
    	$html .= '</div>';

      echo $html;
	}

	
}
