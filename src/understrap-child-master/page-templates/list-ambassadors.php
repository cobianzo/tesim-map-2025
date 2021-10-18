<?php 
$id=1190; 
$post = get_post($id); 
$content = apply_filters('the_content', $post->post_content); 
$title = apply_filters('the_content', $post->post_title);
?>



<?php if ( has_post_thumbnail() && is_page('ambassadors')) : ?>
	<figure class="featuredImage">
		<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?> 
	</figure>
<?php endif; ?>


<div class="entry-title">
	<div class="media title-colLeft vSpacingT">
		<div class="media-left">
			<svg class="media-object titleIcone iconSvg pad-both">
				<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#ambassador"/>
			</svg>
		</div>
		<div class="media-body media-middle">
			<h3><?php echo $title; ?></h3>
		</div>
	</div>
	<div class="col-xs-12 title-colLeft vSpacingT-sm">
		<?php echo $content; ?>
	</div>
</div>
<div class="card-group ambassadorsCont paddingTop30">
	<div class="card-deck">
		
		<?php// is_front_page() ? $ambassadorlimit=10 : $ambassadorlimit=5 ?>
		<?php
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
	</div>
</div>





<?php if(is_front_page()): ?>
	<div class="text-xs-center marginBot30">
		<a href="<?php echo get_permalink( 1190 ); ?>" class="btn btn-outline-primary"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> View all</a>					
	</div>
<?php endif; ?>
