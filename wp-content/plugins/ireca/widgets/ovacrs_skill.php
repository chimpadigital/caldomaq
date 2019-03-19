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
class ovacrs_skill extends Widget_Base {

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
		return 'ovacrs_skill';
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
		return __( 'Skill', 'ireca' );
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
				'number',
				[
					'label' => __( 'Number', 'ireca' ),
					'type' => Controls_Manager::NUMBER,
					"default" => 1000,
					'min'	=> 1
				]
			);

			$this->add_control(
				'desc',
				[
					'label' => __( 'Description', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					'default' => __( 'New Motor For Sale', 'ireca' )
				]
			);

			$this->add_control(
				'speedtime',
				[
					'label' => __( 'Speed Time (ms)', 'ireca' ),
					'type' => Controls_Manager::NUMBER,
					'default' => 2000
				]
			);

			$this->add_control(
				'style',
				[
					'label' => __( 'Style', 'ireca' ),
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

		$html = '<div class="ovacrs_skill '.$settings['class'].' '.$settings['style'].'">';
			$html .= $settings['number'] != '' ? '<div class="ovacrs_count" data-value="'.(int)$settings['number'].'" data-speedtime="'.$settings['speedtime'].'">0</div>' : '';
			$html .= $settings['desc'] != '' ? '<div class="ovacrs_text">'.$settings['desc'].'</div>' : '';
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
		<div class="ovacrs_skill {{{ settings.class }}} {{{ settings.style }}} ">
			<div class="ovacrs_count" data-value="{{{ settings.number }}}" data-speedtime="{{{ settings.speedtime }}} "> {{{ settings.number }}} </div>
			<div class="ovacrs_text"> {{{ settings.desc }}} </div>
		</div>
		<?php
	}
}
