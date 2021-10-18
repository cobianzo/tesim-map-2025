<div class="ListLinkSm">
    <h3>Other programmes and partnerships</h3>
    <p class="text-muted">In this section, you will find information and links to other programmes and structures relevant to ENI CBC.</p>
    <div class="twoCol"><?php echo get_field('other_programmes_and_partnerships', 43); ?></div>
</div> 



<?php // Used to query custom post type Programme tagged as other 
/*
<ul class="listBigLink twoCol">
	<?php
	$args = array( 'posts_per_page' => 5, 'orderby' => 'rand', 'post_type' => 'programmes', 'cat-programmes' => 'other' );
	$rand_posts = get_posts( $args );
	foreach ( $rand_posts as $post ) : 
	  setup_postdata( $post ); ?>
		<li><a href="<?php /* the_permalink(); * / ?>" class="underLining"><?php the_title(); ?></a></li>
	<?php endforeach; 
	wp_reset_postdata(); ?>
</ul>

/* ?>