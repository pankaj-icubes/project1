<div class="prod-top-right">
		<div class="add-to-fav">
			<button class="fav-btn">
				<?php
				if (function_exists('YITH_WCWL')) { ?>
					 <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]');?>
				<?php }
				?>
			</button>
		</div>
	</div>