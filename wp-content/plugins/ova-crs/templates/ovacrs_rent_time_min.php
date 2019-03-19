<?php

// Rent Day min
woocommerce_wp_text_input(
  array(
   'id'                => 'ovacrs_rent_day_min',
   'class'             => 'short ',
   'label'             => esc_html__( 'Rent Day Min', 'ova-crs' ),
   'placeholder'       => esc_html__( '1', 'ova-crs' ),
   'desc_tip'    => 'true',
   'type'              => 'text'
));

// Rent Hour min
woocommerce_wp_text_input(
  array(
   'id'                => 'ovacrs_rent_hour_min',
   'class'             => 'short ',
   'label'             => esc_html__( 'Rent Hour Min', 'ova-crs' ),
   'placeholder'       => esc_html__( '1', 'ova-crs' ),
   'desc_tip'    => 'true',
   'type'              => 'text'
));