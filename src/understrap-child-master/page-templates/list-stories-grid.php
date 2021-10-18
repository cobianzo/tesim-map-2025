<section class="stories storiesInline c-news_list_wrapper">
	<?php $tools_in_taxonomy_term = km_get_tools_in_taxonomy_term(); ?>

	<!-- Loop through every post in the selected taxonomy term -->
	<?php if ( $tools_in_taxonomy_term->have_posts() ) : while ( $tools_in_taxonomy_term->have_posts() ) : $tools_in_taxonomy_term->the_post(); ?>
		
			<?php get_template_part( 'loop-templates/content', 'stories-sidelist' ); ?>
		
		<?php endwhile; ?>
	
	<?php else: ?>
	
		<?php if (is_page('stories')) { $jhlimitpost = 20; } else { $jhlimitpost = 6; } ; ?>
			<?php
				$args = array( 'posts_per_page' => $jhlimitpost, 'order'=> 'DESC', 'category_name' => 'stories' );
				$postslist = get_posts( $args );
				foreach ( $postslist as $post ) :
				  setup_postdata( $post ); ?> 
					<?php get_template_part( 'loop-templates/content', 'stories-sidelist' ); ?>
				<?php
				endforeach; 
				wp_reset_postdata();
			?>

		<?php endif; ?>

	<?php wp_reset_postdata(); ?>
	<?php
		// On récupère la liste des post et de leurs tags associés pour les afficher dans le dropdown
		if (is_page('stories')) { 
			$jhlimitpost = 20; 
		} else { 
			$jhlimitpost = 6; 
		} 
		if (is_page('stories')) { 
			echo "<span data-tag='all-programs' data-url='{$sanitized_tag}' data-name='All Programmes' class='taglistdropdow'></span>";
		}
		$args = array( 'posts_per_page' => $jhlimitpost, 'order'=> 'DESC', 'category_name' => 'stories' );
		$postslist = get_posts( $args );
		
		foreach ( $postslist as $post ) {
			$posttags = get_the_tags();
			if ($posttags or $_GET['post_tag']) {
				$sanitized_tag = esc_attr($_GET['post_tag']?:"all-programs"); 
				foreach($posttags as $tag) {
					echo "<span data-tag='{$tag->slug}' data-url='{$sanitized_tag}' data-name='{$tag->name}' class='taglistdropdow'></span>";
				}
			}	
		}
	?>
</section>
