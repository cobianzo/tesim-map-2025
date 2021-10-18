<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

get_header(); ?>
<div class="wrapper noPadding" >
    
    <div class="container-fluid">

        <div class="row">
        
	        <div class="c-news_list">
		        <header class="c-news-list_header">
			        
			        <div class="media title-colLeft">
					  <div class="media-left">
					    <svg class="media-object titleIcone iconSvg pad-both">
							<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#events"/>
						</svg>
					  </div>
					  <div class="media-body media-middle">
					    <h3><span class="text-muted">ENI CBC</span> Events</h3>
					  </div>
					</div>		        
		        </header>
		        <section class="c-news_list_wrapper hidden-md-down" id="em-wrapper">		       
			        <?php echo EM_Events::output(array( 'limit'=>30, 'pagination'=>0)); ?>
			        <?php /*
						$args = array( 'posts_per_page' => 100, 'post_type' => 'event', 'order'=> 'DESC');
						$postslist = get_posts( $args );
						
						foreach ( $postslist as $post ) :
						  setup_postdata( $post ); ?>
							<?php get_template_part( 'loop-templates/content', 'event-short' ); ?>
						<?php
						endforeach; 
						wp_reset_postdata();
					 */ ?>
			        
			        
			        <?php /*
				     	//global $wp_query;
					 	//$thePostID = $wp_query->post->ID;
					 	global $thePostID;
					 	$thePostID = get_queried_object_id();
						//echo("thePostID : ".$thePostID);    
				        echo do_shortcode('[ajax_load_more post_type="post" category="news" scroll_distance="0" transition="fade"]'); */ ?>
	
		        </section>
		        
	        </div>
			<section  class="c-news_block" id="primary">

                    <?php while ( have_posts() ) : the_post(); ?>
                        
                        <?php get_template_part( 'loop-templates/content', 'stories-single' ); ?>
						
                                               
	                        <?php /*
	                        // If comments are open or we have at least one comment, load up the comment template
	                        if ( comments_open() || get_comments_number() ) :
	                            comments_template();
	                        endif;
	                        */ ?>

                        
                        
                       <?php /*
	                       <div class="post_navigation_cont"> 
			                <h5 class="text-muted">Continue Reading</h5>
			                <?php the_post_navigation( array(
					            'prev_text'                  => __( '<i class="fa fa-long-arrow-left" aria-hidden="true"></i><br>%title' ),
					            'next_text'                  => __( '<i class="fa fa-long-arrow-right" aria-hidden="true"></i><br>%title' ),
					            'in_same_term'               => true,
					            //'taxonomy'                 => __( 'post_tag' ),
					            'screen_reader_text' => __( 'Continue Reading' ),
					        ) );  ?>
			            </div>
                        */ ?>
                    <?php endwhile; // end of the loop. ?>

			</section>



        </div><!-- .row -->
        
    </div><!-- Container end -->
    
</div><!-- Wrapper end -->

<?php get_footer(); ?>
