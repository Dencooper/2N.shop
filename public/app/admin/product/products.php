<?php
require_once __DIR__ . '/../../utils/bootstrap.php';
use CT275\Project\Product;
use CT275\Project\Category;

$product = new Product($PDO);
$category = new Category($PDO);

$products = $product->all();
$categories = $category->all();

include_once __DIR__ . '/../partials/header.php';
?>
<style>
        .back-product-list a:nth-child(1){
            opacity: 0.5;
            pointer-events: none;
            cursor: default;
        }
    </style>
</head>
<body>
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>
    <!-- Main Page Content -->
    <div class="container pb-3 mb-3">
        <h2 class="text-center animate__animated animate__bounce">Quản Lí Sản Phẩm</h2>
        <?php
            $subtitle = 'Thông tin tất cả sản phẩm';
            include_once __DIR__ . '/../partials/heading.php';
        ?>
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between" >
                    <div>
                        <a href="add.php" class="btn btn-primary mb-3">
                            <i class="fa fa-plus"></i> Thêm sản phẩm
                        </a>
                    </div>
                    
                    <div class="search mt-2">
                        <form action="search.php" method="get">
                            <input type="text" name="title" placeholder="Nhập tên danh mục.." style="padding:2px 0 2px 5px; font-size:16px" required oninvalid="this.setCustomValidity('Hãy nhập nội dung!')" />
                            <button type="submit" style="padding: 3px 8px; margin-bottom:2px;font-size:16px"  class="btn btn-dark" ><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                </div>
                

                <!-- Table Starts Here -->
                <table id="products" class="table table-striped table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Danh Mục</th>
                            <th scope="col">Tên Sản Phẩm</th>
                            <th scope="col">Giá Niêm Yết</th>
                            <th scope="col">Giảm Giá</th>
                            <th scope="col">Ngày Tạo</th>
                            <th scope="col">Hình Ảnh 1</th>
                            <th scope="col">Hình Ảnh 2</th>
                            <th scope="col">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $product):?>
                            <tr class="text-center">
                                <td class="align-middle"><?=html_escape($product->getId())?></td>
                                <td class="align-middle"><?=html_escape($product->category_id)?></td>
                                <td class="align-middle"><?=html_escape($product->title)?></td>
                                <td class="align-middle formatted-number"><?= html_escape($product->price);?></td>
                                <td class="align-middle"><?=html_escape($product->discount) . "%" ?></td>
                                <td class="align-middle"><?=html_escape(date("d-m-Y", strtotime($product->created_at)))?></td>
                                <td class="align-middle"><img src="../../<?=html_escape($product->thumb1)?>" alt="" style="max-width: 150px; max-height: 150px;"></td>
                                <td class="align-middle"><img src="../../<?=html_escape($product->thumb2)?>" alt="" style="max-width: 150px; max-height: 150px;"></td>
                                <td class="align-middle" style="border-bottom: none">
                                    <a href="<?= 'edit.php?id=' . $product->getId() ?>" class="btn btn-xs btn-warning">
                                        <i alt="Edit" class="fa fa-pencil"></i> Edit
                                    </a>
                                    <form class="form mt-3" action="delete.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $product->getId() ?>"/>
                                        <button type="submit" class="btn btn-xs btn-danger"             name="delete-product">
                                            <i alt="Delete" class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <!-- Table Ends Here -->
            </div>
        </div>
    </div>

    <div id="delete-confirm" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Xác nhận</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">Bạn có muốn xóa sản phẩm này</div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Xóa</button>
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy</button>
                </div>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/../partials/footer.php' ?>
    <script>
        $(document).ready(function(){
            $('button[name="delete-product"]').on('click', function(e){
                e.preventDefault();
                
                const form = $(this).closest('form');
                const nameTd = $(this).closest('tr').find('td').eq(2);
                if (nameTd.length > 0) {
                    $('.modal-body').html(`Bạn muốn xóa sản phẩm "${nameTd.text()}"?`);
                }
                $('#delete-confirm').modal({
                    backdrop: 'static', keyboard: false
                })
                .on('click', '#delete', function() {
                    form.trigger('submit');
                });
            });
        });
    </script>
    <script>
        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
        var numbers =document.querySelectorAll(".formatted-number");
        var formattedNumber;
        numbers.forEach(number => {
            formattedNumber = formatNumber(number.innerHTML);
            number.innerHTML = formattedNumber;
        });
    </script>
</body>

</html>