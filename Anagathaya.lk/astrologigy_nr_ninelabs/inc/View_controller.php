<?php

class View_controller extends My_controller {

    public function __construct() {
        
    }

    function nr_nl_services() {
        wp_enqueue_script('_nr_lw_service_manage_js', plugins_url("assests/js/service_manage.js", __DIR__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_lw_service_manage_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        ob_start();
        include_once plugin_dir_path(__FILE__) . '/class-service-list-list.php';
        $template = ob_get_contents();
        ob_end_clean();
        include plugin_dir_path(__DIR__) . 'views/admin/services/layout.php';
    }

    function nr_lw_home_list() {
        
    }

    function nr_lw_attributes_list() {
        
    }

    function nr_lw_sub_attributes_list() {
        
    }

}
