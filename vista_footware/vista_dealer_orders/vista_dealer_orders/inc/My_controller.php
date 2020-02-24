<?php
class My_controller extends Core_controller
{
    public function __construct()
    {
    }

    public function _wl_admin_item_management()
    {
        global $msg;
        global $db_c;
        $current_user = wp_get_current_user();
        $user_id = $current_user->ID;

        $json = array();
        $post_array_colors = (isset($_POST['item_colors']) ? $_POST['item_colors'] : '');
        $post_color_sizes = (isset($_POST['item_color_sizes']) ? $_POST['item_color_sizes'] : '');
        $item_code = (isset($_POST['item_code']) ? $_POST['item_code'] : '');
        $item_price = (isset($_POST['item_price']) ? $_POST['item_price'] : '');

        if (!empty($item_code)) {
            $duplicates = $db_c->get_by("items", "item_code", $item_code);
            if (empty($duplicates)) {
                if (!empty($item_price)) {
                    if (is_numeric($item_price)) {
                        if (!empty($post_array_colors)) {
                            $is_size = false;
                            for ($i = 0; count($post_array_colors) > $i; $i++) {
                                $is_size = false;
                                $size_array = $post_color_sizes[$post_array_colors[$i]];
                                if (!empty($size_array)) {
                                    $is_size = true;
                                } else {
                                    $json['msg_type'] = "ERR";
                                    $json['msg'] = "Sorry You have to select sizes for all colors you have selected";
                                    $json['id_value'] = $post_array_colors[$i];
                                    break;
                                }
                            }
                            if ($is_size) {
                                $add_params = array(
                                    "item_code" => ($item_code),
                                    "item_price" => ($item_price),
                                    "item_colors" => (!empty($post_array_colors) ? serialize($post_array_colors) : ''),
                                    "item_color_sizes" => (!empty($post_color_sizes) ? serialize($post_color_sizes) : ''),
                                    "active" => 1,
                                    "created_by" => $user_id
                                );

                                $save_items = $db_c->insert_data("items", $add_params);
                                if (!empty($save_items)) {
                                    $json['msg_type'] = "OK";
                                    $json['msg'] = "Succssfully Created new Item, Reloading...";
                                } else {
                                    $json['msg_type'] = "ERR";
                                    $json['msg'] = "Sorry We cannot perform this action right now, try again later";
                                }
                            }
                        } else {
                            $json['msg_type'] = "ERR";
                            $json['msg'] = "Sorry You have to select atleast one shoe color";
                        }
                    } else {
                        $json['msg_type'] = "ERR";
                        $json['msg'] = $msg->validation_errors("numeric", "Item Price");
                    }
                } else {
                    $json['msg_type'] = "ERR";
                    $json['msg'] = $msg->validation_errors("required", "Item Price");
                }
            } else {
                $json['msg_type'] = "ERR";
                $json['msg'] = $msg->validation_errors("duplicate", "Item Code");
            }
        } else {
            $json['msg_type'] = "ERR";
            $json['msg'] = $msg->validation_errors("required", "Item Code");
        }
        echo json_encode($json);
        exit();
    }


    public function _wl_admin_delete_items()
    {
        global $db_c;
        $json = array();
        $item_id = (isset($_POST['item_id']) ? $_POST['item_id'] : '');
        if (!empty($item_id)) {
            $delete_item = $db_c->delete_item("items", "id", $item_id);
            if (!empty($delete_item)) {
                $json["msg_type"] = "OK";
                $json["msg"] = "Successfully Deleted the Items";
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

    public function _wl_get_colors_and_sizes()
    {
        global $db_c;
        $json = array();
        $item_code = (isset($_POST['item_value']) ? $_POST['item_value'] : '');
        if ($item_code != "") {

            $get_item_values = $db_c->get_by("items", "item_code", $item_code);
            // echo '<pre>';
            // print_r($get_item_values);
            // echo '</pre>';

            $color_layout = "";
            $color_size_layout = "";
            if ($get_item_values != '') {
                $color_array = (isset($get_item_values->item_colors) ? ($get_item_values->item_colors != "") ? unserialize($get_item_values->item_colors) : '' : '');
                $item_price = (isset($get_item_values->item_price) ? ($get_item_values->item_price != "") ? $get_item_values->item_price : '' : '');
                $size_array = (isset($get_item_values->item_color_sizes) ? ($get_item_values->item_color_sizes != "") ? unserialize($get_item_values->item_color_sizes) : '' : '');
                $inc = "0";
                for ($i = 0; count($color_array) > $i; $i++) {
                    $inc++;
                    $color_slug = (isset($color_array[$i]) ? (($color_array[$i] != "") ? $color_array[$i] : '') : '');
                    $color_name = ucwords(preg_replace("/[^a-zA-Z]/", " ", $color_slug));
                    $size_to_color = $size_array[$color_slug]["size"];

                    for ($x = 0; count($size_to_color) > $x; $x++) {
                        // echo $color_slug;
                        // echo $i;
                        $color_size = (isset($size_to_color[$x]) ? (($size_to_color[$x] != "") ? $size_to_color[$x] : '') : '');
                        $increment_sizes = $item_code . "_" . $color_size . "_" . $color_slug . $x;
                        // echo $increment_sizes."<br>";
                        $increment_color = $item_code . "_" . $color_size . "_" . $inc . "_" . $color_slug;
                        // echo $increment_color."<br>";
                        $color_size_layout .= <<<MSG
                         <div class="row">
                             <div class="col-sm-7">
                                <div class="form-check">
                                     <input type="checkbox" class="form-check-input size_set" name="order_params[$item_code][$color_slug][size][]" value="$color_size" id="materialUnchecked_$increment_sizes">
                                    <label class="form-check-label" for="materialUnchecked_$increment_sizes">Size $color_size</label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" name="order_params[$item_code][$color_slug][quentity][$color_size]" class="form-control qty_amount" placeholder="Qty" style="display:none">
                            </div>
                        </div>
MSG;
                    }
                    $color_layout .= <<<MSG
                    
                    <div class="col-lg-4 size_box_front">
                        <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input itemColors" name="order_params[$item_code][color][]" value="$color_slug" id="colorsItems_$increment_color">
                        <label class="form-check-label" for="colorsItems_$increment_color">$color_name</label>
                        </div>
                    <div class='size_list' style="display:none">
                        <br>
                    <p>Available Sizes</p>
                    <div>
                            $color_size_layout
                            </div>
                    </div>
                    </div>
                    
MSG;
                    $color_size_layout = "";
                }

                $return_div = <<<MSG
            <div class="form-group row" id='$item_code'>
            <div class="col-lg-12 heading_box">
            <input type="hidden" name="order_keys[]" value="$item_code">
            <input type="hidden" name="order_params[$item_code][item_price]" value="$item_price">

                <h5>Selected: $item_code <i class="fa fa-close close"></i> <i class="fa fa-minus minimize"></i><i style="display:none" class="fa fa-plus maximize"></i> </h5>
            </div>
            
            $color_layout
            
            </div>
MSG;
                $json['msg_type'] = "OK";
                $json['return_div'] = $return_div;
            } else {
                $json['msg_type'] = "ERR";
                $json['msg'] = "Sorry Cannot Perform this Function right now, please try again later";
            }
        } else {
            $json['msg_type'] = "ERR";
            $json['msg'] = "Sprry Something went wrong with your request, pleease try again later";
        }
        echo json_encode($json);
        exit();
    }

    public function _wl_submit_request_for()
    {
        global $msg;
        $json = array();
        $item_codes_array = (isset($_POST['order_keys']) ? $_POST['order_keys'] : '');
        // $order_param_array = (isset($_POST['order_params'][$item_code]) ? $_POST['order_params'][$item_code] : '');
        $item_params = (isset($_POST['order_params']) ? $_POST['order_params'] : '');
        $name_cus = (isset($_POST['name']) ? $_POST['name'] : '');
        $email_address = (isset($_POST['email']) ? $_POST['email'] : '');
        $phone_number = (isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : '');
        $companyName = (isset($_POST['company']) ? $_POST['company'] : '');

        if (!empty($name_cus)) {
            if (!empty($email_address)) {
                if (is_email($email_address)) {
                    if (!empty($phone_number)) {
                        if (is_numeric($phone_number)) {
                            $validate_phone = $this->validate_phone_number($phone_number, "", 10, 12);
                            if ($validate_phone['condt'] != "") {
                                if (!empty($companyName)) {
                                    $is_validated = false;
                                    if (!empty($item_codes_array)) {
                                        for ($i = 0; count($item_codes_array) > $i; $i++) {
                                            $is_validated = false;
                                            $item_code = (isset($item_codes_array[$i]) ? $item_codes_array[$i] : '');
                                            $order_param_array = (isset($_POST['order_params'][$item_code]) ? $_POST['order_params'][$item_code] : '');
                                            $item_color_arr = (isset($order_param_array['color']) ? $order_param_array['color'] : '');
                                            if (!empty($item_color_arr)) {
                                                for ($y = 0; count($item_color_arr) > $y; $y++) {
                                                    $color_names = (isset($item_color_arr[$y]) ? $item_color_arr[$y] : '');
                                                    // echo $color_names;
                                                    $slug_color_array = (isset($order_param_array[$color_names]) ? $order_param_array[$color_names] : '');
                                                    $color_size_array = (isset($slug_color_array['size']) ? $slug_color_array['size'] : '');
                                                    if (!empty($color_size_array)) {
                                                        for ($q = 0; count($color_size_array) > $q; $q++) {
                                                            $color_size_key = (isset($color_size_array[$q]) ? $color_size_array[$q] : '');
                                                            $quntities = (isset($slug_color_array['quentity'][$color_size_key]) ? $slug_color_array['quentity'][$color_size_key] : '');
                                                            if (!empty($quntities)) {
                                                                $is_validated = true;
                                                            } else {
                                                                $json['msg_type'] = "ERR";
                                                                $json['msg'] = $msg->validation_errors("Required", "Quentities", "Please Enter Quentities for selected, items");
                                                                $is_validated = false;
                                                                break;
                                                            }
                                                        }
                                                    } else {
                                                        $json['msg_type'] = "ERR";
                                                        $json['msg'] = $msg->validation_errors("required", "itemSize", "Please Select at least one of sizes of Item colors whihc you selected before you order from us");
                                                        $is_validated = false;
                                                        break;
                                                    }
                                                }
                                            } else {
                                                $json['msg_type'] = "ERR";
                                                $json['msg'] = $msg->validation_errors("required", "itemColor", "Please Select at least one of colors of the seleted Item before you order from us");
                                                $is_validated = false;
                                                break;
                                            }
                                        }
                                    } else {
                                        $json['msg_type'] = "ERR";
                                        $json['msg'] = $msg->validation_errors("required", "items", "Please Select at least one of item before you order from us");
                                    }

                                    if ($is_validated) {
                                        $table_rows = "";
                                        $net_values = [];
                                        $color_colom = "";
                                        $size_base = "";
                                        $size_li = "";
                                        $sum_quentity = "";
                                        for ($it = 0; count($item_codes_array) > $it; $it++) {
                                            $item_code_selected = (isset($item_codes_array[$it]) ? $item_codes_array[$it] : '');
                                            $item_color_s_item = (isset($item_params[$item_code_selected]) ? $item_params[$item_code_selected] : '');
                                            $item_colors_selected = (isset($item_color_s_item['color']) ? $item_color_s_item['color'] : '');
                                            $item_unit_price = (isset($item_color_s_item['item_price']) ? $item_color_s_item['item_price'] : '');
                                            $formatted_num = number_format($item_color_s_item['item_price'], 2);


                                            for ($cl = 0; count($item_colors_selected) > $cl; $cl++) {
                                                $color_name_selected = (isset($item_colors_selected[$cl]) ? $item_colors_selected[$cl] : '');
                                                $item_color_key_items = (isset($item_color_s_item[$color_name_selected]) ? $item_color_s_item[$color_name_selected] : '');
                                                $formatted_name_color = ucwords(preg_replace("/[^a-zA-Z]/", " ", $color_name_selected));
                                                // echo '<pre>';
                                                // print_r($item_color_key_items);
                                                // echo '</pre>';
                                                $size_array = (isset($item_color_key_items['size']) ? $item_color_key_items['size'] : '');
                                                // // for ($si = 0; count($size_array) > $si; $si++) {
                                                //     $size_item_selected = (isset($size_array[$si]) ? $size_array[$si] : '');
                                                // echo $size_item_selected;
                                                //   echo $size_item_selected."=".$quentity_value . "<br>";
                                                $size_start = 35;
                                                $size_increment = 13;
                                                $td_set = "";
                                                // echo $size_increment;
                                                for ($siz = 1; $size_increment > $siz; $siz++) {
                                                    // echo $size_start;
                                                    $quentity_value .= (isset($item_color_key_items['quentity'][$size_start]) ? $item_color_key_items['quentity'][$size_start] : '');
                                                    $sum_quentity += $quentity_value;
                                                    $formatted_quatity=(isset($quentity_value)? $quentity_value:'-');
                                                    // echo 'Nirosh'. $size_start."=" . $quentity_value;
                                                    $td_set .= "<td style='border-collapse: collapse;padding:10px 5px;text-align:center' id='th_$quentity_value'> $formatted_quatity</td>";
                                                    $size_start++;
                                                    $quentity_value = "";
                                                }
                                                //                                                     $size_li .= <<<MSG
                                                //                                                     <li>Size $size_item_selected ($quentity_value)</li>
                                                // MSG;
                                                // }
                                                //                                                 $size_base .= <<<MSG
                                                //                                                 <ul>$size_li</ul>
                                                // MSG;
                                                //echo  $size_tr;
                                                // $size_tr.=$td_set;
                                                $color_colom .= <<<MSG
                                               <td style='border-collapse: collapse;text-align:center'>$formatted_name_color</td>                                             
MSG;

                                                //                                                 $color_base .= <<<MSG

                                                //                                                 $color_colom

                                                // MSG;
                                                // $color_colom = "";
                                                $size_li = "";
                                                $size_base = "";
                                                $net_value = ($sum_quentity * $item_unit_price);
                                                $net_val_form = number_format($net_value, 2);
                                                array_push($net_values, $net_value);
                                                $sub_total += $net_value;
                                                $sub_total_form = number_format($sub_total, 2);

                                                $table_rows .= <<<MSG
                                                <tr style="background: #fff">
                                                <td style='border-collapse: collapse;padding:10px 5px;text-align:center'>$item_code_selected</td>                                                
                                                $color_colom                                             
                                                $td_set
                                                <td style='border-collapse: collapse;padding:10px 5px;text-align:center'>$sum_quentity</td>
                                                <td style='border-collapse: collapse;padding:10px 5px;text-align:center'>LKR $formatted_num</td>
                                                <td style='border-collapse: collapse;padding:10px 5px;text-align:center'>LKR $net_val_form</td>
                                                </tr>
                                                
                                                MSG;
                                                $color_colom = "";
                                                $size_base = "";
                                                $sum_quentity = "";
                                                $net_value = "";
                                                $net_val_form = "";
                                                $color_base = "";
                                            }
                                        }
                                        $today = date("d/m/Y");
                                        $weblankan_url = "https://www.weblankan.com/";
                                        $site_url = site_url();
                                        $cuur_year = date("Y");
                                        $imag_path = "http://weblankan.site/vista/wp-content/uploads/2020/02/new-logo.png";
                                        // for ($tt = 0; count($array_name) > $tt; $tt++) {
                                                    
                                        //         }
                                    //    <tr style="background: #fdba13">
                                    //             <th colspan=2>
                                    //                 <p style="text-align: center;margin-bottom:0px;margin-top:0;font-size: 12px;">NO 51A, WEKUNAGODA LANE, GALLE, SRI LANKA</p>
                                    //             </th>
                                    //         </tr>
                                    //         <tr style="background: #fdba13">
                                    //             <th colspan=2>
                                    //                 <p style="text-align: center;margin-bottom:0px;margin-top:0;font-size: 12px;">091-3011021/076-9110230 | info@vistafootwear.lk</p>
                                    //             </th>
                                    //         </tr>
                                        $size_start = 35;
                                        $size_increment = 13;
                                        $tr_lot = "";
                                        // echo $size_increment;
                                        for ($siz = 1; $size_increment > $siz; $siz++) {
                                            // echo 'Nirosh'. $size_start;
                                            $tr_lot .= "<th style='border-collapse: collapse;padding:10px 5px;text-align:center' id='th_$size_start'>$size_start</th>";
                                            $size_start++;
                                        }

                                        $email_body = <<<MSG
                                        <table style="width: 100%;background: #fdba13;">
                                            <thead>
                                            <tr style="background: #fdba13">
                                                <th>
                                                   <img src="$imag_path">
                                                </th>
                                                <th>
                                                <h3 style="text-align: center;margin-bottom:4px;text-transform: uppercase;font-size: 31px;">Vista FootWare Industries (PVT) LTD</h3>
                                                </th>
                                            </tr>
                                            
                                            <tr style="background: #fdba13">
                                                <th>
                                                   
                                                </th>
                                            </tr>
                                            <tr style="background: #9d7a66">
                                                <th colspan=2>
                                                    <h3 style="text-align:center;color:#fff">Customer Orders</h3>
                                                </th>
                                            </tr>
                                            <tr style="background: #fff;">
                                                <th>
                                                    <p style="margin: 5px 5px 0px;text-align:left">Ordered Date : $today</p>
                                                </th>
                                                <th>
                                                    <p style="margin: 0px 5px 0px;text-align:left">Ref Name : $name_cus</p>
                                                </th>
                                            </tr>
                                            <tr style="background: #fff;">
                                            <th>
                                            <p style="margin: 0px 5px 0px;text-align:left">Customer Phone : $phone_number</p>
                                                </th>
                                                <th>
                                                <p style="margin: 0px 5px 0px;text-align:left">Customer Email : $email_address</p>
                                                </th>
                                            </tr>
                                            <tr style="background: #fff;">
                                                <th colspan=2>
                                                    <p style="margin: 0px 5px 3px;text-align:left">Company Name : $companyName</p>
                                                </th>
                                               
                                            </tr>
                                            </thead>
                                            </table>
                                            <table border="1" style="width: 100%;background: #fdba13;">
                                            <thead>
                                            <tr style="background: #fff">
                                                <th style='border-collapse: collapse;padding:10px 5px;text-align:center'>Item Code</th>
                                                <th style='border-collapse: collapse;padding:10px 5px;text-align:center'>Item Color</th>
                                                $tr_lot
                                                <th style='border-collapse: collapse;padding:10px 5px;text-align:center'>Total Qty</th>
                                                <th style='border-collapse: collapse;padding:10px 5px;text-align:center'>Unit Price</th>
                                                <th style='border-collapse: collapse;padding:10px 5px;text-align:center'>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        $table_rows
                                        <tr style="background: #fff;">
                                                <td colspan=16 style='border-collapse: collapse;padding:10px 5px;text-align:center'>Net Amount</td>
                                                <td colspan=1 style='border-collapse: collapse;padding:10px 5px;text-align:right'>LKR $sub_total_form</td>
                                                </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr style="background: #fff">
                                        <td colspan='17'>
                                        <p style='text-align:center;margin: 5px 5px 5px;'>Copyright © $cuur_year - <a href='$site_url' target="blank">Vista Footwear</a> - All Rights Reserved. Powered by <a href="$weblankan_url" target="blank">Web Lankan</a></p>
                                        </td>
                                        </tr>
                                        </tfoot>
                                    </table>
MSG;
                                        $to = 'nirosh@weblankan.lk';
                                        $subject = 'Customer Orders';
                                        $body = $email_body;
                                        $headers = array('Content-Type: text/html; charset=UTF-8');
                                        $headers[] = 'From: Vista Customer Orders <nirosh@weblankan.lk>';
                                        $headers[] = 'Cc: ' . $name_cus . ' <' . $email_address . '>';
                                        $email_status = false;
                                        $email_status_sent = wp_mail($to, $subject, $body, $headers);

                                        // if ($email_status) {
                                        $json['msg_type'] = "OK";
                                        // $json['cus'] = $email_body;
                                        $json['msg'] = "Successfully Send Your request to the Administrator";
                                        // } else {
                                        //     $json['msg_type'] = "ERR";
                                        //     $json["msg"] = "Sorry We cannot Send the Email Right Now";
                                        // }
                                    }
                                } else {
                                    $json['msg_type'] = "ERR";
                                    $json['msg'] = $msg->validation_errors("required", "Company Name");
                                }
                            } else {
                                $json['msg_type'] = "ERR";
                                $json['msg'] = $validate_phone['msg_param'];
                            }
                        } else {
                            $json['msg_type'] = "ERR";
                            $json['msg'] = $msg->validation_errors("numeric", "Your Phone Number");
                        }
                    } else {
                        $json['msg_type'] = "ERR";
                        $json['msg'] = $msg->validation_errors("required", "Your Phone Number");
                    }
                } else {
                    $json['msg_type'] = "ERR";
                    $json['msg'] = $msg->validation_errors("valid_email", "Your Email");
                }
            } else {
                $json['msg_type'] = "ERR";
                $json['msg'] = $msg->validation_errors("required", "Your Email");
            }
        } else {
            $json['msg_type'] = "ERR";
            $json['msg'] = $msg->validation_errors("required", "Your Name");
        }
        echo json_encode($json);
        exit();
    }
}
