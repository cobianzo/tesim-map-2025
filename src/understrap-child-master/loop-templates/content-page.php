<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package understrap
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		
	<?php if (is_page("137") or is_page("2124")): ?>
	
		<div class="media title-colLeft vSpacingT-sm">
		  <div class="media-left">
		    <svg class="media-object titleIcone iconSvg pad-both">
				<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#events"/>
			</svg>
		  </div>
		  <div class="media-body media-middle">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		  </div>
		</div>
	<?php elseif (is_page("1823")): ?>
		<div class="media title-colLeft vSpacingT-sm">
		  <div class="media-left">
		    <svg class="media-object titleIcone iconSvg pad-both">
				<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#library"/>
			</svg>
		  </div>
		  <div class="media-body media-middle">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		  </div>
		</div>
		<br><br>	
	<?php else: ?>
		<div class="media title-colLeft vSpacing-sm">
		  <div class="media-body media-middle">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		  </div>
		</div>
	<?php endif; ?>
	
	
	

	

     <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?> 
    
	<div class="entry-content">

		<?php the_content(); ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->
	

</article><!-- #post-## -->
