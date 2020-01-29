<?php
/**
 * The template part for displaying offcanvas content
 *
 * For more info: http://jointswp.com/docs/off-canvas-menu/
 */

 global $wpdb;
?>

<div class="off-canvas position-top" id="off-canvas-search" data-off-canvas>
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="main search small-12 cell">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</div>

<div class="off-canvas position-right" id="off-canvas-nav" data-transition="overlap" data-off-canvas>
	<div class="mobile-nav-container">
		<?php joints_off_canvas_nav(); ?>
		<div class="foot-menu">
			<!-- <ul class="button-menu">
				<li><a href="#stuff" class="button hollow">Tenant Login</a></li>
				<li><a href="#stuff" class="button hollow">Maintenance Request</a></li>
			</ul> -->
			<?php joints_secondary_nav_mobile(); ?>
			<?php joints_social_links(); ?>
		</div>
	</div>
</div>

<?php

	$cat_args = array(
    'exclude' => array( 22,23,24 ),
		'orderby'       => 'term_id',
		'order'         => 'ASC',
		'hide_empty'    => true,
	);

	$salelease_terms = get_terms('property_salelease', $cat_args);
	$cat_terms = get_terms('property_category', $cat_args);

?>

<div class="off-canvas position-right" id="off-canvas-advsearch" data-transition="overlap" data-off-canvas>
	<div class="advancedsearch">
    <a data-toggle="off-canvas-advsearch" class="close-button">M</a>
    <h2>Advanced Search</h2>

    <div class="keywordsearch">
      <input type="search" class="search-field input-group-field" placeholder="<?php echo esc_attr_x( 'Search Keywords', 'jointswp' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'jointswp' ) ?>" />
    </div>

		<ul class="accordion" data-accordion data-multi-expand="true" data-allow-all-closed="true">

			<li class="accordion-item" data-accordion-item>
				<a href="#" class="accordion-title">For Sale/Lease</a>
				<div class="accordion-content" data-tab-content>
					<fieldset class="fieldset advanced-search-salelease">
						<?php foreach($salelease_terms as $term) : ?>
							<span><input id="advsalelease-<?php echo $term->term_id; ?>" data-id="<?php echo $term->term_id; ?>" class="salelease-advsearch" type="checkbox"><label for="advsalelease-<?php echo $term->term_id; ?>"><?php echo $term->name; ?></label></span>
						<?php endforeach; ?>
					</fieldset>
		    </div>
			</li>

			<li class="accordion-item" data-accordion-item>
				<a href="#" class="accordion-title">Category</a>
				<div class="accordion-content" data-tab-content>
					<fieldset class="fieldset advanced-search-category">
						<?php foreach($cat_terms as $term) : ?>
							<span><input id="advcategory-<?php echo $term->term_id; ?>" data-id="<?php echo $term->term_id; ?>" class="category-advsearch" type="checkbox"><label for="advcategory-<?php echo $term->term_id; ?>"><?php echo $term->name; ?></label></span>
						<?php endforeach; ?>
					</fieldset>
		    </div>
			</li>

			<li class="accordion-item" data-accordion-item>
				<a href="#" class="accordion-title">Asking Price</a>
				<div class="accordion-content" data-tab-content>
					<fieldset class="fieldset advanced-search-asking-price">
						<?php
							$priceRanges = array(
								array(100001, 250000),
								array(250001, 500000),
								array(500001, 1000000),
								array(1000001,10000000)
							);
							$i = 0;
						?>
						<?php foreach($priceRanges as $priceRange) : ?>
							<span><input id="advaskingprice-<?php echo $i; ?>" data-meta-value="<?php echo $priceRange[0]; ?>" class="category-advaskingprice" type="checkbox"><label for="advaskingprice-<?php echo $i; ?>"><?php echo ('$'.number_format($priceRange[0]) . " - " . '$'.number_format($priceRange[1])); ?></label></span>
						<?php $i++; endforeach; ?>
					</fieldset>
		    </div>
			</li>

			<li class="accordion-item" data-accordion-item>
				<a href="#" class="accordion-title">Lease Rate</a>
				<div class="accordion-content" data-tab-content>
					<fieldset class="fieldset advanced-search-lease-rate">
						<?php
							$leaseRanges = array(
								array(2, 10),
								array(11, 15),
								array(16, 20),
								array(21,25),

                // array(26,30),
                // array(31,35),
                // array(36,40),
                // array(41,45),
							);
							$i = 0;
						?>
						<?php foreach($leaseRanges as $leaseRange) : ?>
							<span><input id="advleaserate-<?php echo $i; ?>" data-meta-value="<?php echo $leaseRange[0]; ?>" class="category-advleaserate" type="checkbox"><label for="advleaserate-<?php echo $i; ?>"><?php echo ('$'.number_format($leaseRange[0]) . " - " . '$'.number_format($leaseRange[1])); ?></label></span>
						<?php $i++; endforeach; ?>
					</fieldset>
		    </div>
			</li>

      <li class="accordion-item" data-accordion-item>
				<a href="#" class="accordion-title">Broker</a>
				<div class="accordion-content" data-tab-content>
					<?php

          $broker_listings = $wpdb->get_results( "select * from $wpdb->postmeta where meta_key = '_property_meta_broker' " );;
          // echo "<!-- LISTINGS";
          // var_dump($broker_listings);
          // echo "-->";

          $broker_ids = array();
          foreach($broker_listings as $bl) {
            $b_ids = explode(',', $bl->meta_value);
            foreach($b_ids as $b_id) {
              if(!in_array($b_id, $broker_ids) && ctype_digit(trim($b_id))) {
                $broker_ids[] = (int)trim($b_id);
              }
            }
          }

          // echo "<!-- BROKER IDS";
          // var_dump($broker_ids);
          // echo "-->";

          $args = array(
            'posts_per_page'   => 999,
            'post_type' => 'brokers',
            'post__in' => $broker_ids,
            'orderby'   => 'title',
            'order'     => 'ASC'
          );

          $brokers = get_posts( $args );
          // var_dump($brokers);
					?>
					<fieldset class="fieldset advanced-search-broker">
            <?php foreach($brokers as $broker) : ?>
              <span><input id="advbroker-<?php echo $broker->ID; ?>" data-meta-value="<?php echo $broker->ID; ?>" class="category-advleaserate" type="checkbox"><label for="advbroker-<?php echo $broker->ID; ?>"><?php echo $broker->post_title; ?></label></span>
            <?php endforeach; ?>
					</fieldset>

				</div>
			</li>

			<li class="accordion-item" data-accordion-item>
				<a href="#" class="accordion-title">State</a>
				<div class="accordion-content" data-tab-content>
					<?php
					$key = '_property_meta_state';
					$results = $wpdb->get_col(
						$wpdb->prepare( "
							SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
							LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
							WHERE pm.meta_key = '%s'
							AND p.post_status = 'publish'
							ORDER BY pm.meta_value",
							$key
						)
					);
					// var_dump($results);
					?>
					<fieldset class="fieldset advanced-search-state">
						<?php $i=0; foreach($results as $result) : ?>
							<span><input id="advstate-<?php echo $i; ?>" data-meta-value="<?php echo $result; ?>" class="category-advleaserate" type="checkbox"><label for="advstate-<?php echo $i; ?>"><?php echo $result; ?></label></span>
						<?php $i++; endforeach; ?>
					</fieldset>

				</div>
			</li>

			<li class="accordion-item" data-accordion-item>
				<a href="#" class="accordion-title">City</a>
				<div class="accordion-content" data-tab-content>
					<?php
					$key = '_property_meta_city';
					$results = $wpdb->get_col(
						$wpdb->prepare( "
							SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
							LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
							WHERE pm.meta_key = '%s'
							AND p.post_status = 'publish'
							ORDER BY pm.meta_value",
							$key
						)
					);
					// var_dump($results);
					?>
					<fieldset class="fieldset advanced-search-city">
						<?php $i=0; foreach($results as $result) : ?>
							<span><input id="advcity-<?php echo $i; ?>" data-meta-value="<?php echo $result; ?>" class="category-advcity" type="checkbox"><label for="advcity-<?php echo $i; ?>"><?php echo $result; ?></label></span>
						<?php $i++; endforeach; ?>
					</fieldset>

				</div>
			</li>

			<li class="accordion-item" data-accordion-item>
				<a href="#" class="accordion-title">Zip</a>
				<div class="accordion-content" data-tab-content>
					<?php
					$key = '_property_meta_zipcode';
					$results = $wpdb->get_col(
						$wpdb->prepare( "
							SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
							LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
							WHERE pm.meta_key = '%s'
							AND p.post_status = 'publish'
							ORDER BY pm.meta_value",
							$key
						)
					);
					// var_dump($results);
					?>
					<fieldset class="fieldset advanced-search-zipcode">
						<?php $i=0; foreach($results as $result) : ?>
							<span><input id="advzipcode-<?php echo $i; ?>" data-meta-value="<?php echo $result; ?>" class="category-advzipcode" type="checkbox"><label for="advzipcode-<?php echo $i; ?>"><?php echo $result; ?></label></span>
						<?php $i++; endforeach; ?>
					</fieldset>

				</div>
			</li>

		</ul>

    <div class="foot-buttons">
  		<button class="button hollow" id="advanced_clearall">Clear All</button>
  		<button class="button hollow" id="advanced_done" data-toggle="off-canvas-advsearch">Done</button>
    </div>
	</div>
</div>
