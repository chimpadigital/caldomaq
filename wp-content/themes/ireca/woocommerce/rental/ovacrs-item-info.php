<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product; 

$post_id = get_the_id();
$price_type = get_post_meta( $post_id, 'ovacrs_price_type', true );

?>
<div class="ova-crs">

	<div class="price_dis">

		<?php if( get_theme_mod( 'rd_show_table_price', 'true' ) == 'true' ){ ?>

			<!-- Hourly Rent -->
			<?php if( $price_type == 'hour' || $price_type == 'mixed' ){ ?>
				<div class="ovacrs_price_rent ovacrs_hourly_rent">

					
					<a class="nav collapsed" data-toggle="collapse" href="#collapseHour" role="button" aria-expanded="false" aria-controls="collapseHour">
	    				<?php esc_html_e( 'Table Price by Hour', 'ireca' ); ?>
	  				</a>

					<!-- Regular Price Hour -->
					<div class="collapse collapse_content" id="collapseHour">

						<div class="price">
							<label><?php esc_html_e( 'Regular Price / Hour: ', 'ireca' ); ?></label>
							<?php echo wc_price( get_post_meta( $post_id, 'ovacrs_regul_price_hour', true ) ); ?>
						</div>
						
						<!-- Global Discount -->
						<?php 
							$ovacrs_global_discount_duration_type = get_post_meta( $post_id, 'ovacrs_global_discount_duration_type', true );
							$ovacrs_global_discount_duration_val = get_post_meta( $post_id, 'ovacrs_global_discount_duration_val', true );
							if( $ovacrs_global_discount_duration_val ) asort( $ovacrs_global_discount_duration_val );
							$ovacrs_global_discount_price = get_post_meta( $post_id, 'ovacrs_global_discount_price', true );
						 ?>

						<?php if( !empty( $ovacrs_global_discount_duration_val ) ){ ?>
							<div class="price_table">
								<label><?php esc_html_e( 'Global Discount', 'ireca' ); ?></label>
								<table>
									<thead>
										<tr>
											<th><?php esc_html_e( 'Duration (Hour)', 'ireca' ); ?></th>
											<th><?php esc_html_e( 'Price', 'ireca' ); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php $h = 0;
											foreach ($ovacrs_global_discount_duration_val as $key => $value) {
												if( $ovacrs_global_discount_duration_type[$key] == 'hours' ){ ?>
													<tr class="<?php echo intval($h%2) ? 'eve' : 'odd'; $h++; ?>">
														<td class="bold" data-title="<?php esc_html_e( 'Duration (Hour)', 'ireca' ); ?>"><?php echo esc_html( $ovacrs_global_discount_duration_val[$key] ); ?></td>
														<td data-title="<?php esc_html_e( 'Price', 'ireca' ); ?>"><?php echo wc_price( $ovacrs_global_discount_price[$key] ); ?></td>
													</tr>			
												<?php }
											}
										?>
									</tbody>
								</table>
							</div>
						<?php } ?>

						<!-- Special Time with Price -->
						<?php 
							$ovacrs_rt_startdate = get_post_meta( $post_id, 'ovacrs_rt_startdate', true ); 
							$ovacrs_rt_enddate = get_post_meta( $post_id, 'ovacrs_rt_enddate', true );
							$ovacrs_rt_price_hour = get_post_meta( $post_id, 'ovacrs_rt_price_hour', true );
							$ovacrs_rt_discount = get_post_meta( $post_id, 'ovacrs_rt_discount', true );

						?>
						<?php if( !empty( $ovacrs_rt_price_hour ) ){ ?>
							<div class="price_table">
								<label><?php esc_html_e( 'Special Time with Price', 'ireca' ); ?></label>
								<table>
									<thead>
										<tr>
											<th><?php esc_html_e( 'Start Date', 'ireca' ); ?></th>
											<th><?php esc_html_e( 'End Date', 'ireca' ); ?></th>
											<th><?php esc_html_e( 'Price (Hour)', 'ireca' ); ?></th>
											<th><?php esc_html_e( 'Special Discount', 'ireca' ); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php $s = 0; foreach ($ovacrs_rt_price_hour as $key => $value) {
											if($ovacrs_rt_price_hour[$key] ) { ?>
												<tr class="<?php echo intval($s%2) ? 'eve' : 'odd'; $s++; ?>">
													<td class="bold" data-title="<?php esc_html_e( 'Start Date', 'ireca' ); ?>"><?php echo date_i18n( $ovacrs_rt_startdate[$key] ); ?></td>
													<td class="bold" data-title="<?php esc_html_e( 'End Date', 'ireca' ); ?>"><?php echo date_i18n( $ovacrs_rt_enddate[$key] ); ?></td>
													<td data-title="<?php esc_html_e( 'Price (Hour)', 'ireca' ); ?>"><?php echo wc_price( $ovacrs_rt_price_hour[$key] ); ?></td>
													<td data-title="<?php esc_html_e( 'Special Discount', 'ireca' ); ?>">
														<a href="#" data-popup-open="popup-ovacrs-rt-discount-<?php echo esc_attr( $key ); ?>">
															<?php esc_html_e( 'View Discount', 'ireca' ); ?>
															<div class="ovacrs_rt_discount popup" data-popup="popup-ovacrs-rt-discount-<?php echo esc_attr( $key ); ?>">
																<div class="popup-inner">

																	<div class="price_table">

																		<div class="time_discount">
																			<span><?php esc_html_e( 'Time Discount: ', 'ireca' ); ?></span>
																			<span class="time"><?php echo date_i18n( $ovacrs_rt_startdate[$key] ); ?> - <?php echo date_i18n( $ovacrs_rt_enddate[$key] ); ?></span>
																		</div>
																		<?php $ovacrs_rt_discount_price = $ovacrs_rt_discount[$key]['price'];
																			$ovacrs_rt_discount_duration = $ovacrs_rt_discount[$key]['duration'];
																			
																			$ovacrs_rt_discount_duration_type = $ovacrs_rt_discount[$key]['duration_type']; ?>
																		<?php if( $ovacrs_rt_discount_duration ){ ?>	
																		<?php asort($ovacrs_rt_discount_duration); ?>
																		<table>
																			<thead>
																				<tr>
																					<th><?php esc_html_e( 'Duration (Hour)', 'ireca' ); ?></th>
																					<th><?php esc_html_e( 'Price', 'ireca' ); ?></th>
																				</tr>
																			</thead>

																			<tbody>
																				<?php $n = 0;
																					foreach ($ovacrs_rt_discount_duration as $k => $v) {
																						if( $ovacrs_rt_discount_duration_type[$k] == 'hours' ){ ?>
																							<tr class="<?php echo intval($n%2) ? 'eve' : 'odd'; $n++; ?>">
																								<td data-title="<?php esc_html_e( 'Duration (Hour)', 'ireca' ); ?>"><?php echo esc_html( $ovacrs_rt_discount_duration[$k] ); ?></td>
																								<td data-title="<?php esc_html_e( 'Price', 'ireca' ); ?>"><?php echo wc_price( $ovacrs_rt_discount_price[$k] ); ?></td>
																							</tr>
																						<?php }
																					} ?>
																			</tbody>
																		</table>
																		<?php }else{ ?>
																			<div class="no_discount">
																				<?php esc_html_e( 'No Discount in this time', 'ireca' ); ?>
																			</div>
																		<?php } ?>

																	</div>

																	<div  class="close_discount"><a data-popup-close="popup-ovacrs-rt-discount-<?php echo esc_attr( $key ); ?>" href="#"><?php esc_html_e( 'Close', 'ireca' ); ?></a></div>
																	<a class="popup-close" data-popup-close="popup-ovacrs-rt-discount-<?php echo esc_attr( $key ); ?>" href="#">x</a>
																</div>
															</div>
														</a>
													</td>
												</tr>			
										<?php } } ?>
									</tbody>
								</table>
							</div>
						<?php } ?>
					</div>
					

				</div>
			<?php } ?>

			<!-- Daily Rent -->
			<?php if( $price_type == 'day' || $price_type == 'mixed' ){ ?>
				<div class="ovacrs_price_rent ovacrs_daily_rent">

					
					<a class="nav collapsed" data-toggle="collapse" href="#collapseDay" role="button" aria-expanded="false" aria-controls="collapseDay">
	    				<?php esc_html_e( 'Table Price by Day', 'ireca' ); ?>
	  				</a>

					<!-- Regular Price Hour -->
					<div class="collapse collapse_content" id="collapseDay">

						<div class="price">
							<label><?php esc_html_e( 'Regular Price / Day: ', 'ireca' ); ?></label>
							<?php echo wp_kses_post( $product->get_price_html() ); ?>
						</div>
						
						<!-- Global Discount -->
						<?php 
							$ovacrs_global_discount_duration_type = get_post_meta( $post_id, 'ovacrs_global_discount_duration_type', true );
							$ovacrs_global_discount_duration_val = get_post_meta( $post_id, 'ovacrs_global_discount_duration_val', true );
							if( $ovacrs_global_discount_duration_val ) asort( $ovacrs_global_discount_duration_val );
							$ovacrs_global_discount_price = get_post_meta( $post_id, 'ovacrs_global_discount_price', true );
						 ?>
						<?php if( !empty( $ovacrs_global_discount_duration_val ) ){ ?>
							<div class="price_table">
								
								<label><?php esc_html_e( 'Global Discount', 'ireca' ); ?></label>
								<table>
									<thead>
										<tr>
											<th><?php esc_html_e( 'Duration (Day)', 'ireca' ); ?></th>
											<th><?php esc_html_e( 'Price', 'ireca' ); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$k = 0;
											foreach ($ovacrs_global_discount_duration_val as $key => $value) {
												if( $ovacrs_global_discount_duration_type[$key] == 'days' ){ ?>
													<tr class="<?php echo intval($k%2) ? 'eve' : 'odd'; $k++; ?>">
														<td class="bold" data-title="<?php esc_html_e( 'Duration (Day)', 'ireca' ); ?>"><?php echo esc_html( $ovacrs_global_discount_duration_val[$key] ); ?></td>
														<td data-title="<?php esc_html_e( 'Price', 'ireca' ); ?>"><?php echo wc_price( $ovacrs_global_discount_price[$key] ); ?></td>
													</tr>			
												<?php }
											}
										?>
									</tbody>
								</table>

							</div>
						<?php } ?>

						<!-- Special Time with Price -->
						<?php 
							$ovacrs_rt_startdate = get_post_meta( $post_id, 'ovacrs_rt_startdate', true ); 
							$ovacrs_rt_enddate = get_post_meta( $post_id, 'ovacrs_rt_enddate', true );
							$ovacrs_rt_price = get_post_meta( $post_id, 'ovacrs_rt_price', true );
							$ovacrs_rt_discount = get_post_meta( $post_id, 'ovacrs_rt_discount', true );

						?>
						<?php if( !empty( $ovacrs_rt_price ) ){ ?>
							<div class="price_table">
								
								<label><?php esc_html_e( 'Special Time with Price', 'ireca' ); ?></label>
								<table>
									<thead>
										<tr>
											<th><?php esc_html_e( 'Start Date', 'ireca' ); ?></th>
											<th><?php esc_html_e( 'End Date', 'ireca' ); ?></th>
											<th><?php esc_html_e( 'Price (Day)', 'ireca' ); ?></th>
											<th><?php esc_html_e( 'Special Discount', 'ireca' ); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php if( $ovacrs_rt_price ){
												$d = 0;
												foreach ($ovacrs_rt_price as $key => $value) {
													if($ovacrs_rt_price[$key] ) { ?>
														<tr class="<?php echo intval($d%2) ? 'eve' : 'odd'; $d++; ?>">
															<td class="bold"  data-title="<?php esc_html_e( 'Start Date', 'ireca' ); ?>"><?php echo date_i18n( $ovacrs_rt_startdate[$key] ); ?></td>
															<td class="bold"  data-title="<?php esc_html_e( 'End Date', 'ireca' ); ?>"><?php echo date_i18n( $ovacrs_rt_enddate[$key] ); ?></td>
															<td data-title="<?php esc_html_e( 'Price (Day)', 'ireca' ); ?>"><?php echo wc_price( $ovacrs_rt_price[$key] ); ?></td>
															<td data-title="<?php esc_html_e( 'Special Discount', 'ireca' ); ?>">
																<a href="#" data-popup-open="popup-ovacrs-rt-discount-day-<?php echo esc_attr( $key ); ?>">
																	<?php esc_html_e( 'View Discount', 'ireca' ); ?>
																	<div class="ovacrs_rt_discount popup" data-popup="popup-ovacrs-rt-discount-day-<?php echo esc_attr( $key ); ?>">
																		<div class="popup-inner">

																			<div class="price_table">

																				<div class="time_discount">
																					<span><?php esc_html_e( 'Time Discount: ', 'ireca' ); ?></span>
																					<span class="time"><?php echo date_i18n( $ovacrs_rt_startdate[$key] ); ?> - <?php echo date_i18n( $ovacrs_rt_enddate[$key] ); ?></span>
																				</div>
																				<?php $ovacrs_rt_discount_price = isset( $ovacrs_rt_discount[$key]['price'] ) ? $ovacrs_rt_discount[$key]['price'] : '';
																					$ovacrs_rt_discount_duration = isset( $ovacrs_rt_discount[$key]['duration'] ) ? $ovacrs_rt_discount[$key]['duration'] : '';
																					
																					$ovacrs_rt_discount_duration_type = isset( $ovacrs_rt_discount[$key]['duration_type'] ) ? $ovacrs_rt_discount[$key]['duration_type'] : ''; ?>
																				<?php if( $ovacrs_rt_discount_duration ){ ?>
																					<?php asort($ovacrs_rt_discount_duration); ?>
																					<table>
																						<thead>
																							<tr>
																								<th><?php esc_html_e( 'Duration (Day)', 'ireca' ); ?></th>
																								<th><?php esc_html_e( 'Price ', 'ireca' ); ?></th>
																							</tr>
																						</thead>

																						<tbody>
																							<?php $n = 0;
																								foreach ($ovacrs_rt_discount_duration as $k => $v) {
																									if( $ovacrs_rt_discount_duration_type[$k] == 'days' ){ ?>
																										<tr class="<?php echo intval($n%2) ? 'eve' : 'odd'; $n++; ?>">
																											<td data-title="<?php esc_html_e( 'Duration (Day)', 'ireca' ); ?>"><?php echo esc_html( $ovacrs_rt_discount_duration[$k] ); ?></td>
																											<td data-title="<?php esc_html_e( 'Price', 'ireca' ); ?>"><?php echo wc_price( $ovacrs_rt_discount_price[$k] ); ?></td>
																										</tr>
																									<?php }
																								} ?>
																						</tbody>
																					</table>
																					<?php }else{ ?>
																					<div class="no_discount">
																						<?php esc_html_e( 'No Discount in this time', 'ireca' ); ?>
																					</div>
																					<?php } ?>

																			</div>	

																			<div class="close_discount"><a data-popup-close="popup-ovacrs-rt-discount-day-<?php echo esc_attr( $key ); ?>" href="#"><?php esc_html_e( 'Close', 'ireca' ); ?></a></div>
																			<a class="popup-close" data-popup-close="popup-ovacrs-rt-discount-day-<?php echo esc_attr( $key ); ?>" href="#">x</a>
																		</div>
																	</div>
																</a>
															</td>
														</tr>			
											<?php } } } ?>
									</tbody>
								</table>
							</div>
						<?php } ?>
					</div>
					
					
				</div>
			<?php } ?>

		<?php } ?>


		<!-- Time is not available for renting -->
		<?php if( get_theme_mod( 'rd_show_maintenance', 'true' ) == 'true' ){ ?>
			<?php $ovacrs_untime_startdate = get_post_meta( $post_id, 'ovacrs_untime_startdate', true );
					$ovacrs_untime_enddate = get_post_meta( $post_id, 'ovacrs_untime_enddate', true );
				if( $ovacrs_untime_startdate ){
			?>
			<div class="ovacrs_price_rent ovacrs_vehicle_maintenance">
					
				<a class="nav collapsed" data-toggle="collapse" href="#collapseMain" role="button" aria-expanded="false" aria-controls="collapseMain">
					<?php esc_html_e( 'Vehicle Maintenance', 'ireca' ); ?>
				</a>
				
				<div class="collapse collapse_content" id="collapseMain">
					<div class="ovacrs_price_rent ovacrs_untime_rent">
						<span><?php esc_html_e( 'You cant rent car in this time', 'ireca' ); ?></span>
						
						<ul>
						<?php foreach ($ovacrs_untime_startdate as $key => $value) { ?>
							<li><?php echo esc_html( $ovacrs_untime_startdate[$key] ).' - '.esc_html( $ovacrs_untime_enddate[$key] ); ?></li>						
						<?php } ?>
						</ul>
					</div>
				</div>

			</div>
				
			<?php } ?>
		<?php } ?>


	</div>

		

		

	
	


	
	
</div>

