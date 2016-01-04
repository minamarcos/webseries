        <?php 
          wp_reset_postdata();
          $post_id = is_home() ? get_site_option('featured_webseries') : $post->ID;
        ?>


        <section id="gallery">
            <h2>Photo Gallery</h2>
            <?php $gallery = get_gallery($post_id); ?> 
            <?php for($i=0;$i<count($gallery);$i++): ?>
              <?php if ($i%2==0): ?>
                <div class="row">
                <?php endif; ?>
                  <div class="small-6 large-6 column">
                    <a href="#photo" class="photo">
                      <figure>
                        <img id="photo-<?php echo $i; ?>" src="<?php echo $gallery[$i]['photo']; ?>" />
                      </figure>
                    </a>
                  </div>
                <?php if ($i%2==1): ?>
                </div>
              <?php endif; ?>
            <?php endfor; ?>
        </section>

