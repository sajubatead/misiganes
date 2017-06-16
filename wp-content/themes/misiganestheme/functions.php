<?php

function misIganesTheme_resources() {
  wp_enqueue_style ('screen', get_template_directory_uri() . '/css/screen.css');
  wp_enqueue_style('style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'misIganesTheme_resources');


//NAV mmenus

register_nav_menus(array(
  'primary' => __('Primary Menu'),
  'footer' => __('Footer Menu')
))

 ?>
