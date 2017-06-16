<?php

function um_apartments_manager_metabox(){
  add_meta_box(
    'um_metabox',           //Metabox element ID
    __('Apartments Details'),  // Any given name will be displayed on front end of dashboard
    'um_meta_callback',   //function rendering input fields to the front end for insertion of data
    'apartments_listing',  //function um_apartments_manager_post_type()- wp-menu-name(admin sidebar)
    'normal',  //sidebar, normal, or advanced display
    'core'
);
}

 add_action('add_meta_boxes', 'um_apartments_manager_metabox');


 function um_meta_callback( $post ) {  //Acess to post id-s from the DB
 	wp_nonce_field( basename( __FILE__ ), 'um_apartments_nonce' ); //Wps way of ensuring that the data came from this form, not from somewhere outside.(second prm is name of field)
 	$um_stored_meta = get_post_meta( $post->ID ); ?>  <!--query all the data from the db, post named ID(key) for dislpaying in the frontend -->

 	<div>
 		<div class="meta-row">
 			<div class="meta-th">
 				<label for="job-id" class="dwwp-row-title"><?php _e( 'Job Id', 'wp-job-listing' ); ?></label>
 			</div>
 			<div class="meta-td">
 				<input type="text" class="dwwp-row-content" name="job_id" id="job-id"
 				value="<?php if ( ! empty ( $um_stored_meta['job_id'] ) ) {	echo esc_attr( $um_stored_meta['job_id'][0] );} ?>"/> <!-- Is there value in the DB equal to the ID? then display the first item from the array -->
 			</div>
 		</div>
 		<div class="meta-row">
 			<div class="meta-th">
 				<label for="date-listed" class="dwwp-row-title"><?php _e( 'Date Listed', 'wp-job-listing' ); ?></label>
 			</div>
 			<div class="meta-td">
 				<input type="text" size=10 class="dwwp-row-content datepicker" name="date_listed" id="date-listed" value="<?php if ( ! empty ( $um_stored_meta['date_listed'] ) ) echo esc_attr( $um_stored_meta['date_listed'][0] ); ?>"/>
 			</div>
 		</div>
 		<div class="meta-row">
 			<div class="meta-th">
 				<label for="application_deadline" class="dwwp-row-title"><?php _e( 'Application Deadline', 'wp-job-listing' ) ?></label>
 			</div>
 			<div class="meta-td">
 				<input type="text" size=10 class="dwwp-row-content datepicker" name="application_deadline" id="application_deadline" value="<?php if ( ! empty ( $um_stored_meta['application_deadline'] ) ) echo esc_attr( $um_stored_meta['application_deadline'][0] ); ?>"/>
 			</div>
 		</div>
 		<div class="meta">
 			<div class="meta-th">
 				<span><?php _e( 'Principle Duties', 'wp-job-listing' ) ?></span>
 			</div>
 		</div>
 		<div class="meta-editor"></div>
 		<?php


  	$content = get_post_meta( $post->ID, 'principle_duties', true );
 		$editor = 'principle_duties';
 		$settings = array(
 			'textarea_rows' => 8, // input size
 			'media_buttons' => false,  //default display true
 		);
 		wp_editor( $content, $editor, $settings); ?>
 		</div>
 		<div class="meta-row">
 	        <div class="meta-th">
 	          <label for="minimum-requirements" class="dwwp-row-title"><?php _e( 'Minimum Requirements', 'wp-job-listing' ) ?></label>
 	        </div>
 	        <div class="meta-td">
 	          <textarea name="minimum_requirements" class="dwwp-textarea" id="minimum-requirements"><?php
 	          if ( ! empty ( $um_stored_meta['minimum_requirements'] ) ) {
 		          echo esc_attr( $um_stored_meta['minimum_requirements'][0] );
 	          }
 	          ?>
 	          </textarea>
 	        </div>
 	    </div>
 	    <div class="meta-row">
         	<div class="meta-th">
 	          <label for="preferred-requirements" class="dwwp-row-title"><?php _e( 'Preferred Requirements', 'wp-job-listing' ) ?></label>
 	        </div>
 	        <div class="meta-td">
 	          <textarea name="preferred_requirements" class="dwwp-textarea" id="preferred-requirements"><?php
 			          if ( ! empty ( $um_stored_meta['preferred_requirements'] ) ) {
 			            echo esc_attr( $um_stored_meta['preferred_requirements'][0] );
 			          }
 		          ?>
 	          </textarea>
 	        </div>
 	    </div>
 	    <div class="meta-row">
 	        <div class="meta-th">
 	          <label for="relocation-assistance" class="dwwp-row-title"><?php _e( 'Relocation Assistance', 'wp-job-listing' ) ?></label>
 	        </div>
 	        <div class="meta-td">
 	          <select name="relocation_assistance" id="relocation-assistance">
 		          <option value="Yes" <?php if ( ! empty ( $um_stored_meta['relocation_assistance'] ) ) selected( $um_stored_meta['relocation_assistance'][0], 'Yes' ); ?>><?php _e( 'Yes', 'wp-job-listing' )?></option>';
 		          <option value="No" <?php if ( ! empty ( $um_stored_meta['relocation_assistance'] ) ) selected( $um_stored_meta['relocation_assistance'][0], 'No' ); ?>><?php _e( 'No', 'wp-job-listing' )?></option>';
 	          </select>
 	    </div>
 	</div>
 	<?php
 }

 //SAVING FUNCTION - INPUTS TO DB
 function um_meta_save( $post_id ) {


  // Checks save status
     $is_autosave = wp_is_post_autosave( $post_id ); //is there autosave /revision present (wp_function, save it to var)
     $is_revision = wp_is_post_revision( $post_id );
     $is_valid_nonce = ( isset( $_POST[ 'um_apartments_nonce' ] ) && wp_verify_nonce( $_POST[ 'um_apartments_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
     // Exits script depending on save status
     if ( $is_autosave || $is_revision || !$is_valid_nonce ) { //is there ANY changes made ?
         return;
     }
     if ( isset( $_POST[ 'job_id' ] ) ) {  //if there is any data in this input field with this id ?
     	update_post_meta( $post_id, 'job_id', sanitize_text_field( $_POST[ 'job_id' ] ) ); //Update data if true. //sanitize modifies text to UTF8
     }
     if ( isset( $_POST[ 'date_listed' ] ) ) {  // listening input of the name and update data to DB
     	update_post_meta( $post_id, 'date_listed', sanitize_text_field( $_POST[ 'date_listed' ] ) );
     }
     if ( isset( $_POST[ 'application_deadline' ] ) ) {
     	update_post_meta( $post_id, 'application_deadline', sanitize_text_field( $_POST[ 'application_deadline' ] ) );
     }
     if ( isset( $_POST[ 'principle_duties' ] ) ) {
     	update_post_meta( $post_id, 'principle_duties', sanitize_text_field( $_POST[ 'principle_duties' ] ) );
     }
 	if ( isset( $_POST[ 'preferred_requirements' ] ) ) {
 		update_post_meta( $post_id, 'preferred_requirements', wp_kses_post( $_POST[ 'preferred_requirements' ] ) );
 	}
 	if ( isset( $_POST[ 'minimum_requirements' ] ) ) {
 		update_post_meta( $post_id, 'minimum_requirements', wp_kses_post( $_POST[ 'minimum_requirements' ] ) );
 	}
 	if ( isset( $_POST[ 'relocation_assistance' ] ) ) {
 		update_post_meta( $post_id, 'relocation_assistance', sanitize_text_field( $_POST[ 'relocation_assistance' ] ) );
 	}
 }
 add_action( 'save_post', 'um_meta_save' );  //SAVE POST
