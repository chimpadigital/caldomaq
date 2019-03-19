<tr class="row_rt_record" data-pos="">

    <td width="15%">
        <input type="text"  placeholder="<?php esc_html_e('Price/Day', 'ova-crs'); ?>" name="ovacrs_rt_price[]" value="" class="ovacrs_rt_price"/>
    </td>

    <td width="15%">
        <input type="text"  placeholder="<?php esc_html_e('Price/Hour', 'ova-crs'); ?>" name="ovacrs_rt_price_hour[]" value="" class="ovacrs_rt_price_hour"/>
    </td>

    <td width="20%">
      <input type="text" name="ovacrs_rt_startdate[]" value="" class="ovacrs_rt_startdate datetimepicker" placeholder="<?php esc_html_e( 'From YYYY-MM-DD ...', 'ova-crs' ); ?>" autocomplete="off"/>
    </td>

    <td width="20%">
      <input type="text" name="ovacrs_rt_enddate[]" value="" class="ovacrs_rt_enddate datetimepicker" placeholder="<?php esc_html_e( 'End YYYY-MM-DD ...', 'ova-crs' ); ?>" autocomplete="off"/>
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