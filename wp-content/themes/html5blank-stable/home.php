<?php
	
	/*
	Template Name: Home Template
	*/

  get_header(); ?>

  <!-- section -->
  <section>
      <?php if (have_posts()): while (have_posts()) : the_post(); ?>
          <!-- article -->
          <article class="" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              
            <!-- Page Content -->
            <section class="main app form" id="main"><!-- Main Section-->
              <div class="hero-section">
                <div class="container nopadding">
                  <div class="col-md-12">
                    <div class="hero-content text-center">
                      <h1 class="wow fadeInUp" data-wow-delay="0.1s">ALL AUTO ACTUALITIES</h1>
                      <p class="wow fadeInUp" data-wow-delay="0.2s"> Sit vitae semper venenatis orci et proin platea vivamus pellentesque class rhoncus duis cras. Phasellus sollicitudin habitasse platea pellentesque accumsan elementum dignissim. Nam fames nisl. Praesent dictum nulla mauris quisque aliquam cubilia eget per conubia porta nam. Nibh a integer eu diam. Viverra feugiat scelerisque quis fusce aptent ad imperdiet aliquet, justo integer ex massa dapibus euismod aptent ad, varius primis sociosqu iaculis. Adipiscing lobortis est ultricies consequat hac lectus donec odio neque nam morbi. </p>
                      <!-- <a href="#" class="btn btn-action wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">Get Strated</a> --> 
                    </div>
                  </div>
                </div>
              </div>

              <div class="pitch col-md-8 col-sm-8 col-xs-12 no-padding">
                <div class="latest-news">
                  <h2 class="wow fadeInDown" style="color: white;font-weight: bold;padding-top: 10px;padding-bottom: 10px;">Last News</h2>

                    <?php
                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $loop = new WP_Query(array( 
                          'nopaging'               => false,
                          'paged'                  => $paged,
                          'posts_per_page'         => '6',
                          'post_type'              => 'post')
                    );

                    if ($loop->have_posts()):
                      while ( $loop->have_posts() ) : $loop->the_post();
                        // $query->the_post();
                    ?>
                        <div class="col-xs-12 col-sm-6 col-md-4 pitch-content add-padding">
                          <h4>
                            <a href="#">
                            <?php 
                              echo the_title();
                            ?>
                            </a>
                          </h4>
                          <div>
                            <img class="no-padding col-md-12 col-sm-12 col-xs-12" src="<?php echo get_template_directory_uri(); ?>/img/mbappe.jpg">
                            <p> 
                              <?php 
                                echo substr(the_content(),0,500).'...'; 
                              ?>
                            </p>
                          </div>
                        </div>
                      <?php endwhile; ?>
                      <nav class="paginate">
                          <?php pagination_bar( $loop ); ?>
                      </nav>
    
                      <?php wp_reset_postdata();
                    endif;

                    echo "</div>";

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
                          foreach(array_slice($marques, 0, 8) as $marque) {
                            // Get MODELES: subcategories of the current MARQUE
                            $modeles_args = array("child_of" => $marque->term_id,
                                                  "hide_empty" => 0,
                                                  "type"      => "post",      
                                                  "orderby"   => "name",
                                                  "order"     => "ASC");
                            $modeles = get_categories($modeles_args);
                            
                            // List all marque - modeles
                            foreach(array_slice($modeles, 0, 2) as $modele) {
                    ?>
                          <!-- Classes Section -->
                          <div class="pitch" id="classes">
                              <h2 class="wow fadeInDown" style="color: white;font-weight: bold;padding-top: 10px;padding-bottom: 10px;"><?php echo $modele->name; ?></h2>
                            <div class="pitch col-xs-12">
                              <div class="col-md-12">
                                <div class="wow fadeInDown" data-wow-delay="0.2s">
                                  <?php
                                      // Get posts related to this model
                                      $args = array(
                                                      'posts_per_page'   => 6,
                                                      'offset'           => 0,
                                                      'category'         => $modele->term_id,
                                                      'category_name'    => $modele->name,
                                                      'orderby'          => 'date',
                                                      'order'            => 'DESC',
                                                      'post_type'        => 'post',
                                                      'post_status'      => 'publish',
                                                  );
                                                  $posts_array = get_posts($args);

                                                  foreach(array_slice($posts_array, 0, 6) as $post) {
                                  ?>

                                  <div class="col-xs-12 col-sm-6 col-md-4 pitch-content add-padding">
                                    <h4>
                                      <a href="#">
                                      <?php 
                                          echo get_the_title($post->term_id);
                                      ?>
                                      </a>
                                    </h4>
                                    <div>
                                      <img class="no-padding col-md-12 col-sm-12 col-xs-12" src="<?php echo get_template_directory_uri(); ?>/img/mbappe.jpg">
                                        <p> 
                                          <?php 
                                            echo substr($post->post_content,0,500).'...'; 
                                          ?>
                                        </p>
                                      </div>
                                  </div>

                                  <?php
                                      }
                                  ?>
                                </div>
                              </div>
                            </div>
                          </div>
                    <?php 
                                }
                            }
                        }
                    ?>
                  </div>

              <aside class="col-md-4 col-sm-4 col-xs-12 no-padding">
                      <img src="<?php echo get_template_directory_uri(); ?>/img/mbappe.jpg" width="100%";>
                  </aside>
          </section>

          </article>
          <!-- /article -->

          

      <?php endwhile; ?>
      <?php else: ?>

          <!-- article -->
          <article>
              <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
          </article>
          <!-- /article -->

      <?php endif; ?>
  </section>
  <!-- /section -->

  <?php get_sidebar(); ?>
  <?php get_footer(); ?>