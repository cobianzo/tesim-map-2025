<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target="#chapter-navbar">

<div id="page" class="hfeed site">
    
    <!-- ******************* The Navbar Area ******************* -->
    <div class="wrapper-fluid wrapper-navbar" id="wrapper-navbar">
	
        <a class="skip-link screen-reader-text sr-only" href="#content"><?php _e( 'Skip to content', 'understrap' ); ?></a>

        <nav class="navbar site-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                            

                <div class="container-fluid">


                    <div class="navbar-header">

                        <!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
                        <button class="navbar-toggle hidden-md-up" type="button" data-toggle="collapse" data-target=".exCollapsingNavbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Your site title as branding in the menu -->
                        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
	                        <?php /* bloginfo( 'name' ); */?>
	                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-tesim-xs-purple.png" alt="Tesim" class="brand-logo logoSm hidden-lg-up">
	                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-tesim-lg.png" alt="Tesim" class="brand-logo logoLg hidden-md-down">
	                    </a>
						
                    </div>

                    <!-- The WordPress Menu goes here  - u-fadeInLeftBig -->
                    <?php wp_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'container_class' => 'collapse navbar-toggleable-sm exCollapsingNavbar ',
                                'menu_class' => 'nav navbar-nav float-md-right',
                                'fallback_cb' => '',
                                'menu_id' => 'main-menu',
                                'walker' => new wp_bootstrap_navwalker()
                            )
                    ); ?>
                    <div class="socialBtn-cont hidden-md-down">
						<div class="row noPadding navFooterLink">
							<div class="col-xs-12">
								<a class="col-xs-3" href="<?php echo get_page_link(787); ?>">FR</a>
								<a class="col-xs-3" href="<?php echo get_page_link(790); ?>">RU</a>
								<a class="col-xs-3" href="<?php echo get_page_link(793); ?>">العَرَبِيَّة</a>
								<a class="col-xs-3" href="<?php echo get_page_link(787); ?>" data-toggle="modal" data-target="#mySearchModal"><i class="fa fa-lg fa-search" aria-hidden="true"></i></a>
							</div>
						</div>
						<div class="rossw">
							<div class="col-xs-12 col-sm-4 noPadding">
								<a href="https://twitter.com/enicbc" target="_blank" class="socialBtn socialBtn-Tw text-xs-center"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a>
							</div>
							<div class="col-xs-12 col-sm-4 noPadding">
								<a href="https://www.facebook.com/enicbc/" target="_blank" class="socialBtn socialBtn-Fb text-xs-center"><i class="fa fa-facebook fa-2x" aria-hidden="true"></i></a>
							</div>
							<div class="col-xs-12 col-sm-4 noPadding">
								<a href="https://www.youtube.com/channel/UCQ45ZUYKKSRJt1CdoI2Y08w" target="_blank" class="socialBtn socialBtn-Yt text-xs-center"><i class="fa fa-youtube fa-2x" aria-hidden="true"></i></a>
							</div>
						</div>
					</div>		
                </div> <!-- .container -->
                
            
        </nav><!-- .site-navigation -->
        
    </div><!-- .wrapper-navbar end -->




<!-- Search Modal -->
<div class="modal fade" id="mySearchModal" tabindex="-1" role="dialog" aria-labelledby="srch-term" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		  	<form class="form-inline"  role="search" method="get" action="<?php echo home_url() ; ?>">
				<div class="form-group input-group-lg col-sm-10">
					<div class="col-sm-12">
						<label class="sr-only" for="srch-term">Search for...</label>
						<input class="form-control form-control-lg"  placeholder="Search for..." type="search" value="" name="s" id="srch-term">
					</div>
				</div>
				<button type="submit" class="btn btn-lg btn-outline-secondary" value=""><i class="fa fa-lg fa-search" aria-hidden="true"></i></button>    
		    </form>
		</div>
	</div>
</div>



