<?php
/**
 * The template used for displaying single stories
 *
 * @package understrap
 */
?>
<?php if ( has_post_thumbnail() ) : ?>
	<figure class="featuredImage">
		<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?> 
	</figure>
<?php endif; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		 <div class="entry-meta">
			<?php if ( is_singular( 'event' ) ) : ?>	
				<?php echo do_shortcode('[event post_id="' .$post->ID. '"]#_EVENTTAGS[/event]'); ?>
			<?php else: ?>
				<i class="fa fa-calendar" aria-hidden="true"></i> <?php the_date(); ?> 
				<?php the_terms( $post->ID, 'themes', '<i class="fa fa-tag marginLeft30" aria-hidden="true"></i> ', ', ', ' ' ); ?>
				<i class="fa fa-map-marker marginLeft30" aria-hidden="true"></i>
				<?php
				$posttags = get_the_tags();
				if ($posttags) {
				  foreach($posttags as $tag) {
				    echo $tag->name . ' '; 
				  }
				}
				?>
			<?php endif; ?>
		</div><!-- .entry-meta -->
		
		
		
		<div class="entry-meta">
			
			<?php /*
				$terms = get_the_terms ($post->id, 'themes');
				if ( !is_wp_error($terms)) : ?>
				
				<?php 
				    $themes_links = wp_list_pluck($terms, 'name'); 
				    $themes_yo = implode(", ", $themes_links);
				?>
				<span><?php echo $themes_yo; ?></span> */ ?>
		</div>
	</header><!-- .entry-header -->
    <div class="row">
		<div class="col-xs-12">
			<?php the_content(); ?>
			<?php /*
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
					'after'  => '</div>',
				) );
			*/ ?>
		</div><!-- .entry-content -->
	</div>
	<aside class="row">
		<div id="shareme" class="col-xs-12 sharrre">
            <div class="box">
                <div class="left"><i class="fa fa-share"></i>&nbsp; Share &amp; Discuss</div>
                <div class="middle">
                    <a target="_blank" OnClick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=400'); return false;" href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="facebook"><i class="fa fa-facebook fa-2x"></i></a>
                    <a target="_blank" OnClick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=250'); return false;" href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>&via=[via]&hashtags=[hashtags]" class="twitter"><i class="fa fa-twitter fa-2x"></i></a>
                    <a target="_blank" OnClick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=550'); return false;" href="https://www.linkedin.com/shareArticle?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" class="linkedIn"><i class="fa fa-linkedin fa-2x"></i></a>
                    <a target="_blank" OnClick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=400'); return false;" href="https://wa.me/?text=<?php the_title(); ?> <?php the_permalink(); ?>" class="whatsapp"><i class="fa fa-whatsapp fa-2x"></i></a>
                </div>
            </div>
        </div>
	</aside>

<?php if (in_category('stories')) : ?>
	
	<hr class="vSpacing">
	<div class="row">
		<div class="col-xs-12 media">
			<div class="media-left hidden-sm-down">
				<div class="media-object" style="width: 120px;">
					<small class="text-muted">Check out the programme</small><br>
				</div>
			</div>
			<div class="media-body">
				<a href="/programmes/<?php
						$posttags = get_the_tags();
						if ($posttags) {
						  foreach($posttags as $tag) {
						    echo $tag->slug . '/'; 
						  }
						}
						?>" class="btn btn-outline-primary">
					<?php
						$posttags = get_the_tags();
						if ($posttags) {
						  foreach($posttags as $tag) {
						    echo $tag->name . ' '; 
						  }
						}
						?> Programme
				</a>
			</div>
		</div>
	</div>
	
	<?php
	$curauth = get_the_author_meta('ID');
	$ambassador_badge = get_field('profile_picture', 'user_'. $curauth );
	?>
	<hr class="vSpacing">
	<div class="row">
		<div class="col-xs-12">
			<footer class="entry-footer media entry-by-author">
				<?php if ( $curauth == 14 ) : ?>
					<?php /* */?>
					<figure class="media-left">
					    <svg class="media-object titleIcone iconSvg pad-both media-object rounded-circle">
							<use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/img/icons.svg#ambassador"/>
						</svg>
					</figure>				
			
					<div class="media-body">		
						<small class="text-muted">This story was written by:</small>
						<br>
						<strong>TESIM</strong>
					</div>
					
					
					<?php /*
					<div class="media-body">		
						<small class="text-muted">This story was written by the <?php
							$posttags = get_the_tags();
							if ($posttags) {
							  foreach($posttags as $tag) {
							    echo $tag->name . ' '; 
							  }
							}
							?> Programme</small><br>
					</div>
								
					<div class="media-body">		
						<small class="text-muted">This story was written by <strong>TESIM</strong></small><br><br>
					</div> */?>
				<?php else: ?>
					<?php if( !empty($ambassador_badge) ): 
							// vars
							$title = $ambassador_badge['title'];
							$alt = $ambassador_badge['alt'];
						
							// thumbnail
							$size = 'thumbnail';
							$thumb = $ambassador_badge['sizes'][ $size ];
							$width = $ambassador_badge['sizes'][ $size . '-width' ];
							$height = $ambassador_badge['sizes'][ $size . '-height' ];
						?>
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" title="<?php echo $title; ?>" class="media-left" >
							<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php /* echo $width; */?> 100" height="<?php /* echo $height; */ ?> 100" class="media-object rounded-circle" />
						</a>		
					<?php endif; ?>
			
					<div class="media-body">		
						<small class="text-muted">This story was written by:</small><br>
						<p style="margin-bottom: .3rem;">
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" title="<?php echo $title; ?>" class="underLining">
								<strong><?php the_author_link(); ?></strong>
							</a>
						</p>
						<?php
							$ambassador_bio = get_field('ambassador_biography_short', 'user_'. $curauth );
							if ( ! empty( $ambassador_bio ) ) : ?>
								<div class="text-muted ambassador_excerp"><?php echo $ambassador_bio; ?></div>
			            <?php endif; ?>
			    		<?php /* understrap_entry_footer(); */?>
					</div>
			
				<?php endif; ?>
			</footer><!-- .entry-footer -->
		</div>
	</div>
	<hr>
	
	
<?php else: ?>
	



<?php endif; ?>

</article><!-- #post-## -->