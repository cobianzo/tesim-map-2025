<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package understrap

<article id="post-<?php the_ID(); ?>" <?php post_class('card card-inverse'); ?>>
		<a href="<?php the_permalink(); ?>" class="card-img-overlay">
		    <?php the_title( '<h4 class="card-title">', '</h4>' ); ?>
			
			<div class="card-text">
				<?php the_content('Read more ...'); ?>
				<?php /*  Link to the programme: <a href="<?php the_field('link'); ?>"><?php the_field('link'); ?></a> * / ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
			<?php /* edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); * / ?>
		</a>
</article><!-- #post-## --> */ ?>


<li class="<?php if( $key == $pagesNo ) echo 'current'; ?>" id="post-<?php the_ID(); ?>">
	<a href="#0">
		<?php echo get_the_post_thumbnail( $post->ID, 'small', array( 'class' => 'w-100' )); ?> 
		<div class="project-info">
			<?php the_title( '<h4>', '</h4>' ); ?>

			<?php echo  wp_trim_words( get_the_content(), 50, '...' ); /*the_content('Read more ...'); wp_strip_all_tags() */?>
			
			<?php /*  Link to the programme: <a href="<?php the_field('link'); ?>"><?php the_field('link'); ?></a> */ ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
					'after'  => '</div>',
				) );
			?>
		</div>
	</a>
</li>