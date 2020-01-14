<?php
  $nav_menu = array(
        'theme_location'  =>'primary',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'collapse navbar-collapse',
		'container_id'    => 'navbarNavDropdown',
        'menu_class'      => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'items_wrap'      => '<ul class="navbar-nav">%3$s</ul>',
        'depth' => 5,
        'walker' => new wp_bootstrap_navwalker()
  );
  wp_nav_menu($nav_menu);

  //add class in a tag on wp_menu
  add_filter( 'nav_menu_link_attributes', function($atts) {
          $atts['class'] = "nav-link";
          return $atts;
  }, 100, 1 );

  //add class in li tag on wp_menu
  function add_menu_class_on_li($classes, $item, $args) {
    if($args->theme_location == 'primary') {
      $classes[] = 'nav-item';
    }
    return $classes;
  }
  add_filter('nav_menu_css_class', 'add_menu_class_on_li', 1, 3);

?> 