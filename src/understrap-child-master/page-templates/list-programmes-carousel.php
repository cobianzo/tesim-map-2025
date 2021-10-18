<?php /*
<div class="card-columns">
	<?php
	$args = array( 'posts_per_page' => 10, 'orderby' => 'rand', 'post_type' => 'programmes', 'tax_query' => array(
            array(
            'taxonomy' => 'cat-programmes',
            'field' => 'id',
            'terms' => 8,
            'operator' => 'NOT IN',
            ),
        )
	);
	$rand_posts = get_posts( $args );
	foreach ( $rand_posts as $post ) : 
	  setup_postdata( $post ); ?>
		<?php get_template_part( 'loop-templates/content', 'programmes' ); ?>
	<?php endforeach; 
	wp_reset_postdata(); ?>
</div>

*/ ?>

<div class="cd-projects-wrapper">
	<ul class="cd-slider">
	<?php
		$args = array( 'posts_per_page' => 20, 'orderby' => 'rand', 'post_type' => 'programmes', 'tax_query' => array(
	            array(
		            'taxonomy' => 'cat-programmes',
		            'field' => 'id',
		            'terms' => 8,
		            'operator' => 'NOT IN',
	            ),
	        )
		);
		$rand_posts = get_posts( $args );
		$i=1;
		foreach ( $rand_posts as $post ) : 
		  setup_postdata( $post ); ?>
		  
		  	<?php if($i==1) : /* --- Adds CURRENT class to first item --- */ ?>
				<li class="current" id="post-<?php the_ID(); ?>">
					<a href="<?php the_permalink(); ?>">
						<figure>
							<?php echo get_the_post_thumbnail( $post->ID, 'medium', array( 'class' => 'hello' )); ?> 
						</figure>
						<div class="project-info">
							<?php the_title( '<h4>', '</h4>' ); ?>
							<p><?php
								echo wp_trim_words( get_the_content(), 9, '...' );
							?></p>
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
			<?php else : ?>
                <li class="" id="post-<?php the_ID(); ?>">
				<a href="<?php the_permalink(); ?>">
					<figure>
						<?php echo get_the_post_thumbnail( $post->ID, 'medium', array( 'class' => 'hello' )); ?> 
					</figure>
					<div class="project-info">
						<?php the_title( '<h4>', '</h4>' ); ?>
						<p><?php
							echo wp_trim_words( get_the_content(), 9, '...' );
						?></p>
						<?php /* the_content(''); ?>
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
            <?php endif; ?>
			<?php 
			$i++;
		endforeach; 
		wp_reset_postdata(); ?>

	</ul>

	<ul class="cd-slider-navigation cd-img-replace">
		<li><a href="#0" class="prev inactive">Prev</a></li>
		<li><a href="#0" class="next">Next</a></li>
	</ul> <!-- .cd-slider-navigation -->
</div> <!-- .cd-projects-wrapper -->

<?php /*
<div class="cd-project-content">
	<div>
<!--
		<h2>Project title here</h2>
		<em>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt, ullam.</em>
		<p>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum praesentium officia, fugit recusandae ipsa, quia velit nulla adipisci? Consequuntur aspernatur at, eaque hic repellendus sit dicta consequatur quae, ut harum ipsam molestias maxime non nisi reiciendis eligendi! Doloremque quia pariatur harum ea amet quibusdam quisquam, quae, temporibus dolores porro doloribus. 
		</p>
		<p>
			Illum quaerat asperiores aliquam voluptate saepe omnis porro excepturi in atque veritatis sapiente ipsam voluptates iste amet deserunt ullam error pariatur, magni consectetur optio nostrum minima dolorum. Soluta animi nihil doloremque ipsa incidunt vitae architecto beatae, maxime libero, dolore corporis vero porro tenetur ipsam modi repudiandae magnam enim, quibusdam sit.
		</p>
		<p>
			Illum quaerat asperiores aliquam voluptate saepe omnis porro excepturi in atque veritatis sapiente ipsam voluptates iste amet deserunt ullam error pariatur, magni consectetur optio nostrum minima dolorum. Soluta animi nihil doloremque ipsa incidunt vitae architecto beatae, maxime libero, dolore corporis vero porro tenetur ipsam modi repudiandae magnam enim, quibusdam sit.
		</p>
-->
	</div>
	<a href="#0" class="close cd-img-replace">Close</a>
</div> <!-- .cd-project-content -->

*/ ?>