<?php

class Core_controller {

    public function __construct() {
        
    }

    function validate_email($email_custom = '', $custom_text = '') {
//        echo $email_custom;
        $cond = false;
        if (filter_var($email_custom, FILTER_VALIDATE_EMAIL)) {
            $cond = true;
        }
        $msg = new Massage_class();
        $push_data = array(
            "condt" => $cond,
            "msg_param" => (($cond == false) ? $msg->validation_errors("valid_item", "Email Address", (!empty($custom_text) ? $custom_text : "Please Check the Email Address Correctly")) : '')
        );
        return $push_data;
    }

    function match_emails($email_pri, $email_confirm) {
        $cond = false;
        if ($email_pri == $email_confirm) {
            $cond = true;
        }
        $emailArray = array(
            "email_pri" => $email_pri,
            "email_confirm" => $email_confirm,
        );
        $push_data = array(
            "condt" => $cond,
            "msg_param" => (($cond == false) ? $this->validation_errors("match", $emailArray, (!empty($custom_text) ? $custom_text : "")) : '')
        );
        return $push_data;
    }

    function validate_phone_number($phone = '', $custom_text = '') {
        $cond = false;
        $msg_param = "";
        $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
        $phone_to_check = str_replace("+", "", $filtered_phone_number);
        $msg = new Massage_class();
        if (is_numeric($phone_to_check)) {
            if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
                $msg_param = $msg->validation_errors("valid_item", "Phone Number", "Please Check the Phone Number that You Entered, becuase its doen't match to the default Lenth, 10 - 14 Numbers");
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

    function validate_with_database() {
        
    }

    function _nr_fis_destination_install() {
        global $table_name;
        global $table_name2;
        global $fis_db_version;
        global $wpdb;

        $charset_collate = $wpdb->get_charset_collate();
        $sql = "CREATE TABLE $table_name (
                `id`  int(11) NOT NULL AUTO_INCREMENT ,
                `service_name_si`  TEXT ,
                `service_name_en`  TEXT ,
                `service_price`  TEXT ,
                `active`  int(2) ZEROFILL NOT NULL ,
                `created_by`  int(11) NULL ,
                `created_date`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                `edited_by`  int(11) NULL,
                `edited_date`  TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                `remark`  TEXT NULL ,
                PRIMARY KEY (`id`)
	) $charset_collate;CREATE TABLE $table_name2 (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `is_user` INT(11) NULL DEFAULT NULL,
  `id_service` INT(11) NULL DEFAULT NULL,
  `active` INT(11) NULL DEFAULT NULL,
  `created_by` INT(11) NULL DEFAULT NULL,
  `created_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_by` INT(11) NULL DEFAULT NULL,
  `edited_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `remark` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
	) $charset_collate;";
        $sql2 = "";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
//    dbDelta($sql2);
        add_option('fis_db_version', $fis_db_version);
    }

//    function validate_price
}
