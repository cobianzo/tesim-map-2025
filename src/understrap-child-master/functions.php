<?php

// @COBIANZO ADDED: Tesim map
require_once(get_stylesheet_directory() . "/inc/functions-map-projects.php");


function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );


add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), '5.6.4');
   // wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/colcade.js', array(), '0.1.1', true );
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), '0.1.4', true );
}






/*  ---------------------------------------------------- CUSTOM  BACK END */

# CMS : Adds instruction text after the post title input 
function emersonthis_edit_form_after_title() {
    $tip = '<strong>TIP:</strong> To create a single line break use SHIFT+RETURN. By default, RETURN creates a new paragraph.';
    echo '<p style="margin-bottom:0;">'.$tip.'</p>';
}
add_action(
    'edit_form_after_title',
    'emersonthis_edit_form_after_title'
);


// Custom Post Type: Programmes

add_action( 'init', 'create_post_type_programmes' );
function create_post_type_programmes() {
	register_post_type( 'programmes',
		array(
			'labels' => array(
				'name' => __( 'ENI CBC Programmes' ),
				'singular_name' => __( 'Programmes' )
			),
		'public' => true,
		'has_archive' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-pressthis',
		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' )
		)
	);
	register_taxonomy(
 	'cat-programmes',
 	array('programmes'),
 	array(	
 	  'labels' => array(
 			'name' => 'Type de programmes',
 			'singluar_name' => 'Type de programmes'
 		),
 		'public' => true,
 		'show_in_nav_menus' => true,
 		'show_ui' => true,
 		'show_admin_column' => true,
 		'show_tagcloud' => true,
 		'hierarchical' => true,
 		'rewrite' => array('slug' => 'type-de-programmes', 'with_front' => true)
 	)
 );
}


// Author page : Add a custom user role
$result = add_role( 'ambassador', __(
'Ambassadors' ),
	array(
		'read' => true, // true allows this capability
		'edit_posts' => true, // Allows user to edit their own posts
		'edit_pages' => true, // Allows user to edit pages
		'edit_others_posts' => true, // Allows user to edit others posts not just their own
		'create_posts' => true, // Allows user to create new posts
		'manage_categories' => true, // Allows user to manage post categories
		'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode
		'edit_themes' => false, // false denies this capability. User can’t edit your theme
		'install_plugins' => false, // User cant add new plugins
		'update_plugin' => false, // User can’t update any plugins
		'update_core' => false // user cant perform core updates
	)
);


// Filter to fix the Post Author Dropdown
add_filter('wp_dropdown_users', 'theme_post_author_override');
function theme_post_author_override($output)
{
	global $post, $user_ID;
  // return if this isn't the theme author override dropdown
  if (!preg_match('/post_author_override/', $output)) return $output;

  // return if we've already replaced the list (end recursion)
  if (preg_match ('/post_author_override_replaced/', $output)) return $output;

  // replacement call to wp_dropdown_users
	$output = wp_dropdown_users(array(
	  'echo' => 0,
		'name' => 'post_author_override_replaced',
		'selected' => empty($post->ID) ? $user_ID : $post->post_author,
		'include_selected' => true
	));

	// put the original name back
	$output = preg_replace('/post_author_override_replaced/', 'post_author_override', $output);

  return $output;
}


// Author page : tell WordPress to use RAND() SQL sorting when passing rand in orderby parameter
add_action( "pre_user_query", function( $query ) {
    if( "rand" == $query->query_vars["orderby"] ) {
        $query->query_orderby = str_replace( "user_login", "RAND()", $query->query_orderby );
    }
});

/**
 * Filter the except link	

function wpdocs_excerpt_more( $more ) {
    return '<a href="'.get_the_permalink().'" rel="nofollow" rel="btn btn-outline-secondary">Read MoreEEE...</a>';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );
 */


/*  -------------------------------------------------------------- STORIES */
/**
 * Get tools in the taxonomy term
 * @return WP_Query Tools in the taxonomy term.
 */
function km_get_tools_in_taxonomy_term($bypass=false) {
	return new WP_Query(
		array(
			'post_type'      => 'post',
			'cat'			=> 5,
			'posts_per_page' => 500,
			'tax_query'      => array(
				array(
					'taxonomy' => 'post_tag',
					'field'    => 'slug',
					'terms'    => km_get_selected_taxonomy_dropdown_term($bypass),
				),
			)
		)
	);
}
/**
 * Get the selected taxonomy dropdown term slug
 * @return string The selected taxonomy dropdown term slug.
 */
function km_get_selected_taxonomy_dropdown_term($bypass=false) {
	if($bypass) {
		return '';
	}
	return isset( $_GET[ 'post_tag' ] ) ? sanitize_text_field( $_GET[ 'post_tag' ] ) : '';
}



/* Get tools, filtered by the taxonomy term, if one was selected.
 * @return WP_Query Tools in the taxonomy term if one was selected, else all.
 */
function jh_get_tools_in_taxonomy_term() {
	return new WP_Query(
		array(
			'post_type' => 'stories', // Change this to the slug of your post type.
			'posts_per_page' => 500, // Display a maximum of 500 options in the dropdown.
			'tax_query' => jh_get_tools_in_taxonomy_term_tax_query(),
		)
	);
}

/* Get the taxonomy query to be used by km_get_tools_in_taxonomy_term().
 * @return array The taxonomy query if a term was selected, else an empty array.
 */
function jh_get_tools_in_taxonomy_term_tax_query() {
	$selected_term = jh_get_selected_taxonomy_dropdown_term();
	// If a term has been selected, use that in the taxonomy query.
	if ( $selected_term ) {
		return array(
			array(
				'taxonomy' => 'tools', // Change this to the slug of your taxonomy.
				'field' => 'term_id',
				'terms' => $selected_term,
			),
		);
	}
	// Otherwise, don't filter based on a taxonomy term and just get all the results.
	return array();
}

/* Get the selected taxonomy dropdown term slug.
 * @return string The selected taxonomy dropdown term ID, else empty string.
 */
function jh_get_selected_taxonomy_dropdown_term() {
	return isset( $_GET[ 'tools' ] ) && $_GET[ 'tools' ] ? sanitize_text_field( $_GET[ 'tools' ] ) : '';
}









/*  -------------------------------------------------------------- STORIES sideList */
/**
 * Return the post excerpt, if one is set, else generate it using the
 * post content. If original text exceeds $num_of_words, the text is
 * trimmed and an ellipsis (…) is added to the end.
 *
 * @param  int|string|WP_Post $post_id   Post ID or object. Default is current post.
 * @param  int                $num_words Number of words. Default is 55.
 * @return string                        The generated excerpt.
 */
function jh_get_the_excerpt( $post_id = null, $num_words = 20 ) {
	$post = $post_id ? get_post( $post_id ) : get_post( get_the_ID() );
	$text = get_the_excerpt( $post );
	if ( ! $text ) {
		$text = get_post_field( 'post_content', $post );
	}
	$generated_excerpt = wp_trim_words( $text, $num_words );
	return apply_filters( 'get_the_excerpt', $generated_excerpt, $post ); 

}





/*  ---------------------------------------------------- CUSTOM TAXONMY FOR THE 4 THEMES -----   */ 
//hook into the init action and call create_themes_nonhierarchical_taxonomy when it fires
 
add_action( 'init', 'create_themes_nonhierarchical_taxonomy', 0 );
 
function create_themes_nonhierarchical_taxonomy() {
 
// Labels part for the GUI
 
  $labels = array(
    'name' => _x( 'Themes', 'taxonomy general name' ),
    'singular_name' => _x( 'Theme', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Themes' ),
    'popular_items' => __( 'Popular Themes' ),
    'all_items' => __( 'All Themes' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Theme' ), 
    'update_item' => __( 'Update Theme' ),
    'add_new_item' => __( 'Add New Theme' ),
    'new_item_name' => __( 'New Theme Name' ),
    'separate_items_with_commas' => __( 'Separate Themes with commas' ),
    'add_or_remove_items' => __( 'Add or remove Themes' ),
    'choose_from_most_used' => __( 'Choose from the most used Themes' ),
    'menu_name' => __( 'Themes' ),
  ); 
 
// Now register the non-hierarchical taxonomy like tag
 
  register_taxonomy('themes','post',array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'theme' ),
//    'show_in_rest' => true,
  ));
}

function set_featured_image_display() {
  register_meta(
    'post',
    'MY_FIELD_NAME',
    array(
      'show_in_rest' => true,
      'single' => true,
      'type' => 'boolean'
    )
  );
}

add_action( 'init', 'set_featured_image_display' );



//Order archive tax themes by date
remove_all_filters('posts_orderby'); // ADDED
add_filter('pre_get_posts', 'order_tx_by_date', 9999);
function order_tx_by_date($q) {
    if (($q->is_main_query()) && (is_tax('themes')) ) {
    	$q->set('orderby', 'date');
		$q->set('order', 'DESC');
		$q->set('posts_per_page', '20');
		//$q->set('posts_per_page', '4');
		return $q;
	}
}




/*
// Story page dropdowns to filter
function click_taxonomy_dropdown($taxonomy) { ?>
	<form action="/" method="get">
	<select name="cat" id="cat" class="postform">
	<option value="-1">Choose one...</option>
	<?php
	$terms = get_terms($taxonomy);
	foreach ($terms as $term) {
		printf( '<option class="level-0" value="%s">%s</option>', $term->slug, $term->name );
	}
	echo '</select></form>';
	?>
<?php }
*/

// class my_Walker_CategoryDropdown extends Walker_CategoryDropdown {

// 	function start_el(&$output, $category, $depth, $args) {
// 		$pad = str_repeat(' ', $depth * 3);


// 		$cat_name = apply_filters('list_cats', $category->name, $category);
// 		$output .= "\t<option class=\"level-$depth\" value=\"".$category->slug."\"";
// 		if ( $category->term_id == $args['selected'] )
// 			$output .= ' selected="selected"';
// 		$output .= '>';
// 		$output .= $pad.$cat_name;
// 		if ( $args['show_count'] )
// 			$output .= '  ('. $category->count .')';
// 		if ( $args['show_last_update'] ) {
// 			$format = 'Y-m-d';
// 			$output .= '  ' . gmdate($format, $category->last_update_timestamp);
// 		}
// 		$output .= "</option>\n";
// 	}
// }

/* 
function get_terms_dropdown_themes($taxonomies, $args){
    $myterms = get_terms($taxonomies, $args);
    $output ="<select name='themes'>"; //CHANGE ME!
    $output .="<option value=''>Select theme</option>"; //CHANGE ME TO YOUR LIKING!
    foreach($myterms as $term){
        $root_url = get_bloginfo('url');
        $term_taxonomy=$term->taxonomy;
        $term_slug=$term->slug;
        $term_name =$term->name;
        $link = $term_slug;
        $output .="<option value='".$link."'>".$term_name."</option>";
    }
    $output .="</select>";
return $output;
}


function get_terms_dropdown_type($taxonomies, $args){
    $myterms = get_terms($taxonomies, $args);
    $output ="<select name='MYTAXONOMY#2'>"; //CHANGE ME!
    $output .="<option value=''>Select taxonomy #2</option>"; //CHANGE ME TO YOUR LIKING!               foreach($myterms as $term){
        $root_url = get_bloginfo('url');
        $term_taxonomy=$term->taxonomy;
        $term_slug=$term->slug;
        $term_name =$term->name;
        $link = $term_slug;
        $output .="<option value='".$link."'>".$term_name."</option>";
    }
    $output .="</select>";
return $output;
}
*/

/*  ---------------------------------------------------- CUSTOM POST TYPE -----   */ 
// Post Type Key: Call for proposal
function create_cpt_callsproposal() {

	$labels = array(
		'name' => __( 'Calls for proposal', 'Post Type General Name', 'textdomain' ),
		'singular_name' => __( 'Call for proposal', 'Post Type Singular Name', 'textdomain' ),
		'menu_name' => __( 'Calls for proposal', 'textdomain' ),
		'name_admin_bar' => __( 'Call for proposal', 'textdomain' ),
		'archives' => __( 'Call for proposal Archives', 'textdomain' ),
		'attributes' => __( 'Call for proposal Attributes', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Call for proposal:', 'textdomain' ),
		'all_items' => __( 'All Calls for proposal', 'textdomain' ),
		'add_new_item' => __( 'Add New Call for proposal', 'textdomain' ),
		'add_new' => __( 'Add New', 'textdomain' ),
		'new_item' => __( 'New Call for proposal', 'textdomain' ),
		'edit_item' => __( 'Edit Call for proposal', 'textdomain' ),
		'update_item' => __( 'Update Call for proposal', 'textdomain' ),
		'view_item' => __( 'View Call for proposal', 'textdomain' ),
		'view_items' => __( 'View Calls for proposal', 'textdomain' ),
		'search_items' => __( 'Search Call for proposal', 'textdomain' ),
		'not_found' => __( 'Not found', 'textdomain' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
		'featured_image' => __( 'Featured Image', 'textdomain' ),
		'set_featured_image' => __( 'Set featured image', 'textdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
		'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
		'insert_into_item' => __( 'Insert into Call for proposal', 'textdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Call for proposal', 'textdomain' ),
		'items_list' => __( 'Calls for proposal list', 'textdomain' ),
		'items_list_navigation' => __( 'Calls for proposal list navigation', 'textdomain' ),
		'filter_items_list' => __( 'Filter Calls for proposal list', 'textdomain' ),
	);
	$args = array(
		'label' => __( 'Call for proposal', 'textdomain' ),
		'description' => __( '', 'textdomain' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-slides',
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'categories' ),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 9,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'Calls-for-proposal', $args );
}
add_action( 'init', 'create_cpt_callsproposal', 0 );


/*  ---------------------------------------------------- CUSTOM POST TYPE -----   */ 
// Post Type Key: Questions and Answers
function create_cpt_questionandanswers() {
	$labels = array(
		'name' => __( 'Questions and answers', 'Post Type General Name', 'textdomain' ),
		'singular_name' => __( 'Question and answer', 'Post Type Singular Name', 'textdomain' ),
		'menu_name' => __( 'Q & A', 'textdomain' ),
		'name_admin_bar' => __( 'Question and answer', 'textdomain' ),
		'archives' => __( 'Question and answer Archives', 'textdomain' ),
		'attributes' => __( 'Question and answer Attributes', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Question and answer:', 'textdomain' ),
		'all_items' => __( 'All Questions and answers', 'textdomain' ),
		'add_new_item' => __( 'Add New Question and answer', 'textdomain' ),
		'add_new' => __( 'Add New', 'textdomain' ),
		'new_item' => __( 'New Question and answer', 'textdomain' ),
		'edit_item' => __( 'Edit Question and answer', 'textdomain' ),
		'update_item' => __( 'Update Question and answer', 'textdomain' ),
		'view_item' => __( 'View Question and answer', 'textdomain' ),
		'view_items' => __( 'View Questions and answer', 'textdomain' ),
		'search_items' => __( 'Search Question and answer', 'textdomain' ),
		'not_found' => __( 'Not found', 'textdomain' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
		'featured_image' => __( 'Featured Image', 'textdomain' ),
		'set_featured_image' => __( 'Set featured image', 'textdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
		'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
		'insert_into_item' => __( 'Insert into Question and answer', 'textdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Question and answer', 'textdomain' ),
		'items_list' => __( 'Question and answer list', 'textdomain' ),
		'items_list_navigation' => __( 'Questions and answers list navigation', 'textdomain' ),
		'filter_items_list' => __( 'Filter Questions and answers list', 'textdomain' ),
	);
	$args = array(
		'label' => __( 'Question and answer', 'textdomain' ),
		'description' => __( '', 'textdomain' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-sos',
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', ),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 9,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'rewrite' =>  array('slug' => 'questions-and-answers', 'with_front' => false),
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'question-and-answer', $args );
	
	
	// Add new taxonomy, make it hierarchical (like categories) ----- P R O G R A M M E S
	$labels = array(
		'name'              => _x( 'Topics', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Topic', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Topic', 'textdomain' ),
		'all_items'         => __( 'All Topics', 'textdomain' ),
		'parent_item'       => __( 'Parent Topic', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Topic:', 'textdomain' ),
		'edit_item'         => __( 'Edit Topic', 'textdomain' ),
		'update_item'       => __( 'Update Topic', 'textdomain' ),
		'add_new_item'      => __( 'Add New Topic', 'textdomain' ),
		'new_item_name'     => __( 'New Topic Name', 'textdomain' ),
		'menu_name'         => __( 'Topic', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest' 		=> true,
		'rewrite'           => array( 'slug' => 'topic', 'with_front' => false ),
	);
	register_taxonomy( 'topic', array( 'question-and-answer' ), $args );
}
add_action( 'init', 'create_cpt_questionandanswers', 0 );



function custom_taxonomy_flush_rewrite() {
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
add_action('init', 'custom_taxonomy_flush_rewrite');




/* https://wpbeaches.com/how-to-find-out-what-wordpress-template-is-being-used-in-a-theme/ 
add_action( 'admin_bar_menu', 'show_template' );
function show_template() {
global $template;
print_r( $template );
}

*/

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.

function wpdocs_excerpt_more( $more ) {
    return '[.....]';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' ); */
/*  --------------------------------------------------------------  */

/**
 * Custom post template for a specific category:
 */
 
function get_custom_cat_template($single_template) {
    global $post;
 
    if ( in_category( 'stories' )) {
          $single_template = dirname( __FILE__ ) . '/single-story.php';
    } elseif ( in_category( 'voices' )) {
          $single_template = dirname( __FILE__ ) . '/single-voices.php';
    } 
    return $single_template;
}
 
add_filter( "single_template", "get_custom_cat_template" ) ;

/*	--------------------------------------------------------------
	insert link to latest post (in category) on your menu
	
	Adam: add support for putting 'latest post in category X' to menu: */
// Front end only, don't hack on the settings page
if ( ! is_admin() ) {
    // Hook in early to modify the menu
    // This is before the CSS "selected" classes are calculated
    add_filter( 'wp_get_nav_menu_items', 'replace_placeholder_nav_menu_item_with_latest_post', 10, 3 );
}

// Replaces a custom URL placeholder with the URL to the latest post
function replace_placeholder_nav_menu_item_with_latest_post( $items, $menu, $args ) {

        $key = 'http://#latestpost:';

    // Loop through the menu items looking for placeholder(s)
    foreach ( $items as $item ) {
 
        // Is this the placeholder we're looking for?
        if ( 0 === strpos( $item->url, $key ) )
        {
 
        $catname = substr( $item->url, strlen($key) );
        // Get the latest post
        $latestpost = get_posts( 
        	array(
            	'posts_per_page' => 1,
                'category_name' => $catname
        ) );

        if ( empty( $latestpost ) )
            continue;

        // Replace the placeholder with the real URL
        $item->url = get_permalink( $latestpost[0]->ID );
        }
    }

    // Return the modified (or maybe unmodified) menu items array
    return $items;
}

/*  -------------------------------------------------------------- EVENT MANAGER - Add conditional has_attribute for the optional event url */
function em_event_output_condition_filter($replacement, $condition, $match, $EM_Event){
    // Checks for has_test conditional
    if(is_object($EM_Event) && preg_match('/^has_(event_external_url)$/', $condition, $matches)){
        if(array_key_exists($matches[1], $EM_Event->event_attributes) && !empty($EM_Event->event_attributes[$matches[1]]) ){
            $replacement = preg_replace("/\{\/?$condition\}/", '', $match);
        }else{
            $replacement = '';
        }
    }
    
    return $replacement;
}
add_filter('em_event_output_condition', 'em_event_output_condition_filter', 1, 4);

/*  -------------------------------------------------------------- WPDM Wordpress download manager */
/**
 * custom tag [categories_nolink] for comma separated categories without links.
*/
function wpdm_comma_separated_tax_terms($post_id){
    $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
    $terms = wp_get_post_terms( $post_id, 'wpdmcategory', $args );

    $terms_array = array();
    foreach ($terms as $term):
        $terms_array[] = $term->name;
    endforeach;

    return implode(', ', $terms_array);
}

function wpdm_custom_tags($vars){

    $vars['categories_nolink'] = wpdm_comma_separated_tax_terms($vars['ID']);

    return $vars;
}

add_filter( 'wdm_before_fetch_template', 'wpdm_custom_tags', 10, 1 );

/*  -------------------------------------------------------------- Adds 'has_thumb' Post Class if Post has thumbnail */
/**
 * Single story négative margin on 
*/ 

function has_thumb_class($classes) {
	global $post;
	if( has_post_thumbnail($post->ID) ) { $classes[] = 'has_thumb'; }

		return $classes;
}
add_filter('post_class', 'has_thumb_class');



/*  -------------------------------------------------------------- Disable Admin Bar for logged in subscribers  */
/**
 * 
*/
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
	//if ( in_array( ‘subscriber’, (array) $user->roles ) ) {
	//if (!current_user_can('administrator') && !is_admin()) {
	
	// show admin bar only for admins and editors
	if (!current_user_can('edit_posts')) {
		show_admin_bar(false);
	}
}



/*  -------------------------------------------------------------- Upload SVG */
/**
 * Allow SVG through WordPress Media Uploader
*/
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


/*  -------------------------------------------------------------- IMAGES SIZE */
/**
 * Change thumbnail size to 
*/

$GLOBALS['content_width'] = 1200;



/*  -------------------------------------------------------------- Mail : Password reset missing link */
/**
 * Change thumbnail size to 
*/

add_filter( 'wp_mail', 'dirty_wp_mail_filter' );
function dirty_wp_mail_filter( $args ) {

	/**
	 * Get HTML or message
	 */
	$index = isset( $args['html'] ) ? 'html' : 'message';

	// you can include your custom html mail template here
	// just use file_get_contents() functions to get template file and any php replace function like
	// str_ireplace or preg_replace to replace your given placeholder in template by the content which is sent by wp
	// Fix content taking into account the http/https
	$args[$index] = preg_replace("/\<((https|http)(.*))\>/", "$2$3", $args[$index] );

	add_filter( 'wp_mail_content_type', 'dirty_notification_content_type' );

	return $args;
}

function dirty_notification_content_type() {
	return 'text/html';
}
