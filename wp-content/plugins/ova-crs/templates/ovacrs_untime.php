<div class="ovacrs_rt_untime">
	<table class="widefat">

		<thead>
			<tr>
				<th><?php esc_html_e( 'Start Date', 'ova-crs' ); ?></th>
				<th><?php esc_html_e( 'End Date', 'ova-crs' ); ?></th>
			</tr>
		</thead>

		<tbody class="wrap_rt_untime">
			<!-- Append html here -->
			<?php if( $ovacrs_untime_startdate = get_post_meta( $post_id, 'ovacrs_untime_startdate', 'false' ) ){ 
					$ovacrs_untime_enddate = get_post_meta( $post_id, 'ovacrs_untime_enddate', 'false' );

					for( $i = 0 ; $i < count( $ovacrs_untime_startdate ); $i++ ) {
			?>

				<tr class="tr_rt_untime">

				    <td width="20%">
				      <input type="text" name="ovacrs_untime_startdate[]" placeholder="<?php esc_html_e( 'From YYYY-MM-DD ...', 'ova-crs' ); ?>" value="<?php echo $ovacrs_untime_startdate[$i]; ?>" class="ovacrs_untime_startdate datetimepicker" autocomplete="off"/>
				    </td>

				    <td width="20%">
				      <input type="text" name="ovacrs_untime_enddate[]" placeholder="<?php esc_html_e( 'End YYYY-MM-DD ...', 'ova-crs' ); ?>" value="<?php echo $ovacrs_untime_enddate[$i]; ?>" class="ovacrs_untime_enddate datetimepicker" autocomplete="off"/>
				    </td>

				    <td width="1%"><a href="#" class="delete_untime">x</a></td>
				    
				</tr>

			<?php } } ?>
		</tbody>

		<tfoot>
			<tr>
				<th colspan="6">
					<a href="#" class="button insert_rt_untime" data-row="
						<?php
							ob_start();
							include( OVACRS_PLUGIN_PATH.'/templates/ovacrs_untime_field.php' );
							echo esc_attr( ob_get_clean() );
						?>

					">
					<?php esc_html_e( 'Add UT', 'ova-crs' ); ?></a>
					</a>

					
				</th>
			</tr>
		</tfoot>

	</table>
</div>


