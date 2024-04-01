<?php
require_once __DIR__ . '/../../utils/bootstrap.php';

use CT275\Project\User;

$user = new User($PDO);
$db = $user->getDb();
$query = "SELECT * FROM users WHERE email LIKE ?";
$email = '%' . $_GET['email'] . '%';
$statement = $db->prepare($query);
$statement->execute([$email]);

include_once __DIR__ . '/../partials/header.php';
?>
<style>
        .back-product-list a:nth-child(3){
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>
    <div class="container pb-3 mb-3">
        <h2 class="text-center animate__animated animate__bounce">Quản Lí Tài Khoản</h2>
        <?php
            $subtitle = 'Thông tin tất cả tài khoản';
            include_once __DIR__ . '/../partials/heading.php';
        ?>
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between" >
                    <div>
                        <a href="add.php" class="btn btn-secondary mb-3">
                            <i class="fa fa-plus"></i> Thêm tài khoản
                        </a>
                    </div>
                    
                    <div class="search mt-2">
                        <form action="search.php" method="get">
                            <input type="text" name="email" placeholder="Nhập email tài khoản.." style="padding:2px 0 2px 5px; font-size:16px" required oninvalid="this.setCustomValidity('Hãy nhập nội dung!')" />
                            <button type="submit" style="padding: 3px 8px; margin-bottom:2px;font-size:16px"  class="btn btn-dark" ><i class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                </div>
                

                <!-- Table Starts Here -->
                <table id="products" class="table table-striped table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Họ và tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Số điện thoại</th>
                            <th scope="col">Ngày sinh</th>
                            <th scope="col">Giới tính</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Vai trò</th>
                            <th scope="col">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($result = $statement->fetch()): ?>
                                <tr class="text-center">
                                    <td class="align-middle"><?=html_escape($result['fullname'])?></td>
                                    <td class="align-middle"><?=html_escape($result['email'])?></td>
                                    <td class="align-middle"><?=html_escape($result['phone_number'])?></td>
                                    <td class="align-middle"><?=html_escape(date("d-m-Y", strtotime($result['dob'])))?></td>
                                    <?php if ($result['gender'] == 1) :?>
                                        <td class="align-middle">Nữ</td>
                                    <?php elseif ($result['gender'] == 2) :?>
                                        <td class="align-middle">Nam</td>
                                    <?php else:?>
                                        <td class="align-middle">Khác</td>
                                    <?php endif ?>
                                    <td class="align-middle"><?=html_escape(date("d-m-Y", strtotime($result['created_at'])))?></td>
                                    <?php if ($result['role_id'] == 0) :?>
                                        <td class="align-middle">Quản trị viên</td>
                                    <?php elseif ($result['role_id'] == 1) :?>
                                        <td class="align-middle">Người dùng</td>
                                    <?php endif ?>
                                    <td class="align-middle" style="border-bottom: none">
                                        <a href="<?= 'edit.php?id=' . $result['id'] ?>" class="btn btn-xs btn-warning">
                                            <i alt="Edit" class="fa fa-pencil"></i> Sửa
                                        </a>
                                        <form class="form mt-3" action="delete.php" method="POST">
                                            <input type="hidden" name="id" value="<?= $result['id'] ?>"/>
                                            <button type="submit" class="btn btn-xs btn-danger"        name="delete-user">
                                                <i alt="Delete" class="fa fa-trash"></i> Xóa
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
                    <button type="button" data-dismiss="modal" class="btn btn-light">Hủy</button>
                </div>
            </div>
        </div>
    </div>
    <?php include_once __DIR__ . '/../partials/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function(){
            $('button[name="delete-user"]').on('click', function(e){
                e.preventDefault();
                
                const form = $(this).closest('form');
                const nameTd = $(this).closest('tr').find('td').eq(1);
                if (nameTd.length > 0) {
                    $('.modal-body').html(`Bạn muốn xóa tài khoản "${nameTd.text()}"?`);
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
</body>

</html>