<?php
/*  return 'This is a sample of a shorcode!';  //funvtion looks for the post ['job_listing'] and executes
  echo 'this is a bad sample of a shortcode'; //echo will missplace function content to the top of post content.
  return '<h1>Title sample of html element in shortcode</h1>';
  */
function um_apartments_manager_taxonomy_list() {


}

add_shortcode('job_listing', 'um_apartments_manager_taxonomy_list');
