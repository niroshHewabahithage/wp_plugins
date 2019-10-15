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

    function insert_destination_addon_values($payload_array) {
        global $wpdb;
        $table_name = $wpdb->prefix . "destination_adons";
        $save_items = $wpdb->insert($table_name, $payload_array);
        return $wpdb->insert_id;
    }

    function select_addon_by_slug($slug) {
        global $wpdb;
        $table_name = $wpdb->prefix . "destination_adons";
        $get_items = $wpdb->get_row("SELECT * FROM $table_name where destination_slug='$slug'");
        return $get_items;
    }

    function delete_current_item($param) {
        global $wpdb;
        $table_name = $wpdb->prefix . "destination_adons";
        $delete_item = $wpdb->delete($table_name, array("id" => $param));
        return $delete_item;
    }

}
