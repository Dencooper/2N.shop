<?php
require_once __DIR__ . '/../../utils/bootstrap.php';
use CT275\Project\Product;
use CT275\Project\Category;

$category = new Category($PDO);
$categories = $category->all();
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = new Product($PDO);
    $product->fill($_POST);
    $product->fillThumb1($_FILES);
    $product->fillThumb2($_FILES); 
    if ($product->validate()) {
        $product->save() && redirect('/app/admin/product/products.php');
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
</head>
<body>
<?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <!-- Main Page Content -->
    <div class="container" style="border-bottom:none;">
        <h2 class="text-center animate__animated animate__bounce">Quản Lí Sản Phẩm</h2>
        <?php
        $subtitle = 'Thêm sản phẩm mới';
        include_once __DIR__ . '/../partials/heading.php';
        ?>

        <div class="row">
            <div class="col-12">

                <form method="post" class="col-md-6 offset-md-3" enctype="multipart/form-data" id="addProductForm" >
                    <!-- category_id -->
                    <div class="form-group">
                        <label for="category_id">Chọn Danh Mục Sản Phẩm</label>
                        <br>
                        <select name="category_id" class="form-control">
                            <option style="display: none;">-- Tên Danh Mục --</option>
                            <?php foreach($categories as $category):?>
                                <option value=<?=$category->getId()?>><?=html_escape($category->name)?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <!-- title -->
                    <div class="form-group">
                        <label for="title">Tên Sản Phẩm</label>
                        <input type="text" name="title" class="form-control" maxlen="255" id="title" placeholder="Nhập tên sản phẩm"  />

                        <?php if (isset($errors['title'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['title'] ?></strong>
                            </span>
                        <?php endif ?>
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label for="price">Giá Niêm Yết</label>
                        <input type="number" name="price" class="form-control" id="price" placeholder="Nhập giá niêm yết"/>

                    </div>
                    <!-- Discount -->
                    <div class="form-group">
                        <label for="discount">Mức giảm giá (%)</label>
                        <input type="number" name="discount" class="form-control" id="discount" placeholder="Nhập mức giảm giá" value="<?= isset($_POST['discount']) ? html_escape($_POST['discount']) : '' ?>" />

                    </div>

                    <!-- Thumb1 -->
                    <div class="form-group" style="margin-top:30px">
                        <p style="font-size:14px;">Hình Ảnh 1 của Sản Phẩm</p>
                        <input type="file" name="thumb1" id="thumb1" ><?= isset($_POST['thumb1']) ? html_escape($_POST['thumb1']) : '' ?></input>

                        <img class="preview-image" id="preview-image1" src="#" alt="Preview Image" style="display: none; max-width: 250px; max-height: 250px;">
                    </div>
                    <!-- Thumb2 -->
                    <div class="form-group" style="margin-top:40px">
                        <p style="font-size:14px;">Hình Ảnh 2 của Sản Phẩm</p>
                        <input type="file" name="thumb2" id="thumb2" class="<?= isset($errors['thumb2']) ? ' is-invalid' : '' ?>"><?= isset($_POST['thumb2']) ? html_escape($_POST['thumb2']) : '' ?></input>

                        <?php if (isset($errors['thumb2'])) : ?>
                            <span class="invalid-feedback">
                                <strong><?= $errors['thumb2'] ?></strong>
                            </span>
                        <?php endif ?>
                        <img class="preview-image" id="preview-image2" src="#" alt="Preview Image" style="display: none; max-width: 250px; max-height: 250px;">
                    </div>
                    <!-- Submit -->
                    <button type="submit" name="submit" class="btn btn-primary">Xác nhận</button>
                </form>

            </div>
        </div>

    </div>

    <?php include_once __DIR__ . '/../partials/footer.php';?>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#addProductForm").validate({
                rules: {
                    category_id: {
                        range: [1, 99]
                    },
                    title: {
                        required: true, 
                        minlength: 4 
                    },
                    price: {
                        required: true,
                        price: true
                    },
                    discount: {
                        required: true,
                        tel: true
                    },
                    thumb1: {
                        required: true,
                    },
                    thumb2: {
                        required: true,
                    },    
                },
                messages: {
                    title: {
                        required: "Bạn chưa nhập vào tên sản phẩm",
                        minlength: "Bạn chưa nhập vào tên sản phẩm"
                    },
                    price: {
                        required: "Bạn chưa nhập vào giá sản phẩm",
                        number: true,
                        range: [1000, 99999999]
                    },
                    discount: {
                        required: "Bạn chưa nhập mức giảm giá",
                        number: true,
                        range: [0, 100]
                    },
                    category_id: "Bạn chưa chọn danh mục",
                    thumb1: "Bạn chưa chọn ảnh 1 cho sản phẩm",
                    thumb2: "Bạn chưa chọn ảnh 2 cho sản phẩm"
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
</body>
</html>