<?php

require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
require_once(plugin_dir_path(__FILE__) . 'Db_functions.php');

class DiscountSalesItems extends WP_List_Table {

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
        $param_array = array(
            "order_by" => $orderby,
            "order" => $order,
            "search_term" => $search_term,
        );
        if (!empty($search_term)) {
            $all_posts = $db_data->get_all_dsicounted($param_array);
        } else {
            if ($orderby != "" && $order != "") {
                $all_posts = $db_data->get_all_dsicounted($param_array);
            } else {
                $all_posts = $db_data->get_all_dsicounted();
            }
        }


        $locale = 'en-US'; //browser or user locale
        $currency = 'GBP';
        $fmt = new NumberFormatter($locale . "@currency=$currency", NumberFormatter::CURRENCY);
        $symbol = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);

        $post_array = array();
        if (count($all_posts) > 0) {
            foreach ($all_posts as $index => $discount) {
                $post_array[] = array(
                    "id" => $discount->id,
                    "customer_name" => (isset($discount->first_name) ? $discount->first_name : '') . " " . (isset($discount->last_name) ? $discount->last_name : ''),
                    "dicounted_amount" => (isset($discount->dicounted_amount) ? $symbol . " " . number_format($discount->dicounted_amount, 2) : '') . " " . (isset($discount->percentage) ? "<span class='discount_show_span'>Discount (" . $discount->percentage . "%)</span>" : ''),
                    "dicounted_percentage" => (isset($discount->dicounted_amount) ? $symbol . " " . number_format($discount->dicounted_amount, 2) : ''),
                    "final_price" => (isset($discount->final_price) ? $symbol . " " . number_format($discount->final_price, 2) : ''),
                    "actual_price" => (isset($discount->actual_price) ? $symbol . " " . number_format($discount->actual_price, 2) : ''),
                    "address" => (($discount->address != "" || $discount->city != "" || $discount->postal_code != "") ? (isset($discount->address) ? $discount->address . ", " : '') . " " . (isset($discount->city) ? $discount->city . ", " : '') . " " . (isset($discount->postal_code) ? $discount->postal_code . "." : '') : 'Address Not Found'),
                    "discount_code" => (isset($discount->discount_code) ? (($discount->active == 1) ? "<span title='Currently Active'>" . $discount->discount_code . "</span>" : "<span title='Currently Disabled' class='span-red'>" . $discount->discount_code) . "</span>" : ''),
                    "percentage" => (isset($discount->percentage) ? $discount->percentage : ''),
                    "payment_status" => (isset($discount->payment_status) ? $discount->payment_status : ''),
                    "email" => (isset($discount->email) ? $discount->email : ''),
                    "mobile_no" => (isset($discount->mobile_no) ? $discount->mobile_no : ''),
                    "drop_off_date_time" => (isset($discount->drop_off_date) ? $discount->drop_off_date : '') . " " . (isset($discount->drop_off_time) ? $discount->drop_off_time : ''),
                    "return_date_time" => (isset($discount->return_date) ? $discount->return_date : '') . " " . (isset($discount->return_time) ? $discount->return_time : ''),
                    "booking_created" => (isset($discount->book_datetime) ? $discount->book_datetime : ''),
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
            "discount_code" => array("discount_code", false),
            "customer_name" => array("first_Name", false),
            "mobile_no" => array("mobile_no", false),
            "email" => array("email", false),
            "actual_price" => array("actual_price", false),
            "final_price" => array("final_price", false),
        );
    }

    public function get_columns() {
        $columns = array(
            "id" => "ID",
            "customer_name" => "Customer Name",
            "email" => "Email",
            "mobile_no" => "Mobile No",
            "discount_code" => "Discount Code",
            "drop_off_date_time" => "Drop off Date Time",
            "return_date_time" => "Return off Date Time",
//            "booking_created" => "Booked Date",
            "actual_price" => "Initial Price",
            "dicounted_amount" => "Discount Price",
            "final_price" => "Final Price",
            "payment_status" => "Payment Status",
        );
        return $columns;
    }

    public function column_default($item, $column_name) {
        switch ($column_name) {
            case 'id':
            case 'customer_name':
            case 'email':
            case 'mobile_no':
            case 'discount_code':
            case 'drop_off_date_time':
            case 'return_date_time':
//            case 'booking_created':
            case 'actual_price':
            case 'dicounted_amount':
            case 'final_price':
            case 'payment_status':
                return $item[$column_name];
            default :
                return 'No value';
        }
    }

//    public function column_discount_code($item) {
////        $disbled = ;
//        $action = array(
//            "edit" => "<button class = 'admin_list_button edit-items' value = '" . $item['id'] . "' " . (($item['active'] != 1) ? 'disabled="" title="Please Activate this item first"' : "" ) . " >Edit</button>",
//            "deactivate" => (($item['active'] == 1) ? "<button class = 'admin_list_button deactivate-items' value = '" . $item['id'] . "' >Deactivate</button>" : "<button class = 'admin_list_button enable-items' value = '" . $item['id'] . "' >Activate</button>"),
//            "delete" => "<button class = 'admin_list_button delete-items' value = '" . $item['id'] . "' >Delete</button>",
//        );
//
//        return sprintf('%1$s %2$s', $item['discount_code'], $this->row_actions($action));
//    }
//get_colomns    
//column_default
}

function nr_list_table_layout() {
    $nr_wp_list_table = new DiscountSalesItems();


//prepare_items from class
    $nr_wp_list_table->prepare_items();
    echo '<form method="post" name="frm_search_post" action="' . $_SERVER["PHP_SELF"] . '?page=discount-purchases">';
    $nr_wp_list_table->search_box("Search Codes", "search_box_id_2");
    echo '</form>';
    $nr_wp_list_table->display();
}

nr_list_table_layout();


