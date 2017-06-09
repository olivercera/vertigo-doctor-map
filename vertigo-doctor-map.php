<?php
/*
Plugin Name: Vertigo Specialists Map
Description: Map based specialist search
Version: 0.1
Author: Oliver Cera
Author URI: http://olivercera.com
*/

function vertigo_front() {
    include 'inc/front.php';
}

add_shortcode('vertigo-map-search', 'vertigo_front');

function vf_scripts(){
  
  // add js or css needed for project
  //wp_enqueue_script( ... );  
}

add_action( 'wp_enqueue_scripts', 'vf_scripts' );


// backend -->

add_action( 'admin_menu', 'vf_admin_menu' );

function vf_admin_menu() {
  add_menu_page(
    // $page_title
    'Vertigo Map',
    // $menu_title
    'Vertigo Maps',
    // $capability
    'manage_options',
    // $menu_slug
    'myplugin/myplugin-admin-page.php',
    // $function
    'vf_admin_page',
    // $icon_url
    'dashicons-location',
    // $position
    6
  );
  
}

function vf_admin_page(){
  include 'inc/back.php';
}
function vertigo_create_db() {

  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();
  $table_name = $wpdb->prefix . 'vertigo_doctors';
  include 'inc/dbData.php';
 
}
register_activation_hook( __FILE__, 'vertigo_create_db' );
