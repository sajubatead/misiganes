<?php



function um_apartments_manager_metabox(){
  add_meta_box(
    'um_metabox',           //Metabox element ID
    __('Apartment Details'),  // Any given name will be displayed on front end of dashboard
    'um_meta_callback',   //function rendering input fields to the front end for insertion of data
    'apartments_listing',  //function um_apartments_manager_post_type()- under wp-menu-name(admin sidebar)
    'normal',  //sidebar, normal, or advanced display
    'core'  //in priority
);
}

 add_action('add_meta_boxes', 'um_apartments_manager_metabox');


 function um_meta_callback( $post ) {  //Acess to post id-s from the DB   ----   <!--query all the data from the db, post named ID(key) for dislpaying in the frontend -->
 	wp_nonce_field( basename( __FILE__ ), 'um_apartments_nonce' ); //Wps way of ensuring that the data came from this form, not from somewhere outside.(second prm is name of field)
 	$um_stored_meta = get_post_meta( $post->ID );
  $meta_select_class = get_post_meta($post->ID, 'meta_number_select', true);
  ?>

 	<div>

    <div class="meta-row">
        <div class="meta-th">
          <p for="apartment_status" class="meta-row-title"><?php _e( 'Apartment Status', 'um-apt-details' ) ?></p>
        </div>
        <div class="meta-td">
          <select name="apartment_status" id="apartment_status">
            <option value="undefined" <?php if ( ! empty ( $um_stored_meta['apartment_status'] ) ) selected( _e( 'Undefined', 'um-apt-details'));  ?>><?php _e( 'Undefined', 'um-apt-details') ?></option>';
            <option value="available" <?php if ( ! empty ( $um_stored_meta['apartment_status'] ) ) selected( $um_stored_meta['apartment_status'][0], 'available' ); ?>><?php _e( 'Available', 'um-apt-details' )?></option>';
            <option value="sold" <?php if ( ! empty ( $um_stored_meta['apartment_status'] ) ) selected( $um_stored_meta['apartment_status'][0], 'sold' ); ?>><?php _e( 'Sold', 'um-apt-details' )?></option>';
            <option value="booked" <?php if ( ! empty ( $um_stored_meta['apartment_status'] ) ) selected( $um_stored_meta['apartment_status'][0], 'booked' ); ?>><?php _e( 'Booked', 'um-apt-details' )?></option>';
          </select>
    </div>
</div>


    <div class="meta-row">
        <div class="meta-th">
          <p for="apt_rooms" class="meta-row-title"><?php _e( 'Apartment Rooms', 'um-apt-details' ) ?></p>
        </div>
        <div class="meta-td">
          <select name="apt_rooms" id="apt-rooms">
            <option value="0" <?php if ( ! empty ( $um_stored_meta['apt_rooms'] ) ) selected( _e( '-', 'um-apt-details'));  ?>><?php _e( '-', 'um-apt-details') ?></option>';
            <option value="1" <?php if ( ! empty ( $um_stored_meta['apt_rooms'] ) ) selected( $um_stored_meta['apt_rooms'][0], '1' ); ?>><?php _e( '1', 'um-apt-details' )?></option>';
            <option value="2" <?php if ( ! empty ( $um_stored_meta['apt_rooms'] ) ) selected( $um_stored_meta['apt_rooms'][0], '2' ); ?>><?php _e( '2', 'um-apt-details' )?></option>';
            <option value="3" <?php if ( ! empty ( $um_stored_meta['apt_rooms'] ) ) selected( $um_stored_meta['apt_rooms'][0], '3' ); ?>><?php _e( '3', 'um-apt-details' )?></option>';
            <option value="4" <?php if ( ! empty ( $um_stored_meta['apt_rooms'] ) ) selected( $um_stored_meta['apt_rooms'][0], '4' ); ?>><?php _e( '4', 'um-apt-details' )?></option>';
          </select>
    </div>
</div>

<div class="meta-row">
    <div class="meta-th">
      <p for="apt_floors" class="meta-row-title"><?php _e( 'Apartment Floor', 'um-apt-details' ) ?></p>
    </div>
    <div class="meta-td">
      <select name="apt_floors" id="apt-floors">
        <option value="0" <?php if ( ! empty ( $um_stored_meta['apt_floors'] ) ) selected( _e( '-', 'um-apt-details'));  ?>><?php _e( '-', 'um-apt-details') ?></option>';
        <option value="1" <?php if ( ! empty ( $um_stored_meta['apt_floors'] ) ) selected( $um_stored_meta['apt_floors'][0], '1' ); ?>><?php _e( '1', 'um-apt-details' )?></option>';
        <option value="2" <?php if ( ! empty ( $um_stored_meta['apt_floors'] ) ) selected( $um_stored_meta['apt_floors'][0], '2' ); ?>><?php _e( '2', 'um-apt-details' )?></option>';
        <option value="3" <?php if ( ! empty ( $um_stored_meta['apt_floors'] ) ) selected( $um_stored_meta['apt_floors'][0], '3' ); ?>><?php _e( '3', 'um-apt-details' )?></option>';
        <option value="4" <?php if ( ! empty ( $um_stored_meta['apt_floors'] ) ) selected( $um_stored_meta['apt_floors'][0], '4' ); ?>><?php _e( '4', 'um-apt-details' )?></option>';
      </select>
</div>
</div>

<div class="meta-row">
    <div class="meta-th">
      <p for="apt_balcony" class="meta-row-title"><?php _e( 'Apartment Balcony', 'um-apt-details' ) ?></p>
    </div>
    <div class="meta-td">
      <select name="apt_balcony" id="apt-balcony">
        <option value="0" <?php if ( ! empty ( $um_stored_meta['apt_balcony'] ) ) selected( _e( '-', 'um-apt-details'));  ?>><?php _e( '-', 'um-apt-details') ?></option>';
        <option value="yes" <?php if ( ! empty ( $um_stored_meta['apt_balcony'] ) ) selected( $um_stored_meta['apt_balcony'][0], 'yes' ); ?>><?php _e( 'Yes', 'um-apt-details' )?></option>';
        <option value="no" <?php if ( ! empty ( $um_stored_meta['apt_balcony'] ) ) selected( $um_stored_meta['apt_balcony'][0], 'no' ); ?>><?php _e( 'No', 'um-apt-details' )?></option>';
</select>
</div>
</div>

<div class="meta-row">
    <div class="meta-th">
      <p for="apt_terrace" class="meta-row-title"><?php _e( 'Apartment Terrace', 'um-apt-details' ) ?></p>
    </div>
    <div class="meta-td">
      <select name="apt_terrace" id="apt-terrace">
        <option value="0" <?php if ( ! empty ( $um_stored_meta['apt_terrace'] ) ) selected( _e( '-', 'um-apt-details'));  ?>><?php _e( '-', 'um-apt-details') ?></option>';
        <option value="yes" <?php if ( ! empty ( $um_stored_meta['apt_terrace'] ) ) selected( $um_stored_meta['apt_terrace'][0], 'yes' ); ?>><?php _e( 'Yes', 'um-apt-details' )?></option>';
        <option value="no" <?php if ( ! empty ( $um_stored_meta['apt_terrace'] ) ) selected( $um_stored_meta['apt_terrace'][0], 'no' ); ?>><?php _e( 'No', 'um-apt-details' )?></option>';
</select>
</div>
</div>


    <div class="meta-row">
 			<div class="meta-th">
 				<p for="apt-area" class="meta-row-title"><?php _e( 'Apartment Area (m²)', 'um-apt-details' ); ?></p>
 			</div>
 			<div class="meta-td">
 				<input type="text" size=2 class="meta-row-value" name="apt_area" id="apt-area" value="<?php if ( ! empty ( $um_stored_meta['apt_area'] ) ) echo esc_attr( $um_stored_meta['apt_area'][0] ); ?>"/>
        <span><?php _e( 'm²', 'um-apt-details' ); ?></span>
 			</div>
 		</div>

    <div class="meta-row">
      <div class="meta-th">
        <p for="apt_price" class="meta-row-title"><?php _e( 'Apartment Price (€)', 'um-apt-details' ); ?></p>
      </div>
      <div class="meta-td">
        <input type="text" size=5 class="meta-row-value" name="apt_price" id="apt-price" value="<?php if ( ! empty ( $um_stored_meta['apt_price'] ) ) echo esc_attr( $um_stored_meta['apt_price'][0] ); ?>"/>
        <span><?php _e( '€', 'um-apt-details' ); ?></span>
      </div>
    </div>


 		<div class="meta">
 			<div class="meta-th">
 				<span><?php _e( 'Apartment Description', 'um-apt-details' ) ?></span>
 			</div>
 		</div>
 		<div class="meta-editor"></div>

    <?php


  	$content = get_post_meta( $post->ID, 'apt_descritpion', true );
 		$editor = 'apt_descritpion';
 		$settings = array(
 			'textarea_rows' => 6, // input size
 			'media_buttons' => true,  //default display true
 		);
 		wp_editor( $content, $editor, $settings); ?>
 		</div>

 	<?php



 }

 //SAVING FUNCTION - INPUTS TO DB
 function um_meta_save( $post_id ) {
   global $post;

  // Checks save status
     $is_autosave = wp_is_post_autosave( $post_id ); //is there autosave /revision present (wp_function, save it to var)
     $is_revision = wp_is_post_revision( $post_id );
     $is_valid_nonce = ( isset( $_POST[ 'um_apartments_nonce' ] ) && wp_verify_nonce( $_POST[ 'um_apartments_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
     // Exits script depending on save status
     if ( $is_autosave || $is_revision || !$is_valid_nonce ) { //is there ANY changes made ?
         return;
     }



     if ( isset( $_POST[ 'apt_descritpion' ] ) ) {
     	update_post_meta( $post_id, 'apt_descritpion', sanitize_text_field( $_POST[ 'apt_descritpion' ] ) );
     }
    if ( isset( $_POST[ 'apartment_status' ] ) ) {
    	update_post_meta( $post_id, 'apartment_status', sanitize_text_field( $_POST[ 'apartment_status' ] ) );
    }
    if ( isset( $_POST[ 'apt_rooms' ] ) ) {
    update_post_meta( $post_id, 'apt_rooms', sanitize_text_field( $_POST[ 'apt_rooms' ] ) );
    }

    if ( isset( $_POST[ 'apt_floors' ] ) ) {
    update_post_meta( $post_id, 'apt_floors', sanitize_text_field( $_POST[ 'apt_floors' ] ) );
    }
    if ( isset( $_POST[ 'apt_balcony' ] ) ) {
    update_post_meta( $post_id, 'apt_balcony', sanitize_text_field( $_POST[ 'apt_balcony' ] ) );
    }
    if ( isset( $_POST[ 'apt_terrace' ] ) ) {
    update_post_meta( $post_id, 'apt_terrace', sanitize_text_field( $_POST[ 'apt_terrace' ] ) );
    }
    if ( isset( $_POST[ 'apt_area' ] ) ) {  // listening input of the name and update data to DB
    update_post_meta( $post_id, 'apt_area', sanitize_text_field( $_POST[ 'apt_area' ] ) );
    }

    if ( isset( $_POST[ 'apt_price' ] ) ) {  // listening input of the name and update data to DB
    update_post_meta( $post_id, 'apt_price', sanitize_text_field( $_POST[ 'apt_price' ] ) );
    }

    }
    add_action( 'save_post', 'um_meta_save' );  //SAVE POST
