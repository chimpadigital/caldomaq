<?php
namespace Ireca;

use Ireca\Widgets\ovacrs_heading1;
use Ireca\Widgets\ovacrs_heading2;
use Ireca\Widgets\ovacrs_heading3;
use Ireca\Widgets\ovacrs_heading4;
use Ireca\Widgets\ovacrs_service;
use Ireca\Widgets\ovacrs_service_item;
use Ireca\Widgets\ovacrs_service_full;
use Ireca\Widgets\ovacrs_service_card;
use Ireca\Widgets\ovacrs_service_repair;
use Ireca\Widgets\ovacrs_divide;
use Ireca\Widgets\ovacrs_product_filter;
use Ireca\Widgets\ovacrs_text_support;
use Ireca\Widgets\ovacrs_btn_action;
use Ireca\Widgets\ovacrs_why;
use Ireca\Widgets\ovacrs_testimonial;
use Ireca\Widgets\ovacrs_thumbnail_info;
use Ireca\Widgets\ovacrs_blog;
use Ireca\Widgets\ovacrs_product_slider;
use Ireca\Widgets\ovacrs_skill;
use Ireca\Widgets\ovacrs_team;
use Ireca\Widgets\ovacrs_info;
use Ireca\Widgets\ovacrs_video_popup;
use Ireca\Widgets\ovacrs_img_skew;
use Ireca\Widgets\ovacrs_about_info;
use Ireca\Widgets\ovacrs_contact_box;
use Ireca\Widgets\ovacrs_map;




if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		$this->add_actions();
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );


		add_action( 'elementor/frontend/after_register_scripts', function() {

			wp_register_script( 'ireca-elementor', plugins_url( '/assets/js/ireca-elementor.js', ELEMENTOR_IRECA__FILE__ ), [ 'jquery' ], false, true );

			wp_register_script( 'markerclusterer', plugins_url( '/assets/js/markerclusterer.js', ELEMENTOR_IRECA__FILE__ ), [ 'jquery' ], false, true );

	        wp_register_script( 'ova-google-maps-api', 'https://maps.googleapis.com/maps/api/js?key='.get_theme_mod( 'rental_googleapi_key', '' ).'&libraries=places', [ 'jquery' ],false,true );

		} );

	}

	

	/**
	 * On Widgets Registered
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	/**
	 * Includes
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {
		
		require __DIR__ . '/widgets/ovacrs_heading1.php';
		require __DIR__ . '/widgets/ovacrs_heading2.php';
		require __DIR__ . '/widgets/ovacrs_heading3.php';
		require __DIR__ . '/widgets/ovacrs_heading4.php';
		require __DIR__ . '/widgets/ovacrs_service.php';
		require __DIR__ . '/widgets/ovacrs_service_item.php';
		require __DIR__ . '/widgets/ovacrs_service_full.php';
		require __DIR__ . '/widgets/ovacrs_service_card.php';
		require __DIR__ . '/widgets/ovacrs_divide.php';
		require __DIR__ . '/widgets/ovacrs_product_filter.php';
		require __DIR__ . '/widgets/ovacrs_text_support.php';
		require __DIR__ . '/widgets/ovacrs_btn_action.php';
		require __DIR__ . '/widgets/ovacrs_why.php';
		require __DIR__ . '/widgets/ovacrs_testimonial.php';
		require __DIR__ . '/widgets/ovacrs_thumbnail_info.php';
		require __DIR__ . '/widgets/ovacrs_blog.php';
		require __DIR__ . '/widgets/ovacrs_product_slider.php';
		require __DIR__ . '/widgets/ovacrs_skill.php';
		require __DIR__ . '/widgets/ovacrs_team.php';
		require __DIR__ . '/widgets/ovacrs_info.php';
		require __DIR__ . '/widgets/ovacrs_video_popup.php';
		require __DIR__ . '/widgets/ovacrs_img_skew.php';
		require __DIR__ . '/widgets/ovacrs_service_repair.php';
		require __DIR__ . '/widgets/ovacrs_about_info.php';
		require __DIR__ . '/widgets/ovacrs_contact_box.php';
		require __DIR__ . '/widgets/ovacrs_map.php';
		
		
		
	}

	/**
	 * Register Widget
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function register_widget() {

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_heading1() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_heading2() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_heading3() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_heading4() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_service() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_service_full() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_service_item() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_service_card() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_service_repair() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_divide() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_product_filter() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_text_support() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_btn_action() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_why() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_testimonial() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_thumbnail_info() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_blog() );
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_product_slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_skill() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_team() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_info() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_video_popup() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_img_skew() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_about_info() );

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_contact_box() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new ovacrs_map() );
		
		
		
		
		
	}
}

new Plugin();
