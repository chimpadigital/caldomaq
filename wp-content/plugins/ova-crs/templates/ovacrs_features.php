<div class="ovacrs_features">
	<table class="widefat">

		<thead>
			<tr>
				<th><?php esc_html_e( 'Icon Class', 'ova-crs' ); ?></th>
				<th><?php esc_html_e( 'Label', 'ova-crs' ); ?></th>
				<th><?php esc_html_e( 'Description', 'ova-crs' ); ?></th>
				<th><?php esc_html_e( 'Special Feature', 'ova-crs' ); ?></th>
			</tr>
		</thead>

		<tbody class="wrap_rt_features">
			<!-- Append html here -->
			<?php if( $ovacrs_features_desc = get_post_meta( $post_id, 'ovacrs_features_desc', 'false' ) ){
					$ovacrs_features_label = get_post_meta( $post_id, 'ovacrs_features_label', 'false' );
					$ovacrs_features_icons = get_post_meta( $post_id, 'ovacrs_features_icons', 'false' );
					$ovacrs_features_special = get_post_meta( $post_id, 'ovacrs_features_special', 'false' );

					for( $i = 0 ; $i < count( $ovacrs_features_desc ); $i++ ) {
			?>

				<tr class="tr_rt_feature">

				    <td width="20%">
				      <input type="text" name="ovacrs_features_icons[]" placeholder="<?php esc_html_e( 'Font-Awesome', 'ova-crs' ); ?>" value="<?php echo $ovacrs_features_icons[$i]; ?>" />
				    </td>

				    <td width="20%">
				      <input type="text" name="ovacrs_features_label[]" placeholder="<?php esc_html_e( 'Label', 'ova-crs' ); ?>" value="<?php echo $ovacrs_features_label[$i]; ?>" />
				    </td>

				    <td width="29%">
				      <input type="text" name="ovacrs_features_desc[]" placeholder="<?php esc_html_e( 'Description', 'ova-crs' ); ?>" value="<?php echo $ovacrs_features_desc[$i]; ?>" />
				    </td>

				    <td width="20%">
				      <select  name="ovacrs_features_special[]" class="short_dura">
				    		<option value="yes" <?php echo $ovacrs_features_special[$i] == 'yes' ? 'selected': ''; ?> ><?php esc_html_e( 'Yes', 'ova-crs' ); ?></option>
				    		<option value="no" <?php echo $ovacrs_features_special[$i] == 'no' ? 'selected': ''; ?> ><?php esc_html_e( 'No', 'ova-crs' ); ?></option>
				    	</select>
				    </td>

				    <td width="1%"><a href="#" class="delete_feature">x</a></td>
				    
				</tr>

			<?php } } ?>
		</tbody>

		<tfoot>
			<tr>
				<th colspan="6">
					<a href="#" class="button insert_rt_feature" data-row="
						<?php
							ob_start();
							include( OVACRS_PLUGIN_PATH.'/templates/ovacrs_feature_field.php' );
							echo esc_attr( ob_get_clean() );
						?>

					">
					<?php esc_html_e( 'Add Feature', 'ova-crs' ); ?></a>
					</a>

					
				</th>
			</tr>
		</tfoot>

	</table>
</div>


