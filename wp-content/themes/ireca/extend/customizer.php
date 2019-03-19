<?php


function ireca_customize_register( $wp_customize ) {

	/* Remove Colors &  Header Image Customize */
	$wp_customize->remove_section('colors');
	$wp_customize->remove_section('header_image');


	// Typography setting ////////////////////////////////////////////////////////////////////////////////////////////////////////
	$wp_customize->add_section( 'typography_section' , array(
	    'title'      => esc_html__( 'Typography setting', 'ireca' ),
	    'priority'   => 30,
	) );


	$wp_customize->add_setting( 'body_font', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'Poppins',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control(
		new Google_Font_Dropdown_Custom_Control( 
		$wp_customize, 
		'body_font', 
		array(
			'label'          => esc_html__('Body font','ireca'),
            'section'        => 'typography_section',
            'settings'       => 'body_font',
		) ) 
	);



	$wp_customize->add_setting( 'heading_font', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'Teko',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );
	
	$wp_customize->add_control(
		new Google_Font_Dropdown_Custom_Control( 
		$wp_customize, 
		'heading_font', 
		array(
			'label'          => esc_html__('Heading font','ireca'),
            'section'        => 'typography_section',
            'settings'       => 'heading_font',
		) ) 
	);

	$wp_customize->add_setting( 'main_color', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '#e9a31b',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'main_color', 
		array(
			'label'          => esc_html__("Main color",'ireca'),
            'section'        => 'typography_section',
            'settings'       => 'main_color',
		) ) 
	);

	$wp_customize->add_setting( 'second_color', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '#e82930',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'second_color', 
		array(
			'label'          => esc_html__("Second color",'ireca'),
            'section'        => 'typography_section',
            'settings'       => 'second_color',
		) ) 
	);


	$wp_customize->add_setting( 'ireca_custom_font', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('ireca_custom_font', array(
		'label' => esc_html__('Custom Font','ireca'),
		'description' => esc_html__('Step 1: Insert font-face in style.css file: Refer https://css-tricks.com/snippets/css/using-font-face/.  Step 2: Insert name-font here. For example: name-font1, name-font2. Step 3: Refresh customize page to display new font in dropdown font field.','ireca'),
		'section' => 'typography_section',
		'settings' => 'ireca_custom_font',
		'type' =>'textarea'
	));	

	
	// /Typography setting ////////////////////////////////////////////////////////////////////////////////////////////////////////


	// Header setting ////////////////////////////////////////////////////////////////////////////////////////////////////////
	$wp_customize->add_section( 'header_section' , array(
	    'title'      => esc_html__( 'Header Global', 'ireca' ),
	    'priority'   => 31,
	) );

	$wp_customize->add_setting( 'header_version', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'default',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('header_version', array(
		'label' => esc_html__('Header version','ireca'),
		'description' => esc_html__('Select Global Header. You can override Header in config of Post/Page','ireca'),
		'section' => 'header_section',
		'settings' => 'header_version',
		'type' =>'select',
		'choices' => ireca_load_header()

	));

	$wp_customize->add_setting( 'logo', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
	    'label'    => esc_html__( 'Logo', 'ireca' ),
	    'section'  => 'header_section',
	    'settings' => 'logo'
	)));


	$wp_customize->add_setting( 'logo_mobile', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_mobile', array(
	    'label'    => esc_html__( 'Logo Mobile', 'ireca' ),
	    'section'  => 'header_section',
	    'settings' => 'logo_mobile'
	)));

	$wp_customize->add_setting( 'header_show_stick', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'yes',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('header_show_stick', array(
		'label' => esc_html__('Show Menu Stick','ireca'),
		'section' => 'header_section',
		'settings' => 'header_show_stick',
		'type' =>'select',
		'choices' => array(
			'yes' => esc_html__( 'Yes', 'ireca' ),
			'no' => esc_html__( 'No', 'ireca' )
		)
	));
	
	
	// /Header setting ////////////////////////////////////////////////////////////////////////////////////////////////////////



	// Footer setting ////////////////////////////////////////////////////////////////////////////////////////////////////////

	$wp_customize->add_section( 'footer_section' , array(
	    'title'      => esc_html__( 'Footer Global', 'ireca' ),
	    'priority'   => 32,
	) );

	$wp_customize->add_setting( 'footer_version', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'default',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('footer_version', array(
		'label' => esc_html__('Footer version','ireca'),
		'description' => esc_html__('Select Global Footer. You can override Footer in config of Post/Page','ireca'),
		'section' => 'footer_section',
		'settings' => 'footer_version',
		'type' =>'select',
		'choices' => ireca_load_footer()

	));
	
	// /Footer setting ////////////////////////////////////////////////////////////////////////////////////////////////////////

	// Rental List setting ////////////////////////////////////////////////////////////////////////////////////////////////////////
	$wp_customize->add_panel( 'rental_list_panel', array(
	    'title' => 'Rental List',
	    'priority' => 33,
	) );

		$wp_customize->add_section( 'rl_default_section' , array(
		    'title'      => esc_html__( 'General Settings', 'ireca' ),
		    'priority'   => 30,
		    'panel' => 'rental_list_panel',
		) );

			$wp_customize->add_setting( 'rl_type', array(
			  'type' => 'theme_mod', // or 'option'
			  'capability' => 'edit_theme_options',
			  'theme_supports' => '', // Rarely needed.
			  'default' => '2columns',
			  'transport' => 'refresh', // or postMessage
			  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
			  
			) );

			$wp_customize->add_control('rl_type', array(
				'label' => esc_html__('Type display list page','ireca'),
				'section' => 'rl_default_section',
				'settings' => 'rl_type',
				'type' =>'select',
				'choices' => array(
					'2columns' => esc_html__( '2 Columns with Sidebar', 'ireca' ),
					'3columns' => esc_html__( '3 Columns no Sidebar', 'ireca' ),
					'style1' => esc_html__( 'Style 1 with Sidebar', 'ireca' ),
					'style2' => esc_html__( 'Style 2 with Sidebar', 'ireca' ),
					'style3' => esc_html__( 'Style 3 with Sidebar', 'ireca' ),
				)

			));

			$wp_customize->add_setting( 'rl_type_total_features', array(
			  'type' => 'theme_mod', // or 'option'
			  'capability' => 'edit_theme_options',
			  'theme_supports' => '', // Rarely needed.
			  'default' => '6',
			  'transport' => 'refresh', // or postMessage
			  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name
			) );

			$wp_customize->add_control('rl_type_total_features', array(
				'label' => esc_html__('Total feature display','ireca'),
				'section' => 'rl_default_section',
				'settings' => 'rl_type_total_features',
				'type' =>'number',
			));

			$wp_customize->add_setting( 'rl_total_other_features', array(
			  'type' => 'theme_mod', // or 'option'
			  'capability' => 'edit_theme_options',
			  'theme_supports' => '', // Rarely needed.
			  'default' => '4',
			  'transport' => 'refresh', // or postMessage
			  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name
			) );

			$wp_customize->add_control('rl_total_other_features', array(
				'label' => esc_html__('Total other feature display','ireca'),
				'section' => 'rl_default_section',
				'settings' => 'rl_total_other_features',
				'type' =>'number',
			));

			$wp_customize->add_setting( 'rl_total_attribute', array(
			  'type' => 'theme_mod', // or 'option'
			  'capability' => 'edit_theme_options',
			  'theme_supports' => '', // Rarely needed.
			  'default' => '0',
			  'transport' => 'refresh', // or postMessage
			  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name
			) );

			$wp_customize->add_control('rl_total_attribute', array(
				'label' => esc_html__('Total attribute display','ireca'),
				'section' => 'rl_default_section',
				'settings' => 'rl_total_attribute',
				'type' =>'number',
			));

			
			


			$wp_customize->add_setting( 'rl_header', array(
			  'type' => 'theme_mod', // or 'option'
			  'capability' => 'edit_theme_options',
			  'theme_supports' => '', // Rarely needed.
			  'default' => 'default',
			  'transport' => 'refresh', // or postMessage
			  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
			  
			) );

			$wp_customize->add_control('rl_header', array(
				'label' => esc_html__('Header style','ireca'),
				'section' => 'rl_default_section',
				'settings' => 'rl_header',
				'type' =>'select',
				'choices' => array(
					'default' => esc_html__( 'Default', 'ireca' ),
					'version1' => esc_html__( 'Version 1', 'ireca' ),
					'version2' => esc_html__( 'Version 2', 'ireca' ),
					'version3' => esc_html__( 'Version 3', 'ireca' ),
					'version4' => esc_html__( 'Version 4', 'ireca' ),
				)

			));


			$wp_customize->add_section( 'rl_search_section' , array(
			    'title'      => esc_html__( 'Search Settings', 'ireca' ),
			    'priority'   => 30,
			    'panel' => 'rental_list_panel',
			) );


				$wp_customize->add_setting( 'rl_show_search', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => 'true',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_show_search', array(
					'label' => esc_html__('Show Search','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_show_search',
					'type' =>'select',
					'choices' => array(
						'true' => esc_html__( 'Yes', 'ireca' ),
						'false' => esc_html__( 'No', 'ireca' )
					)

				));


				$wp_customize->add_setting( 'rl_search_show_pickup_loc', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => 'false',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_search_show_pickup_loc', array(
					'label' => esc_html__('Show Pickup Location','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_search_show_pickup_loc',
					'type' =>'select',
					'choices' => array(
						'true' => esc_html__( 'Yes', 'ireca' ),
						'false' => esc_html__( 'No', 'ireca' )
					)

				));

				$wp_customize->add_setting( 'rl_search_show_pickoff_loc', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => 'false',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_search_show_pickoff_loc', array(
					'label' => esc_html__('Show PickOff Location','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_search_show_pickoff_loc',
					'type' =>'select',
					'choices' => array(
						'true' => esc_html__( 'Yes', 'ireca' ),
						'false' => esc_html__( 'No', 'ireca' )
					)

				));


				$wp_customize->add_setting( 'rl_search_show_pickup_date', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => 'true',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_search_show_pickup_date', array(
					'label' => esc_html__('Show PickUp Date','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_search_show_pickup_date',
					'type' =>'select',
					'choices' => array(
						'true' => esc_html__( 'Yes', 'ireca' ),
						'false' => esc_html__( 'No', 'ireca' )
					)

				));

				$wp_customize->add_setting( 'rl_search_show_pickoff_date', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => 'true',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_search_show_pickoff_date', array(
					'label' => esc_html__('Show PickOff Date','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_search_show_pickoff_date',
					'type' =>'select',
					'choices' => array(
						'true' => esc_html__( 'Yes', 'ireca' ),
						'false' => esc_html__( 'No', 'ireca' )
					)

				));

				$wp_customize->add_setting( 'rl_search_show_cat', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => 'true',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_search_show_cat', array(
					'label' => esc_html__('Show Category','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_search_show_cat',
					'type' =>'select',
					'choices' => array(
						'true' => esc_html__( 'Yes', 'ireca' ),
						'false' => esc_html__( 'No', 'ireca' )
					)

				));


				$wp_customize->add_setting( 'rl_search_remove_cat', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => '',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_search_remove_cat', array(
					'label' => esc_html__('Remove Categories in dropdown','ireca'),
					'description' => esc_html__('Insert ID of category like 42, 15','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_search_remove_cat',
					'type' =>'text'

				));


				$wp_customize->add_setting( 'rl_search_show_type', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => 'true',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_search_show_type', array(
					'label' => esc_html__('Show Type','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_search_show_type',
					'type' =>'select',
					'choices' => array(
						'true' => esc_html__( 'Yes', 'ireca' ),
						'false' => esc_html__( 'No', 'ireca' )
					)

				));

				$wp_customize->add_setting( 'rl_search_remove_type', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => '',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_search_remove_type', array(
					'label' => esc_html__('Remove types in dropdown','ireca'),
					'description' => esc_html__('Insert ID of type like 42, 15','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_search_remove_type',
					'type' =>'text'

				));


				$wp_customize->add_setting( 'rl_search_pickup_loc_r', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => 'false',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_search_pickup_loc_r', array(
					'label' => esc_html__('Required Input: PickUp Location','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_search_pickup_loc_r',
					'type' =>'select',
					'choices' => array(
						'true' => esc_html__( 'Yes', 'ireca' ),
						'false' => esc_html__( 'No', 'ireca' )
					)

				));

				$wp_customize->add_setting( 'rl_search_pickoff_loc_r', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => 'false',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_search_pickoff_loc_r', array(
					'label' => esc_html__('Required Input: PickOff Location','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_search_pickoff_loc_r',
					'type' =>'select',
					'choices' => array(
						'true' => esc_html__( 'Yes', 'ireca' ),
						'false' => esc_html__( 'No', 'ireca' )
					)

				));

				$wp_customize->add_setting( 'rl_search_pickup_date_r', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => 'true',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_search_pickup_date_r', array(
					'label' => esc_html__('Required Input: PickUp Date','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_search_pickup_date_r',
					'type' =>'select',
					'choices' => array(
						'true' => esc_html__( 'Yes', 'ireca' ),
						'false' => esc_html__( 'No', 'ireca' )
					)

				));

				$wp_customize->add_setting( 'rl_search_pickoff_date_r', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => 'true',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_search_pickoff_date_r', array(
					'label' => esc_html__('Required Input: PickOff Date','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_search_pickoff_date_r',
					'type' =>'select',
					'choices' => array(
						'true' => esc_html__( 'Yes', 'ireca' ),
						'false' => esc_html__( 'No', 'ireca' )
					)

				));

				$wp_customize->add_setting( 'rl_search_cat_r', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => 'false',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_search_cat_r', array(
					'label' => esc_html__('Required Input: Category','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_search_cat_r',
					'type' =>'select',
					'choices' => array(
						'true' => esc_html__( 'Yes', 'ireca' ),
						'false' => esc_html__( 'No', 'ireca' )
					)

				));

				$wp_customize->add_setting( 'rl_search_type_r', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => 'false',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_search_type_r', array(
					'label' => esc_html__('Required Input: Type','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_search_type_r',
					'type' =>'select',
					'choices' => array(
						'true' => esc_html__( 'Yes', 'ireca' ),
						'false' => esc_html__( 'No', 'ireca' )
					)

				));

				$wp_customize->add_setting( 'rl_bf_dateformat', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => 'Y-m-d H:i',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_bf_dateformat', array(
					'label' => esc_html__('Date Format','ireca'),
					'description' => esc_html__('Use params: Y,m,d,H,i. Example: Y-m-d H:i','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_bf_dateformat',
					'type' =>'text'

				));

				


				$wp_customize->add_setting( 'rl_bf_hour_default', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => '09:00',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_bf_hour_default', array(
					'label' => esc_html__('Default Hour','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_bf_hour_default',
					'type' =>'text'

				));

				$wp_customize->add_setting( 'rl_bf_time_step', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => '30',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
				  
				) );

				$wp_customize->add_control('rl_bf_time_step', array(
					'label' => esc_html__('Step Time','ireca'),
					'description' => esc_html__('Example: 15, 20. List time to choose like 07:15, 07:30, 07:45, 08:00','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_bf_time_step',
					'type' =>'text'

				));


				$wp_customize->add_setting( 'rl_search_total_features', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => '6',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name
				) );

				$wp_customize->add_control('rl_search_total_features', array(
					'label' => esc_html__('Result: Total feature display','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_search_total_features',
					'type' =>'number',
				));

				$wp_customize->add_setting( 'rl_search_total_other_features', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => '4',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name
				) );

				$wp_customize->add_control('rl_search_total_other_features', array(
					'label' => esc_html__('Result: Total other feature display','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_search_total_other_features',
					'type' =>'number',
				));

				$wp_customize->add_setting( 'rl_search_total_attribute', array(
				  'type' => 'theme_mod', // or 'option'
				  'capability' => 'edit_theme_options',
				  'theme_supports' => '', // Rarely needed.
				  'default' => '0',
				  'transport' => 'refresh', // or postMessage
				  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name
				) );

				$wp_customize->add_control('rl_search_total_attribute', array(
					'label' => esc_html__('Result: Total attribute display','ireca'),
					'section' => 'rl_search_section',
					'settings' => 'rl_search_total_attribute',
					'type' =>'number',
				));



				


	// Rental Detail setting ////////////////////////////////////////////////////////////////////////////////////////////////////////
	$wp_customize->add_panel( 'rental_detail_panel', array(
	    'title' => 'Rental Detail',
	    'priority' => 33,
	) );

		$wp_customize->add_section( 'rd_show_hide_section' , array(
		    'title'      => esc_html__( 'Style Template', 'ireca' ),
		    'priority'   => 30,
		    'panel' => 'rental_detail_panel',
		) );


		$wp_customize->add_setting( 'rd_style', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'single-product',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_style', array(
			'label' => esc_html__('Template','ireca'),
			'section' => 'rd_show_hide_section',
			'settings' => 'rd_style',
			'type' =>'select',
			'choices' => array(
				'single-product' => esc_html__( 'Template 1', 'ireca' ),
				'single-product2' => esc_html__( 'Template 2', 'ireca' ),
			)

		));

		
		$wp_customize->add_setting( 'rd_show_title', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_show_title', array(
			'label' => esc_html__('Show Title','ireca'),
			'section' => 'rd_show_hide_section',
			'settings' => 'rd_show_title',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));

		$wp_customize->add_setting( 'rd_show_breadcrumbs', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_show_breadcrumbs', array(
			'label' => esc_html__('Show Breadcrumbs','ireca'),
			'section' => 'rd_show_hide_section',
			'settings' => 'rd_show_breadcrumbs',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));


		$wp_customize->add_setting( 'rd_show_act_booking', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_show_act_booking', array(
			'label' => esc_html__('Show Booking Button','ireca'),
			'section' => 'rd_show_hide_section',
			'settings' => 'rd_show_act_booking',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));


		$wp_customize->add_setting( 'rd_show_video_btn', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_show_video_btn', array(
			'label' => esc_html__('Show Video Button','ireca'),
			'section' => 'rd_show_hide_section',
			'settings' => 'rd_show_video_btn',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));


		$wp_customize->add_setting( 'rd_show_price', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_show_price', array(
			'label' => esc_html__('Show Price','ireca'),
			'section' => 'rd_show_hide_section',
			'settings' => 'rd_show_price',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));

		$wp_customize->add_setting( 'rd_show_images', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_show_images', array(
			'label' => esc_html__('Show Images','ireca'),
			'section' => 'rd_show_hide_section',
			'settings' => 'rd_show_images',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));

		


		$wp_customize->add_setting( 'rd_show_rating', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_show_rating', array(
			'label' => esc_html__('Show Rating','ireca'),
			'section' => 'rd_show_hide_section',
			'settings' => 'rd_show_rating',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));

		$wp_customize->add_setting( 'rd_show_excerpt', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_show_excerpt', array(
			'label' => esc_html__('Show Excerpt','ireca'),
			'section' => 'rd_show_hide_section',
			'settings' => 'rd_show_excerpt',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));

		$wp_customize->add_setting( 'rd_show_feature', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_show_feature', array(
			'label' => esc_html__('Show Feature','ireca'),
			'section' => 'rd_show_hide_section',
			'settings' => 'rd_show_feature',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));


		$wp_customize->add_setting( 'rd_show_other_feature', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_show_other_feature', array(
			'label' => esc_html__('Show other Feature','ireca'),
			'section' => 'rd_show_hide_section',
			'settings' => 'rd_show_other_feature',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));


		$wp_customize->add_setting( 'rd_show_table_price', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_show_table_price', array(
			'label' => esc_html__('Show Table Price','ireca'),
			'section' => 'rd_show_hide_section',
			'settings' => 'rd_show_table_price',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));

		$wp_customize->add_setting( 'rd_show_maintenance', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_show_maintenance', array(
			'label' => esc_html__('Show Maintenance','ireca'),
			'section' => 'rd_show_hide_section',
			'settings' => 'rd_show_maintenance',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));

		$wp_customize->add_setting( 'rd_show_calendar', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_show_calendar', array(
			'label' => esc_html__('Show Calendar','ireca'),
			'section' => 'rd_show_hide_section',
			'settings' => 'rd_show_calendar',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));

		$wp_customize->add_setting( 'rd_show_booking_form', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_show_booking_form', array(
			'label' => esc_html__('Show booking form','ireca'),
			'section' => 'rd_show_hide_section',
			'settings' => 'rd_show_booking_form',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));

		$wp_customize->add_setting( 'rd_show_request_booking', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_show_request_booking', array(
			'label' => esc_html__('Show request booking','ireca'),
			'section' => 'rd_show_hide_section',
			'settings' => 'rd_show_request_booking',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));

		$wp_customize->add_setting( 'rd_show_related', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_show_related', array(
			'label' => esc_html__('Show Related Products','ireca'),
			'section' => 'rd_show_hide_section',
			'settings' => 'rd_show_related',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));

	
	$wp_customize->add_section( 'rd_calendar' , array(
		    'title'      => esc_html__( 'Calendar', 'ireca' ),
		    'priority'   => 30,
		    'panel' => 'rental_detail_panel',
		) );

		$wp_customize->add_setting( 'rd_ca_nav_month', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_ca_nav_month', array(
			'label' => esc_html__('Show Navigation Month','ireca'),
			'section' => 'rd_calendar',
			'settings' => 'rd_ca_nav_month',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));

		$wp_customize->add_setting( 'rd_ca_nav_week', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_ca_nav_week', array(
			'label' => esc_html__('Show Navigation Week','ireca'),
			'section' => 'rd_calendar',
			'settings' => 'rd_ca_nav_week',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));

		$wp_customize->add_setting( 'rd_ca_nav_day', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_ca_nav_day', array(
			'label' => esc_html__('Show Navigation Day','ireca'),
			'section' => 'rd_calendar',
			'settings' => 'rd_ca_nav_day',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));


		$wp_customize->add_setting( 'rd_ca_nav_list', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_ca_nav_list', array(
			'label' => esc_html__('Show Navigation List','ireca'),
			'section' => 'rd_calendar',
			'settings' => 'rd_ca_nav_list',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
			)

		));

		$wp_customize->add_setting( 'rd_ca_default_view', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'month',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_ca_default_view', array(
			'label' => esc_html__('Default View','ireca'),
			'section' => 'rd_calendar',
			'settings' => 'rd_ca_default_view',
			'type' =>'select',
			'choices' => array(
				'month' => esc_html__( 'Month', 'ireca' ),
				'agendaWeek' => esc_html__( 'Week', 'ireca' ),
				'agendaDay' => esc_html__( 'Day', 'ireca' ),
				'listWeek' => esc_html__( 'List', 'ireca' ),
			)

		));


	$wp_customize->add_section( 'rd_booking_form' , array(
		    'title'      => esc_html__( 'Booking Form', 'ireca' ),
		    'priority'   => 30,
		    'panel' => 'rental_detail_panel',
		) );

		$wp_customize->add_setting( 'rd_bf_show_pickup_loc', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_bf_show_pickup_loc', array(
			'label' => esc_html__('Show Pickup Location','ireca'),
			'section' => 'rd_booking_form',
			'settings' => 'rd_bf_show_pickup_loc',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
				
			)

		));


		$wp_customize->add_setting( 'rd_bf_show_pickoff_loc', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_bf_show_pickoff_loc', array(
			'label' => esc_html__('Show Pickoff Location','ireca'),
			'section' => 'rd_booking_form',
			'settings' => 'rd_bf_show_pickoff_loc',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
				
			)

		));

		$wp_customize->add_setting( 'rd_bf_show_extra_resource', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_bf_show_extra_resource', array(
			'label' => esc_html__('Show Extra Resource','ireca'),
			'section' => 'rd_booking_form',
			'settings' => 'rd_bf_show_extra_resource',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' ),
				
			)

		));

		

		$wp_customize->add_setting( 'rd_bf_dateformat', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'Y-m-d H:i',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_bf_dateformat', array(
			'label' => esc_html__('Date Format','ireca'),
			'description' => esc_html__('Use params: Y,m,d,H,i. Example: Y-m-d H:i','ireca'),
			'section' => 'rd_booking_form',
			'settings' => 'rd_bf_dateformat',
			'type' =>'text'

		));

		


		$wp_customize->add_setting( 'rd_bf_hour_default', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => '09:00',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_bf_hour_default', array(
			'label' => esc_html__('Default Hour','ireca'),
			'section' => 'rd_booking_form',
			'settings' => 'rd_bf_hour_default',
			'type' =>'text'

		));

		$wp_customize->add_setting( 'rd_bf_time_step', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => '30',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_bf_time_step', array(
			'label' => esc_html__('Step Time','ireca'),
			'description' => esc_html__('Example: 15, 20. List time to choose like 07:15, 07:30, 07:45, 08:00','ireca'),
			'section' => 'rd_booking_form',
			'settings' => 'rd_bf_time_step',
			'type' =>'text'

		));



		


	$wp_customize->add_section( 'rd_request_booking_form' , array(
		    'title'      => esc_html__( 'Request Booking Form', 'ireca' ),
		    'priority'   => 30,
		    'panel' => 'rental_detail_panel',
		) );


		$wp_customize->add_setting( 'rd_rbf_order_tab', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => '11',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_rbf_order_tab', array(
			'label' => esc_html__('Display Tab after Description or Review Tab','ireca'),
			'description' => esc_html__('You can insert 9, 11, 31','ireca'),
			'section' => 'rd_request_booking_form',
			'settings' => 'rd_rbf_order_tab',
			'type' =>'text',
		));



		$wp_customize->add_setting( 'rd_rbf_thank_page', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => '',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_rbf_thank_page', array(
			'label' => esc_html__('Thank Page','ireca'),
			'section' => 'rd_request_booking_form',
			'settings' => 'rd_rbf_thank_page',
			'type' =>'text'
		));


		$wp_customize->add_setting( 'rd_rbf_error_page', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => '',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_rbf_error_page', array(
			'label' => esc_html__('Error Page','ireca'),
			'section' => 'rd_request_booking_form',
			'settings' => 'rd_rbf_error_page',
			'type' =>'text'
		));


		$wp_customize->add_setting( 'rd_rbf_show_number', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_rbf_show_number', array(
			'label' => esc_html__('Show Number','ireca'),
			'section' => 'rd_request_booking_form',
			'settings' => 'rd_rbf_show_number',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' )
			)
		));

		$wp_customize->add_setting( 'rd_rbf_show_address', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_rbf_show_address', array(
			'label' => esc_html__('Show Address','ireca'),
			'section' => 'rd_request_booking_form',
			'settings' => 'rd_rbf_show_address',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' )
			)
		));


		$wp_customize->add_setting( 'rd_rbf_show_pickup_loc', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_rbf_show_pickup_loc', array(
			'label' => esc_html__('Show Pickup Location','ireca'),
			'section' => 'rd_request_booking_form',
			'settings' => 'rd_rbf_show_pickup_loc',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' )
			)
		));

		$wp_customize->add_setting( 'rd_rbf_show_pickoff_loc', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_rbf_show_pickoff_loc', array(
			'label' => esc_html__('Show Pickoff Location','ireca'),
			'section' => 'rd_request_booking_form',
			'settings' => 'rd_rbf_show_pickoff_loc',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' )
			)
		));

		$wp_customize->add_setting( 'rd_rbf_show_extra_source', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_rbf_show_extra_source', array(
			'label' => esc_html__('Show Extra Service','ireca'),
			'section' => 'rd_request_booking_form',
			'settings' => 'rd_rbf_show_extra_source',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' )
			)
		));

		$wp_customize->add_setting( 'rd_rbf_show_extra_info', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rd_rbf_show_extra_info', array(
			'label' => esc_html__('Show Extra Info','ireca'),
			'section' => 'rd_request_booking_form',
			'settings' => 'rd_rbf_show_extra_info',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' )
			)
		));

		
	// Location Setting ////////////////////////////////////////////////////////////////////////////////////////////////////////
	

		$wp_customize->add_section( 'rental_location_settings' , array(
		    'title'      => esc_html__( 'Location Settings', 'ireca' ),
		    'priority'   => 33,
		    'id' => 'rental_location_settings',
		) );


		$wp_customize->add_setting( 'use_loc_filter', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('use_loc_filter', array(
			'label' => esc_html__('Use Location to Validate in Booking Vehicle','ireca'),
			'section' => 'rental_location_settings',
			'settings' => 'use_loc_filter',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' )
			)
		));	

		$wp_customize->add_setting( 'use_loc_filter_search', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => 'true',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('use_loc_filter_search', array(
			'label' => esc_html__('Use Location to Validate in Search Vehicle','ireca'),
			'section' => 'rental_location_settings',
			'settings' => 'use_loc_filter_search',
			'type' =>'select',
			'choices' => array(
				'true' => esc_html__( 'Yes', 'ireca' ),
				'false' => esc_html__( 'No', 'ireca' )
			)
		));	

	
	// Google API Setting ////////////////////////////////////////////////////////////////////////////////////////////////////////
	

		$wp_customize->add_section( 'rental_googleapi_settings' , array(
		    'title'      => esc_html__( 'Google API Settings', 'ireca' ),
		    'priority'   => 33,
		    'id' => 'rental_googleapi_settings',
		) );


		$wp_customize->add_setting( 'rental_googleapi_key', array(
		  'type' => 'theme_mod', // or 'option'
		  'capability' => 'edit_theme_options',
		  'theme_supports' => '', // Rarely needed.
		  'default' => '',
		  'transport' => 'refresh', // or postMessage
		  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
		  
		) );

		$wp_customize->add_control('rental_googleapi_key', array(
			'label' => esc_html__('Key','ireca'),
			'section' => 'rental_googleapi_settings',
			'settings' => 'rental_googleapi_key',
			'type' =>'text'
		));			


	// Blog setting ////////////////////////////////////////////////////////////////////////////////////////////////////////

	$wp_customize->add_section( 'blog_section' , array(
	    'title'      => esc_html__( 'Blog Global', 'ireca' ),
	    'priority'   => 34,
	) );

	$wp_customize->add_setting( 'date_style', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'style1',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('date_style', array(
		'label' => esc_html__('Date Style','ireca'),
		'section' => 'blog_section',
		'settings' => 'date_style',
		'type' =>'select',
		'choices' => array(
			'style1' => esc_html__('Style 1', 'ireca'),
			'style2' => esc_html__('Style 2', 'ireca')
			)
	));

	$wp_customize->add_setting( 'default_icon_wd', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'arrow_carrot-2down',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('default_icon_wd', array(
		'label' => esc_html__('Default Icon Widget','ireca'),
		'description' => esc_html__('Insert Font Icon ','ireca'),
		'section' => 'blog_section',
		'settings' => 'default_icon_wd',
		'type' =>'text'
	));
	
		


	// Layout setting ////////////////////////////////////////////////////////////////////////////////////////////////////////

	$wp_customize->add_section( 'layout_section' , array(
	    'title'      => esc_html__( 'Layout Global', 'ireca' ),
	    'priority'   => 34,
	) );

	$wp_customize->add_setting( 'main_layout', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'right_sidebar',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('main_layout', array(
		'label' => esc_html__('Global Layout for site','ireca'),
		'section' => 'layout_section',
		'settings' => 'main_layout',
		'description' => esc_html__('You can override Layout in config of Post/Page', 'ireca'),
		'type' =>'select',
		'choices' => array(
			'right_sidebar' => esc_html__('Right Sidebar', 'ireca'),
			'left_sidebar' => esc_html__('Left Sidebar', 'ireca'),
			'no_sidebar' => esc_html__('No Sidebar','ireca'),
			'fullwidth' => esc_html__('Full Width','ireca'),
			)

	));


	$wp_customize->add_setting( 'width_site', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'wide',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('width_site', array(
		'label' => esc_html__('Width of site','ireca'),
		'section' => 'layout_section',
		'settings' => 'width_site',
		'type' =>'select',
		'choices' => array(
			'wide' => esc_html__( 'Wide', 'ireca' ),
            'boxed'   => esc_html__('Boxed', 'ireca')
			)

	));

	// Sidebar column setting
	$wp_customize->add_setting( 'sidebar_column', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '4',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('sidebar_column', array(
		'label' => esc_html__('Sidebar column','ireca'),
		'description' => esc_html__('main column + sidebar column = 12 columns','ireca'),
		'section' => 'layout_section',
		'settings' => 'sidebar_column',
		'type' =>'select',
		'choices' => array(
			'1' => esc_html__('1 column', 'ireca'),
			'2' => esc_html__('2 columns', 'ireca'),
			'3' => esc_html__('3 columns', 'ireca'),
			'4' => esc_html__('4 columns', 'ireca'),
			'5' => esc_html__('5 columns', 'ireca'),
			'6' => esc_html__('6 columns', 'ireca')
			)
	));

	// Main column settings
	$wp_customize->add_setting( 'main_column', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '8',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('main_column', array(
		'label' => esc_html__('Main column','ireca'),
		'description' => esc_html__('main column + sidebar column = 12 columns','ireca'),
		'section' => 'layout_section',
		'settings' => 'main_column',
		'type' =>'select',
		'choices' => array(
			'11' => esc_html__('11 columns', 'ireca'),
			'10' => esc_html__('10 columns', 'ireca'),
			'9' => esc_html__('9 columns', 'ireca'),
			'8' => esc_html__('8 columns', 'ireca'),
			'7' => esc_html__('7 columns', 'ireca'),
			'6' => esc_html__('6 columns', 'ireca'),
			)
	));
	
	// /Layout setting ////////////////////////////////////////////////////////////////////////////////////////////////////////


	// Calendar setting ////////////////////////////////////////////////////////////////////////////////////////////////////////

	$wp_customize->add_section( 'calendar_section' , array(
	    'title'      => esc_html__( 'Calendar', 'ireca' ),
	    'priority'   => 34,
	) );

	$wp_customize->add_setting( 'calendar_layout', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'en',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('calendar_layout', array(
		'label' => esc_html__('Calendar Language','ireca'),
		'section' => 'calendar_section',
		'settings' => 'calendar_layout',
		'type' =>'select',
		'choices' => array(
			'ar' => esc_html__('Arabic', 'ireca'),
			'az' => esc_html__('Azerbaijanian (Azeri)', 'ireca'),
			'bg' => esc_html__('Bulgarian','ireca'),
			'bs' => esc_html__('Bosanski','ireca'),
			'ca' => esc_html__('Català','ireca'),
			'ch' => esc_html__('Simplified Chinese','ireca'),
			'cs' => esc_html__('Čeština','ireca'),
			'da' => esc_html__('Dansk','ireca'),
			'de' => esc_html__('German','ireca'),
			'el' => esc_html__('Ελληνικά','ireca'),
			'en' => esc_html__('English','ireca'),
			'en-GB' => esc_html__('English (British) ','ireca'),
			'es' => esc_html__('Spanish','ireca'),
			'et' => esc_html__('Eesti','ireca'),
			'eu' => esc_html__('Euskara','ireca'),
			'fa' => esc_html__('Persian','ireca'),
			'fi' => esc_html__('Finnish (Suomi)','ireca'),
			'fr' => esc_html__('French','ireca'),
			'gl' => esc_html__('Galego','ireca'),
			'he' => esc_html__('Hebrew (עברית)','ireca'),
			'hr' => esc_html__('Hrvatski','ireca'),
			'hu' => esc_html__('Hungarian','ireca'),
			'id' => esc_html__('Indonesian','ireca'),
			'it' => esc_html__('Italian','ireca'),
			'ja' => esc_html__('Japanese','ireca'),
			'ko' => esc_html__('Korean (한국어)','ireca'),
			'kr' => esc_html__('Korean','ireca'),
			'lt' => esc_html__('Lithuanian (lietuvių) ','ireca'),
			'lv' => esc_html__('Latvian (Latviešu)','ireca'),
			'mk' => esc_html__('Macedonian (Македонски)','ireca'),
			'mn' => esc_html__('Mongolian (Монгол)','ireca'),
			'nl' => esc_html__('Dutch','ireca'),
			'no' => esc_html__('Norwegian','ireca'),
			'pl' => esc_html__('Polish','ireca'),
			'pt' => esc_html__('Portuguese','ireca'),
			'pt-BR' => esc_html__('Português(Brasil)','ireca'),
			'ro' => esc_html__('Romanian','ireca'),
			'ru' => esc_html__('Russian','ireca'),
			'se' => esc_html__('Swedish','ireca'),
			'sk' => esc_html__('Slovenčina','ireca'),
			'sl' => esc_html__('Slovenščina','ireca'),
			'sq' => esc_html__('Albanian (Shqip)','ireca'),
			'sr' => esc_html__('Serbian Cyrillic (Српски)','ireca'),
			'sr-YU' => esc_html__('Serbian (Srpski)','ireca'),
			'sv' => esc_html__('Svenska','ireca'),
			'th' => esc_html__('Thai','ireca'),
			'tr' => esc_html__('Turkish','ireca'),
			'uk' => esc_html__('Ukrainian','ireca'),
			'vi' => esc_html__('Vietnamese','ireca'),
			'zh' => esc_html__('Simplified Chinese (简体中文)','ireca'),
			'zh-TW' => esc_html__('Traditional Chinese (繁體中文)','ireca'),
			)

	));


	$wp_customize->add_setting( 'calendar_time', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '07:00, 07:30, 08:00, 08:30, 09:00, 09:30, 10:00, 10:30, 11:00, 11:30, 12:00, 12:30, 13:00, 13:30, 14:00, 14:30, 15:00, 15:30, 16:00, 16:30, 17:00, 17:30, 18:00',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback'// Get function name 
	  
	) );
	$wp_customize->add_control('calendar_time', array(
		'label' => esc_html__('Time to book','ireca'),
		'description' => esc_html__('Like 07:00, 07:30, 08:00, 08:30, 09:00, 09:30, 10:00, 10:30, 11:00, 11:30, 12:00, 12:30, 13:00, 13:30, 14:00, 14:30, 15:00, 15:30, 16:00, 16:30, 17:00, 17:30, 18:00','ireca'),
		'section' => 'calendar_section',
		'settings' => 'calendar_time',
		'type' =>'text',
		
	));

	$wp_customize->add_setting( 'calendar_dis_weekend', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '0,6',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback'// Get function name 
	  
	) );
	$wp_customize->add_control('calendar_dis_weekend', array(
		'label' => esc_html__('Disabled Week Days','ireca'),
		'description' => esc_html__('0: Sunday, 1: Monday, 2: Tuesday, 3: Wednesday, 4: Thursday, 5: Friday, 6: Saturday','ireca'),
		'section' => 'calendar_section',
		'settings' => 'calendar_dis_weekend',
		'type' =>'text',
		
	));

	

	
	// Woo setting ////////////////////////////////////////////////////////////////////////////////////////////////////////
	$wp_customize->add_section( 'woo_section' , array(
	    'title'      => esc_html__( 'Woocommerce setting', 'ireca' ),
	    'priority'   => 35,
	) );

	// Woo layout
	$wp_customize->add_setting( 'woo_layout', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => 'no_sidebar',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback'// Get function name 
	  
	) );
	$wp_customize->add_control('woo_layout', array(
		'label' => esc_html__('Layout','ireca'),
		'section' => 'woo_section',
		'settings' => 'woo_layout',
		'type' =>'select',
		'choices' => array(
			'no_sidebar' => esc_html__('No Sidebar','ireca'),
			'right_sidebar' => esc_html__('Right Sidebar','ireca'),
			'left_sidebar' => esc_html__('Left Sidebar','ireca'),
			'fullwidth' => esc_html__('Full Width','ireca')
			)
	));


	// Woo Sidebar column
	$wp_customize->add_setting( 'woo_sidebar_column', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '4',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('woo_sidebar_column', array(
		'label' => esc_html__('Woo Sidebar column','ireca'),
		'description' => esc_html__('main column + sidebar column = 12 columns','ireca'),
		'section' => 'woo_section',
		'settings' => 'woo_sidebar_column',
		'type' =>'select',
		'choices' => array(
			'1' => esc_html__('1 column', 'ireca'),
			'2' => esc_html__('2 columns', 'ireca'),
			'3' => esc_html__('3 columns', 'ireca'),
			'4' => esc_html__('4 columns', 'ireca'),
			'5' => esc_html__('5 columns', 'ireca'),
			'6' => esc_html__('6 columns', 'ireca')
			)
	));

	// Woo Main column
	$wp_customize->add_setting( 'woo_main_column', array(
	  'type' => 'theme_mod', // or 'option'
	  'capability' => 'edit_theme_options',
	  'theme_supports' => '', // Rarely needed.
	  'default' => '8',
	  'transport' => 'refresh', // or postMessage
	  'sanitize_callback' => 'ireca_fun_sanitize_callback' // Get function name 
	  
	) );

	$wp_customize->add_control('woo_main_column', array(
		'label' => esc_html__('Woo Main column','ireca'),
		'description' => esc_html__('main column + sidebar column = 12 columns','ireca'),
		'section' => 'woo_section',
		'settings' => 'woo_main_column',
		'type' =>'select',
		'choices' => array(
			'11' => esc_html__('11 columns', 'ireca'),
			'10' => esc_html__('10 columns', 'ireca'),
			'9' => esc_html__('9 columns', 'ireca'),
			'8' => esc_html__('8 columns', 'ireca'),
			'7' => esc_html__('7 columns', 'ireca'),
			'6' => esc_html__('6 columns', 'ireca'),
			)
	));



}

function ireca_fun_sanitize_callback($value){
    return $value;
}


add_action( 'customize_register', 'ireca_customize_register' );	

