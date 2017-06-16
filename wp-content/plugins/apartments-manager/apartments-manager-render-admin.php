<?php

//REMOVE WIDGETS ON DASHBOARD
  function um_apartments_manager_dashboard_widgets() {
      global $wp_meta_boxes;
      unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
      unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
      unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
      unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
      unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
      unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_comments']);
      unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
      unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
      unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_right_now']);
      unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
  }

    add_action('wp_dashboard_setup', 'um_apartments_manager_dashboard_widgets' );



//ADD ADMIN BAR LINKS
function um_apartments_manager_toolbar_links() {

  global $wp_admin_bar;

  $wp_admin_bar->add_menu(array(
    'id' => 'uusmaa_link',
    'title' => 'Uusmaa',
    'href' => 'http://www.uusmaa.ee/'
  ));
}

add_action('wp_before_admin_bar_render', 'um_apartments_manager_toolbar_links');
