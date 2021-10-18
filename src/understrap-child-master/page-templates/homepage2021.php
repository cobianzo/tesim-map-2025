<?php
/**
 * Template Name: Home page 2021
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published
 *
 * @package understrap
 */

get_header(); ?>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v4.0&appId=211396205656964&autoLogAppEvents=1"></script>

<?php if( current_user_can('administrator') ): ?><?php else: ?>  <?php endif; ?> 
 
<div class="themes-jumbotron-container">
	<div class="display-1">Because neighbours ...</div>
	<ul class="themes-jumbotron-wrapper">
		<li>
			<a href="/theme/environment">
				<div class="themes-body">
					<h2 class="">... share the<br>same home</h2>

<!-- 					<p class="">Cross-border cooperation programmes work to strengthen a clean environment through different types of actions</p> -->
					<p class="btn btn-secondary "><i class="fa fa-tag" aria-hidden="true"></i> Environment</p>
				</div>
			</a>
		</li>
		<li>
			<a href="/theme/people-to-people">
				<div class="themes-body">
					<h2 class="hidden-sm-down">... grow up<br>together</h2>
					<h2 class="hidden-md-up">... grow up together</h2>
<!-- 					<p class="">People-to-people exchanges are the real cement of cross border cooperation projects: they create direct links between institutions and organisations, authorities and citizens, with the purpose to promote understanding and to develop new solutions to common problems.</p> -->
					<p class="btn btn-secondary "><i class="fa fa-tag" aria-hidden="true"></i> People-to-People</p>
				</div>
			</a>
		</li>
		

		<li>
			<a href="/theme/economic-development">
				<div class="themes-body">
					<h2 class="hidden-sm-down">... give<br>a hand</h2>
					<h2 class="hidden-md-up">... give a hand</h2>
<!-- 					<p class="">The creation of economic opportunities across the European borders is one of the biggest challenges faced by cross-border cooperation. Projects seek to foster business and to help people improve their skills, with benefits for all communities on both sides of the European frontier.</p> -->
					<p class="btn btn-secondary "><i class="fa fa-tag" aria-hidden="true"></i> Economic <span class="hidden-lg-down">Development</span></p>
				</div>
			</a>
		</li>
		<li>
			<a href="/theme/infrastructure">
				<div class="themes-body">
					<h2 class="hidden-sm-down">... keep the<br>doors open</h2>
					<h2 class="hidden-md-up">... keep the doors open</h2>
<!-- 					<p class="">Economic competitiveness of regions depends heavily on adequate transport, logistic and communications. Projects give a possibility to local actors to work together towards sustainable solutions.</p> -->
					<p class="btn btn-secondary"><i class="fa fa-tag" aria-hidden="true"></i>Infrastructure</p>
				</div>
			</a>
		</li>
	</ul>
</div>

<?php /*


	<a class="cd-nav-trigger cd-text-replace" href="#primary-nav">Menu<span aria-hidden="true" class="cd-icon"></span></a>

	<div class="cd-projects-container cd-projects--jh-update">
		<div class="display-1 hidden-sm-down">Because neighbours...</div>
		<ul class="cd-projects-previews">
			
			<li>
				<a href="#0">
					<div class="cd-project-title">
						<h2>...keep the<br>doors open</h2>
						<p class="btn-ghost"><i class="fa fa-tag" aria-hidden="true"></i>Infrastructure</p>
					</div>
				</a>
			</li>

			<li>
				<a href="#0">
					<div class="cd-project-title">
						<h2>...give<br>a hand</h2>
						<p class="noPaddingR btn-ghost"><i class="fa fa-tag" aria-hidden="true"></i> Economic <span class="hidden-lg-down">Development</span></p>
					</div>
				</a>
			</li>
			<li>
				<a href="#0">
					<div class="cd-project-title">
						<h2>...share the<br>same home</h2>
						<p class="btn-ghost"><i class="fa fa-tag" aria-hidden="true"></i> Environment</p>
					</div>
				</a>
			</li>
			<li>
				<a href="#0">
					<div class="cd-project-title">
						<h2>...grow up<br>together</h2>
						<p class="btn-ghost"><i class="fa fa-tag" aria-hidden="true"></i> People-to-People</p>
					</div>
				</a>
			</li>
		</ul> <!-- .cd-projects-previews -->
		<ul class="cd-projects">
			<li>
				<div class="preview-image">
					<div class="cd-project-display">
						<h2 class="display-1"><span class="hidden-md-up">Because<br>neighbours<br></span>keep the <br class="hidden-md-up">doors open</h2>
						<p class="lead">Economic competitiveness of regions depends heavily on adequate transport, logistic and communications. Projects give a possibility to local actors to work together towards sustainable solutions.</p>
					</div>
					<div class="cd-project-title">
						<h2>...keep the<br>doors open</h2>
						<p class="btn-ghosts"><a href="/theme/infrastructure" class="btn btn-outline-secondary"><i class="fa fa-tag" aria-hidden="true"></i>Infrastructure</a></p>
					</div>
				</div>

			</li>

			<li>
				<div class="preview-image">
					<div class="cd-project-display">
						<h2 class="display-1"><span class="hidden-md-up">Because<br>neighbours<br></span>give <br class="hidden-md-up">a hand</h2>
						<p class="lead">The creation of economic opportunities across the European borders is one of the biggest challenges faced by cross-border cooperation. Projects seek to foster business and to help people improve their skills, with benefits for all communities on both sides of the European frontier.</p>
					</div>
					<div class="cd-project-title">
						<h2>...give<br>a hand</h2>
						<p class="noPaddingR"><a href="/theme/economic-development" class="btn btn-outline-secondary"><i class="fa fa-tag" aria-hidden="true"></i> Economic Development</a></p>
					</div> 
				</div>
			</li>
			<li>
				<div class="preview-image">
					<div class="cd-project-display">
						<h2 class="display-1"><span class="hidden-md-up">Because<br>neighbours<br></span>share the <br class="hidden-md-up">same home</h2>
						<p class="lead">Cross-border cooperation programmes work to strengthen a clean environment through different types of actions, from improving  the quality of  water to upgrading waste management facilities, from reducing marine litter to protecting endangered species.</p>
					</div>					
					<div class="cd-project-title">	
						<h2>...share the<br>same home</h2>					
						<p> <a href="/theme/environment" class="btn btn-outline-secondary"><i class="fa fa-tag" aria-hidden="true"></i> Environment</a></p>
						<div style="transform: translateY(-60px;)">More about</div>
					</div> 
				</div>
			</li>

			<li>
				<div class="preview-image">
					<div class="cd-project-display">
						<h2 class="display-1"><span class="hidden-md-up">Because<br>neighbours<br></span>grow up <br class="hidden-md-up">together</h2>
						<p class="lead">People-to-people exchanges are the real cement of cross border cooperation projects: they create direct links between institutions and organisations, authorities and citizens, with the purpose to promote understanding and to develop new solutions to common problems.</p>
					</div>										
					<div class="cd-project-title">
						<h2>...grow up<br class="hidden-sm-down">together</h2>
						<p><a href="/theme/people-to-people" class="btn btn-outline-secondary"><i class="fa fa-tag" aria-hidden="true"></i> People-to-People</a></p>
					</div> 
				</div>
			</li>
			

			
		</ul><!-- .cd-projects -->
	</div><!-- .cd-project-container --> 
*/ ?> 
<div class="wrapper" id="primary">	
	
	<div class="container-fluid">

		<div class="row ">
			<?php 
				// $frontpage_id = get_option( 'page_on_front' );
				// if ($frontpage_id == get_the_ID()) {
				//  	get_template_part('inc/partial-tesim-virtual-tour-v1'); 
				// } else {
					get_template_part('inc/partial-tesim-virtual-tour-v2');
				// }
			?>
		</div>
		<div class="row jumboBoxes is-table-row">
			<div class="col-md-3 jumbo2019-map">
			    <aside class="logoEu">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-flag-europe.svg" alt="European Neighbourhood Intrument" width="90" height="60" >
				</aside>
				<aside class="logoParticip">
						<img src="/wp-content/themes/understrap-child-master/img/logo-particip.png" alt="Particip">
					</aside>
			    <figure class="featuredImage" style="">
<!-- 							<img width="1024" height="719" src="https://tesim-enicbc.eu/wp-content/uploads/2019/08/mappa-EU-Tesim-Vectorial-2019-WK-1024x719.gif" class="attachment-large size-large wp-post-image" alt="" srcset="https://tesim-enicbc.eu/wp-content/uploads/2019/08/mappa-EU-Tesim-Vectorial-2019-WK-1024x719.gif 1024w, https://tesim-enicbc.eu/wp-content/uploads/2019/08/mappa-EU-Tesim-Vectorial-2019-WK-420x295.gif 420w, https://tesim-enicbc.eu/wp-content/uploads/2019/08/mappa-EU-Tesim-Vectorial-2019-WK-768x539.gif 768w" sizes="(max-width: 1024px) 100vw, 1024px"> -->
				</figure>
			</div>
			<div class="col-md-6 jumbo2019-primary">
				<h3 class="card-title text-xs-center">Working together to improve people’s life across the external European borders</h3>
				<section class="row bigNumbers">
		            <div class="col-md-4 noPadding text-xs-center">
					    <h4 class="h2 theWhite">7.000</h4><h5 class="noMargin"><strong>Applications</strong></h5>
		            </div>
		            <div class="col-md-4 noPadding text-xs-center">
					    <h4 class="h2 theWhite">37.000</h4><h5 class="noMargin"><strong>organisations</strong></h5>
		            </div>
		            <div class="col-md-4 noPadding text-xs-center">
					    <h4 class="h2 theWhite">1.000</h4><h5 class="noMargin"><strong>projects</strong></h5>
		            </div>
	            </section>
			</div>
			<div class="col-md-3 jumbo2019-secondary">
		    	<h3 class="card-title">Programme and<br>project support</h3>
				<a href="<?php echo get_permalink( 25 ); ?>" class="btn btn-outline-secondary "><i class="fa fa-long-arrow-right" aria-hidden="true"></i><span class="hidden-sm-down">Discover </span>more</a>
		    </div>
		</div>
	</div>
	
	    <div  id="content" class="container-fluid">
        
	  	<div class="col-md-12 content-area noPadding">



            <main id="main" class="site-main">
	            
	            
	    
	



	            

				
            </main><!-- #main -->
           
		</div>
	</div> <!-- end of .container-fluid -->	
	

		
	<?php /* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - LATEST POST - - - - - - */ ?>
    
    <div class="container-fluid vSpacingT" id="stories">
		<div class="row">
			<div class="col-12">
				<div class="col-xs-12 paddingx30">
					<div class="row">
				        <div class="col-12">
				            
				        	<div class="pull-right paddingTop5">
					            <a href="<?php echo get_page_link(118); ?>" class="btn btn-outline-primary pull-right"><i class="fa fa-long-arrow-right hidden-sm-down" aria-hidden="true"></i> Stories</a>
								<a href="<?php echo get_page_link(3539); ?>" class="btn btn-outline-primary marginRight15 pull-right"><i class="fa fa-long-arrow-right hidden-sm-down" aria-hidden="true"></i> Voices</a>
								<?php
							        $args = array( 'numberposts' => '1', 'category' => 4 );
							        $recent_posts = wp_get_recent_posts( $args );
							        foreach( $recent_posts as $recent ){
							        	$latest_post_url = get_permalink($recent["ID"]);
							        }?>
							    <a href="<?php echo $latest_post_url; ?>" class="btn btn-outline-primary marginRight15 pull-right"><i class="fa fa-long-arrow-right hidden-sm-down" aria-hidden="true"></i> News</a>
							</div>
							<h2 class="display-2">Fresh from the field</h2>
				        </div>
				        
				    </div>
					<div class="pull-right">
						
				    </div>
					
				</div>
				
<!--
				<div class="media title-colLeft">
					
				  	<div class="media-body media-middle">
						
				  </div>
				  <div class="media-right">
						<svg class="media-object titleIcone iconSvg pad-both">
							<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#newsevents"/>
						</svg>
				  	</div>
				</div>
-->
				
				<?php get_template_part( 'page-templates/list', 'all-measonry' ); ?>
								
				<?php /*
				<div class="col-xs-12 text-xs-center">					
					<br>
					<a href="#news" class="page-scroll arrow-down-btn"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cd-arrow-down.svg" alt=""></a>
				</div> */ ?>
		    </div><!-- .col-md-12 -->    
		</div><!-- .row -->    	    
    </div><!-- Container end -->
	
		
		
		
		
		
	<?php /* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - EVENTS - - - - - - 
	<div class="container-fluid noPadding">	
        
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
    */ ?>
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
	
<?php /**/ ?>
	<div class="container-fluid">
	   	<div class="row">
			<div class="col col-md-6 " style="padding: 50px 3vw 40px 6vw;">
				<h4>Follow us on Instagram</h4>
				<?php echo do_shortcode( ' [elfsight_instagram_feed id="1"] ' ); ?> 
			</div>
			
			<div class="col col-md-6" style="padding: 50px 6vw 40px 3vw;">
				<div class="fb-page marginBot30" data-href="https://www.facebook.com/enicbc/" data-tabs="timeline" data-width="500" data-height="245" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false"><blockquote cite="https://www.facebook.com/enicbc/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/enicbc/">ENI CBC - European Neighbourhood Instrument Cross Border Cooperation</a></blockquote>
				</div>
				 <div class=" marginTop60-sm">
					<a class="twitter-timeline" data-height="270" data-width="500" data-link-color="#2b3788" href="https://twitter.com/enicbc?ref_src=twsrc%5Etfw">Tweets by enicbc</a>
					<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
				</div>
			</div>
		</div>
	</div>     
     
    
    <?php get_template_part( 'inc/partial', 'newsletterform' ); ?>


    
    
</div><!-- Wrapper end -->

<?php get_footer(); ?>