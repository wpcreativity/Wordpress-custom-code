<?php 
/*
* Create custom post type
* For example - we need to create a custom post type for slider.
* Use this code in functions.php file
*/
function slider_custom_post_type() {
 
$labels = array(

	'name' => __( 'slider' ),
        'singular_name' => __( 'slider' ),
        'all_items' => __( 'All slider'),
        'view_item' => __( 'View slider'), 
        'add_new_item' => __( 'Add slider '),
        'add_new' => __( 'Add slider'),
        'edit_item' => __( 'Edit slider'),
        'update_item' => __( 'Update slider')         

);

$arys = array(

	'labels' => $labels,
	'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-book-alt',
        'rewrite' => array('slug' => 'slider'),
        'supports' => array( 'title', 'editor', 'excerpt','thumbnail')

);
        register_post_type( 'slider', $arys);
}

add_action('init', 'slider_custom_post_type');
?>