<?php
class Core_controller
{
    function __construct()
    {
    }


    public function _wl_dealer_order_install()
    {
        global $table_name;
        global $table_name2;
        global $wl_db_version;
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
                `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_code` varchar(45) DEFAULT NULL,
  `item_price` varchar(45) DEFAULT NULL,
  `item_colors` text,
  `item_color_sizes` text,
  `active` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_by` int(11) DEFAULT NULL,
  `edited_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remark` text
   PRIMARY KEY (`id`)
	) CHARSET=utf8;CREATE TABLE $table_name2 (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color_name` varchar(45) DEFAULT NULL,
  `color_slug` varchar(45) DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_by` int(11) DEFAULT NULL,
  `edited_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remark` text
  PRIMARY KEY (`id`)
    ) CHARSET=utf8;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        //    dbDelta($sql2);
        add_option('wl_db_version', $wl_db_version);
    }

    public function am_enqueue_admin_styles()
    {
        //boostrap
        wp_register_style('am_admin_bootstrap', plugins_url('../assests/plugins/bootstrap/css/bootstrap.min.css', __FILE__));
        wp_enqueue_style('_nr_boostrap _select_picker', plugins_url('../assests/plugins/select_picker/css/bootstrap-select.min.css', __FILE__));
        wp_enqueue_style('am_admin_bootstrap');
        wp_enqueue_style('_nr_custom_niroroo', plugins_url('../assests/plugins/common/css/style.css', __FILE__));
        wp_enqueue_style('_nr_select2', plugins_url('../assests/plugins/select2/select2.min.css', __FILE__));
        wp_enqueue_style('_nr_custom_main', plugins_url('../assests/css/main_style.css', __FILE__));
        //
        //alerts
        wp_enqueue_style('_nr_custom_alerts', plugins_url('../assests/plugins/alerts/Notiflix-1.2.0/Minified/notiflix-1.2.0.min.css', __FILE__));
        wp_enqueue_script('_nr_customize_functions', plugins_url("../assests/plugins/common/js/custom_functions.js", __FILE__), array('jquery'), 1.1, true);
        wp_enqueue_style('_nr_custom_sweet_alerts', plugins_url('../assests/plugins/sweetalert/css/sweetalert2.min.css', __FILE__));
        wp_enqueue_script('_nr_custom_trigger_alerts', plugins_url("../assests/plugins/alerts/trigger/trigger_alert.js", __FILE__), array('jquery'), 1.1, true);
        wp_enqueue_script('_nr_custom_sweet_js', plugins_url("../assests/plugins/sweetalert/js/sweetalert2.all.min.js", __FILE__), array('jquery'), 1.1, true);
        wp_enqueue_script('_nr_custom_sweet_min_js', plugins_url("../assests/plugins/sweetalert/js/sweetalert2.min.js", __FILE__), array('jquery'), 1.1, true);
        wp_enqueue_script('_nr_select2_min_js', plugins_url("../assests/plugins/select2/select2.min.js", __FILE__), array('jquery'), 1.1, true);
        wp_enqueue_script('_nr_custom_alerts_js', plugins_url("../assests/plugins/alerts/Notiflix-1.2.0/Minified/notiflix-1.2.0.min.js", __FILE__), array('jquery'), 1.1, true);
        wp_enqueue_script('_nr_select_picker_js', plugins_url("../assests/plugins/select_picker/js/bootstrap-select.min.js", __FILE__), array('jquery'), 1.1, true);
    }

    function _wl_dealer_order_admin_menu()
    {
        global $load_view;
        add_menu_page('Item Management', 'Item Management', 'manage_options', "item-manager-module", array($load_view, 'wl_dealer_items'), plugins_url('../icons/sport.png', __FILE__));
    }

    function validate_phone_number($phone = '', $custom_text = '', $min = '', $max = '')
    {
        global $msg;
        $cond = false;
        $msg_param = "";
        $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        $phone_to_check = str_replace("+", "", $filtered_phone_number);
        if (is_numeric($phone_to_check)) {
            if (strlen($phone_to_check) < $min || strlen($phone_to_check) > $max) {
                $msg_param = $msg->validation_errors("valid_item", "Phone Number", "Please Check the Phone Number that You Entered, becuase its doen't match to the default Lenth, $min - $max Numbers");
            } else {
                $cond = true;
            }
        } else {
            $msg_param = $msg->validation_errors("numeric", "Phone Number");
        }
        $push_data = array(
            "condt" => $cond,
            "msg_param" => $msg_param
        );

        return $push_data;
    }
}
