<?php
class View_Controller extends Core_controller
{
    public function __construct()
    {
    }


    public function wl_dealer_items()
    {
        global $db_c;
        wp_enqueue_script('_nr_lw_item_management_js', plugins_url("assests/js/item_management.js", __DIR__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_lw_item_management_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        ob_start();
        include_once plugin_dir_path(__FILE__) . '/tables/class-item-list.php';
        $template = ob_get_contents();
        ob_end_clean();

        $colors_lists = $db_c->get_all("shoe_colors", 1);
        include plugin_dir_path(__DIR__) . 'views/admin/items/layout.php';
    }

    public function _wl_dealer_front_form()
    {
        global $db_c;
        wp_enqueue_script('_nr_lw_dealer_items_js', plugins_url("assests/js/dealer_items.js", __DIR__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_lw_dealer_items_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));

        $items_ = $db_c->get_all("items", "1");
        
        include plugin_dir_path(__DIR__) . 'views/front/items_dealers/layout.php';
    }
}
