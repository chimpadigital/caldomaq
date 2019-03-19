<?php

function ireca_open_layout($special_layout){
	

	// Open layout
	$main_layout = ireca_get_current_main_layout();
	$width_main_content = ($main_layout == 'no_sidebar' ) ? 'col-md-12' : ireca_width_main_content($special_layout);

	?>
		<?php if( $main_layout != 'fullwidth' ){ ?>

			<section class="ova-page-section">
			    <div class="container">
			        <div class="row">
			            <div class=" <?php echo esc_attr($width_main_content); ?>" >
			            
		<?php } ?>
	<?php 

}

add_action( 'ireca_open_layout', 'ireca_open_layout', 10, 1);



