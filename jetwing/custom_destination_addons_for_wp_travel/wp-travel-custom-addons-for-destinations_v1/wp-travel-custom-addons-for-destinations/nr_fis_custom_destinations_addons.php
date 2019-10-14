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
    $destinations = get_terms('travel_locations');

    include ('templates/admin/destinations.php');
}
