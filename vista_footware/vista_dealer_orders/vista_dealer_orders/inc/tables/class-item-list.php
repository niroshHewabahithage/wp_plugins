<?php

require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
require_once(plugin_dir_path(__DIR__) . 'Db_controller.php');

class WLVistaShoeList extends WP_List_Table
{


    //define dataset for worpress W_list =>data
    //prepare Items
    public function prepare_items()
    {

        $orderby = isset($_GET['orderby']) ? trim($_GET['orderby']) : '';
        $order = isset($_GET['order']) ? trim($_GET['order']) : '';
        $search_term = isset($_POST['s']) ? trim($_POST['s']) : '';
        $datas = $this->wp_list_table_data($orderby, $order, $search_term);
        $per_page = 10;
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

    public function wp_list_table_data($orderby = '', $order = '', $search_term = '')
    {
        global $db_c;
        if (!empty($search_term)) {
            $all_posts = $db_c->get_all_list("items", "", "", $search_term);
        } else {
            if ($orderby == "item_code" && $order == "asc") {
                $all_posts = $db_c->get_all_list("items", "item_code", "ASC");
            } elseif ($orderby == 'item_code' && $order = 'desc') {
                $all_posts = $db_c->get_all_list("items", "item_code", "DESC");
            } elseif ($orderby == "item_price" && $order == "asc") {
                $all_posts = $db_c->get_all_list("items", "item_price", "ASC");
            } elseif ($orderby == 'item_price' && $order = 'desc') {
                $all_posts = $db_c->get_all_list("items", "item_price", "DESC");
            } else {
                $all_posts = $db_c->get_all_list("items", "", "");
            }
        }




        $post_array = array();
        if (count($all_posts) > 0) {
            foreach ($all_posts as $index => $items) {
                $avaiable_colors = unserialize($items->item_colors);
                $post_array[] = array(
                    "id" => $items->id,
                    "item_code" => $items->item_code,
                    "item_price" => number_format($items->item_price, 2),
                    "avaibale_colors" => implode(",", $avaiable_colors),
                    "active" => $items->active,
                );
            }
        }
        return $post_array;
    }

    public function get_hidden_columns()
    {
        return array("id");
    }

    public function get_sortable_columns()
    {
        return array(
            "item_code" => array("item_code", false),
            "item_price" => array("item_price", false),
            // "service_price" => array("service_price", false),
        );
    }

    public function get_columns()
    {
        $columns = array(
            "id" => "ID",
            "item_code" => "Item Code",
            "item_price" => "Item_price",
            "avaibale_colors" => "Available Colors",
            //            "service_price" => "Service Price",
        );
        return $columns;
    }

    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'id':
            case 'item_code':
            case 'item_price':
            case 'avaibale_colors':
                return $item[$column_name];
            default:
                return 'No value';
        }
    }

    public function column_item_code($item)
    {

        $action = array(
            // "edit" => "<button class='admin_list_button edit-items' value='" . $item['id'] . "' " . (($item['active'] != 1) ? 'disabled="" title="Please Activate this item first"' : "") . " >Edit</button>",
            //            "deactivate" => (($item['active'] == 1) ? "<button class='admin_list_button deactivate-items' value='" . $item['id'] . "' >Deactivate</button>" : "<button class='admin_list_button enable-items' value='" . $item['id'] . "' >Activate</button>"),
            "delete" => "<button class='admin_list_button delete-items' value='" . $item['id'] . "' >Delete</button>",
        );

        return sprintf('%1$s %2$s', $item['item_code'], $this->row_actions($action));
    }
}

function nr_list_table_layout()
{
    $nr_wp_list_table = new WLVistaShoeList();
    //prepare_items from class
    $nr_wp_list_table->prepare_items();
    // echo '<form method="post" name="frm_search_post" action="' . $_SERVER["PHP_SELF"] . '?page=parking-discount-codes">';
    // $nr_wp_list_table->search_box("Search Codes", "search_box_id");
    // echo '</form>';
    $nr_wp_list_table->display();
}

nr_list_table_layout();
