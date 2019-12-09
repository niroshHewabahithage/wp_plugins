<?php

/*
  Plugin Name: Arrival Form
  Plugin URI: http://weblankan.com
  Description: Managing and Email Sending Plugin widget for the wordpress, Easy Customisable plugin
  Version: 1.0
  Author: Nirosh Randimal
  Author URI: www.linkedin.com/in/nirosh-randimal-331598146
  License: GPL2
 */

global $me_db_version;
global $folder;
global $site_url;
global $uri_segnemt;
global $limit;
global $table_name;
global $table_name_messages;
global $nr_custom_arrival_db_version;

$nr_custom_arrival_db_version = '1.0.0';

$folder = 'Regal';
$uri_segnemt = 5;
$limit = 5;
global $wpdb;
$table_name = $wpdb->prefix . "arrival_form_lw_custom_nr";
$table_name_messages = $wpdb->prefix . "arrival_form_lw_custom_nr_messages";

function _nr_create_required_email_tables_install_plgin() {

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    global $table_name;
    global $table_name_messages;
    global $nr_custom_arrival_db_version;
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
                    `id`  int(11) NOT NULL AUTO_INCREMENT ,
                `to_email`  varchar(255) NOT NULL ,
                `incomming_mailserver`  varchar(255) NOT NULL ,
                `outgoing_emailserver`  varchar(20) ,
                `incomming_port`  varchar(255) NULL ,
                `outgoing_port(SMTP)`  varchar(255) NULL ,
                `METHOD`  varchar(255) NOT NULL ,
                `username`  varchar(255) NOT NULL ,
                `password`  varchar(255) NOT NULL ,
                `created_on`  datetime NOT NULL ,
                `status`  int(2) ZEROFILL NOT NULL ,
                `other`  text NULL ,
                PRIMARY KEY (`id`)
	) $charset_collate;";

    $sql2 = "CREATE TABLE $table_name_messages (
                    `id`  int(11) NOT NULL AUTO_INCREMENT ,
                `msg_slug`  varchar(255) NOT NULL ,
                `message`  varchar(255) NOT NULL ,
                `message_type`  varchar(20) ,
                `created_on`  datetime NOT NULL ,
                `status`  int(2) ZEROFILL NOT NULL ,
                `other`  text NULL ,
                PRIMARY KEY (`id`)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
    dbDelta($sql2);

    add_option('nr_custom_arrival_db_version', $nr_custom_arrival_db_version);
}

register_activation_hook(__FILE__, '_nr_create_required_email_tables_install_plgin');
register_activation_hook(__FILE__, '_nr_arrival_form_email_activation_func');

function _nr_arrival_form_email_activation_func() {
    file_put_contents(__DIR__ . '/my_loggg.txt', ob_get_contents());
}

//function for shortcode

function nr_arval_form_custom_view() {
    wp_enqueue_style('_nr_custom_main', plugins_url('assets/css/style.css', __FILE__));
    wp_enqueue_style('_nr_custom_material', plugins_url('assets/css/bootstrap-material-datetimepicker.min.css', __FILE__));
    wp_enqueue_script('_nr_custom_notiflix_js', plugins_url("assets/Notiflix-1.2.0/Minified/notiflix-1.2.0.min.js", __FILE__), array('jquery'), 1.1, true);
    wp_enqueue_script('_nr_custom_trigger_js', plugins_url("assets/js/trigger_alert.js", __FILE__), array('jquery'), 1.1, true);
    wp_enqueue_style('_nr_custom_notiflix_css', plugins_url('assets/Notiflix-1.2.0/Minified/notiflix-1.2.0.min.css', __FILE__));
    wp_enqueue_script('_nr_custom_main_js', plugins_url("assets/js/main.js", __FILE__), array('jquery'), 1.1, true);
    wp_enqueue_script('_nr_custom_moment_js', plugins_url("assets/js/moment.min.js", __FILE__), array('jquery'), 1.1, true);
    wp_enqueue_script('_nr_custom_date-timepick_js', plugins_url("assets/js/bootstrap-material-datetimepicker.min.js", __FILE__), array('jquery'), 1.1, true);
    wp_enqueue_script('_nr_custom_ja_js', plugins_url("assets/js/ja.js", __FILE__), array('jquery'), 1.1, true);
    ob_start();
    include (__DIR__ . '/templates/arrival_form.php');
    return ob_get_clean();
}

//creating Short code for the view

add_shortcode('nr_arrival_form', 'nr_arval_form_custom_view');

add_action('admin_menu', 'extra_post_info_menu');

function extra_post_info_menu() {

    $page_title = 'Customizing the email configuration Details';
    $menu_title = 'Arrival Form';
    $capability = 'manage_options';
    $menu_slug = 'nr_custom_email_configuration';
    $function = 'load_email_configurations';
    $icon_url = 'dashicons-id-alt';
    $position = 78;

    $submenu_title = 'Display Messages';
    $menu_title_sub = 'Display Messages';
    $menu_slug_sub = 'nr_custom_display_massages';
    $sub_function = "load_function_display_massages";

    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
    add_submenu_page($menu_slug, $submenu_title, $menu_title_sub, $capability, $menu_slug_sub, $sub_function);
}

function load_email_configurations() {
    
}

function load_function_display_massages() {
    
}
