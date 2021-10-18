<section class="stories">
    <div class="card-columns">
		<?php
		//$args = array( 'posts_per_page' => 10, 'order'=> 'ASC' );
		$args = array( 'posts_per_page' => 10, 'order'=> 'ASC', 'category_name'    => 'stories' );
		$postslist = get_posts( $args );
		foreach ( $postslist as $post ) :
		  setup_postdata( $post ); ?> 
			<?php get_template_part( 'loop-templates/content', 'stories' ); ?>
		<?php
		endforeach; 
		wp_reset_postdata();
		?>
    </div>
</section>