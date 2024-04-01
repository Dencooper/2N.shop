<?php
require_once __DIR__ . '/../../utils/bootstrap.php';

use CT275\Project\Product;
use CT275\Project\Category;


$product = new Product($PDO);
$category = new Category($PDO);

$db = $product->getDb();
$query = "SELECT * FROM categories WHERE name LIKE ?";
$name = '%' . $_GET['name'] . '%';
$statement = $db->prepare($query);
$statement->execute([$name]);

include_once __DIR__ . '/../partials/header.php';
?>
    <style>
        .back-product-list a:nth-child(2){
            opacity: 0.5;
        }
    </style>
</head>
<body>
<?php include_once __DIR__ . '/../partials/navbar.php'; ?>
    <!-- Main Page Content -->
    <div class="container pb-3 mb-3">
        <h2 class="text-center animate__animated animate__bounce">Quản Lí Danh Mục</h2>
        <?php
            $subtitle = "Kết quả tìm kiếm của  danh mục \"" .  $_GET['name'] . "\"";
            include_once __DIR__ . '/../partials/heading.php';
        ?>

        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between" >
                    <div>
                        <a href="add.php" class="btn btn-success mb-3">
                            <i class="fa fa-plus"></i> Thêm danh mục
                        </a>
                    </div>
                    
                    <div class="search mt-2">
                        <form action="search.php" method="get"  >
                            <input type="text" name="name" placeholder="Nhập tên danh mục.." style="padding:2px 0 2px 5px; font-size:16px" required oninvalid="this.setCustomValidity('Hãy nhập nội dung!')" />
                            <button type="submit" style="padding: 3px 8px; margin-bottom:2px;font-size:16px"  class="btn btn-dark" ><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                </div>
                <!-- Table Starts Here -->
                <table id="products" class="table table-striped table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên Danh Mục</th>
                            <th scope="col">Số Lượng Sản Phẩm</th>
                            <th scope="col">Ngày Tạo</th>
                            <th scope="col">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($result = $statement->fetch()):
                            $countProduct = $category->countProduct($result['id']);
                        ?>
                                <tr class="text-center">
                                    <td class="align-middle"><?=html_escape($result['id'])?></td>
                                    <td class="align-middle"><?=html_escape($result['name'])?></td>
                                    <td class="align-middle"><?= html_escape($countProduct);?></td>
                                    <td class="align-middle"><?=html_escape(date("d-m-Y", strtotime($result['created_at'])))?></td>
                                    <td class="align-middle" style="border-bottom: none">
                                        <a href="<?= 'edit.php?id=' . $result['id'] ?>" class="btn btn-xs btn-warning">
                                            <i alt="Edit" class="fa fa-pencil"></i> Edit
                                        </a>
                                        <form class="form mt-3" action="delete.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $result['id'] ?>"/>
                                            <button type="submit" class="btn btn-xs btn-danger"           name="delete-category">
                                                <i alt="Delete" class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile ?>
                    </tbody>
                </table>
                <!-- Table Ends Here -->
            </div>
        </div>
    </div>

    <div id="delete-category-confirm" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Xác nhận</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">Bạn có muốn xóa danh mục này</div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete-category">Xóa</button>
                    <button type="button" data-dismiss="modal" class="btn btn-light">Hủy</button>
                </div>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/../partials/footer.php' ?>
    <script>
        $(document).ready(function(){
            $('button[name="delete-category"]').on('click', function(e){
                e.preventDefault();
                
                const form = $(this).closest('form');
                const nameTd = $(this).closest('tr').find('td').eq(1);
                if (nameTd.length > 0) {
                    $('.modal-body').html(`Bạn muốn xóa danh mục "${nameTd.text()}"?`);
                }
                $('#delete-category-confirm').modal({
                    backdrop: 'static', keyboard: false
                })
                .on('click', '#delete-category', function() {
                    form.trigger('submit');
                });
            });
        });
    </script>
</body>
</html>