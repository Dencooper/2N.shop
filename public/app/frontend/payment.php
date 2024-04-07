<?php
require_once __DIR__ . '/../utils/bootstrap.php';
include_once __DIR__ . '/partials/header.php';

if(isset($_SESSION['email']) && isset($_COOKIE['session_cookie']) && ($_COOKIE['session_cookie'] == session_id())){
    $user = $user->findEmail($_SESSION['email']);
}
else{
    header('location: login.php');
    exit();
}
?>
    <title>Thanh toán</title>
<?php
include_once __DIR__ . '/partials/navbar.php';
?>
    <main>
        <div class="container pb-5">
            <div class="cart-top">
                <ul>
                    <li class="active">Đặt hàng</li>
                    <li class="active">Thanh toán</li>
                    <li>Hoàn thành hóa đơn</li>
                </ul>
            </div>
            <div class="payment-main">
                <div class="payment-title d-flex">
                    <p>Thông tin đơn hàng</p>
                    <div class="stopwatch">
                        <i class="fa-solid fa-stopwatch"></i>
                        <span id="time">30:00</span>
                    </div>
                </div>
                <div class="detail-info">
                        <p>Đơn hàng thanh toán:</p>
                        <b>2NS</b>
                        <p>Mã đơn hàng:</p>
                        <b>2N<?= chr(mt_rand(65, 90)) . rand(1000000, 9999999)?></b>
                        <div class="money d-flex">
                            <p>Số tiền thanh toán</p>
                            <b class="formatted-number"><?= html_escape($_GET['total'])?>đ</b>
                        </div>
                </div>
                <div class="button--outline" style="margin-top: 30px;">
                    <a href="completed.php">
                        HOÀN THÀNH
                    </a>
                </div>
            </div>
        </div>
    </main>
<?php
include_once __DIR__ . '/partials/footer.php';
?>
    <script src="../js/payment.js"></script>
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