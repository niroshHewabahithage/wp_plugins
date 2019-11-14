<?php

class Massage_class {

    public function __construct() {
        
    }

    function validation_errors($errr_param, $item_name, $custom_message) {
        $massage = "";
        if (empty($custom_message)) {
            if ($errr_param == "required") {
                $massage = "$item_name cannot be Empty";
            } else if ($errr_param == "valid_email") {
                $massage = "Please Enter Valid $item_name";
            } else if ($errr_param == "duplicate") {
                $massage = "You have a package just like this $item_name, we think its deplicated, please try it again";
            }else if($errr_param=="numeric"){
                $massage = "Sorry $item_name only allow for numeric charcters";
            }
        } else {
            $massage = $custom_message;
        }
        return $massage;
    }

}
