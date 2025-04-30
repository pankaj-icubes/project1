<div class="br-search-icon search_popup_icon" id="searchIcon">
    <i class="fas fa-search"></i>
</div>

<div class="search-overlay" id="searchOverlay">
    <div class="br-search-popup" id="searchPopup1">
        <div class="search-popup-content container">
            <form class="search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <div class="close-icon" id="closeIcon"></div>
                    <span class="screen-reader-text">
                        <?php echo _x('Search for:', 'label', 'boatrental'); ?>
                    </span>
                    <input type="text" placeholder="Search..." value="<?php echo get_search_query(); ?>" name="s" >
                    <button type="submit"><i class="fas fa-search" aria-hidden="true" class="br_search"></i></button>
            </form>
        </div>
    </div>
</div>


