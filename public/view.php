<?php
require_once __DIR__ . '/../src/bootstrap.php';
use CT275\Project\Product;
use CT275\Project\Paginator;

$product = new Product($PDO);

$products = $product->all();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>Xem Danh Mục - Client</title>
    <link rel="icon" href="https://pubcdn.ivymoda.com/ivy2/images/logo-icon.ico" type="image/png" sizes="16x16">
</head>
<body>
    <header>
        <div class="container d-flex">
            <div class="logo">
                <a href="index.php" style="font-size: 15px;" >Quản Lý Danh Mục
                </a>
            </div>
            <nav>
                <div class="menu">
                    <li><a href="">NỮ</a>
                    </li>
                    <li><a href="">NAM</a>
                        <ul class="sub-menu">
                            <ul class="event">
                                <li><a href="">NEW ARRIVAL</a></li>
                            </ul>
                            <div class="main-sub">
                                <li><a href="">ÁO</a>
                                    <ul>
                                        <li><a href="">Áo thun</a></li>
                                        <li><a href="">Áo khoác</a></li>
                                        <li><a href="">Áo sơ mi</a></li>
                                        <li><a href="">Áo vest</a></li>
                                    </ul>
                                </li>
                                <li><a href="">Quần Nam</a>
                                    <ul>
                                        <li><a href="">Quần Jean</a></li>
                                        <li><a href="">Quần lửng/ short</a></li>
                                        <li><a href="">Quần dài</a></li>
                                    </ul>
                                </li>
                                <li><a href="">PHỤ KIỆN</a>
                                    <ul>
                                        <li><a href="">Phụ kiện</a></li>
                                    </ul>
                                </li>
                            </div>
                        </ul>
                    </li>
                    <li><a href="">TRẺ EM</a>
                        <ul class="sub-menu">
                            <ul class="event">
                                <li><a href="">NEW ARRIVAL</a></li>
                                <li><a href="">ÁO KHOÁC</a></li>
                            </ul>
                            <div class="main-sub">
                                <li><a href="">BÉ TRAI</a>
                                    <ul>
                                        <li><a href="">Áo bé trai</a></li>
                                        <li><a href="">Quần bé trai</a></li>
                                        <li><a href="">Phụ kiện bé trai</a></li>
                                    </ul>
                                </li>
                                <li><a href="">BÉ GÁI</a>
                                    <ul>
                                        <li><a href="">Áo bé gái</a></li>
                                        <li><a href="">Quần bé gái</a></li>
                                        <li><a href="">Váy bé gái</a></li>
                                        <li><a href="">Chân váy bé gái</a></li>
                                        <li><a href="">Phụ kiện bé gái</a></li>
                                    </ul>
                                </li>
                            </div>
                        </ul>
                    </li>
                    <li><a href="" class="sale">SALE MÙA LỄ HỘI</a>
                        <ul class="sub-menu">
                            <ul class="event"></ul>
                            <div class="main-sub">
                                <li><a href="" class="sale">Săn sale từng bừng - Mừng đón mua lễ hội</a>
                                    <ul>
                                        <li><a href="">Sale of 30%</a></li>
                                        <li><a href="">Sale of 50%</a></li>
                                        <li><a href="">Sale of 70%</a></li>
                                    </ul>
                                </li>
                                <li><a href="" class="sale">Combo Áo phao + thun/len giảm 10% </a>
                                    <ul>
                                        <li><a href="">Áo phao</a></li>
                                        <li><a href="">Áo thun/len</a></li>
                                    </ul>
                                </li>
                            </div>
                        </ul>
                    </li>
                    <li><a href="">BỘ SƯU TẬP</a>
                        <ul class="sub-menu">
                            <div class="main-sub">
                                <li><a href="">NỮ</a>
                                    <ul>
                                        <li><a href="">MOMENT OF BLISS</a></li>
                                        <li><a href="">PREMIUM HANDSEWN</a></li>
                                        <li><a href="">BLOSSOMS DELIGHT</a></li>
                                        <li><a href="">DIỄM THƯ</a></li>
                                        <li><a href="">THE WHISPER OF CLASSY</a></li>
                                        <li><a href="">QUITELUXURY</a></li>
                                        <li><a href="">EXPRESS FALL/WINTER 2023 COLLECTION</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </ul>        
                    </li>
                    <li><a href="">VỀ CHÚNG TÔI</a>
                        <ul class="sub-menu" id="about">
                            <ul class="event">
                                <li><a href="">Về IVY moda</a></li>
                                <li><a href="">Fashion Show</a></li>
                                <li><a href="">Hoạt động cộng đồng</a></li>
                            </ul>
                        </ul>              
                    </li>
            </nav>
            <div class="others">
                <li><input type="text" placeholder="Tìm kiếm ..." class="search-form"><i class="fa-solid fa-magnifying-glass"></i></li>
                <li><a href=""><i class="fa-solid fa-headphones"></i></a></li> 
                <li><a href="login.html"><i class="fa-regular fa-user"></i></a></li>
                <li><a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a></li>
            </div>
        </div>
        
    </header>
    <main class="site-main">
        <div class="container">
            <section class="cartegory">
                <div class="cartegory-top d-flex">
                    <a href="index.html">Trang chủ </a> <span>&#10230;</span> <p>Nữ</p> <span>&#10230;</span><p>NEW ARRIVAL</p>
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
                                    <p class="cartegory-left-li-content d-flex">Mức chiết khấu
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
                                <p class="cartegory-left-li-content d-flex">Nâng cao
                                    <span class="icon-plus"></span>
                                    <span class="icon-minus"></span>
                                </p>

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
                        <div class="cartegory-right-content d-flex">
                            <?php foreach($products as $product): ?>
                                <div class="cartegory-right-content-item">
                                    <div class="images">
                                        <img src="../<?=html_escape($product->thumb1)?>" alt="">
                                        <img src="../<?=html_escape($product->thumb2)?>" class="img-hover" alt="">
                                    </div>
                                    <p><?=html_escape($product->tittle)?></p>
                                    <p class="formatted-number" ><strong><?=html_escape($product->price - ($product->discount * $product->price * 0.01)) . "đ"?> </strong><del><?=html_escape($product->price) . "đ"?></del></p>
                                    <div class="add-to-cart">
                                        
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        
    </main>
    
    <div class="site-bottom">
        <div class="container">
            <div class="main-footer d-flex">
                <div class="left-footer">
                    <div class="top-left">
                        <a href="">
                            <img src="../images/logo.jpg" alt="" style="height: 50px; width: 50px;" >
                        </a>
                        <a href="#" class="mt-3">
                            <img src="../images/footer/footer1.png" alt="">
                        </a>
                        <a href="#" class="mt-3">
                            <img src="../images/footer/footer2.png" alt="">
                        </a>
                    </div>
                    <p>Công ty Cổ phần Dự Kim với số đăng ký kinh doanh: 018629064</p>
                    <p><strong>Địa chỉ đăng ký:</strong> đường 3/2, phường Xuân Khánh, Quận Ninh Kiều, thành phô Cần Thơ</p>
                    <p><strong>Số điện thoại:</strong> 0933 205 2222/ 090 589 9870</p>
                    <p><strong>Email:</strong> lephuongnam958506@gmail.com</p>
                    <ul class="list-social">
                        <li>
                            <a href="#">
                                <img id="fb" src="../images/footer/ic_fb.svg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img id="gg" src="../images/footer/ic_gg.svg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img id="ins" src="../images/footer/ic_instagram.svg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img id="pin" src="../images/footer/ic_pinterest.svg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img id="yt" src="../images/footer/ic_ytb.svg" alt="">
                            </a>
                        </li>   
                    </ul>
                    <div class="hotline">
                        <a href="tel:0286289162" class="button active">Hotline: 0286 289 162</a>
                    </div>
                </div>
                <div class="center-footer">
                    <div class="left-center">
                        <div class="title-footer">
                            <p class="title-footer">Giới thiệu</p>
                        </div>
                        <ul>
                            <li>
                                <a href="#">Về 2N Shop</a>
                            </li>
                            <li>
                                <a target="_blank" href="#">Tuyển dụng</a>
                            </li>
                            <li>
                                <a href="#">Hệ thống cửa hàng</a>
                            </li>
                        </ul>
                    </div>
                    <div class="main-center">
                        <div class="title-footer">
                            <p class="title-footer">Dịch vụ khách hàng</p>
                        </div>
                        <ul>
                            <li>
                                <a href="#">Chính sách điều khoản</a>
                            </li>
                            <li>
                                <a href="#">Hướng dẫn mua hàng</a>
                            </li>
                            <li>
                                <a href="#">Chính sách thanh toán</a>
                            </li>
                            <li>
                                <a href="#">Chính sách đổi trả</a>
                            </li>
                            <li>
                                <a href="#">Chính sách bảo hành</a>
                            </li>
                            <li>
                                <a href="#">Chính sách giao nhận vận chuyển</a>
                            </li>
                            <li>
                                <a href="#">Chính sách thẻ thành viên</a>
                            </li>
                            <li>
                                <a href="#">Hệ thống cửa hàng</a>
                            </li>
                            <li>
                                <a href="#">Q&amp;A</a>
                            </li>
                        </ul>
                    </div>
                    <div class="right-center">
                        <div class="title-footer">
                            <p class="title-footer">Liên hệ</p>
                        </div>
                        <ul>
                            <li>
                                <a href="tel:0286289162">Hotline</a>
                            </li>
                            <li>
                                <a href="mailto:lephuongnam958506@gmail.com">Email</a>
                            </li>
                            <li>
                                <a href="#">Live Chat</a>
                            </li>
                            <li>
                                <a href="#" target="_blank">Messenger</a>
                            </li>
                            <li>
                                <a href="#">Liên hệ</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="right-footer">
                    <div class="register-form">
                        <div class="title-footer">
                            <p class="title-footer">Nhận thông tin các chương trình của 2N Shop</p>
                        </div>
                        <form id="frm_subscribe">
                            <input id="email_subscribe" type="text" name="email" placeholder="Nhập địa chỉ email" required="required">
                            <div class="btn-submit">
                                <input id="btn-submit" class="form-submit button--outline" value="Đăng ký" type="submit">
                            </div>
                        </form>
                        <div id="subscribe_error"></div>
                    </div>
                    <div class="info-right-ft">
                        <div class="title-footer">
                            <p class="title-footer">Download App</p>
                        </div>
                        <ul>
                            <li>
                                <a id="app_ios" href="#" class="link-white" target="_blank" title="Tải App 2N trên App Store"> <img src="https://pubcdn.ivymoda.com/ivy2/images/appstore.png" class="img-fluid" alt=""> </a>
                            </li>
                            <li>
                                <a id="app_android" href="#" class="link-white" target="_blank" title="Tải App 2N trên Google Play"> <img src="https://pubcdn.ivymoda.com/ivy2/images/googleplay.png" class="img-fluid" alt=""> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer id="footer" class="site-footer">
        <div class="coppy-right">©All rights reserved</div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sliderbar = document.querySelectorAll(".cartegory-left-li-menu");
        sliderbar.forEach(function (menu, index) {
            menu.addEventListener("click", function () {
                menu.classList.toggle("block")
            })
        });

        function formatNumberWithCommas(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        const amountFrom = document.querySelector("#amount-from");
        const valueRange = document.querySelector("#myRange");
        valueRange.addEventListener("input", (event) => {
            amountFrom.textContent = formatNumberWithCommas(event.target.value) + "đ";
        });

        const buttonSizes = document.querySelectorAll(".list-size .button-size");
        buttonSizes.forEach(function (buttonSize, index) {
            buttonSize.addEventListener("click", function () {
                var count = document.querySelectorAll(".list-size .button-size.active").length;
                if (count == 1) {
                    document.querySelector(".list-size .button-size.active").classList.remove("active");
                    buttonSize.classList.add("active");
                } else {
                    buttonSize.classList.add("active");
                }
            })
        })

        const buttonColors = document.querySelectorAll(".list-color .button-color");
        buttonColors.forEach(function (buttonColor, index) {
            buttonColor.addEventListener("click", function () {
                var count = document.querySelectorAll(".list-color .button-color.active").length;
                if (count == 1) {
                    document.querySelector(".list-color .button-color.active").classList.remove("active");
                    buttonColor.classList.add("active");
                } else {
                    buttonColor.classList.add("active");
                }
            })
        })
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
        function confirmDelete() {
            if (confirm("Bạn có muốn xóa không?")) {
                alert("Đã xóa!");
            } else {
                return false;
            }
        }
    </script>
</body>
</html>