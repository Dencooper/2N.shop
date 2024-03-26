<?php
require_once __DIR__ . '/../utils/bootstrap.php';

use CT275\Project\Product;

$product = new Product($PDO);
$db = $product->getDb();
$query = "SELECT * FROM products WHERE tittle LIKE ?";
$tittle = '%' . $_GET['tittle'] . '%';
$statement = $db->prepare($query);
$statement->execute([$tittle]);

include_once __DIR__ . '/partials/header.php';
?>

<body>
<?php include_once __DIR__ . '/partials/navbar.php'; ?>
    <!-- Main Page Content -->
    <div class="container pb-3 mb-3">
        <?php
            $subtitle = "Kết quả tìm kiếm của sản phẩm \"" .  $_GET['tittle'] . "\"";
            include_once __DIR__ . '/partials/heading.php';
        ?>

        <div class="row">
            <div class="col-12">

                <a href="/add.php" class="btn btn-primary mb-3">
                    <i class="fa fa-plus"></i> Thêm sản phẩm
                </a>

                <!-- Table Starts Here -->
                <table id="products" class="table table-striped table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">ID</th>
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
                        <?php while($result = $statement->fetch()): ?>
                                <tr class="text-center">
                                    <td class="align-middle"><?=html_escape($result['id'])?></td>
                                    <td class="align-middle"><?=html_escape($result['tittle'])?></td>
                                    <td class="align-middle formatted-number"><?= html_escape($result['price']);?></td>
                                    <td class="align-middle"><?=html_escape($result['discount']) . "%" ?></td>
                                    <td class="align-middle"><?=html_escape(date("d-m-Y", strtotime($result['created_at'])))?></td>
                                    <td class="align-middle"><img src="../<?=html_escape($result['thumb1'])?>" alt="" style="max-width: 150px; max-height: 150px;"></td>
                                    <td class="align-middle"><img src="../<?=html_escape($result['thumb2'])?>" alt="" style="max-width: 150px; max-height: 150px;"></td>
                                    <td class="align-middle" style="border-bottom: none">
                                        <a href="<?= '/edit.php?id=' . $result['id'] ?>" class="btn btn-xs btn-warning">
                                            <i alt="Edit" class="fa fa-pencil"></i> Edit
                                        </a>
                                        <form class="form mt-3" action="/delete.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $result['id'] ?>"/>
                                            <button type="submit" class="btn btn-xs btn-danger"             name="delete-product">
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

    <?php include_once __DIR__ . '/partials/footer.php'; ?>
    <script>
        $(document).ready(function(){
            $('button[name="delete-product"]').on('click', function(e){
                e.preventDefault();
                
                const form = $(this).closest('form');
                const nameTd = $(this).closest('tr').find('td:first');
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