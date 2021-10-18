<?php
/**
 * Template Name: Projects Map standalone
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
    .back-to-virtual-tour{
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 40px; /** size */
        z-index: 9;
        background: var(--tm-secondary);
        color: white;
        font-size: 2rem;
        border: 1px solid white;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 5px 5px 10px black;
        cursor: pointer;
    }
        .back-to-virtual-tour span {
            position: absolute;
            color: white;
        }
        .back-to-virtual-tour:hover {
            background: black;
            box-shadow: none;
            color: white;
        }
        @media only screen and (min-width: 1600px){ 
            .back-to-virtual-tour{
                top: 50px;
                right: 50px;
                padding: 50px; /** size */
            }
        }
    #container-with-nice-bg-img {    
        height: 100vh;
        border: 10px solid var(--tm-secondary);
        box-shadow: 3px 1px 10px black inset;
        display: flex;
        flex-direction: column;
        justify-content: center;
        
        background-size: cover;
        background-repeat: no-repeat;
    }
        #root  { text-align: center; }
        #root .TM_App {
            text-align: left;
            border-radius: 20px;   
            max-width: 1400px;     
            margin-left: auto;
            margin-right: auto; /** center the app */
            box-shadow: 5px 5px 30px rgb(0 0 0 / 50%);
        }

    
    @media only screen and (min-width: 1000px){ 
        #container-with-nice-bg-img{
            padding: 10px 40px;
        }
    }
    .row-desktop { display: none; } /** desktop */
    @media only screen and (min-width: 1000px) and (min-height:800px) { 
        .row-desktop {
            display: block;
            flex-grow: 1;
            background-repeat: no-repeat;
            background-position: center bottom;
        }
    }

    .top-row-desktop {
        background-image: url('<?php echo $static_imgs . '/top-row.png' ; ?>');
        background-size:  contain;
        margin: 10px;
    }
    .bottom-row-desktop {
        background-image: url('<?php echo $static_imgs . '/bottom-row.jpg' ; ?>');
        background-position: top center;
        opacity: 0.1;
        background-size: 100% auto;
    }
    @media only screen and (min-width: 1400px){ 
        .top-row-desktop {
            background-size: 1400px auto;
        }        
    
        .bottom-row-desktop {
            background-size: 1400px auto;
        }
    }

</style>

</head>

<body <?php body_class(); ?>>

<div id="no-page" class="hfeed site">

    <a href="https://tesim-enicbc.eu/eni-cbc-projects-virtual-tour" title="back to virtual tour" class="back-to-virtual-tour">
        <span>
            ⇠
        </span>
    </a>
    <div id="container-with-nice-bg-img" <?php
        if (has_post_thumbnail()) {
            echo "style='background-image: url(".get_the_post_thumbnail_url(get_the_ID(),'large').");'";
        }
    ?>>
        <div class="top-row-desktop row-desktop"></div>

        <?php get_template_part('inc/partial-react-map-root'); // show only map ?>

        <div class="bottom-row-desktop row-desktop"></div>
    </div>
</div> 
<?php wp_footer(); ?>