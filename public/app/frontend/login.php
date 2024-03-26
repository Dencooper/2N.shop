<?php
    session_start();
    ob_start();
    include "../src/partials/db_connect.php";
    include "../src/partials/user.php";
    require_once __DIR__ . '/../src/bootstrap.php';
    

    if ((isset($_POST['login'])) && ($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = checkuser($username, $password);
        if ($role == '1') header('location: index.php');
        else if ($role == '0') header('location: frontend/view.php');
        else {
            $txt_error = "Username hoặc Password không tồn tại";
        }
        
    }

    include_once __DIR__ . '/../src/partials/header.php';
?>


<body>
<?php include_once __DIR__ . '/../src/partials/navbar.php' ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="card">
                    <div class="card-header alert-info" role="alert">
                        <h4>Nhập thông tin đăng ký</h4>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once __DIR__ . '/../src/partials/footer.php' ?>