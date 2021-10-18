
<div class="card-columns">
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
	foreach ( $rand_posts as $post ) : 
	  setup_postdata( $post ); ?>
		<?php get_template_part( 'loop-templates/content', 'programmes' ); ?>
	<?php endforeach; 
	wp_reset_postdata(); ?>
</div>