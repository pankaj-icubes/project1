<?php 

if(Boatrental_Main::get_meta('single_blog_layout') == 'version_1') {
	
?>


<!-- Layout 1  -->

<div class="br-main-wrapper singal-blog-wrapper blog-<?php echo esc_html(Boatrental_Main::get_meta('sidebar_blog')); ?>">
    <div class="wrap-header-banner single-blog" >
        <div class="overlay">
            <div class="container">
                <div class="header-main-section header-txt-left">
                    <h1 class="header-title"><?php echo esc_html(get_the_title()); ?></h1>
                    <p class="header-description"><?php echo esc_html(custom_excerpt(get_post_field('post_excerpt', get_the_ID()), 20)); ?></p>
                    <div class="header-meta">
						<?php
						$author_display_name = esc_html(get_the_author_meta('display_name', get_post_field('post_author', get_the_ID())));
						?>
					<span><?php esc_html_e('by ', 'boatrental');  echo $author_display_name; ?></span> - 
					<span><i class="far fa-clock"></i><?php echo esc_html(display_post_reading_time()); ?></span>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="br-inside-content">
        <div class="container">
            <div class="main-content">
                <div class="blog-default">
                    <article>
                        <div class="post-content">
                            <?php echo wp_kses(get_post_field('post_content', get_the_ID()), 'post'); ?>
                        </div>
                    </article>
                </div>
            </div>
            <aside class="sidebar">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</div>






<?php }else{ ?>

	
	
	

<!-- Layout 2  -->

<div id="blog_layout_2" class="br-main-wrapper singal-blog-wrapper blog-<?php echo Boatrental_Main::get_meta('sidebar_blog'); ?>">
	<?php
	$post_tags = wp_get_post_terms(get_the_ID(), 'post_tag');
	?>
	<div class="br-inside-content">
		<div class="container">
			<div class="main-content">

			<div class="wrap-header-banner single-blog">
			<div class="overlay">
			<div class="header-meta-tag">
				<?php
				if ($post_tags) {
					foreach ($post_tags as $tag) {
						echo '<span>'. ucfirst($tag->name) . '</span>' ;
					}
				} 
				
				?>
				</div>
			
			<div class="header-main-section header-txt-left">
			
			<h1 class="header-title"><?php the_title(); ?></h1>
				<p class="header-description"><?php  echo custom_excerpt(get_post_field('post_excerpt', get_the_ID()), 9);  ?></p>
				<div class="header-meta">
					<span>by <?php echo get_post_author_name(); ?></span> - </i> <span><i class="far fa-clock"></i><?php echo display_post_reading_time(); ?></span>
				</div>
				

			</div>
			</div>
		
	</div>

				<div class="blog-default">
					<article>
						<div class="post-content">
						<?php echo get_post_field('post_content', get_the_ID()); ?>
						</div>
					</article>
				</div>
				
			</div>
			<aside class="sidebar">
			<?php get_sidebar(); ?>
			</aside>
		</div>
		
	</div>
</div>





	
<?php } ?>



