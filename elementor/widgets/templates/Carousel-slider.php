
<?php 

$random = (rand(10,100));

?>
<div class="yacht-testimonial-wrapper">
  <div class="slide-arrow-wrapper">
    <div class="slide-arrow-inner">
   <button class="br-button-slide btn-white prev_<?php echo esc_attr($random); ?> prev_btn">

	<span  class="br-button__text"><i class="fas fa-arrow-left" aria-hidden="true"></i></span>
							</button>
              <button class="br-button-slide btn-white next_<?php echo esc_attr( $random ); ?> next_btn">
	<span  class="br-button__text"><i class="fas fa-arrow-right" aria-hidden="true"></i></span>
							</button>
    </div>
  </div>
  <div class="yacht-testimonial">
    <ul class="br-testimonial-wrapper slider elementor_slider center_<?php echo esc_attr( $random );?>" data-json_format="<?php echo htmlspecialchars($data_product_sliderone_add_settings);?>" data-slider_class = "<?php echo esc_attr( $random );?>">
    <?php if( !empty($tab_item) ) : 
      foreach ( $tab_item as $item ) : 
      ?>
      <li class="br-testimonial-list slide">
        <div class="br-head-testimonial">
          <div class="br-testimonial-evaluate">
          <?php if( $item['testimonial'] != '' ) : ?>
              <?php echo esc_html( $item['testimonial'] ); ?>
            <?php endif; ?>
          </div>
        </div>

        <div class="br-foot-testimonial">
        <?php if(isset( $item['image_author']['url'] )): ?>													
          <div class="br-testimonial-img">
            <img src="<?php echo esc_attr( $item['image_author']['url'] ); ?>" alt="" class="br-product-img">
          </div>
          <?php endif; ?>
          <div class="br-testimonial-info">
          <?php if( $item['name_author'] != '' ) { ?>
            <p class="br-testimonial-name"><?php echo esc_html( $item['name_author'] ); ?></p>
            <?php } ?>
            <?php if( $item['company_name'] != '' ) { ?>
            <p class="br-testimonial-company"><?php echo esc_html( $item['company_name'] ); ?></p>
            <?php } ?>
          </div>
        </div>
      </li>

      <?php endforeach; endif; ?>

    </ul>



  </div>
</div>


<script>
	jQuery(document).ready(function() {
		initializeSlider('<?php echo esc_js($random); ?>');
	});
</script>