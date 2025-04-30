 <?php 
 $formatted_cabins = get_product_location(get_the_ID(), 'pa_cabins');
 $adult = get_product_location(get_the_ID(), 'pa_guest');
 $berths = get_product_location(get_the_ID(), 'pa_berths');

 if (get_post_type() === 'product') {  
 ?>
 <ul class="br-product-features">
    <?php if($berths != 0) {?>
    <li class="br-product-features-item"><i class="fas fa-bed"></i> <span class="icon-txt"> <?php echo esc_html($berths); ?> Berth </span> </li>
    <?php } if($formatted_cabins != 0) {?>
    <li class="br-product-features-item"><i class="fas fa-hotel"></i> <span class="icon-txt"> <?php echo esc_html($formatted_cabins); ?> Cabin </span></li>
    <?php } if($adult != 0) {?>
    <li class="br-product-features-item"><i class="fas fa-users"></i> <span class="icon-txt"> <?php echo esc_html($adult); ?> Guest </span></li>
    <?php } ?>
</ul>

<?php
 }

if (get_post_type() === 'post') {  

    $blogID = get_the_ID(); // Current blog post ID
    $publishDate = get_the_date('F j, Y', $blogID); // Retrieve and format the publish date
    ?>
    
    <span class="br-meta"><?php echo $publishDate; ?></span>
    <?php
} ?>