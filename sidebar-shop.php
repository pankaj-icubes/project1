<?php
/**
 * The sidebar containing the main widget area
 *
 *
 * @package boatrental
 */

if (is_active_sidebar( 'woocommerce-sidebar' ) && ! is_product()):
?> 
<aside id="secondary" class="sidebar-widget-area widget-area woocommerce-widget-area order-first">
	<?php dynamic_sidebar( 'woocommerce-sidebar' ); ?>
</aside><!-- #secondary -->
<?php else: ?>
<aside id="secondary" class="sidebar-widget-area widget-area woocommerce-widget-area order-first">
	<div class="woocommerce-widget sidebar-widget widget">
	</div>
</aside>
<?php endif; ?>
