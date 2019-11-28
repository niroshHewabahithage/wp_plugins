<?php

class View_controller extends My_controller {

    public function __construct() {
        
    }

    function nr_lw_attributes() {
        wp_enqueue_script('_nr_lw_custom_attributes_js', plugins_url("assests/js/attribute_manage.js", __DIR__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_lw_custom_attributes_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        include plugin_dir_path(__DIR__) . 'views/admin/attributes/layout.php';
    }

    function nr_lw_home_list() {
        
    }

    function nr_lw_attributes_list() {
        
    }

    function nr_lw_sub_attributes_list() {
        
    }

}
