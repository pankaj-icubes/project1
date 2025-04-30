
<div class="br-main-wrapper blog-wrapper">

<div class="wrap-header-banner br-list-blog" >
	<div class="overlay">
		<div class="container">
			<div class="header-main-section header-txt-center">
			<h1 class="header-title"><?php esc_html_e('Inspiration for travel by real people', 'boatrental'); ?></h1>
			<p class="header-description"><?php esc_html_e('Book smart, travel simple', 'boatrental'); ?></p>
			</div>
		</div>
	</div>

	</div>

	

		<div class="br-content">
		<div class="container">
			<div class="br-inner">
				<ul class="br-ul column<?php echo Boatrental_Main::get_meta('blog_col') ?>">
					<?php
					if (have_posts()) :
						while (have_posts()) :
							the_post();
					?>
							<article id="post-<?php the_ID(); ?>" class="custom-post">

								<?php if ( has_post_thumbnail() ) : ?>
									<div class="post-media">
										<?php
											get_template_part('template-parts/media/thumbnail');
										?>
									</div>
								<?php
								else: ?>
									<div class="br-post-image">
										<a href="<?php the_permalink(); ?>">
											<img src="<?php echo esc_url(boatrental_no_image); ?>" alt="" class="br-product-img">
										</a>
									</div>

									
								<?php endif; ?>

								<div class="br-post-content">
								   <div class="post-title">
									<?php get_template_part('template-parts/media/title'); ?>
									</div>


									<div class="post-excerpt">
										<?php get_template_part('template-parts/media/excerpt'); ?>
									</div>

									<?php 
									  
									  echo '<div class="post-user">';
									  echo '<img src="' . esc_url(get_avatar_url(get_the_author_meta('ID'), array('size' => 64))) . '" alt="' . esc_attr(get_the_author_meta('display_name')) . '">';
									  echo '<span class="bypostauthor">' . esc_html(get_the_author_meta('display_name')) . '</span>';
									  echo '</div>';
									?>


									<div class="post-meta">
										<?php get_template_part('template-parts/media/meta'); 
										?>
									</div>

									<div class="post-readmore">
										<?php get_template_part('template-parts/media/readmore'); ?>
									</div>
								</div>

							</article>
						<?php
						endwhile;
					else :
						?>
						<p><?php esc_html_e('No posts found', 'Boatrental'); ?></p>
					<?php endif; ?>
				</ul>
				
				<div class="pagination">
					<?php echo boatrental_woocommerce_pagination(); ?>
				</div>
			</div>


			<!-- Two Column product End -->
			</div>
		</div>
		<?php

		do_action('woocommerce_after_main_content');

		/**
		 * Hook: woocommerce_sidebar.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		?>
	  
</div>

<?php

get_footer('shop');
