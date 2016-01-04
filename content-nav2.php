        <?php $post_id = is_home() ? get_site_option('featured_webseries') : $post->ID; ?>

        <nav id="navigation" class="top-bar" data-topbar role="navigation" data-options="is_hover:true">
          <section class="top-bar-section">
            <?php if (is_single()): ?>
              <ul class="right">
                <?php
                  $currentEpisodeNumber = get_episode_number($post_id);
                  $webisoderightnavs_args = array(
                    'post_type'=>'webisodes',
                    'meta_key'=>'episode',
                    'order_by'=>'meta_value_num',
                    'order'=>ASC,
                  );
                  $webisoderightnavs = new WP_Query($webisoderightnavs_args);
                ?>
          
                <?php if($webisoderightnavs->have_posts()): ?>
                    <?php while($webisoderightnavs->have_posts()): $webisoderightnavs->the_post(); ?>
                      <?php
                        $episodes_count = get_last_episode_number($webisoderightnavs->posts);
                        $episodeId = $webisoderightnavs->post->ID;
                        $previousEpisodeNumber = get_previous_episode_number($currentEpisodeNumber,$episodes_count);
                        $nextEpisodeNumber = get_next_episode_number($currentEpisodeNumber,$episodes_count);
                        $episodeNumber = get_post_meta($episodeId,'episode',true);
                      ?>

                      <?php if (isCurrentEpisode($episodeId,$post_id)): ?>
                        <li><a href="<?php echo get_webisode_permalink($previousEpisodeNumber); ?>" class="nav"><img class="nav-arrow" src="<?php echo get_stylesheet_directory_uri(); ?>/images/assets/arrow-left.png"></a></li>
                        <li><a id="episode-title"><?php echo get_episode_info($post_id,$episodeId,$episodeNumber,$episodes_count); ?></a></li>
                        <li><a href="<?php echo get_webisode_permalink($nextEpisodeNumber); ?>" class='nav'><img class="nav-arrow" src="<?php echo get_stylesheet_directory_uri(); ?>/images/assets/arrow-right.png"></a></li>
                      <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
              </ul>
            <?php endif; ?>


            <!-- Centered Nav Section -->
            <div class="logo-wrapper">
              <div class="logo">
                <a href="/">
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/assets/logo.jpg">
                </a>
              </div>
            </div>



            <!-- Left Nav Section -->
            <ul class="left">
              <li class="has-dropdown not-click"><a href="" class="left-dropdown"><i class="fi-list"></i></a>
                <ul class="dropdown">
                  <li class="active"><a href="#featured-artist">Featured Artist</a></li>
                  <li><a href="#gallery">Gallery</a></li>
                  <li><a href="#mic-locker">Mic Locker</a></li>
                  <li class="divider"><a href="#previous-webisodes">Previous Web Episodes</a></li>
                  <li class="webisode-nav">
                    <?php 
                      $webisodenav_args = array(
                        'post_type'=>'webisodes',
                        'meta_key'=>'episode',
                        'order_by'=>'meta_value_num',
                        'order'=>ASC,
                      ); 
                      $webisodenavs = new WP_Query($webisodenav_args); 
                    ?>
                    <?php if($webisodenavs->have_posts()): ?>
                        <?php while($webisodenavs->have_posts()): ?>
                          <?php $webisodenavs->the_post(); ?>
                          <a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?><span>(episode <?php echo get_post_meta($post->ID,'episode',true); ?>)</span></a>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                  </li>
                </ul>
              </li>
            </ul>
          </section>
        </nav>