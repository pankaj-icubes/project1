<?php
if (is_active_sidebar('boatrental_sidebar')) : ?>


  <div class="widget latest-news">

    <?php dynamic_sidebar('boatrental_sidebar'); ?>

  </div>




<?php else : ?>
  <div class="no-sidebar-message">
  <p><?php esc_html_e('No sidebar available.', 'boatrental'); ?></p>
  </div>
<?php endif; ?>