<?php
namespace Ireca\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class ovacrs_video_popup extends Widget_Base {

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
		return 'ovacrs_video_popup';
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
		return __( 'Video Popup', 'ireca' );
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
				'link',
				[
					'label' => __( 'Link Youtube', 'ireca' ),
					'type' => Controls_Manager::TEXT,
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
				'alt',
				[
					'label' => __( 'Alt Image', 'ireca' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'dis_popup',
				[
					'label' => __( 'Display Popup', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'true',
					'options' => [
						'true' => __( 'Yes', 'ireca' ),
						'false'  => __( 'No', 'ireca' ),
						
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
		$html = '<div class="ovacrs_video_popup '.$settings['class'].'">';
		if( $settings['dis_popup'] == 'true' ){
			$html .= '<a href="'.$settings['link'].'" data-rel="prettyPhoto" title=""><img src="'.$settings['image']['url'].'" alt="'.$settings['alt'].'" /></a>';	
		}else{
			$html .= '<a href="'.$settings['link'].'" target="_blank" title=""><img src="'.$settings['image']['url'].'" alt="'.$settings['alt'].'" /></a>';	
		}
		
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
		<div class="ovacrs_video_popup {{{ settings.class }}}">
			<a href="{{{ settings.link }}}" rel="prettyPhoto" title=""><img src="{{{ settings.image.url }}}" alt="{{{ settings.alt }}}" /></a>
		</div>
		<?php
	}
}
