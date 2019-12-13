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
        include plugin_dir_path(__DIR__) . 'views/admin/users/layout.php';
    }

    function my_show_extra_profile_fields($user) {
        wp_enqueue_script('_nr_lw_new_users_js', plugins_url("assests/js/new_users.js", __DIR__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_lw_new_users_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_c = new Db_functions;
        $get_services = $db_c->get_all("services");
        $get_select_services = $db_c->get_all_services_selected("service_map", "id_service", "is_user", $user->ID);
        $item_array = [];
        if (isset($get_select_services) && !empty($get_select_services) && $get_select_services != "") {
            foreach ($get_select_services as $gss) {
                array_push($item_array, [$gss->id_service]);
            }
        }

        include plugin_dir_path(__DIR__) . 'views/admin/users/templates/edit_user.php';
    }

}
