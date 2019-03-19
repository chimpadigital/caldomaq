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
class ovacrs_heading3 extends Widget_Base {

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
		return 'ovacrs_heading3';
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
		return __( 'Heading 3', 'ireca' );
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
		return [ 'ovacrs_heading3' ];
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
					'default' => __( 'Title', 'ireca' ),
				]
			);

			$this->add_control(
				'content',
				[
					'label' => __( 'Content', 'ireca' ),
					'type' => Controls_Manager::WYSIWYG,
					'default' => __( 'Sub Title', 'ireca' ),
				]
			);
			
			$this->add_control(
				'align',
				[
					'label' => __( 'Align', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'text-center',
					'options' => [
						'text-center' => __( 'Center', 'ireca' ),
						'text-left'  => __( 'Left', 'ireca' ),
						'text-right'  => __( 'Right', 'ireca' ),
						
					],
				]
			);

			$this->add_control(
				'show_border',
				[
					'label' => __( 'Show border at title', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'border_yes',
					'options' => [
						'border_no' => __( 'No', 'ireca' ),
						'border_yes'  => __( 'Yes', 'ireca' ),
						
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

		
      
	    $html = '<div class="ovacrs_heading3 '.$settings['class'].' '.$settings['align'].'">';

	        $html .= '<h3 class="title '.$settings['show_border'].'"><span>'.$settings['title'].'</span></h3>';
	        $html .= '<div class="desc">'.$settings['content'].'</div>';
	        
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
		
      
	    <div class="ovacrs_heading3 {{{ settings.class }}}  {{{ settings.align }}}  ">

	        <h3 class="title {{{ settings.show_border }}}"><span>{{{ settings.title }}} </span></h3>
	        <div class="desc">{{{ settings.content }}}</div>
	        
	    </div>

		<?php
	}
}
