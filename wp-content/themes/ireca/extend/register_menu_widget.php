<?php
/* Register Menu */
add_action( 'init', 'ireca_register_menus' );
function ireca_register_menus() {
  register_nav_menus( array(
    'primary'   => esc_html__( 'Primary Menu', 'ireca' )

  ) );
}





/* Register Widget */
add_action( 'widgets_init', 'ireca_second_widgets_init' );
function ireca_second_widgets_init() {
  
  $args_blog = array(
    'name' => esc_html__( 'Main Sidebar', 'ireca'),
    'id' => "main-sidebar",
    'description' => esc_html__( 'Main Sidebar', 'ireca' ),
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="widget-title">',
    'after_title' => "</h4>",
  );
  register_sidebar( $args_blog );

  $footer_copyright = array(
    'name' => esc_html__( 'Footer copyright', 'ireca'),
    'id' => "footer_copyright",
    'class' => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => "</div>",
    'before_title' => '<h4 class="footer-widget-title">',
    'after_title' => "</h4>",
  );
  register_sidebar( $footer_copyright );

  

  

}

