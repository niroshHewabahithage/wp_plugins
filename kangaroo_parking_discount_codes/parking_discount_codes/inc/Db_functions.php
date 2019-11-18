<?php

class Db_functions {

    function print_value() {
        return "Hellwo World";
    }

    function get_categories() {
        global $wpdb;
        $table_name = $wpdb->prefix . "travel_categories";
        $row = $wpdb->get_results("SELECT * FROM $table_name");
        return $row;
    }

    function insert_destination_addon_values() {
        global $wpdb;
    }

    function get_by($tbl_name, $colmnName, $whereVal, $active_status = false) {
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

    function insert_data($ref_table, $payload_arr) {
        global $wpdb;
        $table_name = $wpdb->prefix . $ref_table;
        $save_items = $wpdb->insert($table_name, $payload_arr);
        return $wpdb->insert_id;
    }

    function get_all_list($tble_name, $orderby = '', $order = '', $search_term = '') {
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

    function update_items($tbl_name, $contd_col, $uniqu_key, $payload) {
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

    function delete_item($tab_name, $refer_column, $param) {
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

}
