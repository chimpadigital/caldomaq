<?php 
get_header(); 
do_action('ireca_open_layout');

					
if ( have_posts() ) : while ( have_posts() ) : the_post();
    get_template_part( 'content/content', 'page' );
    if ( comments_open() ) comments_template( '', true );
endwhile; else : ?>
        <p><?php esc_html_e('Sorry, no pages matched your criteria.', 'ireca'); ?></p>
<?php endif;

do_action('ireca_close_layout'); 
get_footer(); ?>




