<div class="ovacrs_other_features">
	<table class="widefat">

		<thead>
			<tr>
				<th><?php esc_html_e( 'Name', 'ova-crs' ); ?></th>
			</tr>
		</thead>

		<tbody class="wrap_rt_features">
			<!-- Append html here -->
			<?php if( $ovacrs_other_features_name = get_post_meta( $post_id, 'ovacrs_other_features_name', 'false' ) ){

					for( $i = 0 ; $i < count( $ovacrs_other_features_name ); $i++ ) {
			?>

				<tr class="tr_rt_other_feature">

				    <td width="90%">
				      <input type="text" name="ovacrs_other_features_name[]" placeholder="<?php esc_html_e( 'Name', 'ova-crs' ); ?>" value="<?php echo $ovacrs_other_features_name[$i]; ?>" />
				    </td>

				    <td width="10%"><a href="#" class="delete_other_feature">x</a></td>
				    
				</tr>

			<?php } } ?>
		</tbody>

		<tfoot>
			<tr>
				<th colspan="6">
					<a href="#" class="button insert_rt_other_feature" data-row="
						<?php
							ob_start();
							include( OVACRS_PLUGIN_PATH.'/templates/ovacrs_other_feature_field.php' );
							echo esc_attr( ob_get_clean() );
						?>

					">
					<?php esc_html_e( 'Add Other Feature', 'ova-crs' ); ?></a>
					</a>

					
				</th>
			</tr>
		</tfoot>

	</table>
</div>


