<?php
/**
 * The template used for displaying stories
 *
 * @package understrap
 */
 
  $thisPostID = get_the_ID();
 // Works in single post outside of the Loop
  global $wp_query;
  $thePostID = $wp_query->post->ID;
  
?>

<?php /* <article id="post-<?php the_ID(); ?>" <?php if ($thePostID == $thisPostID ) { post_class("c-news-list_item current_c-news-list_item"); } else { post_class("c-news-list_item"); } ?>> */ ?>

<article id="post-<?php the_ID(); ?>" <?php post_class("grid-item news padding15"); ?>>
	<div class="story_item_content">
		<a href="<?php the_permalink(); ?>" class="mainBtn">
			<?php the_title( '<h4>', '</h4>' ); ?>	    
			
			<div class="entry-meta">
				<?php the_terms( $post->ID, 'themes', '<i class="fa fa-tag" aria-hidden="true"></i> ', ', ', ' ' ); ?>
				<?php /* the_date(); understrap_posted_on(); */ ?>
				<?php /* the_tags('');  echo "thePostID : ".$thePostID; echo "thisPostID : ".$thisPostID; */?> 
				<br>
				<i class="fa fa-map-marker" aria-hidden="true"></i> 
				<?php
					$posttags = get_the_tags();
					if ($posttags) {
						foreach($posttags as $tag) {
					    	echo $tag->name . ' ' ; 
						}
					}
					?>
			</div><!-- .entry-meta -->
			<?php 
			    $content_arr = get_extended($post->post_content);
				echo apply_filters('the_content', $content_arr['main']); 
			?>
		</a>
	</div>
</article><!-- #post-## -->