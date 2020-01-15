<?php
/*
Plugin Name: Resources Post Type
Plugin URI: http://wordpress.org
Description: It is a simple Custom post type for resources for elementsgs
Author: confidential
Version: 1.0
Author URI: #
*/

function resources_custom_post_type() {
 
$labels = array(

		'name' => __( 'Resources' ),
        'singular_name' => __( 'Resources' ),
        'all_items' => __( 'All Resources'),
        'view_item' => __( 'View Resource'), 
        'add_new_item' => __( 'Add Resource '),
        'add_new' => __( 'Add Resource'),
        'edit_item' => __( 'Edit Resource'),
        'update_item' => __( 'Update Resource')         

);

$arys = array(

		'labels' => $labels,
		'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-book-alt',
        'rewrite' => array('slug' => 'resources'),
        'supports' => array( 'title', 'editor', 'excerpt','thumbnail')

);
register_post_type( 'Resources', $arys);
}

add_action('init', 'resources_custom_post_type');

function register_resources_category() {

        /**
         * Taxonomy: Resources Category.
         */

        $labels = [
                "name" => __( "Resources Category"),
                "singular_name" => __( "Resources Category"),
        ];

        $args = [
                "label" => __( "Resources Category"),
                "labels" => $labels,
                "public" => true,
                "publicly_queryable" => true,
                "hierarchical" => true,
                "show_ui" => true,
                "show_in_menu" => true,
                "show_in_nav_menus" => true,
                "query_var" => true,
                "rewrite" => [ 'slug' => 'resources_category', 'with_front' => true, ],
                "show_admin_column" => true,
                "show_in_rest" => true,
                "rest_base" => "resources_category",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "show_in_quick_edit" => true,
                ];
        register_taxonomy( "resources_category", [ "resources" ], $args );
}
add_action( 'init', 'register_resources_category' );

function register_resources_tag() {

        /**
         * Taxonomy: Resources tag.
         */

        $labels = [
                "name" => __( "Resources Tag"),
                "singular_name" => __( "Resources Tag"),
        ];

        $args = [
                "label" => __( "Resources Tag"),
                "labels" => $labels,
                "public" => true,
                "publicly_queryable" => true,
                "hierarchical" => true,
                "show_ui" => true,
                "show_in_menu" => true,
                "show_in_nav_menus" => true,
                "query_var" => true,
                "rewrite" => [ 'slug' => 'resources_tag', 'with_front' => true, ],
                "show_admin_column" => true,
                "show_in_rest" => true,
                "rest_base" => "resources_tag",
                "rest_controller_class" => "WP_REST_Terms_Controller",
                "show_in_quick_edit" => true,
                ];
        register_taxonomy( "resources_tag", [ "resources" ], $args );
}
add_action( 'init', 'register_resources_tag' );