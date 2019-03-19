<?php get_header(); 
do_action('ireca_open_layout');
?>

<div class="ireca_404_page">
   <?php get_template_part( 'content/content', 'none' ); ?>
</div>
               

<?php 
do_action('ireca_close_layout');
get_footer();
?>

