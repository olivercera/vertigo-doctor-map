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
    wp_enqueue_script( 'ajax-script', plugins_url( '/inc/js/map.js', __FILE__ ), array('jquery') );

    wp_localize_script( 'ajax-script', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'img_url' => plugin_dir_url( __FILE__ )) );
}

add_shortcode('vertigo-map-search', 'vertigo_front');

function vf_scripts(){
  
 
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
  wp_enqueue_script( 'ajax-script', plugins_url( '/inc/js/item-ajax.js', __FILE__ ), array('jquery') );

  wp_localize_script( 'ajax-script', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' )) );

  include 'inc/back.php';
}

function vertigo_doctor_get_radius() {
  global $wpdb;
  include 'inc/api/getRadius.php';
  wp_die();
}
add_action( 'wp_ajax_vertigo_doctor_get_radius', 'vertigo_doctor_get_radius' );

function vertigo_doctor_get_data() {
  global $wpdb;
  include 'inc/api/getData.php';
  wp_die();
}
add_action( 'wp_ajax_vertigo_doctor_get_data', 'vertigo_doctor_get_data' );

function vertigo_doctor_create() {
  global $wpdb;
  include 'inc/api/create.php';
  wp_die();
}
add_action( 'wp_ajax_vertigo_doctor_create', 'vertigo_doctor_create' );
function vertigo_doctor_update() {
  global $wpdb;
  include 'inc/api/update.php';
  wp_die();
}
add_action( 'wp_ajax_vertigo_doctor_update', 'vertigo_doctor_update' );

function vertigo_doctor_delete() {
  global $wpdb;
  include 'inc/api/delete.php';
  wp_die();
}
add_action( 'wp_ajax_vertigo_doctor_delete', 'vertigo_doctor_delete' );


function vertigo_create_db() {

  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();
  $table_name = $wpdb->prefix . 'vertigo_doctors';
  include 'inc/dbData.php';
 
}

register_activation_hook( __FILE__, 'vertigo_create_db' );

// create custom plugin settings menu
add_action('admin_menu', 'vertigo_maps_create_menu');

function vertigo_maps_create_menu() {

  //create new top-level menu
  add_menu_page('Vertigo Maps Settings', 'Vertigo Maps Settings', 'administrator', __FILE__, 'vertigo_maps_settings_page' );

  //call register settings function
  add_action( 'admin_init', 'register_vertigo_maps_settings' );
}


function register_vertigo_maps_settings() {
  //register our settings
  register_setting( 'vertigo-maps-settings-group', 'google_api_key' );
}

function vertigo_maps_settings_page() {
?>
<div class="wrap">
<h1>Vertigo Maps</h1>

<form method="post" action="options.php">
    <?php settings_fields( 'vertigo-maps-settings-group' ); ?>
    <?php do_settings_sections( 'vertigo-maps-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Google Maps API_KEY</th>
        <td><input type="text" name="google_api_key" value="<?php echo esc_attr( get_option('google_api_key','API_KEY') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>