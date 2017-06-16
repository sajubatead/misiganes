<?php

$args = array(
   'name' => 'faq_question'
);

$output = 'objects'; // names or objects

$post_types = get_post_types( $args, $output );

foreach ( $post_types  as $post_type ) {

   echo '<p>' . $post_type->name . '</p>';
}

?>
