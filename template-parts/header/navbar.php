<div class="br-header-inner header1">
  <div class="br-header-container">

    <!-- logo -->
    <div class="br-brand navbar-<?php echo esc_attr( Boatrental_Main::get_meta('logo_alignment') ); ?>">
      <a class="br-logo" href="<?php echo esc_url( boatrental_url ); ?>"><img src="<?php echo esc_attr(  Boatrental_Main::get_meta('sitelogo') ); ?>" alt="Logo" class="img-fluid"></a>
    </div>

      <!-- Navigation -->
      <div class="br-navigation-wrapper">
        <?php if (empty(Boatrental_Main::get_meta('disable_top_header'))) { ?>


          <nav class="mobile-nav hamburger-menu">
            <div id="mySidenav" class="sidenav">
            <div class="sidenav-wrap-m">
              <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

              <?php
              $args = array(
                'theme_location'   => 'primary_menu',
                'menu_class' => 'br-main-menu-mobile navbar-nav demo navbar-' . Boatrental_Main::get_meta('menu_alignment'),
                'menu_id' => 'boatrentl_mobile',
              );

              echo wp_nav_menu($args);
              ?>
             </div>
            </div>

            <span class="openbtn" onclick="openMobileNav()"><i class="fas fa-bars" aria-hidden="true"></i></span>
          </nav>







          <nav class="br-navigation">
            <?php
            $args = array(
              'theme_location' => 'primary_menu', // Menu location name
              'menu_class' => 'br-main-menu navbar-nav demo navbar-' . Boatrental_Main::get_meta('menu_alignment'),
            );

            echo wp_nav_menu($args);
            
            ?>

            
          </nav>







        <?php } ?>
      </div>
 


    <script>
      function openMobileNav() {
        document.getElementById("mySidenav").style.width = "100%";
      }

      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
      }
    </script>







    <!-- Search -->

    <div class="br-header-nav">

    <?php

    if (!array_key_exists("disable_search", Boatrental_Main::get_meta()) && Boatrental_Main::get_meta('disable_search') !== 1) {
      get_search_form();
    }


    ?>


    <script>
      const closeIcon = document.getElementById("closeIcon");
      const searchIcon = document.getElementById("searchIcon");
      const searchOverlay = document.getElementById("searchOverlay");
      const searchPopup = document.getElementById("searchPopup");

      searchIcon.addEventListener("click", () => {
        searchOverlay.style.display = "block";
        searchPopup.style.display = "block";
      });

      closeIcon.addEventListener("click", () => {
        searchOverlay.style.display = "none";
        searchPopup.style.display = "none";
      });

      searchOverlay.addEventListener("click", (event) => {
        if (event.target === searchOverlay) {
          searchOverlay.style.display = "none";
          searchPopup.style.display = "none";
        }
      });
    </script>


<div class="br-minicarts"> <?php do_action('boatrental_display_minicart'); ?> </div>

<?php
    if (Helpers::is_user_logged_in_check()) { ?>
    <div class="br-login-section">

<!-- dashboard -->
<div class="br-dashboard br-account">

  <span>
    <a href="#"><i class="fas fa-user" aria-hidden="true"></i> <?php echo esc_html(ucfirst(wp_get_current_user()->display_name)); ?> </a>
  </span>
  
  <div class="br-account-sub">
  <ul>
      <li><a href="<?php echo esc_url(wc_get_account_endpoint_url('')); ?>"><?php esc_html_e('My Account', 'boatrental'); ?></a></li>
      <li><a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>"><?php esc_html_e('Orders', 'boatrental'); ?></a></li>
      <li><a href="<?php echo esc_url(wc_get_account_endpoint_url('wishlist')); ?>"><?php esc_html_e('Wishlist', 'boatrental'); ?></a></li>
      <li><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>"><?php esc_html_e('Logout', 'boatrental'); ?></a></li>
  </ul>

  </div>

</div>
</div>
    </div>
<?php } else { ?>
<div class="br-signin br-account">
<span><a href="<?php echo esc_url( boatrental_url . 'my-account/' ); ?>"><i class="fa fa-sign-in" aria-hidden="true"></i><?php esc_html_e('Sign up', 'boatrental'); ?></a></span>
</div>
<?php }

?>
</div>

</div>


</div>



<?php
