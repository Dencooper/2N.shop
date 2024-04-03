<?php
require_once __DIR__ . '/../utils/bootstrap.php';
session_start();
use CT275\Project\Product;

$product = new Product($PDO);
$detailProduct = $product->find($_GET['id']);
include_once __DIR__ . '/partials/header.php';
?>
    <title>Chi tiết sản phẩm</title>
<?php
include_once __DIR__ . '/partials/navbar.php';
?>
    <main style="padding-top:100px;" >
        <section class="product">
            <div class="container" style="padding-bottom: 40px" >
                <div class="product-content d-flex">
                    <div class="product-content-left d-flex">
                        <div class="product-content-left-big-img">
                            <img src="../<?= html_escape($detailProduct->thumb1) ?>" alt="" class="bigImage active">
                            <img src="../<?= html_escape($detailProduct->thumb2) ?>" alt="" class="bigImage">
                        </div>
                        <div class="product-content-left-small-img">
                            <img src="../<?= html_escape($detailProduct->thumb1) ?>" alt="" class="galery" >
                            <img src="../<?= html_escape($detailProduct->thumb2) ?>" alt="" class="galery">
                        </div>
                    </div>
                    <div class="product-content-right">
                        <h1 class="title"><?= html_escape($detailProduct->title) ?></h1>
                        <div class="product-content-right-sub-info d-flex">
                            <p>ID: <span><?= html_escape($detailProduct->getId()) ?></span></p>
                            <div class="product-content-right-rating d-flex">
                                <div class="product-content-right-rating-wrapper">
                                    <div class="product-content-right-rating-background"></div>
                                    <div class="product-content-right-rating-bar" style="width: 100%;"></div>
                                </div>
                                <span>(0 đánh giá)</span>
                            </div>
                        </div>
                        <div class="product-content-right-price">
                            <b class="price formatted-number"><?= html_escape($detailProduct->price - ($detailProduct->price * $detailProduct->discount * 0.01)) ?>đ </b>
                            <del class="formatted-number" ><?= html_escape($detailProduct->price)?>đ</del>
                            <div class="product-content-right-price-sale">
                                <span class="discount">-<?= html_escape($detailProduct->discount)?>%</span> 
                            </div>
                        </div>
                        <div class="product-content-right-color">
                            <p>Màu sắc: <span class="color"></span></p>
                            <ul class="d-flex">
                                <li class="active"><span style="display: none;">Be sáng</span></li>
                                <li><span style="display: none;">Be đậm</span></li>
                                <li><span style="display: none;">Xanh rêu</span></li>
                            </ul>
                        </div>
                        <div class="product-content-right-size">
                            <ul class="d-flex">
                                <li class="button-size">S</li>
                                <li class="button-size">M</li>
                                <li class="button-size">L</li>
                                <li class="button-size">XL</li>
                                <li class="button-size">XXL</li>
                            </ul>
                            <a href="https://dongphuccati.com/tin-tuc/chi-tiet-tin/bang-quy-doi-kick-co-quan-ao.html">
                                <i class="fa-solid fa-ruler"></i> Kiểm tra size của bạn
                            </a>
                        </div>
                        <div class="quantity d-flex">
                            <p>Số lượng</p>
                            <div class="quantity-input">
                                <input type="number" value="1" name="quantity" id="quantity-input">
                                <div class="quantity-increase increase d-flex">+</div>
                                <div class="quantity-decrease decrease d-flex">-</div>
                            </div>
                        </div>
                        <div class="product-content-right-action d-flex">
                            <button class="product-content-right-action-add-to-cart d-flex button" onclick="addToCart()">THÊM VÀO GIỎ</button>
                            <button class="product-content-right-action-purchase button--outline">MUA HÀNG</button>
                            <button class="product-content-right-action-wishlist button--outline"><i class="fa-regular fa-heart"></i></button>
                            <div class="product-content-right-action-find">
                                <a href="">Tìm tại cửa hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
include_once __DIR__ . '/partials/footer.php';
?>
    <script src="../js/product.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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