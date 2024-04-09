<nav class="navbar navbar-expand-md sticky-top navbar-light bg-light container mt-3 mb-3">
    <div class="pl-3 back-product-list" style="font-size:25px;">
        <a href="../product/products.php">
            Sản Phẩm
        </a>
        |
        <a href="../category/categories.php">
            Danh Mục
        </a>
        |
        <a href="../user/users.php">
            Tài Khoản
        </a>
        |
        <a href="/home.php">
            Trang Chủ
        </a>
    </div>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li><span style="font-size:16px; font-weight:600;" ><?= $user->fullname?></span></li>
            <li><a href="../../frontend/logout.php" data-bs-toggle="tooltip" title="Đăng xuất"><i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>
    </div>
</nav>