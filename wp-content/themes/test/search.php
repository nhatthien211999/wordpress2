<?php get_header(); ?>
<div class="container">
    <div id="main-content">
    <div class="search-info">
    <?php 
        $search_query = new WP_Query('s='.$s.'&showpost=-1');
        $search_keyword = wp_specialchars($s, 1);
        $search_count = $search_query->post_count;

        printf(__('We found %1$s articles for your search query.', 'nhatthien'), $search_count);
    ?>
    </div>
    <?php 
    /* Kiem tra trang hien tai co data chua*/
        if(have_posts()) : while (have_posts()): the_post(); ?>
            
            <?php get_template_part('content', get_post_format()) ?>

        <?php endwhile; ?>
        <?php test_pagination() ?>
        <?php else : ?>
            <?php get_template_part('content','none') ?>
        <?php endif; ?>
    
    </div>
    <div id="sidebar">
        <?php get_sidebar(); ?>
    </div>
</div>


<?php get_footer(); ?>