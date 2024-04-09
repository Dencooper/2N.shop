<?php
require_once __DIR__ . '/../../utils/bootstrap.php';
use CT275\Project\Category;

$category = new Category($PDO);
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = new Category($PDO);
    $category->fill($_POST);
    if ($category->validate()) {
        $category->save() && redirect('/app/admin/category/categories.php');
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
    <title>Thêm Danh Mục | 2N Shop</title>
</head>
<body>
<?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="container" style="border-bottom:none;">
        <h2 class="text-center animate__animated animate__bounce">Quản Lí Danh Mục</h2>
        <?php
        $subtitle = 'Thêm danh mục mới';
        include_once __DIR__ . '/../partials/heading.php';
        ?>

        <div class="row">
            <div class="col-12">

                <form method="post" class="col-md-6 offset-md-3">
                    <!-- name -->
                    <div class="form-group">
                        <label for="name">Tên Danh Mục</label>
                        <input type="text" name="name" class="form-control<?= isset($errors['name']) ? ' is-invalid' : '' ?>" maxlen="255" id="name" placeholder="Nhập tên danh mục" value="<?= isset($_POST['name']) ? html_escape($_POST['name']) : '' ?>" />

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

    <?php include_once __DIR__ . '/../partials/footer.php';?>
</body>

</html>