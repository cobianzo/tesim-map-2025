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

<article id="post-<?php the_ID(); ?>" <?php post_class("c-news-list_item"); ?>>
	<div class="c-new-list_content">
		<figure class="imgFrame">
			<?php echo get_the_post_thumbnail( $post->ID, 'medium', array( 'class' => 'w-100' )); ?> 
    	</figure>
	    <div class="entry-meta">
			<?php /* the_date(); understrap_posted_on(); */ ?>
			<?php /* the_tags('');  echo "thePostID : ".$thePostID; echo "thisPostID : ".$thisPostID; */?> 
			<?php
				$posttags = get_the_tags();
				if ($posttags) {
					foreach($posttags as $tag) {
				    	echo $tag->name . ' ' ; 
					}
				}
				?>
		</div><!-- .entry-meta -->
		<a href="<?php the_permalink(); ?>" class="mainBtn">
		    <?php the_title( '<h4>', '</h4>' ); ?>	
		    <?php /* echo jh_get_the_excerpt(); */ ?>
		</a>
	</div>
</article><!-- #post-## -->