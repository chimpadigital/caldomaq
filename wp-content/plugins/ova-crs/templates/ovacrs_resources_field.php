<tr class="tr_rt_resource">

    <td width="15%">
      <input type="text" name="ovacrs_resource_id[]" placeholder="<?php esc_html_e( 'Not space', 'ova-crs' ); ?> " value="" />
    </td>

    <td width="39%">
      <input type="text" name="ovacrs_resource_name[]" value="" />
    </td>

  
    <td width="20%">
      <input type="text" name="ovacrs_resource_price[]" value="" />
    </td>

    <td width="25%">
      
      <select  name="ovacrs_resource_duration_type[]" class="short_dura">
          <option value="hours" ><?php esc_html_e( '/Hours', 'ova-crs' ); ?></option>
          <option value="days" ><?php esc_html_e( '/Days', 'ova-crs' ); ?></option>
          <option value="total" ><?php esc_html_e( '/Total', 'ova-crs' ); ?></option>
        </select>
    </td>

    <td width="1%"><a href="#" class="delete_resource">x</a></td>
    
</tr>