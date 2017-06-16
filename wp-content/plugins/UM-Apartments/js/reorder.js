jQuery(document).ready(function($) {

	var sortList = $( 'ul#custom-type-list' );
	var animation = $( '#loading-animation' );
	var pageTitle = $( 'div h2' );

	sortList.sortable({

		update: function( event, ui ) {   //when any event is changed its gonna run this update.
			animation.show();  //at these circumstances, it is refering to loading animation

			$.ajax({
				url: ajaxurl,  //inpoint, which to hit/wp-adim/admin-ajax.php
				type: 'POST',  //sending data to the server
				dataType: 'json',  //returning data type
				data: {  //actual data, this function is sending
					action: 'save_sort',  //update posting action, /custom named.../apartment-one-php-action
					order: sortList.sortable( 'toArray' ),  //custom property named order, it contains data, gonna be send
					security: WP_JOB_LISTING.security  //custom named property of data, that is sending out.
				},
        success: function( response ) {  //always gonna run.
        					$( 'div#message' ).remove();
        					animation.hide();
									//console.log(order: sortList.sortable( 'toArray' )); to print current values to console
        					if( true === response.success ) {
        						pageTitle.after( '<div id="message" class="updated"><p>' + WP_JOB_LISTING.success + '</p></div>' );
        					} else {
        						pageTitle.after( '<div id="message" class="error"><p>' + WP_JOB_LISTING.failure + '</p></div>' );
        					}


				},
				error: function( error ) {  //ajax built-in function, case of errror and function can not run.
					$( 'div#message' ).remove();
					animation.hide();
					pageTitle.after( '<div id="message" class="error"><p>' + WP_JOB_LISTING.failure + '</p></div>' );
				}
			});
		}
	});

});
