<div id="main-content" class="main">
   <div class="container">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('post-wrap '); ?>>
               <?php the_content(); ?>
               <?php wp_link_pages(array(
                  'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'boatrental') . '</span>',
                  'after'       => '</div>',
                  'link_before' => '<span>',
                  'link_after'  => '</span>',
                  'pagelink'    => '<span class="screen-reader-text">' . esc_html__('Page', 'boatrental') . ' </span>%',
                  'separator'   => '',
               ));
               ?>
            </article>
         <?php endwhile;
      else : ?>
         <p>
            <?php esc_html_e('Sorry, no pages matched your criteria.', 'boatrental'); ?>
         </p>
      <?php endif; ?>
      
   </div>

</div>