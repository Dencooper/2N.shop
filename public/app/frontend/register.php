<?php
require_once __DIR__ . '/../utils/bootstrap.php';
include_once __DIR__ . '/partials/header.php';

use CT275\Project\User;

$user = new User($PDO);
?>
<title>Đăng kí tài khoản | 2N Shop</title>

<?php

include_once __DIR__ . '/partials/navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        if (!($user->checkRegister($_POST['email']))) {
            echo "<script>alert(\"Email đã được sử dụng!\");</script>";
        } else {
            $user = new User($PDO);
            $user->fill($_POST);
            if ($user->validate()) {
                $user->save();
                echo "<script>alert(\"Bạn đã đăng kí tài khoản thành công\");</script>";
                header('Location: login.php');
                exit();
            }
            
        }
    } else {
        echo "Vui lòng điền đầy đủ thông tin cần thiết!";
    }
}
?>

    <div class="container" style="padding-top:70px" >
        <div class="main-register" style="display: block;">
            <h3 style="text-align: center; margin-bottom: 30px;">ĐĂNG KÝ TÀI KHOẢN</h3>
            <form class="row" id="signupForm" method="post">
                <div class="col-6 pe-4">
                    <h4>Thông tin khách hàng</h4>
                    <input type="hidden" name="role_id" value=1>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Họ và tên:<span style="color: red;">*</span></label>
                                <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Họ và tên.." style="width: 100%;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email:<span style="color: red;">*</span></label>
                                <input type="text" id="email" name="email" class="form-control" placeholder="Email.." style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Điện thoại:<span style="color: red;">*</span></label>
                                <input type="tel" id="phone_number" name="phone_number" class="form-control" placeholder="Điện thoại.." style="width: 100%;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Ngày sinh:<span style="color: red;">*</span></label>
                                <input type="date" id="dob" name="dob" class="form-control" placeholder="Ngày sinh.." style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Giới tính:<span style="color: red;">*</span></label>
                                <select id="gender" name="gender" class="form-control" style="font-size: 14px; padding: 10px;">
                                    <option value=1>Nữ</option>
                                    <option value=2>Nam</option>
                                    <option value=3>Khác</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div>
                            <div class="form-group">
                                <label for="">Địa chỉ:<span style="color: red;">*</span></label>
                                <textarea type="text" id="address" name="address" class="form-control" style="width: 100%; height: 80px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 ps-4">
                    <h4>Thông tin mật khẩu</h4>
                    <div class="row">
                        <div class="form-group">
                            <label for="">Mật khẩu:<span style="color: red;">*</span></label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Mật khẩu.." style="width: 100%;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label for="">Nhập lại mật khẩu:<span style="color: red;">*</span></label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu.." style="width: 100%;">
                        </div>
                    </div>
                    <div class="checked-me mb-1">
                        <input type="checkbox" id="username" name="email_username" class="me-2">
                        <label for="regis">Email là tên tài khoản</label>
                    </div>
                    <div class="checked-me mb-1">
                        <input type="checkbox" id="agree" name="agree" class="me-2">
                        <label for="agree">Đồng ý với các <a href="" style="color: rgb(237, 97, 97); font-size: 14px;">điều khoản</a> của IVY</label>
                    </div>
                    <div class="checked-me mb-3">
                        <input type="checkbox" id="regis" name="regis" class="me-2">
                        <label for="regis">Đăng ký nhận bản tin</label>
                    </div>
                    <button type="submit" class="button pb-4">Đăng Ký</button>
                </div>
            </form>
        </div>
    </div>

    <?php include_once __DIR__ . '/partials/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#signupForm").validate({
                rules: {
                    fullname: {
                        required: true, 
                        minlength: 4 
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone_number: {
                        required: true,
                        tel: true
                    },
                    password: {required: true, minlength: 6 },
                    confirm_password: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    }    
                },
                messages: {
                    fullname: {
                        required: "Bạn chưa nhập họ và tên",
                        minlength: "Bạn chưa nhập đủ họ tên"
                    },
                    email: {
                        required: "Bạn chưa nhập vào email",
                        email: "Email không hợp lệ "
                    },
                    phone_number: {
                        required: "Bạn chưa nhập số điện thoại",
                        email: "Số điện thoại khồng hợp lệ"
                    },
                    password: {
                        required: "Bạn chưa nhập mật khẩu",
                        minlength: "Mật khẩu phải có ít nhất 5 ký tự" 
                    },
                    confirm_password: {
                        required: "Bạn chưa nhập mật khẩu",
                        minlength: "Mật khẩu phải có ít nhất 5 ký tự",
                        equalTo: "Mật khẩu không trùng khớp với mật khẩu trên"
                    },
                    address: "Bạn chưa nhập địa chỉ"
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
</body>
</html>