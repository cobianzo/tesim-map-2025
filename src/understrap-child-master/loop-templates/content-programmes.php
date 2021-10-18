<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package understrap


col-xs-12 col-sm-6 col-md-4 col-xl-3 noPadding

 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class('card card-programme '); ?>>
	<a href="<?php the_permalink(); ?>" >
		<figure class="imgFrame">
		    <?php echo get_the_post_thumbnail( $post->ID, 'medium', array( 'class' => 'card-img-top' )); ?> 
		</figure>
	    <div class="card-block"> 
		    
		    <?php the_title( '<h4 class="card-title">', '</h4>' ); ?>

<p><?php
								echo wp_trim_words( get_the_content(), 9, '...' );
							?></p>

			<?php /* <div class="card-text">
				<?php the_content(); ?>	
			</div><!-- .entry-content --> */ ?>
	    </div>	
	</a>			
</article><!-- #post-## -->
