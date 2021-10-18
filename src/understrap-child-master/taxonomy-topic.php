<?php
/**
 * Template Name: Q&A Page topic
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

get_header(); ?>

<div class="wrapper" id="archive-wrapper">
    
    <div  id="content" class="container">

        <div class="row">
        
    	    <div id="primary" class="col-md-12 content-area">
               
            	<main id="main" class="site-main" role="main">
					<div class="media title-colLeft vSpacingT-sm">
						<div class="media-left">
							<svg class="media-object titleIcone iconSvg pad-both">
								<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#callforproposal"/>
							</svg>
						</div>
						<div class="media-body media-middle">
							<?php
                                single_term_title( '<h1 class="page-title"><span class="text-muted">Questions and Answers:</span><br>', '</h1>' );
                            ?>
						</div>
					</div>
					<br>
					<div class="entry-content pb-5">
						<?php the_archive_description( '<div class="lead" style="color: #808080;">', '</div>' ); ?>
						
						<div id="accordion_topics" role="tablist" aria-multiselectable="true" class="accordion-tesim mt-3">
								<?php 
									$term = get_queried_object();
									$taxonomies = get_terms( $term->taxonomy, array(
										'parent'    => $term->term_id,
										'hide_empty' => false
									) );
								foreach ( $taxonomies as $taxonomy ) {

									echo '<div class="card cardQandA">';
									echo 	'<div class="card-header" role="tab" id="' . $taxonomy->slug . '">';
									echo 		'<a data-toggle="collapse" data-parent="#accordion_topics" href="#collapse' . $taxonomy->term_id . '" aria-expanded="true" aria-controls="collapse' . $taxonomy->term_id . '" class="collapsed">';
									echo 			'<h4 class="">' . $taxonomy->name . '</h4>'; 
									echo 		'</a>';
									echo 	'</div>';
									echo 	'<div id="collapse' . $taxonomy->term_id . '" class="collapse show" role="tabpanel" aria-labelledby="' . $taxonomy->slug . '">';

									$args = array(
										'tax_query' => array(
											array(
												'taxonomy' => $taxonomy->taxonomy,
												'field'    => 'slug',
												'terms'    => array( $taxonomy->slug ),
											)
										)
									);
									query_posts( $args );	
									if ( have_posts() ) : 
										while ( have_posts() ) : the_post(); ?>
										
											<article id="post-<?php the_ID(); ?>" <?php post_class('card my-0'); ?>>
												<div class="card-block card-block-child my-0" role="tab" id="heading-<?php the_ID(); ?>">
											        <a data-toggle="collapse" data-parent="#accordion_<?php echo $taxonomy->term_id ?>" href="#collapse-<?php the_ID(); ?>" aria-expanded="true" aria-controls="collapse-<?php the_ID(); ?>" class="collapsed unCollapsed">
											        	<?php the_title( '<h6 class="card-title my-0 py-0">', '</h6>' ); ?>
													</a>
												</div>
												<div id="collapse-<?php the_ID(); ?>" class="collapse show" role="tabpanel" aria-labelledby="heading-<?php the_ID(); ?>">
													<div class="card-block py-0" style="color: #808080;">
														<?php the_content(); ?>
													</div>
												</div>
											</article><!-- #post-## -->
									<?php 		
										endwhile;
										
									endif;
									wp_reset_query();
									
									echo 	'</div>'; // end of collapse show		
									echo '</div>';
								}; ?>
								<br>
								<p class="text-muted">Back to all <a href="<?php echo get_page_link(8); ?>">questions and answers</a></p>
						</div>

					</div> <!-- end of .entry-content -->

				</main><!-- #main -->

			</div><!-- #primary -->

		</div> <!-- .row -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
