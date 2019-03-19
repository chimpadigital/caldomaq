<?php 
	$ovacrs_id_vehicles = get_post_meta( $post_id, 'ovacrs_id_vehicles', true );
	$all_id_vehicles = ovacrs_get_all_id_vehicles();
?>

<div style="display: inline-block;">
<br/><strong class="ovacrs_heading_section" style="float: left; margin-right: 20px;"><?php esc_html_e('Choose ID Vehicle', 'ova-crs'); ?></strong>

<?php if( $all_id_vehicles->have_posts() ): ?>
<select multiple name="ovacrs_id_vehicles[]" style="width: 200px; height: 200px; margin-left: 15px;">
	<?php while( $all_id_vehicles->have_posts() ): $all_id_vehicles->the_post(); 

		$id_vehicle = get_post_meta( get_the_id(), 'ireca_met_id_vehicle', true );
		$selected = in_array($id_vehicle, $ovacrs_id_vehicles ) ? 'selected="selected"' : '';
	?>

	<option <?php echo wp_kses($selected, true); ?> value="<?php echo esc_attr( $id_vehicle ); ?>"> <?php the_title(); ?> </option>
	<?php endwhile; ?>
</select>
<?php endif; wp_reset_postdata(); ?>
<br>

</div>