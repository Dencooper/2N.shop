<?php
require_once __DIR__ . '/../../utils/bootstrap.php';
use CT275\Project\User;
$user = new User($PDO);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && ($user->find($_POST['id'])) !== null) {
    $user->delete();
}

redirect('/app/admin/user/users.php');