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
        wp_enqueue_style('_nr_custom_sweet_alerts', plugins_url('assests/plugins/sweetalert/css/sweetalert2.min.css', __FILE__));
        wp_enqueue_script('_nr_custom_trigger_alerts', plugins_url("assests/plugins/alerts/trigger/trigger_alert.js", __FILE__), array('jquery'), 1.1, true);
        wp_enqueue_script('_nr_custom_sweet_js', plugins_url("assests/plugins/sweetalert/js/sweetalert2.all.min.js", __FILE__), array('jquery'), 1.1, true);
        wp_enqueue_script('_nr_custom_sweet_min_js', plugins_url("assests/plugins/sweetalert/js/sweetalert2.min.js", __FILE__), array('jquery'), 1.1, true);
        wp_enqueue_script('_nr_custom_alerts_js', plugins_url("assests/plugins/alerts/Notiflix-1.2.0/Minified/notiflix-1.2.0.min.js", __FILE__), array('jquery'), 1.1, true);
//        wp_enqueue_script('_nr_select_picker_js', plugins_url("assests/plugins/select_picker/js/bootstrap-select.min.js", __FILE__), array('jquery'), 1.1, true);
    }

    add_action('admin_enqueue_scripts', 'am_enqueue_admin_styles');
} else {

//css============================
    wp_register_style('am_admin_bootstrap', plugins_url() . '/parking_discount_codes/assests/plugins/bootstrap/css/bootstrap.min.css');
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

add_action('admin_menu', 'nr_lw_discount_admin_menu');

function nr_lw_dicount_codes() {
    wp_enqueue_script('_nr_customize_functions', plugins_url("assests/plugins/common/js/custom_functions.js", __FILE__), array('jquery'), 1.1, true);
    wp_enqueue_script('_nr_custom_discount_code_adm_js', plugins_url("assests/js/code_admin.js", __FILE__), array('jquery'), 1.1, true);
    wp_localize_script('_nr_custom_discount_code_adm_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
    ob_start();
    include_once plugin_dir_path(__FILE__) . 'inc/class-discount-code-list.php';
    $template = ob_get_contents();
    ob_end_clean();
    include ('views/admin/discount_code_manager.php');
}

add_action('wp_ajax_validate_discount_code', '_nr_lw_parking_validate_discount_code');

function get_table_list() {
    ob_start();

    include_once plugin_dir_path(__FILE__) . 'inc/owt-table-list.php';

    $template = ob_get_contents();

    ob_end_clean();

    return $template;
}

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

    if (empty($validate_code)) {
        if (!empty($discount_code)) {
            if (!empty($percentage)) {
                if (is_numeric($percentage)) {
                    $push_array = array(
                        "discount_code" => ($discount_code),
                        "percentage" => ($percentage),
                        "note" => ($note),
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

add_action('wp_ajax_update_discount_code', 'nr_lw_update_discount_code');

function nr_lw_update_discount_code() {
    $json = array();
    $msg = new Massage_class();
    $discount_code = (isset($_POST['discountCode']) ? $_POST['discountCode'] : '');
    $percentage = (isset($_POST['percentage']) ? $_POST['percentage'] : '');
    $note = (isset($_POST['note']) ? $_POST['note'] : '');
    $item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : '');
    $db_class = new Db_functions;
    $validate_code = $db_class->get_by("discount_codes", "discount_code", $discount_cord);

    if (empty($validate_code)) {
        if (!empty($discount_code)) {
            if (!empty($percentage)) {
                if (is_numeric($percentage)) {
                    $push_array = array(
                        "discount_code" => ($discount_code),
                        "percentage" => ($percentage),
                        "note" => ($note),
                        "active" => 1,
                    );
                    $update_codes = $db_class->update_items("discount_codes", "id", $item_id, $push_array);
                    if (!empty($update_codes)) {
                        $json["msg_type"] = "OK";
                        $json["msg"] = "Successfully Updated the Discount Code";
                        $json['return_array'] = $update_codes;
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

add_action('wp_ajax_disable_discount_code', 'nr_lw_disable_discount_code');

function nr_lw_disable_discount_code() {
    $json = array();
    $item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : '');
    if (!empty($item_id)) {
        $db_class = new Db_functions();
        $update_param = array(
            "active" => 0
        );
        $update_data = $db_class->update_items("discount_codes", "id", $item_id, $update_param);
        if (!empty($update_data)) {
            $json["msg_type"] = "OK";
            $json["msg"] = "Successfully Disabled the Dicount Code";
        } else {
            $json["msg_type"] = "ERR";
            $json["msg"] = "Something went wrong when processing your request.";
        }
    } else {
        $json["msg_type"] = "ERR";
        $json["msg"] = "Something went wrong when processing your request.";
    }
    echo json_encode($json);
    exit();
}

add_action('wp_ajax_enable_discount_code', 'nr_lw_enable_discount_code');

function nr_lw_enable_discount_code() {
    $json = array();
    $item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : '');
    if (!empty($item_id)) {
        $db_class = new Db_functions();
        $update_param = array(
            "active" => 1
        );
        $update_data = $db_class->update_items("discount_codes", "id", $item_id, $update_param);
        if (!empty($update_data)) {
            $json["msg_type"] = "OK";
            $json["msg"] = "Successfully Enabled the Dicount Code";
        } else {
            $json["msg_type"] = "ERR";
            $json["msg"] = "Something went wrong when processing your request.";
        }
    } else {
        $json["msg_type"] = "ERR";
        $json["msg"] = "Something went wrong when processing your request.";
    }
    echo json_encode($json);
    exit();
}

add_action('wp_ajax_delete_discount_code', 'nr_lw_delete_discount_code');

function nr_lw_delete_discount_code() {
    $json = array();
    $item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : '');
    if (!empty($item_id)) {
        $db_class = new Db_functions();

        $delete_item = $db_class->delete_item("discount_codes", "id", $item_id);
        if (!empty($delete_item)) {
            $json["msg_type"] = "OK";
            $json["msg"] = "Successfully Deleted the Dicount Code";
        } else {
            $json["msg_type"] = "ERR";
            $json["msg"] = "Something went wrong when processing your requests.";
        }
    } else {
        $json["msg_type"] = "ERR";
        $json["msg"] = "Something went wrong when processing your request.";
    }
    echo json_encode($json);
    exit();
}

add_action('wp_ajax_edit_discount_code', 'nr_lw_edit_discount_code');

function nr_lw_edit_discount_code() {
    $json = array();
    $item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : '');
    if (!empty($item_id)) {
        $db_class = new Db_functions();

        $get_value = $db_class->get_by("discount_codes", "id", $item_id, "");

        if (!empty($get_value)) {
            $json["msg_type"] = "OK";
            $json['return_value'] = $get_value;
        } else {
            $json["msg_type"] = "ERR";
            $json["msg"] = "Something went wrong when processing your requests.";
        }
    } else {
        $json["msg_type"] = "ERR";
        $json["msg"] = "Something went wrong when processing your request.";
    }
    echo json_encode($json);
    exit();
}

add_shortcode('code_add_item', "nr_lw_discount_add_view");

function nr_lw_discount_add_view($args) {
    wp_enqueue_script('_nr_customize_functions', plugins_url("assests/plugins/common/js/custom_functions.js", __FILE__), array('jquery'), 1.1, true);
    wp_enqueue_script('_nr_custom_discount_code_front_js', plugins_url("assests/js/front_discount_code.js", __FILE__), array('jquery'), 1.1, true);
    wp_localize_script('_nr_custom_discount_code_front_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
    $a = shortcode_atts(array(
        'price' => 0
            ), $args);


    include ('views/front/discount_code.php');
}

add_action('wp_ajax_nopriv_val_discount_code', 'nr_lw_val_discount_code');

function nr_lw_val_discount_code() {
    $json = array();
    $total_value = (isset($_POST['total']) ? trim($_POST['total']) : '');
    $discount_code = (isset($_POST['discount_code']) ? trim($_POST['discount_code']) : '');
    $symbol = (isset($_POST['symbol']) ? trim($_POST['symbol']) : '');

    if (!empty($discount_code)) {
        $db_class = new Db_functions();
        $get_discount_code = $db_class->get_by("discount_codes", "discount_code", $discount_code, "1");

        if (!empty($get_discount_code)) {
            $discount_percentage = $get_discount_code->percentage;
            $discount = ($total_value / 100) * $discount_percentage;
            $total_value_final = $total_value - $discount;
            
            $json["msg_type"] = "OK";
            $json["msg"] = "Discount Code Validated";
            $json['discount'] = $discount;
            $json['symbol'] = $symbol;
            $json['total_value_final'] = $total_value_final;
        } else {
            $json["msg_type"] = "ERR";
            $json["msg"] = "Discount Code Not Valid.";
        }
    } else {
        $json["msg_type"] = "ERR";
        $json["msg"] = "Something went wrong when processing your request.";
    }
    echo json_encode($json);
    exit();
}
