<?php
require_once __DIR__ . '/../../utils/bootstrap.php';
use CT275\Project\User;

$user = new User($PDO);

$id = isset($_REQUEST['id']) ? filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;

if ($id < 0 || !($user->find($id))) {
    redirect('/app/admin/user/users.php');
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($user->update($_POST)) {
        redirect('/app/admin/user/users.php');
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
                                    <option value="" style="display: none;">
                                    <?php if ($user->gender == 0) :?>
                                    <td class="align-middle">Quẩn trị viên</td>
                                    <?php else :?>
                                        <td class="align-middle">Người dùng</td>
                                    <?php endif ?></option>
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
    <?php include_once __DIR__ . '/../partials/footer.php' ?>
                                                                                                        
</body>
</html>