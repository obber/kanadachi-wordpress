<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'wintersong', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'wintersong' ) );


//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Wintersong Pro Theme', 'wintersong' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/wintersong/' );
define( 'CHILD_THEME_VERSION', '1.3' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue scripts
add_action( 'wp_enqueue_scripts', 'wintersong_enqueue_scripts' );
function wintersong_enqueue_scripts() {

	wp_enqueue_script( 'wintersong-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_script( 'wintersong-custom-js', get_bloginfo( 'stylesheet_directory' ) . '/js/toyproblems.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_style( 'google-font-roboto-mono', '//fonts.googleapis.com/css?family=Roboto+Mono:400,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );
	
}

//* Add custom shortcodes
include('lib/shortcodes.php');

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'admin-preview-callback' => 'wintersong_admin_header_callback',
	'default-text-color'     => '000000',
	'header-selector'        => '.site-header .site-avatar img',
	'height'                 => 224,
	'width'                  => 224,
	'wp-head-callback'       => 'wintersong_header_callback',
) );

function wintersong_admin_header_callback() {
	echo get_header_image() ? '<img src="' . get_header_image() . '" />' : get_avatar( get_option( 'admin_email' ), 224 );
}

function wintersong_header_callback() {

	if ( ! get_header_textcolor() )
		return;

	printf( '<style  type="text/css">.site-title a { color: #%s; }</style>' . "\n", get_header_textcolor() );

	if ( get_header_image() )
		return;

	if ( ! display_header_text() )
	add_filter( 'body_class', 'wintersong_header_image_body_class' );

}

//* Add custom body class for header-text
function wintersong_header_image_body_class( $classes ) {
	$classes[] = 'header-image';
	return $classes;
}

//* Unregister layout settings
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

//* Unregister secondary navigation menu
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Primary Navigation Menu', 'wintersong' ) ) );

//* Unregister sidebars
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Hook site avatar before site title
add_action( 'genesis_header', 'wintersong_site_gravatar', 5 );
function wintersong_site_gravatar() {

	$header_image = get_header_image() ? '<img alt="" src="' . get_header_image() . '" />' : get_avatar( get_option( 'admin_email' ), 224 );
	printf( '<div class="site-avatar"><a href="%s">%s</a></div>', home_url( '/' ), $header_image );

}

//* Force full-width-content layout setting
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_nav' );

//* Relocate after entry widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'wintersong_author_box_gravatar_size' );
function wintersong_author_box_gravatar_size( $size ) {

	return '144';

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'wintersong_comments_gravatar' );
function wintersong_comments_gravatar( $args ) {

    $args['avatar_size'] = 112;
	return $args;

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'wintersong_remove_comment_form_allowed_tags' );
function wintersong_remove_comment_form_allowed_tags( $defaults ) {
	
	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Originally for repositioning footer, commented out to have no footer.
//* Reposition the footer
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

/*

add_action( 'genesis_header', 'genesis_footer_markup_open', 11 );
add_action( 'genesis_header', 'genesis_do_footer', 12 );
add_action( 'genesis_header', 'genesis_footer_markup_close', 13 );

//* Customize the footer
add_filter( 'genesis_footer_output', 'wintersong_custom_footer' );
function wintersong_custom_footer( $output ) {

	$output = sprintf( '<p>%s<a href="http://www.studiopress.com/">%s</a></p>',  __( 'Powered by ', 'wintersong' ), __( 'Genesis', 'wintersong' ) );
	return $output;

} */


//* Register custom post type: lettering
if ( ! function_exists('custom_post_type_lettering') ) {

	add_action( 'init', 'custom_post_type_lettering', 0 );

	function custom_post_type_lettering() {

		$labels = array(
			'name'                  => 'Lettering Pieces',
			'singular_name'         => 'Lettering Piece',
			'menu_name'             => 'Lettering',
			'name_admin_bar'        => 'Lettering',
			'archives'              => 'Lettering Archives',
			'parent_item_colon'     => 'Parent Piece:',
			'all_items'             => 'All Pieces',
			'add_new_item'          => 'Add New Piece',
			'add_new'               => 'Add New',
			'new_item'              => 'New Piece',
			'edit_item'             => 'Edit Piece',
			'update_item'           => 'Update Piece',
			'view_item'             => 'View Piece',
			'search_items'          => 'Search Piece',
			'not_found'             => 'Not found',
			'not_found_in_trash'    => 'Not found in Trash',
			'featured_image'        => 'Featured Image',
			'set_featured_image'    => 'Set featured image',
			'remove_featured_image' => 'Remove featured image',
			'use_featured_image'    => 'Use as featured image',
			'insert_into_item'      => 'Insert into post',
			'uploaded_to_this_item' => 'Uploaded to this item',
			'items_list'            => 'Items list',
			'items_list_navigation' => 'Items list navigation',
			'filter_items_list'     => 'Filter items list',
		);
		$args = array(
			'label'                 => 'Lettering Piece',
			'description'           => 'Hand Lettering & Artwork Posts',
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'genesis_seo', 'thumbnail'),
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 8,
			'menu_icon'             => 'dashicons-format-image',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
		);
		register_post_type( 'lettering', $args );
	}
}

add_action( 'pre_get_posts', 'lettering_archive_query' );
/**
 * Posts_per_page workaround for lettering archive
 * 
 * @author Bill Erickson
 * @link http://www.billerickson.net/customize-the-wordpress-query/
 * @param object $query data
 *
 */
function lettering_archive_query( $query ) {

	if( $query->is_main_query() && $query->is_post_type_archive( 'lettering' ) && !is_admin() ) {
		$query->set( 'posts_per_page', '6' );
	}

}


//* Register custom post type: Toy Problems
if ( ! function_exists('custom_post_type_toy_problems') ) {

	add_action( 'init', 'custom_post_type_toy_problems', 0 );

	function custom_post_type_toy_problems() {

		$labels = array(
			'name'                  => 'Toy Problems',
			'singular_name'         => 'Toy Problem',
			'menu_name'             => 'Toy Problems',
			'name_admin_bar'        => 'Toy Problem',
			'archives'              => 'Toy Problem Archives',
			'parent_item_colon'     => 'Parent Toy Problem:',
			'all_items'             => 'All Toy Problems',
			'add_new_item'          => 'Add New Toy Problem',
			'add_new'               => 'Add New',
			'new_item'              => 'New Toy Problem',
			'edit_item'             => 'Edit Toy Problem',
			'update_item'           => 'Update Toy Problem',
			'view_item'             => 'View Toy Problem',
			'search_items'          => 'Search Toy Problems',
			'not_found'             => 'Not found',
			'not_found_in_trash'    => 'Not found in Trash',
			'featured_image'        => 'Featured Image',
			'set_featured_image'    => 'Set featured image',
			'remove_featured_image' => 'Remove featured image',
			'use_featured_image'    => 'Use as featured image',
			'insert_into_item'      => 'Insert into post',
			'uploaded_to_this_item' => 'Uploaded to this item',
			'items_list'            => 'Items list',
			'items_list_navigation' => 'Items list navigation',
			'filter_items_list'     => 'Filter items list',
		);
		$args = array(
			'label'                 => 'Toy Problems',
			'description'           => 'Toy Problems and Solutions',
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'genesis_seo', 'thumbnail', 'excerpt', 'wpcom-markdown'),
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 4,
			'menu_icon'             => 'dashicons-star-filled',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
		);
		register_post_type( 'toyproblems', $args );
	}
}

add_action( 'pre_get_posts', 'toyproblems_archive_query' );
/**
 * Posts_per_page workaround for toyproblems archive
 * 
 * @author Bill Erickson
 * @link http://www.billerickson.net/customize-the-wordpress-query/
 * @param object $query data
 *
 */
function toyproblems_archive_query( $query ) {

	if( $query->is_main_query() && $query->is_post_type_archive( 'toyproblems' ) && !is_admin() ) {

		// set number of posts
		$query->set( 'posts_per_page', '5' );

		// 

	}

}

add_action('genesis_before_loop','toy_problems_conditional');
/**
* Remove post meta and post info on single post type.
*/
function toy_problems_conditional() {
	if (is_singular('toyproblems')) { //Replace post_type with your post type slug

		// remove date
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

		// add 'Toy Problems' to top right
		add_filter('genesis_post_title_text', 'add_category_text_float');
		function add_category_text_float() {
			return get_the_title() . '<span class="toy-problem-title">Toy Problem</span>';
		}
	}
}