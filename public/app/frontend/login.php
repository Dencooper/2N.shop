<?php
require_once __DIR__ . '/../utils/bootstrap.php';
include_once __DIR__ . '/partials/header.php';

use CT275\Project\User;

$user = new User($PDO);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $user->checkLogin($email, $password);
        if ($role === 1){
            $_SESSION['email'] = $email;
            setcookie('session_cookie', session_id(), time() + 3600, '/');
            header('location: ../../home.php');
            exit();
        } 
        else if ($role === 0){
            $_SESSION['email'] = $email;
            setcookie('session_cookie', session_id(), time() + 3600, '/'); 
            header('location: ../../app/admin/product/products.php');
            exit();
        } 
        else {
            echo "<script>alert(\"Email hoặc password không tồn tại!\");</script>";
        }
        
    }
}

?>
<title>Đăng nhập | 2N Shop</title>
<?php include_once __DIR__ . '/partials/navbar.php' ?>

        <div class="container" style="padding-bottom: 50px; padding-top: 80px;">
            <div class="main-login d-flex">
                <div class="left-login">
                    <h3>Bạn đã có tài khoản 2N Shop</h3>
                    <p>Nếu bạn đã có tài khoản, hãy đăng nhập để tích lũy điểm thành viên và nhận được ưu đãi tốt hơn</p>
                    <form method="post" id="loginForm" >
                        <input type="text" class="form-control" placeholder="Email của bạn" name="email">
                        <input type="password" class="form-control" placeholder="Mật khẩu" name="password">
                        <div class="checked-me mt-3">
                            <input type="checkbox" id="checked">
                            <label for="">Ghi nhớ đăng nhập</label>
                        </div>
                        <div class="other-login d-flex">
                            <a href="">Quên mật khẩu?</a>
                            <a href="">Đăng nhập bằng OTP</a>
                        </div>
                        <button type="submit" class="button">Đăng Nhập</button>
                    </form>
                </div>
                <div class="right-login">
                    <h3>Khách hàng mới của 2N Shop</h3>
                    <p>Nếu bạn chưa có tài khoản trên 2nshop.com, hãy sử dụng tùy chọn này để truy cập biểu mẫu đăng ký.</p>
                    <p>Bằng cách cung cấp cho 2N Shop thông tin chi tiết của bạn,</p>
                    <p>quá trình mua hàng trên 2nshop.com sẽ là một trải nghiệm thú vị và nhanh chóng hơn!</p>
                    <div class="button">
                        <a href="register.php">Đăng kí ngay</a>
                    </div>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

 <script type="text/javascript">
        $(document).ready(function () {
            $("#loginForm").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {required: true, minlength: 5 }
                },
                messages: {
                    email: {
                        required: "Bạn chưa nhập vào email",
                        email: "Email không hợp lệ"
                    },
                    password: {
                        required: "Bạn chưa nhập mật khẩu",
                        minlength: "Mật khẩu phải có ít nhất 5 ký tự" 
                    }
                },
                errorElement: "div",
                errorPlacement: function (error, element) {
                    error.addClass("invalid-feedback");
                    if(element.prop("type") === "checkbox") {
                        error.insertAfter(element.siblings("label"));
                    }else{
                        error.insertAfter(element);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });
        });
    </script> 
    <?php include_once __DIR__ . '/partials/footer.php' ?>