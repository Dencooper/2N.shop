<?php
require_once __DIR__ . '/../utils/bootstrap.php';
include_once __DIR__ . '/partials/header.php';

use CT275\Project\User;
$user = new User($PDO);
if(isset($_SESSION['email']) && isset($_COOKIE['session_cookie']) && ($_COOKIE['session_cookie'] == session_id())){
    $user = $user->findEmail($_SESSION['email']);
}
?>
<title> FAQ | 2N Shop</title>

<?php

include_once __DIR__ . '/partials/navbar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        if (!($user->checkRegister($_POST['email']))) {
            echo "<script>alert(\"Email đã được sử dụng!\");</script>";
        } else {
            $user = new User($PDO);
            $user->fill($_POST);
            if ($user->validate()) {
                $user->save();
                echo "<script>alert(\"Bạn đã đăng kí tài khoản thành công\");</script>";
                header('Location: login.php');
                exit();
            }
            
        }
    } else {
        echo "Vui lòng điền đầy đủ thông tin cần thiết!";
    }
}
?>
    <div class="container" style="padding-top:100px;">
        <div class="faq">
            <h2 class="text-center">FAQ</h2>
            <div class="p-2 mb-1 pb-2 pt-2">
                <p class="border border-1 bg-light m-0 p-2"> 
                    <a class="d-block text-decoration-none" data-bs-toggle="collapse" href="#regis" role="button" aria-expanded="false" aria-controls="regis">1. Làm cách nào để tôi đăng ký tài khoản trên website 2NShop.com?</a>
                </p>
                <div class="border border-1 m-0 p-2 collapse" id="regis">
                    <p>Bước 1: Anh/Chị vào website 2NShop.com.</p>
                    <p>Click chọn hình đại diện góc phải trên cùng ấn chọn <i class="fa-solid fa-user-plus ps-1"></i></p>
                    <p>Bước 2: Điền tên và số điện thoại, các thông tin bắt buộc (dấu sao đỏ) và ấn nút Đăng ký.</p>
                </div>
            </div>
            <div class="p-2 mb-1 pb-2 pt-2">
                <p class="border border-1 bg-light m-0 p-2"> 
                    <a class="d-block text-decoration-none" data-bs-toggle="collapse" href="#not_login" role="button" aria-expanded="false" aria-controls="not_login">2. Tại sao tôi không đăng nhập được?</a>
                </p>
                <div class="border border-1 m-0 p-2 collapse" id="not_login">
                    <p>Anh/Chị kiểm tra lại kết nối internet hoặc thông tin tài khoản và mật khẩu đăng nhập.</p>
                </div>
            </div>
            <div class="p-2 mb-1 pb-2 pt-2">
                <p class="border border-1 bg-light m-0 p-2"> 
                    <a class="d-block text-decoration-none" data-bs-toggle="collapse" href="#return" role="button" aria-expanded="false" aria-controls="return">3. Chính sách đổi trả sản phẩm tại 2N SHOP như thế nào? </a>
                </p>
                <div class="border border-1 m-0 p-2 collapse" id="return">
                    <p>Sản phẩm mua với mức giảm giá từ 50% trở xuống được đổi SIZE_MÀU_MẪU trong 15 ngày kể từ khi nhận đc hàng</p>
                    <p>Tình trạng sản phẩm: còn nguyên vẹn, chưa qua sử dụng, chỉnh sửa, còn nguyên tem mác, mã vạch, phụ kiện.</p>
                    <p>Hóa đơn: còn hóa đơn mua hàng</p>
                    <p>Sản phẩm chỉ được đổi 01 lần/đơn hàng theo đúng quy định.</p>
                </div>
            </div>
            <div class="p-2 mb-1 pb-2 pt-2">
                <p class="border border-1 bg-light m-0 p-2"> 
                    <a class="d-block text-decoration-none" data-bs-toggle="collapse" href="#bill" role="button" aria-expanded="false" aria-controls="bill">4. Làm thế nào để tôi có thể nhận được hóa đơn?</a>
                </p>
                <div class="border border-1 m-0 p-2 collapse" id="bill">
                    <p>Bạn có thể nhận được hóa đơn thông qua email hoặc thư tín.</p>
                </div>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/partials/footer.php' ?>
</body>
</html>