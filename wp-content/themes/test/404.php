<?php get_header(); ?>
<div class="container">
    <div id="main-content">
    <?php 
        _e('<h2>404 NOT FOUND</h2>','nhatthien');
        get_search_form();

        _e('<h3>Content Category:</h3>','nhatthien');
        echo '<div class="404-cart-list"';
            wp_list_categories( array('title_li','') );
        echo '</div>';
        wp_tag_cloud();
    ?>
    <div id="sidebar">
        <?php get_sidebar(); ?>
    </div>
</div>


<?php get_footer(); ?>
