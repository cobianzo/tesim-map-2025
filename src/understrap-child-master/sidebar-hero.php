<?php /* if ( is_active_sidebar( 'hero' ) ): ?>

    <!-- ******************* The Hero Widget Area ******************* -->

    <div class="wrapper" id="wrapper-hero">

        <div class="owl-carousel">

            <?php dynamic_sidebar( 'hero' ); ?>

        </div><!-- .owl-carousel -->

    </div><!-- #wrapper-hero -->

<?php endif; */ ?>




<?php if ( is_active_sidebar( 'hero' ) ): ?>

    <!-- ******************* The Hero Widget Area ******************* -->

    <div class="wrapper" id="wrapper-hero">

		<div class="container-fluid colophon heroCarousel">
			<div class="row"><!-- <div class="is-table-row"> -->
		
				<div class="col-xs-12 col-md-5 col-lg-6 colophon-map noPadding">
					<figure class="featuredImage">
						<img width="1024" height="719" src="https://tesim-enicbc.eu/wp-content/uploads/2019/08/mappa-EU-Tesim-Vectorial-2019-WK-1024x719.gif" class="attachment-large size-large wp-post-image" alt="" srcset="https://tesim-enicbc.eu/wp-content/uploads/2019/08/mappa-EU-Tesim-Vectorial-2019-WK-1024x719.gif 1024w, https://tesim-enicbc.eu/wp-content/uploads/2019/08/mappa-EU-Tesim-Vectorial-2019-WK-420x295.gif 420w, https://tesim-enicbc.eu/wp-content/uploads/2019/08/mappa-EU-Tesim-Vectorial-2019-WK-768x539.gif 768w" sizes="(max-width: 1024px) 100vw, 1024px">
					</figure>
					<aside class="logoEu">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-flag-europe.svg" alt="European Neighbourhood Intrument" width="60" height="40" >
					</aside>
					<aside class="logoParticip">
						<img src="/wp-content/themes/understrap-child-master/img/logo-particip.png" alt="Particip">
					</aside>
					<?php /* <aside>
						<p><i class="fa fa-square theBlue" aria-hidden="true"></i> Over 30 EU member states and neighbouring countries</p><p><i class="fa fa-square theBlue" aria-hidden="true"></i> Thousands of km of land and sea borders</p><p><i class="fa fa-square theBlue" aria-hidden="true"></i> €1 billion</p>
					</aside> */ ?>
				</div>
		
				<div class="col-xs-12 col-md-7 col-lg-6 noPadding">
					<div class="owl-carousel">
					<?php dynamic_sidebar( 'hero' ); ?>
					</div><!-- .owl-carousel -->
				</div>
				
			</div>
		</div>

    </div><!-- #wrapper-hero -->

<?php endif; ?>


