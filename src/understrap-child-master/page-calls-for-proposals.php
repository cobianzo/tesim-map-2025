<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

get_header(); ?>

<div class="wrapper" id="full-width-page-wrapper">
    
    <div  id="content" class="container">
        
	   <div id="primary" class="col-md-12 content-area">

            <main id="main" class="site-main" role="main">

                <?php while ( have_posts() ) : the_post(); ?>
                
                	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="media title-colLeft vSpacingT-sm">
						  <div class="media-left">
						    <svg class="media-object titleIcone iconSvg pad-both">
								<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#callforproposal"/>
							</svg>
						  </div>
						  <div class="media-body media-middle">
								<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						  </div>
						</div>
						<br>
						<div class="entry-content">
							<?php the_content(); ?>
							<br>
							<?php
							$args = array( 'posts_per_page' => 200, 'orderby' => 'title', 'order' =>'ASC', 'post_type' => 'calls-for-proposal'				);
							$rand_posts = get_posts( $args );
							foreach ( $rand_posts as $post ) : 
							  setup_postdata( $post ); ?>
								<?php get_template_part( 'loop-templates/content', 'callsforproposals' ); ?>
							<?php endforeach; 
							wp_reset_postdata(); ?>
							
							
							<?php
								wp_link_pages( array(
									'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
									'after'  => '</div>',
								) );
							?>
							<br><br><br><br>
						</div><!-- .entry-content -->
					
						<footer class="entry-footer">
					
							<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>
					
						</footer><!-- .entry-footer -->
					
					</article><!-- #post-## -->
					

                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || get_comments_number() ) :

                            comments_template();
                        
                        endif;
                    ?>

                <?php endwhile; // end of the loop. ?>
				
            </main><!-- #main -->
           
	    </div><!-- #primary -->
        
    </div><!-- Container end -->
    
</div><!-- Wrapper end -->

<?php get_footer(); ?>
