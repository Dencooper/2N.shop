<?php
include_once __DIR__ . '/partials/header.php';
?>
    <title>Giao hàng</title>
<?php
include_once __DIR__ . '/partials/navbar.php';
?>
    <main>
        <div class="container">
            <div class="cart-top">
                <ul>
                    <li class="active">Giỏ hàng</li>
                    <li class="active">Đặt hàng</li>
                    <li>Thanh toán</li>
                    <li>Hoàn thành hóa đơn</li>
                </ul>
            </div>
            <div class="delivery-main d-flex">
                <div class="delivery-payment">
                    <div class="delivery d-flex">
                        <div class="delivery-address">
                            <h3>Địa chỉ giao hàng</h3>
                            <div class="address">
                                <div class="address-top d-flex">
                                    <p><b>Phương Nam(Cơ quan)</b></p>
                                    <a href="#" style="text-decoration: underline; font-weight: 500;">Chọn địa chỉ khác</a>
                                    <div class="button">
                                        <a href=""><span>MẶC ĐỊNH</span></a>
                                    </div>
                                </div>
                                <p>Điện thoại: 0999921293</p>
                                <p>Địa chỉ: Hẻm 51, Xuân Khánh, Ninh Kiều, Cần Thơ</p>
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
                                <input type="radio" id="fast-method">
                                <label for="fast-method">Chuyển phát nhanh</label>
                                <p>Thời gian giao hàng dự kiến: Thứ 3, 21/05/2024</p>
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
                                        <li><input class="form-control" type="text" placeholder="Nhập tên doanh nghiệp"></li>
                                        <li><input class="form-control" type="text" placeholder="Nhập mã thuế"></li>
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
                            <div class="d-flex credit-method">
                                <input type="radio" name="payment-method" id="credit">
                                <label for="credit">Thanh toán bằng thẻ tính dụng</label>
                            </div>
                            <div class="d-flex atm-method">
                                <input type="radio" name="payment-method" id="atm">
                                <label for="atm">Thanh toán bằng thẻ ATM</label>
                                <p>Hỗ trợ thanh toán online hơn 38 ngân hàng phổ biến Việt Nam</p>
                            </div>
                            <div class="d-flex momo-method">
                                <input type="radio" name="payment-method" id="momo">
                                <label for="momo">Thanh toán bằng Momo</label>
                            </div>
                            <div class="d-flex cod-method">
                                <input type="radio" name="payment-method" id="cod">
                                <label for="cod">Thanh toán khi nhận hàng</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="cart-right">
                    <div class="cart-summary">
                        <div class="cart-summary-overview">
                            <h3>Tổng tiền giỏ hàng</h3>
                            <div class="cart-summary-overview-item d-flex">
                                <p>Tổng tiền hàng</p>
                                <p>3.725.000đ</p>
                            </div>
                            <div class="cart-summary-overview-item d-flex">
                                <p>Tạm tính</p>
                                <p>2.980.000đ</p>
                            </div>
                            <div class="cart-summary-overview-item d-flex">
                                <p>Phí vận chuyển</p>
                                <p>0đ</p>
                            </div>
                            <div class="cart-summary-overview-item d-flex">
                                <p>Tiền thanh toán</p>
                                <p><b style="font-size: 18px;">2.980.000đ</b></p>
                            </div>
                        </div>
                        <div class="code">
                            <div class="code-top d-flex">
                                <a href="">Mã phiếu giảm giá</a>|
                                <a href="">Mã của tôi</a>
                            </div>
                            <div class="code-center d-flex">
                                <input type="text" placeholder="Mã giảm giá" class="form-control">
                                <div class="button--outline">
                                    <a href="">
                                        ÁP DỤNG
                                    </a>
                                </div>
                            </div>
                            <div class="code-bottom">
                                <select name="code-emplyee" id="">
                                    <option value="" style="display: none;">Mã nhân viên hỗ trợ</option>
                                    <option value="">d01</option>
                                    <option value="">d02</option>
                                    <option value="">d03</option>
                                    <option value="">d04</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="button--outline d-flex">
                        <a href="payment.html">
                            Thanh Toán
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
<?php
include_once __DIR__ . '/partials/footer.php';
?>
    <script src="../js/delivery.js"></script>
</body>
</html>