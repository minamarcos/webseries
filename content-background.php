        <?php 
          wp_reset_postdata();
          $post_id = is_home() ? get_site_option('featured_webseries') : $post->ID;
        ?>
        <style type="text/css">
          #background { 
            background-image:url('/wp-content/themes/webseries/images/assets/main-gradient.png'),
              url('<?php echo get_artist_image("main_image",$post_id); ?>');
          }
        </style>

