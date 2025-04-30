<?php 
/*
Template Name: Tours And Destination Template
*/
get_header();

$terms = get_terms(
    array(
        'taxonomy' => 'location',
        'orderby' => 'ASC',
        'order' => 'ID',
    )
);

?>
<div class="br-main-wrapper blog-wrapper tour-wrapper br-tour-wrapper">
    <div class="wrap-header-banner">
    <div class="overlay">
		<div class="container">
			<div class="header-main-section header-txt-center">
            <h1 class="header-title"><?php esc_html_e('Our Favorite Holiday Destinations', 'boatrental'); ?></h1>
            <p class="header-description"><?php esc_html_e('Book smart, travel simple', 'boatrental'); ?></p>

			</div>
		</div>
</div>
	</div>


<div class="tour-destination-wrapper">
    <div class="br-content">
        <div class="container">
            <ul class="br-ul">
                <?php if (!empty($terms)) : ?>
                    <?php foreach ($terms as $term) : ?>
                        <?php
                        // Get products for the current location term
                        $args = array(
                            'post_type' => 'product',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'location',
                                    'field' => 'term_id',
                                    'terms' => $term->term_id,
                                ),
                            ),
                        );
                        $products_query = new WP_Query($args);
                        $product_count = $products_query->found_posts;
                        $data_params = http_build_query(array(
                            'pro_location' => array($term->term_id),
                            // Add more data if needed
                        ));
                        $txt_upload_image = get_term_meta($term->term_id, 'term_image', true);
                        ?>
                        <li class="br-tour-list">
                            <div class="br-head">
                            <a href="<?php echo esc_url(home_url('shop/?' . esc_attr($data_params))); ?>" class="data_data">
                            <img src="<?php echo esc_url($txt_upload_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="br-product-img">
                            </a>
                            </div>
                            <div class="br_foot">
                                <h3 class="br-title">
                                <a href="<?php echo esc_url(home_url('shop/?' . esc_attr($data_params))); ?>" rel="bookmark" title="<?php echo esc_html($term->name); ?>"><?php echo esc_html($term->name); ?></a>
                                </h3>
                                <div class="br-description">+ <?php echo $product_count; echo esc_html(' yachts available', 'boatrental'); ?></div>
                                <a href="<?php echo esc_url(home_url('shop/?' . esc_attr($data_params))); ?>" class="br-btn" tabindex="-1"><?php esc_html_e('View Yachts', 'boatrental'); ?></a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</div>
</div>


<?php 	get_footer(); ?>