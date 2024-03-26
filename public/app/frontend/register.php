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
include_once __DIR__ . '/../src/partials/header.php';
?>

<body>
<?php include_once __DIR__ . '/../src/partials/navbar.php' ?>

    <div class="container">
            <div>
                <div>
                    <div class="text-center mb-5 mt-3">
                        <h2>Nhập thông tin đăng ký</h2>
                    </div>
                    <form action="#" class="row" id="signupForm">
                        <div class="col-6 pe-4">
                            <h4>Thông tin khách hàng</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Họ và tên:<span style="color: red;">*</span></label>
                                        <input type="text" id="lastname" name="fullname" class="form-control" placeholder="Họ và tên.." style="width: 100%;">
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
                                            <option value="">Nữ</option>
                                            <option value="">Nam</option>
                                            <option value="">Khác</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="form-group">
                                    <label for="">Email:<span style="color: red;">*</span></label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Email.." style="width: 100%;">
                                </div>
                            </div>
                            <div class="">
                                <div>
                                    <div class="form-group">
                                        <label for="">Địa chỉ:<span style="color: red;">*</span></label>
                                        <textarea name="address" id="address" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 ps-4">
                            <h4>Thông tin đăng nhập</h4>
                            <div class="">
                                <div class="form-group">
                                    <label for="">Tài Khoản:<span style="color: red;">*</span></label>
                                    <input type="username" id="username" name="username" class="form-control" placeholder="Tài khoản.." style="width: 100%;">
                                </div>
                            </div>
                            <div class="">
                                <div class="form-group">
                                    <label for="">Mật khẩu:<span style="color: red;">*</span></label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Mật khẩu.." style="width: 100%;">
                                </div>
                            </div>
                            <div class="">
                                <div class="form-group">
                                    <label for="">Nhập lại mật khẩu:<span style="color: red;">*</span></label>
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu.." style="width: 100%;">
                                </div>
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
    <?php include_once __DIR__ . '/../src/partials/footer.php' ?>