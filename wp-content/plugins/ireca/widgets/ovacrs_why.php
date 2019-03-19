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
class ovacrs_why extends Widget_Base {

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
		return 'ovacrs_why';
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
		return __( 'Why', 'ireca' );
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
					'default' => __( 'Financing Made Easy', 'ireca' )
				]
			);
			$this->add_control(
				'number',
				[
					'label' => __( 'Number', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					'default' => '01'
				]
			);

			$this->add_control(
				'content',
				[
					'label' => __( 'Content', 'ireca' ),
					'type' => Controls_Manager::WYSIWYG,
					'default' => __( 'Our stress-free finance department that can find financial solutions to save you money.', 'ireca' )
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
				'show_border',
				[
					'label' => __( 'Show Border', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'show_border',
					'options' => [
						'show_border' => __( 'Yes', 'ireca' ),
						'no_show_border'  => __( 'No', 'ireca' ),
						
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

		 $html = '<div class="ovacrs_why '.$settings['class'].' '.$settings['show_border'].'">';

        $html .= '<span class="number">'.$settings['number'].'</span>';

        $html .= '<div class="content">';

            if( $settings['link'] != '' ){
                $html .= $settings['title'] ? '<h3 class="title"><a href="'.$settings['link'].'" target="'.$settings['target'].'">'.$settings['title'].'</a></h3>' : '';
            }else{
                $html .= $settings['title'] ? '<h3 class="title">'.$settings['title'].'</h3>' : '';
            }

            $html .= $settings['content'] ? '<div class="desc">'.$settings['content'].'</div>' : '';

        $html .= '</div>';
    
    $html .= '</div>';



    echo $html;
   
	}

	
	protected function _content_template() {
		?>
		<div class="ovacrs_why {{{ settings.class }}} {{{ settings.show_border }}} ">

			<span class="number">{{{ settings.number }}}</span>

			<div class="content">

				<# if( settings.link != '' ){ #>
					<h3 class="title"><a href="{{{ settings.link }}}" target="{{{ settings.target }}} ">{{{ settings.title }}}</a></h3>
				<# }else{ #>
					<h3 class="title">{{{ settings.title }}}</h3>
				<# } #>

				<div class="desc">{{{ settings.content }}}</div>

			</div>
			
		</div>
		<?php
	}

}
