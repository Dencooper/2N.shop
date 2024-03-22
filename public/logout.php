<?php

define('TITLE', 'Logout');


if (isset($_SESSION['role'])) {
    unset($_SESSION['role']);
}
header('location: login.php');

echo '<p>Bạn đã đăng xuất.</p>';
