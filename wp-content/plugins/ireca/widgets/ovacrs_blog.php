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
class ovacrs_blog extends Widget_Base {

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
		return 'ovacrs_blog';
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
		return __( 'Blog', 'ireca' );
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


		$args = array(
		  'orderby' => 'name',
		  'order' => 'ASC'
		  );

		$categories=get_categories($args);
		$cate_array = array();
		$arrayCateAll = array( 'all' => 'All categories ' );
		if ($categories) {
			foreach ( $categories as $cate ) {
				$cate_array[$cate->cat_name] = $cate->slug;
			}
		} else {
			$cate_array["No content Category found"] = 0;
		}



		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ireca' ),
			]
		);

			$this->add_control(
				'category',
				[
					'label' => __( 'Category', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'all',
					'options' => array_merge($arrayCateAll,$cate_array),
				]
			);
			$this->add_control(
				'total_count',
				[
					'label' => __( 'Total Post', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					'default' => 3
				]
			);

			$this->add_control(
				'show_thumb',
				[
					'label' => __( 'Show thumbnail', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes' => __( 'Yes', 'ireca' ),
						'no'  => __( 'No', 'ireca' ),
						
					],
				]
			);

			$this->add_control(
				'show_title',
				[
					'label' => __( 'Show title', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes' => __( 'Yes', 'ireca' ),
						'no'  => __( 'No', 'ireca' ),
						
					],
				]
			);

			$this->add_control(
				'show_desc',
				[
					'label' => __( 'Show Description', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes' => __( 'Yes', 'ireca' ),
						'no'  => __( 'No', 'ireca' ),
						
					],
				]
			);

			

			$this->add_control(
				'show_date',
				[
					'label' => __( 'Show date', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes' => __( 'Yes', 'ireca' ),
						'no'  => __( 'No', 'ireca' ),
						
					],
				]
			);

			

			$this->add_control(
				'show_cat',
				[
					'label' => __( 'Show category', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes' => __( 'Yes', 'ireca' ),
						'no'  => __( 'No', 'ireca' ),
						
					],
				]
			);

			$this->add_control(
				'show_comment',
				[
					'label' => __( 'Show comment', 'ireca' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'yes',
					'options' => [
						'yes' => __( 'Yes', 'ireca' ),
						'no'  => __( 'No', 'ireca' ),
						
					],
				]
			);

			
			$this->add_control(
				'read_more_text',
				[
					'label' => __( 'Read more text', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'Read More', 'irea' )
				]
			);

			$this->add_control(
				'view_all_text',
				[
					'label' => __( 'View All Text', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( 'View All Posts', 'irea' )
					
				]
			);

			$this->add_control(
				'view_all_link',
				[
					'label' => __( 'View All Link', 'ireca' ),
					'type' => Controls_Manager::TEXT,
					'default' => esc_html__( '#', 'irea' )
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

		$args =array();
		  if ($settings['category'] == 'all') {
		    $args=array('post_type' => 'post', 'posts_per_page' => $settings['total_count']);
		  }else{
		    $args=array('post_type' => 'post', 'category_name'=>$settings['category'],'posts_per_page' => $settings['total_count']);
		  }
		$html = '';

		$blog = new \WP_Query($args);

		$d = 0;

		$html .= '<div  class="row1 ova_blog '.$settings['class'].' '.$settings['style'].'">';

		    if($blog->have_posts()) : while($blog->have_posts()) : $blog->the_post();

		    if( $settings['style'] == 'style1' ){
		    	$html .= '<div class="col-md-4 "><div class="content">';

		            if($settings['show_thumb'] == 'yes'){

		              $html .= '<div class="ova_media">';

		                $thumbnail_url_d = wp_get_attachment_image_url(get_post_thumbnail_id() , 'full' );
		                $img_ireca_list  = wp_get_attachment_image_url( get_post_thumbnail_id(), 'ireca_list' );
						$img_vehicle_m  = wp_get_attachment_image_url( get_post_thumbnail_id(), 'vehicle_m' );

		                $html .= '<img  src="'.$thumbnail_url_d.'" srcset="'.esc_url( $img_vehicle_m ).' 600w, '.esc_url( $img_ireca_list ).' 350w" sizes="(max-width: 600px) 100vw, 600px" alt="'.get_the_title().'" >';

		                $html .= $settings['show_date'] == 'yes' ? '<div class="post_date"><span class="day"> '.get_the_time( 'd' ).'</span><span class="month">'.get_the_time( 'M' ).'</span></div>' : '';
		              
		              $html .= '</div>';

		            }
		            
		            $html .= '<div class="bottom">';
		                  
			            $html .= $settings['show_title'] == 'yes' ? '<h2 class="title"><a href="'.get_the_permalink().'">'.get_the_title( ).'</a></h2>' : '';

			            $html .= '<div class="post-meta">';
			                
			                $cat = '';
			                $i = 1;
			                $cats = get_the_category();
			                foreach ($cats as $key => $value) {
			                	$cat .= $value->name;
			                	if( count($cats) > $i ) $cat .= ', ';
			                	$i++;
			                }

			                $html .= $settings['show_cat'] == 'yes' ? '<span class="post-cat"><i class="icon_folder-open_alt "></i>&nbsp;'.$cat.'</span>' : '';

			                $comment_text = ( get_comments_number() == 1 ) ? esc_html__( 'comment', 'ireca' ) : esc_html__( 'comments', 'ireca' );
			                $html .= $settings['show_comment'] == 'yes' ? '<span class="post-comment"><i class="icon_chat_alt "></i>&nbsp;'.get_comments_number().' '.$comment_text.'</span>' : '';
			                
			            $html .= '</div>';


			            $html .= $settings['show_desc'] == 'yes' ? '<div class="desc">'.get_the_excerpt().'</div>' : '';

			            $html .= $settings['read_more_text'] != '' ? '<a class="read_more" href="'.get_the_permalink().'">'.$settings['read_more_text'].'</a>' : '';

		            $html .= '</div>';

		    	$html .= '</div></div>';

		    }else if( $settings['style'] == 'style2' ){

		    	if( $d == 0 ){
		    		$html .= '<div class="col-lg-8 col-md-12"><div class="left">';
		    	}

		    	if( $d < 2 ){

		    		$html .= '<div class="m_no_padding blog_col_'.$d.'"><div class="content">';

			            if($settings['show_thumb'] == 'yes'){

			            	$thumbnail_url_d = wp_get_attachment_image_url(get_post_thumbnail_id() , 'full' );

			              $html .= '<div class="ova_media" style="background: url( '.$thumbnail_url_d.' )">';

			                $html .= $settings['show_date'] == 'yes' ? '<div class="post_date"><span class="day"> '.get_the_time( 'd' ).'</span><span class="month">'.get_the_time( 'M' ).'</span></div>' : '';
			              
			              $html .= '</div>';

			            }
			            
			            $html .= '<div class="bottom">';
			                  
				            $html .= $settings['show_title'] == 'yes' ? '<h2 class="title"><a href="'.get_the_permalink().'">'.get_the_title( ).'</a></h2>' : '';

				            $html .= '<div class="post-meta">';
				                
				                $cat = '';
				                $i = 1;
				                $cats = get_the_category();
				                foreach ($cats as $key => $value) {
				                	$cat .= $value->name;
				                	if( count($cats) > $i ) $cat .= ', ';
				                	$i++;
				                }

				                $html .= $settings['show_cat'] == 'yes' ? '<span class="post-cat"><i class="icon_folder-open_alt "></i>&nbsp;'.$cat.'</span>' : '';

				                $comment_text = ( get_comments_number() == 1 ) ? esc_html__( 'comment', 'ireca' ) : esc_html__( 'comments', 'ireca' );
				                $html .= $settings['show_comment'] == 'yes' ? '<span class="post-comment"><i class="icon_chat_alt "></i>&nbsp;'.get_comments_number().' '.$comment_text.'</span>' : '';
				                
				            $html .= '</div>';


				            $html .= $settings['show_desc'] == 'yes' ? '<div class="desc">'.get_the_excerpt().'</div>' : '';

				            $html .= $settings['read_more_text'] != '' ? '<a class="read_more" href="'.get_the_permalink().'">'.$settings['read_more_text'].'</a>' : '';

			            $html .= '</div>';

			    	$html .= '</div></div>';
		    	}

		    	if( $d == 1 ){
		    		$html .= '</div></div>';
		    	}

		    	if( $d == 2 ){
		    		$html .= '<div class="col-lg-4 col-md-12"><div class="right">';

		    			$html .= '<div class="m_no_padding blog_col_'.$d.'"><div class="content">';

			            if($settings['show_thumb'] == 'yes'){

			            	$thumbnail_url_d = wp_get_attachment_image_url(get_post_thumbnail_id() , 'full' );

			              $html .= '<div class="ova_media" style="background: url( '.$thumbnail_url_d.' )">';

			                $html .= $settings['show_date'] == 'yes' ? '<div class="post_date"><span class="day"> '.get_the_time( 'd' ).'</span><span class="month">'.get_the_time( 'M' ).'</span></div>' : '';
			              
			              $html .= '</div>';

			            }
			            
			            $html .= '<div class="bottom">';
			                  
				            $html .= $settings['show_title'] == 'yes' ? '<h2 class="title"><a href="'.get_the_permalink().'">'.get_the_title( ).'</a></h2>' : '';

				            $html .= '<div class="post-meta">';
				                
				                $cat = '';
				                $i = 1;
				                $cats = get_the_category();
				                foreach ($cats as $key => $value) {
				                	$cat .= $value->name;
				                	if( count($cats) > $i ) $cat .= ', ';
				                	$i++;
				                }

				                $html .= $settings['show_cat'] == 'yes' ? '<span class="post-cat"><i class="icon_folder-open_alt "></i>&nbsp;'.$cat.'</span>' : '';

				                $comment_text = ( get_comments_number() == 1 ) ? esc_html__( 'comment', 'ireca' ) : esc_html__( 'comments', 'ireca' );
				                $html .= $settings['show_comment'] == 'yes' ? '<span class="post-comment"><i class="icon_chat_alt "></i>&nbsp;'.get_comments_number().' '.$comment_text.'</span>' : '';
				                
				            $html .= '</div>';


				            $html .= $settings['show_desc'] == 'yes' ? '<div class="desc">'.get_the_excerpt().'</div>' : '';

				            $html .= $settings['read_more_text'] != '' ? '<a class="read_more" href="'.get_the_permalink().'">'.$settings['read_more_text'].'</a>' : '';

			            $html .= '</div>';

			    	$html .= '</div></div>';

		    		$html .= '</div></div>';
		    		$d = 0;
		    	}

		    	


		    	$d++;
		    	

		    }
		   
		    
		    
		  endwhile; endif; wp_reset_postdata();

		  $html .= '<div class="col-md-12"><div class="view_all"><div class="wrap_a"><a href="'.$settings['view_all_link'].'" class="ireca_btn btn_tran"><i class="icon_documents_alt"></i>'.$settings['view_all_text'].'</a></div></div></div>';

		$html .= '</div>';

		echo $html;
	}

	
	
}
