<table class="wrap_rt_discount">
	<tbody>
		<tr class="tr_rt_discount">
									
		    <td width="11%">
		        <input type="text" class="ovacrs_rt_discount_price input_per_100" placeholder="<?php esc_html_e('Price', 'ova-crs'); ?>"
		               name="ovacrs_rt_discount[ovacrs_key][price][]" value="" />
		    </td>

		    <td width="26%">
			    
			      <input type="text" class="input_text short ovacrs_rt_discount_duration" placeholder="<?php esc_html_e('Insert number', 'ova-crs'); ?>"
			             name="ovacrs_rt_discount[ovacrs_key][duration][]" value=""/>


			      <select class="short ovacrs_rt_discount_duration_type" name="ovacrs_rt_discount[ovacrs_key][duration_type][]">
			          <option value="hours"><?php esc_html_e('Hour(s)', 'ova-crs'); ?></option>
			          <option value="days"><?php esc_html_e('Day(s)', 'ova-crs'); ?></option>
			      </select>
			    
		    </td>
		    <td width="1%"><a href="#" class="delete_discount">x</a></td>
		    
		</tr>
	</tbody>
</table>
