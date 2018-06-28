<?php
  // LOAD WORDPRESS FUNCTIONS
  require_once("../wp-load.php");
  if ( ! is_admin() ) {
    require_once( ABSPATH . 'wp-admin/includes/post.php' );
  }

?>

