        <?php 
          wp_reset_postdata();
          $post_id = is_home() ? get_site_option('featured_webseries') : $post->ID;

          the_posts_pagination();
        ?>
    <section id="featured-artist">
      <div class="featured">
          <div class="row">
              <div class="small-12 medium-12 large-4 large-offset-4 column">
                  <a href="#" class="video-main" data-reveal-id="video-modal" data-video="<?php echo get_post_meta($post_id,'videos_0_video_url',true); ?>">
                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/assets/play-main.png" class="video-image">
                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/assets/play-main-hover.png" class="video-image-hover">
                    <h3 class="featured-video-title"><?php echo get_post_meta($post_id,'videos_0_title',true); ?></h3>
                  </a>
              </div>
          </div>
          <div class="row">
              <div class="small-12 large-4 column">
                  <h1 class="main-title"><?php echo get_the_title($post_id); ?></h1>
              </div>
          </div>
          <div class="row">
              <div class="small-12 large-8 column">
                  <p class="featured-description"><?php echo get_post_meta($post_id,'description',true); ?></p>
                  <div class="row">
                      <div class="small-12 large-5 column">
                          <div class="row">
                              <div class="small-6 large-6 column">
                                <a class="video-sub" data-reveal-id="video-modal" data-video="<?php echo get_post_meta($post_id,'videos_1_video_url',true); ?>">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/assets/play-sub.png" class="video-image" />
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/assets/play-sub-hover.png" class="video-image-hover" />
                                    <p class="featured-video-subtitle"><?php echo get_post_meta($post_id,'videos_1_title',true); ?></p>
                                </a>
                              </div>
                              <div class="small-6 large-6 column">
                                <a class="video-sub" data-reveal-id="video-modal" data-video="<?php echo get_post_meta($post_id,'videos_2_video_url',true); ?>">
                                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/assets/play-sub.png" class="video-image" />
                                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/assets/play-sub-hover.png"  class="video-image-hover" />
                                  <p class="featured-video-subtitle"><?php echo get_post_meta($post_id,'videos_2_title',true); ?></p>
                                </a>
                              </div>
                          </div>
                      </div>
                      <div class="small-12 large-7 column">
                          <div class="featured-share">
                            <p class="featured-share">Share this Webisode: 
                              <span>
                                <a href="http://www.facebook.com/share.php?u=<?php echo get_permalink($post_id); ?>&title=<?php echo get_the_title($post_id); ?>"><i class="fi-social-facebook"></i></a>
                                <a href="http://twitter.com/intent/tweet?status=<?php echo get_the_title($post_id); ?>+<?php echo get_permalink($post_id); ?>"><i class="fi-social-twitter"></i></a>
                                <a href=""><i class="fi-social-instagram"></i></a>
                              </span>
                            </p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="small-offset-2 small-8 end large-offset-2 large-2 column">
                  <div class="album">
                    <a href="<?php echo get_post_meta($post_id,'album_link',true); ?>" target="_blank" class="album-link">
                      <h3 class="album-title"><?php echo get_post_meta($post_id,'album_title',true); ?></h3>
                      <img src="<?php echo get_artist_image('album_thumbnail',$post_id); ?>" alt="" class="album-image" />
                    </a>
                    <a class="site" href="<?php echo get_post_meta($post_id,'site',true); ?>" target="_blank"><?php echo get_post_meta($post_id,'site',true); ?></a>
                  </div>
              </div>
          </div>
      </div>
    </section>
    <!-- #featured-artist -->