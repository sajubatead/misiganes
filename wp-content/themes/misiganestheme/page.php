<?php get_header(); ?>

<?php

if ( is_page( 'faq_question' ) OR is_page( 'teenused' ) ) {
  get_template_part( 'templates', 'faq_template' );
}

elseif ( is_page( 'about-us' ) OR is_page( 'meist' ) ) {
  get_template_part( 'templates/template', 'aboutus' );
}

elseif ( is_page( 'contact' ) OR is_page( 'kontakt' ) ) {
  get_template_part( 'templates/template', 'contact' );
}

elseif ( is_page( 'faq' ) OR is_page( 'kkk' ) ) {
  get_template_part( 'templates/template', 'faq' );
}

elseif ( is_page( 'calculator' ) OR is_page( 'kalkulaator' ) ) {
  get_template_part( 'templates/template', 'calculator' );
}

else {
 get_template_part( 'index' );
}

 ?>

<?php get_footer(); ?>
