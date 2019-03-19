<?php

/* This is functions define blocks to display post */

if ( ! function_exists( 'ireca_content_thumbnail' ) ) {
  function ireca_content_thumbnail( $size ) {
    if ( has_post_thumbnail()  && ! post_password_required() || has_post_format( 'image') )  :
      the_post_thumbnail( $size, array('class'=> 'img-responsive' ));
    endif;
  }
}

if ( ! function_exists( 'ireca_postformat_video' ) ) {
  function ireca_postformat_video( ) { ?>
    <?php if(has_post_format('video') && wp_oembed_get(get_post_meta(get_the_id(), "ireca_met_embed_media", true))){ ?>
	    <div class="js-video postformat_video">
	        <?php echo wp_oembed_get(get_post_meta(get_the_id(), "ireca_met_embed_media", true)); ?>
	    </div>
    <?php } ?>
  <?php }
}

if ( ! function_exists( 'ireca_postformat_audio ') ) {
  function ireca_postformat_audio( ) { ?>
    <?php if(has_post_format('audio') && wp_oembed_get(get_post_meta(get_the_id(), "ireca_met_embed_media", true))){ ?>
	    <div class="js-video postformat_audio">
	        <?php echo wp_oembed_get(get_post_meta(get_the_id(), "ireca_met_embed_media", true)); ?>
	    </div>
    <?php } ?>
  <?php }
}

if ( ! function_exists( 'ireca_content_title' ) ) {
  function ireca_content_title() { ?>

    <?php if ( is_single() ) : ?>
      <h1 class="post-title">
          <?php the_title(); ?>
      </h1>
    <?php else : ?>
      <h2 class="post-title">
        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
          <?php the_title(); ?>
        </a>
      </h2>
      <?php endif; ?>

 <?php }
}


if ( ! function_exists( 'ireca_content_meta' ) ) {
  function ireca_content_meta( ) { ?>
	    <span class="post-meta-content">
		    
		  	<span class="post-date <?php echo get_theme_mod( 'date_style', 'style1' ); ?>">
		        <span class="left"><i class="far fa-calendar"></i></span>
		        <span class="right"><?php the_time( get_option( 'date_format' ));?></span>
		    </span>

		    
		    <?php if(has_category( )){ ?>
	            <span class="post-categories">
	            	<span class="left">
	            		<i class="far fa-folder"></i>	
	            	</span>
	            	<span class="right">
	            		<?php the_category(',&nbsp;'); ?>
	            	</span>
	            	
	                
	            </span>
	        <?php } ?>

		    
		    <span class=" comment">
		        <span class="left"><i class="far fa-comment-dots"></i></span>
		        <span class="right"><a href="<?php the_permalink();?>">                    
		            <?php comments_popup_link(
		            	esc_html__(' 0 comment', 'ireca'), 
		            	esc_html__(' 1 comment', 'ireca'), 
		            	' % comments',
		            	'',
                  		esc_html__( 'Comment off', 'ireca' )
		            ); ?>
		        </a></span>                
		    </span>
		</span>
  <?php }
}

if ( ! function_exists( 'ireca_content_body' ) ) {
  function ireca_content_body( ) { ?>
  	<div class="post-excerpt">
		<?php if(is_single()){
		    the_content();
		    wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ireca' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		}else{
			the_excerpt();
		}?>
	</div>

	<?php 
	}
}

if ( ! function_exists( 'ireca_content_readmore' ) ) {
  function ireca_content_readmore( ) { ?>
  	<div class="post-footer">
		<div class="post-readmore">
		    <a class="btn btn-theme btn-theme-transparent" href="<?php the_permalink(); ?>"><?php  esc_html_e('Read more', 'ireca'); ?></a>
		</div>
	</div>
 <?php }
}

if ( ! function_exists( 'ireca_content_tag' ) ) {
  function ireca_content_tag( ) { ?>
	
	    <footer class="post-tag">
	        <?php if(has_tag()){ ?>
	            <span class="post-tags">
	            	<span class="ovatags"><?php esc_html_e('Tags ', 'ireca'); ?></span>
	                <?php the_tags('',',&nbsp;&nbsp;',''); ?>
	            </span>
	        <?php } ?>
	        <div class="clearboth"></div>
	        

	        <?php if( has_filter( 'ireca_share_social' ) ){ ?>
		        <div class="share_social">
		        	<span class="ova_label"><?php esc_html_e('Share: ', 'ireca'); ?></span>
		        	<?php echo apply_filters('ireca_share_social', get_the_permalink(), get_the_title() ); ?>
		        </div>
	        <?php } ?>
	    </footer>
	
 <?php }
}

if ( ! function_exists( 'ireca_content_gallery' ) ) {
 	function ireca_content_gallery( ) {

		

			$gallery = get_post_meta(get_the_ID(), 'ireca_met_file_list', true)?get_post_meta(get_the_ID(), 'ireca_met_file_list', true):'';

		    $k = 0;
		    if($gallery){
		        $i=0;

		        ?>

		        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				  	<?php foreach ($gallery as $key => $value) { ?>
				    	<li data-target="#carousel-example-generic" data-slide-to="<?php echo esc_attr($i); ?>" class="<?php if ($i==0) echo 'active'; ?>"></li>
				    <?php $i++; } ?>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
				  	<?php foreach ($gallery as $key => $value) { ?>
					    <div class="item <?php if($k==0) echo 'active'; $k++; ?>">
					      <img class="img-responsive" src="<?php  echo esc_url($value); ?>" alt="<?php the_title_attribute(); ?>">
					    </div>
				   	<?php } ?>
				   </div>

				</div>

		       
		        <?php
		    }
		

	}
}






//Custom comment List:
if ( ! function_exists( 'ireca_theme_comment' ) ) {
function ireca_theme_comment($comment, $args, $depth) {

   $GLOBALS['comment'] = $comment; ?>   
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <article class="comment_item" id="comment-<?php comment_ID(); ?>">
         <header class="comment-author">
         	<?php echo get_avatar($comment,$size='70', $default = 'mysteryman' ); ?>
         </header>

         <section class="comment-details">
             <div class="comment-meta commentmetadata clearfix media-body author-name">
                  <div class="author-name">
                    <div class="author_link"><?php printf('%s', get_comment_author_link()) ?>:</div>&nbsp;
                    <div class="comment_date"><?php printf(get_comment_date()) ?></div>
                    <div class="ova_reply">
	                    <?php edit_comment_link( __( '&nbsp;(Edit)', 'ireca' ), '  ', '' );?>
			            <span><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
		            </div>
                    
                  </div> 
                  
              </div>

              <div class="comment-body clearfix comment-content">
                  <?php comment_text() ?>
                </div>
                
             
          </section>
          <?php if ($comment->comment_approved == '0') : ?>
             <em><?php esc_html_e('Your comment is awaiting moderation.', 'ireca') ?></em>
             <br />
          <?php endif; ?>
      
        
     </article>
<?php
}
}








