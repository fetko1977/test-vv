<?php
/**
 * Default functions
 */

// admin js
add_action( 'admin_enqueue_scripts' , 'default_enqueue_admin_script' );
function default_enqueue_admin_script() {
	
	wp_enqueue_script( 'default_admin_script', get_bloginfo( 'template_url' ) . '/javascript/admin.js', array( 'jquery' ), '1.0', false );
	
}

// page title
function default_get_page_title() {
	
	global $post, $page, $paged;
	
	$page_title = '';
	
	// page title
	$page_title .= wp_title( '|', false, 'right' );

	// site description
	/*$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_front_page() ) ) {
		$page_title .= ' | ' . $site_description;
	}*/
	
	return $page_title;
		
}

// share image
function default_get_share_image() {
	
	global $post;
	
	$share_image = '';
		
	if ( has_post_thumbnail() ) {
		$post_thumbnail_id = get_post_thumbnail_id( get_the_ID() );
		$share_image = wp_get_attachment_image_src( $post_thumbnail_id, 'share_image' );
		$share_image = $share_image[0];
	}
	
	if ( ! $share_image && is_front_page() ) {
		$share_image = get_bloginfo( 'template_url' ) . '/images/logo_share.jpg';
	}
		
	return $share_image;
	
}

// filters
add_filter( 'tiny_mce_before_init', 'default_unhide_kitchensink' );
function default_unhide_kitchensink( $args ) {
	$args['wordpress_adv_hidden'] = false;
	return $args;
}

// order posts
/*
add_action( 'posts_orderby', 'default_custom_posts_orderby' );
function default_custom_posts_orderby($orderby){
	if(is_search()){
	    return 'post_type DESC';
	}else{
		return $orderby;
	}
}
*/

// custom CSS for admin login page
add_action( 'login_head', 'default_custom_admin_login' );
function default_custom_admin_login() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo( 'template_directory' ) . '/default-css-admin-login.css" />';
}

// custom logo link & title for admin login page
add_filter( 'login_headerurl', create_function( false, 'return "' . home_url() . '";' ) );
add_filter( 'login_headertitle', create_function( false, 'return "' . get_bloginfo('name') . '";' ) );

// custom CSS for admin pages
add_action( 'admin_head', 'custom_logo' );
function custom_logo() {
	 echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo( 'template_directory' ) . '/default-css-admin.css" />';
}

// chop string
function default_chop_string( $string, $length, $endstring = '...', $striptags = true ) {
	
	if ( $striptags ) {
		$string = strip_shortcodes( $string );
		$string = strip_tags( $string );
	}
	
	if ( strlen( $string ) > $length ) {
		return rtrim( substr( $string, 0, $length ) ) . $endstring;
	} else {
		return $string;
	}
	
}

// make the 'home' link selectable in the menu section in the CMS
/*add_filter( 'wp_page_menu_args', 'default_home_page_menu_args' );
function default_home_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}*/

// mobile detection
function default_is_mobile( $detect_ipad = true ) {
	
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	if ( preg_match( '/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od|' . ( $detect_ipad ? 'ad' : '' ) . ')|iris|kindle|lge |maemo|meego.+mobile|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr( $useragent, 0, 4 ) ) ) {
		return true;
	} else {
		return false;
	}
	
}

function default_display_errors() {
	ini_set( 'display_errors', 1 );
	error_reporting( E_ALL );
}

// page tree
function default_get_root( $page_id ) {
	
	if ( default_get_parent( $page_id ) != false ) {
		return default_get_root( default_get_parent( $page_id ) );
	} else {
		return $page_id;
	}
	
}
function default_get_parent( $page_id ) {
	
	$page = get_page( $page_id );	
	return $page->post_parent;
	
}
function default_get_all_parents( $page_id, $arr_all_parents ) {
	
	if ( default_get_parent( $page_id ) != false ) {
		$arr_all_parents[] = default_get_parent( $page_id );
		return default_get_all_parents( default_get_parent( $page_id ), $arr_all_parents );
	} else {
		return $arr_all_parents;
	}
	
}

// menu highlighting
add_filter( 'nav_menu_css_class', 'default_add_class_to_current_posttype_parents_menu', 10, 2 );
function default_add_class_to_current_posttype_parents_menu( $classes, $item ) {
	
    // classes voor actieve items
	//$post_type = get_query_var( 'post_type' );
	$post_type = get_post_type();
	if ( $post_type == 'post' ) {
		$post_type_page_id = get_option( 'page_for_posts' );
	} else {
		$post_type_page_id = default_get_page_id_linked_to_template( $post_type );
	}
	
	if ( $post_type_page_id != '' ) {
		
		// huidige pagina actief zetten
		if ( $item->object_id == $post_type_page_id ) {
			array_push( $classes, 'current_page_item' );
		}
		
		// ids ophalen van alle parent pages van de post type page
		$arr_parent_ids = default_get_all_parents( $post_type_page_id, array() );
		// kijken als menu item in array zit en actief zetten
		if ( is_array( $arr_parent_ids ) && in_array( $item->object_id, $arr_parent_ids ) ) {
			array_push( $classes, 'current_page_item' );
		}
		
	}
	
    return $classes;
	
}

// submenu
function default_get_submenu( $current_page_id, $depth = 100, $current_depth = 0 ) {
	
	$submenu = '';
	
	// vanaf het huidige pagina id de hoogste parent ophalen, en daarvan de subitems oplijsten
	
	// hoogste parent ophalen
	$root = default_get_root( $current_page_id );
	
	$submenu .= default_get_submenu_inner( $root, $current_page_id, $depth, $current_depth, true );
	
	return $submenu;
	
}
function default_get_submenu_inner( $page_id, $current_page_id, $depth, $current_depth, $is_root = false ) {
	
	$current_depth++;
	
	$submenu = '';
	
	$args = array( 'parent' => $page_id, 'sort_column' => 'menu_order', 'hierarchical' => 0 );
	$subpages = get_pages( $args );
	
	if ( is_array( $subpages ) && count( $subpages ) > 0 ) {
		
		if ( $is_root ) {
			$submenu .= '<div class="submenu">';
		}
		
		$submenu .= '<ul class="level_' . esc_attr( $current_depth ) . '">';
			
			$count = 1;
			foreach ( $subpages as $subpage ) {
				
				$subpage_link = get_permalink( $subpage->ID );
				$subpage_titel = apply_filters( 'the_title', $subpage->post_title );
				$classes = array();
				
				if ( $count == count( $subpages ) ) {
					$classes[] = 'last';
				}
				if ( $current_page_id == $subpage->ID || in_array( $subpage->ID, default_get_all_parents( $current_page_id, array() ) ) ) {
					$classes[] = 'active';
				}
				
				$submenu .= '<li class="' . implode( ' ', $classes ) . '">';
				$submenu .= '<a href="' . $subpage_link . '">' . $subpage_titel . '</a>';
					
					// subpagina's ophalen
					if ( $current_depth < $depth ) {
						$submenu .= default_get_submenu_inner( $subpage->ID, $current_page_id, $depth, $current_depth );
					}
					
				$submenu .= '</li>';
				
				$count++;
				
			}
			
		$submenu .= '</ul>';
		
		if ( $is_root ) {
			$submenu .= '</div>';
		}
		
	}
	
	return $submenu;
	
}

// language selector
function default_get_language_selector( $displaymethod = 'language_code' ) {
	$language_selector = '';
	
	if ( function_exists( 'icl_get_languages' ) ) {
		$arr_languages = icl_get_languages( 'skip_missing=0&orderby=custom&order=desc' );
		
		if ( count( $arr_languages ) > 1 ) {
			
			$query_params = $_SERVER['QUERY_STRING'];
			if ( $query_params != '' ) {
				$query_params = '?' . $query_params;
			}
			
			$language_selector .= '<div class="language_selector">';
				$language_selector .= '<ul>';
				
				foreach ( $arr_languages as $language ) {
					$language_selector .= '<li class="language language_' . $language['language_code'] . ( $language['active'] == '1' ? ' language_active' : '' ) . '"><a href="' . $language['url'] . $query_params . '">' . $language[$displaymethod] . '</a></li>';
				}
				
				$language_selector .= '</ul>';
			$language_selector .= '</div>';
		}
	}
	
	return $language_selector;
}

// get default language
function default_get_default_language() {
	
	$default_language = '';
	
	// checken als WPML actief is
	global $sitepress;
	if ( function_exists( 'icl_get_languages' ) && method_exists( $sitepress, 'get_default_language' ) ) {
		
		$default_language = $sitepress->get_default_language();
		
	}
	
	return $default_language;
	
}


// get browser language
/*function default_get_browser_language() {
	
	$langcode = ( ! empty( $_SERVER['HTTP_ACCEPT_LANGUAGE'] ) ) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : '';
	$langcode = ( ! empty( $langcode ) ) ? explode( ";", $langcode ) : $langcode;
	$langcode = ( ! empty( $langcode['0'] ) ) ? explode( ",", $langcode['0'] ) : $langcode;
	$langcode = ( ! empty( $langcode['0'] ) ) ? explode( "-", $langcode['0'] ) : $langcode;
	
	return $langcode['0'];
	
}*/

// content fetch functions
function default_get_current_language() {
	
	$current_language = '';

	if ( defined( 'ICL_LANGUAGE_CODE' ) ) { // WPML
		$current_language = ICL_LANGUAGE_CODE;
	} elseif ( function_exists( 'qtrans_getlanguage' ) ) { // qtranslate
		$current_language = qtrans_getlanguage();
	}
	
	return $current_language;
	
}

// get post id in default language
function default_get_post_id_default_language( $id, $post_type = 'post' ) {
	
	$id_dl = '';
	
	if ( function_exists( 'icl_object_id' ) && default_get_default_language() != ICL_LANGUAGE_CODE ) {
		
		$id_dl = icl_object_id( $id, $post_type, false, default_get_default_language() );
		
	}
	
	return $id_dl;
	
}

function default_get_excerpt( $post = '' ) {
	
	if ( empty( $post ) ) {
		global $post;
	}
	
	$result = array();
	
	$raw_content = $post->post_content;
	$result['raw'] = $raw_content;
	
	$parts = preg_split( '/<!--more(.*?)?-->/', $raw_content );
	$result['parts'] = $parts;
	
	// als er geen more tag in zit, de eerste 200 karakters ophalen
	if ( count( $parts ) == 1 ) {
		
		// excerpt = eerste 200 tekens
		$excerpt = default_chop_string( $parts[0], 200 );
		
		// rest de overschot
		$raw_content = strip_shortcodes( $raw_content );
		$raw_content = strip_tags( $raw_content );
		$rest = substr( $raw_content, 200 );
		if ( ! empty( $rest ) ) {
			$rest = '...' . $rest;
		}
		
	} else {
		
		// excerpt = 1ste deel (voor more tag)
		$excerpt = $parts[0];
		
		// rest zijn andere delen
		unset( $parts[0] );
		$rest = implode( '', $parts );
		
	}
	
	$result['excerpt'] = rtrim( $excerpt );
	$result['rest'] = ltrim( $rest );
	
	return $result;
	
}

// content fetch functions
function default_get_post_meta( $id, $field, $post_type = 'post', $if_empty_get_value_from_default_language = true ) {
	
	// get value in active language
	$value = get_post_meta( $id, $field, true );
	
	if ( $value == 'nothing' ) {
		$value = '';
	}
	
	// if value is empty and we want to get the value from the site's default language, get it
	if ( function_exists( 'icl_object_id' ) && empty( $value ) && $if_empty_get_value_from_default_language && default_get_default_language() != ICL_LANGUAGE_CODE ) {
		
		// get post id from the post in the site's default language
		$post_id = icl_object_id( $id, $post_type, false, default_get_default_language() );
		if ( $post_id != NULL ) {
			$value = get_post_meta( $post_id, $field, true );
		}
	}
	
	return $value;
	
}

function default_get_post_meta_acf( $id, $field, $post_type = 'post', $if_empty_get_value_from_default_language = true ) {
	
	$value = '';
	$value = get_field( $field, $id );
	
	if ( function_exists( 'icl_object_id' ) && empty( $value ) && $if_empty_get_value_from_default_language && default_get_default_language() != ICL_LANGUAGE_CODE ) {
		
		$post_id = icl_object_id( $id, $post_type, false, default_get_default_language() );
		if ( ! empty( $post_id ) ) {
			$value = get_field( $field, $post_id );
		}
		
	}
	
	return $value;
	
}

function default_get_post_thumbnail( $id, $post_type = 'post', $size = 'full', $return_type = 'src', $if_empty_get_image_from_default_language = true ) {
	
	$item_image = '';
	
	// get image in active language
	if ( has_post_thumbnail( $id ) ) {
		
		$item_image = default_get_post_thumbnail_inner( $id, $size, $return_type );
		
	}
	
	// if no image get image in the site's default language
	if ( function_exists( 'icl_object_id' ) && empty( $item_image ) && $if_empty_get_image_from_default_language && default_get_default_language() != ICL_LANGUAGE_CODE ) {
		
		// get post id from the post in the site's default language
		$post_id = icl_object_id( $id, $post_type, false, default_get_default_language() );
		if ( $post_id != NULL ) {
			
			if ( has_post_thumbnail( $post_id ) ) {
				$item_image = default_get_post_thumbnail_inner( $post_id, $size, $return_type );
			}
			
		}
		
	}
	
	return $item_image;
	
}
function default_get_post_thumbnail_inner( $id, $size = 'full', $return_type = 'src' ) {
	
	$item_image = '';
	
	if ( $return_type == 'src' ) {
		
		$item_image_id = get_post_thumbnail_id( $id );
		if ( $item_image_id ) {
			$item_image = wp_get_attachment_image_src( $item_image_id, $size );
			$item_image = $item_image[0];
		}
		
	} elseif ( $return_type == 'object' ) {
		
		$item_image_id = get_post_thumbnail_id( $id );
		if ( $item_image_id ) {
			$item_image_src = wp_get_attachment_image_src( $item_image_id, $size );
			$item_image_src = $item_image_src[0];
		}
		
		$item_image['id'] = $item_image_id;
		$item_image['src'] = $item_image_src;
		$item_image['alt'] = get_post_meta( $item_image_id, '_wp_attachment_image_alt', true );
		
	} else {
		
		$item_image = get_the_post_thumbnail( $id, $size );
		
	}
	
	return $item_image;
	
}

// TODO: verbetering: $sizes array als key->value array meegeven zodat we niet moeten vertrouwen op size_0, size_1, ...
function default_get_attachments( $post_id, $name, $sizes = array( 'full' ), $fields = array( 'alt' ), $post_type = 'post', $if_empty_get_attachments_from_default_language = true ) {
	
	$arr_attachments = array();
	
	if ( class_exists( 'Attachments' ) ) {
		
		$attachments = new Attachments( $name, $post_id );
		
		if ( $attachments->exist() && $attachments->total() > 0 ) {
			
			$arr_attachments = default_get_attachments_inner( $attachments, $sizes, $fields );
			
		} elseif ( function_exists( 'icl_object_id' ) && $if_empty_get_attachments_from_default_language && default_get_default_language() != ICL_LANGUAGE_CODE ) {
			
			// get post id from the post in the site's default language
			$d_post_id = icl_object_id( $post_id, $post_type, false, default_get_default_language() );
			if ( $d_post_id != NULL ) {
				
				$attachments = new Attachments( $name, $d_post_id );
				
				if ( $attachments->exist() && $attachments->total() > 0 ) {
					
					$arr_attachments = default_get_attachments_inner( $attachments, $sizes, $fields );
					
				}
				
			}
			
		}
		
	}
	
	return $arr_attachments;
	
}
function default_get_attachments_inner( $attachments, $sizes, $fields ) {
	
	$arr_attachments = array();
	
	while ( $attachments->get() ) {
		
		$attachment = array();
		
		if ( is_array( $sizes ) && count( $sizes ) > 0 ) {
			$size_count = 0;
			foreach ( $sizes as $size ) {
				$attachment['size_' . $size_count] = $attachments->src( $size );
				$size_count++;
			}
		}
		
		if ( count( $fields ) > 0 ) {
			foreach ( $fields as $field ) {
				$attachment[$field] = $attachments->field( $field );
			}
		}
		
		$attachment['url'] = $attachments->url();
		
		$arr_attachments[] = $attachment;
		
	}
	
	return $arr_attachments;
	
}

function default_get_link_object( $link ) {
	
	$o_link = new stdClass();
	
	// http:// aanwezig?, indien niet erbij zetten
	if ( strpos( $link, 'mailto:' ) === false && strpos( $link, 'http://' ) === false && strpos( $link, 'https://' ) === false && $link != '' ) {
		$o_link->url = 'http://' . $link;
	} else {
		$o_link->url = $link;
	}
	
	// link zonder http of https
	$cleanurl = str_replace( 'http://', '', $link );
	$cleanurl = str_replace( 'https://', '', $cleanurl );
	// ook laatste slash verwijderen
	if ( substr( $cleanurl, -1, 1 ) == '/' ) {
		$cleanurl = substr( $cleanurl, 0, -1 );
	}
	$o_link->cleanurl = $cleanurl;
	
	// interne of externe link?
	if ( strpos( $o_link->url, home_url() ) !== false ) {
		$o_link->target = '_self';
	} else {
		$o_link->target = '_blank';
	}
	
	return $o_link;
	
}

function default_get_request( $field ) {
	
	return ( isset( $_REQUEST[$field] ) ? stripslashes( $_REQUEST[$field] ) : '' );
	
}
// -- fields --
// input
function default_build_field( $name, $label, $value ) {
	
	?>
	<p>
		<label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?>:</label><br />
		<input type="text" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" class="widefat" />
	</p>
	<?php
	
}
function default_save_field( $post_id, $field ) {
	
	if ( isset( $_POST[$field] ) ) {
		if ( ! add_post_meta( $post_id, $field, $_POST[$field], true ) ) {
			update_post_meta( $post_id, $field, $_POST[$field] );
		}					
	}
	
}

// WYSIWYG
function default_build_wysiwyg_field( $name, $label, $value, $teeny = true, $media_buttons = false ) {
	
	?>
	<p>
		<label for="<?php echo esc_attr( $name ); ?>" style="float: left; padding:10px 0 0 0;"><?php echo esc_html( $label ); ?>:</label>
		<?php wp_editor( $value, $name, array( 'teeny' => $teeny, 'media_buttons' => $media_buttons, 'textarea_rows' => 10, 'textarea_name' => $name ) ); ?>
	</p>
	<?php
	
}

// checkbox
function default_build_checkbox_field( $name, $label, $value ) {
		
	?>
	<p>
		<input type="checkbox" id="<?php echo esc_attr( $name ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php echo ( $value ? ' checked="checked"' : '' ); ?> />
		<label for="<?php echo esc_attr( $name ); ?>"><?php echo esc_html( $label ); ?></label>
	</p>
	<?php
	
}
function default_save_checkbox_field( $post_id, $field ) {
	
	$value = '0';
	if ( isset( $_POST[$field] ) && $_POST[$field] == 'on' ) {
		$value = '1';
	}
	update_post_meta( $post_id, $field, $value );
	
}

// dropdown van CPT
function default_build_cpt_dropdown_field( $name, $cpt, $value, $label = '', $custom_args = '' ) {
	
	$input = '';
	
	$input = '<p class="default_cpt_dropdown" data-id="' . $name . '">';
		
		if ( $label != '' ) {
			$input .= '<label for="' . $name . '">' . $label . ':</label><br />';
		}
		
		$args = array(
			'posts_per_page' => -1,
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_type' => $cpt
		);
		
		// als er custom parameters meegegeven zijn, deze gebruiken in de $args array
		if ( is_array( $custom_args ) ) {
			
			foreach ( $custom_args as $k => $v ) {
				$args[$k] = $v;
			}
			
		}
		
		$get_items = new WP_Query( $args );
		
		if ( $get_items->have_posts() ) {
			
			$input .= '<select name="' . $name . '" id="dropdown_' . $name . '" class="widefat default_link_selector_select">';
			
				$input .= '<option value="">' . __( 'Select..', 'Default' ) . '</option>';
				
				// met een custom foreach werken ipv de standaard WP loop door een bug waardoor wp_reset_postdata werkt in CMS
				foreach ( $get_items->posts as $item ) {
					
					$input .= '<option value="' . $item->ID . '"' . ( $item->ID == $value ? ' selected="selected"' : '' ) . '>' . esc_attr( get_the_title( $item->ID ) ) . '</option>';
					
				}
				
			$input .= '</select>';
			
		} else {
			$input .= esc_html__( 'No items yet.', 'Default' );
		}
		
		wp_reset_postdata();
		
	$input .= '</p>';
	
	echo $input;
	
}

// link
function default_build_link_field( $name, $label = 'Link', $value, $enable_manual_input = true ) {
	
	$arr_disabled_post_types = array( 'attachment' );
	
	$input = '';
			
	$manual_input = true;
	if ( is_numeric( $value ) || $value == '' ) { 
		$manual_input = false;
	}
	
	$input = '<p class="default_link_selector" data-id="' . $name . '">';
		
		if ( $label != '' ) {
			$input .= '<label for="dropdown_' . $name . '">' . esc_html( $label ) . ':</label><br />';
		}
		
		$input .= '<select id="dropdown_' . $name . '" class="widefat default_link_selector_select"' . ( $manual_input ? ' style="display: none;"' : '' ) . '>';
		
		$input .= '<option value="">' . __( 'Select..', 'Default' ) . '</option>';
		
		$post_types = get_post_types(
			array( 'exclude_from_search' => false ),
			'objects'
		);
		foreach ( $post_types as $post_type ) {
			
			if ( ! in_array( $post_type->name, $arr_disabled_post_types ) ) {
				
				$args = array(
					'posts_per_page' => -1,
					'post_type' => $post_type->name
				);
				
				if ( $post_type->hierarchical ) {
					$args['orderby'] = 'parent menu_order';
					$args['order'] = 'ASC';
				}
				
				$get_items = new WP_Query( $args );
				
				if ( $get_items->have_posts() ) {
					
					$input .= '<optgroup label="' . esc_attr( $post_type->labels->name ) . '">';
					
					// met een custom foreach werken ipv de standaard WP loop door een bug waardoor wp_reset_postdata werkt in CMS
					foreach ( $get_items->posts as $item ) {
						
						$label = get_the_title( $item->ID );
						if ( $item->post_parent != 0 ) {
							$label = get_the_title( $item->post_parent ) . ' &gt; ' . $label;
						}
						$input .= '<option value="' . $item->ID . '"' . ( $item->ID == $value ? ' selected="selected"' : '' ) . '>' . esc_attr( $label ) . '</option>';
						
					}
					
					$input .= '</optgroup>';
					
				}
				
				wp_reset_postdata();
				
			}
			
		}
		
		$input .= '</select>';
		
		$input .= '<input type="text" id="input_' .$name . '" value="' . esc_attr( $value ) . '" class="widefat default_link_selector_input"' . ( $manual_input ? '' : ' style="display: none;"' ) . ' />';
		
		if ( $enable_manual_input ) {
			$input .= '<input type="checkbox" id="check_' . $name . '"' . ( $manual_input ? ' checked="checked"' : '' ) . ' class="default_link_selector_check" />&nbsp;<label for="check_' . $name . '">' . __( 'Input link manually', 'Default' ) . '</label>';
		}
		
		$input .= '<input type="hidden" name="' .$name . '" id="' .$name . '" value="' . esc_attr( $value ) . '" class="default_link_selector_value" />';
		
	$input .= '</p>';
	
	echo $input;
	
}
function default_get_link_field_value( $post_id, $name, $post_type = 'post' ) {
	
	$link = default_get_post_meta( $post_id, $name, $post_type, false );
	
	if ( is_numeric( $link ) ) {
		
		$link = get_permalink( $link );
		
	}
	
	if ( $link != '' ) {
		
		$link = default_get_link_object( $link );
		
	}
	
	return $link;
	
}

// box met checkboxes om posts van een bepaald post type te selecteren
// TODO: component herzien
/* ideeën:
 * - scrollbar als er veel items zijn
 * - zoekfunctie (beetje zoals de tag selectbox)
 * - volgorde van items kunnen bepalen? Moet dit op dit niveau? Of eerder op CPT niveau? -> voordeel: per post kan de volgorde individueel bepaald worden, nadeel: -> als er heel veel posts zijn en de volgorde mag overal dezelfde zijn moet ze wel per post aangepast worden
*/

function default_build_cpt_checkbox_list_field( $name, $value, $cpt, $orderby = 'title' ) {
	
	$input = '';
	
	// items ophalen
	$args = array(
		'posts_per_page' => -1,
		'orderby' => $orderby,
		'order' => 'ASC',
		'post_type' => $cpt
	);
	
	$get_items = new WP_Query( $args );
	
	if ( $get_items->have_posts() ) {
		
		$input = '<div class="default_cpt_checkbox_list" data-id="' . $name . '"><ul>';
		
		foreach ( $get_items->posts as $item ) {
			
			$checked = false;
			if ( is_array( $value ) && in_array( $item->ID, $value ) ) {
				$checked = true;
			} elseif ( $value == $item->ID ) {
				$checked = true;
			}
			
			$input .= '<li><input type="checkbox" name="' . $name . '[]" value="' . $item->ID . '" id="default_cpt_checkbox_' . $name . '_' . $item->ID . '"' . ( $checked ? ' checked="checked"' : '' ) . ' /> <label for="default_cpt_checkbox_' . $name . '_' . $item->ID . '">' . esc_attr( get_the_title( $item->ID ) ) . '</label></li>';
			
		}
		
		$input .= '</ul></div>';
		
	} else {
		
		$input = '<div class="default_cpt_checkbox_list_no_items">' . esc_html__( 'No items to select.', 'Default' ) . '</div>';
		
	}
	
	wp_reset_postdata();
	
	echo $input;
	
}
function default_save_cpt_checkbox_list_field( $post_id, $field ) {
	
	$value = '';
	if ( isset( $_POST[$field] ) ) {
		$value = $_POST[$field];
	}
	update_post_meta( $post_id, $field, $value );
	
}

function default_build_repeater_field( $s_id, $arr_repeater_fields ) {
	
	global $i_max_number_of_repeater_fields;
	
	$td_width = 90 / count( $arr_repeater_fields );
	
	?>
	<table class="repeater repeater_<?php echo $s_id; ?>" width="100%">
		<thead>
			<tr>
				<?php
					foreach ( $arr_repeater_fields as $field ) {
						?>
						<th style="text-align:left;" width="<?php echo $td_width; ?>%"><?php echo $field['label']; ?></th>
						<?php
					}
				?>
				<th width="10%">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php
				for ( $x = 0; $x < $i_max_number_of_repeater_fields; $x++ ) {
					
					$arr_values = array();
					$empty = true;
					foreach ( $arr_repeater_fields as $field ) {
						
						$value = get_post_meta( get_the_ID(), $s_id . '_' . $field['name'] . '_' . $x, true );
						
						// kijken als er een veld ingevuld is, als er geen enkel veld ingevuld is -> rij niet tonen
						if ( $value != '' ) {
							$empty = false;
						}
						
						$arr_values[$field['name']] = $value;
						
					}
					
					?>
					<tr class="repeater_row repeater_row_<?php echo $x; ?>" style="display: <?php echo ( $empty && $x != 0 ? 'none' : 'table-row' ); ?>;">
						<?php
							foreach ( $arr_repeater_fields as $field ) {
								?>
								<td>
									<input type="text" id="<?php echo $s_id . '_' . $field['name'] . '_' . $x; ?>" name="<?php echo $s_id . '_' . $field['name'] . '_' . $x; ?>" value="<?php echo $arr_values[$field['name']]; ?>" class="widefat" />
								</td>
								<?php
							}
						?>
						<td>
							<?php
								if ( $x == 0 ) {
									?>
									<a class="repeater_add" data-id="<?php echo $s_id; ?>" title="<?php _e( 'Add', 'Default' ); ?>"><?php _e( 'Add', 'Default' ); ?></a>
									<?php
								} else {
									echo '&nbsp;';
								}
							?>
						</td>
					</tr>
					<?php
					
				}
			?>
		</tbody>
	</table>
	<?php
}

function default_save_repeater_field( $post_id, $s_id, $arr_repeater_fields ) {
	
	global $i_max_number_of_repeater_fields;
	
	$arr_values = array();
	
	$count = 0;
	for ( $x = 0; $x < $i_max_number_of_repeater_fields; $x++ ) {
		
		$arr_value = array();
		$empty = true;
		foreach ( $arr_repeater_fields as $field ) {
			
			$arr_value[$field['name']] = isset( $_POST[$s_id . '_' . $field['name'] . '_' . $x] ) ? $_POST[$s_id . '_' . $field['name'] . '_' . $x] : '';
			if ( $arr_value[$field['name']] != '' ) {
				$empty = false;
			}
			
		}
		
		if ( ! $empty ) {
			foreach ( $arr_repeater_fields as $field ) {
				$arr_values[$count][$field['name']] = $arr_value[$field['name']];
			}
			
			$count++;
		}
		
	}
	
	for ( $x = 0; $x < $i_max_number_of_repeater_fields; $x++ ) {
		
		foreach ( $arr_repeater_fields as $field ) {
			if ( isset( $arr_values[$x] ) ) {
				update_post_meta( $post_id, $s_id . '_' . $field['name'] . '_' . $x, $arr_values[$x][$field['name']] );
			} else {
				update_post_meta( $post_id, $s_id . '_' . $field['name'] . '_' . $x, '' );
			}
		}
		
	}
	
}

// ACF options page
/*if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( array(
		'page_title' => __( 'Theme settings', 'Default' ),
		'menu_title' => __( 'Theme settings', 'Default' ),
		'menu_slug' => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect' => false
	) );
}
function default_get_acf_option( $option, $if_empty_get_value_from_default_language = true ) {
	
	$value = get_field( $option, 'option' );
	
	// als het leeg is de waarde uit de default taal ophalen
	if ( defined( 'ICL_LANGUAGE_CODE' ) && empty( $value ) && $if_empty_get_value_from_default_language && Defaultget_default_language() != ICL_LANGUAGE_CODE ) {
		
		$value = get_option( 'options_' . $option );
		
	}
	
	return $value;
	
}*/

// acf repeater
function default_get_acf_repeater_rows( $post_id, $post_type, $repeater, $fields, $required_fields, $if_empty_get_value_from_default_language = false ) {
	
	$arr_rows = default_get_acf_repeater_rows_inner( $post_id, $post_type, $repeater, $fields, $required_fields );
	
	if ( defined( 'ICL_LANGUAGE_CODE' ) && count( $arr_rows ) == 0 && $if_empty_get_value_from_default_language && default_get_default_language() != ICL_LANGUAGE_CODE ) {
		
		$post_id = icl_object_id( $post_id, $post_type, false, default_get_default_language() );
		if ( $post_id != NULL ) {
			$arr_rows = default_get_acf_repeater_rows_inner( $post_id, $post_type, $repeater, $fields, $required_fields );
		}
		
	}
	
	return $arr_rows;
	
}
function default_get_acf_repeater_rows_inner( $post_id, $post_type, $repeater, $fields, $required_fields ) {
	
	$arr_rows = array();
	
	// zijn de nodige parameters meegegeven
	if ( ! empty( $repeater ) && is_array( $fields ) && count( $fields ) > 0 ) {
		
		// heeft de repeater rijen
		if ( have_rows( $repeater, $post_id ) ) {
			
			while ( have_rows( $repeater, $post_id ) ) {
				
				the_row();
				
				$arr_row = array();
				$valid = true;
				
				// haal velden op
				foreach ( $fields as $field ) {
					
					$value = get_sub_field( $field );
					
					// zit het veld in de verplichte velden en is het leeg -> invalid
					if ( is_array( $required_fields ) && count( $required_fields ) && in_array( $field, $required_fields ) && empty( $value ) ) {
						$valid = false;
					}
					
					$arr_row[$field] = $value;
					
				}
				
				// indien valid -> toevoegen
				if ( $valid ) {
					$arr_rows[] = $arr_row;
				}
				
			}
			
		}
		
	}
	
	return $arr_rows;
	
}
?>