<?php
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/classes/product.php';

use CT275\Project\Product;

$product = new Product($PDO);

$id = isset($_REQUEST['id']) ? filter_var($_REQUEST['id'], FILTER_SANITIZE_NUMBER_INT) : -1;
if ($id < 0 || !($product->find($id))) {
    redirect('/');
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($product->update($_POST, $_FILES)) {
        redirect('/');
    }
    $errors = $product->getValidationErrors();
}

include_once __DIR__ . '/../src/partials/header.php';
?>

<body>
    <?php include_once __DIR__ . '/../src/partials/navbar.php' ?>

    <!-- Main Page Content -->
    <div class="container">

        <?php
        $subtitle = 'Cập nhật thông tin sản phẩm';
        include_once __DIR__ . '/../src/partials/heading.php';
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

                    <!-- Thumbnail -->
                    <div class="form-group">
                        <p >Hình Ảnh Của Sản Phẩm: <?= html_escape($product->thumb) ?></p>
                        <input type="file" name="thumb" id="thumb" class="<?= isset($errors['thumb']) ? ' is-invalid' : '' ?>"></input>
                        <?php if (isset($errors['thumb'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['thumb'] ?></strong>
                            </span>
                        <?php endif ?>
                        <img id="preview-image" src="<?= html_escape($product->thumb) ?>" alt="Preview Image" style=" max-width: 250px; max-height: 250px;">
                    </div>

                    <!-- Submit -->
                    <button type="submit" name="submit" class="btn btn-primary">Update product</button>
                </form>

            </div>
        </div>

    </div>

    <?php include_once __DIR__ . '/../src/partials/footer.php' ?>
    <script>
        $(document).ready(function() {
            function isImage(file) {
				return file?.type.startsWith('image/');
			}
			$('#avatar').change(function (event) {
				if(isImage(event.target.files[0])){
					var file = this.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#preview-image').attr('src', e.target.result).show();
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