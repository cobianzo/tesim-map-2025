<section class="stories c-news_list_wrapper voicesCont">
	<div class="grid col-xs-12" data-colcade="columns: .grid-col, items: .grid-item">
		<div class="grid-col grid-col--1"></div>
		<div class="grid-col grid-col--2"></div>
		<div class="grid-col grid-col--3"></div>
		<div class="grid-col grid-col--4"></div>
		<?php $tools_in_taxonomy_term = km_get_tools_in_taxonomy_term(); ?>

		<!-- Loop through every post in the selected taxonomy term -->
		<?php if ( $tools_in_taxonomy_term->have_posts() ) : while ( $tools_in_taxonomy_term->have_posts() ) : $tools_in_taxonomy_term->the_post(); ?>
				<?php get_template_part( 'loop-templates/content', 'measonry-voices' ); ?>
			<?php endwhile; ?>
		<?php else: ?>
		
			<?php if (is_page('voices-from-the-field') || is_single() ) { $jhlimitpost = 20; } else { $jhlimitpost = 4; } ; ?>
			<?php
				$args = array( 'posts_per_page' => $jhlimitpost, 'order'=> 'DESC', 'category_name' => 'voices' );
				$postslist = get_posts( $args );
				foreach ( $postslist as $post ) :
				  setup_postdata( $post ); ?> 
					<?php get_template_part( 'loop-templates/content', 'measonry-voices' ); ?>
				<?php 
				endforeach; 
				wp_reset_postdata();
			?>		
		<?php endif; ?>
	</div>
	<?php wp_reset_postdata(); ?>
	<?php
		// On récupère la liste des post et de leurs tags associés pour les afficher dans le dropdown
		if (is_page('stories-v2')) { 
			$jhlimitpost = 20; 
		} else { 
			$jhlimitpost = 6; 
		} 
		if (is_page('stories-v2')) { 
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
