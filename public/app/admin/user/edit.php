<?php
require_once __DIR__ . '/../../utils/bootstrap.php';
include_once __DIR__ . '/../partials/header.php';
$id = isset($_REQUEST['id']) ? filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;

if ($id < 0 || !($user->find($id))) {
    redirect('/app/admin/user/users.php');
}
$user = $user->find($id);
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($user->update($_POST)) {
        redirect('/app/admin/user/users.php');
    }
    $errors = $user->getValidationErrors();
}
?>
<style>
       .back-product-list a:nth-child(3){
            opacity: 0.5;
        }
    </style>
    <title>Cập Nhật Tài Khoản | 2N Shop</title>
</head>
<body>
<?php include_once __DIR__ . '/../partials/navbar.php'; ?>
    <!-- Main Page Content -->
    <div class="container" style="border-bottom:none;" >
        <h2 class="text-center animate__animated animate__bounce">Quản Lí Tài Khoản</h2>
        <?php
        $subtitle = 'Cập nhật thông tin tài khoản';
        include_once __DIR__ . '/../partials/heading.php';
        ?>

        <div class="row mt-3">
            <div class="col-12">

            <form method="post" id="addUser" class="col-md-8 offset-2">
                    <div class="row">
                        <div class="col-6">
                            <!-- role_id -->
                            <div class="form-group">
                                <label for="role_id">Vai Trò</label>
                                <br>
                                <select name="role_id" id="role_id" class="form-control">
                                    <option value=<?= html_escape($user->role_id)?> style="display: none;"><?php if (html_escape($user->role_id) == 0) {
                                        echo "Quản Trị Viên";
                                    }
                                    else {
                                        echo "Người dùng";
                                    }?></option>
                                    <option value=0>Quản trị viên</option>
                                    <option value=1>Người dùng</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control<?= isset($errors['email']) ? ' is-invalid' : '' ?>" id="email" placeholder="Nhập email.." value="<?= html_escape($user->email)?>" />

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
                                <input type="text" name="fullname" class="form-control<?= isset($errors['fullname']) ? ' is-invalid' : '' ?>" maxlen="255" id="fullname" placeholder="Nhập họ và tên" value="<?= html_escape($user->fullname)?>" />

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
                                <input type="tel" name="phone_number" class="form-control<?= isset($errors['phone_number']) ? ' is-invalid' : '' ?>" id="phone_number" placeholder="Nhập số điện thoại" value="<?= html_escape($user->phone_number)?>" />
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
                            <!-- address -->
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <textarea name="address" class="form-control<?= isset($errors['address']) ? ' is-invalid' : '' ?>" id="address" placeholder="Nhập dịa chỉ.." style="height: 120px;" cols="30" rows="10"><?= html_escape($user->address)?></textarea>

                                <?php if (isset($errors['address'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $errors['address'] ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- dob -->
                            <div class="form-group">
                                <label for="dob">Ngày sinh</label>
                                <input type="date" name="dob" class="form-control<?= isset($errors['dob']) ? ' is-invalid' : '' ?>" id="dob" value="<?= html_escape($user->dob)?>" />

                                <?php if (isset($errors['dob'])) : ?>
                                    <span class="invalid-feedback">
                                        <strong><?= $errors['dob'] ?></strong>
                                    </span>
                                <?php endif ?>
                            </div>
                            <!-- gender -->
                            <div class="form-group">
                                <label for="gender">Giới tính</label>
                                <br>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="<?= html_escape($user->gender)?>" style="display: none;"><?php if ($user->gender == 1) :?>Nữ
                                    <?php elseif ($user->gender == 2) :?>Nam
                                    <?php elseif ($user->gender == 3) :?>Khác
                                    <?php endif ?></option>
                                    <option value=1>Nữ</option>
                                    <option value=2>Nam</option>
                                    <option value=3>Khác</option>
                                </select>
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
                        minlength: 9,
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
                        minlength: "Số điện thoại không hợp lệ",
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
                    gender: "Bạn chưa chọn giới tính"
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
    <?php include_once __DIR__ . '/../partials/footer.php' ?>                                                                        
</body>
</html>