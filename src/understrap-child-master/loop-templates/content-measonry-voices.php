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
<?php 
	$voice_title = get_field('voice_title' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class("grid-item text-xs-center"); ?> >
		<a href="<?php the_permalink(); ?>" class="card-img-top ">
			<?php if ( in_category('interview') ) {
			    echo 	'<aside><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-comments-o fa-stack-1x fa-inverse"></i></span></aside>';
			} elseif ( in_category('quote') ) {
			    echo 	'<aside><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-quote-right fa-stack-1x fa-inverse"></i></span></aside>';	
			} elseif ( in_category('video') ) {
			    echo 	'<aside><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-video-camera fa-stack-1x fa-inverse"></i></span></aside>';
			} ?>

			<?php echo get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'class' => 'rounded-circle' )); ?>
			<div class="card-block">
				<div class="entry-meta">

					<?php 
						$terms = get_the_terms( $post->ID , array( 'themes') );
						// init counter
						$i = 1;
						foreach ( $terms as $term ) {
						 	$term_link = get_term_link( $term, array( 'teams_positions') );
						 	if( is_wp_error( $term_link ) )
						 	continue;
						 	//  Add comma (except after the last theme)
						 	echo ($i < count($terms))? ", " : '<i class="fa fa-tag" aria-hidden="true"></i> ';
						 	echo $term->name;
						 	// Increment counter
						 	$i++;
						}
					?>
				</div>
				<div class="card-title"><p><?php echo $voice_title ?></p></div>
				<?php the_title( '<span class="entry-meta">', '</span>' ); ?>	
				<span class="entry-meta">
					<?php /* 
					<i class="fa fa-map-marker" aria-hidden="true"></i> <?php the_field('voice_country'); ?>
					 */?> 
					<?php
						$posttags = get_the_tags();
						if ($posttags) {
						  foreach($posttags as $tag) {
						    echo $tag->name . ' '; 
						  }
						}
						?>
				</span><!-- .entry-meta -->
			</div>
		</a>
</article><!-- #post-## -->





<?php /*
			//$ambassadorlimit = if(is_home())
			//$blogusers = is_front_page() ? get_users( 'blog_id=1&orderby=rand&role=ambassador&number=4' ) : get_users( 'blog_id=1&orderby=id&order=desc&order=desc&role=ambassador&number=100' ) ;
			$blogusers = is_front_page() ? get_users( 'blog_id=1&orderby=id&order=desc&role=ambassador&number=4' ) : get_users( 'blog_id=1&orderby=id&order=desc&order=desc&role=ambassador&number=100' ) ;
			$arr_users = (array)$blogusers;
			//array_rand($arr_users, 4);
			//shuffle($arr_users);	
			// Array of WP_User objects.
			foreach ( $arr_users as $user ) {
				$lnk = $root . '/author/' . $user->user_nicename;
				$name = $user->user_firstname;
				$ambassador_position = get_field('ambassador_position', 'user_'. $user->ID );
				$ambassador_country = get_field_object('ambassador_country', 'user_'. $user->ID );
				$ambassador_title = get_field('ambassador_title', 'user_'. $user->ID );
				$value = $ambassador_country['value'];
			    $ambassador_country_value = $ambassador_country['choices'][ $value ];
			    $ambassador_programme_values = get_field('programme', 'user_'.$user->ID );
				//$bio = $user->user_description;
				$bio = get_field('ambassador_biography_short', 'user_'. $user->ID);
				$image = get_field('profile_picture', 'user_'.$user->ID);
				$thumb = $image['sizes'][ 'thumbnail' ];
			    echo '<div class="col-xs-12 col-sm-6 col-md-3 text-xs-center" style="height:375px;">';
				echo 	'<a href="' . $lnk . '" title="' . $name . '" class="card-img-top">';
				
				
				if( get_field('ambassador_format', 'user_'.$user->ID) == 'Interview' ) {
					echo 	'<aside><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-comments-o fa-stack-1x fa-inverse"></i></span></aside>';
				} elseif ( get_field('ambassador_format', 'user_'.$user->ID) == 'Quote' ) {
					echo 	'<aside><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-quote-right fa-stack-1x fa-inverse"></i></span></aside>';	
				} elseif ( get_field('ambassador_format', 'user_'.$user->ID) == 'Video' ) {
					echo 	'<aside><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-video-camera fa-stack-1x fa-inverse"></i></span></aside>';
				};
				echo 		'<img src="' . $thumb . '" alt="' . $name . '" class="rounded-circle">';
			    echo 		'<div class="card-block">';
			    if ($ambassador_title) {
					echo 		'<div class="card-title">' . $ambassador_title . '</div>';
				} else {
					echo 		'<div class="card-title">' . $bio . '</div>';
				};
				echo 			'<span class="entry-meta">' . esc_html( $user->display_name ) . '</span><br>';
				if ($ambassador_programme_values) {
					foreach ( $ambassador_programme_values as $term ) {
						echo 	'<span class="entry-meta-lowercase">' . $term->name . '</span>';
					}
				} else {
						echo 	'<span class="entry-meta-lowercase">' . $ambassador_country_value . '</span>';
				};
				echo 			'<br>';
//				echo 			'<div class="author-bio-sm">' . $bio . '</div>';
//				echo 			'<p>' . $bio . '</p>';
//				echo 			'<a href="mailto:' . esc_html( $user->user_email ) . '">' . esc_html( $user->user_email ) . '</a>';
				echo 		'</div>';
				echo 	'</a>';						
				echo '</div>';
			} ?>