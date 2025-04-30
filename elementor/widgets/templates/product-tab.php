<div class="br-main-wrapper product-tabs yacht-tabs">
	<div class="product-tabs-navigation nav">
		<?php foreach ($categories as $category) : ?>
			<a href="#tab-<?php echo $category; ?>"><?php echo $category; ?></a>
		<?php endforeach; ?>
	</div>
	<?php foreach ($categories as $category) : ?>
		<div id="tab-<?php echo $category; ?>" class="product-tab-content <?php if ($category == $categories[0]) {
																				echo 'active';
																			} ?>">
			<ul class="br-product-wrapper br-prod-col <?php echo esc_attr($settings['columns']) ?>">

				<?php
				if ($category == 'all') {
					$args = array(
						'post_type' => 'product',
						'posts_per_page' => $settings['posts_per_page'],
						'orderby' => $settings['orderby'],
						'order' => $settings['order'],
						'show_featured' => $settings['show_featured'],
						'category_in' => $settings['category_in'],
					);
				} else {
					$args = array(
						'post_type' => 'product',
						'posts_per_page' => $settings['posts_per_page'],
						'product_cat' => $category,
						'orderby' => $settings['orderby'],
						'order' => $settings['order'],
						'show_featured' => $settings['show_featured'],
						'category_in' => $settings['category_in'],
					);
				}

				$products = new WP_Query($args);
				if ($products->have_posts()) :
					while ($products->have_posts()) :
						$products->the_post();
						//wc_get_template_part('content', 'product');
						get_template_part('template-parts/post/content-post');
						
					endwhile;
				else :
					get_template_part( 'template-parts/post/content-none' );
				endif;
				wp_reset_postdata();
				?>
			</ul>


		</div>
	<?php endforeach; ?>
</div>