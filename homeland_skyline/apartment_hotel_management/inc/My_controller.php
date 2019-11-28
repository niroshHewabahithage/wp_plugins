<?php

/**
 * Description of My_controller
 *
 * @author DP5
 * Nov 27, 2019 5:04:14 PM
 */
class My_controller extends Core_controller {

    public function __construct() {
        
    }

    function get_print() {
        return $this->print_all();
    }

    function nr_lw_save_attribute() {
        $json = array();
        $msg = new Massage_class();
        $attribute_name = (isset($_POST['attribute_name']) ? $_POST['attribute_name'] : '');
        $attribute_slug = (isset($_POST['attribute_slug']) ? $_POST['attribute_slug'] : '');
        $content_type = (isset($_POST['content-type']) ? $_POST['content-type'] : '');
        if (!empty($attribute_name)) {
            $json["msg_type"] = "OK";
            $json["msg"] = "msg";
        } else {
            $json["msg_type"] = "ERR";
            $json["msg"] = $msg->validation_errors("required", "Attribute Name");
        }
        echo json_encode($json);
        exit();
    }

}
