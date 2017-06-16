<?php


add_action( 'pre_get_posts', 'event_column_orderby' );

function event_column_orderby( $query ) {
    if( ! is_admin() )
        return;

    $orderby = $query->get( 'orderby');

    if( 'status' == $orderby ) {
        $query->set('meta_key','apartment_status');
        $query->set('orderby','meta_value');
    }
}

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



//ADD ADMIN TOP-BAR LINKS
function um_apartments_manager_toolbar_links() {

  global $wp_admin_bar;

  $wp_admin_bar->add_menu(array(
    'id' => 'uusmaa_link',
    'title' => 'Uusmaa',
    'href' => 'http://www.uusmaa.ee/'
  ));
}

add_action('wp_before_admin_bar_render', 'um_apartments_manager_toolbar_links');



//REMOVE EDITOR STATUS BAR ENTIRELY
function my_theme_add_editor_styles(){
    ?>
        <style type="text/css">
            .mce-path   {display: none!important;}
        </style>
    <?php
}
add_action( 'admin_head', 'my_theme_add_editor_styles' );





//custom columns for custom post type

add_filter( 'manage_apartments_listing_posts_columns', 'apartment_list_columns' );
add_action( 'manage_apartments_listing_posts_custom_column' , 'custom_apartment_list_column', 10,2 );

//////////Sortable Floors

add_filter( 'manage_edit-movie_sortable_columns', 'my_movie_sortable_columns' );

function my_movie_sortable_columns( $columns ) {

	$columns['floors'] = 'duration';

	return $columns;
}


function apartment_list_columns($columns) {
    unset( $columns['author'] );
    unset( $columns['date']);
    $columns['status'] = __( 'Status', 'custom_column_title' );
    $columns['title'] = __('Apartment Number', 'custom_column_title');
    $columns['location'] = __('Apartment Adress', 'custom_column_title');
    $columns['floor'] = __('Apartment Floor', 'custom_column_title');
    $columns['rooms'] = __('Apartment Rooms', 'custom_column_title');
    $columns['balcony'] = __('Apartment Balcony', 'custom_column_title');
    $columns['terrace'] = __('Apartment Terrace', 'custom_column_title');
    $columns['area'] = __('Apartment Area', 'custom_column_title');
    $columns['price'] = __('Apartment Price', 'custom_column_title');
    return $columns;
}


function custom_apartment_list_column( $column) {
  global $post;

    switch ( $column ) {
      /* If displaying the 'genre' column. */
  		case 'location' :
  			/* Get the genres for the post. */
  			$terms = get_the_terms( $post->ID, 'location' );
  			/* If terms were found. */
  			if ( !empty( $terms ) ) {
  				$out = array();
  				/* Loop through each term, linking to the 'edit posts' page for the specific term. */
  				foreach ( $terms as $term ) {
  					$out[] = sprintf( '<a href="%s">%s -%s</a>',
  						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'location' => $term->slug ), 'edit.php' ) ),
  						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'location', 'display' ) ),
              esc_html( sanitize_text_field(get_the_title($post->ID) ) )
  					);
  				}
  				/* Join the terms, separating them with a comma. */
  				echo join( ', ', $out );
  			}
  			/* If no terms were found, output a default message. */
  			else {
  				_e( 'No Genres' );
  			}
        break;
        case 'status' :
            echo get_post_meta( $post->ID , 'apartment_status' , true ); // postID, Key, Whether to return a single value
            break;
        case 'floor' :
          echo get_post_meta( $post->ID, 'apt_floors', true);
        break;
        case 'rooms' :
          echo get_post_meta( $post->ID, 'apt_rooms', true);
        break;
        case 'balcony' :
          echo get_post_meta( $post->ID, 'apt_balcony', true);
        break;
        case 'terrace' :
          echo get_post_meta( $post->ID, 'apt_terrace', true);
        break;
        case 'area' :
          echo get_post_meta( $post->ID, 'apt_area', true);
        break;
        case 'price' :
          echo get_post_meta( $post->ID, 'apt_price', true);
        break;
    }
}
