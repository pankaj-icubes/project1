<?php

if (has_post_thumbnail() && !post_password_required() && get_post_type() === 'post' || has_post_format('image')) :
?>
    <div class="br-post-image">
        <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('medium_large', array('class' => 'br-product-img', 'alt' => '')); ?>
            <?php endif; ?>
        </a>
    </div>
<?php

endif;

if (get_post_type() === 'product') { ?>
    <div class="br-head-product">
        <a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="" class="br-product-img"></a>
        <div class="br-product-tag">
            <?php
            $product = wc_get_product(get_the_ID());

            $rating_count = $product->get_rating_count();
            $average_rating = $product->get_average_rating();
            $average_rating = trim($average_rating, " \""); // Remove spaces and quotes
            if ($rating_count > 0) {
                
            ?>
                <div class="br-product-review"><i class="fas fa-star" aria-hidden="true"></i> <span> <?php echo $average_rating; ?></span></div>
            <?php
            }
            ?>
            <div class="br-product-wishlist">
                <?php
                
                if (function_exists('YITH_WCWL')) {
                    echo do_shortcode('[yith_wcwl_add_to_wishlist]');
                }
                ?>
            </div>
        </div>
    </div>
<?php }

?>