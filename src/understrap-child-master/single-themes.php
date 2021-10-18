<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

get_header(); ?>
<div class="wrapper noPadding" >
    
    <div class="container-fluid">

        <div class=" row listAndDetailTemplate"> <?php /*   */ ?>
	        
	        <div class="c-news_list">
		        <header class="hidden-md-down c-news-list_header">
			        
			        <div class="media title-colLeft ">
					  <div class="media-left">
					    <svg class="media-object titleIcone iconSvg pad-both">
							<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#stories"/>
						</svg>
					  </div>
					  <div class="media-body media-middle">
					    <h3><span class="text-muted">ENI CBC</span> themes</h3>
					  </div>
					</div>		        
		        </header>
		        <section class="c-news_list_wrapper " id="em-wrapper">
			        
			        <?php /*
						$args = array( 'posts_per_page' => 4, 'order'=> 'ASC', 'category_name'  => 'stories' );
						$postslist = get_posts( $args );
						
						foreach ( $postslist as $post ) :
						  setup_postdata( $post ); ?>
							<?php get_template_part( 'loop-templates/content', 'stories-sidelist' ); ?>
						<?php
						endforeach; 
						wp_reset_postdata();
						*/
					 ?>
			        
			        <?php 
				     	$_SESSION['thePageStoryID'] =  get_queried_object_id();  
				        echo do_shortcode('[ajax_load_more post_type="post" repeater="template_2" posts_per_page="7" category="stories" scroll_distance="0" transition="fade"]'); ?>
	
		        </section>
		        
	        </div>
	        <section  class="c-news_block" id="primary">
		        <header class="hidden-lg-up c-news-list_header">
			        
			        <div class="media title-colLeft ">
					  <div class="media-left">
					    <svg class="media-object titleIcone iconSvg pad-both">
							<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#stories"/>
						</svg>
					  </div>
					  <div class="media-body media-middle">
					    <h3><span class="text-muted">ENI CBC</span> Stories</h3>
					  </div>
					</div>		        
		        </header>      
		        <?php while ( have_posts() ) : the_post(); ?>
	
	                <?php get_template_part( 'loop-templates/content', 'stories-single' ); ?>
	                    <?php if (is_singular('stories')) : ?>   
		                <?php
		                // If comments are open or we have at least one comment, load up the comment template
		                if ( comments_open() || get_comments_number() ) :?>
								
				                <?php comments_template(); ?>
		
		                <?php endif; ?>
	                <?php endif; ?>
	                <div class="post_navigation_cont"> 
		                <h5 class="text-muted">Continue Reading</h5>
		                <div class="hidden-md-down">
			                <?php the_post_navigation( array(
					            'prev_text'                  => __( '%title<br><i class="fa fa-long-arrow-left translateFaIcon" aria-hidden="true"></i>' ),
					            'next_text'                  => __( '%title<br><i class="fa fa-long-arrow-right translateFaIcon" aria-hidden="true"></i>' ),
					            'in_same_term'               => true,
					            //'taxonomy'                   => __( 'post_tag' ),
					            'screen_reader_text' => __( 'Continue Reading' ),
					        ) );  ?>
		                </div>
	                </div>	
	
	                
	            <?php endwhile; // end of the loop. ?>
	
	        </section>



        </div><!-- .row -->
        
    </div><!-- Container end -->
    
</div><!-- Wrapper end -->
<?php wp_footer(); ?>
<?php /* get_footer(); */ ?>
