</head>
<body>
    <header>
        <div class="container d-flex">
            <div class="logo">
                <a href="../../home.php">
                    <img src="../images/logo.png" alt="">
                </a>
            </div>
            <nav>
                <form action="category" method="get">
                    <div class="menu">
                        <li><a href="category.php?id=1">NỮ</a>
                        </li>
                        <li><a href="category.php?id=6">NAM</a>
                        </li>
                        <li><a href="category.php?id=8">TRẺ EM</a></li>
                        <li><a href="" class="sale">SALE MÙA LỄ HỘI</a></li>
                        <li>
                            <?php
                                $role = $user->role_id;
                                if ($role === 0){
                                    echo '<a href="../admin/product/products.php">
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
                    </div>
                </form>
            </nav>
            <div class="others">
                <?php if(isset($_SESSION['email']) && isset($_COOKIE['session_cookie']) && $_COOKIE['session_cookie'] == session_id()):?>
                    <li><a href=""><?= $user->fullname?></a></li>
                    <li><a href="faq.php"><i class="fa-solid fa-headphones"></i></a></li>
                    <li><a href="logout.php" data-bs-toggle="tooltip" title="Đăng xuất"><i class="fa-solid fa-right-from-bracket"></i></i></a></li>
                <?php else: ?>
                    <li><a href="faq.php"><i class="fa-solid fa-headphones"></i></a></li>
                    <li><a href="login.php" data-bs-toggle="tooltip" title="Đăng nhập"><i class="fa-solid fa-user"></i></i></i></a></li>
                    <li><a href="register.php" data-bs-toggle="tooltip" title="Đăng kí"><i class="fa-solid fa-user-plus"></i></a></li>
                <?php endif?>
            </div>
        </div>
        
    </header>