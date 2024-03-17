<?php
require_once __DIR__ . '/../src/bootstrap.php';
use CT275\Project\Product;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = new Product($PDO);
    $product->fill($_POST);
    $product->fillThumb($_FILES); 
    if ($product->validate()) {
        $product->save() && redirect('/');
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
        $subtitle = 'Thêm sản phẩm mới';
        include_once __DIR__ . '/../src/partials/heading.php';
        ?>

        <div class="row" style="height: 80vh">
            <div class="col-12">

                <form method="post" class="col-md-6 offset-md-3" enctype="multipart/form-data">

                    <!-- Name -->
                    <div class="form-group">
                        <label for="tittle">Tên Sản Phẩm</label>
                        <input type="text" name="tittle" class="form-control<?= isset($errors['tittle']) ? ' is-invalid' : '' ?>" maxlen="255" id="tittle" placeholder="Nhập tên sản phẩm" value="<?= isset($_POST['tittle']) ? html_escape($_POST['tittle']) : '' ?>" />

                        <?php if (isset($errors['tittle'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['tittle'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label for="price">Giá Niêm Yết</label>
                        <input type="number" name="price" class="form-control<?= isset($errors['price']) ? ' is-invalid' : '' ?>" id="price" placeholder="Nhập giá niêm yết" value="<?= isset($_POST['price']) ? html_escape($_POST['price']) : '' ?>" />

                        <?php if (isset($errors['price'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['price'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>
                    <!-- Discount -->
                    <div class="form-group">
                        <label for="discount">Giá Niêm Yết</label>
                        <input type="number" name="discount" class="form-control<?= isset($errors['discount']) ? ' is-invalid' : '' ?>" id="discount" placeholder="Nhập mức giảm giá" value="<?= isset($_POST['discount']) ? html_escape($_POST['discount']) : '' ?>" />

                        <?php if (isset($errors['discount'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['discount'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Thumb -->
                    <div class="form-group">
                        <p >Hình Ảnh Sản Phẩm</p>
                        <input type="file" name="thumb" id="thumb" class="<?= isset($errors['thumb']) ? ' is-invalid' : '' ?>"><?= isset($_POST['thumb']) ? html_escape($_POST['thumb']) : '' ?></input>

                        <?php if (isset($errors['thumb'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['thumb'] ?></strong>
                            </span>
                        <?php endif ?>
                        <img id="preview-image" src="#" alt="Preview Image" style="display: none; max-width: 250px; max-height: 250px;">
                    </div>
                    <!-- Submit -->
                    <button type="submit" name="submit" class="btn btn-primary">Add product</button>
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
			$('#thumb').change(function (event) {
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