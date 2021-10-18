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
							<h1 class="entry-title"><?php echo get_the_title(8); ?></h1>
						</div>
					</div>
					<br>
					<div class="entry-content pb-5">
						<p class="lead" style="color: #808080;">
							<?php $post_8 = get_post( 8 ); 
								echo $post_8->post_content;
								
							?>
						</p>
						<div id="accordion_topics" role="tablist" aria-multiselectable="true" class="accordion-tesim mt-3">
							<?php 
								global $post;
								$taxonomies = get_terms( 'topic', array( 'order' => 'DESC', 'parent'  => 0 ) );
								foreach ( $taxonomies as $taxonomy ) {
									$term_link = get_term_link( $taxonomy );
									echo '<div class="card cardQandA">';
									echo 	'<div class="card-header">';
									echo 		'<a href="' . esc_url( $term_link ) . '">';
									echo 			'<h4 class="">' . $taxonomy->name . '</h4>'; 
									echo 			'<p style="color: #808080;">' . $taxonomy->description . '</p>'; 									
									echo 		'</a>';
									echo 	'</div>';
									echo '</div>';																		
								}; ?>
						</div>

					</div> <!-- end of .entry-content -->

				</main><!-- #main -->

			</div><!-- #primary -->

		</div> <!-- .row -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
