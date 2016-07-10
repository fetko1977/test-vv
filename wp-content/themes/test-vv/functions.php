<?php
/**
 * Functions and definitions
 */
define( 'ICL_DONT_LOAD_NAVIGATION_CSS', true );
define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );
define( 'ICL_DONT_LOAD_LANGUAGES_JS', true );

// setup
if ( ! function_exists( 'default_theme_setup' ) ) {
	function default_theme_setup() {
		
		add_editor_style( 'default-css-editor.css' );
		
		// navigation
		//register_nav_menu( 'top', __( 'Top Menu', 'Default' ) );
		register_nav_menu( 'primary', __( 'Primary Menu', 'Default' ) );
		
		add_theme_support( 'post-thumbnails' );
		
		// image sizes
		add_image_size( 'share_image', 200, 200, true );
		
		//add_image_size( 'fullscreen_image', 1200, 900, true );
		
	}
}
add_action( 'after_setup_theme', 'default_theme_setup' );

// widget areas
/*
function default_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Main widget area', 'Default' ),
		'id' => 'main-widget-area',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
}
add_action( 'widgets_init', 'default_widgets_init' );
*/

// search form
add_filter( 'get_search_form', 'default_search_form' );
function default_search_form( $form ) {

    $form = '
		<div class="search_form">
			<form role="search" method="get" id="search_form" action="' . home_url( '/' ) . '">
	        	<input type="text" value="' . esc_attr__( 'Search', 'Default' ) . '" data-value="' . esc_attr__( 'Search', 'Default' ) . '" name="s" id="s" class="toggleval" />
	        	<input type="submit" value="' . esc_attr__( 'Search', 'Default' ) . '" id="search_submit" />
			</form>
		</div>
		';

    return $form;
}

// cf7 ajax loader
function default_cf7_loader() {
	return get_bloginfo( 'template_url' ) . '/images/preloader_small.gif';
}
add_filter( 'wpcf7_ajax_loader' , 'default_cf7_loader', 100 );

// remove submenu pages om het overzichtelijker te maken -> dit in een eerdere hook aanroepen
/*add_action( 'admin_init', 'default_remove_submenu_pages', 11 );
function default_remove_submenu_pages() {
	
	// sub pages van taxonomy & terms order plugin
	remove_submenu_page( 'edit.php', 'to-interface-post' ); // posts
	
}*/

// remove menu pages om het overzichtelijker te maken
add_action( 'admin_menu', 'default_remove_menu_pages', 11 );
function default_remove_menu_pages() {
	
	global $b_user_is_client_admin;
	
	// sub pages van post types order plugin
	//remove_submenu_page( 'edit.php', 'order-post-types-post' ); // posts
	//remove_submenu_page( 'edit.php?post_type=event', 'order-post-types-event' );
	//remove_submenu_page( 'edit.php?post_type=missed', 'order-post-types-missed' );
	
	// categories & tags
	//remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' );
	//remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
	
	// comments en posts menu
	//remove_menu_page( 'edit-comments.php' );
	//remove_menu_page( 'edit.php' );
	
	// aanpassen
	remove_submenu_page( 'themes.php', 'customize.php' );
	
	if ( $b_user_is_client_admin ) {
		
		// tools (extra)
		remove_menu_page( 'tools.php' );
		// advanced custom fields plugin
		remove_menu_page( 'edit.php?post_type=acf' );
		// profile page
		remove_menu_page( 'profile.php' );
		
	}
	
}

// default functions
include 'default-functions.php';

// custom content types
include 'default-custom-content-types.php';

// theme options
include 'default-theme-options.php';

// user handling
include 'default-admin-user-handling.php';