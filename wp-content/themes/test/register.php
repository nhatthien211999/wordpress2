<?php /* Template Name: register page */ ?>

<?php if(is_user_logged_in()) { 
    $user_id = get_current_user_id();
    $current_user = wp_get_current_user();
    $profile_url = get_author_posts_url($user_id);
    $edit_profile_url = get_edit_profile_url($user_id); 

?>

<div class="regted">
    Bạn đã đăng nhập với tên nick <a href="<?php echo $profile_url ?>">
    <?php echo $current_user->display_name; ?>
    </a> Bạn có muốn 
    <a href="<?php echo esc_url(wp_logout_url($current_url)); ?>">Thoát</a> không ?
</div>
<?php } else { ?>
<div class="dangkytaikhoan">
    <?php 
        $err = ''; 
        $success = ''; 
        global $wpdb, $PasswordHash, $current_user, $user_ID; 
        if(isset($_POST['task']) && $_POST['task'] == 'register' ) { 
            $pwd1 = $wpdb->escape(trim($_POST['pwd1']));
            $pwd2 = $wpdb->escape(trim($_POST['pwd2']));
            $email = $wpdb->escape(trim($_POST['email']));
            $first_name = $wpdb->escape(trim($_POST['first_name']));
            $last_name = $wpdb->escape(trim($_POST['last_name']));
            $username = $wpdb->escape(trim($_POST['username']));
            $display_name = $wpdb->escape(trim($_POST['first_name']).' '.trim($_POST['last_name']));
            
            if( $email == "" || $pwd1 == "" || $pwd2 == "" || $username == "") {
                $err = 'Vui lòng không bỏ trống những thông tin bắt buộc!';
            } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $err = 'Địa chỉ Email không hợp lệ!.';
            } else if(get_user_by( 'email', encrypt_login_email($email) ) ) { //???? 
                $err = 'Địa chỉ Email đã tồn tại!.';
            } else if(get_user_by( 'login', encrypt_login_email($username) )){
                $err = 'User name đã tồn tại!.';
            } else if($pwd1 <> $pwd2 ){
                $err = '2 Password không giống nhau!.';
            } else {
                $user_id = wp_insert_user( 
                    array (
                        'user_pass' => apply_filters('pre_user_pass',$pwd1), 
                        'user_login' => apply_filters('pre_user_login', encrypt_login_email($username)), 
                        'first_name' => apply_filters('pre_user_first_name', encrypt($first_name)),
                        'last_name' => apply_filters('pre_user_last_name', encrypt($last_name)),
                        'user_email' => apply_filters('	pre_user_email', encrypt_login_email($email).'@gmail.com'),
                        'display_name' => apply_filters('pre_user_display_name', encrypt($display_name)),  
                        'role' => 'subscriber' ) 
                    );

                update_user_meta( $user_id, 'user_name', encrypt($username) );

                
                if( is_wp_error($user_id) ) {
                    $err = 'Error on user creation.';
                } else {
                    do_action('user_register', $user_id);
                    $success = 'Bạn đã đăng ký thành công!';
                }
            }
    }
    ?>
<!--display error/success message-->
<div id="message">
        <?php
            if(! empty($err) ) :
                echo ''.$err.'';
            endif;
        ?>
        <?php
            if(! empty($success) ) :
                $login_page  = home_url( '/dang-nhap.html' );
                echo ''.$success. '<a href='.$login_page.'> Đăng nhập</a>'.'';
            endif;
        ?>
    </div>
    <form class="form-horizontal" method="post" role="form">
<div class="form-group">
    <label class="control-label  col-sm-3" for="username">Tên đăng nhập:</label>
    <div class="col-sm-9">
    <input type="text" class="form-control" name="username" id="username" placeholder="Tên Đăng nhập">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-3" for="email">Email:</label>
    <div class="col-sm-9">
        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
    </div>
</div>
<div class="form-group">
    <label class="control-label  col-sm-3" for="userfirst_name">First Name:</label>
    <div class="col-sm-9">
    <input type="text" class="form-control" name="first_name" id="first_name">
    </div>
</div>
<div class="form-group">
    <label class="control-label  col-sm-3" for="last_name">Last Name:</label>
    <div class="col-sm-9">
    <input type="text" class="form-control" name="last_name" id="last_name">
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-3" for="pwd1">Password:</label>
    <div class="col-sm-9">
        <input type="password" class="form-control" name="pwd1" id="pwd1" placeholder="Nhập password">
    </div>

</div>
<div class="form-group">
    <label class="control-label col-sm-3" for="pwd2">Nhập lại Pass:</label>
    <div class="col-sm-9">
        <input type="password" class="form-control" name="pwd2" id="pwd2" placeholder="Nhập lại password">
    </div>
</div>
<?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
    <button type="submit" class="btn btn-primary">Đăng ký</button>
    <input type="hidden" name="task" value="register" />
    </div>
</div>
</form>
</div>
<div class="thongbaologin">
    <?php
        $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;
        if ( $login === "failed" ) {
                echo '<strong>ERROR:</strong> Sai username hoặc mật khẩu.!';
        } elseif ( $login === "empty" ) {
                echo '<strong>ERROR:</strong> Username và mật khẩu không thể bỏ trống.';
        } elseif ( $login === "false" ) {
                echo '<strong>ERROR:</strong> Bạn đã thoát ra.';
        }
    ?>
</div>
 
<?php } ?>


