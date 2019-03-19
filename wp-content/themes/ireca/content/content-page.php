
<?php if( get_post_meta(  ireca_get_current_id() ,'ireca_met_bg_header', true ) == '' ){ ?>
<h1 class="page-title"><?php the_title() ?> </h1>
<?php } ?>

<?php 
	the_content();
?>
<div class="page-links">
	<?php
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ireca' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'ireca' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
	?>

</div>
