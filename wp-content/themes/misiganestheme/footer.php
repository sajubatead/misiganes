

<footer class="footer">
<p><?php bloginfo('name'); ?> - &copy; <?php echo date('Y'); ?></p>

<nav class="footer-nav">
  <?php
  $opts = array(
    'theme_location' => 'footer'
  );
 ?>
 <?php  wp_nav_menu( $opts ); ?>
</nav>

</footer>


</div> <!-- container end -->
<?php wp_footer(); ?>
</body>
</html>
