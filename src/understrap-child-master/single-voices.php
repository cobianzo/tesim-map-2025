<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */


get_header(); ?>
<div class="wrapper author" id="primary">
    <div  id="content" class="container-fluid noPadding ">

        <div class="col-md-12 noPadding content-area">
	        
	        
	       	    <?php while ( have_posts() ) : the_post(); ?>
		   			<figure class="col-md-6 noPadding author-sidePic">
		   				<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
		   			</figure>
		   			<section id="main" class="col-md-6 author-main" role="main">
		                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="page-header author-header">
		                        <div class="media">
								  <div class="media-left noPaddingR media-middle">
								    <svg class="media-object titleIcone iconSvg pad-both">
										<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#ambassador"/>
									</svg>
								  </div>
								  <div class="media-body media-middle">
										<h5><span class="text-muted">Voices from the field</span></h5>
										<?php the_title( '<h3 class="noMargin">', '</h3>' ); ?>
			                            <span class="entry-meta">
				                            <?php
												$ambassador_position = get_field('voice_position');
												if ( ! empty( $ambassador_position ) ) : ?>    
													<?php echo $ambassador_position; ?>, 
				                            <?php endif; ?>
				                            
				                            <?php
												$ambassador_country = get_field_object('voice_country');
												$value = $ambassador_country['value'];
												$ambassador_country_value = $ambassador_country['choices'][ $value ];
												if ( ! empty( $ambassador_country ) ) : ?>
													<?php echo $ambassador_country_value ?>
				                            <?php endif; ?>
			                            </span>
								  </div>
								</div>
		                    </header><!-- .page-header -->   
		                    
		                  						    
						    
							<div class="">
								<?php if ( in_category('interview') ) {
								    echo 	'<aside class="icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-comments-o fa-stack-1x fa-inverse"></i></span></aside>';
								} elseif ( in_category('quote') ) {
								    echo 	'<aside class="icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-quote-right fa-stack-1x fa-inverse"></i></span></aside>';	
								} elseif ( in_category('video') ) {
								    echo 	'<aside class="icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-video-camera fa-stack-1x fa-inverse"></i></span></aside>';
								} ?>
								<h2 class="marginBot30"><?php echo get_field('voice_title') ?></h2>
								<?php the_content(); ?>
								
								<?php
									$ambassador_bio_short = get_field('voice_biography' );
									if ( ! empty( $ambassador_bio_short ) ) : ?>
		                                <dt class="paddingTop30"><span class="entry-meta"><?php esc_html_e( 'Biography', 'understrap' ); ?></span></dt>
										<dd style="font-size: smaller; color: #818a91; line-height: 24px;"><?php echo $ambassador_bio_short; ?></dd>
	                            <?php endif; ?>
								
								<aside class="row">
									<div id="shareme" class="col-xs-12 sharrre">
							            <div class="box">
							                <div class="left"><i class="fa fa-share"></i>&nbsp; Share &amp; Discuss</div>
							                <div class="middle">
							                    <a target="_blank" OnClick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=400'); return false;" href="https://www.facebook.com/sharer.php?u=<?php global $wp; echo home_url( $wp->request ); ?>" class="facebook"><i class="fa fa-facebook fa-2x"></i></a>
							                    <a target="_blank" OnClick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=250'); return false;" href="https://twitter.com/share?url=<?php echo home_url( $wp->request ); ?>&text=<?php echo $curauth->display_name; ?>&via=[via]&hashtags=[hashtags]" class="twitter"><i class="fa fa-twitter fa-2x"></i></a>
							                    <a target="_blank" OnClick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=550'); return false;" href="https://www.linkedin.com/shareArticle?url=<?php echo home_url( $wp->request ); ?>&title=<?php echo $curauth->display_name; ?>" class="linkedIn"><i class="fa fa-linkedin fa-2x"></i></a>
							                    <a target="_blank" OnClick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=400'); return false;" href="https://wa.me/?text=<?php echo $curauth->display_name; ?> <<?php echo home_url( $wp->request ); ?>" class="whatsapp"><i class="fa fa-whatsapp fa-2x"></i></a>
							                </div>
							            </div>
							        </div>
								</aside>
								
							</div><!-- .entry-content -->
						
							<footer class="entry-footer">
						
								<?php /* understrap_entry_footer(); */ ?>
						
							</footer><!-- .entry-footer -->
						
						</article><!-- #post-## -->
		   			</section>

	
	            <?php endwhile; // end of the loop. ?>
				
				<div class="col-md-12 noPaddingL noPaddingR content-area paddingTop60">
<!-- 					<h5 class="text-muted">Continue Reading</h5> -->
					<?php get_template_part( 'page-templates/list', 'voices-measonry' ); ?>
				</div><!-- #primary -->


        </div><!-- .row -->
        
    </div><!-- Container end -->
    
</div><!-- Wrapper end -->
<?php wp_footer(); ?>
<?php /* get_footer(); */ ?>
