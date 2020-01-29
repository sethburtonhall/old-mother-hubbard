<?php
/**
 * Template part for displaying a single post
 */
?>
<div class="gray-header">
	<div class="grid-container">
		<div class="grid-container grid-x grid-margin-x grid-padding-x">
			<main class="main small-12 medium-12 large-12 cell" role="main">
				<h1><?php the_title(); ?></h1>
			</main>
		</div>
	</div>
	<div class="grid-container">
		<div class="grid-container grid-x grid-margin-x grid-padding-x subhead-withnav">
			<div class="main small-12 medium-12 large-8 cell" role="main">
				<p class="subhead">
					<?php echo get_post_meta( get_the_ID(), '_property_meta_address', true ); ?> <?php echo get_post_meta( get_the_ID(), '_property_meta_address_2', true ); ?><br />
					<?php echo get_post_meta( get_the_ID(), '_property_meta_city', true ); ?>, <?php echo get_post_meta( get_the_ID(), '_property_meta_state', true ); ?> <?php echo get_post_meta( get_the_ID(), '_property_meta_zipcode', true ); ?>
				</p>
			</div>
			<div class="main small-12 medium-12 large-4 cell" role="main">
					<ul class="subhead-menu">
						<li><a href="#gallery-desc">Gallery</a></li>
						<li><a href="#location-desc">Location</a></li>
						<li><a href="#overview-desc">Overview</a></li>
						<?php if(!empty(get_post_meta( get_the_ID(), '_property_meta_floorplan_photos', true ))) : ?>
							<li><a href="#floorplans-desc">Floor Plans</a></li>
						<?php endif; ?>
					</ul>
			</div>
		</div>
	</div>
</div>


<div id="gallery-desc">
	<div class="grid-container">
		<div class="grid-container grid-x grid-margin-x grid-padding-x">
			<div class="small-12 medium-12 large-12 cell">

				<div class="carousel-container" id="gallery-desc">
					<?php
						$photos = get_post_meta( get_the_ID(), '_property_meta_property_photos', true );
					?>
					<div class="header-carousel">
						<?php $photoindex = 1; foreach((array) $photos as $key => $entry) : ?>
							<?php
								// var_dump($entry);
								$img_full = wp_get_attachment_url( $entry['_property_meta_carousel_photo_id']);
								$img_large = wp_get_attachment_image_url($entry['_property_meta_carousel_photo_id'], 'large');
								$caption = esc_html( $entry['_property_meta_carousel_photo_caption'] );
								if(empty($caption)) {
									$caption = "[ photo ".$photoindex." of ".count($photos)." ]";
								}
							?>
							<div class="slide ">
								<div class="slideimg-container">
									<a href="<?php echo $img_full ?>"><img src="<?php echo $img_large ?>" alt="" /></a>
								</div>
								<p class="slideimg-caption">
									&nbsp;<?php echo $caption; ?>&nbsp;
								</p>
							</div>
						<?php $photoindex++; endforeach; ?>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>


<!-- AIzaSyD8KQT1aa98iwav4AQftnGC6fHlaCk4Ock -->

<?php
	$apiAddress = array();
	$apiAddress[] = get_post_meta( get_the_ID(), '_property_meta_address', true );
	$apiAddress[] = get_post_meta( get_the_ID(), '_property_meta_city', true );
	$apiAddress[] = get_post_meta( get_the_ID(), '_property_meta_state', true );
	$apiAddress[] = get_post_meta( get_the_ID(), '_property_meta_zipcode', true );
?>

<div class="map-container" id="location-desc">
	<div class="grid-container">
		<div class="grid-container grid-x grid-margin-x grid-padding-x">
			<div class="small-12 medium-12 large-6 cell">
				<div class="location-map-container">
					<div class="flex-video">
						<!-- <iframe
							width="600"
							height="450"
							frameborder="0" style="border:0"
							src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD09zQ9PNDNNy9TadMuzRV_UsPUoWKntt8&q=<?php echo urlencode(implode('+', $apiAddress)); ?>" allowfullscreen>
						</iframe> -->

						<div id="property-map" style="height: 400px;"></div>
						<script>
							var geocoder;
							var map;
							var address = "<?php echo implode(' ', $apiAddress); ?>";
							function initMap() {
								var geocoder = new google.maps.Geocoder();
								var map = new google.maps.Map(document.getElementById('property-map'), {
									center: {lat: 36.104646274506415, lng: -80.24345790000001},
									zoom: 16,
									styles: [
										{
											"elementType": "labels.text.fill",
											"stylers": [
												{
													"color": "#435b71"
												}
											]
										},
										{
											"elementType": "labels.text.stroke",
											"stylers": [
												{
													"color": "#041e34"
												}
											]
										},
										{
											"featureType": "administrative",
											"elementType": "geometry",
											"stylers": [
												{
													"visibility": "off"
												}
											]
										},
										{
											"featureType": "administrative.land_parcel",
											"elementType": "labels",
											"stylers": [
												{
													"visibility": "off"
												}
											]
										},
										{
											"featureType": "landscape",
											"stylers": [
												{
													"color": "#041e34"
												}
											]
										},
										{
											"featureType": "poi",
											"stylers": [
												{
													"visibility": "off"
												}
											]
										},
										{
											"featureType": "road",
											"elementType": "geometry",
											"stylers": [
												{
													"color": "#0b2b48"
												}
											]
										},
										{
											"featureType": "road",
											"elementType": "labels.icon",
											"stylers": [
												{
													"visibility": "off"
												}
											]
										},
										{
											"featureType": "road.local",
											"elementType": "labels",
											"stylers": [
												{
													"visibility": "off"
												}
											]
										},
										{
											"featureType": "transit",
											"stylers": [
												{
													"visibility": "off"
												}
											]
										},
										{
											"featureType": "water",
											"stylers": [
												{
													"color": "#06233b"
												}
											]
										}
									]
								});

								if (geocoder) {
									console.log('codin!');
							    geocoder.geocode({
							      'address': "<?php echo implode(' ', $apiAddress); ?>"
							    }, function(results, status) {
										console.log(results);
							      if (status == google.maps.GeocoderStatus.OK) {
							        if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
												map.setCenter(results[0].geometry.location);

												var image = {
											    url: '<?php echo get_template_directory_uri(); ?>/assets/images/map-marker.png',
											    size: new google.maps.Size(60, 61),
											    origin: new google.maps.Point(0, 0),
											    anchor: new google.maps.Point(30, 61)
											  };

							          var marker = new google.maps.Marker({
							            position: results[0].geometry.location,
							            map: map,
							            title: address,
													icon: image,
							          });

											}
										}
									});
								}
							}
						</script>
						<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD09zQ9PNDNNy9TadMuzRV_UsPUoWKntt8&callback=initMap"></script>
					</div>
				</div>
			</div>
			<div class="small-0 medium-0 large-1 cell show-for-large"></div>
			<div class="small-12 medium-12 large-5 cell">
				<div class="location-description-container">
					<h2>Location</h2>
					<?php echo get_post_meta(get_the_ID(), '_property_meta_location_highlights', true); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="grid-container" id="overview-desc">
	<div class="grid-container grid-x grid-margin-x grid-padding-x">
		<div class="small-12 medium-12 large-12 cell">
			<div class="property-article-container">
				<article id="post-<?php the_ID(); ?>" <?php post_class('internalpage'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					<h2>Property Overview</h2>
					<div class="content-container">
						<?php
							the_content();

							$brochures = get_post_meta( get_the_ID(), '_property_meta_brochure_files', true );
						?>

						<?php if(!empty($brochures)) : ?>
							<div class="brochure-container">
								<?php foreach((array) $brochures as $key => $entry) : ?>
									<a href="<?php echo $entry; ?>" target="_blank" class="button large">Download Brochure</a>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>


						<?php

							$prefix = '_property_meta_';
						?>
						<ul class="accordion" data-accordion data-multi-expand="true" data-allow-all-closed="true">

							<?php if(!(empty(get_post_meta( get_the_ID(), '_property_meta_livestream_url', true )))) : ?>
								<li class="accordion-item is-active" data-accordion-item>

									<a href="#" class="accordion-title">LiveStream</a>

							    <div class="accordion-content" data-tab-content>
										<div class="flex-video">
											<iframe src="<?php echo get_post_meta( get_the_ID(), '_property_meta_livestream_url', true) ; ?>" style="box-sizing:border-box; border:1px solid #444; position:absolute; top:0; left:0; width:100%; height:100%; "></iframe>
										</div>
									</div>
								</li>
							<?php endif; ?>

							<?php
								$details_meta = array(
									'Available SF ±' => 'available_sf',
									'SF per Floor ±' => 'sf_per_floor',
									'Building SF ±' => 'building_sf',
									'Office SF ±' => 'office_sf',
									'Retail SF ±' => 'retail_sf',
									'Year Built' => 'year_built',
									'Dimensions ±' => 'dimensions',
									'Restrooms ±' => 'restrooms',
									'Floors' => 'floors',
									'Elevators ±' => 'elevators',
									'Flooring' => 'flooring',
									'Roof' => 'roof',
									'Bldg Exterior' => 'bldg_exterior',
									'Acres ±' => 'acres',
									'Ceiling Height ±' => 'ceiling_height',
									'Parking ±' => 'parking',
									'Bay Size ±' => 'bay_size',
									'Docks ±' => 'docks',
									'Drive-ins ±' => 'drive_ins',
									'Sprinklered' => 'sprinklered'
								);

								$final_details = array();
							?>

							<?php
								foreach($details_meta as $key => $value) {
									$meta_value = get_post_meta( get_the_ID(), $prefix.$value, true );
									if(!empty($meta_value)) {
										$final_details[] = array($key, $meta_value);
									}
								}
							?>

							<?php if(!empty($final_details)) : ?>
							  <li class="accordion-item is-active" data-accordion-item>

									<a href="#" class="accordion-title">Property Details</a>

							    <div class="accordion-content" data-tab-content>

										<table>
										<?php foreach($final_details as $meta_value) : ?>
											<tr>
												<th>
													<?php echo $meta_value[0]; ?>
												</th>
												<td>
													<?php echo $meta_value[1]; ?>
												</td>
											</tr>
										<?php endforeach; ?>
										</table>
							    </div>
							  </li>
							<?php endif; ?>

							<?php
								$utilities_meta = array(
									'Electrical' => 'electrical',
									'Water' => 'water',
									'Sewer' => 'sewer',
									'Air' => 'air',
									'Heat' => 'heat',
									'Gas' => 'gas'
								);

								$final_utilities = array();
							?>

							<?php
								foreach($utilities_meta as $key => $value) {
									$meta_value = get_post_meta( get_the_ID(), $prefix.$value, true );
									if(!empty($meta_value)) {
										$final_utilities[] = array($key, $meta_value);
									}
								}
							?>

							<?php if(!empty($final_utilities)) : ?>
								<li class="accordion-item" data-accordion-item>

									<a href="#" class="accordion-title">Utilities</a>

							    <div class="accordion-content" data-tab-content>
										<table>
											<?php foreach($final_utilities as $meta_value) : ?>
												<tr>
													<th>
														<?php echo $meta_value[0]; ?>
													</th>
													<td>
														<?php echo $meta_value[1]; ?>
													</td>
												</tr>
											<?php endforeach; ?>
										</table>
							    </div>
							  </li>
							<?php endif; ?>

							<?php
								$taxes_meta = array(
									'Zoning' => 'zoning',
									'Tax Map' => 'tax_map',
									'Tax Block' => 'tax_block',
									'Tax Lots' => 'tax_lots',
									'Tax Pin' => 'tax_pin',
								);
								$final_taxes = array();
							?>

							<?php
								foreach($taxes_meta as $key => $value) {
									$meta_value = get_post_meta( get_the_ID(), $prefix.$value, true );
									if(!empty($meta_value)) {
										$final_taxes[] = array($key, $meta_value);
									}
								}
							?>

							<?php if(!empty($final_taxes)) : ?>
								<li class="accordion-item" data-accordion-item>
									<a href="#" class="accordion-title">Taxes</a>

							    <div class="accordion-content" data-tab-content>

										<table>
											<?php foreach($final_taxes as $meta_value) : ?>
												<tr>
													<th>
														<?php echo $meta_value[0]; ?>
													</th>
													<td>
														<?php echo $meta_value[1]; ?>
													</td>
												</tr>
											<?php endforeach; ?>
										</table>
							    </div>
							  </li>
							<?php endif; ?>

							<?php
								$pricing_meta = array(
									'Price' => 'price',
									'Price/SF' => 'price_sf',
									'Tax Value' => 'tax_value',
									'Lease Rt/SF ±' => 'lease_rt_sf',
									'Rent/mth ±' => 'rent_mth',
									'Lease Type' => 'lease_type',
								);
								$final_pricing = array();
							?>

							<?php
								foreach($pricing_meta as $key => $value) {
									$meta_value = get_post_meta( get_the_ID(), $prefix.$value, true );
									if(!empty($meta_value)) {
										$final_pricing[] = array($key, $meta_value);
									}
								}
							?>

							<?php if(!empty($final_pricing)) : ?>
								<li class="accordion-item" data-accordion-item>
							    <a href="#" class="accordion-title">Pricing &amp; Terms</a>

							    <div class="accordion-content" data-tab-content>

										<table>
										<?php foreach($final_pricing as $meta_value) : ?>
											<tr>
												<th>
													<?php echo $meta_value[0]; ?>
												</th>
												<td>
													<?php
														if($meta_value[0] === 'Price' || $meta_value[0] === 'Tax Value') { echo '$'; }
														echo $meta_value[1];
													?>
												</td>
											</tr>
										<?php endforeach; ?>
										</table>
							    </div>
							  </li>
							<?php endif; ?>

							<?php
								$floorplan_photos = get_post_meta( get_the_ID(), '_property_meta_floorplan_photos', true );
							?>

							<?php if(!empty($floorplan_photos)) : ?>
							<li class="accordion-item is-active" id="floorplans-desc" data-accordion-item>
						    <a href="#" class="accordion-title">Floor Plans</a>

						    <div class="accordion-content" data-tab-content>

									<div class="floorplan-carousel">
										<?php $photoindex = 1; foreach((array) $floorplan_photos as $key => $entry) : ?>
											<?php
												// var_dump($entry);
												// $img = wp_get_attachment_url( $entry['_property_meta_floorplan_photo_id']);
												$img_full = wp_get_attachment_url( $entry['_property_meta_floorplan_photo_id']);
												$img_large = wp_get_attachment_image_url($entry['_property_meta_floorplan_photo_id'], 'large');
												$caption = esc_html( $entry['_property_meta_floorplan_photo_caption'] );
												if(empty($caption)) {
													$caption = "[ photo ".$photoindex." of ".count($floorplan_photos)." ]";
												}
											?>
											<div class="slide">
												<div class="slideimg-container">
													<a href="<?php echo $img_full ?>"><img src="<?php echo $img_large ?>" alt="" /></a>
												</div>
												<p class="slideimg-caption">
													&nbsp;<?php echo $caption; ?>&nbsp;
												</p>
											</div>
										<?php $photoindex++; endforeach; ?>
									</div>
								</div>
							</li>
							<?php endif; ?>

							<?php
								$attachments = get_post_meta( get_the_ID(), '_property_meta_attachment_files', true );
							?>

							<?php if(!empty($attachments)) : ?>
								<li class="accordion-item" data-accordion-item>
							    <a href="#" class="accordion-title">Attachments</a>

							    <div class="accordion-content" data-tab-content>
										<table>
											<?php foreach((array) $attachments as $key => $entry) : ?>
												<tr>
													<th>
														<?php echo Attachment; ?>
													</th>
													<td>
														<a href="<?php echo $entry; ?>" target="_blank"><?php echo basename($entry); ?></a>
													</td>
												</tr>
											<?php endforeach; ?>
										</table>
									</div>
								</li>
							<?php endif; ?>

						</ul>
					</div>
				</article>
			</div>
		</div>
	</div>
</div>

<?php
$broker_ids = explode(',', get_post_meta( get_the_ID(), '_property_meta_broker', true ));

// var_dump($broker_ids);

$args = array(
		// 'post__in' => $broker_ids,
		// 'post_type' => "brokers",
		// 'orderby' => 'post__in'
		'posts_per_page' => 99,
		'offset' => 0,
		'include' => $broker_ids,
		'post_type' => 'brokers',

);

$broker_list = get_posts($args);

// Fix a thing that, because of the use of an ordering plugin, the posts cannot be ordered via query

$new_broker_list = array();
$nbl_index = 0;

foreach($broker_ids as $bid) {
	foreach($broker_list as $bl) {
		if($bl->ID == $bid) {
			$new_broker_list[] = $bl;
		}
	}
}

// var_dump($broker_list);
// var_dump($post_query);
?>

<div class="broker-container">
	<div class="grid-container">
		<div class="grid-container grid-x grid-margin-x grid-padding-x">
			<div class="small-12 medium-12 large-12 cell">
				<div class="broker-contact">
					<?php $contact_emails = array(); $ce_index = 0;?>
					<?php /*while($post_query->have_posts()) : $post_query->the_post();*/ ?>
					<?php foreach($new_broker_list as $broker_post) : ?>
						<div class="broker-row">
							<div class="broker-contact-photo" style="background-image: url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($broker_post->ID), 'large')[0]; ?>)" ></div>
							<div class="broker-contact-info">
								<h2><?php echo $broker_post->post_title; ?></h2>
								<p class="email"><a href="mailto:<?php echo get_post_meta( $broker_post->ID, '_broker_meta_email_address', true ); ?>" target="_blank"><?php echo get_post_meta( $broker_post->ID, '_broker_meta_email_address', true ); ?></a></p>
								<p class="phone"><?php echo get_post_meta( $broker_post->ID, '_broker_meta_phone_number', true ); ?></p>
							</div>
						</div>
						<?php $contact_emails[] = "form-agent-emails-".$ce_index."=".get_post_meta( $broker_post->ID, '_broker_meta_email_address', true ); $ce_index++;?>
					<?php endforeach; ?>
					<?php /*endwhile; ?>
					<?php wp_reset_query();*/ ?>
				</div>

				<div class="contact-form">
					<?php
						echo do_shortcode("[gravityform id=2 title=false description=false ajax=true tabindex=49 field_values='".implode('&', $contact_emails)."']");
					?>
				</div>
			</div>
		</div>
	</div>
</div>
