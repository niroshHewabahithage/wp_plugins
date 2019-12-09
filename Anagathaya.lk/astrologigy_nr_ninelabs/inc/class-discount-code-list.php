<?php

require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
require_once(plugin_dir_path(__FILE__) . 'Db_functions.php');

class NiroCustomDiscountClass extends WP_List_Table {

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
            $all_posts = $db_data->get_all_list("discount_codes", "", "", $search_term);
        } else {
            if ($orderby == "percentage" && $order == "asc") {
                $all_posts = $db_data->get_all_list("discount_codes", "percentage", "ASC");
            } elseif ($oderby == 'percentage' && $order = 'desc') {
                $all_posts = $db_data->get_all_list("discount_codes", "percentage", "DESC");
            } elseif ($orderby == "discount_code" && $order == "asc") {
                $all_posts = $db_data->get_all_list("discount_codes", "discount_code", "ASC");
            } elseif ($oderby == 'discount_code' && $order = 'desc') {
                $all_posts = $db_data->get_all_list("discount_codes", "discount_code", "DESC");
            } else {
                $all_posts = $db_data->get_all_list("discount_codes", "", "");
            }
        }


        $post_array = array();
        if (count($all_posts) > 0) {
            foreach ($all_posts as $index => $discount) {
                $post_array[] = array(
                    "id" => $discount->id,
                    "discount_code" => $discount->discount_code,
                    "percentage" => $discount->percentage . "% from total Value",
                    "note" => $discount->note,
                    "status" => ($discount->active == 1) ? "<span>Code Active</span>" : "<span style='color:#ff3636'>Code Disabled</span>",
                    "active" => $discount->active,
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
            "percentage" => array("percentage", false),
            "discount_code" => array("discount_code", false),
        );
    }

    public function get_columns() {
        $columns = array(
            "id" => "ID",
            "discount_code" => "Discount Code",
            "percentage" => "Percentage",
            "note" => "Note",
            "status" => "Status",
        );
        return $columns;
    }

    public function column_default($item, $column_name) {
        switch ($column_name) {
            case 'id':
            case 'discount_code':
            case 'percentage':
            case 'note':
            case 'status':
                return $item[$column_name];
            default :
                return 'No value';
        }
    }

    public function column_discount_code($item) {
//        $disbled = ;
        $action = array(
            "edit" => "<button class='admin_list_button edit-items' value='" . $item['id'] . "' " . (($item['active'] != 1) ? 'disabled="" title="Please Activate this item first"' : "") . " >Edit</button>",
            "deactivate" => (($item['active'] == 1) ? "<button class='admin_list_button deactivate-items' value='" . $item['id'] . "' >Deactivate</button>" : "<button class='admin_list_button enable-items' value='" . $item['id'] . "' >Activate</button>"),
            "delete" => "<button class='admin_list_button delete-items' value='" . $item['id'] . "' >Delete</button>",
        );

        return sprintf('%1$s %2$s', $item['discount_code'], $this->row_actions($action));
    }

//get_colomns    
//column_default
}

function nr_list_table_layout() {
    $nr_wp_list_table = new NiroCustomDiscountClass();


//prepare_items from class
    $nr_wp_list_table->prepare_items();
    echo '<form method="post" name="frm_search_post" action="' . $_SERVER["PHP_SELF"] .'?page=parking-discount-codes">';
    $nr_wp_list_table->search_box("Search Codes", "search_box_id");
    echo '</form>';
    $nr_wp_list_table->display();
}

nr_list_table_layout();


