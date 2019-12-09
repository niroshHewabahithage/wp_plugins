<?php

/*
  Plugin Name: Astrology Service Search Module
  Plugin URI: https://nine.lk/
  Description: Serch exact astrologist who fits for your requeirement, search pay and get the service
  Version: 1.0
  Author: nineLabs
  Author URI: www.linkedin.com/in/nirosh-randimal-331598146
  License: GPL2
 */

//inlcudes
include plugin_dir_path(__FILE__) . 'inc/Core_controller.php';
include plugin_dir_path(__FILE__) . 'inc/My_controller.php';
include plugin_dir_path(__FILE__) . 'inc/View_controller.php';
include plugin_dir_path(__FILE__) . 'inc/Db_functions.php';
include plugin_dir_path(__FILE__) . 'inc/Massage_class.php';

//end includes

function nr_nl_astrology_admin_menu() {
    $load_view = new View_controller();
    //##############################################################################################################################
    //add main menu for apartment and home attributes
    add_menu_page('Service Manager', 'Service Manager', 'manage_options', "services-manager", array($load_view, 'nr_nl_services'), plugins_url('icons/customer.png', __FILE__));
    //attributes Sub Manu
    add_submenu_page("custom-attributes", 'Custom Sub Attributes', "Custom Sub Attributes", 'manage_options', 'custom-sub-attributes', array($load_view, 'nr_lw_sub_attributes_list'));
    //##############################################################################################################################
}

add_action('admin_menu', 'nr_nl_astrology_admin_menu');

if (is_admin()) {

    function am_enqueue_admin_styles() {
//boostrap
        wp_register_style('am_admin_bootstrap', plugins_url('assests/plugins/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('_nr_boostrap _select_picker', plugins_url('assests/plugins/select_picker/css/bootstrap-select.min.css', __FILE__));
        wp_enqueue_style('am_admin_bootstrap');
        wp_enqueue_style('_nr_custom_niroroo', plugins_url('assests/plugins/common/css/style.css', __FILE__));
        wp_enqueue_style('_nr_select2', plugins_url('assests/plugins/select2/select2.min.css', __FILE__));
        wp_enqueue_style('_nr_custom_main', plugins_url('assests/css/main_style.css', __FILE__));
//
//alerts
        wp_enqueue_style('_nr_custom_alerts', plugins_url('assests/plugins/alerts/Notiflix-1.2.0/Minified/notiflix-1.2.0.min.css', __FILE__));
        wp_enqueue_script('_nr_customize_functions', plugins_url("assests/plugins/common/js/custom_functions.js", __FILE__), array('jquery'), 1.1, true);
        wp_enqueue_style('_nr_custom_sweet_alerts', plugins_url('assests/plugins/sweetalert/css/sweetalert2.min.css', __FILE__));
        wp_enqueue_script('_nr_custom_trigger_alerts', plugins_url("assests/plugins/alerts/trigger/trigger_alert.js", __FILE__), array('jquery'), 1.1, true);
        wp_enqueue_script('_nr_custom_sweet_js', plugins_url("assests/plugins/sweetalert/js/sweetalert2.all.min.js", __FILE__), array('jquery'), 1.1, true);
        wp_enqueue_script('_nr_custom_sweet_min_js', plugins_url("assests/plugins/sweetalert/js/sweetalert2.min.js", __FILE__), array('jquery'), 1.1, true);
        wp_enqueue_script('_nr_select2_min_js', plugins_url("assests/plugins/select2/select2.min.js", __FILE__), array('jquery'), 1.1, true);
        wp_enqueue_script('_nr_custom_alerts_js', plugins_url("assests/plugins/alerts/Notiflix-1.2.0/Minified/notiflix-1.2.0.min.js", __FILE__), array('jquery'), 1.1, true);
        wp_enqueue_script('_nr_select_picker_js', plugins_url("assests/plugins/select_picker/js/bootstrap-select.min.js", __FILE__), array('jquery'), 1.1, true);
    }

    add_action('admin_enqueue_scripts', 'am_enqueue_admin_styles');
} else {

//css============================
    wp_register_style('am_admin_bootstrap', plugins_url('assests/plugins/bootstrap/css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('am_admin_bootstrap');
    wp_enqueue_style('_nr_custom_main', plugins_url('assests/css/main_style.css', __FILE__));
    wp_enqueue_style('_nr_custom_niroroo', plugins_url('assests/plugins/common/css/style.css', __FILE__));
//select picker css
    wp_enqueue_style('_nr_boostrap _select_picker', plugins_url('assests/plugins/select_picker/css/bootstrap-select.min.css', __FILE__));
//    js================
    wp_enqueue_script('_nr_jquesry_number', plugins_url("assests/plugins/jquery_number/jquery.number.min.js", __FILE__), array('jquery'), 1.1, true);
    wp_enqueue_script('_nr_customize_functions', plugins_url("assests/plugins/common/js/custom_functions.js", __FILE__), array('jquery'), 1.1, true);
//alerts
    wp_enqueue_style('_nr_custom_alerts', plugins_url('assests/plugins/alerts/Notiflix-1.2.0/Minified/notiflix-1.2.0.min.css', __FILE__));
    wp_enqueue_script('_nr_custom_trigger_alerts', plugins_url("assests/plugins/alerts/trigger/trigger_alert.js", __FILE__), array('jquery'), 1.1, true);
    wp_enqueue_script('_nr_custom_alerts_js', plugins_url("assests/plugins/alerts/Notiflix-1.2.0/Minified/notiflix-1.2.0.min.js", __FILE__), array('jquery'), 1.1, true);
//select_picker
    wp_enqueue_script('_nr_select_picker_js', plugins_url("assests/plugins/select_picker/js/bootstrap-select.min.js", __FILE__), array('jquery'), 1.1, true);
}

$myCon = new My_controller();

add_action('wp_ajax_save_service', array($myCon, 'nr_nl_save_service'));
add_action('wp_ajax_get_edit_details', array($myCon, 'nr_nl_get_edit_details'));
add_action('wp_ajax_update_services', array($myCon, 'nr_nl_update_services'));
add_action('wp_ajax_delete_service', array($myCon, 'nr_nl_delete_service'));
