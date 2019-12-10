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

    function nr_nl_service_users() {
        wp_enqueue_script('_nr_lw_new_users_js', plugins_url("assests/js/new_users.js", __DIR__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_lw_new_users_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_c = new Db_functions;
        $get_services = $db_c->get_all("services");
//        $user_id = wp_create_user("nirosh", "nirosh123");
//        if (is_wp_error($user_id)) {
//            echo $user_id->get_error_message();
//        } else {
//            //add into custom table
//            echo $user_id;
//            update_user_meta($user_id, "first_name", 'Nirosh');
//            update_user_meta($user_id, "last_name", 'Randimal');
//        }
        include plugin_dir_path(__DIR__) . 'views/admin/users/layout.php';
    }

}
