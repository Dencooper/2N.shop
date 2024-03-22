<?php
    session_start();
    ob_start();
    include "../src/partials/db_connect.php";
    include "../src/partials/user.php";
    

    if ((isset($_POST['login'])) && ($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = checkuser($username, $password);
        $_SESSION['role']=$role;
        if ($role == '1') header('location: index.php');
        else if ($role == '0') header('location: frontend/view.php');
        else {
            $txt_error = "Username hoặc Password không tồn tại";
        }
        
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"/>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2">
                <div class="card">
                    <div class="card-header alert-info" role="alert">
                        <h4>Nhập thông tin đăng ký</h4>
                    </div>
                    <div class="card-body">
                        <form id="signupForm" action="#" method="post">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Tên đăng nhập</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="username" placeholder="Nhập tên đăng nhập"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Mật khẩu</label>
                                <div class="col-sm-5">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Nhập mật khẩu"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5 offset-sm-4">
                                    <button type="submit" class="btn btn-primary" name="login" value="Login">Đăng nhập</button>
                                </div>
                            </div>
                            <?php
                            if (isset($txt_error)&&($txt_error!="")){
                               echo "<font color='red'>".$txt_error."</font>";
                            }
        
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>