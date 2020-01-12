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
global $table_name;
global $table_name2;
global $table_name3;
global $fis_db_version;
$fis_db_version = '1.0.0';
global $wpdb;
$table_name = $wpdb->prefix . "services";
$table_name2 = $wpdb->prefix . "service_map";
$table_name3 = $wpdb->prefix . "sub_services";


//inlcudes
include plugin_dir_path(__FILE__) . 'inc/Core_controller.php';
include plugin_dir_path(__FILE__) . 'inc/My_controller.php';
include plugin_dir_path(__FILE__) . 'inc/View_controller.php';
include plugin_dir_path(__FILE__) . 'inc/Db_functions.php';
include plugin_dir_path(__FILE__) . 'inc/Massage_class.php';
include plugin_dir_path(__FILE__) . 'inc/Upload_view.php';

$cr_con = new Core_controller();
//activation_link
register_activation_hook(__FILE__, array($cr_con, '_nr_fis_destination_install'));

//end includes

function nr_nl_astrology_admin_menu() {
    $load_view = new View_controller();
    //##############################################################################################################################
    //add main menu for apartment and home attributes
    add_menu_page('Service Manager', 'Service Manager', 'manage_options', "services-manager", array($load_view, 'nr_nl_services'), plugins_url('icons/customer.png', __FILE__));
    //attributes Sub Manu
    add_submenu_page("services-manager", 'Add Sub Service', "Add Sub Service", 'manage_options', 'service-add-sub-service', array($load_view, 'nr_nl_service_sub_services'));
    add_submenu_page("services-manager", 'Add Astrologer', "Add Astrologer", 'manage_options', 'service-add-astrologer', array($load_view, 'nr_nl_service_users'));
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
$load_view = new View_controller();
//service Management
add_action('wp_ajax_save_service', array($myCon, 'nr_nl_save_service'));
add_action('wp_ajax_get_edit_details', array($myCon, 'nr_nl_get_edit_details'));
add_action('wp_ajax_update_services', array($myCon, 'nr_nl_update_services'));
add_action('wp_ajax_delete_service', array($myCon, 'nr_nl_delete_service'));

//Astrology management
add_action('wp_ajax_save_astrologist', array($myCon, 'nr_nl_save_astrologist'));

//view_user edit feilds
add_action('show_user_profile', array($load_view, 'my_show_extra_profile_fields'));
add_action('edit_user_profile', array($load_view, 'my_show_extra_profile_fields'));

//update new Users
add_action('personal_options_update', array($myCon, 'my_save_extra_profile_fields'));
add_action('edit_user_profile_update', array($myCon, 'my_save_extra_profile_fields'));


//front end 
add_shortcode("astrology_form", array($load_view, "nr_nl_astrology_form"));

//front end functions 
add_action("wp_ajax_nopriv_get_astrologist", array($myCon, "nr_nl_get_astrologist"));

add_action("nr_custom_title", "nr_nl_custom_edit");

function nr_nl_custom_edit() {
    
}

//save-sub_services
add_action("wp_ajax_save_sub_services", array($myCon, "nr_nl_save_sub_services"));


//get services to the astrolger
add_action("wp_ajax_get_services_astrologer", array($myCon, "nr_nl_get_service_astrologer"));
add_action("wp_ajax_submit_prices_astrologer", array($myCon, "nr_nl_submit_pricess"));

//get sub services 
//add_action("wp_ajax_nopriv_get_sub_service");
