<?php

/*
  Plugin Name: Discount Code Management
  Plugin URI: https://www.weblankan.com
  Description: Managing the discount codes for the parking slots
  Version: 1.0
  Author: niroroo619- Nirosh Randimal
  Author URI: www.linkedin.com/in/nirosh-randimal-331598146
  License: GPL2
 */
global $me_db_version;
global $wpdb;

include plugin_dir_path(__FILE__) . 'inc/Db_functions.php';
include plugin_dir_path(__FILE__) . 'inc/Massage_class.php';

//admin Page Menu 
function nr_lw_discount_admin_menu() {
//    add main Menu
    add_menu_page('Discount Codes', 'Discount Codes', 'manage_options', "parking-discount-codes", 'nr_lw_dicount_codes', plugins_url('parking_discount_codes/icons/price.png', __DIR__));
//add submenu
// add_submenu_page("travel-plugin-lagrand", 'Travel Categories', "Travel Categories", 'manage_options', 'travel-categories', 'nr_lw_travel_categories');
}

//adding styls for backend
if (is_admin()) {

    function am_enqueue_admin_styles() {
//boostrap
        wp_register_style('am_admin_bootstrap', plugins_url() . '/parking_discount_codes/assests/plugins/bootstrap/css/bootstrap.min.css');
//        wp_enqueue_style('_nr_boostrap _select_picker', plugins_url('assests/plugins/select_picker/css/bootstrap-select.min.css', __FILE__));
        wp_enqueue_style('_nr_custom_niroroo', plugins_url('assests/plugins/common/css/style.css', __FILE__));
        wp_enqueue_style('_nr_custom_main', plugins_url('assests/css/main_style.css', __FILE__));
        wp_enqueue_style('am_admin_bootstrap');
//
//alerts
        wp_enqueue_style('_nr_custom_alerts', plugins_url('assests/plugins/alerts/Notiflix-1.2.0/Minified/notiflix-1.2.0.min.css', __FILE__));
        wp_enqueue_script('_nr_custom_trigger_alerts', plugins_url("assests/plugins/alerts/trigger/trigger_alert.js", __FILE__), array('jquery'), 1.1, true);
        wp_enqueue_script('_nr_custom_alerts_js', plugins_url("assests/plugins/alerts/Notiflix-1.2.0/Minified/notiflix-1.2.0.min.js", __FILE__), array('jquery'), 1.1, true);
//        wp_enqueue_script('_nr_select_picker_js', plugins_url("assests/plugins/select_picker/js/bootstrap-select.min.js", __FILE__), array('jquery'), 1.1, true);
    }

    add_action('admin_enqueue_scripts', 'am_enqueue_admin_styles');
} else {
//css============================
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

add_action('admin_menu', 'nr_lw_discount_admin_menu');

function nr_lw_dicount_codes() {
    wp_enqueue_script('_nr_customize_functions', plugins_url("assests/plugins/common/js/custom_functions.js", __FILE__), array('jquery'), 1.1, true);
    wp_enqueue_script('_nr_custom_discount_code_adm_js', plugins_url("assests/js/code_admin.js", __FILE__), array('jquery'), 1.1, true);
    wp_localize_script('_nr_custom_discount_code_adm_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
    include ('views/admin/discount_code_manager.php');
}

add_action('wp_ajax_validate_discount_code', '_nr_lw_parking_validate_discount_code');

function _nr_lw_parking_validate_discount_code() {
    $json = array();
    $discount_cord = (isset($_POST['discount_code']) ? $_POST['discount_code'] : '');

    if (!empty($discount_cord)) {
        $db_class = new Db_functions;
        $validate_code = $db_class->get_by("discount_codes", "discount_code", $discount_cord);
        if (empty($validate_code)) {
            $json["msg_type"] = "OK";
        } else {
            $json["msg_type"] = "ERR";
            $json["msg"] = "There is already discount code exactly like this try another.";
        }
    } else {
        $json["msg_type"] = "ERR";
        $json["msg"] = "Something went wrong when processing your request.";
    }
    echo json_encode($json);
    exit();
}

add_action('wp_ajax_save_discount_code', 'nr_lw_save_discount_code');

function nr_lw_save_discount_code() {
    $json = array();
    $msg = new Massage_class();
    $discount_code = (isset($_POST['discountCode']) ? $_POST['discountCode'] : '');
    $percentage = (isset($_POST['percentage']) ? $_POST['percentage'] : '');
    $note = (isset($_POST['note']) ? $_POST['note'] : '');
    $db_class = new Db_functions;
    $validate_code = $db_class->get_by("discount_codes", "discount_code", $discount_cord);
    echo '<pre>';
    print_r($validate_code);
    echo '</pre>';
    if (empty($validate_code)) {
        if (!empty($discount_code)) {
            if (!empty($percentage)) {
                if (is_numeric($percentage)) {
                    $push_array = array(
                        "discount_code" => ($discount_code),
                        "percentage" => ($percentage),
                        "note" => ($percentage),
                        "active" => 1,
                    );
                    $save_codes = $db_class->insert_data("discount_codes", $push_array);
                    if (!empty($save_codes)) {
                        $json["msg_type"] = "OK";
                        $json["msg"] = "Successfully Created the Discount Code";
                        $json['return_array'] = $save_codes;
                    } else {
                        $json["msg_type"] = "ERR";
                        $json["msg"] = "Failed to create the Discount Code for some reason, PLease Try Again in a bit.";
                    }
                } else {
                    $json["msg_type"] = "ERR";
                    $json["msg"] = $msg->validation_errors("numeric", "Discount Percentage");
                }
            } else {
                $json["msg_type"] = "ERR";
                $json["msg"] = $msg->validation_errors("required", "Discount Percentage");
            }
        } else {
            $json["msg_type"] = "ERR";
            $json["msg"] = $msg->validation_errors("required", "Discount Code", "Your going to save discount codes so please enter the discount code");
        }
    } else {
        $json["msg_type"] = "ERR";
        $json["msg"] = "The Discount Code that you entered seems to be in the database please try another.";
    }
    echo json_encode($json);
    exit();
}
