<div class="br-main-wrapper br-search">
  <div class="container">
				<h1 class="heading">
					<?php esc_html_e('Search Results for: ','boatrental'); printf( '<span>%s</span>', get_search_query() ); ?>
</h1>



<div class="br-search-main">

			<?php
			global $wpdb;

			$search_term = sanitize_text_field($_GET['s']);

			$query = $wpdb->prepare("
				SELECT p.*
				FROM {$wpdb->prefix}posts AS p
				WHERE p.post_type IN ('post', 'product')
				AND (
					p.post_title LIKE '%%%s%%'
					OR p.post_content LIKE '%%%s%%'
				)
			", $search_term, $search_term);


			$results = $wpdb->get_results($query);

			if ($results) :
				$total_products = count($results);
				echo "<p>(".$total_products." Results found) </p>";
				foreach ($results as $post) :
					setup_postdata($post);

					?>
					<div class="br-wrap-box">
							<?php
							if( has_post_thumbnail()  ) : ?>
								
								<div class="box-left">
								<div class="post-media">
									<?php 
										get_template_part( 'template-parts/media/thumbnail' );
									?>
								</div>
									</div>

							<?php endif; ?>
							<div class="box-right">
								<?php get_template_part( 'template-parts/media/title' ); ?>
								
								<?php get_template_part( 'template-parts/media/meta' ); ?>
								
								<div class="post-excerpt">
									<?php get_template_part( 'template-parts/media/excerpt' ); ?>
								</div>
								<?php get_template_part( 'template-parts/media/readmore' ); ?>
							</div>
					</div>
			<?php
				endforeach;
			?>
			</div>

			<div class="pagination-wrapper">
				<?php
				$args = array(
					'type'      => 'list',
					'next_text' => '<i class="ovaicon-next"></i>',
					'prev_text' => '<i class="ovaicon-back"></i>',
				);

				the_posts_pagination($args);
				?>
			</div>

			<?php else : ?>

			<p>
				<?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'boatrental'); ?>
			</p>
			
			<?php endif; ?>


			</div>	
</div>

