<?php
/* 
Template Name: Archives-Stories
*/
get_header(); ?>


<div class="wrapper">
    
    <div class="container-fluid">
        
	   <div class="col-md-12 content-area">
		   <?php while ( have_posts() ) : the_post(); ?>
	   		<div class="media title-colLeft vSpacingT-sm">
				<div class="media-left paddingTop10">
				    <svg class="media-object titleIcone iconSvg pad-both">
						<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#stories"/>
					</svg>
				</div>
				<div class="media-body media-middle">
				    <h1><span class="text-muted">ENI CBC Stories</span><br><?php the_title(); ?></h1>
				</div>
			</div>
            <div id="main" class="entry-content vSpacingT-sm" role="main">
    
				<div class="row">
		            <?php /*<div class="col-xs-12 col-md-9">
	                    <div class="text-muted"><?php the_content(); ?></div>
		            </div> + add following class to next div col-md-3*/ ?>
					<div class="col-xs-12 col-md-3">
						
						<?php /*	
						<form action="<?php bloginfo('url'); ?>/stories/" method="get">
                        <div>
                            <?php
                            $taxonomies = array('themes'); //CHANGE ME!
                            $args = array('orderby'=>'name','hide_empty'=>false);
                            $select = get_terms_dropdown_themes($taxonomies, $args);
                            $select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
                            echo $select;
                            ?>
                     
                            <input type="submit" name="submit" value="filter" /> <!--CHANGE VALUE TO YOUR LIKING!-->
                        </div>
                    </form>

						
						
						
						<select>
    <?php
       $tax_terms = get_terms('themes', array('hide_empty' => '0'));      
       foreach ( $tax_terms as $tax_term ):  
          echo '<option value="'.$tax_term->name.'">'.$tax_term->name.'</option>';   
       endforeach;
    ?>
</select> 


<?php click_taxonomy_dropdown( 'themes' ); ?>
						
						

								<form method="get" action="/">
									<fieldset>
										<?php $args = array(
//											'orderby'         => 'NAME',  // Order the items in the dropdown menu by their name
											'taxonomy'        => 'post_tag',
//											'name'            => 'post_tag',
											'value_field'     => 'slug',		
											'show_count'	  => 0,																								
											'show_option_all' => 'All Programmes',
											//'walker' 		  => new my_Walker_CategoryDropdown,
											'class'			  => 'form-control',
											//'echo' 		  => 0,
											'hide_if_empty'	  => 1
										);
								
										wp_dropdown_categories( $args ); ?>
										<script type="text/javascript"><!--
										    var dropdown = document.getElementById("cat");
										    function onCatChange() {
												if ( dropdown.options[dropdown.selectedIndex].value != '0' ) {
													location.href = "<?php bloginfo('url'); ?>/stories/?post_tag="+dropdown.options[dropdown.selectedIndex].value;
												}
										    }
										    dropdown.onchange = onCatChange;
										--></script> 
										
									</fieldset>
								</form>
						
						
		*/?>
		
												
						<form action="<?php bloginfo('url'); ?>/stories/" method="get">
							<div class="form-group">
								<label for="exampleSelect1">
									<small class="text-muted">Filter stories by :</small>
								</label>
								<?php 
									$select = wp_dropdown_categories(
										array(
											'orderby'         => 'NAME',  // Order the items in the dropdown menu by their name
											'taxonomy'        => 'post_tag', // Only include posts with the taxonomy of 'tools'
											'name'            => 'post_tag',
											//'exclude'		  =>  array( 'cat' => '4' ),
											'value_field'     => 'slug',
											'show_count'	  => 0,
											'show_option_all' => 'All Programmes', // Text the dropdown will display when none of the options have been selected
											'selected'        => 1, //km_get_selected_taxonomy_dropdown_term(), // Set which option in the dropdown menu is the currently selected one
											'class'			  => 'form-control',
											'echo' 			  => 0,
											'hide_if_empty'	  => 1
										)
									);
									$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
									echo $select;
								?>
								<noscript><div><input type="submit" value="View" /></div></noscript>
							</div>
						</form>	
						<?php /*		
						
						<form id="tool-category-select" class="tool-category-select" method="get">
						
						<?php
							// Create and display the dropdown menu.
							wp_dropdown_categories(
								array(
									'orderby' => 'NAME', // Order the items in the dropdown menu by their name.
									'taxonomy' => 'themes', // Only include posts with the taxonomy of 'tools'.
									'name' => 'themes', // Change this to the
									'show_option_all' => 'All Tools', // Text the dropdown will display when none of the options have been selected.
									'selected' => jh_get_selected_taxonomy_dropdown_term(), // Set which option in the dropdown menu is the currently selected one.
								)
							);
							?>
							
							<input type="submit" value="View" />
						</form> */ ?>
				
					</div>	
				</div>

           	</div><!-- #main -->
            
            <?php endwhile; // end of the loop. ?>
            
	    </div><!-- #primary -->
        
    </div><!-- Container end -->
    
    
    
    
    
    <div id="primary" class="container-fluid noPadding ">
        
	   <div class="col-md-12 noPadding content-area">
            
           <?php get_template_part( 'page-templates/list', 'stories-measonry' ); ?>
	    </div><!-- #primary -->
        
    </div><!-- Container end -->
    <?php get_template_part( 'inc/partial', 'newsletterform' ); ?>
</div><!-- Wrapper end -->

<?php get_footer(); ?>
