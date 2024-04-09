<?php
require_once __DIR__ . '/../../utils/bootstrap.php';
use CT275\Project\Category;

$category = new Category($PDO);

$id = isset($_REQUEST['id']) ? filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;

if ($id < 0 || !($category->find($id))) {
    redirect('/app/admin/category/categories.php');
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($category->update($_POST)) {
        redirect('/app/admin/category/categories.php');
    }
    $errors = $category->getValidationErrors();
}

include_once __DIR__ . '/../partials/header.php';
?>
    <style>
        .back-product-list a:nth-child(2){
            opacity: 0.5;
        }
    </style>
    <title>Cập Nhật Danh Mục | 2N Shop</title>

<body>
<?php include_once __DIR__ . '/../partials/navbar.php'; ?>


    <!-- Main Page Content -->
    <div class="container" style="border-bottom:none;" >
        <h2 class="text-center animate__animated animate__bounce">Quản Lí Sản Phẩm</h2>
        <?php
        $subtitle = 'Cập nhật thông tin sản phẩm';
        include_once __DIR__ . '/../partials/heading.php';
        ?>

        <div class="row">
            <div class="col-12">

                <form method="post" class="col-md-6 offset-md-3" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?= $category->getId() ?>">

                    <!-- name -->
                    <div class="form-group">
                        <label for="name">Tên Danh Mục</label>
                        <input type="text" name="name" class="form-control<?= isset($errors['name']) ? ' is-invalid' : '' ?>" maxlen="255" id="name" placeholder="Nhập tên danh mục" value="<?= html_escape($category->name) ?>" />

                        <?php if (isset($errors['name'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['name'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>
                    <!-- Submit -->
                    <button type="submit" name="submit" class="btn btn-primary">Xác nhận</button>
                </form>

            </div>
        </div>

    </div>

    <?php include_once __DIR__ . '/../partials/footer.php' ?>
</body>

</html>