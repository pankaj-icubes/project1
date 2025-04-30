<?php
$terms = get_terms(
	array(
		'taxonomy' => 'location',
		'orderby' => $settings['orderby'],
		'order' => $settings['order'],
		'number' => $settings['posts_per_page']
	)
);
$random = (rand(10,100));
if ($terms && !is_wp_error($terms)) :
?>

	<div class="yacht-slides-wrapper">
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

		<div class="yacht-slides location1">
		<ul class="br-product-wrapper slider center_<?php echo esc_attr($random); ?>" data-json_format="<?php echo esc_attr(htmlspecialchars($data_product_sliderone_add_settings)); ?>" data-slider_class="<?php echo esc_attr($random); ?>">

				<?php foreach ($terms as $term) : ?>
					<?php
					$args = array(
						'post_type' => 'product',
						'posts_per_page' => 1,
						'tax_query' => array(
							array(
								'taxonomy' => 'location',
								'field' => 'slug',
								'terms' => $term->slug
							)
						)
					);
					$query = new WP_Query($args);
					if ($query->have_posts()) :
						while ($query->have_posts()) :
							$query->the_post();
							$txt_upload_image = get_term_meta($term->term_id, 'term_image', true);
							$data_params = http_build_query(array(
								'pro_location' => array($term->term_id),
								// Add more data if needed
							));
					?>
								<li class="br-prod-list slide">
								<div class="br-head-product">
									<a href="<?php echo esc_url(home_url('shop/?' . $data_params)); ?>">
										<img src="<?php echo esc_url($txt_upload_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="br-product-img">
									</a>
								</div>

								<div class="br-foot-product">
									<div class="br-product-title"> <a href="<?php echo esc_url(home_url('shop/?' . $data_params)); ?>"> <?php echo esc_html($term->name); ?> </a></div>
									<div class="br-product-description gallery-caption">+ <?php echo esc_html($query->found_posts); ?> <?php echo esc_html('Yachts available here', 'boatrental'); ?></div>
									<a href="<?php echo esc_url(home_url('shop/?' . $data_params)); ?>" class="br-btn"><?php echo esc_html('View Detail', 'boatrental'); ?></a>
								</div>
								
							</li>
					<?php endwhile;
					endif;

					wp_reset_postdata();
					?>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>



		</ul>



		</div>
	</div>


<script>
	jQuery(document).ready(function() {
		initializeSlider('<?php echo esc_js($random); ?>');
	});


</script>