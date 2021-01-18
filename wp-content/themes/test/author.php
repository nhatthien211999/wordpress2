<?php get_header(); ?>
<div class="container">
    <div id="main-content">
    <div class="author-box">
        <?php get_template_part('author-bio') ?>
    </div>
    <?php if(is_tag() || is_category()): ?>
            <div class="archive-description">
                <?php echo term_description(); ?>
            </div>
        
    <?php endif; ?>
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