<?php
/**
 * Template Name: Virtual Tour standalone
 *
 * Template for displaying a page without any relation to the rest of the site. 
 *
 * @package understrap
 */ 

?>
<!DOCTYPE html>
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

<?php 
    $static_imgs = get_stylesheet_directory_uri() . '/inc/imgs';
?>
<style>
    #container-with-nice-bg-img {    
        height: 100vh;
        border: 10px solid var(--tm-secondary);
        padding: 10px 10px 30px; 
        box-shadow: 3px 1px 10px black inset;
        display: flex;
        flex-direction: column;
        justify-content: center;
        
        background-size: cover;
        background-repeat: no-repeat;
    }
    .kuula-supercontainer {
        /* flex: 0 0 auto !important; /** overwrite the inner style */
    }
    .kuula-container {
        height: 100%;
    }

</style>

</head>

<body <?php body_class(); ?>>

<div id="no-page" class="hfeed site">

    <div id="container-with-nice-bg-img" <?php
        if (has_post_thumbnail()) {
            echo "style='background-image: url(".get_the_post_thumbnail_url(get_the_ID(),'large').");'";
        }
    ?>>
        

        <?php get_template_part('inc/partial-tesim-virtual-tour-v2'); // show only map ?>

    </div>
</div> 
<?php wp_footer(); ?>