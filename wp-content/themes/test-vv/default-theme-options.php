<?php
/**
 * Theme options
 */

if ( function_exists( 'acf_add_options_page' ) ) {
 acf_add_options_page( array(
  'page_title'  => __('Theme Options', 'Default'),
  'menu_title'  => __('Theme Options', 'Default'),
  'menu_slug'   => 'theme-options',
  'capability'  => 'edit_posts',
  'parent_slug' => '',
  'icon_url'    => ''
 ));
}