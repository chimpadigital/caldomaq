<div class="ovacrs_resources">
	<table class="widefat">

		<thead>
			<tr>
				<th><?php esc_html_e( 'Unique ID', 'ova-crs' ); ?></th>
				<th><?php esc_html_e( 'Name', 'ova-crs' ); ?></th>
				<th><?php esc_html_e( 'Price ($)', 'ova-crs' ); ?></th>
				<th><?php esc_html_e( 'Duration', 'ova-crs' ); ?></th>
			</tr>
		</thead>

		<tbody class="wrap_resources">
			<!-- Append html here -->
			<?php if( $ovacrs_resource_name = get_post_meta( $post_id, 'ovacrs_resource_name', 'false' ) ){ 
					
					$ovacrs_resource_price = get_post_meta( $post_id, 'ovacrs_resource_price', 'false' );

					
					$ovacrs_resource_duration_type = get_post_meta( $post_id, 'ovacrs_resource_duration_type', 'false' ) ? get_post_meta( $post_id, 'ovacrs_resource_duration_type', 'false' ) : array();

					$ovacrs_resource_id = get_post_meta( $post_id, 'ovacrs_resource_id', 'false' ) ? get_post_meta( $post_id, 'ovacrs_resource_id', 'false' ) : array();

					for( $i = 0 ; $i < count( $ovacrs_resource_name ); $i++ ) {
			?>

				<tr class="tr_rt_resource">

					<td width="15%">
				      <input type="text"  name="ovacrs_resource_id[]"  value="<?php echo $ovacrs_resource_id[$i]; ?>" placeholder="<?php esc_html_e( 'Not space', 'ova-crs' ); ?> " />
				    </td>

				    <td width="39%">
				      <input type="text" name="ovacrs_resource_name[]"  value="<?php echo $ovacrs_resource_name[$i]; ?>" />
				    </td>

				    <td width="20%">
				      <input type="text"  name="ovacrs_resource_price[]"  value="<?php echo $ovacrs_resource_price[$i]; ?>" />
				    </td>

				    <td width="25%">
				    	
				    	<select  name="ovacrs_resource_duration_type[]" class="short_dura">
				    		<option value="hours" <?php echo $ovacrs_resource_duration_type[$i] == 'hours' ? 'selected': ''; ?> ><?php esc_html_e( '/Hours', 'ova-crs' ); ?></option>
				    		<option value="days" <?php echo $ovacrs_resource_duration_type[$i] == 'days' ? 'selected': ''; ?> ><?php esc_html_e( '/Days', 'ova-crs' ); ?></option>
				    		<option value="total" <?php echo $ovacrs_resource_duration_type[$i] == 'total' ? 'selected': ''; ?> ><?php esc_html_e( '/Total', 'ova-crs' ); ?></option>
				    	</select>
				    </td>

				    <td width="1%"><a href="#" class="delete_resource">x</a></td>
				    
				</tr>

			<?php } } ?>
		</tbody>

		<tfoot>
			<tr>
				<th colspan="6">
					<a href="#" class="button insert_resources" data-row="
						<?php
							ob_start();
							include( OVACRS_PLUGIN_PATH.'/templates/ovacrs_resources_field.php' );
							echo esc_attr( ob_get_clean() );
						?>

					">
					<?php esc_html_e( 'Add Resources', 'ova-crs' ); ?></a>
					</a>

					
				</th>
			</tr>
		</tfoot>

	</table>
</div>


