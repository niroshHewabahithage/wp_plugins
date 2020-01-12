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
        $service_multiple = (isset($_POST['serviceMultiple']) ? '1' : '0');

        if (!empty($service_name_sin)) {
            if (!empty($service_name_en)) {
                if (!empty($service_price)) {
                    if (is_numeric($service_price)) {
                        $add_params = array(
                            "service_name_si" => ($service_name_sin),
                            "service_name_en" => ($service_name_en),
                            "service_price" => ($service_price),
                            "is_multiple" => ($service_multiple),
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
        $service_multiple = (isset($_POST['serviceMultiple']) ? '1' : '0');
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
                                "is_multiple" => ($service_multiple),
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

    function nr_nl_save_astrologist() {
        $json = array();

        $service_array = (isset($_POST['users']) ? $_POST['users'] : '');
        $first_name_sinhala = (isset($_POST['firstNameSin']) ? $_POST['firstNameSin'] : '');
        $last_name_sinhala = (isset($_POST['lateNameSin']) ? $_POST['lateNameSin'] : '');
        $firstNameEn = (isset($_POST['firstNameEn']) ? $_POST['firstNameEn'] : '');
        $lateNameEn = (isset($_POST['lateNameEn']) ? $_POST['lateNameEn'] : '');
        $email = (isset($_POST['email']) ? $_POST['email'] : '');
        $phonenumber = (isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '');
        $username = (isset($_POST['username']) ? $_POST['username'] : '');
        $password = (isset($_POST['password']) ? $_POST['password'] : '');
        $key_map_image = (isset($_POST['key_map_left']) ? $_POST['key_map_left'] : '');

        $msg = new Massage_class();
        if (!empty($service_array)) {
            if (!empty($first_name_sinhala)) {
                if (!empty($firstNameEn)) {
                    if (!empty($last_name_sinhala)) {
                        if (!empty($lateNameEn)) {
                            if (!empty($email)) {
                                $validate_email = $this->validate_email($email);
                                if ($validate_email['condt'] != '') {
                                    if (!empty($phonenumber)) {
                                        $validatePhone = $this->validate_phone_number($phonenumber);
                                        if ($validatePhone['condt'] != "") {
                                            if (!empty($username)) {
                                                if (!empty($password)) {
                                                    $user_id = wp_create_user($username, $password, $email);
                                                    if (!is_wp_error($user_id)) {
                                                        $first_name = ($first_name_sinhala . " " . $last_name_sinhala);
                                                        $last_name = ($firstNameEn . " " . $lateNameEn);
                                                        update_user_meta($user_id, "first_name", $first_name);
                                                        update_user_meta($user_id, "last_name", $last_name);
                                                        update_usermeta($user_id, 'phone', $phonenumber);
                                                        update_usermeta($user_id, 'image', $key_map_image);
                                                        update_usermeta($user_id, 'trigeer_key', "new_user123");
                                                        $db_c = new Db_functions();
                                                        foreach ($service_array as $sa) {
                                                            $insert_param = array(
                                                                "is_user" => ($user_id),
                                                                "id_service" => $sa,
                                                                "active" => 1
                                                            );

                                                            $db_c->insert_data("service_map", $insert_param);
                                                        }
                                                        $json['msg_type'] = "OK";
                                                        $json['msg'] = "Succssfully Saved New User";
                                                    } else {
                                                        $json["msg_type"] = "ERR";
                                                        $json["msg"] = $user_id->get_error_message();
                                                        //add into custom table
//                                                        echo $user_id;
//                                                        update_user_meta($user_id, "first_name", 'Nirosh');s
                                                    }
                                                } else {
                                                    $json["msg_type"] = "ERR";
                                                    $json["msg"] = $msg->validation_errors("required", 'Password');
                                                }
                                            } else {
                                                $json["msg_type"] = "ERR";
                                                $json["msg"] = $msg->validation_errors("required", 'User Name');
                                            }
                                        } else {
                                            $json["msg_type"] = "ERR";
                                            $json["msg"] = $validatePhone['msg_param'];
                                        }
                                    } else {
                                        $json["msg_type"] = "ERR";
                                        $json["msg"] = $msg->validation_errors("required", 'Phone Number');
                                    }
                                } else {
                                    $json["msg_type"] = "ERR";
                                    $json["msg"] = $validate_email['msg_param'];
                                }
                            } else {
                                $json["msg_type"] = "ERR";
                                $json["msg"] = $msg->validation_errors("required", 'Email Address');
                            }
                        } else {
                            $json["msg_type"] = "ERR";
                            $json["msg"] = $msg->validation_errors("required", 'Last Name in English');
                        }
                    } else {
                        $json["msg_type"] = "ERR";
                        $json["msg"] = $msg->validation_errors("required", 'Last Name in Sinhala');
                    }
                } else {
                    $json["msg_type"] = "ERR";
                    $json["msg"] = $msg->validation_errors("required", 'First Name in English');
                }
            } else {
                $json["msg_type"] = "ERR";
                $json["msg"] = $msg->validation_errors("required", 'First Name in Sinhala');
            }
        } else {
            $json["msg_type"] = "ERR";
            $json["msg"] = $msg->validation_errors("required", 'Service', "You have to select one or more services in order to save this Astrologiest");
        }
        echo json_encode($json);
        exit();
    }

    function send_welcome_email_to_new_user($user_id) {
        $user = get_userdata($user_id);
        $user_email = $user->user_email;
        // for simplicity, lets assume that user has typed their first and last name when they sign up
        $user_full_name = $user->user_firstname . $user->user_lastname;

        // Now we are ready to build our welcome email
        $to = $user_email;
        $subject = "Hi " . $user_full_name . ", welcome to our site!";
        $body = '
              <h1>Dear ' . $user_full_name . ',</h1></br>
              <p>Thank you for joining our site. Your account is now active.</p>
              <p>Please go ahead and navigate around your account.</p>
              <p>Let me know if you have further questions, I am here to help.</p>
              <p>Enjoy the rest of your day!</p>
              <p>Kind Regards,</p>
              <p>poanchen</p>
    ';
        $headers = array('Content-Type: text/html; charset=UTF-8');
        if (wp_mail($to, $subject, $body, $headers)) {
            error_log("email has been successfully sent to user whose email is " . $user_email);
        } else {
            error_log("email failed to sent to user whose email is " . $user_email);
        }
    }

    function my_save_extra_profile_fields($user_id) {

        if (!current_user_can('edit_user', $user_id))
            return false;
        $service_array = (isset($_POST['users']) ? $_POST['users'] : '');
        update_usermeta($user_id, 'phone', $_POST['phone']);
        update_usermeta($user_id, 'image', $_POST['key_map_left']);

        $db_c = new Db_functions();
        $delete_services = $db_c->delete_item("service_map", "is_user", $user_id);
        if (!empty($delete_services)) {
            foreach ($service_array as $sa) {
                $insert_param = array(
                    "is_user" => ($user_id),
                    "id_service" => $sa,
                    "active" => 1
                );

                $db_c->insert_data("service_map", $insert_param);
            }
        } else {
            foreach ($service_array as $sa) {
                $insert_param = array(
                    "is_user" => ($user_id),
                    "id_service" => $sa,
                    "active" => 1
                );

                $db_c->insert_data("service_map", $insert_param);
            }
        }
    }

    //front end Funtions 
    function nr_nl_get_astrologist() {
        $json = array();
        $id_service = (isset($_POST['item_id']) ? $_POST['item_id'] : '');
        if (!empty($id_service)) {
            $db_c = new Db_functions();
            $get_atrology_primary = $db_c->get_astrologist_for_service($id_service);
            $get_sub_service = $db_c->get_sub_services($id_service);
//            echo '<pre>';
//            print_r($get_sub_service);
//            echo '</pre>';
            $sub_services = "";
            if (!empty($get_sub_service)) {
                foreach ($get_sub_service as $gss) {
                    $sub_service_sinhala = (isset($gss->sub_service_sinhala) ? $gss->sub_service_sinhala : '');
                    $sub_service_english = (isset($gss->sub_service_english) ? $gss->sub_service_english : '');
                    $item_id = (isset($gss->id) ? $gss->id : '');
                    $image_path = plugins_url('/icons/keyboard-right-arrow-button.png', __DIR__);
                    $sub_services .= <<<MSG
                            <tr>
                                        <td><img src="$image_path"width="28%" ></td>
                                        <td><p>$sub_service_sinhala | $sub_service_english</p></td>
                                        <td class="pricetd"></p>
                                            <div class="form-check">
                                                <input type="checkbox" value='$item_id'   class="form-check-input checkSub_Service" name="service[1][]"  id="materialUnchecked_$item_id">
                                                <label class="form-check-label" for="materialUnchecked_$item_id"></label>
                                            </div>

                                        </td>
                                    </tr>
MSG;
                }
            } else {
                $sub_services = "";
            }
            $div = "";

            if (!empty($get_atrology_primary)) {
                foreach ($get_atrology_primary as $users) {
                    $first_name = $db_c->get_meta_values($users->ID, "usermeta", "first_name");
                    $last_name = $db_c->get_meta_values($users->ID, "usermeta", "last_name");
                    $phone = $db_c->get_meta_values($users->ID, "usermeta", "phone");
                    $user_src = $db_c->get_meta_values($users->ID, "usermeta", "image");
                    $price_item = (isset($users->service_price) ? $users->service_price : '');
                    $post_array[] = array(
                        "id" => $users->ID,
                        "astrologer_name_sinhala" => $first_name->meta_value,
                        "astrologer_name_english" => $last_name->meta_value,
                        "astrologer_phone" => $phone->meta_value,
                        "astology_image" => $user_src->meta_value,
                        "price_item" => $price_item,
                        "active" => 1,
                    );
                }

                if (!empty($post_array)) {
                    foreach ($post_array as $ps) {
                        $name_in_sinhala = (isset($ps['astrologer_name_sinhala']) ? $ps['astrologer_name_sinhala'] : '');
                        $name_in_english = (isset($ps['astrologer_name_english']) ? $ps['astrologer_name_english'] : '');
                        $image_array = wp_get_attachment_image_src((isset($ps['astology_image']) ? $ps['astology_image'] : ''), $default);
                        $image_path = (!empty($image_array[0]) ? $image_array[0] : '');
                        $user_id = (isset($ps['id']) ? $ps['id'] : '');
                        $price_value = (isset($ps['price_item']) ? $ps['price_item'] : '');

                        $div .= <<<MSG
                        <div class="col-lg-4">
                        <div class="astrolger_div">
                            <div class="form-check" style="position:absolute">
                                <input type="checkbox" value='$user_id' class="form-check-input checkUser" data-value='$price_value'  name="users[1][]"  id="materialUncheckedU_$user_id">
                                <label class="form-check-label" for="materialUncheckedU_$user_id"></label>
                            </div>
                            <img src="$image_path">
                            <h5 class='text-center'>$name_in_sinhala</h5>
                            <h5 class='text-center'>$name_in_english</h5>
                            <div>
                            </div>
                        </div>
                    </div>
MSG;
                    }
                }
                $json['msg_type'] = "OK";
                $json['return_div'] = $div;
                $json['sub_services'] = $sub_services;
            }
        } else {
            $json['msg_type'] = "ERR";
            $json['msg'] = "Something went wrong please try again later";
        }
        echo json_encode($json);
        exit();
    }

    function nr_nl_save_sub_services() {
        $json = array();
        $msg = new Massage_class();
        $selected_service = (isset($_POST['service_select']) ? $_POST['service_select'] : '');
        $sub_service_english = (isset($_POST['sub-service-english']) ? $_POST['sub-service-english'] : '');
        $sub_service_sinhala = (isset($_POST['sub-service-sinhala']) ? $_POST['sub-service-sinhala'] : '');

        //validations
        if ($selected_service != "") {
            if ($sub_service_english != "") {
                if ($sub_service_sinhala != "") {
                    $db_c = new Db_functions();
                    $insert_param = array(
                        "service_id" => $selected_service,
                        "sub_service_sinhala" => $sub_service_sinhala,
                        "sub_service_english" => $sub_service_english,
                        "active" => 1
                    );

                    $save_sub_service = $db_c->insert_data("sub_services", $insert_param);

                    if (!empty($save_sub_service)) {
                        $json['msg_type'] = "OK";
                        $json['msg'] = "Successfully Created New Sub Category";
                    } else {
                        $json['msg_type'] = "ERR";
                        $json['msg'] = "Sorry Something Went Wrong with your request";
                    }
                } else {
                    $json['msg_type'] = "ERR";
                    $json['msg'] = $msg->validation_errors("required", "Sub Service Name in Sinhala");
                }
            } else {
                $json['msg_type'] = "ERR";
                $json['msg'] = $msg->validation_errors("required", "Sub Service Name in English");
            }
        } else {
            $json['msg_type'] = "ERR";
            $json["msg"] = $msg->validation_errors("required", 'Desired Service', "You Should Select a Service to add a Sub Service");
        }
        echo json_encode($json);
        exit();
    }

    public function nr_nl_get_service_astrologer() {
        $json = array();
        $item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : '');
        $db_c = new Db_functions();
        $get_services_astrologer = $db_c->get_services_for_user($item_id);
//        echo '<pre>';
//        print_r($get_services_astrologer);
//        echo '</pre>';
        $div_content = "";
        if (!empty($get_services_astrologer)) {
            $x = 0;
            foreach ($get_services_astrologer as $gsa) {
                $x++;
                $service_name = (($gsa->service_name_en != "") ? $gsa->service_name_en : '') . " | " . (($gsa->service_name_si != "") ? $gsa->service_name_si : '');
                $map_id = (($gsa->mapId != "") ? $gsa->mapId : '');
                $service_price = (($gsa->price_service != "") ? $gsa->price_service : '');
                $div_content .= <<<MSG
                <div class="form-group row">
                    <div class="col-lg-12">
                        <label class="required">$service_name</label>
                        <input type="hidden" name="astrologer[services][$x][mapId]" value="$map_id">
                        <input type="text" name="astrologer[services][$x][servicePrice]" placeholder="Enter Price" class="form-control" value="$service_price">
                    </div>
                </div>
MSG;
            }
            $json['msg_type'] = "OK";
            $json['msg'] = "Successs";
            $json['div_content'] = $div_content;
        } else {
            $json['msg_type'] = "ERR";
            $json['msg'] = "Sorry Something Went Wrong";
        }
        echo json_encode($json);
        exit();
    }

    public function nr_nl_submit_pricess() {
        $json = array();
        $service_array = ((isset($_POST['astrologer']["services"]) ? $_POST['astrologer']["services"] : ''));
//        echo count($service_array);
        $item_okay = false;
        if (!empty($service_array)) {
//            echo 'nirosh';
            $x = 0;
            for ($i = 0; count($service_array) > $i; $i++) {
                $x++;
                if ($service_array[$x]['servicePrice'] != "") {
                    $item_okay = true;
                } else {
                    $item_okay = false;
                    break;
                }
            }
            $db_c = new Db_functions();
            if ($item_okay) {
                $inc = 0;
                for ($i = 0; count($service_array) > $i; $i++) {
                    $inc++;
                    $item_id = $service_array[$inc]['mapId'];
                    $price_value = $service_array[$inc]['servicePrice'];
                    $update_values = $db_c->update_items("service_map", "id", $item_id, array(
                        "service_price" => $price_value,
                    ));
                }
                $json['msg_type'] = "OK";
                $json['msg'] = "Successfully Update the prices";
            } else {
                $json['msg_type'] = "ERR";
                $json['msg'] = "Sorry You Have to fill everything in this Form";
            }
        } else {
            $json['msg_type'] = "ERR";
            $json['msg'] = "Sorry Something Went Wrong with my request";
        }
        echo json_encode($json);
        exit();
    }

}
