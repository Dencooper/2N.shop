<?php
require_once __DIR__ . '/../utils/bootstrap.php';
use CT275\Project\Product;

$product = new Product($PDO);

$products = $product->all();

include_once __DIR__ . '/partials/header.php';
?>
    <title>Danh Mục - Nữ | 2N Shop</title>
<?php
include_once __DIR__ . '/partials/navbar.php';
?>
    <main class="site-main">
        <div class="container">
            <section class="cartegory">
                <div class="cartegory-top d-flex">
                    <a href="../../home.php">Trang chủ </a><span>&#8212;</span><p>Nữ</p>
                </div>
                <div class="d-flex">
                    <div class="cartegory-left">
                        <ul>
                            <li class="cartegory-left-li">
                                <div class="cartegory-left-li-menu">
                                    <p class="cartegory-left-li-content d-flex">Size
                                        <span class="icon-plus"></span>
                                        <span class="icon-minus"></span>
                                    </p>
                                </div>
                                <div class="sub-cartegory">
                                    <ul class="d-flex list-size">
                                        <li class="button-size">S</li>
                                        <li class="button-size">M</li>
                                        <li class="button-size">L</li>
                                        <li class="button-size">XL</li>
                                        <li class="button-size">XXL</li>
                                    </ul>
                                </div>
                            </li>
                            <li class="cartegory-left-li color">
                                <div class="cartegory-left-li-menu">
                                    <p class="cartegory-left-li-content d-flex">Màu sắc
                                        <span class="icon-plus"></span>
                                        <span class="icon-minus"></span>
                                    </p>
                                </div>
                                <div class="sub-cartegory">
                                    <ul class="list-color">
                                        <li class="button-color" type="button" data-bs-toggle="tooltip" title="vàng nâu"></li>
                                        <li class="button-color"></li>
                                        <li class="button-color"></li>
                                        <li class="button-color"></li>
                                        <li class="button-color"></li>
                                        <li class="button-color"></li>
                                        <li class="button-color"></li>
                                        <li class="button-color"></li>
                                        <li class="button-color"></li>
                                        <li class="button-color"></li>
                                        <li class="button-color"></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="cartegory-left-li">
                                <div class="cartegory-left-li-menu">
                                    <p class="cartegory-left-li-content d-flex">Mức giá
                                        <span class="icon-plus"></span>
                                        <span class="icon-minus"></span>
                                    </p>
                                </div>
                                <div class="sub-cartegory">
                                    <div class="slidecontainer">
                                        <input type="range" min="0" max="10000000" value="0" class="slider" id="myRange">
                                        <div class="value-range d-flex">
                                            <span id="amount-from">0đ</span>
                                            <span id="amount-to">10.000.000đ</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="cartegory-left-li">
                                <div class="cartegory-left-li-menu">
                                    <p class="cartegory-left-li-content d-flex">Mức giảm giá
                                        <span class="icon-plus"></span>
                                        <span class="icon-minus"></span>
                                    </p>
                                </div>
                                <div class="sub-cartegory">
                                    <div class="radio-cartegory">
                                        <label for="under-30">
                                            <input type="radio" id="under-30" name="chiet-khau">
                                            Dưới 30%
                                        </label>
                                        <label for="f30t50">
                                            <input type="radio" id="f30t50" name="chiet-khau">
                                            Từ 30% - 50%
                                        </label>
                                        <label for="f50t70">
                                            <input type="radio" id="f50t70" name="chiet-khau">
                                            Từ 50% - 70%
                                        </label>
                                        <label for="from-70">
                                            <input type="radio" id="from-70" name="chiet-khau">
                                            Từ 70%
                                        </label>
                                        <label for="special">
                                            <input type="radio" id="special" name="chiet-khau">
                                            Giá đặc biệt
                                        </label>
                                    </div>
                                </div>
                            </li>
                            <li class="cartegory-left-li">
                                <div class="filter-button d-flex">
                                    <button class="btn button--outline">BỎ LỌC</button>
                                    <button class="btn button">LỌC</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="cartegory-right">
                        <div class="right-top d-flex">
                            <div class="cartegory-right-top-item">
                                <select name="" id="">
                                    <option value="" style="display: none;">Sắp xếp</option>
                                    <option value="">Mặc định</option>
                                    <option value="">Giá cao đến thấp</option>
                                    <option value="">Giá thấp đến cao</option>
                                </select>
                            </div>
                        </div>      
                        <div class="cartegory-right-content d-flex justify-content-start">
                            <?php foreach($products as $product): 
                                if ($product->category_id == 1): ?>
                                    <div class="cartegory-right-content-item" onclick="product_detail(<?=html_escape($product->getId())?>)">
                                        <div class="images">
                                            <img src="../<?=html_escape($product->thumb1)?>" alt="">
                                            <img src="../<?=html_escape($product->thumb2)?>" class="img-hover" alt="">
                                        </div>
                                        <p style="height:45px;"><?=html_escape($product->title)?></p>
                                        <p class="formatted-number" ><strong><?=html_escape($product->price - ($product->discount * $product->price * 0.01))?>đ </strong><del><?=html_escape($product->price)?>đ</del></p>
                                        <div class="add-to-cart">
                                            
                                        </div>
                                    </div>
                            <?php endif; endforeach ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        
    </main>
    
<?php
include_once __DIR__ . '/partials/footer.php';
?>
    <script src="../js/cartegory.js"></script>
    <script>
        function product_detail(productId){
            window.location.href = "product.php?id=" + productId;
        }
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