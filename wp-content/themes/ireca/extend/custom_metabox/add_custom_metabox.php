<?php
/*
Plugin Name: CMB2 Field Type: Google Maps
Plugin URI: https://github.com/mustardBees/cmb_field_map
GitHub Plugin URI: https://github.com/mustardBees/cmb_field_map
Description: Google Maps field type for CMB2.
Version: 2.2.0
Author: Phil Wylie
Author URI: https://www.philwylie.co.uk/
License: GPLv2+
*/

/**
 * Class PW_CMB2_Field_Google_Maps.
 */
class PW_CMB2_Field_Google_Maps {

	/**
	 * Current version number.
	 */
	const VERSION = '2.2.0';

	/**
	 * Initialize the plugin by hooking into CMB2.
	 */
	public function __construct() {
		add_filter( 'cmb2_render_pw_map', array( $this, 'render_pw_map' ), 10, 5 );
		add_filter( 'cmb2_sanitize_pw_map', array( $this, 'sanitize_pw_map' ), 10, 4 );


		add_filter( 'cmb2_render_ova_range_time', array( $this, 'render_ova_range_time' ), 10, 5 );
		add_filter( 'cmb2_sanitize_ova_range_time', array( $this, 'sanitize_ova_range_time' ), 10, 4 );
		
	}

	/**
	 * Render field.
	 */
	public function render_pw_map( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {

		
		add_action( 'admin_footer', array( $this, 'setup_admin_scripts' ), 10, 2 );

		

		echo '<input type="text" class="large-text pw-map-search" id="' . $field->args( 'id' ) . '" />';

		echo '<div class="pw-map"></div>';

		$field_type_object->_desc( true, true );

		echo $field_type_object->input( array(
			'type'       => 'hidden',
			'name'       => $field->args('_name') . '[latitude]',
			'value'      => isset( $field_escaped_value['latitude'] ) ? $field_escaped_value['latitude'] : '',
			'class'      => 'pw-map-latitude',
			'desc'       => '',
		) );
		echo $field_type_object->input( array(
			'type'       => 'hidden',
			'name'       => $field->args('_name') . '[longitude]',
			'value'      => isset( $field_escaped_value['longitude'] ) ? $field_escaped_value['longitude'] : '',
			'class'      => 'pw-map-longitude',
			'desc'       => '',
		) );
	}

	/**
	 * Optionally save the latitude/longitude values into two custom fields.
	 */
	public function sanitize_pw_map( $override_value, $value, $object_id, $field_args ) {
		if ( isset( $field_args['split_values'] ) && $field_args['split_values'] ) {
			if ( ! empty( $value['latitude'] ) ) {
				update_post_meta( $object_id, $field_args['id'] . '_latitude', $value['latitude'] );
			}

			if ( ! empty( $value['longitude'] ) ) {
				update_post_meta( $object_id, $field_args['id'] . '_longitude', $value['longitude'] );
			}
		}

		return $value;
	}



	public function render_ova_range_time( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {

		
		add_action( 'admin_footer', array( $this, 'setup_admin_scripts' ), 10, 2 );

		

		echo esc_html__( 'Start Date: ','ireca' ).$field_type_object->input( array(
			'type'       => 'text',
			'name'       => $field->args('_name') . '[startdate]',
			'value'      => isset( $field_escaped_value['startdate'] ) ? $field_escaped_value['startdate'] : '',
			'class'      => 'ova-range-time datetimepicker',
			'desc'       => '',
		) );

		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.esc_html__( 'End Date: ','ireca' ).$field_type_object->input( array(
			'type'       => 'text',
			'name'       => $field->args('_name') . '[enddate]',
			'value'      => isset( $field_escaped_value['enddate'] ) ? $field_escaped_value['enddate'] : '',
			'class'      => 'ova-range-time datetimepicker',
			'desc'       => '',
		) );

		
	}

	/**
	 * Optionally save the latitude/longitude values into two custom fields.
	 */
	public function sanitize_ova_range_time( $override_value, $value, $object_id, $field_args ) {
		if ( isset( $field_args['split_values'] ) && $field_args['split_values'] ) {
			if ( ! empty( $value['startdate'] ) ) {
				update_post_meta( $object_id, $field_args['id'] . '_startdate', $value['startdate'] );
			}

			if ( ! empty( $value['enddate'] ) ) {
				update_post_meta( $object_id, $field_args['id'] . '_enddate', $value['enddate'] );
			}
		}

		return $value;
	}




	/**
	 * Enqueue scripts and styles.
	 */
	public function setup_admin_scripts() {
		
		if( get_theme_mod( 'rental_googleapi_key', '' ) != '' ){
			wp_enqueue_script( 'pw-google-maps-api', 'https://maps.googleapis.com/maps/api/js?key='.get_theme_mod( 'rental_googleapi_key', '' ).'&libraries=places', null, null );
		}else{
			wp_enqueue_script('google-map-api', 'https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false',array('jquery'),false,true);
		}
		wp_enqueue_script( 'pw-google-maps', IRECA_URI. '/extend/custom_metabox/js/script.js', array( 'pw-google-maps-api', 'jquery' ), null );
		wp_enqueue_style( 'pw-google-maps', IRECA_URI. '/extend/custom_metabox/css/style.css', array(), null );
	}

	
}
$pw_cmb2_field_google_maps = new PW_CMB2_Field_Google_Maps();
