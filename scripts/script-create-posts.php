<?php
  // LOAD WORDPRESS FUNCTIONS
  require_once("../wp-load.php");
  if ( ! is_admin() ) {
    require_once( ABSPATH . 'wp-admin/includes/post.php' );
  }
  require_once("Lorem.php");

  // Get the main category
  $main_category = "marques-auto";
  $main_category_id = term_exists($main_category);

  if($main_category_id) {

    // Get MARQUES: subcategories of the main category
    $marques_args = array("child_of" => $main_category_id,
                          "hide_empty" => 0,
                          "type"      => "post",      
                          "orderby"   => "name",
                          "order"     => "ASC");
    $marques = get_categories($marques_args);

    // For each marque
    foreach($marques as $marque) {
      // Get MODELES: subcategories of the current MARQUE
      $modeles_args = array("child_of" => $marque->term_id,
                            "hide_empty" => 0,
                            "type"      => "post",      
                            "orderby"   => "name",
                            "order"     => "ASC");
      $modeles = get_categories($modeles_args);
      
      // List all marque - modeles
      foreach($modeles as $modele) {
        echo $marque->name."-".$modele->name."\n";

        $post_id = post_exists($marque->name."-".$modele->name);
        echo $post_id."\n";

        if($post_id) {
          // Create the POST object
          $modele_post = array(
            'ID'            => $post_id,
            'post_title'    => $marque->name."-".$modele->name,
            'post_content'  => "<h6>".Lorem::ipsum(2)."</h6>",
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_category' => $modele->term_id
          );
          echo "CATEGORY of this post: ".$modele->term_id."\n";
          echo "POST ".$marque->name."-".$modele->name." updated!\n";
          // Insert the post into the database if not exists
          wp_update_post($modele_post);
          wp_set_object_terms($post_id, $modele->term_id, 'category');
        } else {
          // Create the POST object
          $modele_post = array(
            'post_title'    => $marque->name."-".$modele->name,
            'post_content'  => "<p>".Lorem::ipsum(1)."</p>",
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_category' => $modele->term_id
          );
          echo "CATEGORY of this post: ".$modele->term_id."\n";
          echo "POST ".$marque->name."-".$modele->name." created!\n";
          // Update the post into the database if not exists
          $post_id = wp_insert_post($modele_post);
          wp_set_object_terms($post_id, $modele->term_id, 'category');
        }
      }
    }

  }
?>