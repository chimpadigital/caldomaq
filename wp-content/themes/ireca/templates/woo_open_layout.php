<?php

add_action( 'ireca_woo_open_layout',  'ireca_woo_open_layout' );

function ireca_woo_open_layout( $main_layout = '', $width_main_content = '' ){
// Open layout
$main_layout =  ($main_layout != '' ) ? $main_layout : get_theme_mod('woo_layout','no_sidebar');
if( trim( $width_main_content ) != '' ){
	$width_main_content = $width_main_content;
}else{
	$width_main_content = ($main_layout == 'no_sidebar' ) ? 'ovatheme_woo_nosidebar' : ireca_woo_width_main_content();	
}

?>

	<?php if( $main_layout != 'fullwidth' && $main_layout != 'no_sidebar' ){ ?>
	<section class="ova-page-section">
	    <div class="container">
	    	<div class="row">
	            <div class=" <?php echo esc_attr($width_main_content); ?>" >
	<?php }else{ ?>
		<section class="ova-page-section">
	    <div class="container">
	       	<div class=" <?php echo esc_attr($width_main_content); ?>" >
	<?php } ?>

<?php }