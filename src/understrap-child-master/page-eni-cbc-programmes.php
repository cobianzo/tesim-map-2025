<?php get_header(); ?>

<div class="wrapper">
	
    <div class="container-fluid">
        
	   <div class="col-md-12 content-area noPadding">

	   		<?php while ( have_posts() ) : the_post(); ?>
	            
				            
	            <div class="media title-colLeft vSpacingT-sm hidden-sm-down">
					<div class="media-left">
					    <svg class="media-object titleIcone iconSvg pad-both">
							<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#prog-support"/>
						</svg>
					</div>
					<div class="media-body media-middle">
					    <?php the_title( '<h1>', '</h1>' ); ?>
					</div>
				</div>
				
				
				
				<div class="media title-colLeft vSpacingT-sm hidden-sm-up">
					<div class="media-body media-middle">
					    <?php the_title( '<h1>', '</h1>' ); ?>
					</div>
				</div>
	            

	            
	            
	            
				<div id="main" class="entry-content vSpacingT-sm" role="main">
    

				<div class="row">
		            <div class="col-xs-12 ">
			            <svg class="media-object titleIcone iconSvg pad-both pull-right hidden-sm-up">
							<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#prog-support"/>
						</svg>
	                    <div class="text-muted"><?php the_content(); ?></div>
		            </div>
		        </div>        
				</div>
	            
	        <?php endwhile; // end of the loop. ?>

           
	    </div><!-- #primary -->
        
    </div><!-- Container end -->
    

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
	
	<div class="container-fluid bgLightGray">
		<div class="row ">		
			<div class="col-xs-12 col-sm-11 offset-sm-1 vSpacing-sm">	            
				<?php  get_template_part( 'page-templates/list', 'programmes-other' );  ?>
			</div>
		</div>
	</div>
    
    
    <?php get_template_part( 'inc/partial', 'newsletterform' ); ?>
    
</div><!-- Wrapper end -->

<?php get_footer(); ?>
