  <section id="mic-locker">
      <div class="products-container">
        <div class="row">
        <div class="small-12 large-12 columns">
            <div class="title-container">
              <h2>Mic Locker</h2>
              <p>Used throughout Guitar Center’s Web Series, AKG’s high-end<br/> microphones stand for superior sound and outstanding quality.</p>
            </div>
            <div class="row">
              <div class="large-12 column">
                <div class="products">
                  <?php $product_args = array('post_type' => 'gcproducts'); $products = new WP_Query($product_args); ?>
                  <?php if ($products->have_posts()): ?>
                      <?php while($products->have_posts()): ?>
                          <?php $products->the_post(); ?>
                          <div class="product">
                            <img src="<?php echo get_thumbnail($products->post->ID); ?>" alt="" />
                            <div class="product-info">
                              <h3><?php echo get_the_title(); ?></h3>
                              <a href="<?php echo get_product_link($post->ID); ?>" target="_blank">Learn More &gt;</a>
                            </div>
                            <p class="product-description"><?php echo get_product_description($post->ID); ?> <br/><br/><br/><br/><br/></p>
                          </div>
                      <?php endwhile; ?>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section><!-- #mic-locker -->


