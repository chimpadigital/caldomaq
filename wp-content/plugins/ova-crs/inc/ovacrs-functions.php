<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if( !function_exists( 'ovacrs_locate_template' ) ){
	function ovacrs_locate_template( $template_name, $template_path = '', $default_path = '' ) {
		
		// Set variable to search in ovacrs-templates folder of theme.
		if ( ! $template_path ) :
			$template_path = 'ovacrs-templates/';
		endif;

		// Set default plugin templates path.
		if ( ! $default_path ) :
			$default_path = OVACRS_PLUGIN_PATH . 'ovacrs-templates/'; // Path to the template folder
		endif;

		// Search template file in theme folder.
		$template = locate_template( array(
			$template_path . $template_name
			// ,$template_name
		) );

		// Get plugins template file.
		if ( ! $template ) :
			$template = $default_path . $template_name;
		endif;

		return apply_filters( 'ovacrs_locate_template', $template, $template_name, $template_path, $default_path );
	}

}


function ovacrs_get_template( $template_name, $args = array(), $tempate_path = '', $default_path = '' ) {
	if ( is_array( $args ) && isset( $args ) ) :
		extract( $args );
	endif;
	$template_file = ovacrs_locate_template( $template_name, $tempate_path, $default_path );
	if ( ! file_exists( $template_file ) ) :
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );
		return;
	endif;

	
	include $template_file;
}

function ovacrs_woo_wp_select_multiple( $field ) {
    global $thepostid, $post, $woocommerce;

    $thepostid              = empty( $thepostid ) ? $post->ID : $thepostid;
    $field['class']         = isset( $field['class'] ) ? $field['class'] : 'select short';
    $field['wrapper_class'] = isset( $field['wrapper_class'] ) ? $field['wrapper_class'] : '';
    $field['name']          = isset( $field['name'] ) ? $field['name'] : $field['id'];
    $field['value']         = isset( $field['value'] ) ? $field['value'] : ( get_post_meta( $thepostid, $field['id'], true ) ? get_post_meta( $thepostid, $field['id'], true ) : array() );

    echo '<p class="form-field ' . esc_attr( $field['id'] ) . '_field ' . esc_attr( $field['wrapper_class'] ) . '"><label for="' . esc_attr( $field['id'] ) . '">' . wp_kses_post( $field['label'] ) . '</label><select id="' . esc_attr( $field['id'] ) . '" name="' . esc_attr( $field['name'] ) . '" class="' . esc_attr( $field['class'] ) . '" multiple="multiple">';

    foreach ( $field['options'] as $key => $value ) {

        echo '<option value="' . esc_attr( $key ) . '" ' . ( in_array( $key, $field['value'] ) ? 'selected="selected"' : '' ) . '>' . esc_html( $value ) . '</option>';

    }

    echo '</select> ';

    if ( ! empty( $field['description'] ) ) {

        if ( isset( $field['desc_tip'] ) && false !== $field['desc_tip'] ) {
            echo '<img class="help_tip" data-tip="' . esc_attr( $field['description'] ) . '" src="' . esc_url( WC()->plugin_url() ) . '/assets/images/help.png" height="16" width="16" />';
        } else {
            echo '<span class="description">' . wp_kses_post( $field['description'] ) . '</span>';
        }

    }
    echo '</p>';
}