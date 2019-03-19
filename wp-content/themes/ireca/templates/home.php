<?php 
/** Template Name: Home Template  */

get_header();
	while(have_posts()): the_post(); ?>
		<div class="container">
				<?php the_content(); ?>
		</div>
    <?php endwhile;
get_footer();