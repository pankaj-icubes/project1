<?php 
/*
Template Name: Blog Single Layout 2
*/
get_header();


$post_title = 'the-ultimate-guide-to-choosing-the-perfect-boat-for-your-vacation';

// Get the post based on the title
$post = get_page_by_path($post_title, OBJECT, 'post');

// Check if the post exists
if ($post) {
    
    setup_postdata($post);

    if (empty(get_the_post_thumbnail_url(get_the_ID(), 'full'))) {
        $image = boatrental_no_image;
    } else {
        $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
    }
    $background_image = "
    .single_data {
            background-image: url(" . $image . ");
        }
        
    ";
    echo '<style>' . $background_image . '</style>';
?>
    <div id="blog_layout_2" class="br-main-wrapper singal-blog-wrapper blog-<?php echo Boatrental_Main::get_meta('sidebar_blog'); ?>">
        <?php
        $post_tags = wp_get_post_terms($post->ID, 'post_tag');
        ?>
        <div class="br-inside-content">
            <div class="container">
                <div class="main-content">
                    <div class="wrap-header-banner single-blog single_data">
                        <div class="overlay">
                            <div class="header-meta-tag">
                                <?php
                                if ($post_tags) {
                                    foreach ($post_tags as $tag) {
                                        echo '<span>' . ucfirst($tag->name) . '</span>';
                                    }
                                }
                                ?>
                            </div>
                            <div class="header-main-section header-txt-left">
                                <h1 class="header-title"><?php echo esc_html(get_the_title($post)); ?></h1>
                                <p class="header-description"><?php echo esc_html(custom_excerpt(get_post_field('post_excerpt', $post->ID), 9)); ?></p>
                                <div class="header-meta">
                                    <span>by <?php echo esc_html(get_post_author_name($post->post_author)); ?></span> -
                                    <span><i class="far fa-clock"></i><?php echo esc_html(display_post_reading_time($post)); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="blog-default">
                        <article>
                            <div class="post-content">
                                <?php echo wp_kses(get_post_field('post_content', $post->ID), 'post'); ?>
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
<?php
} else {
    echo 'Post not found.';
}


get_footer('');
?>
