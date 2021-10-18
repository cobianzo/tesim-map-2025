<?php get_header(); ?>

<div class="wrapper" id="primary" <?php /* style="background-image:url('<?php the_post_thumbnail_url('large'); ?>'); background-repeat: no-repeat; background-position: right top" */ ?> >

    <?php while ( have_posts() ) : the_post(); ?>
    <div class="container-fluid colophon">
	   <div class="row">
			<div class="col-md-5 col-lg-6 colophon-map noPadding">
			   <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
			   <aside><p><i class="fa fa-square theBlue" aria-hidden="true"></i> Over 30 EU member states and neighbouring countries</p><p><i class="fa fa-square theBlue" aria-hidden="true"></i> Thousands of km of land and sea borders</p><p><i class="fa fa-square theBlue" aria-hidden="true"></i> €1 billion</p></aside>
			</div>
			<div class="col-md-7 col-lg-6 jumbo-secondary">
				<?php /* <small><?php echo get_field('subtitle'); ?><br><br></small>*/ ?>
				<div class="lead"><?php /* the_title( '<h5>', '</h5>' ); */ ?><?php echo get_field('lead_paragraphe'); ?></div>
			</div>
	   </div>
    </div>
    <div style="visibility: hidden" >.</div>
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-12 noPadding vSpacingT-sm hidden-lg-down" id="programmes">
		<div class="media title-colLeft">
		  <div class="media-left">
		    <svg class="media-object titleIcone iconSvg pad-both">
				<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#proj-support"/>
			</svg>
		  </div>
		  <div class="media-body media-middle">
		    <h3><?php echo get_field('second_subtitle'); ?></h3>
		  </div>
		</div>
	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-12 noPadding vSpacing-sm hidden-md-up">
		<div class="media title-colLeft">
		  <div class="media-left">
		    <svg class="media-object titleIcone iconSvg pad-both">
				<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#proj-support"/>
			</svg>
		  </div>
		  <div class="media-body media-middle">
		    <h3><?php echo get_field('second_subtitle'); ?></h3>
		  </div>
		</div>
	</div>				

	<div class="col-xs-12 col-sm-12 vSpacingT-sm entry-content text-muted">
		<?php echo get_field('second_description'); ?>
	</div>
    <?php /* <div class="container-fluid noPadding bgLightGray">
		<div class="col-md-12 noPadding ">       				
            <?php get_template_part( 'page-templates/list', 'programmes-carousel' ); ?>
            <div class="col-xs-12 marginBot30 text-xs-center">
				<a href="<?php echo get_page_link(43); ?>" class="btn btn-outline-primary marginRight"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>Browse all Programmes</a>
			</div> 
	    </div><!-- .col-md-12 -->  
    </div><!-- Container end --> */ ?>
    <div class="container-fluid noPadding bgLightGray">
   		<div class="col-md-12 noPadding vSpacing-sm">     

	            <?php /* get_template_part( 'page-templates/list', 'programmes' ); */ ?>
	            
	        <div class="card-programmes-columns">
				<?php
				$args = array( 'posts_per_page' => 20, 'orderby' => 'title', 'order' =>'ASC', 'post_type' => 'programmes', 'tax_query' => array(
			            array(
			            'taxonomy' => 'cat-programmes',
			            'field' => 'id',
			            'terms' => 8,
			            'operator' => 'NOT IN',
			            ),
			        )
				);
				$rand_posts = get_posts( $args );
				foreach ( $rand_posts as $post ) : 
				  setup_postdata( $post ); ?>
					<?php get_template_part( 'loop-templates/content', 'programmes' ); ?>
				<?php endforeach; 
				wp_reset_postdata(); ?>
			</div>    
	            

		</div> <!-- .col-md-12 -->
	</div> <!-- .container -->
    <div class="container">
    	<div class="row">
	    	<div class="col-xs-12 col-sm-12 entry-content">
				<?php echo get_field('about_quote'); ?>
			</div>
		</div>
    </div>
    <div id="content" class="container-fluid">
    	<div class="row">
			<div class="col-xs-12 col-sm-12 vSpacingT-sm entry-content">
				<?php the_content(); ?>
			</div>

			<?php /* <div class="col-xs-12 text-xs-center">
				<a href="#programmes" class="page-scroll arrow-down-btn"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cd-arrow-down.svg" alt=""></a>
			</div> */ ?>
		</div>
    </div>

	<?php /*
	<div class="container-fluid colophon">
	   <div class="row">
			<div class="col-md-5 col-lg-2  noPadding">
			   
			</div>
			<div class="col-md-7 col-lg-10 jumbo-secondary">
				<?php echo get_field('about_quote'); ?>	        	
			</div>
	   </div>
    </div> */ ?>

    <div class="container-fluid bgLightGray " id="programmes">
		<div class="col-xs-12 col-sm-1 col-md-3 col-lg-3 hidden-sm-down hidden-xl-up title-colLeft vSpacing-sm">
			<h3><?php echo get_field('second_subtitle'); ?></h3>
			<svg class="titleIcone iconSvg pad-both">
				<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#proj-support"/>
			</svg>
		</div>
				    
		<div class="container-fluid vSpacing-sm bgLightGray">
			<div class="row ">		
				<div class="col-xs-12 col-sm-12 vSpacing-sm entry-content">
					<?php get_template_part( 'page-templates/list', 'programmes-other' ); ?>
				</div>
			</div>
		</div>
    </div>
    <?php endwhile; // end of the loop. ?>
    

	<div class="container-fluid noPadding">
			<?php /* <div class="col-xs-12 noPadding ">
				<div class="col-xs-12 text-xs-center">
					<a href="#stories" class="page-scroll arrow-down-btn"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cd-arrow-down.svg" alt=""></a>
				</div>
			</div> */ ?>
	</div>			
	<div class="container-fluid noPadding" id="stories">
		<div class="rows">
			<div class="col-xs-12 noPadding ">
				<div class="media title-colLeft">
					<div class="media-left">
						<svg class="media-object titleIcone iconSvg pad-both">
							<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#stories"/>
						</svg>
				  	</div>
				  	<div class="media-body media-middle">
						<h3><span class="text-muted">ENI CBC</span> Stories</h3>
				  </div>
				</div>
				<div class="col-xs-12 title-colLeft vSpacingT-sm entry-content">
					<p class="text-muted">Find out more about the positive impact of ENI CBC projects on the lives of people living on both sides of the external border of the EU! From creating business opportunities and new jobs, to making our regions more sustainable and providing innovative and accessible social services on the external borders…there are many stories to tell!</strong></p>						
				</div>
				
				<?php get_template_part( 'page-templates/list', 'stories-measonry' ); ?>
				
				<div class="col-xs-12 text-xs-center">
					<a href="<?php echo get_page_link(118); ?>" class="btn btn-outline-primary marginBot30"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> All Stories</a>
					</<br>
<?php /*					<a href="#ambassadors" class="page-scroll arrow-down-btn"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/cd-arrow-down.svg" alt=""></a>*/ ?>
				</div>
		    </div><!-- .col-md-12 -->    
		</div><!-- .row -->    	    
    </div><!-- Container end -->
    
    <?php /*
	<div class="container-fluid noPadding" id="ambassadors">
		<div class="paddingTop60">
			<div class="col-xs-12 noPadding ">
				
				<?php get_template_part( 'page-templates/list', 'ambassadors' ); ?>
		    </div><!-- .col-md-12 -->
		</div><!-- .row -->    	    
    </div><!-- Container end -->
	*/ ?>
	
	<?php get_template_part( 'inc/partial', 'newsletterform' ); ?>
	
</div><!-- Wrapper end -->

<?php get_footer(); ?>
