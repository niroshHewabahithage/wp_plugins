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

    function nr_nl_save_service() {
        $json = array();
        $msg = new Massage_class();
        $service_name_sin = (isset($_POST['serviceNameSin']) ? $_POST['serviceNameSin'] : '');
        $service_name_en = (isset($_POST['serviceNameEn']) ? $_POST['serviceNameEn'] : '');
        $service_price = (isset($_POST['servicePrice']) ? $_POST['servicePrice'] : '');

        if (!empty($service_name_sin)) {
            if (!empty($service_name_en)) {
                if (!empty($service_price)) {
                    if (is_numeric($service_price)) {
                        $add_params = array(
                            "service_name_si" => ($service_name_sin),
                            "service_name_en" => ($service_name_en),
                            "service_price" => ($service_price),
                            "active" => 1
                        );

                        $db_c = new Db_functions();
                        $save_service = $db_c->insert_data('services', $add_params);
                        if (!empty($save_service)) {
                            $json["msg_type"] = "OK";
                            $json["msg"] = "Successfully Saved the Service";
                        } else {
                            $json["msg_type"] = "ERR";
                            $json["msg"] = "Something went wrong when processing your request.";
                        }
                    } else {
                        $json["msg_type"] = "ERR";
                        $json["msg"] = $msg->validation_errors("numeric", "Service Price");
                    }
                } else {
                    $json["msg_type"] = "ERR";
                    $json["msg"] = $msg->validation_errors("required", "Service Price");
                }
            } else {
                $json["msg_type"] = "ERR";
                $json["msg"] = $msg->validation_errors("required", "Service Name English");
            }
        } else {
            $json["msg_type"] = "ERR";
            $json["msg"] = $msg->validation_errors("required", "Service Name Sinhala");
        }
        echo json_encode($json);
        exit();
    }

    function nr_nl_get_edit_details() {
        $json = array();
        $item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : '');
        $db_c = new Db_functions();
        $get_service_single = $db_c->get_by("services", "id", $item_id);
        if (!empty($get_service_single)) {
            $json["msg_type"] = "OK";
            $json["return_array"] = $get_service_single;
        } else {
            $json["msg_type"] = "ERR";
            $json["msg"] = "Something went wrong when processing your request.";
        }
        echo json_encode($json);
        exit();
    }

    function nr_nl_update_services() {
        $json = array();
        $msg = new Massage_class();
        $item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : '');
        $service_name_sin = (isset($_POST['serviceNameSin']) ? $_POST['serviceNameSin'] : '');
        $service_name_en = (isset($_POST['serviceNameEn']) ? $_POST['serviceNameEn'] : '');
        $service_price = (isset($_POST['servicePrice']) ? $_POST['servicePrice'] : '');
        $db_c = new Db_functions();
        if (!empty($item_id)) {
            if (!empty($service_name_sin)) {
//                $validate_service_item = $this->validate_with_database();
                if (!empty($service_name_en)) {
                    if (!empty($service_price)) {
                        if (is_numeric($service_price)) {
                            $add_params = array(
                                "service_name_si" => ($service_name_sin),
                                "service_name_en" => ($service_name_en),
                                "service_price" => ($service_price),
                                "active" => 1
                            );

                            $db_c = new Db_functions();
                            $update_service = $db_c->update_items('services', "id", $item_id, $add_params);
                            if (!empty($update_service)) {
                                $json["msg_type"] = "OK";
                                $json["msg"] = "Successfully Updated the Service";
                            } else {
                                $json["msg_type"] = "ERR";
                                $json["msg"] = "Something went wrong when processing your request.";
                            }
                        } else {
                            $json["msg_type"] = "ERR";
                            $json["msg"] = $msg->validation_errors("numeric", "Service Price");
                        }
                    } else {
                        $json["msg_type"] = "ERR";
                        $json["msg"] = $msg->validation_errors("required", "Service Price");
                    }
                } else {
                    $json["msg_type"] = "ERR";
                    $json["msg"] = $msg->validation_errors("required", "Service Name English");
                }
            } else {
                $json["msg_type"] = "ERR";
                $json["msg"] = $msg->validation_errors("required", "Service Name Sinhala");
            }
        } else {
            $json["msg_type"] = "ERR";
            $json["msg"] = $msg->validation_errors("required", "Service Name Sinhala");
        }

        echo json_encode($json);
        exit();
    }

    function nr_nl_delete_service() {
        $json = array();
        $item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : '');
        if (!empty($item_id)) {
            $db_class = new Db_functions();

            $delete_item = $db_class->delete_item("services", "id", $item_id);
            if (!empty($delete_item)) {
                $json["msg_type"] = "OK";
                $json["msg"] = "Successfully Deleted the Service";
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

}
