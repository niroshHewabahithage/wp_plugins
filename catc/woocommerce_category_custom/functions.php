<?php

/*
  Plugin Name: Woocommerce Category Custom
  Plugin URI: http://weblankan.com
  Description: This Plugin Will be add filters to the product categories and some other function
  Version: 1.0
  Author: Nirosh Randimal
  Author URI: www.linkedin.com/in/nirosh-randimal-331598146
  License: GPL2
 */
global $site_url;

$site_url = "http://www.catc.lk/";
add_filter('woocommerce_product_categories_widget_dropdown_args', 'rv_exclude_wc_widget_categories');

add_filter('woocommerce_product_categories_widget_args', 'rv_exclude_wc_widget_categories');

function rv_exclude_wc_widget_categories($cat_args) {
    $category_list = "";
    $category = get_queried_object();


    $taxonomy = 'product_cat';

    $parent_product_cats = get_terms($taxonomy, array('parent' => 0, 'orderby' => 'slug', 'hide_empty' => false));

    foreach ($parent_product_cats as $product_cat_obj) {
        $term_id = $product_cat_obj->term_id; // term ID
//        print_r($term_id);
        if ($category->parent != $term_id) {
            if ($term_id != 15) {
                $category_list .= "$term_id";
            }
        } else {
            
        }
    }

    $cat_args['exclude'] = array($category_list, "15"); // Insert the product category IDs you wish to exclude
    return $cat_args;
}

remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

//    custom-category

add_shortcode('custom-category', 'nr_wl_woocommerce_custom_product_categoies');

function nr_wl_woocommerce_custom_product_categoies() {
    global $site_url;
    $taxonomy = 'product_cat';
    $orderby = 'name';
    $show_count = 0;      // 1 for yes, 0 for no
    $pad_counts = 0;      // 1 for yes, 0 for no
    $hierarchical = 1;      // 1 for yes, 0 for no  
    $title = '';
    $empty = 0;

    $args = array(
        'taxonomy' => $taxonomy,
        'orderby' => $orderby,
        'show_count' => $show_count,
        'pad_counts' => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li' => $title,
        'hide_empty' => $empty
    );
    $all_categories = get_categories($args);
    $footer_categories .= "<h4 style='color:#fff;font-size:20px;border-bottom:2px solid #545454;padding-bottom:10px;'>Product categories</h4><ul style='list-style: none;'>";
    foreach ($all_categories as $cat) {
        if ($cat->category_parent == 0) {
            $category_id = $cat->term_id;
            if ($category_id != 15) {
                $footer_categories .= "<a href='$site_url.products/$cat->slug'><li style='color: #fff;font-size: 16px;'>$cat->name &nbsp;<b style='font-size: 20px;'>&#8250;</b></li></a>";
            }
        }
    }
    $footer_categories .= "</ul>";
    echo $footer_categories;
}
