<?php get_header(); ?>
<div class="content">
    <?php if(have_posts()) : while (have_posts()): the_post(); ?>
            
        <?php get_template_part('content', get_post_format()) ?>
        <!-- profile tác giả -->
        <?php get_template_part('author-bio') ?>
        <?php comments_template(); ?>

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
