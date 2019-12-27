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



//Custom post type with all labels and menus
function services_post_type() {

        $labels = array(
                'name'                  => 'Services',
                'singular_name'         => 'Services',
                'menu_name'             => 'Services',
                'name_admin_bar'        => 'Post Type',
                'archives'              => 'Item Archives',
                'attributes'            => 'Item Attributes',
                'parent_item_colon'     => 'Parent Item:',
                'all_items'             => 'All Items',
                'add_new_item'          => 'Add New Item',
                'add_new'               => 'Add New',
                'new_item'              => 'New Item',
                'edit_item'             => 'Edit Item',
                'update_item'           => 'Update Item',
                'view_item'             => 'View Item',
                'view_items'            => 'View Items',
                'search_items'          => 'Search Item',
                'not_found'             => 'Not found',
                'not_found_in_trash'    => 'Not found in Trash',
                'featured_image'        => 'Featured Image',
                'set_featured_image'    => 'Set featured image',
                'remove_featured_image' => 'Remove featured image',
                'use_featured_image'    => 'Use as featured image',
                'insert_into_item'      => 'Insert into item',
                'uploaded_to_this_item' => 'Uploaded to this item',
                'items_list'            => 'Items list',
                'items_list_navigation' => 'Items list navigation',
                'filter_items_list'     => 'Filter items list',
        );
        $args = array(
                'label'                 => 'Services',
                'description'           => 'Post Type Description',
                'labels'                => $labels,
                'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
                'taxonomies'            => array( 'category', 'post_tag' ),
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_menu'          => true,
                'menu_position'         => 31,
                'show_in_admin_bar'     => true,
                'show_in_nav_menus'     => true,
                'can_export'            => true,
                'has_archive'           => true,
                'menu_icon' => 'dashicons-smiley',
                'exclude_from_search'   => false,
                'publicly_queryable'    => true,
                'capability_type'       => 'page',
        );
        register_post_type( 'post_type_services', $args );

}
add_action( 'init', 'services_post_type', 0 ); 
?>