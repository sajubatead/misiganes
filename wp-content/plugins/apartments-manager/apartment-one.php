<?php

function um_add_submenu_page() {
/*$parent_slug='edit.php?post_type=apartments_listing';
$page_title=__('Apartment One');
$menu_title=__('Apartment One');
$capability='manager_options';
$menu_slug='apartment_one';
$function='apartment_admin_callback';
*/
	add_submenu_page(
		'edit.php?post_type=faq_question',
		__( 'FAQ Order' ),
		__( 'FAQ Order' ),
		'manage_options',
		'faq_order',
		'fa_questions_plugin_callback'
	);
};

add_action('admin_menu', 'um_add_submenu_page');



function fa_questions_plugin_callback() {
 global $typenow;
 global $pagenow;
  $args= array(
    'post_type' => 'faq_question', //Custom post type name
      'orderby' => 'menu_order',  //Order of creation or custom order
      'order' =>  'ASC', //order A decending order
      'post_status' => 'publish', //Query only posts published not drafts
      'no_found_rows' => true,  //Wp second query, how many post were queried- currently deactivated
      'update_post_term_cache' => true,  //currently no using any taxonomy data, so its false --------------------------
      'post_per_page' => 15,
			
      /*
      'tax_query' => array(
  array(
    'taxonomy' => 'apartment_one',
    'field'    => 'harjapea-arendus',
    'terms'    => 'harjapea',
  ),
),
*/
  );
   $faq_question = new WP_Query( $args );
   /*
   ECHO DB DATA OF THE QUERY
   echo '<pre>';
   var_dump( $faq_question -> get_posts() );
   echo '</pre>';
   */

?>
<div id="job-sort" class="wrap">
		<div id="icon-job-admin" class="icon32"><br /></div>
		  <h2><?php _e( 'Sort Job Positions', 'wp-job-listing' ); ?>
        <img src="<?php echo esc_url( admin_url() . '/images/loading.gif' ); ?>" id="loading-animation"></h2>
			     <?php if ( $faq_question->have_posts() ) : ?>
				         <p><?php _e('<strong>Note:</strong> this only affects the Jobs listed using the shortcode functions', 'wp-job-listing'); ?></p>
				            <ul id="custom-type-list">
					            <?php while ( $faq_question->have_posts() ) : $faq_question->the_post(); ?>
						             <li id="<?php esc_attr( the_id() ); ?>"><?php esc_html( the_title() ); ?></li>
					              <?php endwhile; ?>
				               </ul>
			                <?php else: ?>
				             <p><?php _e( 'You have no Jobs to sort.', 'wp-job-listing' ); ?></p>
			             <?php endif; ?>
	               </div>

<?php
}
//SAVE ORDER OF THE LIST
function um_save_order() {
	if (!	check_ajax_referer( 'wp-job-order', 'security' )) {  // aparments-manager security nonce, which is passed to reorder ajax security.
		return wp_send_json_error(' Invalid nonce'); //Send json response to ajax request(sucess value equal to false)
	}//if nonce is not valid, or is not comeing from refered input

	if (! current_user_can( 'manage_options')) {  //if user has capabilities to use this function
		return wp_send_json_error( 'You are not allowed to do this.');
	}

	$order = $_POST['order']; //$_POST super global var for ajax request built in php(currently consist security: order: in reorder.js)
	$counter = 0;  // loop through array starting each item in position of 0


//FOR LOOP
	foreach( $order as $item_id ) {
		$post = array(
		'ID' => (int)$item_id,  //int will print always number
		'menu_order' => $counter,  // order that item is at the moment function runs
	);
		wp_update_post($post);  //it can be anything that is saveable to a post as like title
		$counter++; //every time loop runs(item changed its value), passing id to array with index 1
	}
	wp_send_json_success( 'Post Saved.'); //once we reach this point, post is saved.
}
add_action( 'wp_ajax_save_sort', 'um_save_order' );  //link to ajax request in reorder.js (action:save_sort = wp_ajax_save_sort)
