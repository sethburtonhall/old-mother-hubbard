<?php
/**
 * Displays archive pages if a speicifc template is not set.
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

get_header(); ?>

<?php

$args = array(
		'post_type' => 'services',
		'posts_per_page' => $settings->posts_to_show
);

$post_query = new WP_Query($args);

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">

<?php if($post_query->have_posts()) : ?>

	<div class="services-features-two">
    <div class="grid-container">
  		<div class="grid-container grid-x grid-margin-x grid-padding-x">
  			<div class="small-12 medium-12 large-12 cell services-features-container">
          <div class="whitebacking"></div>
          <?php while($post_query->have_posts()) : $post_query->the_post(); ?>

            <div class="feature-container">
              <a href="<?php echo get_the_permalink(); ?>">

                <div class="feature">
                  <div class="grid-container">

                		<div class="grid-container grid-x grid-margin-x grid-padding-x">
                      <div class="small-2 medium-2 large-4 cell">
                      </div>
                      <div class="small-10 medium-10 large-8 cell img-house">
                        <div class="img-contaner" style="background-image:url(<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full')[0]; ?>);"></div>
                      </div>
                    </div>

                    <div class="title-container">
                      <span>
                        <h2><?php echo get_the_title(); ?></h2>
                        <div class="arrow elegant-icon">$</div>
                      </span>
                    </div>

                  </div>
                </div>

              </a>
            </div>

          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </div>

<?php endif; ?>

</article>

<?php get_footer(); ?>
