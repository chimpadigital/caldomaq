<?php get_header();
do_action('ireca_open_layout');

// Get content
if ( have_posts() ) : while ( have_posts() ) : the_post();

	get_template_part( 'content/content', 'post' );

    if ( comments_open() || get_comments_number() ) {
    	comments_template();
    }
	
endwhile; else :
    get_template_part( 'content/content', 'none' );
endif;

do_action('ireca_close_layout');
get_footer(); ?>
