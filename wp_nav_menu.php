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
?> 