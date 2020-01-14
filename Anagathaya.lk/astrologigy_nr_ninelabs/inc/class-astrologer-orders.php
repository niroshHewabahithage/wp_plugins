<?php

require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
require_once(plugin_dir_path(__FILE__) . 'Db_functions.php');

class NineAstrologerOrdersSingle extends WP_List_Table {

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
        $current_user = wp_get_current_user();
        $user_id = $current_user->ID;

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
                $all_posts = $db_data->get_all_orders_astrolger($user_id);
            }
        }


        $post_array = array();
        if (count($all_posts) > 0) {
            foreach ($all_posts as $index => $orders) {

                $post_array[] = array(
                    "id" => $orders->order_id,
                    "requested_service" => (isset($orders->service_name_en) ? (($orders->service_name_en != "") ? $orders->service_name_en : '') : '') . " " . (isset($orders->service_name_si) ? (($orders->service_name_si != "") ? "| " . $orders->service_name_si : '') : ''),
                    "requested_area" => (isset($orders->sub_service_english) ? (($orders->sub_service_english != "") ? $orders->sub_service_english : '') : '') . " " . (isset($orders->sub_service_sinhala) ? (($orders->sub_service_sinhala != "") ? "| " . $orders->sub_service_sinhala : '') : ''),
                    "requested_person" => (isset($orders->name) ? (($orders->name != "") ? $orders->name : '') : ''),
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
            "requested_person" => "Ordered Person",
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
            case 'requested_person':
            case 'created_date':
            case 'request_status':
                return $item[$column_name];
            default :
                return 'No value';
        }
    }

    public function column_requested_service($item) {

        $action = array(
            "edit" => "<button class='admin_list_button show-order' value='" . $item['id'] . "' >View Order</button>",
            "delete" => "<button class='admin_list_button delete-items' value='" . $item['id'] . "' >Delete</button>",
        );

        return sprintf('%1$s %2$s', $item['requested_service'], $this->row_actions($action));
    }

}

function nr_list_table_layout() {
    $nr_wp_list_table = new NineAstrologerOrdersSingle();
//prepare_items from class
    $nr_wp_list_table->prepare_items();
//    echo '<form method="post" name="frm_search_post" action="' . $_SERVER["PHP_SELF"] . '?page=parking-discount-codes">';
//    $nr_wp_list_table->search_box("Search Codes", "search_box_id");
//    echo '</form>';
    $nr_wp_list_table->display();
}

nr_list_table_layout();
