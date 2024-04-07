<?php

define('TITLE', 'Logout');


session_start();

unset($_SESSION['email']);

if (isset($_COOKIE['session_cookie'])) {
    setcookie('session_cookie', '', time() - 3600, '/');
}

session_unset();

session_destroy();

header("Location: ../../home.php");
exit();
