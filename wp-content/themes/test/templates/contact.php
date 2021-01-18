<?php
/*
    Template Name: Contact
*/
?>

<?php get_header(); ?>
<div class="container">
    <div id="main-content">
    <div class="contact-info">
        <h4>Địa chỉ liên hệ</h4>
        <p>Addres: ...............</p>
        <p>Phone: 085xxxxxx</p>  
    </div>
    <div class="contact-form">
    <?php echo do_shortcode('[contact-form-7 id="1619" title="Contact form 1"]'); ?>
    </div>
    
    </div>
    <div id="sidebar">
        <?php get_sidebar(); ?>
    </div>
</div>


<?php get_footer(); ?>