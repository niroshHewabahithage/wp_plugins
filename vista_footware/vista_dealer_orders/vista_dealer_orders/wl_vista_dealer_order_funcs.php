<?php
/*
  Plugin Name: Vista Dealer Order Calculator
  Plugin URI: https://www.weblankan.com
  Description: Calculate Orders which made by dealers of the vista shoes
  Version: 1.0
  Author: niroroo619- Nirosh Randimal
  Author URI: www.linkedin.com/in/nirosh-randimal-331598146
  License: GPL2
 */
global $table_name;
global $table_name2;
global $wl_db_version;
$wl_db_version = '1.0.0';
global $wpdb;
$table_name = $wpdb->prefix . "items";
$table_name2 = $wpdb->prefix . "shoe_colors";
global $wp_db;
global  $load_view;
global $db_c;
global $my_con;
global $msg;

//include core_files
include plugin_dir_path(__FILE__) . 'inc/Core_controller.php';
include plugin_dir_path(__FILE__) . 'inc/My_controller.php';
include plugin_dir_path(__FILE__) . 'inc/View_controller.php';
include plugin_dir_path(__FILE__) . 'inc/Db_controller.php';
include plugin_dir_path(__FILE__) . 'inc/Massage_class.php';
$load_view = new View_controller();
$db_c = new Db_controller();
$my_con = new My_controller();
$msg = new Massage_class();


$c_con = new Core_controller();
register_activation_hook(__FILE__, array($c_con, "_wl_dealer_order_install"));

if (is_admin()) {
  add_action("admin_enqueue_scripts", array($c_con, "am_enqueue_admin_styles"));
} else {
  wp_register_style('am_admin_bootstrap', plugins_url('assests/plugins/bootstrap/css/bootstrap.min.css', __FILE__));
  wp_enqueue_style('am_admin_bootstrap');
  wp_enqueue_style('_nr_custom_main', plugins_url('assests/css/main_style.css', __FILE__));
  wp_enqueue_style('_nr_custom_niroroo', plugins_url('assests/plugins/common/css/style.css', __FILE__));
  //select picker css
  wp_enqueue_style('_nr_boostrap _select_picker', plugins_url('assests/plugins/select_picker/css/bootstrap-select.min.css', __FILE__));
  //    js================
  // wp_enqueue_script('_nr_jquesry_number', plugins_url("assests/plugins/jquery_number/jquery.number.min.js", __FILE__), array('jquery'), 1.1, true);
  // wp_enqueue_script('_nr_customize_functions', plugins_url("assests/plugins/common/js/custom_functions.js", __FILE__), array('jquery'), 1.1, true);
  //alerts
  wp_enqueue_style('_nr_custom_alerts', plugins_url('assests/plugins/alerts/Notiflix-1.2.0/Minified/notiflix-1.2.0.min.css', __FILE__));
  wp_enqueue_script('_nr_custom_trigger_alerts', plugins_url("assests/plugins/alerts/trigger/trigger_alert.js", __FILE__), array('jquery'), 1.1, true);
  wp_enqueue_script('_nr_custom_alerts_js', plugins_url("assests/plugins/alerts/Notiflix-1.2.0/Minified/notiflix-1.2.0.min.js", __FILE__), array('jquery'), 1.1, true);
  //select_picker
  wp_enqueue_script('bootstrap', plugins_url('assests/plugins/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'), 1.1, true);
  wp_enqueue_script('_nr_select_picker_js', plugins_url("assests/plugins/select_picker/js/bootstrap-select.min.js", __FILE__), array('jquery'), 1.1, true);
}

// add_shortcode
add_shortcode("dealer-order-form", array($load_view, "_wl_dealer_front_form"));

add_action("admin_menu", array($c_con, "_wl_dealer_order_admin_menu"));


//save_items
add_action("wp_ajax_save_items", array($my_con, "_wl_admin_item_management"));

//delete_items
add_action("wp_ajax_delete_items", array($my_con, "_wl_admin_delete_items"));


//front_get_colors_and_sizes
add_action("wp_ajax_nopriv_get_color_size", array($my_con, "_wl_get_colors_and_sizes"));
add_action("wp_ajax_nopriv_submit_request", array($my_con, "_wl_submit_request_for"));
