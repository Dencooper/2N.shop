<?php
// Kiểm tra xem có dữ liệu được gửi từ form hay không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem tất cả các trường bắt buộc đã được điền đầy đủ hay không
    if (!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        // Lấy dữ liệu từ form
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        // Kiểm tra xem trường "address" có dữ liệu không
        $address = !empty($_POST['address']) ? $_POST['address'] : NULL;

        // Thực hiện kết nối đến CSDL
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=ct275_project', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Kết nối đến CSDL thất bại: " . $e->getMessage();
            exit();
        }

        // Kiểm tra xem username đã tồn tại trong CSDL hay không
        $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM user WHERE username = ?");
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_count = $row['count'];

        if ($user_count > 0) {
            // Username đã tồn tại, hiển thị thông báo lỗi
            echo "Tên đăng nhập đã tồn tại. Vui lòng chọn một tên đăng nhập khác.";
        } else {
            // Username chưa tồn tại, tiến hành thêm người dùng mới vào CSDL
            $sql = "INSERT INTO user (fullname, email, username, password, address) VALUES (:fullname, :email, :username, :password, :address)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['fullname' => $fullname, 'email' => $email, 'username' => $username, 'password' => $password, 'address' => $address]);

            // Hiển thị thông báo đăng ký thành công
            echo "Đăng ký thành công!";
            // Chuyển hướng người dùng đến trang đăng nhập
            header('Location: login.php');
            exit();
        }
    } else {
        // Nếu có bất kỳ trường bắt buộc nào không được điền, hiển thị thông báo lỗi
        echo "Vui lòng điền đầy đủ thông tin cần thiết!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"/>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="card">
                    <div class="card-header alert-info" role="alert">
                        <h4>Nhập thông tin đăng ký</h4>
                    </div>
                    <div class="card-body">
                        <form id="signupForm" action="#" method="post">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Họ và Tên</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="fullname" placeholder="Nhập họ và tên của bạn"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Email</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email" placeholder="Nhập email của bạn"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Tên đăng nhập</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="username" placeholder="Nhập tên đăng nhập"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Mật khẩu</label>
                                <div class="col-sm-5">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Nhập mật khẩu"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Nhập lại mật khẩu</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="confirm_password" placeholder="Nhập lại mật khẩu"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Địa chỉ</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="address" placeholder="Nhập địa chỉ của bạn"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5 offset-sm-4">
                                    <button type="submit" class="btn btn-primary" name="signup" value="Sign up">Đăng ký</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

 <script type="text/javascript">
//        $.validator.setDefaults({
//        submitHandler: function() { alert("submitted!"); }
//        });

        $(document).ready(function () {
            $("#signupForm").validate({
                rules: {
                    fullname: "required",
                    username: {required: true, minlength: 2 },
                    password: {required: true, minlength: 5 },
                    confirm_password: {
                        required: true,
                        minlength: 5,
                        equalTo: "#password"
                    }    
                },
                messages: {
                    fullname: "Bạn chưa nhập họ và tên của bạn",
                    email: {
                    required: true,
                    email: true
                    },
                    username: {
                        required: "Bạn chưa nhập vào tên đăng nhập",
                        minlength: "Tên đăng nhập phải có ít nhất 2 ký tự"
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