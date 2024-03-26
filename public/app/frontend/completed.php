<?php
include_once __DIR__ . '/partials/header.php';
?>
    <title>Hoàn tất đơn hàng</title>
<?php
include_once __DIR__ . '/partials/navbar.php';
?>
    <main>
        <div class="container">
            <div class="cart-top">
                <ul>
                    <li class="active">Giỏ hàng</li>
                    <li class="active">Đặt hàng</li>
                    <li class="active">Thanh toán</li>
                    <li class="active">Hoàn thành hóa đơn</li>
                </ul>
            </div>
            <div class="completed">
                <div class="completed-icon">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div class="completed-content">
                    <h1>BẠN ĐÃ ĐẶT HÀNG THÀNH CÔNG</h1>
                </div>
            </div>
        </div>
    </main>
<?php
include_once __DIR__ . '/partials/footer.php';
?>
</body>
</html>