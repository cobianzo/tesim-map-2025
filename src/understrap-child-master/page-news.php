<?php get_header(); ?>

<div class="wrapper">
    
    <div id="primary" class="container-fluid noPadding ">
        
	   <div class="col-md-12 noPadding content-area">
	   		<div class="media title-colLeft">
				<div class="media-left">
				    <svg class="media-object titleIcone iconSvg pad-both">
						<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#news"/>
					</svg>
				</div>
				<div class="media-body media-middle">
				    <h3><span class="text-muted">ENI CBC</span> News</h3>
				</div>
			</div>
            <div id="main" class="entry-content" role="main">

	            <?php while ( have_posts() ) : the_post(); ?>
		            
				    <?php /* the_title( '<h1>', '</h1>' ); */ ?>
					<div class="row">
			            <div class="col-xs-12 col-md-9">
		                    <?php the_content(); ?>
			            </div>
						<div class="col-xs-12 col-md-3">
							<form action="<?php bloginfo('url'); ?>/stories/" method="get">
								<div class="form-group">
								<label for="exampleSelect1"><small class="text-muted">Filter news by :</small></label>
								<?php 
									$select = wp_dropdown_categories(
										array(
											'orderby'         => 'NAME',  // Order the items in the dropdown menu by their name
											'taxonomy'        => 'post_tag', // Only include posts with the taxonomy of 'tools'
											'name'            => 'post_tag',
											'value_field'     => 'slug',
											'show_count'	  => 1,
											'show_option_all' => 'All Programmes', // Text the dropdown will display when none of the options have been selected
											'selected'        => km_get_selected_taxonomy_dropdown_term(), // Set which option in the dropdown menu is the currently selected one
											'class'			  => 'form-control',
											'echo' 			  => 0,
										)
									);
									$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
									echo $select;
								?>
								<noscript><div><input type="submit" value="View" /></div></noscript>
								</div>
							</form>						
						</div>	
					</div>

                    
                <?php endwhile; // end of the loop. ?>
                
            </div><!-- #main -->
           <?php get_template_part( 'page-templates/list', 'news' ); ?>
	    </div><!-- #primary -->
        
    </div><!-- Container end -->
    
</div><!-- Wrapper end -->

<?php get_footer(); ?>
