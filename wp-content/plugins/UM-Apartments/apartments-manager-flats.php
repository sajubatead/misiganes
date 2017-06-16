<?php

namespace Location_Term_Meta;
function setup() {
	add_action( 'init', __NAMESPACE__ . '\register_location_taxonomy' );
	add_action( 'location_add_form_fields', __NAMESPACE__  . '\new_location_social_metadata' );
	add_action( 'location_edit_form_fields', __NAMESPACE__  . '\edit_location_social_metadata' );  //dynamic hoooks
	add_action( 'edit_location', __NAMESPACE__  . '\save_location_social_metadata' );
	add_action( 'create_location', __NAMESPACE__  . '\save_location_social_metadata' );  //if it would be category, dynamic hook's firts prm would be create_category
}
setup();
function register_location_taxonomy() {
	$labels = array(
		'name'              => _x( 'Buildings', 'text-domain' ),
		'singular_name'     => _x( 'Building', 'text-domain' ),
		'search_items'      => __( 'Search Buildings', 'text-domain' ),
		'all_items'         => __( 'All Buildings', 'text-domain' ),
		'parent_item'       => __( 'Parent Building', 'text-domain' ),
		'parent_item_colon' => __( 'Parent Building:', 'text-domain' ),
		'edit_item'         => __( 'Edit Building', 'text-domain' ),
		'update_item'       => __( 'Update Building', 'text-domain' ),
		'add_new_item'      => __( 'Add New Building', 'text-domain' ),
		'new_item_name'     => __( 'New Building Name', 'text-domain' ),
		'menu_name'         => __( 'Arendused', 'text-domain' ),
	);
	register_taxonomy( 'location', 'apartments_listing', array( 'labels' => $labels, 'hierarchical'=>true ) );
}
function supported_text_inputs() {
	return array(
			'facebook'  => esc_html__( 'Flats from', 'text-domain' ),  //text or name that is escaped for safe use in Html input, domain is for translations
			'twitter'   => esc_html__( 'Flats to', 'text-domain' ),   //text or name that is escaped for safe use in Html input, domain is for translations
			'linkedin'  => esc_html__( 'Floors from', 'text-domain' ),   //text or name that is escaped for safe use in Html input, domain is for translations
      'faltbes'  => esc_html__( 'Floors to', 'text-domain' )   //text or name that is escaped for safe use in Html input, domain is for translations
	);
}




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function new_location_social_metadata() {
	wp_nonce_field( basename( __FILE__ ), 'location_social_nonce' ); //nonce is for security issues
	$social_networks = supported_text_inputs(); //importing supported inputs ?>

	<th scope="row" valign="top" colspan="2">
		<h3><?php esc_html_e( 'Building Details', 'text-domain' ); ?></h3>
	</th>

	<?php foreach ( $social_networks as $network => $value ) { ?>

    <div class="form-field location-metadata">
			<label
        for="<?php printf( esc_html__( '%s-metadata', 'text-domain' ), $network ); ?>">
				<?php printf( esc_html__( '%s', 'text-domain' ), esc_html( $value ) ); ?>
			</label>

    <input
      type="text"
				name="<?php printf( esc_html__( 'location_%s_metadata', 'text-domain' ), esc_attr( $network ) ); ?>"
				  id="<?php printf( esc_html__( '%s-metadata', 'text-domain' ), esc_attr( $network ) ); ?>"
				value=""
			class="social-metadata-field" />

		</div>

	<?php }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function edit_location_social_metadata( $term ) {
	wp_nonce_field( basename( __FILE__ ), 'location_social_nonce' );
	$social_networks = supported_text_inputs(); ?>

	<th scope="row" valign="top" colspan="2">
		<h3><?php esc_html_e( 'Social Network Options', 'text-domain' ); ?></h3>
	</th>

	<?php foreach ( $social_networks as $network => $value ) {
		$term_key = sprintf( 'location_%s_metadata', $network );
		$metadata = get_term_meta( $term->term_id, $term_key, true ); ?>

		<tr class="form-field location-metadata"> <!-- worpress class -->
			<th scope="row">
				<label for="<?php printf( esc_html__( '%s-metadata', 'text-domain' ), $network ); ?>">
					<?php printf( esc_html__( '%s URL', 'text-domain' ), esc_html( $value ) ); ?>
				</label>
			</th>
			<td>
				<input type="text"
				       name="<?php printf( esc_html__( 'location_%s_metadata', 'text-domain' ), esc_attr( $network ) ); ?>"
				       id="<?php printf( esc_html__( '%s-metadata', 'text-domain' ), esc_attr( $network ) ); ?>"
				       value="<?php echo ( ! empty( $metadata ) ) ? esc_attr( $metadata ) : ''; ?>" class="social-metadata-field"/>
               <!-- if value not empty, display metadata, else empty -->
			</td>
		</tr>
	<?php }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function save_location_social_metadata( $term_id ) {

	if ( ! isset( $_POST[ 'location_social_nonce' ] ) ) {
		return;   // IF NONCE IS SET
	}

	if ( ! wp_verify_nonce( $_POST['location_social_nonce'], basename( __FILE__ ) ) ) {
		return; //IF NONCE IS not passed, function stops here.
	}
	$social_networks = supported_text_inputs();
	foreach ( $social_networks as $network => $value ) {
		$term_key = sprintf( 'location_%s_metadata', $network );   //DB meta_key column NAME
		if ( isset( $_POST[ $term_key ] ) ) {
			update_term_meta( $term_id, esc_attr( $term_key ), ( $_POST[ $term_key ] ) );
		}
	}
}
