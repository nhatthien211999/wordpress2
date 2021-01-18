<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
    <div class="entry-header">
        <?php test_entry_header(); ?>
        <?php test_entry_meta(); ?>
    </div>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php (is_single() ? test_emtry_tag() : ''); ?>
    </div>
</article>