<?php 
/**
 * In this inc/ folder
 * 1) Partial to show the Virtual exhibition. `tesim-virtual-tour.php`
 * 2) Inside this partial, partial of the New Virtual exhibition, (better with buttons) `partial-tesim-virtual-tour-v2.php`
 *          and partial for the tesim map entry point, which is THIS FILE 
 * 3) This partial calls the REACT APP, which is inside `inc/react-map/` folder (it is the build folder of the create-react-app)
 * 
 * HOW?
 * 
 * 1) Declares the Custom Post Type 'project'
 * 	1.2) The Custom Post Type 'programme' is already defined in the original tesim site. 
 * 2) Defines the ACF fields for the projects
 * 	2.2) Same for programmes
 * 3) On every save post of a project, we update the file 'projects-and-programmes.json', inside the react app. (it could be outside, updating `env.tesimsite` before building)
 * 
 * From here, to know about how the app is developed and deployed, see the project `tesim-map`
*/
$directory_react_app 	 = '/inc/react-map';
$json_filename 			 = 'projects-and-programmes.json';
define('FULL_PATH_FILENAME', get_stylesheet_directory() . $directory_react_app . '/' . $json_filename);
define('FULL_URL_FILENAME', get_stylesheet_directory_uri() . '/' . $directory_react_app . '/' . $json_filename);

// $FULL_PATH_FILENAME 	 = get_stylesheet_directory() . $directory_react_app . '/' . $json_filename;
// $FULL_URL_FILENAME 		= get_stylesheet_directory_uri() . '/' . $directory_react_app . '/' . $json_filename;

// 1) Definition of the custom por type `enicbc-project` 
// Register Custom Post Type Project
add_action( 'init', 'project_post_type', 0 );
function project_post_type() {

	$labels = array(
		'name'  => _x( 'Projects', 'Project General Name', 'map' ),	'singular_name'  => _x( 'Project', 'Project Singular Name', 'map' ),	'menu_name'             => __( 'Projects', 'map' ),	'name_admin_bar'        => __( 'Project', 'map' ),	'archives'              => __( 'Item Archives', 'map' ),	'attributes'            => __( 'Item Attributes', 'map' ),	'parent_item_colon'     => __( 'Parent Item:', 'map' ),	'all_items'             => __( 'All Items', 'map' ),	'add_new_item'          => __( 'Add New Item', 'map' ),	'add_new'               => __( 'Add New', 'map' ),	'new_item'              => __( 'New Item', 'map' ),	'edit_item'             => __( 'Edit Item', 'map' ),	'update_item'           => __( 'Update Item', 'map' ),	'view_item'             => __( 'View Item', 'map' ),	'view_items'            => __( 'View Items', 'map' ),	'search_items'          => __( 'Search Item', 'map' ),	'not_found'             => __( 'Not found', 'map' ),	'not_found_in_trash'    => __( 'Not found in Trash', 'map' ),	'featured_image'        => __( 'Featured Image', 'map' ),	'set_featured_image'    => __( 'Set featured image', 'map' ),	'remove_featured_image' => __( 'Remove featured image', 'map' ),	'use_featured_image'    => __( 'Use as featured image', 'map' ),	'insert_into_item'      => __( 'Insert into item', 'map' ),	'uploaded_to_this_item' => __( 'Uploaded to this item', 'map' ),	'items_list'            => __( 'Items list', 'map' ),	'items_list_navigation' => __( 'Items list navigation', 'map' ),	'filter_items_list'     => __( 'Filter items list', 'map' ),
	);
	$args = array(
		'label'                 => __( 'Project', 'map' ),
		'description'           => __( 'Project Description', 'map' ),
		'labels'                => $labels,
		'supports'              => ['title', 'thumbnail'],
		'taxonomies'            => ['subthematic'], // custom taxonomy. No needed, the programme association is with another cpt, not taxonomy
		'hierarchical'  => false, 	'public' => true, 				'show_ui' => true, 'show_in_menu' => true,
		'menu_position' => 5, 		'show_in_admin_bar' => true, 	'show_in_nav_menus' => true, 'can_export' => true,
		'has_archive' 	=> false, 	'exclude_from_search' => true, 	'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'project', $args );
}

//hook into the init action and call create_subthematic_nonhierarchical_taxonomy when it fires
 
add_action( 'init', 'create_subthematic_nonhierarchical_taxonomy', 0 );
 
function create_subthematic_nonhierarchical_taxonomy() {
 
// Labels part for the GUI
 
  $labels = array(
    'name' => _x( 'Subthematics', 'taxonomy general name' ),
    'singular_name' => _x( 'Subthematic', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Subthematic' ),
    'popular_items' => __( 'Popular Subthematic' ),
    'all_items' => __( 'All Subthematics' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Subthematic' ), 
    'update_item' => __( 'Update Subthematic' ),
    'add_new_item' => __( 'Add New Subthematic' ),
    'new_item_name' => __( 'New Subthematic Name' ),
    'separate_items_with_commas' => __( 'Separate Subthematics with commas' ),
    'add_or_remove_items' => __( 'Add or remove Subthematics' ),
    'choose_from_most_used' => __( 'Choose from the most used Subthematics' ),
    'menu_name' => __( 'Subthematics' ),
  ); 
 
// Now register the non-hierarchical taxonomy like tag
 
  register_taxonomy('subthematics','project',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
	'meta_box_cb' => false,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'subthematic' ),
  ));
}
// // Definition of the taxonomy 'programme'  (NO, WE DONT NEED IT ,it is a custom post type instead, created in the original site.)
// // Register Custom Programme
// add_action( 'init', 'custom_taxonomy', 0 );
// function custom_taxonomy() {

// 	$labels = array(
// 		'name' => _x( 'Programmes', 'Programme General Name', 'map' ), 'singular_name'          => _x( 'Programme', 'Programme Singular Name', 'map' ), 'menu_name'                  => __( 'Programme', 'map' ), 'all_items'                  => __( 'All Items', 'map' ), 'parent_item'                => __( 'Parent Item', 'map' ), 'parent_item_colon'          => __( 'Parent Item:', 'map' ), 'new_item_name'              => __( 'New Item Name', 'map' ), 'add_new_item'               => __( 'Add New Item', 'map' ), 'edit_item'                  => __( 'Edit Item', 'map' ), 'update_item'                => __( 'Update Item', 'map' ), 'view_item'                  => __( 'View Item', 'map' ), 'separate_items_with_commas' => __( 'Separate items with commas', 'map' ), 'add_or_remove_items'        => __( 'Add or remove items', 'map' ), 'choose_from_most_used'      => __( 'Choose from the most used', 'map' ), 'popular_items'              => __( 'Popular Items', 'map' ), 'search_items'               => __( 'Search Items', 'map' ), 'not_found'                  => __( 'Not Found', 'map' ), 'no_terms'                   => __( 'No items', 'map' ), 'items_list'                 => __( 'Items list', 'map' ), 'items_list_navigation'      => __( 'Items list navigation', 'map' ),
// 	);
// 	$args = array(
// 		'labels'                     => $labels,
// 		'hierarchical'               => false,
// 		'public'                     => true,
// 		'show_ui'                    => true,
// 		'show_admin_column'          => true,
// 		'show_in_nav_menus'          => false,
// 		'show_tagcloud'              => false,
// 	);
// 	register_taxonomy( 'programme', array( 'project' ), $args );

// }



// 2) ACF for the fields of `project`

if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_acf_fields_for_project',
		'title' => 'Project fields (needed for react map level 3)',
		'fields' => array(
			array(
				'key' => 'field_project_title_alt',
				'label' => '',
				'name' => 'project_title_alt',
				'type' => 'text',
				'instructions' => 'autogenerated JSON file:<br/><b>' . FULL_URL_FILENAME . '</b><br/>for some reason, the poster has a heading box with a title and subtitle, and on top of that we have the "Project Title", which may vary in some words. Use this field for the "Project title" and not the one in big letters in the poster.',
				'wrapper' => ['width' => '100','class' => '','id' => '',],
				'placeholder' => 'project title alt (optional)',
			),
			array(
				'key' => 'field_subtitle',
				'label' => '',
				'name' => 'subtitle',
				'type' => 'text',
				'instructions' => '',
				'wrapper' => ['width' => '40','class' => '','id' => '',],
				'default_value' => '',
				'placeholder' => 'subtitle here',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_subthematic',
				'label' => 'Subthematic',
				'name' => 'subthematic',
				'type' => 'taxonomy',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => [ 'width' => '40', 'class' => '', 'id' => '', ],
				'taxonomy' => 'subthematics',
				'field_type' => 'multi_select',
				'allow_null' => 0,
				'add_term' => 1,
				'save_terms' => 0,
				'load_terms' => 0,
				'return_format' => 'object',
				'multiple' => 0,
			),
			array(
				'key' => 'field_programme', 'label' => 'Programme',
				'name' => 'programme',
				'type' => 'post_object',
				'required' => 1,
				'instructions' => 'Select the programme where this project belongs to',
				'wrapper' => ['width' => '20','class' => '','id' => '',],
				'post_type' => [ 0 => 'programmes' ],
				'taxonomy' => '', 			'allow_null' => 0, 'multiple' => 0,
				'return_format' => 'id', 	'ui' => 1,
			),
			array(
				'key' => 'field_thematic',  'label' => '',
				'name' => 'thematic',
				'type' => 'radio',
				'instructions' => '',  
				'wrapper' => ['width' => 50],
				'choices' => array(
					'environment' => 'environment',
					'economical' => 'economical',
					'infrastructures' => 'infrastructures',
					'p2p' => 'p2p',
				),
				'allow_null' => 0, 'other_choice' => 0,
				'default_value' => 'environment',
				'layout' => 'horizontal',
				'return_format' => 'value',
				'save_other_choice' => 0,
			),
			array(
				'key' => 'field_pdf_upload', 'label' => 'pdf upload',
				'name' => 'pdf_upload',
				'type' => 'file',
				'instructions' => 'Upload the pdf. Alternativelly, you can use the url field. In case of having both, the uploaded file will be used.',
				'wrapper' => ['width' => '25','class' => '','id' => '',],
				'return_format' => 'url',
				'library' => 'all',
				'min_size' => '', 'max_size' => '', 'mime_types' => '',
			),
			array(
				'key' => 'field_pdf_url', 'label' => 'pdf url',
				'name' => 'pdf_url',
				'type' => 'url',
				'instructions' => 'Alternative file url (leave empty if uploaded a file on the field on the left)',
				'wrapper' => ['width' => '25','class' => '','id' => '',],
				'default_value' => '',
				'placeholder' => 'https://...',
			),
			array(
				'key' => 'field_map_image', 'label' => 'Map image',
				'name' => 'map_image',
				'type' => 'image',
				'instructions' => 'The map shown in the bottom left corner of the screen.',
				'wrapper' => ['width' => '25','class' => '','id' => '',],
				'return_format' => 'url',
				'preview_size' => 'medium_large',
				'library' => 'all',
				'min_width' => '', 'min_height' => '', 'min_size' => '', 'max_width' => '', 'max_height' => '', 'max_size' => '', 'mime_types' => '',
			),
			array(
				'key' => 'field_map_image_url', 'label' => 'map image url',
				'name' => 'map_image_url',
				'type' => 'url',
				'instructions' => 'Alternative image url (You can leave it empty if you uploaded a map image alredy)',	
				'wrapper' => ['width' => '25','class' => '','id' => '',],
				'default_value' => '',
				'placeholder' => 'https://...',
			),
			array(
				'key' => 'field_links', 'label' => 'Links',
				'name' => 'links',
				'type' => 'textarea',
				'instructions' => 'All external links, including the keep.eu. One per line
	Write the keep.eu link in the first line
	For every link, write first the words shown in the button, then the full url of the link.',
				'wrapper' => ['width' => '25','class' => '','id' => '',],
				'default_value' => '',
				'placeholder' => 'https://keep.eu/rest-of-link',
				'maxlength' => '', 'rows' => 5, 'new_lines' => '',
			),
			array(
				'key' => 'field_countries',
				'label' => 'Countries',
				'name' => 'countries',
				'type' => 'text',
				'instructions' => 'Comma separated. ie: `ru,no,fi`',
				'wrapper' => ['width' => '33','class' => '','id' => '',],
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
			array(
				'key' => 'field_iframemsg',
				'label' => 'iframe',
				'name' => 'iframemsg',
				'type' => 'message', 'wrapper' => ['width' => '66'],
				'message' => isset($_GET['post'])? '<iframe src="'.get_field('pdf_url', $_GET['post']).'" style="width: 100%; height:500px"></iframe>' : '',
			),
		),
		'location' => array(
			array( [ 'param' => 'post_type', 'operator' => '==', 'value' => 'project', ], ),
		),
		'menu_order' 			=> 0,
		'position' 				=> 'normal',
		'style' 				=> 'default',
		'label_placement' 		=> 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' 		=> '',
		'active' 				=> true,
		'description' 			=> '',
	));



	

	// 2.2) ACF for programmes (ENI CBC programmes were created already by tesim website development team - Julien )
	acf_add_local_field_group(array(
		'key' => 'group_programmes_fields_level3',
		'title' => 'Fields for programmes for react map',
		'fields' => [
			array(
				'key' => 'field_programme_logo', 'label' => 'Logo',
				'name' => 'programme_logo',
				'type' => 'image',
				'instructions' => '',
				'wrapper' => ['width' => '','class' => '','id' => '',],
				'return_format' => 'id',
				'preview_size' => 'medium_large',
				'library' => 'all',
				'min_width' => '', 'min_height' => '', 'min_size' => '', 'max_width' => '', 'max_height' => '', 'max_size' => '', 'mime_types' => '',
			),
			array(
				'key' => 'field_programme_nuts3',
				'label' => 'Nuts3',
				'name' => 'programme_nuts3',
				'type' => 'text',
				'instructions' => 'Comma separated. ie: `uk324,uk332`',
				'wrapper' => ['width' => '','class' => '','id' => '',],
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			),
		],
		'location' => array( array( [ 'param' => 'post_type', 'operator' => '==', 'value' => 'programmes', ] ), ),
		'menu_order' 			=> 0,
		'position' 				=> 'side',
		'style' 				=> 'default',
		'label_placement' 		=> 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' 		=> '',
		'active' 				=> true,
		'description' 			=> 'This fields is needed for the react map (level 3)',
	));
endif;




// -) EVENT SAVE THE PAGE for the Projects in the DB. Every time you save a project or a programme 
// WHAT: exports the file inc/react-map/projects-and-programmes.json, needed by the react app
add_action( 'save_post', 'save_page_for_projects_or_programmes_in_db' , 10, 1);
function save_page_for_projects_or_programmes_in_db( $post_id ) {

	if ( wp_is_post_revision( $post_id ) ) return; // only for real posts!
	if ( !in_array(get_post_type($post_id), [ 'project', 'programmes' ]) ) return; // only when saving a prog or proj
	

	$all_projects = get_posts('post_type=project&posts_per_page=-1&orderby=>title&order=DESC');
	$all_projects_bien = [];
	$programmes_info_from_projects = []; // associative array
	foreach ($all_projects as $i => $project) 
		if (get_field('programme', $project->ID)) {
			$ID = $project->ID;
			// $the_project = $project;
			$the_project                            = new stdClass();
			$the_project->ID                        = $ID;
			$post_title_official					= get_field('project_title_alt', $ID); // the official title
			// if (!strlen(trim($post_title))) $post_title = 
			$the_project->post_title                = $project->post_title; 
			$the_project->post_subtitle             = get_field('subtitle', $ID);
			$the_project->post_title_official       = $post_title_official;
			$the_project->permalink                 = str_replace('http://localhost:9000', 'https://tesim-enicbc.eu', get_permalink( $ID ));
			$pdf_upload 							= get_field('pdf_upload', $ID);
			$pdf_url 								= get_field('pdf_url', $ID);
			$the_project->pdf_link                  = $pdf_upload? $pdf_upload: $pdf_url;
			$map_image_upload 						= get_field('map_image', $ID);
			$map_image_url 							= get_field('map_image_url', $ID);
			$the_project->external_featured_image   = $map_image_upload?? $map_image_url;
			$the_project->links_and_map             = get_field('links', $ID);
			$the_project->color                     = get_field('thematic', $ID);
			$the_project->image_poster 				= has_post_thumbnail( $ID )? get_the_post_thumbnail_url( $ID, 'medium') : null;
			$subthematics 	= get_field('subthematic', $ID); // array, only the 1st one matters
			$subthematic 	= ($subthematics&&count($subthematics)? $subthematics[0]->name : null );
			// $subthematic  	= str_replace( '&amp;', '&', $subthematic); // TODO: @TOACTIVATE
			$the_project->subthematic               = $subthematic;
			$the_project->programme                 = get_field('programme', $ID);
			$the_project->countries                 = strtolower( get_field('countries', $ID) );

			$all_projects_bien[] = $the_project;

			$countries_programme = $programmes_info_from_projects[$the_project->programme]?? [];
			$countries_programme = array_unique( array_merge($countries_programme, explode(',',$the_project->countries)) );
			$programmes_info_from_projects[$the_project->programme] = $countries_programme;
		}


	// NOW reconfigure the programmes


	$all_programmes 		= get_posts('post_type=programmes&posts_per_page=-1&orderby=>title&order=DESC');
	$total_programmes_bien 	= [];
	foreach ($all_programmes as $i => $programme) {
		$ID 				= $programme->ID;
		$logo 				= wp_get_attachment_image_src( get_field('programme_logo', $ID), 'medium');

		$the_programme 		= new stdClass();
		$the_programme->ID  = $ID;
		$the_programme->post_title  = $programme->post_title;
		$the_programme->post_name   = $programme->post_name;
		$the_programme->logo        = $logo? $logo[0] : null;
		$the_programme->nuts3       = get_field('programme_nuts3', $ID)?? '';
		$the_programme->countries   = isset($programmes_info_from_projects[$ID])? implode(',', $programmes_info_from_projects[$ID]) : '';
		//$the_programme->countries   = get_field('countries', $ID);
		$total_programmes_bien[$ID] = $the_programme;
	}
	

	$result = [
        'projects'   => $all_projects_bien,
        'programmes' => $total_programmes_bien
    ];

	$text_to_save_in_json_file = (json_encode($result,JSON_PRETTY_PRINT));

	$result = file_put_contents(FULL_PATH_FILENAME, $text_to_save_in_json_file);
	if (!$result) {
		wp_die( "<h1>Filename not written! " . FULL_PATH_FILENAME . " </h1>" );
	}
	// $open 	= fopen( $FULL_PATH_FILENAME, "a" ); 
	// $write 	= fputs( $open, $text_to_save_in_json_file ); 
    // fclose( $open );



	return false;      
}




// DEVELOPMENT ONLY - 
if (is_admin() && isset($_GET['generateprojects'])) {
	add_action( 'init', 'init_projects_and_acf_prog', 10 );
}
function init_projects_and_acf_prog() {
	// $directory_react_app 	 = '/inc/react-map';
	// $json_filename 			 = 'projects-and-programmes.json';
	// $FULL_PATH_FILENAME 	 = get_stylesheet_directory() . $directory_react_app . '/' . $json_filename;

	$string = file_get_contents(FULL_PATH_FILENAME);
	if ($string === false) {
	  die('error opening file '. FULL_PATH_FILENAME);
	}

	$json_a = json_decode($string, true);
	if ($json_a === null) {
		die('error deconding');
	}

	echo "<pre>";
	print_r($json_a);
	echo "</pre>";
	/* 
	[ID] => 7537
	[post_title] => CGTN
	[permalink] => https://interreg.eu/snippet/cgtn/
	[pdf_link] => https://tesim-enicbc.eu/wp-content/uploads/2021/02/CGTN.pdf
	[external_featured_image] => https://tesim-enicbc.eu/wp-content/uploads/2021/01/CGTN.png
	[links_and_map] => https://keep.eu/projects/23032/Cross-border-green-transpor-EN/ 
TESIM interview https://tesim-enicbc.eu/voices/ihor-popodyuk/ 
Project page https://huskroua-cbc.eu/projects/financed-projects-database/cross-border-green-transport-network 
Facebook https://www.facebook.com/CGTN.HUSKROUA/
	[color] => infrastructures
	[programme] => 5224
	[subthematic] => A
	[countries] => ua,sk,ro,hu
	*/
	foreach ( $projects = $json_a['projects'] as $i => $project_info ) {
		echo "<br>" . $project_info['post_title'];

		$new = array(
			'post_title' => $project_info['post_title'],
			'post_type' 	=> 'project',
			// 'post_content' => 'This is the content of our new post.',
			'post_status' => 'publish',
		);
		// ver si el post existe. 
		$post_exists = get_page_by_title($project_info['post_title'], OBJECT, 'project');
		if (!$post_exists) {
			$post_id = wp_insert_post( $new );
		}else $post_id 	 =  $post_exists->ID;

		// now the ACF 
		update_field( 'pdf_url', $project_info['pdf_link'], $post_id );
		update_field( 'links', $project_info['links_and_map'], $post_id );
		update_field( 'thematic', $project_info['color'], $post_id );
		update_field( 'map_image_url', $project_info['external_featured_image'], $post_id );
		update_field( 'countries', $project_info['countries'], $post_id );

	}

	die();
	
	// die($FULL_PATH_FILENAME);
}