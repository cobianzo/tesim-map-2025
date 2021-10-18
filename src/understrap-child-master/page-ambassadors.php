<?php get_header(); ?>


	<?php /*<div class="container-fluid">
        
		<div class="col-md-12 content-area">
			
			<?php while ( have_posts() ) : the_post(); ?>
	            
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="featuredImage">
						<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?> 
					</figure>
				<?php endif; ?>
	            
	            <div class="media title-colLeft  vSpacingT-sm">
					<div class="media-left">
					    <svg class="media-object titleIcone iconSvg pad-both">
							<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#ambassador"/>
						</svg>
					</div>
					<div class="media-body media-middle">
					    <?php the_title( '<h1>', '</h1>' ); ?>
					</div>
				</div>
	            

	            
				<div id="main" class="entry-content vSpacingT-sm" role="main">
					<div class="row">
			            <div class="col-xs-12">
		                    <div class="text-muted"><?php the_content(); ?></div>
			            </div>
			        </div>        
				</div>
	            
	        <?php endwhile; // end of the loop. ?>

	    </div><!-- #primary -->
        
    </div><!-- Container end --> */ ?>

<div class="wrapper" id="primary">
	
	<div class="container-fluid noPadding" id="ambassadors">
			<div class="col-xs-12 noPadding">
				<?php get_template_part( 'page-templates/list', 'ambassadors' ); ?>
			</div>
	</div>
    
    
</div><!-- Wrapper end -->
<?php get_footer(); ?>
