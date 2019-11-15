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

}
