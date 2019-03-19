<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */



add_action( 'cmb2_init', 'ireca_metaboxes_default' );
function ireca_metaboxes_default() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'ireca_met_';

    

    
    /* Page Settings ***************************************************************************/
    /* ************************************************************************************/
    $page_settings = new_cmb2_box( array(
        'id'            => 'page_heading_settings',
        'title'         => esc_html__( 'Show Page Heading', 'ireca' ),
        'object_types'  => array( 'page', 'post'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true,
        
    ) );

        // Display title of page
        $page_settings->add_field( array(
            'name'       => esc_html__( 'Show title of page', 'ireca' ),
            'desc'       => esc_html__( 'Allow display title of page', 'ireca' ),
            'id'         => $prefix . 'page_heading',
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => array(
                'yes' => esc_html__( 'Yes', 'ireca' ),
                'no'   => esc_html__('No', 'ireca' )
            ),
            'default' => 'yes',
            
        ) );

        $page_settings->add_field( array(
            'name'       => esc_html__( 'Show Breadcrumbs', 'ireca' ),
            'id'         => $prefix . 'show_breadcrumbs',
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => array(
                'yes' => esc_html__( 'Yes', 'ireca' ),
                'no'   => esc_html__('No', 'ireca' )
            ),
            'default' => 'yes',
            
        ) );

        


    
   

    
    /* Post Settings *********************************************************************************/
    /* *******************************************************************************/
    $post_settings = new_cmb2_box( array(
        'id'            => 'post_video',
        'title'         => esc_html__( 'Post Settings', 'ireca' ),
        'object_types'  => array( 'post'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ) );

        // Video or Audio
        $post_settings->add_field( array(
            'name'       => esc_html__( 'Link audio or video', 'ireca' ),
            'desc'       => esc_html__( 'Insert link audio or video use for video/audio post-format', 'ireca' ),
            'id'         => $prefix . 'embed_media',
            'type'             => 'oembed',
        ) );


        // Gallery image
        $post_settings->add_field( array(
            'name'       => esc_html__( 'Gallery image', 'ireca' ),
            'desc'       => esc_html__( 'image in gallery post format', 'ireca' ),
            'id'         => $prefix . 'file_list',
            'type'             => 'file_list',
        ) );




    /* General Settings ***************************************************************/
    /* ********************************************************************************/
    $general_settings = new_cmb2_box( array(
        'id'            => 'layout_settings',
        'title'         => esc_html__( 'General Settings', 'ireca' ),
        'object_types'  => array( 'page', 'post', 'product'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
    ));

        $general_settings->add_field( array(
            'name'       => esc_html__( 'Logo Desktop', 'ireca' ),
            'desc'       => esc_html__( 'If empty, The logo will get from Appearance >> Customize >> Header Global >> Logo', 'ireca' ),
            'id'         => $prefix . 'logo',
            'type'             => 'file',
        ) );

        $general_settings->add_field( array(
            'name'       => esc_html__( 'Logo Mobile', 'ireca' ),
            'desc'       => esc_html__( 'If empty, The logo will get from Appearance >> Customize >> Header Global >> Logo Mobile', 'ireca' ),
            'id'         => $prefix . 'logo_mobile',
            'type'             => 'file',
        ) );

        $general_settings->add_field( array(
            'name'       => esc_html__( 'Main Color', 'ireca' ),
            'desc'       => esc_html__( 'If you empty, the color will use in Appearance >> Customize >> Typography setting >> Main Color', 'ireca' ),
            'id'         => $prefix.'main_color',
            'default'    => '',
            'type'       => 'colorpicker',
        ) );

        $general_settings->add_field( array(
            'name'       => esc_html__( 'Second Color', 'ireca' ),
            'desc'       => esc_html__( 'If you empty, the color will use in Appearance >> Customize >> Typography setting >> Second Color', 'ireca' ),
            'id'         => $prefix.'second_color',
            'default'    => '',
            'type'       => 'colorpicker',
        ) );

        

        $general_settings->add_field( array(
            'name'       => esc_html__( 'Header Version', 'ireca' ),
            'id'         => $prefix . 'header_version',
            'description' => esc_html__( 'This value will override value in customizer', 'ireca' ),
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => ireca_load_header_metabox(),
            'default' => 'global'
            
        ));

        $general_settings->add_field( array(
            'name'       => esc_html__( 'Background Header', 'ireca' ),
            'desc'       => esc_html__( 'Display behind Menu', 'ireca' ),
            'id'         => $prefix . 'bg_header',
            'type'             => 'file',
        ) );



        $general_settings->add_field( array(
            'name'       => esc_html__( 'Footer Version', 'ireca' ),
            'id'         => $prefix . 'footer_version',
            'description' => esc_html__( 'This value will override value in customizer', 'ireca'  ),
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => ireca_load_footer_metabox(),
            'default' => 'global'

        ) );

        $general_settings->add_field( array(
            'name'       => esc_html__( 'Main Layout', 'ireca' ),
            'desc'       => esc_html__( 'This value will override value in theme customizer', 'ireca' ),
            'id'         => $prefix.'main_layout',
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => array(
                'global'   => esc_html__('Global in customizer', 'ireca' ),
                'right_sidebar' => esc_html__( 'Right Sidebar', 'ireca' ),
                'left_sidebar'   => esc_html__('Left Sidebar', 'ireca' ),
                'no_sidebar'   => esc_html__('No Sidebar', 'ireca' ),
                'fullwidth'     => esc_html__( 'Full Width', 'ireca' )
                ),
            'default' => 'global',
            
        ) );


        $general_settings->add_field( array(
            'name'       => esc_html__( 'Width of site', 'ireca' ),
            'desc'       => esc_html__( 'This value will override value in theme customizer', 'ireca' ),
            'id'         => $prefix . 'width_site',
            'type'             => 'select',
            'show_option_none' => false,
            'options'          => array(
                'global'    => esc_html__('Global in customizer', 'ireca'),
                'wide' => esc_html__( 'Wide', 'ireca' ),
                'boxed'   => esc_html__('Boxed', 'ireca' ),
            ),
            'default' => 'global',
            
        ) );

        
        /* Vehicle Settings ***************************************************************************/
        /* ************************************************************************************/
        $vehicle_settings = new_cmb2_box( array(
            'id'            => 'vehicle_settings',
            'title'         => esc_html__( 'Vehicle Settings', 'ireca' ),
            'object_types'  => array( 'vehicle'), // Post type
            'context'       => 'normal',
            'priority'      => 'high',
            'show_names'    => true,
            
        ) );


           

            // Display title of page
            $vehicle_settings->add_field( array(
                'name'       => esc_html__( 'ID Vehicle', 'ireca' ),
                'description'       => esc_html__( 'It is Unique, No Special Character, Space', 'ireca' ),
                'id'         => $prefix . 'id_vehicle',
                'type'             => 'text',
                'show_option_none' => false,
                
            ) );

            if( class_exists('OVACRS') && class_exists('woocommerce') ){
                $id_vehicle_location = ovacrs_get_locations_array();
            }else{
                $id_vehicle_location = array();
            }
            

            $vehicle_settings->add_field( array(
                'name'       => esc_html__( 'ID Vehicle is in the location', 'ireca' ),
                'id'         => $prefix.'id_vehicle_location',
                'type'             => 'select',
                'show_option_none' => false,
                'options'          => $id_vehicle_location,
                'default' => '',
                
            ) );

            $vehicle_settings->add_field( array(
                'name' => esc_html__( 'Address', 'ireca' ),
                'desc' => esc_html__( 'Drag the marker to set the exact location','ireca' ),
                'id' => $prefix . 'vehicle_address',
                'type' => 'pw_map',
                'split_values' => true, // Save latitude and longitude as two separate fields
            ) );

            
             $vehicle_settings->add_field( array(
                'name'       => esc_html__( 'Unavailable Time', 'ireca' ),
                'id'         => $prefix.'id_vehicle_untime_from_day',
                'type'             => 'ova_range_time',
                'default' => '',
                
            ) );
            
            
   
}


