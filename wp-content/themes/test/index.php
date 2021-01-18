<!-- <?php
    $args = array(
        'post_type'=> 'post',
        'orderby'    => 'ID',
        'post_status' => 'publish',
        'order'    => 'DESC',
        'posts_per_page' => -1 // this will retrive all the post that is published 
        );
    $the_query = new WP_Query( $args );
    var_dump(get_the_date());
?> -->
<?php get_header(); ?>
<div class="container">
    <div id="main-content">
    <?php 
    $args = array(
        'post_type'=> 'post',
        'orderby'    => 'ID',
        'post_status' => 'publish',
        'order'    => 'DESC',
        'posts_per_page' => -1 // this will retrive all the post that is published 
        );
    $the_query = new WP_Query( $args );
    /* Kiem tra trang hien tai co data chua*/
        if($the_query->have_posts()) : while ($the_query->have_posts()): $the_query->the_post(); ?>
            
            <?php get_template_part('content', get_post_format()) ?>

        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
        <?php test_pagination() ?>
        <?php else : ?>
            <?php get_template_part('content','none') ?>
        <?php endif; ?>
        <?php get_footer(); ?>
    </div>
    
    <div id="sidebar">
        <?php get_sidebar(); ?>
    </div>
    
</div>




