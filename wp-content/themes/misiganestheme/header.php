<!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
   <meta charset="<php? bloginfo('charset'); ?>">
   <meta name="viewport"  content="width=device-width">
   <title><?php bloginfo('name'); ?></title>
   <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="container"> <!--container start -->


<!-- site header -->
<header class="header">
  <nav class="header-nav">
    <?php
      $opts = array(
        'theme_location' => 'primary'
      );
      ?>
      <?php  wp_nav_menu( $opts ); ?>
    </nav>

  <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
  <h5><?php bloginfo('description'); ?></h5>
</header>
<!-- /site header -->
