<?php if (post_password_required()) return; ?>


        
    <div class="content_comments">
        <div id="comments" class="comments">

            <?php if(have_comments()){ ?>
                <div>

                    <h3 class="heading-post-title">
                        <div><?php comments_number( esc_html__('0 Comments', 'ireca'), esc_html__( '1 Comment', 'ireca' ), esc_html__( '% Comments', 'ireca' ) ); ?></div>
                    </h3>
                </div>

            <?php } ?>

            <?php if (have_comments()) { ?>
                <ul class="commentlists">
                    <?php wp_list_comments('callback=ireca_theme_comment'); ?>
                </ul>
                <?php
                // Are there comments to navigate through?

                if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
                    <footer class="navigation comment-navigation" role="navigation">
                        <div class="nav_comment_text"><?php esc_html_e( 'Comment navigation', 'ireca' ); ?></div>
                        <div class="previous"><?php previous_comments_link(__('&larr; Older Comments', 'ireca')); ?></div>
                        <div class="next right"><?php next_comments_link(__('Newer Comments &rarr;', 'ireca')); ?></div>
                    </footer><!-- .comment-navigation -->
                <?php endif; // Check for comment navigation ?>

                <?php if (!comments_open() && get_comments_number()) : ?>
                    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'ireca' ); ?></p>
                <?php endif; ?>
                
            <?php } ?>

            <?php

            $aria_req = ($req ? " aria-required='true'" : '');
            $comment_args = array(
                'title_reply' => wp_kses('<h3 class="heading-post-title"><div>' . esc_html__( 'Leave a reply', 'ireca' ) . '</div></h3>', true),
                'fields' => apply_filters('comment_form_default_fields', array(
                    'author' => '<div class="row"><div class="col-md-12 "><input type="text" name="author" value="' . esc_attr($commenter['comment_author']) . '" ' . esc_attr($aria_req) . ' class="form-control" placeholder="'. esc_attr__('Name','ireca') .'" />',
                    'email' => '<input type="text" name="email" value="' . esc_attr($commenter['comment_author_email']) . '" ' . esc_attr($aria_req) . ' class="form-control" placeholder="'. esc_attr__('Email','ireca') .'" />',
                    'phone' => '<input type="text" name="url" value="' . esc_url($commenter['comment_author_url']) . '" ' . esc_attr($aria_req) . ' class="form-control" placeholder="'. esc_attr__('Website','ireca') .'" /></div></div>',            
                    
                )),
                'comment_field' => '<div class="row"><div class="col-md-12  ">                               
                                            <textarea class="form-control" rows="7" name="comment" placeholder="'. esc_attr__('Your Comment ...','ireca') .'"></textarea>
                                    </div></div>',
                'label_submit' => esc_html__('Submit Comment','ireca'),
                'comment_notes_before' => '',
                'comment_notes_after' => '',
            );
            ?>

            <?php global $post; ?>
            <?php if ('open' == $post->comment_status) { ?>
                <div class="commentform">
                    
                        <?php comment_form($comment_args); ?>
                    
                </div><!-- end commentform -->
            <?php } ?>


        </div><!-- end comments -->
    </div>

