<?php
/**
 * The template used for displaying stories
 *
 * @package understrap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("side-news-list_item side-event-list_item"); ?>>

	<header class="entry-header">
		<a href="<?php echo do_shortcode('[event post_id="' .$post->ID. '"]#_EVENTURL[/event]'); ?>" class="translateFaIcon" >

			<div class="entry-meta"><?php echo strip_tags(do_shortcode('[event post_id="' .$post->ID. '"]#_EVENTTAGS[/event]')); ?></div>
			<?php the_title( '<h4 class="entry-title">', '</h4>' ); ?>
			<div class="entry-meta text-capitalize">
				<?php if ( is_single() ) : ?>
					<?php echo strip_tags(do_shortcode('[event post_id="' .$post->ID. '"]#_EVENTDATES[/event]')); ?><br><?php echo strip_tags(do_shortcode('[event post_id="' .$post->ID. '"]#_LOCATIONNAME, #_LOCATIONTOWN[/event]')); ?>
				<?php else : ?>
					<?php the_date(); ?> - <?php the_tags('',', '); ?>
				<?php endif; ?>
			</div><!-- .entry-meta -->			
			<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
		</a>
	</header><!-- .entry-header -->
	
</article><!-- #post-## -->
