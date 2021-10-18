<?php
/**
 * The template used for displaying stories
 *
 * @package understrap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('card card-block noPadding'); ?>>
	<a href="<?php the_permalink(); ?>">
	    <?php echo get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'card-img-top' )); ?>     
	    <div class="card-block">
		    <div class="entry-meta"><?php the_date(); ?> - <?php the_tags('',', '); ?></div>
		    
		    <?php the_title( '<h4 class="card-title">', '</h4>' ); ?>
			
			<div class=" class="card-blockquote"">
				<?php the_content('<i class="fa fa-long-arrow-right" aria-hidden="true"></i> Read more'); ?>
			</div><!-- .entry-content -->

			<?php /* edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); */?>
		</div>
	</a>
</article><!-- #post-## -->