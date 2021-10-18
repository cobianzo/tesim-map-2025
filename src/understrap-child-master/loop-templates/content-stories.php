<?php
/**
 * The template used for displaying stories
 *
 * @package understrap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="card">
		<a href="<?php the_permalink(); ?>">
	    <?php echo get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'card-img-top' )); ?> 
	    
	    <div class="card-block">
		    <?php the_title( '<h4 class="card-title">', '</h4>' ); ?>
			
		    <div class="card-text"><p class="entry-meta"><?php the_date(); /*understrap_posted_on(); */?> <?php if( has_tag() ) { echo "- "; echo the_tags(''); } ?></p></div>
			<div class="card-text">
				<?php the_content('<i class="fa fa-long-arrow-right" aria-hidden="true"></i> Read more'); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
			<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
		</a>
	</div>
</article><!-- #post-## -->