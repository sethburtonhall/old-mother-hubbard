<?php
/**
 * Template part for displaying posts
 *
 * Used for single, index, archive, search.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article">

	<header class="article-header">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	</header> <!-- end article header -->

	<section class="entry-content archive search-result" itemprop="articleBody">
		<?php if(has_post_thumbnail()) : ?>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><span style="background-image:url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>)"></span></a>
		<?php elseif(!empty(get_post_meta(get_the_ID(), '_property_meta_property_photos', true)[0])) : ?>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><span style="background-image:url(<?php echo wp_get_attachment_image_url(get_post_meta(get_the_ID(), '_property_meta_property_photos', true)[0]['_property_meta_carousel_photo_id'], 'medium'); ?>)"></span></a>
		<?php elseif(!empty(get_post_meta(get_the_ID(), 'case_study_property_photos', true)[0])) : ?>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><span style="background-image:url(<?php echo wp_get_attachment_image_url(get_post_meta(get_the_ID(), 'case_study_property_photos', true)[0]['_case_study_meta_carousel_photo_id'], 'medium'); ?>)"></span></a>
		<?php endif; ?>
		<?php the_excerpt(); ?>
	</section> <!-- end article section -->

	<footer class="article-footer">
    	<p class="tags"><?php the_tags('<span class="tags-title">' . __('Tags:', 'jointstheme') . '</span> ', ', ', ''); ?></p>
	</footer> <!-- end article footer -->

</article> <!-- end article -->

<hr />
