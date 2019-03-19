<?php get_header(); 
do_action('ireca_open_layout');
?>

<!-- Get content -->
<header class="page-header">
	<h2 class="search-page-title">
		<?php esc_html_e('Search Results for: ','ireca'); printf( '<span>%s</span>', get_search_query() ); ?>
	</h2>
</header>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content/content', 'search' ); ?>
<?php endwhile; ?>
    <div class="pagination-wrapper">
        <?php ireca_pagination_theme(); ?>
	</div>
<?php else : ?>
        <?php get_template_part( 'content/content', 'none' ); ?>
<?php endif; ?>


<?php 
do_action('ireca_close_layout'); 
get_footer();
?>