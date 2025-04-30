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
	<div class="yacht-slides container location2">
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
					?>
								<li class="br-prod-list slide">
									<div class="br-head-product">
										<a href="<?php echo esc_url(get_term_link($term)); ?>">
											<img src="<?php echo esc_url($txt_upload_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="br-product-img">
										</a>
									</div>

									<div class="br-foot-product">
										<div class="br-product-title"> <a href="<?php echo esc_url(get_term_link($term)); ?>"> <?php echo esc_html($term->name); ?> </a></div>
										<div class="br-product-description gallery-caption">+ <?php echo esc_html($query->found_posts); ?> Yachts available here</div>
										<a href="<?php echo esc_url(get_term_link($term)); ?>" class="br-btn">View Detail</a>
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