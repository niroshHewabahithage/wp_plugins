<?php

class Db_functions extends My_controller
{

    function print_value()
    {
        return "Hellwo World";
    }

    function get_categories()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . "travel_categories";
        $row = $wpdb->get_results("SELECT * FROM $table_name");
        return $row;
    }

    function insert_destination_addon_values()
    {
        global $wpdb;
    }

    function get_by($tbl_name, $colmnName, $whereVal, $active_status = false)
    {
        global $wpdb;
        $active = "";
        if ($active_status === "1") {
            $active = "AND active=1";
        } else if ($active_status === "0") {
            $active = ' AND active=0';
        }
        $table_name = $wpdb->prefix . $tbl_name;

        $row = $wpdb->get_row("SELECT * FROM $table_name where $colmnName='$whereVal' $active");
        return $row;
    }

    function get_all($tbl_name, $active_status = false)
    {
        global $wpdb;
        $active = "";
        if ($active_status === "1") {
            $active = "where active=1";
        } else if ($active_status === "0") {
            $active = 'where active=0';
        }
        $table_name = $wpdb->prefix . $tbl_name;

        $row = $wpdb->get_results("SELECT * FROM $table_name  $active");

        return $row;
    }

    function insert_data($ref_table, $payload_arr)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . $ref_table;
        $save_items = $wpdb->insert($table_name, $payload_arr);
        return $wpdb->insert_id;
    }

    function get_all_list($tble_name, $orderby = '', $order = '', $search_term = '')
    {
        global $wpdb;
        if ($orderby !== "" && $order !== "") {
            $orderCont = "Order by $orderby $order";
        } else {
            $orderCont = "";
        }

        if ($search_term !== "") {
            $where = 'WHERE discount_code like "%' . $search_term . '%" OR percentage like "%' . $search_term . '%" OR note="%' . $search_term . '%"';
        } else {
            $where = "";
        }
        $table_name = $wpdb->prefix . $tble_name;
        $row = $wpdb->get_results("SELECT * FROM $table_name $where $orderCont");
        return $row;
    }

    function get_all_orders()
    {
        global $wpdb;
        $row = $wpdb->get_results("SELECT cr.id as order_id, cr.service_id, cr.sub_service_id, s.service_name_en, s.service_name_si, ss.sub_service_english, ss.sub_service_sinhala, cr.created_date, cr.active as request_completed, (Select meta_value from " . $wpdb->prefix . "usermeta where meta_key='first_name' AND user_id=cr.user_id) as user_name_sinhala, (Select meta_value from " . $wpdb->prefix . "usermeta where meta_key='last_name' AND user_id=cr.user_id) as user_name_english FROM " . $wpdb->prefix . "customer_requests cr LEFT JOIN " . $wpdb->prefix . "usermeta u ON cr.user_id = u.user_id LEFT JOIN " . $wpdb->prefix . "services s on cr.service_id=s.id LEFT JOIN " . $wpdb->prefix . "sub_services ss on cr.sub_service_id=ss.id group by cr.id order by cr.active ASC;");
        return $row;
    }

    function get_all_orders_astrolger($id_user)
    {
        global $wpdb;
        $row = $wpdb->get_results("SELECT cr.id as order_id, cr.service_id, cr.sub_service_id, s.service_name_en, s.service_name_si,cr.name, ss.sub_service_english, ss.sub_service_sinhala, cr.created_date, cr.active as request_completed, (Select meta_value from " . $wpdb->prefix . "usermeta where meta_key='first_name' AND user_id=cr.user_id) as user_name_sinhala, (Select meta_value from " . $wpdb->prefix . "usermeta where meta_key='last_name' AND user_id=cr.user_id) as user_name_english FROM " . $wpdb->prefix . "customer_requests cr LEFT JOIN " . $wpdb->prefix . "usermeta u ON cr.user_id = u.user_id LEFT JOIN " . $wpdb->prefix . "services s on cr.service_id=s.id LEFT JOIN " . $wpdb->prefix . "sub_services ss on cr.sub_service_id=ss.id where cr.user_id=$id_user  group by cr.id order by cr.active ASC;");
        return $row;
    }

    function update_items($tbl_name, $contd_col, $uniqu_key, $payload)
    {
        global $wpdb;
        if ($uniqu_key != "" && $contd_col != "") {
            $where = array(
                $contd_col => $uniqu_key
            );
        } else {
            $where = array();
        }
        $table_name = $wpdb->prefix . $tbl_name;
        $update_data = $wpdb->update($table_name, $payload, $where);
        return $update_data;
    }

    function delete_item($tab_name, $refer_column, $param)
    {
        global $wpdb;
        if ($refer_column != "" && $param != "") {
            $where = array($refer_column => $param);
        } else {
            $where = "";
        }
        $table_name = $wpdb->prefix . $tab_name;

        $delete_items = $wpdb->delete($table_name, $where);
        return $delete_items;
    }

    function get_all_services_selected($tble_name, $select_colomn, $colomn_name, $column_value)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . $tble_name;
        $row = $wpdb->get_results("SELECT $select_colomn FROM $table_name where $colomn_name=$column_value");
        return $row;
    }

    function get_all_dsicounted($payload_array = array())
    {

        $condition = "";
        if (!empty($payload_array)) {
            if ($payload_array['order_by'] != "") {
                $condition = "order by " . $payload_array['order_by'] . " " . $payload_array['order'] . "";
            } else if ($payload_array['search_term'] != "") {
                $condition = "where discount_code like '%" . $payload_array['search_term'] . "%'";
            }
        } else {
        }
        global $wpdb;
        $row = $wpdb->get_results("SELECT" .
            " dp.id," .
            "dp.booking_id," .
            "dp.dicount_code_id," .
            "dp.dicounted_amount," .
            "dp.final_price," .
            "dp.actual_price," .
            "b.address," .
            "b.city," .
            "b.postal_code," .
            "dc.discount_code," .
            "dc.percentage," .
            "dc.active," .
            "b.first_name," .
            "b.last_name," .
            "b.supplier," .
            "b.payment_status," .
            "b.email," .
            "b.mobile_no," .
            "b.drop_off_date," .
            "b.drop_off_time," .
            "b.return_date," .
            "b.return_time," .
            "b.book_datetime," .
            "b.description" .
            " FROM" .
            " wp_discounted_purchases dp" .
            " left join " .
            " wp_discount_codes dc on dp.dicount_code_id=dc.id" .
            " left join wp_bookings b on dp.booking_id=b.booking_id $condition;");

        return $row;
    }

    function get_astrologist_for_service($id_service)
    {
        global $wpdb;
        $row = $wpdb->get_results("select * from " . $wpdb->prefix . "service_map sm left join " . $wpdb->prefix . "users u on sm.is_user=u.ID where sm.id_service=$id_service");
        return $row;
    }

    function get_user_capabilies($user_id)
    {
        global $wpdb;
        $row = $wpdb->get_row("select * from " . $wpdb->prefix . "usermeta where user_id=$user_id AND meta_key='" . $wpdb->prefix . "capabilities'");
        return $row;
    }

    function get_meta_values($user_id, $tbl_name, $serch_param)
    {
        global $wpdb;
        $row = $wpdb->get_row("select meta_value from " . $wpdb->prefix . "$tbl_name where user_id=$user_id AND meta_key='$serch_param'");
        return $row;
    }

    function get_services_for_user($item_id)
    {
        global $wpdb;
        $select_colomn = "sm.id as mapId,sm.is_user, sm.id_service, sm.service_price as price_service, s.service_name_en, s.service_name_si";
        $row = $wpdb->get_results("SELECT $select_colomn from " . $wpdb->prefix . "service_map sm left join " . $wpdb->prefix . "services s on sm.id_service = s.id where sm.is_user=$item_id");
        return $row;
    }

    function get_sub_services($id_service)
    {
        global $wpdb;
        $select_colomn = "*";
        $row = $wpdb->get_results("SELECT $select_colomn from " . $wpdb->prefix . "sub_services where service_id=$id_service");
        return $row;
    }

    function get_single_order($order_id)
    {
        global $wpdb;
        $select_colomn = "s.service_name_en, s.service_name_si, ss.sub_service_english, ss.sub_service_sinhala, sm.service_price, cr.*,cr.active as uploaded";
        $row = $wpdb->get_row("SELECT $select_colomn FROM " . $wpdb->prefix . "customer_requests cr LEFT JOIN " . $wpdb->prefix . "services s ON cr.service_id = s.id LEFT JOIN " . $wpdb->prefix . "sub_services ss on cr.sub_service_id=ss.id LEFT JOIN " . $wpdb->prefix . "service_map sm on cr.service_id=sm.id_service where cr.id=$order_id group by cr.id");
        return $row;
    }

    function get_all_order_user_count($id_user)
    {
        global $wpdb;
        $select_colomn = "*";
        $row = $wpdb->get_results("SELECT $select_colomn from " . $wpdb->prefix . "customer_requests where user_id=$id_user");
        return count($row);
    }
}
