<?php
require_once __DIR__ . '/../utils/bootstrap.php';
use CT275\Project\Product;

$product = new Product($PDO);

$id = isset($_REQUEST['id']) ? filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;
if ($id < 0 || !($product->find($id))) {
    redirect('/app/admin/index.php');
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($product->update($_POST, $_FILES)) {
        redirect('/app/admin/index.php');
    }
    $errors = $product->getValidationErrors();
}

include_once __DIR__ . '/partials/header.php';
?>

<body>
<?php include_once __DIR__ . '/partials/navbar.php'; ?>


    <!-- Main Page Content -->
    <div class="container" style="border-bottom:none;" >

        <?php
        $subtitle = 'Cập nhật thông tin sản phẩm';
        include_once __DIR__ . '/partials/heading.php';
        ?>

        <div class="row">
            <div class="col-12">

                <form method="post" class="col-md-6 offset-md-3" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?= $product->getId() ?>">

                    <!-- Tittle -->
                    <div class="form-group">
                        <label for="tittle">Tên Sản Phẩm</label>
                        <input type="text" name="tittle" class="form-control<?= isset($errors['tittle']) ? ' is-invalid' : '' ?>" maxlen="255" id="tittle" placeholder="Nhập tên sản phẩm" value="<?= html_escape($product->tittle) ?>" />

                        <?php if (isset($errors['tittle'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['tittle'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label for="price">Giá Niêm Yết</label>
                        <input type="number" name="price" class="form-control<?= isset($errors['price']) ? ' is-invalid' : '' ?>" id="price" placeholder="Nhập giá niêm yết" value="<?= html_escape($product->price) ?>" />

                        <?php if (isset($errors['price'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['price'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>
                    <!-- Discount -->
                    <div class="form-group">
                        <label for="discount">Mức Giảm Giá</label>
                        <input type="number" name="discount" class="form-control<?= isset($errors['discount']) ? ' is-invalid' : '' ?>" id="discount" placeholder="Nhập mức giảm giá" value="<?= html_escape($product->discount) ?>" />

                        <?php if (isset($errors['discount'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['discount'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Thumbnail 1 -->
                    <div class="form-group" style="margin-top:30px" >
                        <p style="font-size:14px;" >Hình Ảnh Của Sản Phẩm 1: <?= html_escape($product->thumb1) ?></p>
                        <input type="file" name="thumb1" id="thumb1" class="<?= isset($errors['thumb1']) ? ' is-invalid' : '' ?>"></input>
                        <?php if (isset($errors['thumb1'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['thumb1'] ?></strong>
                            </span>
                        <?php endif ?>
                        <img class="preview-image" id="preview-image1" src="../<?= html_escape($product->thumb1) ?>" alt="Preview Image" style=" max-width: 250px; max-height: 250px;">
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
                        <img class="preview-image" id="preview-image2" src="../<?= html_escape($product->thumb2) ?>" alt="Preview Image" style=" max-width: 250px; max-height: 250px;">
                    </div>

                    <!-- Submit -->
                    <button type="submit" name="submit" class="btn btn-primary">Update product</button>
                </form>

            </div>
        </div>

    </div>

    <?php include_once __DIR__ . '/partials/footer.php' ?>
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