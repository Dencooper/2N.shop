<?php
require_once __DIR__ . '/../../utils/bootstrap.php';
use CT275\Project\Category;
$category = new Category($PDO);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && ($category->find($_POST['id'])) !== null) {
    
    try {
        $category->delete();
    } catch (Exception $e) {
        redirect('/app/admin/category/categories.php');
    }
}

redirect('/app/admin/category/categories.php');