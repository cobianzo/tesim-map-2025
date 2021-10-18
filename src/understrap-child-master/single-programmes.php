<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

get_header(); ?>
<div class="wrapper noPadding" id="single-wrapper">
    
    <div id="primary" class="container-fluid noPadding">

        <div class="row">
        
                <?php while ( have_posts() ) : the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class('col-sm-12'); ?>>
						<div style="background-color: #f9e4ea">
							<figure class="featuredImage">
								<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?> 
							</figure>
						</div>
						<div class="col-xs-12 col-md-8 col-lg-8" style="z-index: 2;">
							<div class="entry-content">
								<div class="media">
									<div class="media-left media-top">
										<a href="#">
											<figure class="media-object paddingTop10">
												<svg class="titleIcone iconSvg pad-both">
													<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#proj-support"/>
												</svg>
											</figure>
										</a>
									</div>
									<div class="media-body">
										<div class="entry-meta">ENI CBC Programme</div>
										<div class="entry-header"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></div>
									</div>
								</div>
								
								<?php the_content(); ?>
						
								<p class="text-xs-center">
									<small class="text-muted">Visit the programme website</small><br>
									<?php
										$programmes_link = get_field('link');
										$remove = array("http://", "https://");
										$programmes_link_shorter = str_replace($remove, "", $programmes_link);
										if ( ! empty( $programmes_link ) ) : ?>
											<a href="<?php echo $programmes_link; ?>" class="btn btn-outline-primary" target="_blank" ><?php echo $programmes_link_shorter; ?></a>
							        <?php endif; ?>
								</p>
								<?php
									wp_link_pages( array(
										'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
										'after'  => '</div>',
									) );
								?>
							</div><!-- .entry-content -->
						</div>
						<div class="col-xs-12 col-md-4" style="z-index: 1;">
							<div class="">
								<?php 
									$terms = get_field('programme_tag_relationship');
									$programme_tag_relationship_ids = array();
									foreach ( $terms as $term ) {
									    // We successfully got a link. Print it out.
									    //echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->term_id . ' - ' . $term->slug . '</a></li>';
									    $programme_tag_relationship_ids[] = $term->slug;
									} ?>

								<aside class="sideNews">
									<?php 
		
									$map = get_field('programme_map');
									
									if( !empty($map) ): ?>
										<a href="<?php echo $map['url']; ?>" data-rel="lightbox-gallery-0" class="mapLink">
											<span class="overlay"><i class="fa fa-lg fa-search" aria-hidden="true"></i></span>
											<img src="<?php echo $map['url']; ?>" alt="<?php echo $map['alt']; ?>" />
										</a>
									<?php endif; ?>
									<?php
										$args = array( 
											'posts_per_page' => 5,
											'category' => 4,
											'tax_query' => array( 
												array(
													'taxonomy' => 'post_tag',
													'field' => 'slug',
													'terms' => $programme_tag_relationship_ids
												)
											)
										);
										$myposts = get_posts( $args );
										if( ! empty( $myposts) ) : ?>
											<h5><?php /* the_title(); */ ?> Related News</h5>
										<?php endif; ?>
									
										<?php foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
				
											<?php get_template_part( 'loop-templates/content', 'news-short' ); ?>
									
										<?php endforeach; 
										wp_reset_postdata();
									?>
									
									<?php /* echo do_shortcode( '[events_list_grouped mode="monthly"]#_EVENTLINK - #_EVENTDATES at #_EVENTTIMES<br />[/events_list_grouped]' ); */?>
																		
									<?php 
										if (class_exists('EM_Events')) {
											    echo EM_Events::output( array('limit'=>10,'orderby'=>'name','tag'=>$programme_tag_relationship_ids) );
											}
									?>
								</aside>
							</div>
						</div>
					
						<footer class="entry-footer">
							<?php understrap_entry_footer(); ?>
						</footer><!-- .entry-footer -->
					</article><!-- #post-## -->

					<?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    ?>                    
                <?php endwhile; // end of the loop. ?>
				
            </div>  
        </div><!-- .row -->
        
    <div class="container-fluid noPadding">
	    <section class="stories ">	
			<?php
			$args = array(
				'posts_per_page' => 4,
				'offset' => 0,
				'category' => 5,
				'tax_query' => array(
					array(
						'taxonomy' => 'post_tag',
						'field' => 'slug',
						'terms' =>  $programme_tag_relationship_ids 
					)
				)
			);
			
			$myposts = get_posts( $args );
			if( ! empty( $myposts) ) : ?>
				<div class="col-xs-12 title-colLeft"><h5><?php /* the_title(); */?>Stories from the <?php the_tags(''); ?> Programme</h5></div>
				
				<div class="storiesInline c-news_list_wrapper">
					<?php foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
						<?php get_template_part( 'loop-templates/content', 'stories-sidelist' ); ?>
					<?php endforeach; 
					wp_reset_postdata();?>					
				</div>
			<?php endif; ?>
			
		</section>
    </div>    

	<div class="container-fluid noPadding">
	    <section class="faces ">
		    <div class="col-xs-12 title-colLeft"><h5>Voices from the <?php the_tags(''); ?> Programme</h5></div>
		    <div class="col-xs-12 vSpacingT-sm">
		    <?php
				$blogusers = get_users( 'blog_id=1&orderby=rand&role=ambassador&number=100' ) ;
				$arr_users = (array)$blogusers;
				//array_rand($arr_users, 4);
				//shuffle($arr_users);	
				// Array of WP_User objects.
				foreach ( $arr_users as $user ) {
					$lnk = $root . '/author/' . $user->user_nicename;
					$name = $user->user_firstname;
					$ambassador_position = get_field('ambassador_position', 'user_'. $user->ID );
					$ambassador_country = get_field_object('ambassador_country', 'user_'. $user->ID );
					$value = $ambassador_country['value'];
				    $ambassador_country_value = $ambassador_country['choices'][ $value ];
				    $ambassador_programme_values = get_field('programme', 'user_'.$user->ID );
					//$bio = $user->user_description;
					$bio = get_field('ambassador_biography_short', 'user_'. $user->ID);
					$image = get_field('profile_picture', 'user_'.$user->ID);
					$thumb = $image['sizes'][ 'thumbnail' ];
					if ($ambassador_programme_values) {
						foreach ( $ambassador_programme_values as $term ) {
							$string = $term->name;
							if( preg_match("(".implode("|",array_map("preg_quote",$programme_tag_relationship_ids)).")i",$string,$m)) {
								
								echo '<div class="col-xs-12 col-sm-6 col-md-3 text-xs-center" style="height:375px;">';
								echo 	'<a href="' . $lnk . '" title="' . $name . '" class="card-img-top">';
								echo 		'<img src="' . $thumb . '" alt="' . $name . '" class="rounded-circle">';
							    echo 	'</a>';
							    echo 	'<div class="card-block">';						    
								echo 		'<a href="' . $lnk . '" title="' . $name . '" class="underLining">';
								echo 			'<h5 class="card-title">' . esc_html( $user->display_name ) . '</h5>';
							    echo 		'</a>';
								//echo 		'<br><span class="entry-meta">' . $term->name . '</span>';
								echo 		'<br><span class="entry-meta">' . $ambassador_country_value . '</span>';				
								echo 		'<div class="author-bio-sm">' . $bio . '</div>';
								echo 	'</div>';							
								echo '</div>';
							}
						}
					};
				}
			?>
		    </div>
		</section>
    </div>  

    
	<div class="container-fluid noPadding  bgLightGray">
		<div class="col-xs-12 vSpacing text-xs-center">	
		<!-- <h4 class="paddingTop30">Other ENI CBC Programmes</h4> -->
			<div class="cd-intro-block">
				<a href="#collapseProgrammes" id="scrollToProgBtn" class="btn btn-outline-primary" data-action="show-projects" data-toggle="collapse" aria-expanded="false" aria-controls="collapseProgrammes">
					<i class="fa fa-long-arrow-right" aria-hidden="true"></i> View other programmes
				</a>
			</div>
		</div>
	</div>
	<div class="collapse" id="collapseProgrammes">
		<?php get_template_part( 'page-templates/list', 'programmes-carousel' ); ?>
	</div>
</div><!-- Wrapper end -->

<?php get_footer(); ?>
