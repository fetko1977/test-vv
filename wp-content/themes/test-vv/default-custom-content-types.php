<?php
/**
 * Custom content types
 */

/*global $i_max_number_of_repeater_fields, $arr_repeater_fields;
$i_max_number_of_repeater_fields = 10;

$arr_repeater_fields = array(
	array(
		'label' => __( 'Top', 'Default' ),
		'name' => 'top'
	),
	array(
		'label' => __( 'Mid', 'Default' ),
		'name' => 'mid'
	),
	array(
		'label' => __( 'Bottom', 'Default' ),
		'name' => 'bottom'
	)
);*/

add_action( 'init', 'default_custom_content' );
function default_custom_content() {
	/*
	// create extra content type
	$project_labels = array(
		'name' => __( 'Projects', 'Default' ),
		'singular_name' => __( 'Project', 'Default' ),
		'add_new' => __( 'Add New', 'Default' ),
		'add_new_item' => __( 'Add New Project', 'Default' ),
		'edit_item' => __( 'Edit Project', 'Default' ),
		'new_item' => __( 'New Project', 'Default' ),
		'view_item' => __( 'View Project', 'Default' ),
		'search_items' => __( 'Search Projects', 'Default' ),
		'not_found' =>  __( 'Nothing found', 'Default' ),
		'not_found_in_trash' => __( 'Nothing found in Trash', 'Default' ),
		'parent_item_colon' => ''
	);
	$project_args = array(
		'exclude_from_search' => true,
        'labels' => $project_labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true,
		'query_var' => true,
		// ofwel een menu icon (zal niet verkleuren bij hover, want er wordt dan gewoon een image gebruikt), ofwel via css in wp-admin/css/colors-fresh.css toevoegen met class .menu-icon-programmadag
		//'menu_icon' => get_stylesheet_directory_uri() . '/images/programma_dag_icon.png',
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 30,
		'rewrite' => array( 'slug' => 'projects' ), // slug altijd meervoud van de type naam, bv "wijnfiches"
		'supports' => array( 'title', 'editor', 'page-attributes', 'thumbnail' ),
		//'taxonomies' => array( 'category' ),
		'register_meta_box_cb' => 'default_add_project_meta_boxes'
    );
	register_post_type( 'project', $project_args ); // type naam altijd enkelvoud, bv "wijnfiche", confr. "page", "post", etc.
	*/
	
	/*
	// Add new taxonomy, make it hierarchical (like categories)
	$project_cats_labels = array(
		'name' => __( 'Categories', 'Default' ),
		'singular_name' => __( 'Category', 'Default' ),
		'search_items' =>	__( 'Search Categories', 'Default' ),
		'all_items' => __( 'All Categories', 'Default' ),
		'parent_item' => __( 'Parent Category', 'Default' ),
		'parent_item_colon' => __( 'Parent Category:', 'Default' ),
		'edit_item' => __( 'Edit Category', 'Default' ), 
		'update_item' => __( 'Update Category', 'Default' ),
		'add_new_item' => __( 'Add New Category', 'Default' ),
		'new_item_name' => __( 'New Category Name', 'Default' ),
		'menu_name' => __( 'Categories', 'Default' ),
	);
	$project_cats_args = array(
		'hierarchical' => true,
		'labels' => $project_cats_labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'projects-category' ),
		'show_in_nav_menus' => false,
		'show_admin_column' => true
	);
	register_taxonomy( 'project_category', array( 'project' ), $project_cats_args );

	// Add new taxonomy, NOT hierarchical (like tags)
	$arr_project_tags_labels = array(
		'name' => __( 'Writers', 'Default' ),
		'singular_name' => __( 'Writer', 'Default' ),
		'search_items' =>	__( 'Search Writers', 'Default' ),
		'popular_items' => __( 'Popular Writers', 'Default' ),
		'all_items' => __( 'All Writers', 'Default' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Writer', 'Default' ), 
		'update_item' => __( 'Update Writer', 'Default' ),
		'add_new_item' => __( 'Add New Writer', 'Default' ),
		'new_item_name' => __( 'New Writer Name', 'Default' ),
		'separate_items_with_commas' => __( 'Separate writers with commas', 'Default' ),
		'add_or_remove_items' => __( 'Add or remove writers', 'Default' ),
		'choose_from_most_used' => __( 'Choose from the most used writers', 'Default' ),
		'menu_name' => __( 'Writers', 'Default' ),
	);
	$arr_project_tags_args = array(
		'hierarchical' => false,
		'labels' => $arr_project_tags_labels,
		'show_ui' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'writer' ),
		'show_in_nav_menus' => false,
		'show_admin_column' => true
	);
	register_taxonomy( 'project_tags', 'project', $arr_project_tags_args );
	*/
	
}

// cpts: add meta boxes
/*function default_add_project_meta_boxes() {
	add_meta_box( 'default_project_content_meta_box', __( 'Content', 'Default' ), 'default_project_content_meta_box_callback', 'project', 'normal', 'low' );
}
function default_project_content_meta_box_callback() {
	
	$link = get_post_meta( get_the_ID(), 'link', true );
	
	default_build_link_field( 'link', __( 'Link', 'Default' ), $link );
	
}*/

// pages: add meta boxes
add_action( 'add_meta_boxes', 'default_add_meta_boxes' );
function default_add_meta_boxes() {
	
	global $post;

	$page_template = get_post_meta( $post->ID, '_wp_page_template', true );
	
	/*if ( $page_template != 'template-splash.php' ) {
		add_meta_box( 'default_page_title_meta_box', __( 'Title', 'Default' ), 'default_page_title_meta_box_callback', 'page', 'normal', 'low' );
	}*/
	
}

// page
/*function default_page_title_meta_box_callback() {
	
	$title = get_post_meta( get_the_ID(), 'page_title', true );
	$subtitle = get_post_meta( get_the_ID(), 'page_subtitle', true );
	
	default_build_field( 'page_title', __( 'Title', 'Default' ), $title );
	default_build_field( 'page_subtitle', __( 'Subtitle', 'Default' ), $subtitle );
	
}*/

add_action( 'save_post', 'default_post_save' );
function default_post_save( $post_id ) {
	
	// doe niets als het gaat om een auto-save
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) return $post_id;
	
	// check of de user wel de juiste perms heeft om te saven
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}
	
	// haal post data op en save
	switch ( $_POST['post_type'] ) {
		/*case 'project':
		 	
			default_save_field( $post_id, 'link' );
		 	
			break;*/
		case 'page':
			switch ( get_post_meta( $post_id, '_wp_page_template', true ) ) {
				/*case 'template-brands.php': // merken pagina
					
					default_save_page_id_linked_to_template( $post_id, 'brand_' );
					
					break;*/
			}
			break;
	}
	
	// doe dit ook in eigen plugins
	if ( function_exists( 'default_clear_cache' ) ) {
		default_clear_cache();
	}
	
	return $post_id;
	
}
add_action( 'delete_post', 'default_delete_post', 10 );
function default_delete_post( $post_id ) {
	if ( function_exists( 'default_clear_cache' ) ) {
		default_clear_cache();
	}
	return true;
}

function default_save_page_id_linked_to_template( $post_id, $prefix ) {
	
	if ( function_exists( 'icl_object_id' ) ) {
		$languages = icl_get_languages( 'skip_missing=0&orderby=id&order=desc' );
		foreach ( $languages as $lang ) {
			$post_lang_id = icl_object_id( $post_id, 'page', false, $lang['language_code'] );
			
			if ( $post_lang_id != null ) {
				if ( get_option( $prefix . '_' . $lang['language_code'] . '_page_id' ) != $post_lang_id ) {
					update_option( $prefix . '_' . $lang['language_code'] . '_page_id', $post_lang_id );
				}								
			}						
		}
	} else {
		if ( get_option( $prefix . '_page_id' ) != $post_id ) {
			update_option( $prefix . '_page_id', $post_id );
		}	
	}
	
}
function default_get_page_id_linked_to_template( $prefix ) {
	
	$post_id = '';
	
	if ( function_exists( 'icl_object_id' ) && defined( 'ICL_LANGUAGE_CODE' ) ) {
		$post_id = get_option( $prefix . '_' . ICL_LANGUAGE_CODE . '_page_id' ) ;
	} else {
		$post_id = get_option( $prefix . '_page_id' ) ;
	}
	
	return $post_id;
	
}

// config attachment plugin
/*
define( 'ATTACHMENTS_DEFAULT_INSTANCE', false );
function default_config_attachments( $attachments ) {
	
	$attachment_args_project = array(
		'label' => __( 'Images', 'Default' ), // title of the meta box (string)
		'post_type' => array( 'project' ), // all post types to utilize (string|array)
		'filetype' => array( 'image' ), // allowed file type(s) (array) (image|video|text|audio|application) // null for no limit
 		'note' => __( 'Image size: 1200x900', 'Default' ), // include a note within the meta box (string)
		'button_text' => __( 'Add image', 'Default' ), // text for 'Attach' button in meta box (string)
		'modal_text' => __( 'Add to images', 'Default' ), // text for modal 'Attach' button (string)
		'fields' => array(
			array(
				'name' => 'title', // unique field name
				'type' => 'text', // registered field type
				'label' => __( 'Title', 'Default' ) // label to display
			)
		)
	);
	
	$attachments->register( 'default_project_attachments', $attachment_args_project ); // unique instance name
	
}
add_action( 'attachments_register', 'default_config_attachments' );
*/

// only show elements on certain templates
add_action( 'admin_head', 'default_custom_admin_css' );
function default_custom_admin_css() {
	
	global $post;
	
	if ( $post && $post->post_type == 'page' ) {
		
		$template = get_post_meta( $post->ID, '_wp_page_template', true );
		
		/*if ( $template == 'template-home.php' ) {
			?>
			<style type="text/css">
				#attachments-default_home_attachments {
					display: block !important;
				}
			</style>
			<?php
		}*/
		
		// WYSIWYG verbergen bij sommige templates
		if ( $template == 'template-redirect_to_first_child.php' || $template == 'template-redirect_to_first_child_of_menu.php' ) {
			?>
			<style type="text/css">
				#postdivrich {
					display: none !important;
				}
			</style>
			<?php
		}
		
		// featured image verbergen bij sommige templates
		if ( $template == 'template-redirect_to_first_child.php' || $template == 'template-redirect_to_first_child_of_menu.php' || $template == 'template-splash.php' ) {
			?>
			<style type="text/css">
				#postimagediv {
					display: none !important;
				}
			</style>
			<?php
		}
		
	}
	
}

// extra kolommen tonen in CMS overzicht
/*
add_action( 'load-edit.php', 'default_show_custom_fields_columns', 1 );
if ( ! function_exists( 'default_show_custom_fields_columns' ) ) {
	function default_show_custom_fields_columns() {
		
		if ( ! isset( $_GET['post_type'] ) ) {
			$post_type = 'post';
		} else {
			$post_type = $_GET['post_type'];
		}
		
		switch ( $post_type ) {
			case 'project':
				add_filter( 'manage_posts_columns', 'default_show_custom_fields_columns_labels_project', 9 );
				add_action( 'manage_posts_custom_column', 'default_show_custom_fields_columns_values_project', 9, 2 );
				break;
			case 'academy':
				add_action('manage_posts_custom_column', 'default_show_custom_fields_columns_values_academy', 9, 2);
				add_filter('manage_posts_columns', 'default_show_custom_fields_columns_labels_academy', 9);
				break;
		}
		
	}
}
if ( ! function_exists( 'default_show_custom_fields_columns_labels_project' ) ) {
	function default_show_custom_fields_columns_labels_project( $columns ) {
		
		$columns['realised'] = __( 'Realised?', 'Default' );
		$columns['getuigenis_pagina_organiseren'] = __( 'Organiseren', 'Default' );
		$columns['getuigenis_pagina_idee'] = __( 'Mijn idee', 'Default' );
		
		return $columns;
		
	}	
}
if ( ! function_exists( 'default_show_custom_fields_columns_values_project' ) ) {
	function default_show_custom_fields_columns_values_project( $column, $post_id ) {
		
		if ( $column == 'realised' ) {
			//echo htmlspecialchars( stripcslashes( get_post_meta( $post_id, 'realised', true ) ) );
			echo ( get_post_meta( $post_id, 'realised', true ) == 'true' ? __( 'Yes', 'Default' ) : __( 'No', 'Default' ) );
		}
		if ( $column == 'getuigenis_pagina_organiseren' ) {
			echo htmlspecialchars( stripcslashes( get_post_meta( $post_id, 'getuigenis_pagina_organiseren', true ) ) );
		}
		if ( $column == 'getuigenis_pagina_idee' ) {
			echo htmlspecialchars( stripcslashes( get_post_meta( $post_id, 'getuigenis_pagina_idee', true ) ) );
		}
		
	}	
}
*/

// cache
if ( ! function_exists( 'default_clear_cache' ) ) {
	function default_clear_cache() {
		// Clear all W3 Total Cache
		if ( class_exists( 'W3_AdminActions_FlushActionsAdmin' ) ){
			$plugin_totalcacheadmin = & w3_instance( 'W3_AdminActions_FlushActionsAdmin' );
			$plugin_totalcacheadmin->flush_all();
		}
	}
}

// clear cache on widget save
if ( ! function_exists( 'default_clear_cache_on_widget_save' ) ) {
	add_filter( 'widget_update_callback', 'default_clear_cache_on_widget_save', 10, 3 );
	function default_clear_cache_on_widget_save( $instance, $new_instance, $old_instance, $this ) {
		if ( function_exists( 'default_clear_cache' ) ) {
			default_clear_cache();
		}
		
		return $instance;
	}
}

?>