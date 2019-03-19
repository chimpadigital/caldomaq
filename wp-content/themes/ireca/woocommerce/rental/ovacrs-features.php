<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$post_id = get_the_id();

$ovacrs_features_desc = get_post_meta( $post_id, 'ovacrs_features_desc', true );
$ovacrs_features_label = get_post_meta( $post_id, 'ovacrs_features_label', true );
$ovacrs_features_icons = get_post_meta( $post_id, 'ovacrs_features_icons', true );
$ovacrs_features_special = get_post_meta( $post_id, 'ovacrs_features_special', true );



if( $ovacrs_features_desc && get_theme_mod( 'rd_show_feature', 'true' ) == 'true' ){ ?>
	<ul class="ireca_woo_features">
		<?php foreach ($ovacrs_features_desc as $key => $value) { ?>
			
				<li>
					<label><?php echo esc_html( $ovacrs_features_label[$key] ); ?>: </label>
					<span><?php echo esc_html( $ovacrs_features_desc[$key] ); ?></span>
				</li>
			
		<?php } ?>
	</ul>
<?php } ?>




<?php $other_features = get_post_meta( get_the_id(), 'ovacrs_other_features_name', true );
if( $other_features && get_theme_mod( 'rd_show_other_feature', 'true' ) == 'true' ){ ?>
	<div class="single_rent other_features row">
        <?php foreach ($other_features as $key => $value) {
            if( $value != '' ){ ?>
                <div class="item col-lg-6 col-md-12">
                    <i class="icon_check"></i>
                    <span class="other-feature-item"><?php echo esc_html($value); ?></span>    
                </div>
                
                <?php 
            }
        } ?>
    </div>
<?php } ?>

