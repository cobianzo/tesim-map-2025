<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

get_header(); ?>

<div class="wrapper" id="archive-wrapper">
	<div class="hearder-imageBanner <?php if(is_tax( 'themes', 'infrastructure' )): ?>bg-infrastructure<?php elseif(is_tax( 'themes', 'economic-development' )): ?>bg-economic<?php elseif(is_tax( 'themes', 'environment' )): ?>bg-environment<?php elseif(is_tax( 'themes', 'people-to-people' )): ?>bg-people<?php endif; ?>">
		<div class="container">
			<header class="page-header">
                <?php single_term_title( '<h1 class="page-title paddingTop30"><i class="fa fa-tag thePurpleLight" aria-hidden="true"></i> ', '</h1>' ); ?>
            </header><!-- .page-header -->
            
			<div class=""><?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?></div>
		</div>
	</div>
	<div  id="content" class="container">

        <div class="row">
        
    	    <div id="primary" class="col-md-12 content-area">
               
	            <main id="main" class="site-main " role="main">

	                      <?php if ( have_posts() ) : ?>
	
	                        
							<section class="stories c-news_list_wrapper voicesCont">
								<div class="grid col-xs-12" data-colcade="columns: .grid-col, items: .grid-item">
									<div class="grid-col grid-col--1"></div>
									<div class="grid-col grid-col--2"></div>
									<div class="grid-col grid-col--3"></div>
									<div class="grid-col grid-col--4"></div>
							
	                        <?php /* Start the Loop */ ?>
	                        <?php while ( have_posts() ) : the_post(); ?>
								<?php if ( in_category('voices') ) {
								    get_template_part( 'loop-templates/content', 'measonry-voices' );
								} elseif ( in_category('news') ) {
								    get_template_part( 'loop-templates/content', 'measonry-news' );
								} else {
								    get_template_part( 'loop-templates/content', 'measonry-stories' );
								} ?>
	                            
	                        <?php endwhile; ?>
	
	                            <?php the_posts_navigation(); ?>
	
	                        <?php else : ?>
	
	                            <?php get_template_part( 'loop-templates/content', 'none' ); ?>
	
	                        <?php endif; ?>
								</div>
							</section>
	
	            </main><!-- #main -->
               
    	    </div><!-- #primary -->

		</div> <!-- .row -->
        
    </div><!-- Container end -->
    
</div><!-- Wrapper end -->

<?php get_footer(); ?>
