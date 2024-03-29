<?php
require_once __DIR__ . '/../../utils/bootstrap.php';
use CT275\Project\Product;
$product = new Product($PDO);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && ($product->find($_POST['id'])) !== null) {
    $product->delete();
}

redirect('/app/admin/product/products.php');