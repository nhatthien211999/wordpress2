<?php
/**
* Khai bao hang gia tri
* THEME_URL = lay duong dan thu muc theme
* CORE = lay duong dan cua thu muc /core
**/

define ('THEME_URL', get_stylesheet_directory());
define ('CORE', THEME_URL . "/core");


/** 
* nhung file /core/init.php
**/
// require_once('../wp-includes/user.php');
require_once(CORE . "/init.php");

/** 
* thiet lap chieu rong noi dung
* xac dinh kich thuoc cua noi dung
**/

if(!isset($content_width)){
    $content_width = 620;
}

/** 
* khai bao chuc nang
* textdomain -> file style
**/

if(!function_exists('test_theme_setup')){
    function test_theme_setup(){
        $language_folder = THEME_URL . '/languageS';
        load_theme_textdomain('nhatthien', $language_folder);
        /** 
        * tu dong them link RSS len <head> 
        * tu dong them cac chuc nang co san trong wordpress
        * khong khai bao theme khong su dung
        */
        add_theme_support( 'automatic-feed-links' );
        /**
        * them anh dai dien cho post
        * them post thumbnail
        */
       add_theme_support( 'post-thumbnails' );

        /*
        * post format
        */

        add_theme_support( 'post-formats', array( 
            'image', 
            'video',
            'quote',
            'gallery',
            'link'

            ) );
        
        /** them title tag */
        add_theme_support( 'title-tag' );

        /* custum backgound*/
        add_theme_support( 'custom-background' );
        /** 
        * Them menu 
        */
        register_nav_menu('primary-menu', __('Primary Menu', 'nhatthien'));

        /**
         * Tao sidebar
         */
        $sidebar = array(
            'name' => __('Main Sidebar', 'nhatthien'),
            'id' => 'main-sidebar',
            'description' => __('Default sidebar'),
            'class' => 'main-sidebar',
            'before_title' => '< class="widgettile">',
            'after_title' => '</h3>'


        );
        register_sidebar($sidebar);

    }
    /** 
    * tu dong tai lai trong
    * init la hooks chay khi tai lai trang
    **/
    add_action('init','test_theme_setup' );
}

/* TEMPLATE FUNCTION */
if(!function_exists('test_header')){
    function test_header(){ 
        ?>
        <div class="site-name">
        <?php
            if(is_home()){
                printf( '<h1><a href="%1$s" title="%2$s">%3$s<a/></h1>', 
                    get_bloginfo('url'),
                    get_bloginfo('description'),
                    get_bloginfo('name')
            );
            }
            else{
                printf( '<h3><a href="%1$s" title="%2$s">%3$s<a/></h1>', 
                get_bloginfo('url'),
                get_bloginfo('description'),
                get_bloginfo('name')
            );
            };

            ?>
        </div>
        <div class="site-description"><?php bloginfo('description') ?></div> 
        
        <?php
    }

}
/* Menu FUNCTION */
if(!function_exists('test_menu')){
    function test_menu($menu){
        $menu = array(
            'theme_location' => $menu,
            'container' => 'nav',
            'container_class' => $menu
        );
        wp_nav_menu($menu);
    }
}
/* phan trang FUNCTION */
if(!function_exists('test_pagination')){
    function test_pagination(){
        //kiem tra co may trang
        if($GLOBALS['wp_query']->max_num_pages < 2){
            return '';
        } ?>
        
        <nav class="pagination" role="navigation">
        
            <?php if(get_next_posts_link()) : ?>
                <div class="prev"><?php next_posts_link(__('Oder Posts','nhatthien')); ?></div>
            <?php endif; ?>

            <?php if(get_previous_posts_link()) : ?>
                <div class="next"><?php previous_posts_link(__('Newest','nhatthien')); ?></div>
            <?php endif; ?>

        </nav>
    
    <?php 
    
}

}

if(!function_exists('test_thumbnail')){
    function test_thumbnail($size){
        if( !is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image')) : ?>
            <figure class="post-thumbnail"><?php the_post_thumbnail($size); ?></figure>
        <?php endif; ?>    
    <?php }
}

if( !function_exists('test_entry_header') ){
    function test_entry_header(){
        if( is_single() ) : ?>
            <h1 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h1>
        <?php else : ?>
            <h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h2>
        <?php endif; ?>
        <?php
    }
}
// lay data post
if(!function_exists('test_entry_meta')){
    function test_entry_meta(){
        if( !is_single() ) : ?>
            <div class="entry-meta">
                <?php 
                    printf(__('<span class="author">Posted by %1$s', 'nhatthien'), get_the_author());
                    printf(__('<span class="author">Posted by %1$s', 'nhatthien'), get_the_date());
                    printf(__('<span class="author">Posted by %1$s', 'nhatthien'), get_the_category_list(','));
                    if(comments_open()){
                        echo '<span class="entry-reply" >';
                            comments_popup_link(
                                __('leave a comment', 'nhatthien'),
                                __('One comment', 'nhatthien'),
                                __('% comment', 'nhatthien'),
                                __('read all comment', 'nhatthien')
                            );
                        echo '</span>';
                    }
                ?>
            </div>
        <?php endif; ?>
        <?php
    }
}
//hien thi noi dung cua post page
if(!function_exists('test_entry_content')){
    function test_entry_content(){
        if(!is_single() && !is_page()){
            the_excerpt();
        }else{
            the_content();
            //phan trang
            $link_pages = array(
                'before' => __('<p>page:','nhatthien'),
                'after' => '</p>',
                'nextpagelink' => __('Next page', 'nhatthien'),
                'previouspagelink' => __('Previous Page', 'nhatthien')
            );
            wp_link_pages($link_pages);
        }
    }

}

function test_readmore(){
    return '<a class="read-more" href="'.get_permalink(get_the_ID()).'">'.__('...[read More]', 'nhatthien').'</a>';
}
add_filter('excerpt_more', 'test_readmore');

//hien thi tag
if(!function_exists('test_entry_tag')){
    function test_emtry_tag(){
        if(has_tag()):
            echo '<div class="entry-tag">';
            printf( __('Tagged in %1$s','nhatthien'),get_the_tag_list('',', '));

        endif;
    }
}

//nhúng file css

function test_style(){
    wp_register_style('main-style',get_template_directory_uri().'/style.css', 'all');
    wp_enqueue_style('main-style');
}

add_action('wp_enqueue_scripts','test_style');

function encrypt_user($message){
    //chuyển sang nhị phân -> lục phân
    $encryption_key = '1f4276388ad3214c873428dbef42243f';
    $key = hex2bin($encryption_key);

    //mật mã IV - lấy ra độ dài của mât mã
    $nonceSize = openssl_cipher_iv_length('AES-128-CBC');
    //tạo chuỗi byle ngẫu nhiên vs số byte xác định bởi độ dài của mật mã
    $nonce = openssl_random_pseudo_bytes($nonceSize);

    $ciphertext = openssl_encrypt(
      $message, 
      'AES-128-CBC', 
      $key,
      OPENSSL_RAW_DATA, //trả dữ liệu về kiểu base64
      $nonce
    );
    return base64_encode($nonce.$ciphertext);
}

function decrypt_user($message){
    $encryption_key = '1f4276388ad3214c873428dbef42243f';
    $key = hex2bin($encryption_key);
    $message = base64_decode($message);
    $nonceSize = openssl_cipher_iv_length('AES-128-CBC');
    $nonce = mb_substr($message, 0, $nonceSize, '8bit');

    $ciphertext = mb_substr($message, $nonceSize, null, '8bit');
    
    $plaintext= openssl_decrypt(
        $ciphertext, 
        'AES-128-CBC', 
        $key,
        OPENSSL_RAW_DATA,
        $nonce
    );
    return $plaintext;
}
function encrypt($message){
    
    $encryption_key ='1f4276388ad3214c873428dbef42243f' ;
    //chuyển sang nhị phân -> lục phân
    $key = hex2bin($encryption_key);

    //mật mã IV - lấy ra độ dài của mât mã
    $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
    //tạo chuỗi byle ngẫu nhiên vs số byte xác định bởi độ dài của mật mã
    $nonce = openssl_random_pseudo_bytes($nonceSize);

    $ciphertext = openssl_encrypt(
      $message, 
      'aes-256-ctr', 
      $key,
      OPENSSL_RAW_DATA, //trả dữ liệu về kiểu base64
      $nonce
    );
    return base64_encode($nonce.$ciphertext);
  }

  function decrypt($message){

    $encryption_key ='1f4276388ad3214c873428dbef42243f' ;
    $key = hex2bin($encryption_key);
    $message = base64_decode($message);
    $nonceSize = openssl_cipher_iv_length('aes-256-ctr');
    $nonce = mb_substr($message, 0, $nonceSize, '8bit');
    $ciphertext = mb_substr($message, $nonceSize, null, '8bit');

    $plaintext= openssl_decrypt(
      $ciphertext, 
      'aes-256-ctr', 
      $key,
      OPENSSL_RAW_DATA,
      $nonce
    );
    return $plaintext;
  }

  function checkEmail($email){
    $array = array(
		'orderby' => 'id',
		'order' => 'DESC'
	);
    $listUser = get_users($array);
    foreach ($listUser as $key => $user){
        if($user->id==1){
            continue;
        }
        if(decrypt(cutEmail($user->user_email)) == $email){
            return true;
        }
    }
    return false;
  }

  function checkName($name){
    $array = array(
		'orderby' => 'id',
		'order' => 'DESC'
	);
    $listUser = get_users($array);
    foreach ($listUser as $key => $user){
        if($user->id==1){
            continue;
        }
        if(decrypt($user->user_name) == $name){
            return true;
        }
    }
    return false;
  }

  function cutEmail($email){
    return trim($email,'@gmail.com');
  }


  function findUser($username){
    $array = array(
		'orderby' => 'id',
		'order' => 'DESC'
	);
    $listUser = get_users($array);
    foreach ($listUser as $key => $user){
        if($user->id==1){
            continue;
        }
        if(decrypt($user->user_name) == $username){
            return $user;
        }
    }    
    return;

  }
  function checkpass($user, $password){
    if($user->user_pass == $password){
        return true;
    }
    return false;
  }

//-------------------------
/* Tự động chuyển đến một trang khác sau khi login */
function my_login_redirect( $redirect_to, $request, $user ) {
    //is there a user to check?
    global $user;
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
            //check for admins
            if ( in_array( 'administrator', $user->roles ) ) {
                    // redirect them to the default place
                    return admin_url();
            } else {
                    return home_url();
            }
    } else {
            return $redirect_to;
    }
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );
function redirect_login_page() {
    $login_page  = home_url( '/dang-nhap/' );
    $page_viewed = basename($_SERVER['REQUEST_URI']);  
 
    if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_page);
        exit;
    }
}
add_action('init','redirect_login_page');

/* Kiểm tra lỗi đăng nhập */
function login_failed() {
    $login_page  = home_url( '/dang-nhap/' );
    wp_redirect( $login_page . '?login=failed' );
    exit;
}
add_action( 'wp_login_failed', 'login_failed' );  
 
function verify_username_password( $user, $username, $password ) {
    $login_page  = home_url( '/dang-nhap/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "?login=empty" );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);


function changeuser(){
    if ( is_user_logged_in() ) {

        $current_user = wp_get_current_user();
        $current_user->display_name = decrypt($current_user->display_name);
        $current_user->user_login = decrypt($current_user->user_name);
        $current_user->user_email = decrypt(cutEmail($current_user->user_email));
    }
}
add_action('init','changeuser',10 );

// function getListUser(){
//     $array = array(
// 		'orderby' => 'id',
// 		'order' => 'DESC'
// 	);
//     $listUser = get_users($array);
//     foreach ($listUser as $key => $user){
//         $user->display_name = decrypt($user->display_name);
//         $user->user_login = decrypt($user->user_name);
//         $user->user_email = decrypt($user->user_email);
//         $user->last_name = decrypt($user->last_name);
//         $user->first_name = decrypt($user->first_name);
        
//     }  

// }
//     add_action('init','getListUser');








