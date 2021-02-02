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
        // $sidebar = array(
        //     'name' => __('Main Sidebar', 'nhatthien'),
        //     'id' => 'main-sidebar',
        //     'description' => __('Default sidebar'),
        //     'class' => 'main-sidebar',
        //     'before_title' => '< class="widgettile">',
        //     'after_title' => '</h3>'


        // );
        // register_sidebar($sidebar);

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


//---------------------------------------------------------OPEN SSL---------------------------------------------------------

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

  function encrypt_login_email($message){
    
    $encryption_key ='1f4276388ad3214c873428dbef42243f' ;
    $key = hex2bin($encryption_key);
    $nonce = '';
    $ciphertext = openssl_encrypt(
      $message, 
      'aes-256-cbc', 
      $key,
      OPENSSL_RAW_DATA, //trả dữ liệu về kiểu base64
      null
    );
    return base64_encode($nonce.$ciphertext);
  }

  function decrypt_login_email($message){
    $encryption_key ='1f4276388ad3214c873428dbef42243f' ;
    $key = hex2bin($encryption_key);
    $message = base64_decode($message);
    $ciphertext = mb_substr($message, null, null, '8bit');
    $plaintext= openssl_decrypt(
      $ciphertext, 
      'aes-256-cbc', 
      $key,
      OPENSSL_RAW_DATA,
      null
    );
    return $plaintext;
  }

  function cutEmail($email){
    return trim($email,'@gmail.com');
  }
  function cutUrl($url){
    return trim($url,'http://');
  }



//-----------------------------------------------------------------------------------------------------------
//change col user table

// ----------------col username---------------
add_filter( 'manage_users_columns', function( $columns )
{
    return array_slice( $columns, 0, 1, true ) 
        + [ 'mycol1' => __( 'User Name' ) ] 
        + array_slice( $columns, 2, null, true );
} );


add_filter( 'manage_users_custom_column', function( $default, $column_name, $user_id )
{
    if( 'mycol1' === $column_name ){
        $u = new WP_User( $user_id ); 
        if ($u instanceof \WP_User) {
            $edit_link = get_edit_user_link( $user_id );
            $default .= "<a href='$edit_link'>".decrypt_login_email($u->user_login)."</a>" ;
        }
    
        return ($default) ;
    }
}, 10, 3 );  

// ------------col name-------------
add_filter( 'manage_users_columns', function( $columns )
{
    return array_slice( $columns, 0, 2, true ) 
        + [ 'mycol2' => __( 'Name' ) ] 
        + array_slice( $columns, 3, null, true );
} );
add_filter( 'manage_users_custom_column', function( $output, $column_name, $user_id )
{
    if( 'mycol2' === $column_name )
    {
        $u = new WP_User( $user_id ); 
        if( $u instanceof \WP_User )
        {
            // Default output
            $output = decrypt($u->display_name);
            unset( $u ); 
        }
    }       
    return $output;
}, 10, 3 );  

add_filter( 'manage_users_sortable_columns', function( $columns )
{
    $columns['mycol2'] = 'name';
    return $columns;
} );

// //-----col email-----------
add_filter( 'manage_users_columns', function( $columns )
{
    return array_slice( $columns, 0, 3, true ) 
        + [ 'mycol3' => __( 'Email' ) ] 
        + array_slice( $columns, 4, null, true );
} );
add_filter( 'manage_users_custom_column', function( $output, $column_name, $user_id )
{
    if( 'mycol3' === $column_name )
    {
        $u = new WP_User( $user_id ); 
        if( $u instanceof \WP_User )
        {
            // Default output
            $output = decrypt_login_email(cutEmail($u->user_email));

            unset( $u ); 
        }
    }       
    return $output;
}, 10, 3 );  


//-------add field list user-------
    
add_filter('manage_users_columns', 'pippin_add_user_id_column');
function pippin_add_user_id_column($columns) {
    $user = wp_get_current_user ();
    $columns['user_id'] = 'User ID';
    return $columns;
}
 
add_action('manage_users_custom_column',  'pippin_show_user_id_column_content', 10, 3);
function pippin_show_user_id_column_content($value, $column_name, $user_id) {
   
    $user = get_userdata( $user_id );
	if ( 'user_id' == $column_name )
		return $user_id;
    return $value;
}
//--------------------------------------------------------



//--------------------Updata user_name table usermeta-------------------------------
// define the user_register callback 


//create user
add_filter( 'wp_pre_insert_user_data' , 'filter_user_data' , 99, 1 );

function filter_user_data( $userdata ) {
    global $pagenow;
    if ( $pagenow != 'user-edit.php' || $pagenow != 'profile.php') {   
        $userdata['user_login'] = encrypt_login_email($_POST['user_login']);
    }

    if(isset($_POST['display_name'])){
        $userdata['display_name'] = encrypt($_POST['display_name']);
    }
    else{
        $userdata['display_name'] = encrypt($_POST['first_name'].' '.$_POST['last_name']);
    }

    $userdata['user_email'] = encrypt_login_email($_POST['email']).'@gmail.com';
    $userdata['user_url'] = encrypt($_POST['url']);

    return $userdata;
}

add_filter( 'insert_user_meta', 'filter_user_meta', 99, 2);

function filter_user_meta( $meta, $user ) {
    
    $meta['first_name'] = encrypt($_POST['first_name']);
    $meta['last_name'] = encrypt($_POST['last_name']);

    return $meta;
}

// -------Check exits username & email
add_filter( 'username_exists', 'check_username_exists', 99, 2);

function check_username_exists( $user_id, $username ) {

    if($user_id == false){

        $user = get_user_by( 'login', encrypt_login_email($username) );

        if ( $user ) {
            $user_id = $user->ID;
        } else {
            $user_id = false;
        }
    }
    return apply_filters( 'username_exist', $user_id, $username );

}

add_filter( 'email_exists', 'check_email_exists', 99, 2);

function check_email_exists( $user_id, $email ) {
    global $pagenow;
    if ( $pagenow == 'user-edit.php' || $pagenow != 'profile.php'){
        if($user_id == false){
            $user = get_user_by( 'email', encrypt_login_email($email).'@gmail.com' );
            if ( $user ) {
                if($user->id == $_POST['user_id']){
                    $user_id = false;
                }
                else{
                    $user_id = $user->id;
                }
            } else {
                $user_id = false;
            }
        }
        return apply_filters( 'email_exist_page_edit', $user_id, $email );
    }else{
        if($user_id == false){
            $user = get_user_by( 'email', encrypt_login_email($email).'@gmail.com' );
            if ( $user ) {
                $user_id = $user->ID;
            } else {
                $user_id = false;
            }
        }
        return apply_filters( 'email_exist', $user_id, $email );
    }

}



// remove wordpress authentication
remove_filter('authenticate', 'wp_authenticate_username_password', 20);


// -------------------------------------Override Login-----------------------------------------------------

add_filter('authenticate', function($user, $email, $password){

    //Check for empty fields
        if(empty($email) || empty ($password)){        
            //create new error object and add errors to it.
            $error = new WP_Error();
    
            if(empty($email)){ //No email
                $error->add('empty_username', __('<strong>ERROR</strong>: Email field is empty.'));
            }
            else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ //Invalid Email
                $error->add('invalid_username', __('<strong>ERROR</strong>: Email is invalid.'));
            }
    
            if(empty($password)){ //No password
                $error->add('empty_password', __('<strong>ERROR</strong>: Password field is empty.'));
            }
    
            return $error;
        }
    
        //Check if user exists in WordPress database
        $user = get_user_by( 'email', encrypt_login_email($email).'@gmail.com' );
    
        //bad email
        if(!$user){
            $error = new WP_Error();
            $error->add('invalid', __('<strong>ERROR</strong>: Either the email or password you entered is invalid.'));
            return $error;
        }
        else{ //check password
            if(!wp_check_password($password, $user->user_pass, $user->ID)){ //bad password
                $error = new WP_Error();
                $error->add('invalid', __('<strong>ERROR</strong>: Either the email or password you entered is invalid.'));
                return $error;
            }else{
                return $user; //passed
            }
        }
    }, 20, 3);

add_filter('authenticate', function($user, $username, $password){

    //Check for empty fields
    if(empty($username) || empty ($password)){        
            //create new error object and add errors to it.
            $error = new WP_Error();
    
            if(empty($username)){ //No user
               $error->add( 'empty_username', __( '<strong>Error</strong>: The username field is empty.' ) );
            }
            else if(!filter_var($username, FILTER_VALIDATE_EMAIL)){ //Invalid User
                $error->add('invalid_username', __('<strong>ERROR</strong>: UserName is invalid.'));
            }
    
            if(empty($password)){ //No password
                $error->add('empty_password', __('<strong>ERROR</strong>: Password field is empty.'));
            }
    
            return $error;
        }
    
        //Check if user exists in WordPress database
        $user = get_user_by( 'login', encrypt_login_email($username) );
    
        //bad email
        if(!$user){
            $error = new WP_Error();
            $error->add('invalid', __('<strong>ERROR</strong>: Either the UserName or password you entered is invalid.'));
            return $error;
        }
        else{ //check password
            if(!wp_check_password($password, $user->user_pass, $user->ID)){ //bad password
                $error = new WP_Error();
                $error->add('invalid', __('<strong>ERROR</strong>: Either the UserName or password you entered is invalid.'));
                return $error;
            }else{
                return $user; //passed
            }
        }
    }, 20, 3);

//get data form edit profile
    add_filter('wp_get_user_edit_by', 'get_user_decrypt');
    function get_user_decrypt($user){

        $user->user_login = decrypt_login_email($user->user_login);
        $user->last_name = decrypt($user->last_name);
        $user->first_name = decrypt($user->first_name);
        $user->user_email = decrypt_login_email(esc_attr( cutEmail( $user->user_email )));
        $user->user_url = decrypt(cutUrl($user->user_url));
        $user->display_name = decrypt($user->display_name);
        
        return apply_filters( 'wp_get_user_edit_by_data', $user );
    }

    
    // add_filter ('manage_users_columns', 'users_columns') ;
    // add_filter ('manage_users_custom_column', 'users_custom_column', 10, 3) ;
    
    // function users_columns ($cols)
    // {
    //     $cols['author_page'] = 'Author page' ;
    
    //     return ($cols) ;
    // }
    
    // function users_custom_column ($default, $column_name, $user_id)
    // {
    //     $u = get_userdata( $user_id ); 
    //     if ('author_page' == $column_name) {
    //         $edit_link = get_edit_user_link( $user_id );
    //         $default .= "<a href='$edit_link'>".decrypt_login_email($u->user_login)."</a>" ;
    //         }
    
    //     return ($default) ;
    // }
    add_action('init','set_data' );
    function set_data(){
        global $current_user;
        wp_get_current_user() ;
        $current_user->display_name = decrypt($current_user->display_name);
        $current_user->user_login = decrypt_login_email($current_user->user_login);
    }


/* 
// add library js
add_action( 'admin_head', 'library_js' );
function library_js() {     
    ?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
    <?php
}
add_action( 'admin_head', 'wpse39285_field_placement_js' );
function wpse39285_field_placement_js() {
    global $pagenow;
    if ( $pagenow == 'profile.php' ) {
        $user = wp_get_current_user();
        ?>
        <script type="text/javascript">

            $(document).ready(function($) {
                var user_login = '<?php echo decrypt_login_email(esc_attr( $user->user_login )); ?>';
                
                $(".username").text(user_login);
                console.log(user_login);
            });
        </script>
        <?php
    }
    
}
*/