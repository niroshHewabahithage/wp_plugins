<?php

class Massage_class extends My_controller {

    public function __construct() {
        
    }

    public function validation_errors($errr_param, $item_name, $custom_message = '') {
        $massage = "";

        if (empty($custom_message)) {
            if ($errr_param == "required") {
                $massage = "$item_name cannot be Empty";
            } else if ($errr_param == "valid_item") {
                $massage = "Please Enter Valid $item_name";
            } else if ($errr_param == "duplicate") {
                $massage = "You have a package just like this $item_name, we think its deplicated, please try it again";
            } else if ($errr_param == "numeric") {
                $massage = "Sorry $item_name only allow for numeric charcters";
            } else if ($errr_param == "match") {
                $massage = "The primary email " . $item_name['email_pri'] . " is doesn't match to the confirmed email " . $item_name['email_confirm'] . "";
            } else if ($errr_param == "match_param") {
                $massage = "Its Look Like the item which you are trying to add is already available in the database, pleae try another";
            }
        } else {
            $massage = $custom_message;
        }
        return $massage;
    }

}
