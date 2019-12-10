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

//    function validate_price
}
