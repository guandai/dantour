<?php
if ( ! is_wp_error( $trip_id ) ) {
				$trip_data = WpTravel_Helpers_Trips::get_trip( $trip_id );
	if ( ! is_wp_error( $trip_data ) && 'WP_TRAVEL_TRIP_INFO' === $trip_data['code'] ) {
		$trip = $trip_data['trip'];
	}
}

if ( function_exists( 'wptravel_get_settings' ) ) {
	$settings = wptravel_get_settings();
} else {
	$settings = wp_travel_get_settings();
}
$primary_color           = isset( $settings['set_trip_itinerary_pdf_primary_color'] ) ? $settings['set_trip_itinerary_pdf_primary_color'] : '#28B951';
$secondary_color         = isset( $settings['set_trip_itinerary_pdf_secondary_color'] ) ? $settings['set_trip_itinerary_pdf_secondary_color'] : '#FF9671';
$downloads_relative_path = isset( $settings['downloads_relative_path'] ) ? $settings['downloads_relative_path'] : 'yes';

$trip_image = get_post_thumbnail_id( $trip_id );

$image_url = '';
if ( $trip_image ) {
	$image     = wp_get_attachment_image_src( $trip_image, 'medium' );
	$image_url = $image[0];
	if ( 'yes' === $downloads_relative_path ) {
		$image_url = get_attached_file( $trip_image );
	}
}
if ( '' === $image_url ) {
	$image_url = wptravel_get_post_placeholder_image_url();
}
?>
<!-- <!DOCTYPE html> -->
<html <?php language_attributes(); ?>>
	<head>
	</head>
	<style>
		.trip-details * {
			font-family: 'Poppins', sans-serif;
		}
		.trip-details {
			/* border-top: 15px solid #fc9e1f; */
			padding: 30px;
			margin-left: -10px;
		}
		.trip-details .trip-heading {
			width: 200px;
			height: 5px !important;
			background: <?php echo esc_attr( $primary_color ); ?>;
			padding-top: 35px;
			margin-left: -35px;
			padding-left: 40px;
			border-radius: 0 20px 20px 0;
		}
		.trip-details .trip-heading h1 {
			font-family: 'Poppins', sans-serif;
			font-size: 20px;
			text-transform: uppercase;
			/* line-height: 22px; */
			line-height: 10px;
			font-weight: bold;
			/* color: #fc9e1f; */
			color: #fff;
			padding: 0 20px;
			padding-bottom: 30px;
			/* border-bottom: 0.5px solid #cccccc; */
		}
		.trip-details .images {
			margin-top: 25px;
			margin-bottom: 25px;
			text-align: center;		
		}
		
		h4 {
			/* font-size: 25px; */
			font-size: 21px;
			font-family: 'Poppins', sans-serif;
			text-transform: uppercase;
			/* Default color xina */
			color: <?php echo esc_attr( $primary_color ); ?>;
			margin-top: 30px;
			border-bottom: 1px solid <?php echo esc_attr( $primary_color ); ?>; 
			padding-bottom: 10px;
		}
		h3 {
			margin-top: 0;
			/* font-size: 25px;
			line-height: 20px; */
			font-size: 21px;
			line-height: 5px;
			font-family: 'Poppins', sans-serif;
			/* color: purple; */
			color: #787878;
			text-transform: capitalize;
			font-weight: bold;
		}

		.trip-details table, .trip-details th, .trip-details td {
			width: 100%;
			border-collapse: collapse;
			vertical-align: top;
		}
		.trip-details .trip-table tr td:nth-child(1) {
			/* width: 30%; */
			width: 25%;
		}

		.trip-details .trip-table tr td:nth-child(1), .title {		
			/* font-size: 25px;
			line-height: 25px; */
			font-size: 20px;
			line-height: 21px;
			font-weight: bold;
			color: #666666;
			/* color: blue; */
			text-transform: capitalize;
			padding-left: 25px;
			padding-top: 28px;
		}
		.trip-details .trip-table tr td:nth-child(2),
		.desc {
			font-weight: 300;
			/* font-size: 23px; */
			font-size: 19px;
			line-height: 28px;
			text-transform: capitalize;
			text-align: justify;
			color: #666666;
			/* color: tomato; */
			/* line-height: 32px; */
			padding-right: 38px;
			margin-bottom: 5px;
		}

		.trip-code {
			/* border: 1px dashed #FC9E1F; */
			border: 1px dashed <?php echo esc_attr( $primary_color ); ?>;
			padding: 15px 20px;
			display: block;
		}
		.trip-details .trip-table tr td{
			padding: 25px 0;
			font-family: 'Poppins', sans-serif;
		}

		.trip-details h5{
			font-size: 16px;
			font-family: 'Poppins', sans-serif;
			color: <?php echo esc_attr( $primary_color ); ?>;
			padding-bottom: 20px;
			border-bottom: 0.5px dashed <?php echo esc_attr( $primary_color ); ?>;
			padding-top: 60px;
			padding-left: 22px;
			padding-right: 22px;
		}
		.trip-details h5.include-title {
			margin-top: -45px !important;
		}
		.trip-details h5.exclude-title {
			padding-top: 0 !important;
			margin-top: 0px;
		}
		.trip-details .trip-table tr td h5.pricing-title {
			color: red !important;
		}
		.trip-details p{
			font-size: 14px;
			line-height: 20px;
			font-family: 'Poppins', sans-serif;
			font-weight: 300;
			color: #666666;
			/* color: skyblue; */
			margin-top: -15px;
			padding-left: 22px;
			padding-right: 22px;
			text-align: justify;
		}
		.trip-table tr:nth-child(6) {
			margin-top: 50px !important;
		}
		/* .trip-details .trip-table tr:nth-child(3) td h5.pricing-title {
			margin-top: -50px !important;
			margin-left: 100px !important;
			padding-left: 500px !important;
			color: red !important;
		} */

		.trip-itineraries h5.itinerary-label {
			padding: 0;
		}

		.trip-itineraries .trip-itinerary {
			padding-left: 22px;
		}

		.trip-itineraries .trip-itinerary .itinerary-content h5 {
			color: #666666;
		}

		.trip-itineraries .trip-itinerary .tc-heading h5, .trip-itineraries .trip-itinerary .tc-content h5 {
			border-bottom: none;
			padding: 0;
			margin: 0;
		}

		.trip-itineraries .trip-itinerary .tc-heading .day-count {
			color: <?php echo esc_attr( $secondary_color ); ?>;
			border-bottom: 0.5px dashed <?php echo esc_attr( $secondary_color ); ?>;
			padding-left: 10px;
		}

		.trip-itineraries .trip-itinerary .tc-heading .itinerary-image {
			padding-top: 25px;
		}

		.trip-itineraries .trip-itinerary .tc-content p {
			padding-left: 0;
		}

		.mini-table {
			margin-top: 35px;
		}
		.mini-table th, .mini-table td {
			border: 1px solid #ddd;
			text-align: center;
		}
		.mini-table tr th {
			font-size: 23px;
			line-height: 24px;
			font-weight: bold;
			color: #fff;
			/* background: #E7AD65; */
			/* background: #555555; */
			background: <?php echo esc_attr( $primary_color ); ?>;
			padding: 25px 0;

		}
		.mini-table tr:nth-child(even) {
			/* background: #f2f2f2; */
			background: rgba(40, 185, 81, 0.10);
		}
		.mini-table tr td {
			/* font-size: 22px !important;
			line-height: 22px !important; */
			font-size: 19px !important;
			line-height: 20px !important;
			font-weight: normal !important;
			color: #666666 !important;
			/* color: brown !important; */
		}
		.mini-table tr td:nth-child(1) {
			padding-left: 0px !important;
			font-weight: normal !important;
		}
		.mini-table tr td:nth-child(2) {
			text-align: center !important;
			padding-right: 0px !important;
		}

		.mini-table tr th.table-data{
			background: transparent !important;
			color: #000 !important;
			font-size: 19px !important;
			font-weight: 300 !important;
		}

		.pricing-title{
			padding-top: 20px !important;
		}
	</style>
	<body>			
		<div class="trip-details">
			<div class="trip-heading">
				<h1><?php esc_html_e( 'Trip Details', 'wp-travel-pro' ); ?></h1>
			</div>
			<div class="images">				
				<img src="<?php echo 'yes' !== $downloads_relative_path ? esc_url( $image_url ) : esc_url( $image_url ); ?>" alt="">
			</div>
				
			<!-- table tag consists upto trip itineraries -->
			<table class="trip-table">
				<tr>
					<td><?php esc_html_e( 'Trip Title : ', 'wp-travel-pro' ); ?></td>
					<td>
						<?php echo esc_html( $trip_data['trip']['title'] ); ?>
					</td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'Trip Code : ', 'wp-travel-pro' ); ?></td>
					<td>
						<div class="trip-code">
							<?php
							echo esc_html( $trip_data['trip']['trip_code'] );
							?>
						</div>
					</td>
				</tr>
				<?php if( $settings['show_trip_price'] === 'yes'  ): ?>
				<tr>
					<td colspan="2">
						<?php esc_html_e( 'Trip Pricing : ', 'wp-travel-pro' ); ?>
						<?php
						$pricings = $trip_data['trip']['pricings'];
						foreach ( $pricings as $pricing ) {
							?>
							<br />
							<br />
							<h5 class="pricing-title"><?php echo esc_html( $pricing['title'] ); ?></h5>

							<?php
							$categories = $pricing['categories'];

							?>
							<table class="mini-table">
								<tr>
									<th><?php echo esc_html( 'Category' ); ?></th>
									<th><?php echo esc_html( 'Price Per' ); ?></th>
									<th><?php echo esc_html( 'Price' ); ?></th>
									<th><?php echo esc_html( 'Person(Min/Max)' ); ?></th>
								</tr>
								<?php
								$i = 1;
								foreach ( $categories as $category ) {
									$extra_class = $i % 2 == 0 ? 'even' : 'odd';
									?>
									<tr>
										<th class="table-data">
											<?php
											if ( ! empty( $category['term_info']['title'] ) ) {
												echo esc_html( $category['term_info']['title'] );
											}
											?>
										</th>
										<th class="table-data">
											<?php
											if ( ! empty( $category['price_per'] ) ) {
												echo esc_html( $category['price_per'] );
											}
											?>
										</th>
										<th class="table-data">
											<?php
											if ( ! empty( $category['regular_price'] ) ) {
												echo ( 'Price: ' . wp_kses_post( wptravel_get_formated_price_currency( $category['regular_price'] ) ) );
												echo '<br><br>';}
											if ( $category['is_sale'] > 0 ) {
												echo ( 'Sale Price: ' . wp_kses_post( wptravel_get_formated_price_currency( $category['sale_price'] ) ) );
												echo '<br><br>';}
											?>
										</th>
										<th class="table-data">
											<?php
											if ( ! empty( $pricing['min_pax'] && $pricing['max_pax'] ) ) {
												echo esc_html( $pricing['min_pax'] . '-' . $pricing['max_pax'] );
												echo '<br><br>';
											}
											?>
										</th>
									</tr>
									<?php
									$i++;
								}

								?>
							</table>

							<?php
						}
						?>
					</td>
					
				</tr>
				<?php endif; ?>
				<tr>
					<?php
					$allowed_trip_details = $settings['show_trip_date'];
					if ( $allowed_trip_details == 'yes' ) {
						if ( isset( $trip_data['trip'] ) && isset( $trip_data['trip']['dates'] ) && ! empty( $trip_data['trip']['dates'][0]['start_date'] && $trip_data['trip']['dates'][0]['end_date'] ) ) {
							?>
							<td><?php esc_html_e( 'Trip Date : ', 'wp-travel-pro' ); ?></td>
							<td>
							<?php
								echo esc_html( 'From ' . $trip_data['trip']['dates'][0]['start_date'] . ' to ' . $trip_data['trip']['dates'][0]['end_date'] );
							?>
							</td>
							<?php
						}
					}
					?>
						
				</tr>	
				<tr>
					<?php
					$allowed_trip_details = $settings['show_trip_outline'];
					if ( $allowed_trip_details === 'yes' ) {
						if ( ! empty( $trip_data['trip']['trip_outline'] ) ) {
							?>
								<td>
									<?php esc_html_e( 'Trip Outline : ', 'wp-travel-pro' ); ?></td>
								
									<td>
										<p>
											<?php echo wp_kses_post( preg_replace('/\[wp_travel_trip_weather_forecast(.*)\]/i', '', $trip_data['trip']['trip_outline']) ); ?>
										</p>
									</td>	
							<?php
						}
					}
					?>
				</tr>
			</table>
			<div class="trip-itineraries">
				<?php
				$allowed_trip_details = $settings['show_trip_itineraries'];
				if ( $allowed_trip_details == 'yes' ) {
					if ( ! empty( $trip_data['trip']['itineraries'] ) ) {
						?>
						<h5 class="itinerary-label"><?php esc_html_e( 'Trip Itineraries : ', 'wp-travel-pro' ); ?></h5>
						<?php
						$itineraries = $trip_data['trip']['itineraries'];
						foreach ( $itineraries as $itinerary ) {
							?>
							<div class="trip-itinerary">
								<div class="tc-heading">
									<h5 class="day-count"><?php echo esc_html( $itinerary['label'] ); ?></h5>
									<?php
									if ( isset( $itinerary['image'] ) && ! empty( $itinerary['image'] ) ) {
										$img_id    = $itinerary['image'];
										$image_url = '';
										if ( $img_id ) {
											$image     = wp_get_attachment_image_src( $img_id, 'medium' );
											$image_url = isset( $image[0] ) ? $image[0] : '';
											if ( 'yes' === $downloads_relative_path ) {
												$image_url = get_attached_file( $img_id );
											}
										}
										if ( '' === $image_url ) {
											$image_url = wptravel_get_post_placeholder_image_url();
										}
										?>
												<br />
												<div class="itinerary-image">
													<img src="<?php echo 'yes' !== $downloads_relative_path ? esc_url( $image_url ) : esc_url( $image_url ); ?>" width="300" />
												</div>
												<br />
											<?php
									}
									?>
									<br />
									<div class="itinerary-content">
									<?php if ( $itinerary['date'] && 'invalid date' !== strtolower( $itinerary['date'] ) ) : ?>
										<h5><?php echo esc_html( 'Date: ' . $itinerary['date'] ); ?></h5>
										<br/>
									<?php endif; ?>
									<?php if ( $itinerary['time'] ) : ?>
										<h5><?php echo esc_html( 'Time: ' . $itinerary['time'] ); ?></h5>
										<br/>
									<?php endif; ?>
								</div>
								</div>
								<div class= "tc-content">
								<div class="itinerary-content">
									<h5><?php echo esc_html( $itinerary['title'] ); ?></h5>
									<?php echo '<br>'; ?>
									<p><?php echo ( $itinerary['desc'] ); ?></p>
									<?php echo '<br><br>'; ?>
								</div>
								</div>
							</div>
							<?php
						}
					}
				}
				?>
			</div>
			<!-- this div contains from trip overview, trip includes and excludes -->
			<div>
				<?php
				$allowed_trip_details = $settings['show_trip_overview'];
				if ( 'yes' === $allowed_trip_details ) {
					if ( ! empty( $trip_data['trip']['trip_overview'] ) ) {
						?>
						<h5><?php esc_html_e( 'Trip Overview : ', 'wp-travel-pro' ); ?></h5>
						<p> <?php echo wp_kses_post( preg_replace('/\[wp_travel_trip_weather_forecast(.*)\]/i', '', $trip_data['trip']['trip_overview']) ); ?></p>
						<?php
					}
				}

				$allowed_trip_details = $settings['show_trip_includes_excludes'];
				if ( 'yes' === $allowed_trip_details && ! empty( $trip_data['trip']['trip_include'] && $trip_data['trip']['trip_exclude'] ) ) {
					?>
					<h5 class="include-title"><?php esc_html_e( 'Trip Include : ', 'wp-travel-pro' ); ?></h5>
					<p><?php echo wp_kses_post( preg_replace('/\[wp_travel_trip_weather_forecast(.*)\]/i', '', $trip_data['trip']['trip_include']) ); ?></p>

					<h5 class="exclude-title"><?php esc_html_e( 'Trip Exclude : ', 'wp-travel-pro' ); ?></h5>
					<p> <?php echo wp_kses_post( preg_replace('/\[wp_travel_trip_weather_forecast(.*)\]/i', '', $trip_data['trip']['trip_exclude']) ); ?> </p>
					<?php
				}
				?>
			</div>
		</div>
	</body>
</html>
