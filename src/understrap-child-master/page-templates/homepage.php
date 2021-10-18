<?php
/**
 * Template Name: Home page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published
 *
 * @package understrap
 */

get_header(); ?>

<?php
    get_sidebar('hero'); 
?>


<div class="wrapper" id="primary">
    
    <div  id="content" class="container-fluid">
        
	  	<div class="col-md-12 content-area noPadding">



            <main id="main" class="site-main">

				<div class="row jumboBoxes is-table-row">
					<div class="col-sm-6 jumbo-secondary padding4">
					    <h3 class="card-title">Would you like to learn more about cooperation on the EU's external borders?</h3>
<?php /*			    <p class="card-text">The European Neighbourhood Instrument Cross Border Cooperation (ENI CBC) promotes cooperation between EU countries and neighbouring countries. It supports 16 programmes at the external borders of the EU covering a land border, sea crossing or common sea basin. </p> */ ?>
						<a href="<?php echo get_permalink( 17 ); ?>" class="btn btn-outline-secondary "><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Discover more</a>
					</div>
					<div class="col-sm-6 jumbo-secondary">
				    	<h3 class="card-title">Do you need support for your ENI CBC programme or project?</h3>
						<?php /* <p class="card-text">The TESIM project provides support and training to ENI CBC programmes and projects. The work of TESIM focuses on improving management and implementation quality of programmes, including the promotion of exchanges among them. At project level, TESIM’s work focuses on capacity building in the neighbouring countries. Increasing the visibility of ENI CBC as a whole is an important theme across all our activities.</p> */ ?>
						<a href="<?php echo get_permalink( 25 ); ?>" class="btn btn-outline-secondary "><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Discover more</a>
				    </div>
				</div>
            </main><!-- #main -->
            <section class="col-xs-12 vSpacing-sm vSpacingT bigNumers">
	            <article class="col-xs-12 col-sm-4 text-xs-center">
				    <h4 class="h1 theBlue">7.000</h4><h5><strong>Applications</strong></h5>
	            </article>
	            <article class="col-xs-12 col-sm-4 text-xs-center">
				    <h4 class="h1 theBlue">37.000</h4><h5><strong>organisations</strong></h5>
	            </article>
	            <article class="col-xs-12 col-sm-4 text-xs-center">
				    <h4 class="h1 theBlue">1.000</h4><h5><strong>projects</strong></h5>
	            </article>
            </section>
            <div class="col-xs-12 text-xs-center">
				<a href="#news" class="page-scroll arrow-down-btn"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cd-arrow-down.svg" alt=""></a>
			</div>
		</div>
	</div> <!-- end of .container-fluid -->	
		
	<?php /* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - STORIES - - - - - - */ ?>
    
    <div class="container-fluid noPadding vSpacingT" id="stories">
		<div class="rows">
			<div class="col-xs-12 noPadding ">
				<div class="media title-colLeft">
					<div class="media-left">
						<svg class="media-object titleIcone iconSvg pad-both">
							<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#stories"/>
						</svg>
				  	</div>
				  	<div class="media-body media-middle">
						<h3><span class="text-muted">ENI CBC</span> Stories </h3>
				  </div>
				</div>
				<div class="col-xs-12 col-sm-12 vSpacingT-sm entry-content">
					<p class="text-muted">Find out more about the positive impact of ENI CBC projects on the lives of people living on both sides of the external border of the EU! From creating business opportunities and new jobs, to making our regions more sustainable and providing innovative and accessible social services on the external borders… <strong>there are many stories to tell!</strong>
						</p>						
				</div>
				
				<?php get_template_part( 'page-templates/list', 'stories-measonry' ); ?>
								
				<div class="col-xs-12 text-xs-center">
					<a href="<?php echo get_page_link(118); ?>" class="btn btn-outline-primary marginBot30"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> All Stories</a>
					<br>
					<a href="#news" class="page-scroll arrow-down-btn"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cd-arrow-down.svg" alt=""></a>
				</div>
		    </div><!-- .col-md-12 -->    
		</div><!-- .row -->    	    
    </div><!-- Container end -->
	
		
		
		
		
		
	<?php /* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - NEWS - - - - - - */ ?>	
	<div class="container-fluid noPadding">	
	    <div class="col-xs-12 noPadding" id="news">
            <div class="media title-colLeft" style="margin-bottom:20px;">
				<div class="media-left">
					<svg class="media-object iconSvg pad-both">
						<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#newsevents"></use>
					</svg>
			  	</div>
			  	<div class="media-body media-middle">
					<h3>News & Events</h3>
			  </div>
			</div>
	    </div>
	    <div class="col-xs-12 noPadding">   
		    
				<?php /*while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'loop-templates/content', 'page' ); ?>
                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();        
                        endif;
                    ?>
                <?php endwhile; // end of the loop. */ ?>
		    
            <?php get_template_part( 'page-templates/list', 'news' ); ?>
    		
    		<div class="col-xs-12 text-xs-center">
	    		<?php
			        $args = array( 'numberposts' => '1', 'category' => 'news' );
			        $recent_posts = wp_get_recent_posts( $args );
			        foreach( $recent_posts as $recent ){
			        echo '<a href="' . get_permalink($recent["ID"]) . '" class="btn btn-outline-primary marginRight"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> More News</a>';
			        }
			    ?>
			</div>
        </div>
        
        <?php /* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - EVENTS - - - - - - */ ?>
        
        <div class="col-xs-12 vSpacing noPadding home-news">    
	        <div class="media title-colLeft" style="margin-bottom:20px;">
				<div class="media-left">
					<svg class="media-object iconSvg pad-both">
						<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#events"></use>
					</svg>
				</div>
				<div class="media-body media-middle">
					<h3><span class="text-muted">Upcoming</span> Events</h3>
			  </div>
			</div>
	        
            <section class="c-news_block js-eventblock-click">
	            <article class="featured-event">
		            <?php
			            $latest_cpt = get_posts("post_type=event&numberposts=1");
						$latest_event = $latest_cpt[0]->ID;
			             ?>
			        <figure class="featuredImage">
		            	<?php echo do_shortcode('[event post_id="' . $latest_event . '"]#_EVENTIMAGE[/event]'); ?>
		            </figure>
		            <div class="home-featured-news-content">
			        	<div class="entry-meta"><?php echo strip_tags(do_shortcode('[event post_id="' . $latest_event . '"]#_EVENTTAGS[/event]')); ?></div>
			        	<h4><?php echo strip_tags(do_shortcode('[event post_id="' . $latest_event . '"]#_EVENTNAME[/event]')); ?></h4>
			        	<small class="text-muted"><i><?php echo do_shortcode('[event post_id="' . $latest_event . '"]#_{j F Y}<br> #_LOCATIONNAME, #_LOCATIONTOWN[/event]'); ?></i></small>
			        	<br><br>
			        	<p><?php echo strip_tags(do_shortcode('[event post_id="' . $latest_event . '"]#_EVENTEXCERPT{30,...}[/event]')); ?></p>
			        	
			        	<a href="<?php echo strip_tags(do_shortcode('[event post_id="' . $latest_event . '"]#_EVENTURL[/event]')); ?>" class="btn btn-sm btn-outline-primary">
				        	<i class="fa fa-long-arrow-right" aria-hidden="true"></i> Event page</a>
		            </div>
            	</article>
            </section>
            
            <div class="home-news-list">
				<section class="c-news_list_wrapper" id="em-wrapper">
					<?php echo EM_Events::output(array( 'limit'=>3, 'offset'=>1, 'pagination'=>0)); ?>
				</section>
            </div>
            
            
            
            
			<div class="col-xs-12 text-xs-center vSpacing-sm">
				<a href="<?php echo get_page_link(137); ?>" class="btn btn-outline-primary"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> View all Events</a>
			</div>
			
			<div class="col-xs-12 text-xs-center">
				<a href="#programmes" class="page-scroll arrow-down-btn"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cd-arrow-down.svg" alt=""></a>
			</div>
        </div>
	            
    </div><!-- Container end -->
    
    <?php /* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - PROGRAMMES - - - - - - 
    
    
    <div class="container-fluid noPadding bgLightGray">
		<div class="col-md-12 noPadding ">       				
            <?php get_template_part( 'page-templates/list', 'programmes-carousel' ); ?>
            <div class="col-xs-12 marginBot30 text-xs-center">
				<a href="<?php echo get_page_link(43); ?>" class="btn btn-outline-primary marginRight"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> All Programmes</a>
			</div> 
	    </div><!-- .col-md-12 -->  
    </div><!-- Container end -->
    */ ?>
    
    
    
    <div class="container-fluid noPadding bgLightGray" id="programmes">
		<div class="col-xs-12 noPadding">
			
				<div class="media title-colLeft vSpacingT-sm">
					<div class="media-left">
						<svg class="media-object iconSvg pad-both">
							<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#prog-support"></use>
						</svg>
				  	</div>
				  	<div class="media-body media-middle">
						<h3><span class="text-muted">ENI CBC</span> Programmes</h3>
				  	</div>
				</div>
				<div class="col-xs-12 vSpacingT-sm entry-content">
					<p class="text-muted">A total of 16 programmes will be implemented under ENI CBC. They cover 12 land borders, one sea crossing and three sea basins, stretching from Finland and Russia in the north, to countries like Hungary and the Ukraine in the east, and Italy, Northern Africa and the Middle East in the south.<br>
					<strong>Here you will find news and information on each programme, including the programme strategy and participating countries.</strong></p>
				</div>
		</div>
		<div class="col-xs-12 noPadding">
			<div class="col-md-12 noPadding">       				
	            <?php get_template_part( 'page-templates/list', 'programmes-carousel' ); ?>
		    </div><!-- .col-md-12 -->        
			
			<div class="col-xs-12 text-xs-center vSpacing vSpacingT-sm">
				<a href="<?php echo get_page_link(17); ?>" class="btn btn-outline-primary"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> More about the Programmes</a>
			</div>
		</div>

	</div>
    
       
    
    <?php get_template_part( 'inc/partial', 'newsletterform' ); ?>

	
	
	<?php /* 
	<div class="container-fluid bgLightGray vSpacing-sm">
			<div class="row ">		
				<div class="col-xs-12 col-sm-12 col-md-10 offset-md-2 col-lg-9 offset-lg-3 vSpacingT-sm entry-content">
					<?php get_template_part( 'page-templates/list', 'programmes-other' ); ?>
				</div>
			</div>
	</div> */ ?>
	
	<div class="container-fluid noPadding" id="ambassadors">
			<div class="col-xs-12 noPadding">
				<?php get_template_part( 'page-templates/list', 'ambassadors' ); ?>
			</div>
	</div>
    
    
</div><!-- Wrapper end -->

<?php get_footer(); ?>