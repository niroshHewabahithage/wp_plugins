<?php

class Short_codes {

    public function __construct() {
        
    }

    //common Form - Personal Information Gathering

    function nr_travel_infomation_common() {
        wp_enqueue_style('_nr_common_form', plugins_url('assests/css/common_form.css', __FILE__));
        wp_enqueue_script('_nr_custom_common_form_js', plugins_url("assests/js/common_form.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_common_form_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));

        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/common_form.php');
        return ob_get_clean();
    }

//white_water_rating
    function nr_travel_easy_rafting_for_fam() {
        wp_enqueue_script('_nr_custom_white_water_rafting_js', plugins_url("assests/js/white_wate_rafting.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_white_water_rafting_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/white_wate_rafting.php');
        return ob_get_clean();
    }

    function nr_travel_swiss_alps_rafting() {
        wp_enqueue_script('_nr_custom_white_water_rafting_js', plugins_url("assests/js/white_wate_rafting.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_white_water_rafting_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/white_wate_rafting.php');
        return ob_get_clean();
    }

    function nr_travel_pleasure_sportive() {
        wp_enqueue_script('_nr_custom_white_water_rafting_js', plugins_url("assests/js/white_wate_rafting.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_white_water_rafting_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/white_wate_rafting.php');
        return ob_get_clean();
    }

    function nr_travel_swiss_grand_canyon_r() {
        wp_enqueue_script('_nr_custom_white_water_rafting_js', plugins_url("assests/js/white_wate_rafting.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_white_water_rafting_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/white_wate_rafting.php');
        return ob_get_clean();
    }

    function nr_travel_swiss_grand_canyon_r_not_fam() {
        wp_enqueue_script('_nr_custom_white_water_rafting_js', plugins_url("assests/js/white_wate_rafting.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_white_water_rafting_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/white_wate_rafting.php');
        return ob_get_clean();
    }

    function nr_travel_easy_rafting_along_w() {
        wp_enqueue_script('_nr_custom_white_water_rafting_js', plugins_url("assests/js/white_wate_rafting.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_white_water_rafting_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/white_wate_rafting.php');
        return ob_get_clean();
    }

//bungi Jumping
    function nr_travel_backwards_jump() {
        wp_enqueue_script('_nr_custom_bungi_jumping_js', plugins_url("assests/js/bungi_jumping.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_bungi_jumping_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/bungi_jumping.php');
        return ob_get_clean();
    }

    function nr_travel_speed_jump() {
        wp_enqueue_script('_nr_custom_bungi_jumping_js', plugins_url("assests/js/bungi_jumping.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_bungi_jumping_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/bungi_jumping.php');
        return ob_get_clean();
    }

    function nr_travel_classic_jump() {
        wp_enqueue_script('_nr_custom_bungi_jumping_js', plugins_url("assests/js/bungi_jumping.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_bungi_jumping_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/bungi_jumping.php');
        return ob_get_clean();
    }

    function nr_travel_swiss_alps_bungee_ju() {
        wp_enqueue_script('_nr_custom_bungi_jumping_js', plugins_url("assests/js/bungi_jumping.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_bungi_jumping_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/bungi_jumping.php');
        return ob_get_clean();
    }

//paragliding
    function nr_travel_interlaken_majestic() {
        wp_enqueue_script('_nr_custom_paragliding_js', plugins_url("assests/js/paragliding.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_paragliding_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;

        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/paragliding.php');
        return ob_get_clean();
    }

    function nr_travel_interlaken_majestic_12() {
        wp_enqueue_script('_nr_custom_paragliding_js', plugins_url("assests/js/paragliding.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_paragliding_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;

        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/paragliding.php');
        return ob_get_clean();
    }

    function nr_travel_grindelwald_paraglid() {
        wp_enqueue_script('_nr_custom_paragliding_js', plugins_url("assests/js/paragliding.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_paragliding_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;

        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/paragliding.php');
        return ob_get_clean();
    }

    function nr_travel_lauterbrunnen_valley() {
        wp_enqueue_script('_nr_custom_paragliding_js', plugins_url("assests/js/paragliding.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_paragliding_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;

        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/paragliding.php');
        return ob_get_clean();
    }

    function nr_travel_spiez_paragliding() {
        wp_enqueue_script('_nr_custom_paragliding_js', plugins_url("assests/js/paragliding.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_paragliding_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;

        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/paragliding.php');
        return ob_get_clean();
    }

    function nr_travel_interlaken_paraglidi() {
        wp_enqueue_script('_nr_custom_paragliding_js', plugins_url("assests/js/paragliding.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_paragliding_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;

        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/paragliding.php');
        return ob_get_clean();
    }

//bernina-express

    function nr_travel_whole_day_trip() {
        wp_enqueue_script('_nr_custom_bernina_express_js', plugins_url("assests/js/bernina_express.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_bernina_express_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_desinations = $db_class->get_desinations($short_code);
        $package_name = $get_package_info->package_name;
        $reductions_items = $db_class->get_reductions($short_code);
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/bernina_express.php');
        return ob_get_clean();
    }

    function nr_travel_travel_to_luxurious() {
        wp_enqueue_script('_nr_custom_bernina_express_js', plugins_url("assests/js/bernina_express.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_bernina_express_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_desinations = $db_class->get_desinations($short_code);
        $package_name = $get_package_info->package_name;
        $reductions_items = $db_class->get_reductions($short_code);
        $train_classes = $db_class->get_train_classes();
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/bernina_express.php');
        return ob_get_clean();
    }

    function nr_travel_urban_to_classic_tow() {
        wp_enqueue_script('_nr_custom_bernina_express_js', plugins_url("assests/js/bernina_express.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_bernina_express_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_desinations = $db_class->get_desinations($short_code);
        $package_name = $get_package_info->package_name;
        $reductions_items = $db_class->get_reductions($short_code);

        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/bernina_express.php');
        return ob_get_clean();
    }

//Jungfrau Travel pass

    function nr_travel_connecting_pass_from() {
        wp_enqueue_script('_nr_custom_junfrau_tavel_pass_js', plugins_url("assests/js/junfrau_tavel_pass.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_junfrau_tavel_pass_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        $package_desinations = $db_class->get_desinations($short_code);
        $reductions_items = $db_class->get_reductions($short_code);
        $train_classes = $db_class->get_train_classes();
        $get_age_limit = $db_class->get_age_set();

        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/junfrau_tavel_pass.php');
        return ob_get_clean();
    }

    function nr_travel_connecting_pass_frommajoir() {
        wp_enqueue_script('_nr_custom_junfrau_tavel_pass_js', plugins_url("assests/js/junfrau_tavel_pass.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_junfrau_tavel_pass_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        $package_desinations = $db_class->get_desinations($short_code);
        $reductions_items = $db_class->get_reductions($short_code);
        $train_classes = $db_class->get_train_classes();
        $get_age_limit = $db_class->get_age_set();

        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/junfrau_tavel_pass.php');
        return ob_get_clean();
    }

    function nr_travel_connecting_pass_from_begining() {
        wp_enqueue_script('_nr_custom_junfrau_tavel_pass_js', plugins_url("assests/js/junfrau_tavel_pass.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_junfrau_tavel_pass_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        $package_desinations = $db_class->get_desinations($short_code);
        $reductions_items = $db_class->get_reductions($short_code);
        $train_classes = $db_class->get_train_classes();
        $get_age_limit = $db_class->get_age_set();

        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/junfrau_tavel_pass.php');
        return ob_get_clean();
    }

//Glazier Express
    function nr_lw_travel_glazier_express() {
        wp_enqueue_script('_nr_custom_junfrau_tavel_pass_js', plugins_url("assests/js/junfrau_tavel_pass.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_junfrau_tavel_pass_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        $package_desinations = $db_class->get_desinations($short_code);
        $reductions_items = $db_class->get_reductions($short_code);
        $train_classes = $db_class->get_train_classes();
        $get_age_limit = $db_class->get_age_set();

        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/glazier_express.php');
        return ob_get_clean();
    }

//swiss travel pass
    function nr_travel_swiss_travel_pass() {
        wp_enqueue_script('_nr_custom_swiss-travel-pass_js', plugins_url("assests/js/swiss_travel_pass.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_swiss-travel-pass_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/swiss_travel_pass.php');
        return ob_get_clean();
    }

//Goldenpass Panorama Express

    function nr_travel_laucerne_interlaken() {
        wp_enqueue_script('_nr_custom_goldern_panorama_express_js', plugins_url("assests/js/goldern_panorama_express.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_goldern_panorama_express_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        $reductions_items = $db_class->get_reductions($short_code);
        $package_desinations = $db_class->get_desinations($short_code);
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/goldern_panorama_express.php');
        return ob_get_clean();
    }

//Stanserhorn CabriO Cable car
    function nr_travel_stanserhorn_cabrio_() {
        wp_enqueue_script('_nr_custom_goldern_panorama_express_js', plugins_url("assests/js/goldern_panorama_express.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_goldern_panorama_express_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        $reductions_items = $db_class->get_reductions($short_code);
        $package_desinations = $db_class->get_desinations($short_code);
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/goldern_panorama_express.php');
        return ob_get_clean();
    }

    function nr_travel_interlaken_montreux() {
        wp_enqueue_script('_nr_custom_goldern_panorama_express_js', plugins_url("assests/js/goldern_panorama_express.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_goldern_panorama_express_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        $reductions_items = $db_class->get_reductions($short_code);
        $package_desinations = $db_class->get_desinations($short_code);
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/goldern_panorama_express.php');
        return ob_get_clean();
    }

    function nr_travel_interlaken_lucerne_e() {
        wp_enqueue_script('_nr_custom_goldern_panorama_express_js', plugins_url("assests/js/goldern_panorama_express.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_goldern_panorama_express_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        $reductions_items = $db_class->get_reductions($short_code);
        $package_desinations = $db_class->get_desinations($short_code);
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/goldern_panorama_express.php');
        return ob_get_clean();
    }

    function nr_travel_montreux_interlaken() {
        wp_enqueue_script('_nr_custom_goldern_panorama_express_js', plugins_url("assests/js/goldern_panorama_express.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_goldern_panorama_express_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        $reductions_items = $db_class->get_reductions($short_code);
        $package_desinations = $db_class->get_desinations($short_code);
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/goldern_panorama_express.php');
        return ob_get_clean();
    }

//Gelmerbahn steepest funicular
    function nr_travel_gelmerbahn_steepest() {
        wp_enqueue_script('_nr_custom_gelmerbahn-steepest_js', plugins_url("assests/js/gelmerbahn-steepest.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_gelmerbahn-steepest_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        $reductions_items = $db_class->get_reductions($short_code);
        $package_desinations = $db_class->get_desinations($short_code);
        $get_age_limit = $db_class->get_age_set();
        $train_classes = $db_class->get_train_classes();
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/gelmerbahn-steepest.php');
        return ob_get_clean();
    }

//swiss Smart Travel Pass
    function nr_travel_swiss_smart_travel_p() {
        wp_enqueue_script('_nr_custom_swiss_smart_travel_p_js', plugins_url("assests/js/swiss_smart_travel_p.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_swiss_smart_travel_p_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;
        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        $train_classes = $db_class->get_train_classes();
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/swiss_smart_travel_p.php');
        return ob_get_clean();
    }

//plan your trip 
    function nr_lw_travel_plan_ur_trip() {
        $db_class = new Db_functions;
        $get_activities = $db_class->get_activities();
        $get_locations = $db_class->get_locations();
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/plan_your_trip.php');
        return ob_get_clean();
    }

    //single page with param 
    function nr_single_item_with_param($param) {
        $short_code_value = (isset($param['s_code']) ? $param['s_code'] : '');

        wp_enqueue_style('_nr_common_form', plugins_url('assests/css/common_form.css', __FILE__));
        wp_enqueue_script('_nr_custom_common_form_js', plugins_url("assests/js/common_form.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_common_form_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));

        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/common_form.php');
        return ob_get_clean();
    }

    //stoosbahn
    function nr_travel_stoosbahn($param) {
        echo '<pre>';
        print_r($param);
        echo '</pre>';
        
        wp_enqueue_script('_nr_custom_goldern_panorama_express_js', plugins_url("assests/js/goldern_panorama_express.js", __FILE__), array('jquery'), 1.1, true);
        wp_localize_script('_nr_custom_goldern_panorama_express_js', 'the_ajax_script', array('ajaxurl' => admin_url('admin-ajax.php')));
        $db_class = new Db_functions;

        $short_code = (isset($_GET['sc']) ? $_GET['sc'] : '');
        $get_package_info = $db_class->get_package__details($short_code);
        $package_name = $get_package_info->package_name;
        $reductions_items = $db_class->get_reductions($short_code);
        $package_desinations = $db_class->get_desinations($short_code);
        ob_start();
        include (plugin_dir_path(__FILE__) . '../templates/front/templates/goldern_panorama_express.php');
        return ob_get_clean();
    }

    //btn short_codes
    function nr_lw_travel_button() {
        ob_start();
        echo '<a target="blank" href="' . home_url('data-forms?sc=swiss-travel-pass') . '"><button class="pack-btn" value="' . get_field('item_access_values') . '">Select this package</button></a>';
        return ob_get_clean();
    }

    function nr_lw_travel_gelmerbahn_steepest_funicula() {
        ob_start();
        echo '<a target="blank" href="' . home_url('data-forms?sc=gelmerbahn-steepest-') . '"><button class="pack-btn" value="' . get_field('item_access_values') . '">Select this package</button></a>';
        return ob_get_clean();
    }

    function nr_lw_travel_stanserhorn_cabrio() {
        ob_start();
        echo '<a target="blank" href="' . home_url('data-forms?sc=stanserhorn-cabrio-c') . '"><button class="pack-btn" value="' . get_field('item_access_values') . '">Select this package</button></a>';
        return ob_get_clean();
    }

    function nr_lw_travel__stoosbahn_btn_select() {
        ob_start();
        echo '<a target="blank" href="' . home_url('data-forms?sc=stoosbahn') . '"><button class="pack-btn" value="' . get_field('item_access_values') . '">Select this package</button></a>';
        return ob_get_clean();
    }

    function nr_travel_btn_plan_your_trip() {
        ob_start();
        echo '<a target="blank" href="' . home_url('data-forms?sc=nr_lw_plan_ur_trip') . '"><button class="pack-btn" value="' . get_field('item_access_values') . '">Plan Your Trip</button></a>';
        return ob_get_clean();
    }

    function nr_lw_travel__smart_trvel_pass_button() {
        ob_start();
        echo '<a target="blank" href="' . home_url('data-forms?sc=swiss-smart-travel-p') . '"><button class="pack-btn" value="' . get_field('item_access_values') . '">Select this package</button></a>';
        return ob_get_clean();
    }

    function nr_lw_travel___glazier_xerpress() {
        ob_start();
        echo '<a target="blank" href="' . home_url('data-forms?sc=glazier-express') . '"><button class="pack-btn" value="' . get_field('item_access_values') . '">Select this package</button></a>';
        return ob_get_clean();
    }

}
