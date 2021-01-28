<?php
/*
 Template Name: Login Page
 */
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/core.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/md5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/aes.js"></script>

<style>
        body {
                background: #2E8D41;
                font-family: Arial, sans-serif;
                font-size: 14px;
                line-height: 1.5em;
        }
        .login-area {
                background: #FFF;
                margin: 100px auto;
                width: 960px;
                padding: 1em;
                overflow: hidden;
        }
        .note {
                float: left;
                margin-right: 20px;
        }
        .form {
                float: right;
                width: 250px;
                text-align: center;
        }
        label {
                display: block;
        }
        input[type=email], input[type=number], input[type=password], input[type=search], input[type=tel], input[type=text], input[type=url], select, textarea {
                border: 1px solid #DDD;
                -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.07);
                box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.07);
                background-color: #FFF;
                color: #333;
                -webkit-transition: .05s border-color ease-in-out;
                transition: .05s border-color ease-in-out;
                padding: 5px 10px;
        }
        input[type=submit] {
                        background: #51a818;
                        background-image: -webkit-linear-gradient(top, #51a818, #3d8010);
                        background-image: -moz-linear-gradient(top, #51a818, #3d8010);
                        background-image: -ms-linear-gradient(top, #51a818, #3d8010);
                        background-image: -o-linear-gradient(top, #51a818, #3d8010);
                        background-image: linear-gradient(to bottom, #51a818, #3d8010);
                        -webkit-border-radius: 10px;
                        -moz-border-radius: 10px;
                        border-radius: 10px;
                        font-family: Arial;
                        color: #ffffff;
                        padding: 10px 20px 10px 20px;
                        border: solid #32a840 2px;
                        text-decoration: none;
        }       
</style>
<?php get_header(); ?>
<div class="login-area">
        <div class="note">
                <h3>Đăng nhập</h3>
                <p>Hãy sử dụng tài khoản của bạn để đăng nhập vào website. Nếu chưa có tài khoản, <a href="<?php bloginfo('url'); ?>/wordpress2/dang-ky/">đăng ký tại đây</a>.</p>
        </div>
        <div class="form">
                <?php
                        $args = array(
                                'redirect'       => site_url( $_SERVER['REQUEST_URI'] ),
                                'form_id'        => 'dangnhap', //Để dành viết CSS
                                'label_username' => __( 'Tên tài khoản' ),
                                'label_password' => __( 'Mật khẩu' ),
                                'label_remember' => __( 'Ghi nhớ' ),
                                'label_log_in'   => __( 'Đăng nhập' ),
                        );
                        wp_login_form($args);
                ?>
        </div>
</div>

<?php
        $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;
        if ( $login === "failed" ) {
                echo '<p><strong>ERROR:</strong> Sai username hoặc mật khẩu.</p>';
        } elseif ( $login === "empty" ) {
                echo '<p><strong>ERROR:</strong> Username và mật khẩu không thể bỏ trống.</p>';
        } elseif ( $login === "false" ) {
                echo '<p><strong>ERROR:</strong> Bạn đã thoát ra.</p>';
        }
?>
<script>
// $(document).ready(function(){
//         $('#wp-submit').on( 'click',function( event ) {               
//                 var temp = CryptoJS.MD5($('#user_login').val()).toString();               
//                 $("<input />").attr("type", "hidden")
//                 .attr("name", "log")
//                 .attr("value", temp)
//                 .appendTo("#dangnhap");

//                 // // document.dangnhap.log.value = temp;
//                 var field = document.getElementById("user_login");
//                 field.id = "username";  // using element properties
//                 field.setAttribute("name", "userName");  // using .setAttribute() method
//         } );
// })
</script>