<?php
/**
 * Custom user handling
 * // http://codex.wordpress.org/Roles_and_Capabilities
 */

global $b_enable_member_role;
global $b_user_is_client_admin;
global $b_user_is_member;

$b_enable_member_role = false;

add_action( 'admin_menu', 'default_client_admin_no_settings' );
function default_client_admin_no_settings() {
	global $current_user;
	
	if ( in_array( 'default_client_admin', $current_user->roles ) ) {
		remove_menu_page( 'options-general.php' );
	}
	
	// verwijder "koppelingen"
	remove_menu_page( 'link-manager.php' );
}

add_action( 'admin_init', 'default_admin_user_handling' );
function default_admin_user_handling() {
	
	global $b_enable_member_role;
	
	$b_remove_roles = false; // set to true if you want to remove the role
	$b_reset_capabilities = false; // set to true if you want to reset the capabilities
	$b_roles_setupped = get_option( 'default_roles_setupped' ); // if run for the first time (after theme activation) roles and capabilities have to be created anyway
	
	// remove role (if needed)
	if ( $b_remove_roles ) {
		remove_role( 'default_client_admin' );
		if ( $b_enable_member_role ) {
			remove_role( 'default_member' );
		}
		update_option( 'default_roles_setupped', 'not done' );
	}
	
	
	if ( ! $b_remove_roles && ( $b_roles_setupped != 'done' || $b_reset_capabilities ) ) {
		
		// add role
		$user_role = add_role( 'default_client_admin', 'Client admin' );
		
		// add member role
		if ( $b_enable_member_role ) {
			$member_role = add_role( 'default_member', 'Site Member' );
		}
		
		// what and what not
		$arr_capabilities = array(
			// post types order plugin
			array ( 'capability' => 'level_10', 'can' => true ),
			array ( 'capability' => 'level_9', 'can' => true ),
			array ( 'capability' => 'level_8', 'can' => true ),
			array ( 'capability' => 'level_7', 'can' => true ),
			array ( 'capability' => 'level_6', 'can' => true ),
			array ( 'capability' => 'level_5', 'can' => true ),
			array ( 'capability' => 'level_4', 'can' => true ),
			array ( 'capability' => 'level_3', 'can' => true ),
			array ( 'capability' => 'level_2', 'can' => true ),
			array ( 'capability' => 'level_1', 'can' => true ),
			array ( 'capability' => 'level_0', 'can' => true ),
			// super admin (network sites)
			array ( 'capability' => 'manage_network', 'can' => false ),
			array ( 'capability' => 'manage_sites', 'can' => false ),
			array ( 'capability' => 'manage_network_users', 'can' => false ),
			array ( 'capability' => 'manage_network_themes', 'can' => false ),
			array ( 'capability' => 'manage_network_options', 'can' => false ),
			// administrator
			array ( 'capability' => 'activate_plugins', 'can' => false ),
			array ( 'capability' => 'add_users', 'can' => false ),
			array ( 'capability' => 'create_users', 'can' => false ),
			array ( 'capability' => 'delete_plugins', 'can' => false ),
			array ( 'capability' => 'delete_themes', 'can' => false ),
			array ( 'capability' => 'delete_users', 'can' => false ),
			array ( 'capability' => 'edit_files', 'can' => false ),
			array ( 'capability' => 'edit_plugins', 'can' => false ),
			array ( 'capability' => 'edit_theme_options', 'can' => true ),
			array ( 'capability' => 'edit_themes', 'can' => false ),
			array ( 'capability' => 'edit_users', 'can' => false ),
			array ( 'capability' => 'export', 'can' => false ),
			array ( 'capability' => 'import', 'can' => false ),
			array ( 'capability' => 'install_plugins', 'can' => false ),
			array ( 'capability' => 'install_themes', 'can' => false ),
			array ( 'capability' => 'list_users', 'can' => false ),
			array ( 'capability' => 'manage_options', 'can' => true ),
			array ( 'capability' => 'promote_users', 'can' => false ),
			array ( 'capability' => 'remove_users', 'can' => false ),
			array ( 'capability' => 'switch_themes', 'can' => false ),
			array ( 'capability' => 'unfiltered_upload', 'can' => false ),
			array ( 'capability' => 'update_core', 'can' => false ),
			array ( 'capability' => 'update_plugins', 'can' => false ),
			array ( 'capability' => 'update_themes', 'can' => false ),
			array ( 'capability' => 'edit_dashboard', 'can' => false ),
			// editor
			array ( 'capability' => 'moderate_comments', 'can' => true ),
			array ( 'capability' => 'manage_categories', 'can' => true ),
			array ( 'capability' => 'manage_links', 'can' => false ),
			array ( 'capability' => 'unfiltered_html', 'can' => true ),
			array ( 'capability' => 'edit_others_posts', 'can' => true ),
			array ( 'capability' => 'edit_pages', 'can' => true ),
			array ( 'capability' => 'edit_others_pages', 'can' => true ),
			array ( 'capability' => 'edit_published_pages', 'can' => true ),
			array ( 'capability' => 'publish_pages', 'can' => true ),
			array ( 'capability' => 'delete_pages', 'can' => true ),
			array ( 'capability' => 'delete_others_pages', 'can' => true ),
			array ( 'capability' => 'delete_published_pages', 'can' => true ),
			array ( 'capability' => 'delete_others_posts', 'can' => true ),
			array ( 'capability' => 'delete_private_posts', 'can' => true ),
			array ( 'capability' => 'edit_private_posts', 'can' => true ),
			array ( 'capability' => 'read_private_posts', 'can' => true ),
			array ( 'capability' => 'delete_private_pages', 'can' => true ),
			array ( 'capability' => 'edit_private_pages', 'can' => true ),
			array ( 'capability' => 'read_private_pages', 'can' => true ),
			// author
			array ( 'capability' => 'edit_published_posts', 'can' => true ),
			array ( 'capability' => 'upload_files', 'can' => true ),
			array ( 'capability' => 'publish_posts', 'can' => true ),
			array ( 'capability' => 'delete_published_posts', 'can' => true ),
			// contributor
			array ( 'capability' => 'edit_posts', 'can' => true ),
			array ( 'capability' => 'delete_posts', 'can' => true ),
			// subscriber
			array ( 'capability' => 'read', 'can' => true )
			
		);
		
		// get role
		$role = get_role( 'default_client_admin' );
		
		if ( $b_enable_member_role ) {
			$member_role = get_role( 'default_member' );
		}
		
		// add or remove capabilities
		foreach ( $arr_capabilities as $capability ) {
			
			if ( $capability['can'] ) {
				$role->add_cap( $capability['capability'] );
			} else {
				$role->remove_cap( $capability['capability'] );
			}
			
			// remove alle rechten voor de member role
			if ( $b_enable_member_role ) {
				$member_role->remove_cap( $capability['capability'] );
			}
			
		}
		
		// member kan enkel lezen!
		if ( $b_enable_member_role ) {
			$member_role->add_cap( 'read' );
			$member_role->add_cap( 'manage_options' );
			$member_role->add_cap( 'edit_theme_options' );
		}
		
		// set option to prevent that this code is executed on every page view
		update_option( 'default_roles_setupped', 'done' );
	}
	
}

add_action( 'wp_dashboard_setup', 'default_remove_dashboard_widgets' );
function default_remove_dashboard_widgets() {
	global $wp_meta_boxes, $b_user_is_client_admin;
	
	if ( $b_user_is_client_admin ) {
		//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
		//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	}
}

// remove default WP widgets
add_action( 'widgets_init', 'default_remove_default_widgets' );
function default_remove_default_widgets() {
	global $b_user_is_client_admin, $b_user_is_member;
	
	// get current logged in users role
	global $current_user;
	$user_roles = $current_user->roles;
	$user_role = array_shift($user_roles);
	
	// clean up for default_client_admin user type
	if ( $user_role == 'default_client_admin' ) {
		$b_user_is_client_admin = true;
	} elseif ( $user_role == 'default_member' ) {
		$b_user_is_member = true;
	} else {
		$b_user_is_client_admin = false;
		$b_user_is_member = false;
	}
	
	if ( $b_user_is_client_admin ) {
		unregister_widget( 'WP_Widget_Pages' ); // Pages Widget
		unregister_widget( 'WP_Widget_Calendar' ); // Calendar Widget
		unregister_widget( 'WP_Widget_Archives' ); // Archives Widget
		unregister_widget( 'WP_Widget_Links' ); // Links Widget
		unregister_widget( 'WP_Widget_Meta' ); // Meta Widget
		unregister_widget( 'WP_Widget_Search' ); // Search Widget
		//unregister_widget( 'WP_Widget_Text' ); // Text Widget
		unregister_widget( 'WP_Widget_Categories' ); // Categories Widget
		unregister_widget( 'WP_Widget_Recent_Posts' ); // Recent Posts Widget
		unregister_widget( 'WP_Widget_Recent_Comments' ); // Recent Comments Widget
		unregister_widget( 'WP_Widget_RSS' ); // RSS Widget
		unregister_widget( 'WP_Widget_Tag_Cloud' ); // Tag Cloud Widget
		unregister_widget( 'WP_Nav_Menu_Widget' ); // Menus Widget
	}
}


// remove menu items
add_action( 'admin_menu', 'default_remove_menu_items' );
function default_remove_menu_items() {
	global $menu, $b_user_is_client_admin;
	
	if ( $b_user_is_client_admin ) {
		//$restricted = array(__('Links'), __('Comments'), __('Media'), __('Plugins'), __('Tools'), __('Users'));
		$restricted = array(__( 'Tools', 'Default' ), __( 'Profile', 'Default' ));
		
		end ( $menu );
		while ( prev( $menu ) ) {
			$value = explode( ' ', $menu[key($menu)][0] );
			if ( in_array( $value[0] != NULL ? $value[0] : "" , $restricted ) ) {
				unset( $menu[key( $menu )] );
			}
		}
	}
}

// remove submenu items
add_action( 'admin_menu', 'default_remove_submenus' );
function default_remove_submenus() {
	global $submenu, $b_user_is_client_admin;
	
	if ( $b_user_is_client_admin ) {
		//unset( $submenu['index.php'][10] ); // Updates
		unset( $submenu['themes.php'][5] ); // Themes
		//unset( $submenu['options-general.php'][15] ); // Writing
		//unset( $submenu['options-general.php'][25] ); // Discussion
		unset( $submenu['edit.php'][16] ); // Tags
	}
}

// remove meta boxes
add_action( 'admin_init','default_remove_meta_boxes' );
function default_remove_meta_boxes() {
	global $b_user_is_client_admin;
	
	//remove_meta_box( 'categorydiv','post','normal' );
	remove_meta_box( 'tagsdiv-post_tag','post','normal' );
	
	if ( $b_user_is_client_admin ) {
		/* posts meta boxes */
		remove_meta_box( 'postcustom','post','normal' );
		remove_meta_box( 'trackbacksdiv','post','normal' );
		//remove_meta_box( 'commentstatusdiv','post','normal' );
		//remove_meta_box( 'commentsdiv','post','normal' );
		//remove_meta_box( 'categorydiv','post','normal' );
		remove_meta_box( 'tagsdiv-post_tag','post','normal' );
		remove_meta_box( 'postexcerpt','post','normal' );
		
		/* pages meta boxes */
		remove_meta_box( 'postcustom','page','normal' );
		remove_meta_box( 'trackbacksdiv','page','normal' );
		remove_meta_box( 'commentstatusdiv','page','normal' );
		remove_meta_box( 'commentsdiv','page','normal' );
	}
}

// remove columns in posts overview
add_filter( 'manage_posts_columns', 'default_remove_post_columns' );
function default_remove_post_columns( $defaults ) {
	global $b_user_is_client_admin;
	
	//unset( $defaults['categories'] );
	unset( $defaults['comments'] );
	unset( $defaults['tags'] );
	
	if ( $b_user_is_client_admin ) {
		// unset( $defaults['comments'] );
		// unset( $defaults['tags'] );
	}
	
	return $defaults;
}

// remove columns in pages overview
add_filter( 'manage_pages_columns', 'default_remove_pages_columns' );
function default_remove_pages_columns( $defaults ) {
	global $b_user_is_client_admin;
	
	unset( $defaults['comments'] );
	if ( $b_user_is_client_admin ) {
		// unset( $defaults['comments'] );
	}
	
	return $defaults;
}

?>