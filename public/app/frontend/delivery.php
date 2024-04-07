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
date_default_timezone_set('Asia/Ho_Chi_Minh');
$expectedTime = time() + (3 * 24 * 60 * 60);
?>
    <title>Đơn hàng của bạn | 2N SHOP</title>
<?php
include_once __DIR__ . '/partials/navbar.php';
?>
    <main>
        <div class="container">
            <div class="cart-top">
                <ul>
                    <li class="active">Đặt hàng</li>
                    <li>Thanh toán</li>
                    <li>Hoàn thành hóa đơn</li>
                </ul>
            </div>
            <form action="payment.php" method="get">
                <input type="hidden" name="total" value=<?= html_escape($_GET['price'] * $_GET['quantity'])?> >
                <div class="delivery-main d-flex">
                    <div class="delivery-payment">
                        <div class="delivery d-flex">
                            <div class="delivery-address">
                                <h3>Địa chỉ giao hàng</h3>
                                <div class="address">
                                    <div class="address-top d-flex">
                                        <p><b><?= html_escape($user->fullname)?></b></p>
                                        <a href="#" style="text-decoration: underline; font-weight: 500;">Chọn địa chỉ khác</a>
                                        <div class="button">
                                            <a href=""><span>MẶC ĐỊNH</span></a>
                                        </div>
                                    </div>
                                    <p>Điện thoại: <?= html_escape($user->phone_number)?></p>
                                    <p>Địa chỉ: <?= html_escape($user->address)?></p>
                                </div>
                                <div class="add-address button">
                                    <a href="">
                                        <i class="fa-solid fa-plus"></i>
                                        THÊM ĐỊA CHỈ
                                    </a>
                                </div>
                            </div>
                            <div class="delivery-method">
                                <h3>Phương thức giao hàng</h3>
                                <div class="method">
                                    <input type="radio" id="fast-method" required>
                                    <label for="fast-method">Chuyển phát nhanh</label>
                                    <p>Thời gian giao hàng dự kiến: <?= date('d/m/Y', $expectedTime)?></p>
                                </div>
                                <div class="vat">
                                    <h3>Bạn có muốn nhận hóa đơn VAT không ?
                                        <div class="form-check">
                                            <input type="checkbox" id="checkbox">
                                        </div>
                                    </h3>
                                    <div class="checked-vat" style="display: none;">
                                        <ul>
                                            <li><input class="form-control" type="text" placeholder="Nhập email"></li>
                                            <li><input class="form-control" type="text" placeholder="Nhập họ tên"></li>
                                            <li><input class="form-control" type="text" placeholder="Nhập địa chỉ"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="payment">
                            <h3>Phương thức thanh toán</h3>
                            <div class="payment-methods">
                                <p>Mọi giao dịch đều được bảo mật và mã hóa. Thông tin thẻ tín dụng sẽ không bao giờ được lưu lại.</p>
                                <div class="d-flex cod-method">
                                    <input type="radio" name="payment-method" value="cod" required>
                                    <label for="cod">Thanh toán khi nhận hàng</label>
                                </div>
                                <div class="d-flex credit-method">
                                    <input type="radio" name="payment-method" value="credit" disabled>
                                    <label for="credit">Thanh toán bằng thẻ tính dụng (chưa hỗ trợ)</label>
                                </div>
                                <div class="d-flex atm-method">
                                    <input type="radio" name="payment-method" value="atm" disabled>
                                    <label for="atm">Thanh toán bằng thẻ ATM (chưa hỗ trợ)</label>
                                    <p>Hỗ trợ thanh toán online hơn 38 ngân hàng phổ biến Việt Nam</p>
                                </div>
                                <div class="d-flex momo-method">
                                    <input type="radio" name="payment-method" value="momo" disabled>
                                    <label for="momo">Thanh toán bằng Momo (chưa hỗ trợ)</label>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="cart-right">
                        <div class="cart-summary">
                            <div class="cart-summary-overview">
                                <h3>Chi Tiết Đơn Hàng</h3>
                                <div class="cart-summary-overview-item d-flex">
                                    <p>Mã sản phẩm</p>
                                    <p><?= html_escape($_GET['id'])?></p>
                                </div>
                                <div class="cart-summary-overview-item d-flex">
                                    <p>Size</p>
                                    <p><?= html_escape($_GET['size'])?></p>
                                </div>
                                <div class="cart-summary-overview-item d-flex">
                                    <p>Màu sắc</p>
                                    <p><?= html_escape($_GET['color'])?></p>
                                </div>
                                <div class="cart-summary-overview-item d-flex">
                                    <p>Giá (-<?= html_escape($_GET['discount'])?>%)</p>
                                    <p class="formatted-number"><?= html_escape($_GET['price'])?>đ</p>
                                </div>
                                <div class="cart-summary-overview-item d-flex">
                                    <p>Số lượng</p>
                                    <p><?= html_escape($_GET['quantity'])?></p>
                                </div>
                                <div class="cart-summary-overview-item d-flex">
                                    <p>Tạm tính</p>
                                    <p class="formatted-number"><?= html_escape($_GET['price'] * $_GET['quantity'])?>đ</p>
                                </div>
                                <div class="cart-summary-overview-item d-flex">
                                    <p>Phí vận chuyển</p>
                                    <p>0đ</p>
                                </div>
                                <div class="cart-summary-overview-item total d-flex">
                                    <p>Tiền thanh toán</p>
                                    <p class="formatted-number"><b style="font-size: 18px;"><?= html_escape($_GET['price'] * $_GET['quantity'])?>đ</b></p>
                                </div>
                            </div>
                        </div>
                        <button class="button--outline text-center">Thanh Toán</button>
                    </div>
                </div>
            </form>
            
        </div>
    </main>
<?php
include_once __DIR__ . '/partials/footer.php';
?>
    <script src="../js/delivery.js"></script>
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