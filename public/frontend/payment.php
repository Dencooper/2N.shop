<?php
include_once __DIR__ . '/partials/header.php';
?>
    <title>Thanh toán</title>
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
                    <li>Hoàn thành hóa đơn</li>
                </ul>
            </div>
            <div class="payment-main d-flex">
                <div class="payment-left">
                    <div class="payment-title">
                        <p>Thẻ ATM/ Tài khoản ngân hàng</p>
                    </div>
                    <div class="list-bank">
                        <div class="search-bank">
                            <input type="text" placeholder="Tìm kiếm ngân hàng">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <div class="list-bank-img d-flex">
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>  
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                            <div class="img-bank">
                                <img src="" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="payment-right">
                    <div class="payment-title d-flex">
                        <p>Thông tin đơn hàng</p>
                        <div class="stopwatch">
                            <i class="fa-solid fa-stopwatch"></i>
                            <span id="time">30:00</span>
                        </div>
                    </div>
                    <div class="detail-info">
                            <p>Đơn hàng thanh toán:</p>
                            <b>IVY</b>
                            <p>Mã đơn hàng:</p>
                            <b>IVM7541231</b>
                            <div class="money d-flex">
                                <p>Số tiền thanh toán</p>
                                <b>2,980,00 VND</b>
                            </div>
                    </div>
                    <div class="button--outline" style="margin-top: 30px;">
                        <a href="completed.html">
                            HOÀN THÀNH
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
include_once __DIR__ . '/partials/footer.php';
?>
    <script src="../js/payment.js"></script>
</body>
</html>