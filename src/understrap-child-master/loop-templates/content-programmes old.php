<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package understrap
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('card card-inverse'); ?>>

	    <?php echo get_the_post_thumbnail( $post->ID, 'small', array( 'class' => 'card-img w-100' )); ?> 
	    
	    <a href="<?php the_permalink(); ?>" class="card-img-overlay">
		    <?php the_title( '<h4 class="card-title">', '</h4>' ); ?>
			
			<div class="card-text">
				<?php the_content('Read more ...'); ?>
				<?php /*  Link to the programme: <a href="<?php the_field('link'); ?>"><?php the_field('link'); ?></a> */ ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
			<?php /* edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); */ ?>
		</a>
</article><!-- #post-## -->
