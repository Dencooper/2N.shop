<?php
require_once __DIR__ . '/../../utils/bootstrap.php';
use CT275\Project\Product;
use CT275\Project\Category;

$product = new Product($PDO);
$category = new Category($PDO);

$categories = $category->all();
$id = isset($_REQUEST['id']) ? filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;
$category = $category->find($product->find($id)->category_id);


if ($id < 0 || !($product->find($id))) {
    redirect('/app/admin/product/products.php');
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($product->validate()) {
        $product->update($_POST, $_FILES) && redirect('/app/admin/product/products.php');
    }
    $errors = $product->getValidationErrors();
}

include_once __DIR__ . '/../partials/header.php';
?>
    <style>
       .back-product-list a:nth-child(1){
            opacity: 0.5;
        }
    </style>
    <title>Cập Nhật Sản Phẩm | 2N Shop</title>
</head>
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

                    <input type="hidden" name="id" value="<?= $product->getId() ?>">

                    <!-- category_id -->
                    <div class="form-group">
                        <label for="category_id">Chọn Danh Mục Sản Phẩm</label>
                        <br>
                        <select name="category_id" id="" class="form-control">
                            <option value=<?=html_escape($category->getId())?> style="display: none;"><?=html_escape($category->name)?></option>
                            <?php foreach($categories as $category):?>
                                <option value=<?=html_escape($category->getId())?>><?=html_escape($category->name)?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <!-- title -->
                    <div class="form-group">
                        <label for="title">Tên Sản Phẩm</label>
                        <input type="text" name="title" class="form-control<?= isset($errors['title']) ? ' is-invalid' : '' ?>" maxlen="255" id="title" placeholder="Nhập tên sản phẩm" value="<?= html_escape($product->title) ?>" />

                        <?php if (isset($errors['title'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['title'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label for="price">Giá Niêm Yết</label>
                        <input type="number" name="price" class="formatted-number form-control<?= isset($errors['price']) ? ' is-invalid' : '' ?>" id="price" placeholder="Nhập giá niêm yết" value="<?= html_escape($product->price) ?>" />

                        <?php if (isset($errors['price'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['price'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>
                    <!-- Discount -->
                    <div class="form-group">
                        <label for="discount">Mức giảm giá (%)</label>
                        <input type="number" name="discount" class="form-control<?= isset($errors['discount']) ? ' is-invalid' : '' ?>" id="discount" placeholder="Nhập mức giảm giá" value="<?= html_escape($product->discount) ?>" />

                        <?php if (isset($errors['discount'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['discount'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>
                    
                    <!-- Thumbnail 1 -->
                    <div class="form-group" style="margin-top:10px;" >
                        <p style="font-size:14px;" >Nếu không thay đổi hình ảnh của sản phẩm</p>
                        <p style="font-size:14px;">Vui lòng chọn lại hình ảnh theo đường dẫn</p>
                        <p style="font-size:14px; margin-top:20px;">Hình Ảnh Của Sản Phẩm 1: <?= html_escape($product->thumb1) ?></p>
                        <input type="file" name="thumb1" id="thumb1" class="<?= isset($errors['thumb1']) ? ' is-invalid' : '' ?>"></input>
                        <?php if (isset($errors['thumb1'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['thumb1'] ?></strong>
                            </span>
                        <?php endif ?>
                        <img class="preview-image" id="preview-image1" src="../../<?= html_escape($product->thumb1) ?>" alt="Preview Image" style=" max-width: 250px; max-height: 250px;">
                    </div>
                    <!-- Thumbnail 2 -->
                    <div class="form-group" style="margin-top:40px" >
                        <p style="font-size:14px;">Hình Ảnh Của Sản Phẩm 2: <?= html_escape($product->thumb2) ?></p>
                        <input type="file" name="thumb2" id="thumb2" class="<?= isset($errors['thumb2']) ? ' is-invalid' : '' ?>"></input>
                        <?php if (isset($errors['thumb2'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['thumb2'] ?></strong>
                            </span>
                        <?php endif ?>
                        <img class="preview-image" id="preview-image2" src="../../<?= html_escape($product->thumb2) ?>" alt="Preview Image" style=" max-width: 250px; max-height: 250px;">
                    </div>

                    <!-- Submit -->
                    <button type="submit" name="submit" class="btn btn-primary">Xác nhận</button>
                </form>

            </div>
        </div>

    </div>

    <?php include_once __DIR__ . '/../partials/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            function isImage(file) {
				return file?.type.startsWith('image/');
			}
			$('#thumb1').change(function (event) {
				if(isImage(event.target.files[0])){
					var file = this.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#preview-image1').attr('src', e.target.result).show();
                        }
                        reader.readAsDataURL(file);
                    }
				} else{
					alert("Đây không phải hình ảnh!!!")
				}
			});
            $('#thumb2').change(function (event) {
				if(isImage(event.target.files[0])){
					var file = this.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#preview-image2').attr('src', e.target.result).show();
                        }
                        reader.readAsDataURL(file);
                    }
				} else{
					alert("Đây không phải hình ảnh!!!")
				}
			});
        });
    </script>
</body>

</html>