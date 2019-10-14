<?php

/*
  Plugin Name: Destination Addons
  Plugin URI: www.linkedin.com/in/nirosh-randimal-331598146
  Description: Appending Custom value to wp Travel Destinations
  Version: 1.0
  Author: niroroo619(තඩියා)- Nirosh Randimal
  Author URI: www.linkedin.com/in/nirosh-randimal-331598146
  License: GPL2
 */

register_activation_hook(__FILE__, 'child_plugin_activate');
include plugin_dir_path(__FILE__) . 'inc/Upload_view.php';

function child_plugin_activate() {

    // Require parent plugin
    if (!is_plugin_active('wp-travel/wp-travel.php') and current_user_can('activate_plugins')) {
        // Stop activation redirect and show error
        wp_die('Sorry, but this plugin requires the Parent Plugin to be installed and active. <br><a href="' . admin_url('plugins.php') . '">&laquo; Return to Plugins</a>');
    }
}

function nr_fis_destinations_admin_menu() {
    add_menu_page('Destination Addons', 'Destination Addons', 'manage_options', "destination-addons", 'nr_admin_manu_primary', plugins_url('wp-travel-custom-addons-for-destinations/icons/locations_Add.png', __DIR__), 59);
}

add_action('admin_menu', 'nr_fis_destinations_admin_menu');

function am_enqueue_admin_styles() {
//alerts
    wp_enqueue_style('_nr_custom_alerts', plugins_url('assests/plugins/alerts/Notiflix-1.2.0/Minified/notiflix-1.2.0.min.css', __FILE__));
    wp_enqueue_script('_nr_custom_trigger_alerts', plugins_url("assests/plugins/alerts/trigger/trigger_alert.js", __FILE__), array('jquery'), 1.1, true);
    wp_enqueue_script('_nr_custom_alerts_js', plugins_url("assests/plugins/alerts/Notiflix-1.2.0/Minified/notiflix-1.2.0.min.js", __FILE__), array('jquery'), 1.1, true);
    wp_enqueue_script('_nr_select_picker_js', plugins_url("assests/plugins/select_picker/js/bootstrap-select.min.js", __FILE__), array('jquery'), 1.1, true);
}

add_action('admin_enqueue_scripts', 'am_enqueue_admin_styles');

//basic functions
function nr_admin_manu_primary() {
    wp_enqueue_style('_nr_custom_main', plugins_url('assests/css/main_style.css', __FILE__));
    wp_register_style('am_admin_bootstrap', plugins_url() . '/wp-travel-custom-addons-for-destinations/assests/plugins/bootstrap/css/bootstrap.min.css');
    wp_enqueue_style('_nr_boostrap _select_picker', plugins_url('assests/plugins/select_picker/css/bootstrap-select.min.css', __FILE__));
    wp_enqueue_style('am_admin_bootstrap');
    wp_enqueue_style('_nr_custom_niroroo', plugins_url('assests/plugins/common/css/style.css', __FILE__));
    wp_enqueue_script('_nr_destination_upload_js', plugins_url("assests/js/uplaod_handler.js", __FILE__), array('jquery'), 1.1, true);
    wp_localize_script('_nr_destination_upload_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
    $destinations = get_terms('travel_locations');


    include ('templates/admin/destinations.php');
}

add_action('wp_ajax_fetch_button', "nr_fis_multi_button");

function nr_fis_multi_button() {
    $json = array();
    $return_item = "";
    $item_name = (isset($_POST['item_name']) ? $_POST['item_name'] : '');
    $width = (isset($_POST['width']) ? $_POST['width'] : '');
    $height = (isset($_POST['height']) ? $_POST['height'] : '');
    $upload_btn = new Upload_view;

    $return_item .= "<div class='col-sm-3'>";
    $return_item .= $upload_btn->nr_fixel_it_wprss_uploader_multi($item_name, $width, $height);
    $return_item .= "</div>";

    $json['msg_type'] = "OK";
    $json['return_array'] = $return_item;

    echo json_encode($json);
    exit();
}

add_action('wp_ajax_save_items', "nr_fis_save_destination_values");

function nr_fis_save_destination_values() {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
}
