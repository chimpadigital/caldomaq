<?php

// Register and load the widget
function ireca_load_widget() {
    register_widget( 'ireca_search_widget' );
}
add_action( 'widgets_init', 'ireca_load_widget' );
 
// Creating the widget 
class ireca_search_widget extends WP_Widget {
 
function __construct() {
parent::__construct(
 
// Base ID of your widget
'ireca_search_widget', 
 
// Widget name will appear in UI
__('Ireca Search', 'ireca'), 
 
// Widget description
array( 'description' => __( 'Ireca Simple Search Widget ', 'ireca' ), ) 
);
}
 
// Creating widget front-end
 
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
 
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];
 
// This is where you run the code and display the output
echo '<form role="search" method="get" class="search-form" action="'.home_url('/').'">
		
		<input type="search" class="search-field" placeholder="Search …" value="" name="s" >
		
		<button type="submit" class="search-submit"><i class="icon_search"></i></button>
	</form>';

echo $args['after_widget'];
}
         
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'Search', 'ireca' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
     
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class ireca_search_widget ends here