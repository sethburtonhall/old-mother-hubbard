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
		<div class="grid-container grid-x grid-margin-x grid-padding-x">
			<div class="main small-12 medium-12 large-8 cell" role="main">
				<p class="subhead line-left">
					<?php echo get_post_meta( get_the_ID(), '_case_study_meta_address', true ); ?> <?php echo get_post_meta( get_the_ID(), '_case_study_meta_address_2', true ); ?><br />
					<?php echo get_post_meta( get_the_ID(), '_case_study_meta_city', true ); ?>, <?php echo get_post_meta( get_the_ID(), '_case_study_meta_state', true ); ?> <?php echo get_post_meta( get_the_ID(), '_case_study_meta_zipcode', true ); ?>
				</p>
			</div>
		</div>
	</div>
</div>
</div>

<div class="grid-container">
	<div class="grid-container grid-x grid-margin-x grid-padding-x">
		<div class="small-12 medium-12 large-12 cell">

			<div class="carousel-container">
				<?php
					$photos = get_post_meta( get_the_ID(), 'case_study_property_photos', true );
				?>
				<div class="header-carousel">
					<?php foreach((array) $photos as $key => $entry) : ?>
						<?php
							// var_dump($entry);
							$img = wp_get_attachment_url( $entry['_case_study_meta_carousel_photo_id']);
							$caption = esc_html( $entry['_case_study_meta_carousel_photo_caption'] );
						?>
						<div class="slide">
							<div class="slideimg-container">
								<img src="<?php echo $img ?>" alt="" />
							</div>
							<p class="slideimg-caption">
								<?php echo $caption; ?>
							</p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<article id="post-<?php the_ID(); ?>" <?php post_class('internalpage'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
				<h2><?php echo get_post_meta( get_the_ID(), '_case_study_meta_headline', true ); ?></h2>
				<div class="content-container">
					<?php the_content(); ?>
					<a href="/contact/" class="button large">Let's Talk</a>
				</div>
			</article>

		</div>
	</div>
</div>
