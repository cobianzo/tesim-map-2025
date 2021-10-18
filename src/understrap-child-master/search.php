<?php
/**
 * The template for displaying search results pages.
 *
 * @package understrap
 */

get_header(); ?>
<div class="wrapper search-wrapper">
    
    <div class="container">

        <div class="row">
        
            <section id="primary" class="col-md-12 content-area">
                
                <main id="main" class="site-main" role="main">

                <?php if ( have_posts() ) : ?>
					
					<div class="media title-colLeft vSpacingT-sm">
					  <div class="media-left">
					    <svg class="media-object titleIcone iconSvg pad-both">
							<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="http://tesim-enicbc.eu/wp-content/uploads/2016/11/monitoring-evaluation.svg"></use>
						</svg>
					  </div>
					  <div class="media-body media-middle">
							<h1 class="page-title"><?php printf( __( '<span class="text-muted">Search Results for:</span> %s', 'understrap' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					</div>
					
					
					<!-- .page-header -->
					<div class="entry-content">
	                    <?php /* Start the Loop */ ?>
	                    <?php while ( have_posts() ) : the_post(); ?>
	
	                        <?php
	                        /**
	                         * Run the loop for the search to output the results.
	                         * If you want to overload this in a child theme then include a file
	                         * called content-search.php and that will be used instead.
	                         */
	                        get_template_part( 'loop-templates/content', 'search' );
	                        ?>
	
	                    <?php endwhile; ?>
					</div>
                    <?php the_posts_navigation(); ?>

                <?php else : ?>

                    <?php get_template_part( 'loop-templates/content', 'none' ); ?>

                <?php endif; ?>

                </main><!-- #main -->
                
            </section><!-- #primary -->



        </div><!-- .row -->
    
    </div><!-- Container end -->
    
</div><!-- Wrapper end -->

<?php get_footer(); ?>