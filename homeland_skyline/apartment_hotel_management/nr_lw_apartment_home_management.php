<?php

/*
  Plugin Name: Apartments & Homes Management
  Plugin URI: https://www.weblankan.com
  Description: Managing all the Apartments and homes which are managed by the HOMELAND SKYLINE (pvt) LTD
  Version: 1.0
  Author: niroroo619- Nirosh Randimal
  Author URI: www.linkedin.com/in/nirosh-randimal-331598146
  License: GPL2
 */

include plugin_dir_path(__FILE__) . 'inc/Core_controller.php';
include plugin_dir_path(__FILE__) . 'inc/My_controller.php';
include plugin_dir_path(__FILE__) . 'inc/View_controller.php';

function nr_lw_discount_admin_menu() {
    $load_view = new View_controller();

    //##############################################################################################################################
    //add main menu for apartment and home attributes
    add_menu_page('Custom Attributes', 'Custom Attributes', 'manage_options', "custom-attributes", array($load_view, 'nr_lw_attributes_list'), plugins_url('apartment_hotel_management/icons/sort-descending.png', __DIR__));
    //attributes Sub Manu
    add_submenu_page("custom-attributes", 'Custom Sub Attributes', "Custom Sub Attributes", 'manage_options', 'custom-sub-attributes', array($load_view, 'nr_lw_sub_attributes_list'));

    //##############################################################################################################################
    //    add main Menu Apartment
    add_menu_page('Apartments', 'Apartments', 'manage_options', "properties-management", array($load_view, 'nr_lw_apartment_list'), plugins_url('apartment_hotel_management/icons/apartment_16.png', __DIR__));
    //add submenu apartments
    add_submenu_page("properties-management", 'Discount Purchases', "Discount Purchases", 'manage_options', 'discount-purchases', 'nr_lw_discount_purchases');

    //###########################################################################################################################
    //add Homes Main Menu
    add_menu_page('Homes', 'Homes', 'manage_options', "homes-management", array($load_view, 'nr_lw_home_list'), plugins_url('apartment_hotel_management/icons/home_16.png', __DIR__));
}

add_action('admin_menu', 'nr_lw_discount_admin_menu');


