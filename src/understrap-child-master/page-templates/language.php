<?php
/**
 * Template Name: Language page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published
 *
 * @package understrap
 */

get_header(); ?>


<div class="wrapper <?php if( is_page( 793 )) echo 'rtlStyle'; ?>" id="primary" <?php if( is_page( 793 )) echo 'dir="rtl"'; ?> <?php /* style="background-image:url('<?php the_post_thumbnail_url('large'); ?>'); background-repeat: no-repeat; background-position: right top" */ ?> >

    <?php while ( have_posts() ) : the_post(); ?>
    <div class="container-fluid colophon ">
	   <div class="row">
			<div class="col-md-5 col-lg-6 colophon-map noPadding">
			   <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
			</div>
			<div class="col-md-7 col-lg-6 jumbo-secondary rtl">
				<?php /* <small><?php echo get_field('subtitle'); ?><br><br></small>*/ ?>
				<div class="lead"><?php /* the_title( '<h5>', '</h5>' ); */ ?><?php echo get_field('lead_paragraphe'); ?></div>
			</div>
	   </div>
    </div>
    
     <section class="col-xs-12 vSpacing-sm vSpacingT">
	            <article class="col-xs-12 col-sm-4 text-xs-center">
				    <h4 class="h1 theBlue">7.000</h4><h5><strong><?php echo get_field('applications'); ?></strong></h4>
	            </article>
	            <article class="col-xs-12 col-sm-4 text-xs-center">
				    <h4 class="h1 theBlue">37.000</h4><h5><strong><?php echo get_field('organisations'); ?></strong></h5>
	            </article>
	            <article class="col-xs-12 col-sm-4 text-xs-center">
				    <h4 class="h1 theBlue">1.000</h4><h5><strong><?php echo get_field('projects'); ?></strong></h5>
	            </article>
            </section>
    
    
    <div id="content" class="container">
    	<div class="row">
			<div class="col-xs-12 col-sm-12 vSpacingT-sm entry-content rtl">
				<?php the_content(); ?>
			</div>

			<div class="col-xs-12 text-xs-center">
				<a href="#programmes" class="page-scroll arrow-down-btn"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cd-arrow-down.svg" alt=""></a>
			</div>
		</div>
    </div>


		
       
    
    <?php /* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - PROGRAMMES - - - - - - */ ?>
    
    <div class="container-fluid noPadding bgLightGray" id="programmes">
		<div class="col-xs-12">
	
			<div class="media <?php if( is_page( 793 )) { echo 'title-colRight'; } else { echo 'title-colLeft';} ?> vSpacingT-sm">
				<div class="<?php if( is_page( 793 )) { echo 'media-right'; } else { echo 'media-left';} ?>">
					<svg class="media-object iconSvg pad-both">
						<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#prog-support"></use>
					</svg>
			  	</div>
			  	<div class="media-body media-middle">
					<h3><?php echo get_field('programmes_title'); ?></h3>
			  	</div>
			</div>
			<div class="col-xs-12 vSpacingT-sm entry-content rtl ">
				<p class="text-muted"><?php echo get_field('programmes_introduction'); ?></p>
			</div>
		</div>
		<div class="col-xs-12 noPadding">
			<div class="col-md-12 noPadding" <?php if( is_page( 793 )) echo 'dir="ltr"'; ?>>
				<?php get_template_part( 'page-templates/list', 'programmes-carousel' ); ?>
			</div><!-- .col-md-12 -->      
			
			<div class="col-xs-12 text-xs-center vSpacing-sm">
				<a href="<?php echo get_page_link(43); ?>" class="btn btn-outline-primary"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> View all Programmes</a>
			</div>
		</div>

	</div>
	
	<?php /* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - About Tesim  - - - - - - */ ?>
    <?php if( get_field('languages_about_tesim_title') ) { ?>
		<div class="container-fluid noPadding" id="programmes">
			<div class="col-xs-12">
				<div class="media <?php if( is_page( 793 )) { echo 'title-colRight'; } else { echo 'title-colLeft';} ?> vSpacingT-sm">
					<div class="<?php if( is_page( 793 )) { echo 'media-right'; } else { echo 'media-left';} ?>">
						<svg class="media-object iconSvg pad-both">
							<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#prog-support"></use>
						</svg>
				  	</div>
				  	<div class="media-body media-middle">
						<h3><?php echo get_field('languages_about_tesim_title'); ?></h3>
				  	</div>
				</div>
				<div class="col-xs-12 vSpacingT-sm entry-content rtl ">
					<p class="text-muted"><?php echo get_field('languages_about_tesim_body'); ?></p>
					<a href="<?php echo get_page_link(2); ?>" class="btn btn-outline-primary"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> <?php echo get_field('languages_about_tesim_link'); ?></a>
				</div>   
			</div>
		</div>
	<?php } ?>
    
	
	<?php /* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - Prog & Project support  - - - - - - */ ?>
    
    <div class="container-fluid noPadding" id="programmes">
		<div class="col-xs-12">
			<?php if( get_field('programmes_support_title') ) { ?>
				<div class="media <?php if( is_page( 793 )) { echo 'title-colRight'; } else { echo 'title-colLeft';} ?> vSpacingT-sm">
					<div class="<?php if( is_page( 793 )) { echo 'media-right'; } else { echo 'media-left';} ?>">
						<svg class="media-object iconSvg pad-both">
							<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#prog-support"></use>
						</svg>
				  	</div>
				  	<div class="media-body media-middle">
						<h3><?php echo get_field('programmes_support_title'); ?></h3>
				  	</div>
				</div>
				<div class="col-xs-12 vSpacingT-sm entry-content rtl ">
					<p class="text-muted"><?php echo get_field('programmes_support_body'); ?></p>
				</div>
			<?php } ?>
			&nbsp;
			<?php if( get_field('project_level_support_title') ) { ?>
				<div class="media <?php if( is_page( 793 )) { echo 'title-colRight'; } else { echo 'title-colLeft';} ?> vSpacingT-sm">
					<div class="<?php if( is_page( 793 )) { echo 'media-right'; } else { echo 'media-left';} ?>">
						<svg class="media-object iconSvg pad-both">
							<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#proj-support"></use>
						</svg>
				  	</div>
				  	<div class="media-body media-middle">
						<h3><?php echo get_field('project_level_support_title'); ?></h3>
				  	</div>
				</div>
				<div class="col-xs-12 vSpacingT-sm entry-content rtl ">
					<p class="text-muted"><?php echo get_field('project_level_body'); ?></p>
				</div>  
			<?php } ?> 
		</div>
	</div>
        
    <?php endwhile; // end of the loop. ?>	

	<div class="container-fluid jumbo-secondary jumbo-newsletter vSpacingT-sm">
			<div class="row ">		
				<div class="col-xs-12 <?php if( is_page( 793 )) { echo 'title-colRight'; } else { echo 'title-colLeft';} ?> ">
					<h3><?php echo get_field('newsletter_title'); ?></h3>
					<p><?php echo get_field('newsletter_body'); ?></p>
				</div>
				<div class="col-xs-12 entry-content noPaddingR">
					<div id="no-notify" class="no-notify">
				    	<form action="https://sixtytwo.createsend.com/t/r/s/khhyeu/" method="post" id="newsletterForm" class="form-inline" <?php if( is_page( 793 )) echo 'dir="ltr" style="text-align:right; padding-right:6vw;"'; ?> >
			    		 
			    		  <div class="form-group input-group-lg">
						    <label class="sr-only" for="fieldName">Name</label>
						    <input type="name" class="form-control" id="fieldName" placeholder="Your name" name="cm-name" >
						  </div>
			    		  <div class="form-group input-group-lg">
						    <label class="sr-only" for="fieldEmail">Your Email address</label>
						    <input type="email" class="form-control" id="fieldEmail" placeholder="Enter email" name="cm-khhyeu-khhyeu">
						  </div>
						 
						  <button type="submit" class="btn btn-lg btn-outline-secondary">Get ENI-CBC Updates</button>

						</form>
				    	
				  	</div>   						
					<div id="notify-success" class="notify-msg">
				    	<h4><i class="fa fa-smile-o fa-lg fa-pull-left" aria-hidden="true"></i> <strong>Subscription succeed,</strong> You're all set to receive our newsletter.</h4>
					</div>
					<div id="notify-failed" class="notify-msg">
						<h4><i class="fa fa-meh-o fa-lg fa-pull-left" aria-hidden="true"></i> <strong>Oops,</strong> Your email seems incorrect. Please try again.</h4>
					</div>
					
					
					
	
					
				</div>
			</div>
	</div>
	
    
    
</div><!-- Wrapper end -->

<?php get_footer(); ?>