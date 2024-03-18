<?php
require_once __DIR__ . '/../src/bootstrap.php';
use CT275\Project\Product;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = new Product($PDO);
    $product->fill($_POST);
    $product->fillThumb1($_FILES);
    $product->fillThumb2($_FILES); 
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

        <div class="row">
            <div class="col-12">

                <form method="post" class="col-md-6 offset-md-3" enctype="multipart/form-data">

                    <!-- Tittle -->
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

                    <!-- Thumb1 -->
                    <div class="form-group">
                        <p >Hình Ảnh 1 của Sản Phẩm</p>
                        <input type="file" name="thumb1" id="thumb1" class="<?= isset($errors['thumb1']) ? ' is-invalid' : '' ?>"><?= isset($_POST['thumb1']) ? html_escape($_POST['thumb1']) : '' ?></input>

                        <?php if (isset($errors['thumb1'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['thumb1'] ?></strong>
                            </span>
                        <?php endif ?>
                        <img id="preview-image1" src="#" alt="Preview Image" style="display: none; max-width: 250px; max-height: 250px;">
                    </div>
                    <!-- Thumb2 -->
                    <div class="form-group">
                        <p >Hình Ảnh 2 của Sản Phẩm</p>
                        <input type="file" name="thumb2" id="thumb2" class="<?= isset($errors['thumb2']) ? ' is-invalid' : '' ?>"><?= isset($_POST['thumb2']) ? html_escape($_POST['thumb2']) : '' ?></input>

                        <?php if (isset($errors['thumb2'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['thumb2'] ?></strong>
                            </span>
                        <?php endif ?>
                        <img id="preview-image2" src="#" alt="Preview Image" style="display: none; max-width: 250px; max-height: 250px;">
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