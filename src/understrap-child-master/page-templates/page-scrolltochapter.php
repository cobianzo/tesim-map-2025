<?php
/**
 * Template Name: Scroll to Chapter
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published
 *
 * @package understrap
 */

get_header(); ?>


<?php get_header(); ?>

    <div class="wrapper scrollToChapter" id="primary">
    
    <div  id="content" class="container-fluid">

        <div class="row">
	
	    <?php while ( have_posts() ) : the_post(); ?>
			<?php if (is_page("25")): ?>
			    <div class="container-fluid colophon">
				   <div class="row">
						<div class="col-md-5 col-lg-6 colophon-map noPadding">
						   <?php echo get_the_post_thumbnail( 17, 'large' ); ?>
						   		<aside><p><i class="fa fa-square theBlue" aria-hidden="true"></i> Over 30 EU member states and neighbouring countries</p><p><i class="fa fa-square theBlue" aria-hidden="true"></i> Thousands of km of land and sea borders</p><p><i class="fa fa-square theBlue" aria-hidden="true"></i> €1 billion</p></aside>
						</div>
						<div class="col-md-7 col-lg-6 jumbo-secondary">
							<?php /* <small><?php echo get_field('subtitle'); ?><br><br></small>*/ ?>
							<div class="lead"><?php echo get_field('lead_paragraphe'); ?></div>
						</div>
				   </div>
			    </div>
			<?php endif; ?>
	
			<?php /*<div class="col-xs-12">
				<header class="entry-header">
						<?php /* <div class="entry-meta">Support to programmes &amp; projects</div> * / ?>
						<?php the_title( '<h1>', '</h1>' ); ?>
					</header><!-- .entry-header -->
			</div>	*/ ?>
			<div class="col-xs-12 col-sm-3 chapterNav-area">
				<div data-spy="affix" data-offset-top="<?php if (is_page("32")): ?>150<?php elseif (is_page("34")): ?>150<?php elseif (is_page("25")): ?>420<?php endif; ?>" data-offset-bottom="400" style="margin-top: 15px;"  id="chapter-navbar">
					
					<ul class="nav nav-pills nav-stacked">
						<?php if (is_page("32")): ?>
							<li class="nav-item"><a href="<?php echo get_page_link(25)?>" class="nav-link text-uppercase">Programme support</a></li>
							<li class="nav-item"><a href="#prog-mgmt" class="nav-link nav-link-sub active page-scroll">Programme Management</a></li>
							<li class="nav-item"><a href="#financial-mgmt" class="nav-link nav-link-sub page-scroll">Financial Management</a></li>
							<li class="nav-item"><a href="#closure" class="nav-link nav-link-sub page-scroll">Closure of ENPI CBC programmes</a></li>
							<li class="nav-item"><a href="#monitoring-and-evaluation" class="nav-link nav-link-sub page-scroll">Monitoring and Evaluation</a></li>
							<li class="nav-item"><a href="#large-infrastructure-projects" class="nav-link nav-link-sub page-scroll">Large infrastructure projects</a></li>
							<li class="nav-item"><a href="#visibility" class="nav-link nav-link-sub page-scroll">Visibility</a></li>
							<li>
								<hr style="margin-left: 60px; margin-top: 30px;">
								<a href="<?php echo get_page_link(25)?>" class="nav-link">Support to ENI CBC<br><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
							</li>
						<?php elseif (is_page("34")): ?>
							<li class="nav-item"><a href="<?php echo get_page_link(25)?>#project-level-support" class="nav-link text-uppercase">Project level support</a></li>
							<li class="nav-item"><a href="#partnerspartnerships" class="nav-link active  nav-link-sub page-scroll">Finding Partners &amp; Building Partnerships</a></li>
							<li class="nav-item"><a href="#projectpreparation" class="nav-link nav-link-sub page-scroll">Project preparation</a></li>
							<li class="nav-item"><a href="#projectimplementation" class="nav-link nav-link-sub page-scroll">Project implementation and management</a></li>
							<li>
								<hr style="margin-left: 60px; margin-top: 30px;">
								<a href="<?php echo get_page_link(25)?>" class="nav-link">Support to ENI CBC<br><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
							</li>
						<?php elseif (is_page("25")): ?>
							<li class="nav-item"><a href="#programme-support" class="nav-link active page-scroll text-uppercase">Programme support</a></li>
							<li class="nav-item"><a href="<?php echo get_page_link(32)?>#prog-mgmt" class="nav-link nav-link-sub page-scroll">Programme Management</a></li>
							<li class="nav-item"><a href="<?php echo get_page_link(32)?>#financial-mgmt" class="nav-link  nav-link-sub ">Financial Management</a></li>
							<li class="nav-item"><a href="<?php echo get_page_link(32)?>#closure" class="nav-link nav-link-sub page-scroll">Closure of ENPI CBC programmes</a></li>
							<li class="nav-item"><a href="<?php echo get_page_link(32)?>#monitoring-and-evaluation" class="nav-link nav-link-sub page-scroll">Monitoring and Evaluation</a></li>
							<li class="nav-item"><a href="<?php echo get_page_link(32)?>#large-infrastructure-projects" class="nav-link nav-link-sub page-scroll">Large infrastructure projects</a></li>
							<li class="nav-item"><a href="<?php echo get_page_link(32)?>#visibility" class="nav-link  nav-link-sub ">Visibility</a></li>
							<br>
							<hr style="margin-left: 60px;">
							<li class="nav-item paddingTop20"><a href="#project-level-support" class="nav-link page-scroll text-uppercase">Project level support</a></li>
							<li class="nav-item"><a href="<?php echo get_page_link(34)?>#partnerspartnerships" class="nav-link nav-link-sub">Finding Partners &amp; Building Partnerships</a></li>
							<li class="nav-item"><a href="<?php echo get_page_link(34)?>#projectpreparation" class="nav-link nav-link-sub">Project preparation</a></li>
							<li class="nav-item"><a href="<?php echo get_page_link(34)?>#projectimplementation" class="nav-link nav-link-sub">Project implementation and management</a></li>
							<li>
							<hr style="margin-left: 60px; margin-top: 30px;">
							<br>
							<h5>LEGAL FRAMEWORK</h5>
							<?php echo do_shortcode( '[wpdm_category id="enicbc-regulatory-framework" template="link-template-resources-sm.php" operator="IN" toolbar="0" cols=1 colspad=1 colsphone=1 ]' ) ?>
							<li class="hidden-md-up">
								<hr style="margin-left: 60px; margin-top: 30px;">
							</li>
						<?php else: ?>
							<a href="javascript:history.back()" class="nav-link">Back<br><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
						<?php endif; ?>
							
					</ul>
	            </div>				
        	</div>
        	
        	
			<div class="col-xs-12 col-sm-9 content-area">
           
                 <main id="main" class="site-main" role="main">
	                 
                        <?php /* get_template_part( 'loop-templates/content', 'page' ); */ ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						
						     <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?> 
						    
							<div class="entry-content">
						
								<?php the_content(); ?>
						
								<?php
									wp_link_pages( array(
										'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
										'after'  => '</div>',
									) );
								?>
						
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

                    

                </main><!-- #main -->
               
    	    </div><!-- #primary -->
            <?php endwhile; // end of the loop. ?>
            
            <?php /* get_sidebar(); */ ?>

        </div><!-- .row -->
        
    </div><!-- Container end -->
	
</div><!-- Wrapper end -->


<?php get_footer(); ?>


