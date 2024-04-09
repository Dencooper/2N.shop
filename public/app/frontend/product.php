<?php
require_once __DIR__ . '/../utils/bootstrap.php';
include_once __DIR__ . '/partials/header.php';

use CT275\Project\Product;

$product = new Product($PDO);
$detailProduct = $product->find($_GET['id']);
?>
    <title>Chi tiết sản phẩm | 2N Shop</title>
<?php
include_once __DIR__ . '/partials/navbar.php';
?>
    <main style="padding-top:100px;" >
        <section class="product">
            <div class="container" style="padding-bottom: 40px" >
                <form action="delivery.php" method="get">
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
                            <input type="hidden" name="id" value="<?= html_escape($detailProduct->getId()) ?>">
                            <input type="hidden" name="title" value="<?= html_escape($detailProduct->title) ?>">
                            <input type="hidden" name="price" value="<?= html_escape($detailProduct->price - ($detailProduct->price * $detailProduct->discount * 0.01)) ?>">
                            <input type="hidden" name="discount" value="<?= html_escape($detailProduct->discount) ?>">
                            <h1 class="title"><?= html_escape($detailProduct->title) ?></h1>
                            <div class="product-content-right-sub-info d-flex">
                                <p>ID: <span><?= html_escape($detailProduct->getId()) ?></span></p>
                                <div class="product-content-right-rating d-flex">
                                    <div class="product-content-right-rating-wrapper">
                                        <div class="product-content-right-rating-background"></div>
                                        <div class="product-content-right-rating-bar" style="width: 100%;"></div>
                                    </div>
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
                                <div class="list-color d-flex">
                                    <label>
                                        <input type="radio" name="color" value="Be sáng" class="d-none" required>
                                        <div class="button-color"><span style="display: none;">Be sáng</span></div>
                                    </label>
                                    <label>
                                        <input type="radio" name="color" value="Be đậm" class="d-none">
                                        <div class="button-color"><span style="display: none;">Be đậm</span></div>
                                    </label>
                                    <label>
                                        <input type="radio" name="color" value="Xanh rêu" class="d-none">
                                        <div class="button-color"><span style="display: none;">Xanh rêu</span></div>
                                    </label>
                                </div>
                            </div>
                            <div class="product-content-right-size">
                                <div class="list-size d-flex">
                                    <label>
                                        <input type="radio" name="size" value="S" class="d-none" required>
                                        <span class="button-size">S</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="size" value="M" class="d-none">
                                        <span class="button-size">M</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="size" value="L" class="d-none">
                                        <span class="button-size">L</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="size" value="XL" class="d-none">
                                        <span class="button-size">XL</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="size" value="XXL" class="d-none">
                                        <span class="button-size">XXL</span>
                                    </label>
                                </div>
                                <a href="">
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
                                <button class="product-content-right-action-purchase button--outline" type="submit" >MUA HÀNG</button>
                                <button class="product-content-right-action-add-to-cart d-flex button" style="max-width: 250px" >THÊM VÀO YÊU THÍCH</button>
                                <div class="product-content-right-action-find">
                                    <a href="">Tìm tại cửa hàng</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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