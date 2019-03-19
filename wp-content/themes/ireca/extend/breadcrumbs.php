<?php 
function ireca_breadcrumbs() {
ob_start();

?>
<div id="breadcrumbs" >
        <?php
        	$separator = '<span class="separator">></span>';
	        $home = esc_html__('Home', 'ireca');
	        $before = '<li>';
	        $after = '</li>'; 
		?>


		            <div class="breadcrumbs">
						<div class="breadcrumbs-pattern">
							<div class="container">
								<div class="row">
									<ul class="breadcrumb"><?php
		        global $post;
		        global $wp_query;
		        
		        $homeLink = home_url('/');
		        $type=get_post_type();

		        
		        echo '<li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $separator . ' ';	
		        
		        
		        if ( is_category() ) {
			        
			        $cat_obj = $wp_query->get_queried_object();
			        $thisCat = $cat_obj->term_id;
			        $thisCat = get_category($thisCat);
			        $parentCat = get_category($thisCat->parent);
			        if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' '));
			        print wp_kses_post( $before ) . '' . single_cat_title('', false) . '' . $after;



		        } elseif ( is_day() ) {

			        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $separator . ' ';
			        echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $separator . ' ';
			        print wp_kses_post($before ) . esc_html__('Archive by date', 'ireca').' ' . get_the_time('d') . '"' . $after;

		        } elseif ( is_month() ) {

			        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $separator . ' ';
			        print wp_kses_post($before) . esc_html__('Archive by month', 'ireca').' ' . get_the_time('F') . '"' . $after;

		        } elseif ( is_year() ) {

		        	print wp_kses_post($before) . esc_html__('Archive by year', 'ireca').' ' . get_the_time('Y') . '"' . $after;

		        } elseif ( is_single() && !is_attachment() ) {

			        if ( get_post_type() != 'post' ) {
				        $post_type = get_post_type_object(get_post_type());
				        $slug = $post_type->rewrite;
				        echo '<a href="' . $homeLink .  $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>' . $separator . ' ';
				        print wp_kses_post($before) . get_the_title() . $after;
			        } else {
				        $cat = get_the_category(); $cat = $cat[0];
				        echo ' ' . get_category_parents($cat, TRUE, ' ' . $separator . ' ') . ' ';
				        print wp_kses_post( $before ) . '' . get_the_title() . ' ' . $after;
			        }
		        }elseif ( is_search()) {
		            print wp_kses_post( $before ) . esc_html__('Search results for', 'ireca').' ' . get_search_query() . '"' . $after;
		        }elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {

			        $post_type = get_post_type_object(get_post_type());
			        print wp_kses_post( $before ) . $post_type->labels->singular_name . $after;

		        } elseif ( is_attachment() ) {

			        $parent_id  = $post->post_parent;
			        $breadcrumbs = array();
			        while ($parent_id) {
				        $page = get_page($parent_id);
				        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				        $parent_id    = $page->post_parent;
			        }
			        $breadcrumbs = array_reverse($breadcrumbs);
			        foreach ($breadcrumbs as $crumb) echo ' ' . $crumb . ' ' . $separator . ' ';
			        print wp_kses_post( $before ) . '' . get_the_title() . '' . $after;

		        }elseif ( is_page() && !$post->post_parent ) {

		        	print wp_kses_post( $before ) . '' . get_the_title() . '' . $after;

		        } elseif ( is_page() && $post->post_parent ) {

			        $parent_id  = $post->post_parent;
			        $breadcrumbs = array();
			        while ($parent_id) {
				        $page = get_page($parent_id);
				        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				        $parent_id    = $page->post_parent;
			        }
			        $breadcrumbs = array_reverse($breadcrumbs);
			        foreach ($breadcrumbs as $crumb) echo ' ' . $crumb . ' ' . $separator . ' ';
		        	print wp_kses_post( $before ) . '' . get_the_title() . '' . $after;

		        }elseif ( is_tag() ) {
		        	print wp_kses_post( $before ) . esc_html__('Archive by tag', 'ireca').' ' . single_tag_title('', false) . '"' . $after;
		        } elseif ( is_author() ) {
		        global $author;
		        $userdata = get_userdata($author);
		        	print wp_kses_post( $before ) . esc_html__('Articles posted by', 'ireca').' ' . $userdata->display_name . '"' . $after;
		        } elseif ( is_home() ){
		        	print wp_kses_post( $before ) . esc_html__('Blog', 'ireca').'&nbsp;' . $after;
		        }elseif ( is_404() ) {
		        	print wp_kses_post( $before ) . esc_html__('You got it Error 404 not Found', 'ireca').'&nbsp;' . $after;
		        }
		        if ( get_query_var('paged') ) {
			        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' ';
			        
			        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
		        }
								        echo '</ul>
										</div>
									</div>
								</div>
							</div>';
            
        ?>
</div>
<?php 

$list_post2 = ob_get_contents();ob_end_clean();?>
 <?php print  wp_kses_post( $list_post2  ); 
} ?>
