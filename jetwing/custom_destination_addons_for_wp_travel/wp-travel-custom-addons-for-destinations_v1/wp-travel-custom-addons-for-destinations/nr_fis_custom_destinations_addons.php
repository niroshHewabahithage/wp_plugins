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
global $table_name;
global $fis_db_version;
$fis_db_version = '1.0.0';
global $wpdb;
$table_name = $wpdb->prefix . "destination_adons";

register_activation_hook(__FILE__, 'child_plugin_activate');
register_activation_hook(__FILE__, '_nr_fis_destination_install');
include plugin_dir_path(__FILE__) . 'inc/Upload_view.php';
include plugin_dir_path(__FILE__) . 'inc/Db_functions.php';

function child_plugin_activate() {

    // Require parent plugin
    if (!is_plugin_active('wp-travel/wp-travel.php') and current_user_can('activate_plugins')) {
        // Stop activation redirect and show error
        wp_die('Sorry, but this plugin requires the Parent Plugin to be installed and active. <br><a href="' . admin_url('plugins.php') . '">&laquo; Return to Plugins</a>');
    }
}

function _nr_fis_destination_install() {
    global $table_name;
    global $fis_db_version;
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
                `id`  int(11) NOT NULL AUTO_INCREMENT ,
                `destination`  varchar(255) NOT NULL ,
                `destination_slug`  varchar(255) NOT NULL ,
                `custom_addons`  LONGTEXT ,
                `active`  int(2) ZEROFILL NOT NULL ,
                `other`  TEXT NULL ,
                PRIMARY KEY (`id`)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
    add_option('fis_db_version', $fis_db_version);
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

add_action("wp_ajax_fetch_custom_items", "nr_fis_fetch_custom_data");

function nr_fis_fetch_custom_data() {
    $json = array();
    $destination = (isset($_POST['destination']) ? $_POST['destination'] : '');
    $destination_slug = (isset($_POST['destination_slug']) ? $_POST['destination_slug'] : '');

//    (
//    [tgLine] => Nirosh randisml
//    [description] => nirosh randimal
//    [sMediaTags] => hello nirosh
//    [key_map_left] => 333
//    [key_map_right] => 90
//    [multi_uploader] => Array
//        (
//            [0] => 73
//            [1] => 97
//            [2] => 162
//            [3] => 159
//        )
//
//)
    $db_class = new Db_functions;
    $return_item = "";
    $image_url = "";
    $upload_btn = new Upload_view;
    $get_the_items_for = $db_class->select_addon_by_slug($destination_slug);
    if (!empty($get_the_items_for)) {
        $searched_array = unserialize($get_the_items_for->custom_addons);

        if (!empty($searched_array['multi_uploader'])) {
            for ($i = 0; count($searched_array['multi_uploader']) > $i; $i++) {
                $image_url = wp_get_attachment_url($searched_array['multi_uploader'][$i]);
                $image_id = $searched_array['multi_uploader'][$i];
                $return_item .= "<div class='col-sm-3'>";
                $return_item .= $upload_btn->nr_fixel_it_wprss_uploader_multi("multi_uploader", '100', 'auto', $image_url, $image_id);
                $return_item .= "</div>";
            }
        } else {
            
        }

        $json["msg_type"] = "OK";
        $json['item_id_desti'] = $get_the_items_for->id;
        $json['tgLine'] = $searched_array['tgLine'];
        $json['description'] = $searched_array['description'];
        $json['sMediaTags'] = $searched_array['sMediaTags'];
        $json['key_map_left'] = wp_get_attachment_url($searched_array['key_map_left']);
        $json['key_map_left_id'] = $searched_array['key_map_left'];
        $json['key_map_right'] = wp_get_attachment_url($searched_array['key_map_right']);
        $json['key_map_right_id'] = $searched_array['key_map_right'];
        $json['return_item'] = $return_item;
    } else {
        $json["msg_type"] = "ERR";
    }
    echo json_encode($json);
    exit();
}

add_action('wp_ajax_save_items', "nr_fis_save_destination_values");

function nr_fis_save_destination_values() {
    $json = array();
    $valuesArray = (isset($_POST) ? $_POST : '');

    $tgLine = $valuesArray['RssFeedIcon_settings']['tgLine'];
    $db_class = new Db_functions;
    if (isset($tgLine) && $tgLine != "") {
        //$sMediaTags = explode(",", $valuesArray['RssFeedIcon_settings']['sMediaTags']);
        $push_array = array(
            "destination" => ($valuesArray['destinationName']),
            "destination_slug" => ($valuesArray['destinationSlug']),
            "custom_addons" => serialize($valuesArray['RssFeedIcon_settings']),
            "active" => 1
        );
        $save_cutome_feilds = $db_class->insert_destination_addon_values($push_array);
        if (!empty($save_cutome_feilds)) {
            $json["msg_type"] = "OK";
            $json["msg"] = "Successfully Created Destination Addons";
        } else {
            $json["msg_type"] = "ERR";
            $json["msg"] = "Something went wrong when processing your request.";
        }
    } else {
        $json['msg_type'] = "ERR";
        $json['msg'] = "Tag Line is Compulsory";
    }
    echo json_encode($json);
    exit();
}

add_action('wp_ajax_update_items', "nr_fis_update_destination_values");

function nr_fis_update_destination_values() {
    $json = array();
    $valuesArray = (isset($_POST) ? $_POST : '');
    $tgLine = $valuesArray['RssFeedIcon_settings']['tgLine'];
    $db_class = new Db_functions;
    if (isset($tgLine) && $tgLine != "") {
        $item_id = $valuesArray['item_update_link'];
        $delete_current_item = $db_class->delete_current_item($item_id);
        if (!empty($delete_current_item)) {
            $push_array = array(
                "destination" => ($valuesArray['destinationName']),
                "destination_slug" => ($valuesArray['destinationSlug']),
                "custom_addons" => serialize($valuesArray['RssFeedIcon_settings']),
                "active" => 1
            );
            $save_cutome_feilds = $db_class->insert_destination_addon_values($push_array);
            if (!empty($save_cutome_feilds)) {
                $json["msg_type"] = "OK";
                $json["msg"] = "Successfully Updated Destination Addons";
            } else {
                $json["msg_type"] = "ERR";
                $json["msg"] = "Something went wrong when processing your request.";
            }
        } else {
            $json["msg_type"] = "ERR";
            $json["msg"] = "Something went wrong when processing your request.";
        }
    } else {
        $json['msg_type'] = "ERR";
        $json['msg'] = "Tag Line is Compulsory";
    }
    echo json_encode($json);
    exit();
}

add_shortcode('nr_fis_destination_adon', 'nr_fis_desti_adoon');

function nr_fis_desti_adoon() {
    global $wp;
    $url = home_url($wp->request);
    $parsed = parse_url($url);
    $path = $parsed['path'];
    $path_parts = explode('/', $path);
    $desired_output = $path_parts[3];
    if (!empty($desired_output)) {
        $db_class = new Db_functions;
        $get_the_items_for = $db_class->select_addon_by_slug($desired_output);
        $searched_array = unserialize($get_the_items_for->custom_addons);
//        echo '<pre>';
//        print_r($searched_array);
//        echo '</pre>';
        $sMediaTags = explode(",", $searched_array['sMediaTags']);

//        echo '<pre>';
//        print_r($sMediaTags);
//        echo '</pre>';
    } else {
        
    }

    ob_start();
    include (plugin_dir_path(__FILE__) . 'templates/front/print_array.php');
    return ob_get_clean();
}
