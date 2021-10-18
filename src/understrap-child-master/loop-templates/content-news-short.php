<?php
/**
 * The template used for displaying stories
 *
 * @package understrap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("side-news-list_item"); ?>>

	<header class="entry-header">
		<div class="translateFaIcon" >
			<div class="entry-meta">
				<?php if ( is_singular( 'programmes' ) ) : ?>
					
					<?php the_date(); ?>
					
				<?php elseif (is_single()): ?>
					
					<?php the_date(); ?> - <?php /* the_tags('',', '); */ ?>
					<?php $posttags = get_the_tags();
						if ($posttags) {
						  foreach($posttags as $tag) {
						    echo $tag->name . ' '; 
						  }
						}
						?>
						
				<?php else : ?>

					<?php the_date(); ?> - <?php /* the_tags('',', '); */ ?>
					<?php $posttags = get_the_tags();
						if ($posttags) {
						  foreach($posttags as $tag) {
						    echo $tag->name . ' '; 
						  }
						}
						?>
						
				<?php endif; ?>
			</div><!-- .entry-meta -->
			<a href="<?php the_permalink(); ?>" class="mainBtn">
				<?php the_title( '<h4 class="entry-title">', '</h4>' ); ?><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
			</a>
		</div>
	</header><!-- .entry-header -->
	
</article><!-- #post-## -->
