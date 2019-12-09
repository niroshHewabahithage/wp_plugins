<?php

require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
require_once(plugin_dir_path(__FILE__) . 'Db_functions.php');

class NineAstrologyServces extends WP_List_Table {

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
            $all_posts = $db_data->get_all_list("services", "", "", $search_term);
        } else {
            if ($orderby == "service_name_si" && $order == "asc") {
                $all_posts = $db_data->get_all_list("services", "service_name_si", "ASC");
            } elseif ($orderby == 'service_name_si' && $order = 'desc') {
                $all_posts = $db_data->get_all_list("services", "service_name_si", "DESC");
            } elseif ($orderby == "service_name_en" && $order == "asc") {
                $all_posts = $db_data->get_all_list("services", "service_name_en", "ASC");
            } elseif ($orderby == 'service_name_en' && $order = 'desc') {
                $all_posts = $db_data->get_all_list("services", "service_name_en", "DESC");
            } elseif ($orderby == "service_price" && $order == "asc") {
                $all_posts = $db_data->get_all_list("services", "service_price", "ASC");
            } elseif ($orderby == 'service_price' && $order = 'desc') {
                $all_posts = $db_data->get_all_list("services", "service_price", "DESC");
            } else {
                $all_posts = $db_data->get_all_list("services", "", "");
            }
        }


        $post_array = array();
        if (count($all_posts) > 0) {
            foreach ($all_posts as $index => $services) {
                $post_array[] = array(
                    "id" => $services->id,
                    "service_name_si" => $services->service_name_si,
                    "service_name_en" => $services->service_name_en,
                    "service_price" => number_format($services->service_price, 2),
                    "active" => $services->active,
                );
            }
        }

        return $post_array;
    }

    public function get_hidden_columns() {
        return array("id");
    }

    public function get_sortable_columns() {
        return array(
            "service_name_si" => array("service_name_si", false),
            "service_name_en" => array("service_name_en", false),
            "service_price" => array("service_price", false),
        );
    }

    public function get_columns() {
        $columns = array(
            "id" => "ID",
            "service_name_si" => "Service Name Sinhala",
            "service_name_en" => "Service Name English",
//            "service_price" => "Service Price",
        );
        return $columns;
    }

    public function column_default($item, $column_name) {
        switch ($column_name) {
            case 'id':
            case 'service_name_si':
            case 'service_name_en':
            case 'service_price':
                return $item[$column_name];
            default :
                return 'No value';
        }
    }

    public function column_service_name_si($item) {

        $action = array(
            "edit" => "<button class='admin_list_button edit-items' value='" . $item['id'] . "' " . (($item['active'] != 1) ? 'disabled="" title="Please Activate this item first"' : "") . " >Edit</button>",
//            "deactivate" => (($item['active'] == 1) ? "<button class='admin_list_button deactivate-items' value='" . $item['id'] . "' >Deactivate</button>" : "<button class='admin_list_button enable-items' value='" . $item['id'] . "' >Activate</button>"),
            "delete" => "<button class='admin_list_button delete-items' value='" . $item['id'] . "' >Delete</button>",
        );

        return sprintf('%1$s %2$s', $item['service_name_si'], $this->row_actions($action));
    }

}

function nr_list_table_layout() {
    $nr_wp_list_table = new NineAstrologyServces();
//prepare_items from class
    $nr_wp_list_table->prepare_items();
    echo '<form method="post" name="frm_search_post" action="' . $_SERVER["PHP_SELF"] . '?page=parking-discount-codes">';
    $nr_wp_list_table->search_box("Search Codes", "search_box_id");
    echo '</form>';
    $nr_wp_list_table->display();
}

nr_list_table_layout();
