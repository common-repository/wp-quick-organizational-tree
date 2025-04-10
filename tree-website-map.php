<?php
/*
 * Plugin Name: Tree Website Map
 * Description: Tree Website Map is an awesome WordPress plug-in to add a tree view of all pages & custom posts.. <a href="admin.php?page=wm_website_maps">Dashboard</a>
 * Author: wp-buy
 * Author URI: https://www.wp-buy.com/
 * Version: 1.0.0.8
 */
 

define( 'WM_DS', DIRECTORY_SEPARATOR );
define( 'WM_PLUGIN_ROOT_DIR', dirname(__FILE__) );
define( 'WM_PLUGIN_MAIN_FILE', __FILE__ );
define( 'WM_PLUGIN_DIR_URL', plugin_dir_url( __FILE__) );

require_once( WM_PLUGIN_ROOT_DIR.WM_DS."functions.php" );
require_once( WM_PLUGIN_ROOT_DIR.WM_DS."options.php" );

if( isset( $_GET['wmpageid'] ) ){
	switch( $_GET['wmpageid'] ){
		case "wm_image_gen":
		add_action('template_redirect', 'wm_get_custom_image_size');
		break;
		
		case "wm_h_map":
		add_action('template_redirect', 'wm_render_h_map_to_frame');
		break;
	}
}

$path = plugin_basename( __FILE__ );
register_activation_hook( WM_PLUGIN_MAIN_FILE, 'wm_set_settings' );
add_action( 'admin_menu', 'wm_add_menu_page' );
add_action( 'plugins_loaded', 'wm_manage_enqueue' );
add_action( 'wp_ajax_wm_node_delete', 'wm_delete_tree_node' );
add_action( 'wp_ajax_wm_node_editform', 'wm_get_node_form' );
add_action( 'wp_ajax_wm_node_addform', 'wm_get_node_form' );
add_action( 'wp_ajax_wm_add_node', 'wm_save_tree_node' );
add_action( 'wp_ajax_wm_edit_node', 'wm_save_tree_node' );
add_action( 'wp_ajax_wm_drag_node', 'wm_change_parent_node' );
add_action( 'wp_ajax_wm_edit_horizontal_map', 'wm_edit_horizontal_map' );
add_action( 'wp_ajax_wm_edit_vertical_map', 'wm_edit_vertical_map' );
add_action( 'wp_ajax_wm_get_vertical_tree_nodes', 'wm_get_vertical_tree_nodes' );
add_action( 'wp_ajax_nopriv_wm_get_vertical_tree_nodes', 'wm_get_vertical_tree_nodes' );
add_action( 'wp_ajax_wm_del_vertical_tree_node', 'wm_delete_vertical_tree_node' );
add_action( 'wp_ajax_wm_restore_vertical_tree_node', 'wm_restore_vertical_tree_node' );
add_action( 'wp_ajax_wm_delete_map', 'wm_delete_map' );
add_action( 'wp_ajax_nopriv_wm_draw_horizontal_map', 'wm_render_horiontal_map' );
add_action( 'wp_ajax_wm_draw_horizontal_map', 'wm_render_horiontal_map' );
add_shortcode( 'wm_website_map', 'wm_render_website_map' );
add_action( 'after_setup_theme', 'wm_register_thumbnail_size' );
add_action( 'init', 'wm_plugin_ini' );
add_action( 'admin_head', 'wm_render_shortcodes' );

add_action("after_plugin_row_{$path}", 'wmap_after_plugin_row', 10, 3);


?>