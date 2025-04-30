</div>
<?php
if (empty(Boatrental_Main::get_meta('disable_footer'))) {
?>

  <!-- Footer Layout 1  -->

  
  <footer class="br-footer-wrapper sticky <?php echo esc_html(Boatrental_Main::get_meta('main_footer_style')); ?>">
    <div class="container">
        <?php do_action('footer_layout'); ?>
    </div>
</footer>



<?php } ?>




<?php wp_footer(); ?>

</body>

</html>