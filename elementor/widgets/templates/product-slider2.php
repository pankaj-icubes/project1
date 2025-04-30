
<?php 

$random = (rand(10,100));

?>

<div class="yacht-carousel-wrapper prod-slide-layout2">
  
  <div class="yacht-carousel">
  <ul class="br-product-wrapper slider elementor_slider center_<?php echo esc_attr($random); ?>" data-json_format="<?php echo esc_attr(htmlspecialchars($data_product_sliderone_add_settings)); ?>" data-slider_class="<?php echo esc_attr($random); ?>">
      <?php while ($all_products->have_posts()) :
          $all_products->the_post(); ?>
          <li class="br-prod-list slide">
              <div class="br-head-product">
                  <a href="<?php echo esc_url(get_permalink()); ?>">
                      <img loading="lazy" src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" class="yacht-carousel-img wp-post-image" alt="<?php echo esc_attr(get_the_title()); ?>" decoding="async">
                  </a>
              </div>

              <div class="br-foot-product">
                  <div class="wp-caption">
                      <div class="br-product-title alignleft">
                          <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                      </div>
                      <div class="wp-caption-text">
                              <?php echo esc_html(custom_excerpt(get_the_excerpt(), 10)); ?>
                          </div>
                  </div>
                  <button class="br-btn"><a href="<?php echo esc_url(get_permalink()); ?>"><i class="fas fa-arrow-right" aria-hidden="true"></i></a></button>
              </div>
          </li>
      <?php endwhile; ?>
  </ul>




  </div>

  <div class="slide-arrow-wrapper">
    <div class="slide-arrow-inner">
      <button class="prev_<?php echo esc_attr($random) ?> prev"><i class="fas fa-arrow-left" aria-hidden="true"></i></button>
      <button class="next_<?php echo esc_attr($random) ?> next"><i class="fas fa-arrow-right" aria-hidden="true"></i></button>
    </div>
  </div>
</div>



<script>
	jQuery(document).ready(function() {
		initializeSlider('<?php echo esc_js($random); ?>');
	});
</script>