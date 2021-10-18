<?php
/**
 * @package understrap
 */
?>





<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<figure class="featuredImage">
		<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?> 
	</figure>
	<div class="col-sm-8">
		<div class="entry-content">
			<div class="media">
				<div class="media-left media-bottom">
					<a href="#">
						<figure class="media-object">
							<svg class="titleIcone iconSvg pad-both">
								<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#programmes"/>
							</svg>
						</figure>
					</a>
				</div>
				<div class="media-body"><div class="entry-meta">ENI CBC Programme</div>
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div>
			</div>
			<?php the_content(); ?>
	
			<?php
				$programmes_link = get_field('link');
				$remove = array("http://", "https://");
				$programmes_link_shorter = str_replace($remove, "", $programmes_link);
				if ( ! empty( $programmes_link ) ) : ?>
					Programme website <a href="<?php echo $programmes_link; ?>" class="btn btn-primary" target="_blank" ><?php echo $programmes_link_shorter; ?></a>
	        <?php endif; ?>
	
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>
	<div class="col-sm-4">
		<div class="">
			Lorem ipsum
		</div>
	</div>

	<footer class="entry-footer">
		<?php understrap_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
