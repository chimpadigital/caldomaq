<?php

//Product Cat Create page
function ovacrs_taxonomy_add_new_meta_field() {
    ?>

    <div class="form-field">
        <label for="Display"><?php _e('Display', 'ova-crs'); ?></label>
        <select name="ovacrs_cat_dis">
        	<option value="rental"><?php esc_html_e( 'Rental', 'ova-crs' ); ?></option>
        	<option value="shop"><?php esc_html_e( 'Shop', 'ova-crs' ); ?></option>
        </select>
    </div>
   
    <?php
}

//Product Cat Edit page
function ovacrs_taxonomy_edit_meta_field($term) {

    //getting term ID
    $term_id = $term->term_id;

    // retrieve the existing value(s) for this meta field.
    $ovacrs_cat_dis = get_term_meta($term_id, 'ovacrs_cat_dis', true);
    
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="ovacrs_cat_dis"><?php _e('Display', 'ova-crs'); ?></label></th>
        <td>
        	<select name="ovacrs_cat_dis">
	        	<option value="rental" <?php echo ( esc_attr($ovacrs_cat_dis) == 'rental' ) ? 'selected' : ''; ?>><?php esc_html_e( 'Rental', 'ova-crs' ); ?></option>
	        	<option value="shop" <?php echo ( esc_attr($ovacrs_cat_dis) == 'shop' ) ? 'selected' : ''; ?>><?php esc_html_e( 'Shop', 'ova-crs' ); ?></option>
	        </select>

            
        </td>
    </tr>
    
    <?php
}

add_action('product_cat_add_form_fields', 'ovacrs_taxonomy_add_new_meta_field', 10, 1);
add_action('product_cat_edit_form_fields', 'ovacrs_taxonomy_edit_meta_field', 10, 1);

// Save extra taxonomy fields callback function.
function ovacrs_save_taxonomy_custom_meta($term_id) {

    $ovacrs_cat_dis = filter_input(INPUT_POST, 'ovacrs_cat_dis');
    update_term_meta($term_id, 'ovacrs_cat_dis', $ovacrs_cat_dis);
    
}

add_action('edited_product_cat', 'ovacrs_save_taxonomy_custom_meta', 10, 1);
add_action('create_product_cat', 'ovacrs_save_taxonomy_custom_meta', 10, 1);