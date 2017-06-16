<?php


//POST type
function fa_questions_plugin() {
$singular = 'FAQ Question';
$plural = 'FAQ Questions';
$slug = str_replace( ' ', '_', strtolower( $singular ) );

  $labels = array(
    'name' => 'FAQ',
    'singular_name' => $singular,
    'add_name' => 'Add New' ,
    'add_new' => 'Add New Question',
    'add_new_item' => 'Add New ' . $singular,
    'edit' => 'Edit',
    'edit_item' => 'Edit ' . $singular,
    'new_item' => 'New ' . $singular,
    'view' => 'View ' . $singular,
    'view_item' => 'View ' . $singular,
    'search_term' => 'Search ' . $plural,
    'parent' => 'Parent ' . $singular,
    'not_found' => 'No ' . $plural .' found',
    'not_found_in_trash' => 'No ' . $plural .' In Trash',
    'menu_name' => 'FA Questions',
    'all_items'  => 'All FA Questions'
  );

  $args = array(
		      'labels'              => $labels,
	        'public'              => true,  //how easily can get public to the back end
	        'publicly_queryable'  => true,
	        'exclude_from_search' => false,
	        'show_in_nav_menus'   => true,
	        'show_ui'             => true,
	        'show_in_menu'        => true,
	        'show_in_admin_bar'   => true,
	        'menu_position'       => 1,
	        'menu_icon'           => 'dashicons-carrot',
	        'can_export'          => true,
	        'delete_with_user'    => false,
	        'hierarchical'        => false,  //Act more as a page or more asa post- currently set to act like a post
	        'has_archive'         => true,  // does it have a archive page
	        'query_var'           => true,    //custom slug, currently set by default
	        'capability_type'     => 'page',   //if set to page, only administrators can have a access to this post type
	        'map_meta_cap'        => true,
	        // 'capabilities' => array(),   //capabilities to different user roles for custom post types
	        'rewrite'             => array(
	        	'slug' => $slug,
	        	'with_front' => true,
	        	'pages' => true,
	        	'feeds' => false,  //Part of rss feed
	        ),
	        'supports'            => array(   //default input types of the post type
	        	'title',
	        	'editor',
	        )
	);

	register_post_type( $slug, $args );
}
add_action('init', 'fa_questions_plugin');




/*
function um_apartments_manager_taxonomy() {
$singular = 'Building';
$plural = 'Buildings';
$slug = str_replace( ' ', '_', strtolower( $singular ) );

$labels = array(
'name' => $plural,
'singular_name' => $singular,
'search_items' => 'Search ' . $plural,
'popular_items' => 'Popular ' . $plural,
'all_items' => 'All ' . $plural,
'parent_item' => null,
'parent_item_colon' => null,
'edit_item' => 'Edit ' . $singular,
'update_item' => 'Update ' . $singular,
'add_new_item' => 'Add New ' . $singular,
'new_item_name' => 'New ' . $singular . ' Name',
'separate_items_with_commas' => 'Separate ' . $plural . ' with commas',
'add_or_remove_items' => 'Add or remove ' . $plural,
'choose_from_most_used' => 'Choose from the most used ' . $plural,
'not_found' => 'No ' . $plural . ' found.',
'menu_name' => $plural,
);
//assign capabilities if need to change user types different capabilities


$args = array(
'hierarchical' => true,
'labels' => $labels,
'show_ui' => true,
'show_admin_column' => true,
'update_count_callback' => '_update_post_term_count',
'query_var' => true,
'rewrite' => array( 'slug' => $slug ),
);

register_taxonomy($slug, 'apartments_listing', $args );
}


add_action('init','um_apartments_manager_taxonomy');

*/

///////////////////------------------------------------------------------------------



/*
// Taxonomy under Media in Admin Bar
function people_init() {
	// create a new taxonomy
	register_taxonomy(
		'people',
		'post',
		array(
			'label' => __( 'People' ),
			'rewrite' => array( 'slug' => 'person' ),
			'capabilities' => array(
				'assign_terms' => 'edit_guides',
				'edit_terms' => 'publish_guides'
			)
		)
	);
}
add_action( 'init', 'people_init' );
*/


/*
 // ADMIN CUSTOM SETTINGS
function my_plugin_menu() {
	add_options_page( 'My Plugin Options', 'My Plugin', 'manage_options', 'my-unique-identifier', 'my_plugin_options' );
}
add_action( 'admin_menu', 'my_plugin_menu' );

// Hook for adding admin menus
add_action('admin_menu', 'mt_add_pages');

// action function for above hook
function mt_add_pages() {
    // Add a new submenu under Settings:
    add_options_page(__('Test Settings','menu-test'), __('Test Settings','menu-test'), 'manage_options', 'testsettings', 'mt_settings_page');

    // Add a new submenu under Tools:
    add_management_page( __('Test Tools','menu-test'), __('Test Tools','menu-test'), 'manage_options', 'testtools', 'mt_tools_page');

    // Add a new top-level menu (ill-advised):
    add_menu_page(__('Test Toplevel','menu-test'), __('Test Toplevel','menu-test'), 'manage_options', 'mt-top-level-handle', 'mt_toplevel_page' );

    // Add a submenu to the custom top-level menu:
    add_submenu_page('mt-top-level-handle', __('Test Sublevel','menu-test'), __('Test Sublevel','menu-test'), 'manage_options', 'sub-page', 'mt_sublevel_page');

    // Add a second submenu to the custom top-level menu:
    add_submenu_page('mt-top-level-handle', __('Test Sublevel 2','menu-test'), __('Test Sublevel 2','menu-test'), 'manage_options', 'sub-page2', 'mt_sublevel_page2');
}

// mt_settings_page() displays the page content for the Test Settings submenu
function mt_settings_page() {
    echo "<h2>" . __( 'Test Settings', 'menu-test' ) . "</h2>";
}

// mt_tools_page() displays the page content for the Test Tools submenu
function mt_tools_page() {
    echo "<h2>" . __( 'Test Tools', 'menu-test' ) . "</h2>";
}

// mt_toplevel_page() displays the page content for the custom Test Toplevel menu
function mt_toplevel_page() {
    echo "<h2>" . __( 'Test Toplevel', 'menu-test' ) . "</h2>";
}

// mt_sublevel_page() displays the page content for the first submenu
// of the custom Test Toplevel menu
function mt_sublevel_page() {
    echo "<h2>" . __( 'Test Sublevel', 'menu-test' ) . "</h2>";
}

// mt_sublevel_page2() displays the page content for the second submenu
// of the custom Test Toplevel menu
function mt_sublevel_page2() {
    echo "<h2>" . __( 'Test Sublevel2', 'menu-test' ) . "</h2>";
}
*/
