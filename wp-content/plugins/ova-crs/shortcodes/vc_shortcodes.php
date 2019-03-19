<?php

add_action('init','vc_ovacrs_info',1000);
function vc_ovacrs_info(){
    if(function_exists('vc_map')){


    	// ovacrs_info
		vc_map( array(
			 "name" => esc_html__("Info", 'ova-crs'),
			 "base" => "ovacrs_info",
			 "class" => "",
			 "category" => esc_html__("IRECA", 'ova-crs'),
			 "icon" => "icon-qk",   
			  "params" => array(

			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Icon",'ova-crs'),
			       "param_name" => "icon"
			    ),
			    array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Text",'ova-crs'),
			       "param_name" => "text"
			    ),
			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Class",'ova-crs'),
			       "param_name" => "class"
			       
			    )
			  )
		));

		// service
		vc_map( array(
			 "name" => esc_html__("Service", 'ova-crs'),
			 "base" => "ovacrs_service",
			 "class" => "",
			 "category" => esc_html__("IRECA", 'ova-crs'),
			 "icon" => "icon-qk",   
			  "params" => array(

			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Icon",'ova-crs'),
			       "param_name" => "icon"
			    ),
			    array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Title",'ova-crs'),
			       "param_name" => "title"
			    ),
			    array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Link title",'ova-crs'),
			       "param_name" => "title_link"
			    ),
			    
			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Target",'ova-crs'),
			       "param_name" => "target",
			       "value"	=> array(
			       	esc_html__('Same Window', 'ova-crs') => '_self',
			       	esc_html__('New Window', 'ova-crs') => '_blank',
			       ),
			       "default" => '_self'

			    ),
			    
			    array(
			       "type" => "textarea_html",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Description",'ova-crs'),
			       "param_name" => "content"
			    ),
			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Show line",'ova-crs'),
			       "param_name" => "show_line",
			       "value"	=> array(
			       	esc_html__('Yes', 'ova-crs') => 'yes',
			       	esc_html__('No', 'ova-crs') => 'no',
			       ),
			       "default" => 'yes'

			    ),
			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Class",'ova-crs'),
			       "param_name" => "class"
			       
			    )
			  )
		));

		vc_map( array(
			 "name" => esc_html__("Divide", 'ova-crs'),
			 "base" => "ovacrs_divide",
			 "class" => "",
			 "category" => esc_html__("IRECA", 'ova-crs'),
			 "icon" => "icon-qk",   
			  "params" => array(

			  	array(
			       "type" => "attach_image",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Logo",'ova-crs'),
			       "param_name" => "img"
			    ),
			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Class",'ova-crs'),
			       "param_name" => "class"
			       
			    )
			  )
		));

		

		vc_map( array(
			 "name" => esc_html__("Product Filter", 'ova-crs'),
			 "base" => "ovacrs_product_filter",
			 "class" => "",
			 "category" => esc_html__("IRECA", 'ova-crs'),
			 "description" => esc_html__("Filter by Category", 'ova-crs'),
			 "icon" => "icon-qk",   
			  "params" => array(

			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Slug Category",'ova-crs'),
			       "param_name" => "array_slug"
			    ),

			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Tab Active",'ova-crs'),
			       "description" => esc_html__("Insert Slug of Category",'ova-crs'),
			       "param_name" => "tab_active"
			    ),

			    
			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Show Products",'ova-crs'),
			       "description" => esc_html__("For Renting: you have to choose Product data is Car Rental.  For Selling: You can choose Any Product data except Car Rental.",'ova-crs'),
			       "param_name" => "filters",
			       "value" => array(
			       	esc_html__( "For Renting", 'ova-crs' ) => "rent",
			       	esc_html__( "For Selling" , 'ova-crs' ) => "sell",
			       	esc_html__( "Both (Rent, Sell) ", 'ova-crs'  ) => "both",
			       ),
			       "default" => "rent"
			    ),

			  	array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Order By",'ova-crs'),
			       "description" => esc_html__("Custom Order: You have to insert number in \"Order at frontend\" Field of product",'ova-crs'),
			       "param_name" => "orderby",
			       "value" => array(
			       	esc_html__( "ID" ) => "id",
			       	esc_html__( "Custom Order" ) => "order",
			       	esc_html__( "Total Sales" ) => "total_sales",
			       	esc_html__( "Rating" ) => "rating",
			       ),
			       "default" => "id"
			    ),
			  	 array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Order",'ova-crs'),
			       "param_name" => "order",
			       "value" => array(
			       	esc_html__( "Decrease" ) => "DESC",
			       	esc_html__( "Ascending" ) => "ASC",
			       ),
			       "default" => "DESC"
			    ),

			    
			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Show Category Tab",'ova-crs'),
			       "param_name" => "show_tab",
			       "value" => array(
			       	esc_html__( "Yes" ) => "yes",
			       	esc_html__( "No" ) => "no",
			       ),
			       "default" => "yes"
			    ),

			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Align Navigation (tab)",'ova-crs'),
			       "param_name" => "align_nav",
			       "value" => array(
			       	esc_html__( "Right" ) => "justify-content-end",
			       	esc_html__( "Center" ) => "justify-content-center",
			       	esc_html__( "Left" ) => "",
			       ),
			       "default" => "justify-content-end"
			    ),

			     array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Style Box Item",'ova-crs'),
			       "param_name" => "product_style",
			       "value" => array(
			       	esc_html__( "Style 1" ) => "style1",
			       	esc_html__( "Style 2" ) => "style2",
			       ),
			       "default" => "style1"
			    ),

			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Total columns in each slide",'ova-crs'),
			       "param_name" => "total_columns_slide",
			       "value" => array(
					esc_html__( "2 items" ) => "2",
					esc_html__( "3 items" ) => "3",
			       	esc_html__( "4 items" ) => "4"
			       ),
			       "default" => "2"
			    ),
			    
			    array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Total items in each column",'ova-crs'),
			       "description" => esc_html__("Insert interger",'ova-crs'),
			       "param_name" => "total_items_column",
			       "value" => "1"
			    ),

			    array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Total items in each category",'ova-crs'),
			       "description" => esc_html__("Insert interger. Insert -1 to display all items in category",'ova-crs'),
			       "param_name" => "total_items_cat",
			       "value" => "100"
			    ),

			    array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Button Text",'ova-crs'),
			       "param_name" => "butotn_text",
			       "value" => "Rent it"
			    ),
			    
			    
			    
			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Show Navigation",'ova-crs'),
			       "param_name" => "show_nav",
			       "value" => array(
			       	esc_html__( "Yes" ) => "yes",
			       	esc_html__( "No" ) => "no",
			       ),
			       "default" => "yes"
			    ),

			    array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Icon at Navigation",'ova-crs'),
			       "description" => esc_html__("Insert Font Class ",'ova-crs'),
			       "param_name" => "icon_nav"
			    ),

			    array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Auto Slide",'ova-crs'),
			       "description" => esc_html__("Insert false : not auto . Insert number integer (ms) for auto. Example 5000 ",'ova-crs'),
			       "param_name" => "auto_slide",
			       "value" => "false"
			    ),

			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Show Thumbnail",'ova-crs'),
			       "param_name" => "show_thumbnail",
			       "value" => array(
			       	esc_html__( "Yes" ) => "yes",
			       	esc_html__( "No" ) => "no",
			       ),
			       "default" => "yes"
			    ),
			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Show Price",'ova-crs'),
			       "param_name" => "show_price",
			       "value" => array(
			       	esc_html__( "Yes" ) => "yes",
			       	esc_html__( "No" ) => "no",
			       ),
			       "default" => "yes"
			    ),
			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Show Time Rental (/Day, /Hour)",'ova-crs'),
			       "param_name" => "show_time_rental",
			       "value" => array(
			       	esc_html__( "Yes" ) => "yes",
			       	esc_html__( "No" ) => "no",
			       ),
			       "default" => "yes"
			    ),
			    

			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Show Title",'ova-crs'),
			       "param_name" => "show_title",
			       "value" => array(
			       	esc_html__( "Yes" ) => "yes",
			       	esc_html__( "No" ) => "no",
			       ),
			       "default" => "yes"
			    ),

			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Show Rating Star",'ova-crs'),
			       "param_name" => "show_rating_star",
			       "value" => array(
			       	esc_html__( "Yes" ) => "yes",
			       	esc_html__( "No" ) => "no",
			       ),
			       "default" => "yes"
			    ),

			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Show Rating text",'ova-crs'),
			       "param_name" => "show_rating_text",
			       "value" => array(
			       	esc_html__( "Yes" ) => "yes",
			       	esc_html__( "No" ) => "no",
			       ),
			       "default" => "yes"
			    ),
			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Show Feature",'ova-crs'),
			       "param_name" => "show_feature",
			       "value" => array(
			       	esc_html__( "Yes" ) => "yes",
			       	esc_html__( "No" ) => "no",
			       ),
			       "default" => "yes"
			    ),
			    
			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Class",'ova-crs'),
			       "param_name" => "class"
			       
			    )
			  )
		));
		
		vc_map( array(
			 "name" => esc_html__("Heading 1", 'ova-crs'),
			 "base" => "ovacrs_heading1",
			 "class" => "",
			 "category" => esc_html__("IRECA", 'ova-crs'),
			 "icon" => "icon-qk",   
			  "params" => array(

			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Title",'ova-crs'),
			       "param_name" => "title"
			    ),
			    array(
			       "type" => "textarea_html",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Description",'ova-crs'),
			       "param_name" => "content"
			    ),
			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Style",'ova-crs'),
			       "param_name" => "style",
			       "value" => array(
			       	esc_html__( "Style 1", 'ova-crs' ) => "style1",
			       	esc_html__( "Style 2", 'ova-crs' ) => "style2"
			       ),
			       "default" => "style1"
			    ),
			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Class",'ova-crs'),
			       "param_name" => "class"
			       
			    )
			  )
		));

		vc_map( array(
			 "name" => esc_html__("Heading 2", 'ova-crs'),
			 "base" => "ovacrs_heading2",
			 "class" => "",
			 "category" => esc_html__("IRECA", 'ova-crs'),
			 "icon" => "icon-qk",   
			  "params" => array(

			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Title",'ova-crs'),
			       "param_name" => "title"
			    ),
			    array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Highlight title",'ova-crs'),
			       "param_name" => "highlight_title"
			    ),
			    array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Highlight icon",'ova-crs'),
			       "description" => esc_html__("Insert icon font",'ova-crs'),
			       "param_name" => "highlight_icon"
			    ),
			    array(
			       "type" => "textarea_html",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Description",'ova-crs'),
			       "param_name" => "content"
			    ),
			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Class",'ova-crs'),
			       "param_name" => "class"
			       
			    )
			  )
		));

		vc_map( array(
			 "name" => esc_html__("Text Support", 'ova-crs'),
			 "base" => "ovacrs_support",
			 "class" => "",
			 "category" => esc_html__("IRECA", 'ova-crs'),
			 "icon" => "icon-qk",   
			  "params" => array(

			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Title",'ova-crs'),
			       "param_name" => "title"
			    ),
			    array(
			       "type" => "textarea_html",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Description",'ova-crs'),
			       "param_name" => "content"
			    ),
			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Show Bold Line",'ova-crs'),
			       "param_name" => "show_line",
			       "value" => array(
			       	esc_html__( "Yes", 'ova-crs' ) => "yes",
			       	esc_html__( "No", 'ova-crs' ) => "no"
			       ),
			       "default" => "yes"
			    ),
			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Text color",'ova-crs'),
			       "param_name" => "text_color",
			       "value" => array(
			       	esc_html__( "Dark", 'ova-crs' ) => "dark",
			       	esc_html__( "White", 'ova-crs' ) => "white"
			       ),
			       "default" => "dark"
			    ),
			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Class",'ova-crs'),
			       "param_name" => "class"
			       
			    )
			  )
		));

		vc_map( array(
			 "name" => esc_html__("Button Action", 'ova-crs'),
			 "base" => "ovacrs_btn_action",
			 "class" => "",
			 "category" => esc_html__("IRECA", 'ova-crs'),
			 "icon" => "icon-qk",   
			  "params" => array(

			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Title",'ova-crs'),
			       "param_name" => "title"
			    ),
			    array(
			       "type" => "textarea_html",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Phone",'ova-crs'),
			       "param_name" => "content"
			    ),

			    array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Button Text",'ova-crs'),
			       "param_name" => "btn_text"
			    ),
			    array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Button Link",'ova-crs'),
			       "param_name" => "btn_link"
			    ),
			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Button Target",'ova-crs'),
			       "param_name" => "btn_target",
			       "value" => array(
			       	esc_html__( "Same Window", 'ova-crs' ) => "_self",
			       	esc_html__( "New Window", 'ova-crs' ) => "_blank"
			       ),
			       "default" => "_self"
			    ),
			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Text color",'ova-crs'),
			       "param_name" => "text_color",
			       "value" => array(
			       	esc_html__( "Dark", 'ova-crs' ) => "dark",
			       	esc_html__( "White", 'ova-crs' ) => "white"
			       ),
			       "default" => "dark"
			    ),
			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Class",'ova-crs'),
			       "param_name" => "class"
			       
			    )
			  )
		));



		vc_map( array(
			 "name" => esc_html__("Why", 'ova-crs'),
			 "base" => "ovacrs_why",
			 "class" => "",
			 "category" => esc_html__("IRECA", 'ova-crs'),
			 "icon" => "icon-qk",   
			  "params" => array(

			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Number",'ova-crs'),
			       "param_name" => "number"
			    ),
			    array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Title",'ova-crs'),
			       "param_name" => "title"
			    ),
			    
			    array(
			       "type" => "textarea_html",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Description",'ova-crs'),
			       "param_name" => "content"
			    ),
			    array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Link Title",'ova-crs'),
			       "param_name" => "link"
			    ),
			    
			    
			    array(
			       "type" => "dropdown",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Target link",'ova-crs'),
			       "param_name" => "target",
			       "value" => array(
			       	esc_html__( "Same Window", 'ova-crs' ) => "_self",
			       	esc_html__( "New Window", 'ova-crs' ) => "_blank"
			       ),
			       "default" => "_self"
			    ),
			  	array(
			       "type" => "textfield",
			       "holder" => "div",
			       "class" => "",
			       "heading" => esc_html__("Class",'ova-crs'),
			       "param_name" => "class"
			       
			    )
			  )
		));

		




		vc_map( array(
			 "name" => esc_html__("Testimonial", 'ova-crs'),
			 "base" => "ovacrs_testimonial",
			 "class" => "",
			 "category" => esc_html__("IRECA", 'ova-crs'),
			 "icon" => "icon-qk",
			 "as_parent" => array('only' => 'ovacrs_testimonial_item'), 
		    "content_element" => true,
		    "js_view" => 'VcColumnView',
		    "show_settings_on_create" => true,

			 "params" => array(
			 	
			 		
			 		array(
				       "type" => "textfield",
				       "holder" => "div",
				       "class" => "",
				       "heading" => esc_html__("Count item each slide",'ova-crs'),
				       "param_name" => "count",
				       "value" => "2",
				      
				    ),
			 		array(
				       "type" => "dropdown",
				       "holder" => "div",
				       "class" => "",
				       "heading" => __("Auto slider",'ova-crs'),
				       "param_name" => "auto_slider",
				       "value" => array(
				       		__('True', 'ova-crs') => "true",
				       		__('False', 'ova-crs') => "false",
				       	),
				       "default"	=> "true"
				    ),
				    array(
				       "type" => "textfield",
				       "holder" => "div",
				       "class" => "",
				       "heading" => __("Duration of slider(ms). 1000ms = 1s",'ova-crs'),
				       "param_name" => "duration",
				       "value"	=> '3000'
				    ),
				    array(
				       "type" => "dropdown",
				       "holder" => "div",
				       "class" => "",
				       "heading" => __("Pagination",'ova-crs'),
				       "param_name" => "pagination",
				       "value" => array(
				       		__('True', 'ova-crs') => "true",
				       		__('False', 'ova-crs') => "false",
				       	),
				       "default"	=> "true"
				    ),
				    array(
				       "type" => "dropdown",
				       "holder" => "div",
				       "class" => "",
				       "heading" => __("Loop",'ova-crs'),
				       "param_name" => "loop",
				       "value" => array(
				       		esc_html__('True', 'ova-crs') => "true",
				       		esc_html__('False', 'ova-crs') => "false",
				       	),
				       "default"	=> "true"
				    ),
				  	array(
				       "type" => "textfield",
				       "holder" => "div",
				       "class" => "",
				       "heading" => esc_html__("Class",'ova-crs'),
				       "param_name" => "class",
				       "value" => "",
				       "description" => esc_html__("Insert class to use for your style",'ova-crs')
				    )

			 
		)));


		vc_map( array(
			 "name" => esc_html__("Testimonial Item", 'ova-crs'),
			 "base" => "ovacrs_testimonial_item",
			 "class" => "",
			 "category" => esc_html__("IRECA", 'ova-crs'),
			 "icon" => "icon-qk",
			 "as_child" => array('only' => 'ovacrs_testimonial'),
		     "content_element" => true,
			 "params" => array(
			 	
			 		
				    
					array(
				       "type" => "attach_image",
				       "holder" => "div",
				       "class" => "",
				       "heading" => esc_html__("Image",'ova-crs'),
				       "param_name" => "image"
				    ),
				    array(
				       "type" => "textfield",
				       "holder" => "div",
				       "class" => "",
				       "heading" => esc_html__("name",'ova-crs'),
				       "param_name" => "name"
				    ),
				    array(
				       "type" => "textfield",
				       "holder" => "div",
				       "class" => "",
				       "heading" => esc_html__("job",'ova-crs'),
				       "param_name" => "job"
				    ),
				    array(
				       "type" => "textarea",
				       "holder" => "div",
				       "class" => "",
				       "heading" => esc_html__("Description",'ova-crs'),
				       "param_name" => "desc"
				    ),
				    
				  	array(
				       "type" => "textfield",
				       "holder" => "div",
				       "class" => "",
				       "heading" => esc_html__("Class",'ova-crs'),
				       "param_name" => "class",
				       "value" => "",
				       "description" => esc_html__("Insert class to use for your style",'ova-crs')
				    )

			 
		)));

		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
		    class WPBakeryShortCode_ovacrs_testimonial extends WPBakeryShortCodesContainer {
		    }
		}
		if ( class_exists( 'WPBakeryShortCode' ) ) {
		    class WPBakeryShortCode_ovacrs_testimonial_item extends WPBakeryShortCode {
		    }
		}
		



		vc_map( array(
			 "name" => esc_html__("Thumbnail Info", 'ova-crs'),
			 "base" => "ovacrs_thumbnail_info",
			 "class" => "",
			 "category" => esc_html__("IRECA", 'ova-crs'),
			 "icon" => "icon-qk",
			 "params" => array(
			 	
			 		
				    
					array(
				       "type" => "attach_image",
				       "holder" => "div",
				       "class" => "",
				       "heading" => esc_html__("Image",'ova-crs'),
				       "param_name" => "image"
				    ),
				    array(
				       "type" => "textfield",
				       "holder" => "div",
				       "class" => "",
				       "heading" => esc_html__("Title",'ova-crs'),
				       "param_name" => "title"
				    ),
				    array(
				       "type" => "textarea_html",
				       "holder" => "div",
				       "class" => "",
				       "heading" => esc_html__("Description",'ova-crs'),
				       "param_name" => "content"
				    ),
				     array(
				       "type" => "textfield",
				       "holder" => "div",
				       "class" => "",
				       "heading" => esc_html__("Icon font",'ova-crs'),
				       "param_name" => "icon"
				    ),
				     array(
				       "type" => "textfield",
				       "holder" => "div",
				       "class" => "",
				       "heading" => esc_html__("Link",'ova-crs'),
				       "param_name" => "link"
				    ),

				    

				    array(
				       "type" => "dropdown",
				       "holder" => "div",
				       "class" => "",
				       "heading" => __("Target",'ova-crs'),
				       "param_name" => "target",
				       "value" => array(
				       		esc_html__('Same Window', 'ova-crs') => "_self",
				       		esc_html__('New Window', 'ova-crs') => "_blank",
				       	),
				       "default"	=> "_self"
				    ),
				  	array(
				       "type" => "textfield",
				       "holder" => "div",
				       "class" => "",
				       "heading" => esc_html__("Class",'ova-crs'),
				       "param_name" => "class",
				       "value" => "",
				       "description" => esc_html__("Insert class to use for your style",'ova-crs')
				    )
		)));
		
			


}} 