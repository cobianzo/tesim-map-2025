<div class="home-news">
	
	<section class="c-news_block js-newsblock-click">	
		<?php
			$args = array( 'posts_per_page' => 1, 'order'=> 'DESC', 'category_name'  => 'news' );
			$postslist = get_posts( $args );
			
			foreach ( $postslist as $post ) :
			  setup_postdata( $post ); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('noPadding'); ?>>
					<div>
						<?php if ( has_post_thumbnail() ) : ?>
							<figure class="featuredImage">
								<?php echo get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'card-img-top' ) ); ?> 
							</figure>
						<?php endif; ?>
					    <div class="home-featured-news-content">
						    <div class="entry-meta"><?php the_date(); ?> - <?php
								$posttags = get_the_tags();
								if ($posttags) {
								  foreach($posttags as $tag) {
								    echo $tag->name . ' '; 
								  }
								}
								?></div>
						    
						    <?php the_title( '<h4 class="card-title">', '</h4>' ); ?>
							
							<div class="">
								<?php the_content('<i class="fa fa-long-arrow-right" aria-hidden="true"></i>' ); ?>
							</div><!-- .entry-content -->
				
							<?php /* edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); */?>
						</div>
					</div>
				</article><!-- #post-## -->
			<?php
			endforeach; 
			wp_reset_postdata();
		 ?>	</section>

	<div class="home-news-list">
		<section class="c-news_list_wrapper " id="em-wrapper">		       
				        
	    <?php
			$args = array( 'posts_per_page' => 3, 'order'=> 'DESC', 'category_name'  => 'news', 'offset'=> '1' );
			$postslist = get_posts( $args );
			
			foreach ( $postslist as $post ) :
			  setup_postdata( $post ); ?>
				<?php get_template_part( 'loop-templates/content', 'news-short' ); ?>
			<?php
			endforeach; 
			wp_reset_postdata();
		 ?>
	    
		</section>
	</div>


</div>

<?php /* 
<section class="news">
    <div class="clearfix">
		<?php
		// $args = array( 'posts_per_page' => 10, 'order'=> 'ASC' );
		$args = array( 'posts_per_page' => 10, 'order'=> 'DESC', 'category_name'    => 'news' );
		$postslist = get_posts( $args );
		$isFirst = true;
		$i=1;
		foreach ( $postslist as $post ) :
		setup_postdata( $post ); 
		if($i==1) {
        	echo '<div class="col-sm-6 push-sm-6">';
        	echo get_template_part( 'loop-templates/content', 'news-card' );
        	echo '</div>';
		} else {
        	echo '<div class="col-sm-6 pull-sm-6 noPaddingL">';			
        	echo get_template_part( 'loop-templates/content', 'news-short' );
        	echo '</div>';
		}
        $i++;
		endforeach;
		wp_reset_postdata();
		?>
    </div>
</section> */ ?>