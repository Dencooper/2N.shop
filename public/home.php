<?php
require_once __DIR__ . '/app/utils/bootstrap.php';
use CT275\Project\Product;
use CT275\Project\User;

$user = new User($PDO);
$product = new Product($PDO);

session_start();
if(isset($_SESSION['email']) && isset($_COOKIE['session_cookie']) && $_COOKIE['session_cookie'] == session_id()){
    $user = $user->findEmail($_SESSION['email']);
}
$products = $product->all();
$count = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="app/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="icon" href="app/images/logo.png" type="image/png" sizes="20x20">
    <title>Trang Chủ | 2N Shop</title>
</head>
<body>
    <header>
        <div class="container d-flex">
            <div class="logo">
                <a href="home.php">
                    <img src="app/images/logo.png" alt="">
                </a>
            </div>
            <nav>
                <div class="menu">
                    <li><a href="app/frontend/category.php">NỮ</a></li>
                    <li><a href="app/frontend/categoryMen.php">NAM</a></li>
                    <li><a href="app/frontend/categoryKids.php">TRẺ EM</a></li>
                    <li><a href="#" class="sale">SALE MÙA LỄ HỘI</a></li>
                    <li>
                        <?php
                            $role = $user->role_id;
                            if ($role === 0){
                                echo '<a href="app/admin/product/products.php">
                                QUẢN LÍ DANH MỤC
                                </a>';
                            } 
                            else{
                                echo '<a href="">
                                VỀ 2N SHOP
                                </a>';
                            }
                        ?>
                    </li>
            </nav>
            <div class="others">
                <?php if(isset($_SESSION['email']) && isset($_COOKIE['session_cookie']) && $_COOKIE['session_cookie'] == session_id()):?>
                    <li><a href=""><?= $user->fullname?></a></li>
                    <li><a href="faq.php"><i class="fa-solid fa-headphones"></i></a></li>
                    <li><a href="app/frontend/logout.php" data-bs-toggle="tooltip" title="Đăng xuất"><i class="fa-solid fa-right-from-bracket"></i></i></a></li>
                <?php else: ?>
                    <li><a href="app/frontend/faq.php"><i class="fa-solid fa-headphones"></i></a></li>
                    <li><a href="app/frontend/login.php" data-bs-toggle="tooltip" title="Đăng nhập"><i class="fa-solid fa-user"></i></i></i></a></li>
                    <li><a href="app/frontend/register.php" data-bs-toggle="tooltip" title="Đăng kí"><i class="fa-solid fa-user-plus"></i></a></li>
                <?php endif?>
            </div>
        </div>
        
    </header>
    <main id="main" class="site-main">
        <div class="container">
            <div id="slider" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#slider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#slider" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#slider" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#slider" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="app/images/slider/slide1.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="app/images/slider/slide2.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="app/images/slider/slide3.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="app/images/slider/slide4.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev justify-content-start ps-3" type="button" data-bs-target="#slider" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next justify-content-end pe-3" type="button" data-bs-target="#slider" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
            <section class="home-new-pro">
                <div id="sale-content">
                    <strong>HAPPY HOLI-YAY | GIẢM 30% TOÀN BỘ SẢN PHẨM MỚI NHẤT</strong>
                </div>
                <div class="exclusive-tabs">
                    <div class="exclusive-head">
                        <ul>
                            <li class="exclusive-tab active">IVY moda</li>
                            <li class="exclusive-tab">IVY men</li>
                            <li class="exclusive-tab">IVY kids</li>
                        </ul>
                    </div>
                </div>
                <div class="home-cartegory">
                    <div class="moda active home-cartegory-content">
                        <div class="cartegory-right-content d-flex flex-wrap justify-content-start" >
                            <?php foreach($products as $product):
                                if ($product->category_id == 1): 
                                    $count++;
                                    if ($count > 5) {
                                        break;
                                    }?>
                                    <div class="cartegory-right-content-item" style="width:20%" onclick="product_detail(<?=html_escape($product->getId())?>)">
                                        <div class="images">
                                            <img src="app/<?=html_escape($product->thumb1)?>" alt="">
                                            <img src="app/<?=html_escape($product->thumb2)?>" class="img-hover" alt="">
                                        </div>
                                        <p style="height:45px;" ><?=html_escape($product->title)?></p>
                                        <p class="formatted-number" ><strong><?=html_escape($product->price - ($product->discount * $product->price * 0.01))?>đ </strong><del><?=html_escape($product->price)?>đ</del></p>
                                        <div class="add-to-cart">
                                            
                                        </div>
                                    </div>
                            <?php endif; endforeach ?>
                        </div>   
                    </div>
                    <div class="men home-cartegory-content">
                        <div class="cartegory-right-content d-flex justify-content-start">
                            <?php foreach($products as $product): 
                                if ($product->category_id == 6): ?>
                                    <div class="cartegory-right-content-item" style="width:20%" onclick="product_detail(<?=html_escape($product->getId())?>)">
                                        <div class="images">
                                            <img src="app/<?=html_escape($product->thumb1)?>" alt="">
                                            <img src="app/<?=html_escape($product->thumb2)?>" class="img-hover" alt="">
                                        </div>
                                        <p><?=html_escape($product->title)?></p>
                                        <p class="formatted-number" ><strong><?=html_escape($product->price - ($product->discount * $product->price * 0.01))?>đ </strong><del><?=html_escape($product->price)?>đ</del></p>
                                        <div class="add-to-cart">
                                            
                                        </div>
                                    </div>
                            <?php endif; endforeach ?>
                        </div>   
                    </div>
                    <div class="kids home-cartegory-content">
                        <div class="cartegory-right-content d-flex justify-content-start">
                            <?php foreach($products as $product): 
                                if ($product->category_id == 8): ?>
                                    <div class="cartegory-right-content-item" style="width:20%" onclick="product_detail(<?=html_escape($product->getId())?>)">
                                        <div class="images">
                                            <img src="app/<?=html_escape($product->thumb1)?>" alt="">
                                            <img src="app/<?=html_escape($product->thumb2)?>" class="img-hover" alt="">
                                        </div>
                                        <p><?=html_escape($product->title)?></p>
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
    <div class="site-bottom">
        <div class="container">
            <div class="main-footer d-flex">
                <div class="left-footer">
                    <div class="top-left">
                        <a href="">
                            <img src="app/images/logo.png" alt="" style="height: 50px; width: 50px;" >
                        </a>
                        <a href="#" class="mt-3">
                            <img src="app/images/footer/footer1.png" alt="">
                        </a>
                        <a href="#" class="mt-3">
                            <img src="app/images/footer/footer2.png" alt="">
                        </a>
                    </div>
                    <p>Công ty Cổ phần Dự Kim với số đăng ký kinh doanh: 018629064</p>
                    <p><strong>Địa chỉ đăng ký:</strong> đường 3/2, phường Xuân Khánh, Quận Ninh Kiều, thành phô Cần Thơ</p>
                    <p><strong>Số điện thoại:</strong> 0933 205 2222/ 090 589 9870</p>
                    <p><strong>Email:</strong> lephuongnam958506@gmail.com</p>
                    <ul class="list-social">
                        <li>
                            <a href="#">
                                <img id="fb" src="app/images/footer/ic_fb.svg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img id="gg" src="app/images/footer/ic_gg.svg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img id="ins" src="app/images/footer/ic_instagram.svg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img id="pin" src="app/images/footer/ic_pinterest.svg" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img id="yt" src="app/images/footer/ic_ytb.svg" alt="">
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
    <script src="app/js/script.js"></script>
    <script>
        function product_detail(productId){
            window.location.href = "app/frontend/product.php?id=" + productId;
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