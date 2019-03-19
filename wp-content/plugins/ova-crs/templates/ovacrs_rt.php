<div class="ovacrs_rt">
	<table class="widefat">

		<thead>
			<tr>
				<th><?php esc_html_e( 'Price/Day ($)', 'ova-crs' ); ?></th>
				<th><?php esc_html_e( 'Price/Hour ($)', 'ova-crs' ); ?></th>
				<th><?php esc_html_e( 'Start Date', 'ova-crs' ); ?></th>
				<th><?php esc_html_e( 'End Date', 'ova-crs' ); ?></th>
				<th><?php esc_html_e( 'Setup Price in Special Time (PST)', 'ova-crs' ); ?></th>
			</tr>
		</thead>

		<tbody class="wrap_rt">
			<!-- Append html here -->
			<?php if( $ovacrs_rt_price = get_post_meta( $post_id, 'ovacrs_rt_price', 'false' ) ){ 
				
				$ovacrs_rt_price_hour = get_post_meta( $post_id, 'ovacrs_rt_price_hour', 'false' );
				$ovacrs_rt_startdate = get_post_meta( $post_id, 'ovacrs_rt_startdate', 'false' );
				$ovacrs_rt_enddate = get_post_meta( $post_id, 'ovacrs_rt_enddate', 'false' );
				$ovacrs_rt_discount = get_post_meta( $post_id, 'ovacrs_rt_discount', 'false' );



				for( $i = 0 ; $i < count( $ovacrs_rt_price ); $i++ ) {
					
			?>

				<tr class="row_rt_record" data-pos="<?php echo esc_attr($i); ?>">

				    <td width="15%">
				        <input type="text" placeholder="<?php esc_html_e('Price/Day', 'ova-crs'); ?>" name="ovacrs_rt_price[]" value="<?php echo esc_attr($ovacrs_rt_price[$i]); ?>" class="ovacrs_rt_price" >
				    </td>

				    <td width="15%">
				        <input type="text"  placeholder="<?php esc_html_e('Price/Hour', 'ova-crs'); ?>" value="<?php echo esc_attr($ovacrs_rt_price_hour[$i]); ?>" name="ovacrs_rt_price_hour[]"  class="ovacrs_rt_price_hour"/>
				    </td>

				    <td width="20%">
				      <input type="text" name="ovacrs_rt_startdate[]" placeholder="<?php esc_html_e( 'From YYYY-MM-DD ...', 'ova-crs' ); ?>" value="<?php echo esc_attr($ovacrs_rt_startdate[$i]); ?>" class="ovacrs_rt_startdate datetimepicker" autocomplete="off">
				    </td>

				    <td width="20%">
				      <input type="text" name="ovacrs_rt_enddate[]" placeholder="<?php esc_html_e( 'End YYYY-MM-DD ...', 'ova-crs' ); ?>" value="<?php echo esc_attr($ovacrs_rt_enddate[$i]); ?>" class="ovacrs_rt_enddate datetimepicker" autocomplete="off">
				    </td>


				    <td width="39%">
				    	<table width="100%" class="ovacrs_rt_discount">

					      	<thead>
								<tr>
									<th><?php esc_html_e( 'Price ($)', 'ova-crs' ); ?></th>
									<th><?php esc_html_e( 'Duration', 'ova-crs' ); ?></th>
								</tr>
							</thead>

							<tbody class="real">

								<?php if( isset( $ovacrs_rt_discount[$i]['price'] ) ){ ?>
								<?php for( $k = 0; $k < count( $ovacrs_rt_discount[$i]['price'] ); $k++ ){ ?>
									<tr class="tr_rt_discount">
																
										<td width="11%">
										    <input type="text" class="ovacrs_rt_discount_price input_per_100" placeholder="<?php esc_html_e('Price', 'ova-crs') ?>" 
										    	name="ovacrs_rt_discount[<?php echo $i;?>][price][]" value="<?php echo esc_attr( $ovacrs_rt_discount[$i]['price'][$k] ); ?>" />
										</td>

										<td width="26%">
										    
										      <input type="text" class="input_text short ovacrs_rt_discount_duration" placeholder="Insert number" name="ovacrs_rt_discount[<?php echo $i; ?>][duration][]" value="<?php echo esc_attr( $ovacrs_rt_discount[$i]['duration'][$k] ); ?>" />

										      <?php $ovacrs_rt_discount_duration_type =  $ovacrs_rt_discount[$i]['duration_type'][$k]; ?>
										      <select class="short ovacrs_rt_discount_duration_type" name="ovacrs_rt_discount[<?php echo $i; ?>][duration_type][]">
										          <option value="hours" <?php echo $ovacrs_rt_discount_duration_type == 'hours' ? 'selected': ''; ?> >Hour(s)</option>
										          <option value="days" <?php echo $ovacrs_rt_discount_duration_type == 'days' ? 'selected': ''; ?> >Day(s)</option>
										      </select>
										    
										</td>
									<td width="1%"><a href="#" class="delete_discount">x</a></td>

									</tr> 
									
								<?php } }?>
							
								
							</tbody>

							<tfoot>
									<tr>
										<th colspan="6">
											<a href="#" class="button insert_rt_discount">
												<?php esc_html_e( 'Add PST', 'ova-crs' ); ?>
												<?php include( OVACRS_PLUGIN_PATH.'/templates/ovacrs_rt_discount.php' ); ?>
											</a>
										</th>
									</tr>
								
								
							</tfoot>

				      	
				      	</table>
				    </td>


				    <td width="1%"><a href="#" class="delete_rt">x</a></td>
				</tr>
			<?php } } ?>
		</tbody>

		<tfoot>
			<tr>
				<th colspan="6">
					<a href="#" class="button insert_rt_record" data-row="
						<?php
							ob_start();
							include( OVACRS_PLUGIN_PATH.'/templates/ovacrs_rt_record.php' );
							echo esc_attr( ob_get_clean() );
						?>

					">
					<?php esc_html_e( 'Add ST', 'ova-crs' ); ?></a>
					</a>

					
				</th>
			</tr>
		</tfoot>

	</table>
</div>


