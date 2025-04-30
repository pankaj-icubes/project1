<div class="br-main-wrapper product-tabs yacht-tabs">
	<div class="product-tab-content active">
	<ul class="br-product-wrapper br-prod-col <?php echo esc_attr($settings['columns']); ?>">
			<?php while ($all_products->have_posts()) :
				$all_products->the_post();
				
				get_template_part('template-parts/post/content-post');
				
				endwhile; ?>
		</ul>

	</div>
</div>