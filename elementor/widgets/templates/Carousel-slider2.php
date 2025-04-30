<?php

$random = (rand(10, 100));

?>
<div class="yacht-testimonial-wrapper layout_2">
  <div class="yacht-testimonial">
  <div class="br-testimonial-wrapper slider elementor_slider center_<?php echo esc_attr($random); ?>"  data-slider_class="<?php echo esc_attr($random); ?>" data-json_format="<?php echo htmlspecialchars($data_product_sliderone_add_settings);?>" data-slider_class = "<?php echo esc_attr( $random );?>">

      <?php 
       if (!empty($tab_item_v2)) :
        foreach ($tab_item_v2 as $item) :
      ?>
          <ul class="boatrental-flix">
            <li class="boatrental-flix-inner">

              <div class="boatrental-flix-front">
                <?php if (isset($item['image_author']['url'])) : ?>
                  <div class="br-testimonial-img">
                    <img src="<?php echo esc_attr($item['image_author']['url']); ?>" alt="" class="br-product-img">
                  </div>
                <?php endif; ?>
              </div>

              <div class="boatrental-flix-back">  
                <?php if ($item['testimonial'] != '') : ?>
                  <?php echo custom_excerpt(esc_html($item['testimonial']), 20); ?>
                <?php endif; ?>
                <?php if ($item['name_author'] != '') { ?>
                  <p class="br-testimonial-name"><?php echo $item['name_author'] ?></p>
                <?php } ?>
                <?php if ($item['company_name'] != '') { ?>
                  <p class="br-testimonial-company"><?php echo $item['company_name'] ?></p>
                <?php } ?>
              </div>

            </li>
          </ul>

      <?php endforeach;
      endif; ?>
      

    </div>

    <div class="slide-arrow-wrapper">
    <div class="slide-arrow-inner">
      <button class="prev_<?php echo esc_attr($random); ?> prev"><i class="fas fa-arrow-left" aria-hidden="true"></i></button>
      <button class="next_<?php echo esc_attr($random); ?> next"><i class="fas fa-arrow-right" aria-hidden="true"></i></button>
    </div>
  </div>
    



  </div>
</div>


<script>
  jQuery(document).ready(function() {
    initializeSlider('<?php echo esc_js($random); ?>');
  });
</script>