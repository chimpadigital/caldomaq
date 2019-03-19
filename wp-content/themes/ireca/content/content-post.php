<?php $sticky_class = is_sticky()?'sticky':''; ?>

<?php if( has_post_format('link') ){ ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrap '. $sticky_class); ?>  >
		
			<?php if(!is_single()){ ?> 
		        <h2 class="post-title">
		        	<a href="<?php the_permalink(); ?> "><?php the_title(); ?></a>
		        </h2>
	        <?php } ?>
	        
			<?php
			        $link = get_post_meta( $post->ID, 'format_link_url', true );
			        $link_description = get_post_meta( $post->ID, 'format_link_description', true );
			        
			        if ( is_single() ) {
			                printf( '<h1 class="entry-title"><a href="%1$s" target="blank">%2$s</a></h1>',
			                        $link,
			                        get_the_title()
			                );
			        } else {
			                printf( '<h2 class="entry-title"><a href="%1$s" target="blank">%2$s</a></h2>',
			                        $link,
			                        get_the_title()
			                );
			        }
			?>
			<?php
			        printf( '<a href="%1$s" target="blank">%2$s</a>',
			                $link,
			                $link_description
			        );
			?>
	</article>

<?php }elseif ( has_post_format('aside') ){ ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrap '. $sticky_class); ?>  >
			<?php if(!is_single()){ ?> 
		        <h2 class="post-title">
		        	<a href="<?php the_permalink(); ?> "><?php the_title(); ?></a>
		        </h2>
	        <?php } ?>
			<div class="post-body">
		           <?php the_content(''); /* Display content  */ ?>
		    </div>
	</article>

<?php }else{ ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('post-wrap '. $sticky_class); ?>  >

			<?php if( has_post_format('audio') ){ ?>

				 <div class="post-media">
		        	<?php ireca_postformat_audio(); /* Display video of post */ ?>
		        </div>

			<?php }elseif(has_post_format('gallery')){ ?>

				<?php ireca_content_gallery(); /* Display gallery of post */ ?>

			<?php }elseif(has_post_format('video')){ ?>

				 <div class="post-media">
		        	<?php ireca_postformat_video(); /* Display video of post */ ?>
		        </div>

			<?php }elseif(has_post_thumbnail()){ ?>

		        <div class="post-media">
		        	<?php ireca_content_thumbnail('full'); /* Display thumbnail of post */ ?>
		        </div>

	        <?php } ?>

	        <div class="wrap_content">
	        	
	        			
    				<?php if( get_theme_mod( 'date_style', 'style1' ) == 'style2' ){ ?>
    					<div class="post_date">
	        				<div class="date">
	        					<div class="time">
		        					<span class="day"><?php echo get_the_time( 'd' ); ?></span>
		        					<span class="month"><?php echo get_the_time( 'M' ); ?></span>
		        				</div>
		        			</div>
	        			</div>
    				<?php } ?>
	        		
        		
	        	
		        <div class="right">
		        	 <?php if(!is_single()){ ?> 
			        <h2 class="post-title">
			        	<a href="<?php the_permalink(); ?> "><?php the_title(); ?></a>
			        </h2>
			        <?php }else{ ?>
			        	<h1 class="post-title"><?php the_title(); ?></h1>
			        	 <div class="post-meta">
					        <?php ireca_content_meta(); /* Display Date, Author, Comment */ ?>
					    </div>
			        <?php } ?>

			        <?php if(!is_single()){ ?>
				        <div class="post-meta">
					        <?php ireca_content_meta(); /* Display Date, Author, Comment */ ?>
					    </div>
				    <?php } ?>

				     <?php if(!is_single()){ ?> 
				    <div class="post-body">
				    	<div class="post-excerpt">
				            <?php ireca_content_body(); /* Display content of post or intro in category page */ ?>
				        </div>
				    </div>
				    <?php } ?>

				    <?php if(!is_single()){ ?> 
				            <?php ireca_content_readmore(); /* Display read more button in category page */ ?>
				    <?php }?>
		        </div>
	        </div>
				        
			<?php if(is_single()){ ?>
	        	 <?php ireca_content_body(); /* Display content of post or intro in category page */ ?>
	       	<?php } ?>
	       

		    <?php if(is_single()){ ?>

		    	<?php ireca_content_tag(); /* Display tags, category */ ?>

		    	<?php $author_id = get_the_author_meta( 'ID' ); ?>
		    	<?php if( get_the_author_meta( 'user_description' ) != '' ){ ?>
			    	<div class="author_meta">
			    		<div class="img">
			    			<?php echo get_avatar($author_id, $size='100', $default = 'mysteryman' ); ?>	
			    		</div>
			    		<div class="info">
			    			<label><?php esc_html_e( 'Posted by', 'ireca' ); ?></label>
			    			<a class="author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?> ">
			    				<?php echo get_the_author_meta( 'display_name' ); ?>
			    			</a>
			    			<div class="desc"><?php echo get_the_author_meta( 'user_description' ); ?> </div>
			    		</div>
			    		
			    	</div>
		    	<?php } ?>

		    	<!-- You also like -->
		    	<?php if( class_exists( 'OVACRS' ) ){ ?>
			    	<?php 
		    			$cat = get_the_category();
		    			if( $cat ){
		    				$cat_query = array(
			    				'cat' => $cat[0]->term_id
			    			);	
		    			}else{
		    				$cat_query = array();
		    			}
		    			
		    			$args_base = array(
		    				'post_type' => 'post',
		    				'post_status' => 'publish',
		    				'posts_per_page' => 2,
		    				
		    			);
		    			$args = array_merge($args_base, $cat_query);
		    			$post_recommend = new WP_Query( $args );
	    			?>
	    			<?php if( $post_recommend->post_count > 0 ){ ?>
				    	<div class="post_recommend">
				    		<h3 class="heading-post-title">
				    			<div><?php esc_html_e( 'You may also like', 'ireca' ); ?></div>
				    		</h3>
				    		<div class="row">
				    			<div class="ova_blog">
					    			<?php if ( $post_recommend->have_posts() ) : while ( $post_recommend->have_posts() ) : $post_recommend->the_post(); ?>
					    				<div class="col-md-6">
					    					<div class="content">
						    					<div class="ova_media">
						    						<?php  
								    					$img_ireca_m = '';
								    					if( has_post_thumbnail() ){
								    						$img_ireca_m  = wp_get_attachment_image_url( get_post_thumbnail_id(), 'ireca_m' );	
								    					}
							    					?>
							    					<?php if( $img_ireca_m ){ ?>
							    						<img src="<?php echo esc_url( $img_ireca_m ); ?>" alt="<?php the_title_attribute(); ?>" />
							    					<?php }else{ ?>
							    						<img src="<?php echo esc_url( IRECA_URI.'/assets/img/600x400.png' ); ?>" alt="<?php the_title_attribute(); ?>" />
							    					<?php } ?>

						    						<div class="post_date"><span class="day"><?php echo get_the_time( 'd' ); ?></span><span class="month"><?php echo get_the_time( 'M' ); ?></span></div>
						    					</div>
						    				</div>

					    					<div class="bottom">
					    						<h3 class="post-title"><a href="<?php the_permalink(); ?>">
					    						<?php the_title(); ?> </a></h3>
					    					</div>
					    					
					    				</div>
					    			<?php endwhile; endif; wp_reset_postdata(); ?>
			    				</div>
			    			</div>
				    			
				    		
				    	</div>
			    	<?php } ?>

		    	<?php } ?>


		    	
		    <?php } ?>



	</article>


<?php } ?>

