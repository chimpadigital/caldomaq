<div class="ovacrs_global_discount">
	<table class="widefat">

		<thead>
			<tr>
				<th><?php esc_html_e( 'Price ($)', 'ova-crs' ); ?></th>
				<th><?php esc_html_e( 'Duration', 'ova-crs' ); ?></th>
			</tr>
		</thead>

		<tbody>
			<!-- Append html here -->

			<?php if( $ovacrs_global_discount_price = get_post_meta( $post_id, 'ovacrs_global_discount_price', 'false' ) ){

				$ovacrs_global_discount_duration_val = get_post_meta( $post_id, 'ovacrs_global_discount_duration_val', 'false' );
				$ovacrs_global_discount_duration_type = get_post_meta( $post_id, 'ovacrs_global_discount_duration_type', 'false' );

				for( $i =0 ; $i < count( $ovacrs_global_discount_price ); $i++ ) { ?>
					<tr class="row_discount">
							
					    <td width="11%">
					        <input type="text" class="input_text" placeholder="<?php esc_html_e('Price', 'ova-crs'); ?>"
					               name="ovacrs_global_discount_price[]" value="<?php echo $ovacrs_global_discount_price[$i]; ?>"/>
					    </td>

					    <td width="26%">
						    
						      <input type="text" class="input_text short" placeholder="<?php esc_html_e('Insert number', 'ova-crs'); ?>"
						             name="ovacrs_global_discount_duration_val[]" value="<?php echo $ovacrs_global_discount_duration_val[$i]; ?>"/>


						      <select class="short" name="ovacrs_global_discount_duration_type[]">
						          <option value="hours" <?php echo ( $ovacrs_global_discount_duration_type[$i] == 'hours' ) ? 'selected' : ''; ?> ><?php esc_html_e('Hour(s)', 'ova-crs'); ?></option>
						          <option value="days" <?php echo ( $ovacrs_global_discount_duration_type[$i] == 'days' ) ? 'selected' : ''; ?>><?php esc_html_e('Day(s)', 'ova-crs'); ?></option>
						      </select>
						    
					    </td>
					    <td width="1%"><a href="#" class="delete">x</a></td>
					    
					</tr>
				<?php }

			} ?>
		</tbody>

		<tfoot>
			<tr>
				<th colspan="6">
					<a href="#" class="button insert_discount" data-row="<tr class=&quot;row_discount&quot;>
					    <td width=&quot;11%&quot;>
					        <input type=&quot;text&quot; class=&quot;input_text&quot; placeholder=&quot;<?php esc_html_e('Price', 'ova-crs'); ?>&quot;
					               name=&quot;ovacrs_global_discount_price[]&quot; value=&quot;&quot;/>
					    </td>

					    <td width=&quot;26%&quot;>
					    
					      <input type=&quot;text&quot; class=&quot;input_text short&quot; placeholder=&quot;<?php esc_html_e('Insert number', 'ova-crs'); ?>&quot; name=&quot;ovacrs_global_discount_duration_val[]&quot; value=&quot;&quot;/>

					      <select class=&quot;short&quot; name=&quot;ovacrs_global_discount_duration_type[]&quot;>
					          <option value=&quot;hours&quot;><?php esc_html_e('Hour(s)', 'ova-crs'); ?></option>
					          <option value=&quot;days&quot;><?php esc_html_e('Day(s)', 'ova-crs'); ?></option>
					         
					      </select>
					    
					    </td>

					    <td width=&quot;1%&quot;><a href=&quot;#&quot; class=&quot;delete&quot;>x</a></td>

					</tr>


					"><?php esc_html_e( 'Add PD', 'ova-crs' ); ?></a>
				</th>
			</tr>
		</tfoot>

	</table>
</div>