<?php
require_once __DIR__ . '/../../utils/bootstrap.php';
use CT275\Project\User;

$user = new User($PDO);
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User($PDO);
    $user->fill($_POST);
    if ($user->validate()) {
        $user->save() && redirect('/app/admin/user/users.php');
    }

    $errors = $user->getValidationErrors();
}
include_once __DIR__ . '/../partials/header.php';
?>
<style>
        .back-product-list a:nth-child(3){
            opacity: 0.5;
        }
    </style>
</head>
<body>
<?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="container" style="border-bottom:none;">
        <h2 class="text-center animate__animated animate__bounce">Quản Lí Tài Khoản</h2>
        <?php
        $subtitle = 'Thêm tài khoản mới';
        include_once __DIR__ . '/../partials/heading.php';
        ?>

        <div class="row mt-2">
            <div class="col-12">
                <form method="post" id="addUser" class="col-md-8 offset-2">
                    <div class="row">
                        <div class="col-6">
                            <!-- role_id -->
                            <div class="form-group">
                                <label for="role_id">Vai Trò</label>
                                <br>
                                <select name="role_id" id="role_id" class="form-control">
                                    <option value="" style="display: none;">-- Vai trò --</option>
                                    <option value=0>Quản Trị Viên</option>
                                    <option value=1>Người Dùng</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control<?= isset($errors['email']) ? ' is-invalid' : '' ?>" id="email" placeholder="Nhập email.." value="<?= isset($_POST['email']) ? html_escape($_POST['email']) : '' ?>" />

                                <?php if (isset($errors['email'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $errors['email'] ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <!-- fullname -->
                            <div class="form-group">
                                <label for="fullname">Họ và tên</label>
                                <input type="text" name="fullname" class="form-control<?= isset($errors['fullname']) ? ' is-invalid' : '' ?>" maxlen="255" id="fullname" placeholder="Nhập họ và tên" value="<?= isset($_POST['fullname']) ? html_escape($_POST['fullname']) : '' ?>" />

                                <?php if (isset($errors['fullname'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $errors['fullname'] ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- phone_number -->
                            <div class="form-group">
                                <label for="phone_number">Số điện thoại</label>
                                <input type="tel" name="phone_number" class="form-control<?= isset($errors['phone_number']) ? ' is-invalid' : '' ?>" id="phone_number" placeholder="Nhập số điện thoại" value="<?= isset($_POST['phone_number']) ? html_escape($_POST['phone_number']) : '' ?>" />

                                <?php if (isset($errors['phone_number'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $errors['phone_number'] ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <!-- dob -->
                            <div class="form-group">
                                <label for="dob">Ngày sinh</label>
                                <input type="date" name="dob" class="form-control<?= isset($errors['dob']) ? ' is-invalid' : '' ?>" id="dob" value="<?= isset($_POST['dob']) ? html_escape($_POST['dob']) : '' ?>" />

                                <?php if (isset($errors['dob'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $errors['dob'] ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- gender -->
                            <div class="form-group">
                                <label for="gender">Giới tính</label>
                                <br>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="" style="display: none;">-- Giới tính --</option>
                                    <option value=1>Nữ</option>
                                    <option value=2>Nam</option>
                                    <option value=3>Khác</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <!-- address -->
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <textarea name="address" class="form-control<?= isset($errors['address']) ? ' is-invalid' : '' ?>" id="address" placeholder="Nhập dịa chỉ.." value="<?= isset($_POST['address']) ? html_escape($_POST['address']) : '' ?>" style="height: 120px;" cols="30" rows="10"></textarea>

                                <?php if (isset($errors['address'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $errors['address'] ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- password -->
                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="password" name="password" class="form-control<?= isset($errors['password']) ? ' is-invalid' : '' ?>" id="password" placeholder="Nhập password.." value="<?= isset($_POST['password']) ? html_escape($_POST['password']) : '' ?>" />

                                <?php if (isset($errors['password'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $errors['password'] ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                            <!-- confirm_password -->
                            <div class="form-group">
                                <label for="confirm_password">Xác nhận mật khẩu</label>
                                <input type="password" name="confirm_password" class="form-control<?= isset($errors['confirm_password']) ? ' is-invalid' : '' ?>" id="confirm_password" placeholder="Nhập lại mật khẩu.." value="<?= isset($_POST['confirm_password']) ? html_escape($_POST['confirm_password']) : '' ?>" />

                                <?php if (isset($errors['confirm_password'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $errors['confirm_password'] ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>   
                            <!-- Submit -->
                            <button type="submit" name="submit" class="btn btn-primary">Xác nhận</button>                         
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#addUser").validate({
                rules: {
                    role_id: {
                        required: true, 
                    },
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
                    dob: {
                        required: true,
                    },
                    gender: {
                        required: true,
                    },
                    address: {
                        required: true,
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
                    address: "Bạn chưa nhập địa chỉ",
                    role_id: "Bạn chưa chọn vai trò",
                    dob: "Bạn chưa chọn ngày sinh",
                    gender: "Bạn chưa chọn giới tinh"
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
    <?php include_once __DIR__ . '/../partials/footer.php';?>

</body>
</html>