<?php

require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
require_once(plugin_dir_path(__FILE__) . 'Db_functions.php');

class NineAstrologerOrders extends WP_List_Table {

    //define dataset for worpress W_list =>data
    //prepare Items
    public function prepare_items() {

        $orderby = isset($_GET['orderby']) ? trim($_GET['orderby']) : '';
        $order = isset($_GET['order']) ? trim($_GET['order']) : '';
        $search_term = isset($_POST['s']) ? trim($_POST['s']) : '';
        $datas = $this->wp_list_table_data($orderby, $order, $search_term);
        $per_page = 5;
        $current_page = $this->get_pagenum();
        $total_items = count($datas);

        $this->set_pagination_args(array(
            "total_items" => $total_items,
            "per_page" => $per_page,
        ));
        $this->items = array_slice($datas, (($current_page - 1) * $per_page), $per_page);
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = array($columns, $hidden, $sortable);
    }

    public function wp_list_table_data($orderby = '', $order = '', $search_term = '') {
        $db_data = new Db_functions();
        if (!empty($search_term)) {
            $all_posts = $db_data->get_all_orders();
        } else {
            if ($orderby == "astrologer_name_sinhala" && $order == "asc") {
                $all_posts = $db_data->get_all_list("users", "astrologer_name_sinhala", "ASC");
            } elseif ($orderby == 'astrologer_name_sinhala' && $order = 'desc') {
                $all_posts = $db_data->get_all_list("users", "astrologer_name_sinhala", "DESC");
            } elseif ($orderby == "astrologer_name_english" && $order == "asc") {
                $all_posts = $db_data->get_all_list("users", "astrologer_name_english", "ASC");
            } elseif ($orderby == 'astrologer_name_english' && $order = 'desc') {
                $all_posts = $db_data->get_all_list("users", "astrologer_name_english", "DESC");
            } elseif ($orderby == "astrologer_phone" && $order == "asc") {
                $all_posts = $db_data->get_all_list("users", "astrologer_phone", "ASC");
            } elseif ($orderby == 'astrologer_phone' && $order = 'desc') {
                $all_posts = $db_data->get_all_list("users", "astrologer_phone", "DESC");
            } else {
                $all_posts = $db_data->get_all_orders();
            }
        }


//    [0] => stdClass Object
//        (
//            [order_id] => 2
//            [service_id] => 1
//            [sub_service_id] => 9
//            [service_name_en] => Horrescope
//            [service_name_si] => ඵලාපල බැලීම (කේන්දර සැකසීම හා පරික්ෂාව )
//            [sub_service_english] => Sample Data
//            [sub_service_sinhala] => සමාජ තත්ත්වය 
//            [created_date] => 2020-01-13 15:53:48
//            [request_completed] => 0
//            [user_name_sinhala] => aefaef aefaef
//            [user_name_english] => aefaef afaef
//        )
        $post_array = array();
        if (count($all_posts) > 0) {
            foreach ($all_posts as $index => $orders) {

                $post_array[] = array(
                    "id" => $orders->order_id,
                    "requested_service" => (isset($orders->service_name_en) ? (($orders->service_name_en != "") ? $orders->service_name_en : '') : '') . " " . (isset($orders->service_name_si) ? (($orders->service_name_si != "") ? "| " . $orders->service_name_si : '') : ''),
                    "requested_area" => (isset($orders->sub_service_english) ? (($orders->sub_service_english != "") ? $orders->sub_service_english : '') : '') . " " . (isset($orders->sub_service_sinhala) ? (($orders->sub_service_sinhala != "") ? "| " . $orders->sub_service_sinhala : '') : ''),
                    "requested_astrologer" => (isset($orders->user_name_english) ? (($orders->user_name_english != "") ? $orders->user_name_english : '') : '') . " " . (isset($orders->user_name_sinhala) ? (($orders->user_name_sinhala != "") ? "| " . $orders->user_name_sinhala : '') : ''),
                    "created_date" => (isset($orders->created_date) ? (($orders->created_date != "") ? $orders->created_date : '') : ''),
                    "request_status" => (isset($orders->request_completed) ? (($orders->request_completed == "1") ? "Order Completed" : 'Order In Prograss') : ''),
                );

//               
            }
        }
        return $post_array;
    }

    public function get_hidden_columns() {
        return array("id");
    }

    public function get_sortable_columns() {
//        return array(
//            "astrologer_name_sinhala" => array("service_name_si", false),
//            "astrologer_name_english" => array("service_name_en", false),
//            "astrologer_phone" => array("service_price", false),
//        );
    }

    public function get_columns() {
        $columns = array(
            "id" => "ID",
            "requested_service" => "Ordered Service",
            "requested_area" => "Ordered Service Area",
            "requested_astrologer" => "Astrologer Name",
            "created_date" => "Ordered Date",
            "request_status" => "Order Current Status",
        );
        return $columns;
    }

    public function column_default($item, $column_name) {
        switch ($column_name) {
            case 'id':
            case 'requested_service':
            case 'requested_area':
            case 'requested_astrologer':
            case 'created_date':
            case 'request_status':
                return $item[$column_name];
            default :
                return 'No value';
        }
    }

    public function column_astrologer_name_sinhala($item) {

        $action = array(
            "edit" => "<a href='" . home_url() . "/wp-admin/user-edit.php?user_id=" . $item['id'] . "?'><button class='admin_list_button edit-items' value='" . $item['id'] . "' " . (($item['active'] != 1) ? 'disabled="" title="Please Activate this item first"' : "") . ">Edit</button></a>",
            "change_price" => "<button class='admin_list_button change-price' value='" . $item['id'] . "' >Change Price</button>",
            "delete" => "<button class='admin_list_button delete-items' value='" . $item['id'] . "' >Delete</button>",
        );

        return sprintf('%1$s %2$s', $item['astrologer_name_sinhala'], $this->row_actions($action));
    }

}

function nr_list_table_layout() {
    $nr_wp_list_table = new NineAstrologerOrders();
//prepare_items from class
    $nr_wp_list_table->prepare_items();
//    echo '<form method="post" name="frm_search_post" action="' . $_SERVER["PHP_SELF"] . '?page=parking-discount-codes">';
//    $nr_wp_list_table->search_box("Search Codes", "search_box_id");
//    echo '</form>';
    $nr_wp_list_table->display();
}

nr_list_table_layout();
