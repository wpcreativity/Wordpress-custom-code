<?php
/**
 * Taxonomy: slider Category.
 * For example - Here, We are creating a custom taxonomy for slider post type.
 * Use this code in functions.php file
 */
function register_slider_category() {

$labels = [
        "name" => "slider Category",
        "singular_name" =>"slider Categories",
];

$args = [
        "label" => "slider Category",
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => [ 'slug' => 'slider_category', 'with_front' => true, ],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "rest_base" => "slider_category",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => true,
        ];
register_taxonomy( "slider_category", [ "slider" ], $args );
}
add_action( 'init', 'register_slider_category' );
?>