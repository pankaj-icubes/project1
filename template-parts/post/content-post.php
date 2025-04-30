<li class="br-product-list">
	<?php
		// do_action( 'woocommerce_before_shop_loop_item' );

		do_action( 'woocommerce_before_shop_loop_item_title' );
	?>


	<div class="br-foot-product">

		<?php 
			do_action('woocommerce_shop_loop_item_title');
		
			do_action('woocommerce_after_shop_loop_item');
		
			do_action('woocommerce_shop_loop_item_meta'); 
		?>
	</div>
	<?php if (get_post_type() === 'post') { ?>
		<div class="post-excerpt">
			<?php get_template_part('template-parts/media/excerpt'); ?>
		</div>
	<?php } ?>
</li>