<?php
/**
 * The template for displaying the author pages.
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
 *
 * @package understrap
 */
get_header(); ?>
<div class="wrapper author" id="primary">
    <div  id="content" class="container-fluid noPadding ">
        <?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
		<div class="col-md-12 noPadding content-area">
        		
    		<figure class="col-md-6 noPadding author-sidePic">
    			<?php
					//$ambassador_id = get_the_author_meta('ID');
					$ambassador_badge = get_field('profile_picture', 'user_'.$curauth->ID);
//							$ambassador_badge = get_field('profile_picture', 'user_'. $ambassador_id );
					if( !empty($ambassador_badge) ): ?>
						<img src="<?php echo $ambassador_badge['url']; ?>" alt="<?php echo $ambassador_badge['alt']; ?>"/>
				<?php endif; ?>  
    		</figure> 
            <section id="main" class="col-md-6 author-main" role="main">
                        
                    <header class="page-header author-header">
                        <div class="media">
						  <div class="media-left media-middle">
						    <svg class="media-object titleIcone iconSvg pad-both">
								<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#ambassador"/>
							</svg>
						  </div>
						  <div class="media-body media-middle">
								<h5><span class="text-muted">ENI CBC</span> in faces</h5>
								<h1><?php echo $curauth->display_name; ?></h1>
	                            <span class="entry-meta">
	                            <?php
									$ambassador_position = get_field('ambassador_position', 'user_'. $curauth->ID );
									if ( ! empty( $ambassador_position ) ) : ?>    
										<?php echo $ambassador_position; ?>, 
	                            <?php endif; ?>
	                            
	                            <?php
									$ambassador_country = get_field_object('ambassador_country', 'user_'. $curauth->ID );
									$value = $ambassador_country['value'];
									$ambassador_country_value = $ambassador_country['choices'][ $value ];
									if ( ! empty( $ambassador_country ) ) : ?>
										<?php echo $ambassador_country_value ?>
	                            <?php endif; ?>
	                            </span>
						  </div>
						</div>
                    </header><!-- .page-header -->   

                        <?php /* if ( ! empty( $curauth->ID ) ) : ?>
                            <?php echo get_avatar($curauth->ID); ?>
                        <?php endif; */ ?>
                                 
                        <dl>

							<?php /* 
								$ambassador_bio = get_field('ambassador_biography_short', 'user_'. $curauth->ID );
								if ( ! empty( $ambassador_bio ) ) : ?>
									<dt><?php esc_html_e( 'Biography', 'understrap' ); ?></dt>
									<dd><?php echo $ambassador_bio; ?></dd>
                            <?php endif; */ ?>
                            <?php
	                            $ambassador_title = get_field('ambassador_title', 'user_'. $curauth->ID );
	                            if ( ! empty( $ambassador_title ) ) : ?>
	                            <h2 class="marginBot30"><?php echo $ambassador_title; ?></h2>
	                        <?php endif; ?>                                                        
                            <?php
								$my_cbc_experience = get_field('my_cbc_experience', 'user_'. $curauth->ID );
								if ( ! empty( $my_cbc_experience ) ) : ?>
	                                <dt><span class="entry-meta"><?php esc_html_e( 'My CBC Experience', 'understrap' ); ?></span></dt>
									<dd><?php echo $my_cbc_experience; ?></dd>
                            <?php endif; ?>
                            
                            <?php
								$ambassador_bio_short = get_field('ambassador_biography', 'user_'. $curauth->ID );
								if ( ! empty( $ambassador_bio_short ) ) : ?>
	                                <dt><span class="entry-meta"><?php esc_html_e( 'Biography', 'understrap' ); ?></span></dt>
									<dd><?php echo $ambassador_bio_short; ?></dd>
                            <?php endif; ?>
                            
                            <?php 
	                            
	                            
	                            /* if ( ! empty( $curauth->user_description ) ) : ?>
                                <dt><?php esc_html_e( 'Profile', 'understrap' ); ?></dt>
                                <dd><?php echo $curauth->user_description; ?></dd>    
                            <?php endif;  ?>
                            
                            <?php  if ( ! empty( $curauth->user_email ) ) : ?>
	                                <dt><span class="entry-meta"><?php esc_html_e( 'Email :', 'understrap' ); ?></span></dt>
									<dd><a href="mailto:<?php echo $curauth->user_email;?>"><?php echo $curauth->user_email; ?></a></dd>
                            <?php endif; ?>
                            
                            <?php if ( ! empty( $curauth->user_url ) ) : ?>
                                <dt><span class="entry-meta"><?php esc_html_e( 'Website', 'understrap' ); ?></span></dt>
                                <dd><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></dd>
                            <?php endif; */?>
                            	                        
							
                        </dl>
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
                        
                            
                    
                    
                    
                        <!-- The Loop -->
                        
                        <?php if ( have_posts() ) :?>
                        <br>
                        <h5><?php esc_html_e( 'Stories by', 'understrap' ); ?> <?php echo $curauth->display_name; ?>:</h5>
                        <ul>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <li>
                                <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
                                <?php the_title(); ?></a>,
                                <span class="text-muted"><?php the_time('d M Y'); ?> <?php /* in <?php the_category('&'); */ ?></span>
                            </li>
                        
                        <?php endwhile; ?>

                            <?php the_posts_navigation(); ?>

                        <?php else : ?>

                            <?php /* get_template_part( 'loop-templates/content', 'none' ); */ ?>
						</ul>	
                        <?php endif; ?>
                        
                        <!-- End Loop -->
        
                    

            </section><!-- #main -->
               
			
               
        </div><!-- .col-md-12 noPadding content-area -->
    </div><!-- Container end -->
    <div class="container-fluid noPadding ">    
		<div class="col-md-12 noPadding paddingTop60 content-area">
		<?php get_template_part( 'page-templates/list', 'ambassadors' ); ?>
		</div>
    </div><!-- Container end -->
    
</div><!-- Wrapper end -->

<?php get_footer(); ?>