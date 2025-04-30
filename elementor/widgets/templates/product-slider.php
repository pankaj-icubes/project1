<?php 

$random = (rand(10,100));

?>

<div class="yacht-carousel-wrapper prod-slide-layout1">
  <div class="slide-arrow-wrapper">
    <div class="slide-arrow-inner">
      
    <button class="br-button-slide btn-black prev_<?php echo esc_attr($random) ?> prev_btn">
        <span class="br-button__text"><i class="fas fa-arrow-left" aria-hidden="true"></i></span>
    </button>
    <button class="br-button-slide btn-black next_<?php echo esc_attr($random) ?> next_btn">
        <span class="br-button__text"><i class="fas fa-arrow-right" aria-hidden="true"></i></span>
    </button>

    
    </div>
  </div>
  <div class="yacht-carousel">
    <ul class="br-product-wrapper slider elementor_slider slider1data center_<?php echo esc_attr($random); ?>" data-json_format="<?php echo esc_attr(htmlspecialchars($data_product_sliderone_add_settings)); ?>" data-slider_class="<?php echo esc_attr($random); ?>">
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

                    <div class="br-button-sld alignright btn-white">
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="br-button br-btn">
                            <span class="br-button__text"><i class="fas fa-arrow-right" aria-hidden="true"></i>Explore</span>
                        </a>
                    </div>
                </div>
            </li>
        <?php endwhile; ?>
    </ul>
  </div>
</div>



<script>
	jQuery(document).ready(function() {
		initializeSlider('<?php echo esc_js($random); ?>');
	});
</script>