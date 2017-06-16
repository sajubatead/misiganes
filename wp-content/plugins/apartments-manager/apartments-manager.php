<?php
/*
Plugin Name: Apartments manager
Plugin URI:  https://developer.wordpress.org/plugins/unique-plugin
Description: Apartments managing plugin
Version:     1.0
Author:      Sergio
Author URI:  https://developer.wordpress.org/sergio
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: apartments-manager
*/

//Exit if accessed directly
if ( ! defined('ABSPATH')) {
  exit;
}

$dir = plugin_dir_path(__FILE__);
require_once (  $dir . 'apartments-manager-custompost.php');
require_once ( $dir . 'apartments-manager-render-admin.php');
require_once ( $dir . 'apartment-one.php');

function fa_questions_plugin_main() {  //Import Plugin Scripts
global $pagenow, $typenow; //get the post type

if( $typenow == 'faq_question'){

  wp_enqueue_style('um-admin-css', plugins_url('css/admin-apartments.css', __FILE__) );// unique name, and source, and dependency

}

if( ($pagenow == 'post.php' || $pagenow= 'post-new.php') && $typenow == 'faq_question' ) { //if pages exist(post edit screen, post type screen) then on those screens load plugin's scripts
  wp_enqueue_script( 'admin-js', plugins_url( 'js/admin-js.js', __FILE__ ), array( 'jquery', 'jquery-ui-datepicker' ), '20150204', true );
  wp_enqueue_script( 'admin-custom-quicktags', plugins_url( 'js/admin-quicktags.js', __FILE__ ), array( 'quicktags' ), '20150206', true );
  wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );}

  if( $pagenow == 'post-new.php' && $typenow == 'faq_question'){  ///////////////////////////////////////////post-new??//////////////
        		wp_enqueue_script( 'reorder-js', plugins_url( 'js/reorder.js', __FILE__ ), array( 'jquery', 'jquery-ui-sortable' ), '20150626', true );
            wp_localize_script( 'my-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
            wp_localize_script('reorder-js', 'WP_JOB_LISTING', array(  //pass wordpress strings and url data to scripts
              'security' => wp_create_nonce( 'wp-job-order' ), //apartment one is refering to this nonce
              'success' => __( 'Jobs sort order has been saved.' ),
              'failure' => __( 'There was an error saving the sort order, or you do not have proper permissions.' )
            ));
}
}
add_action('admin_enqueue_scripts','fa_questions_plugin_main');
