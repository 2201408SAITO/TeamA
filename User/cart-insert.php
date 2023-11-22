<?php
session_start();
require 'header.php';
require 'menu_noswip.php';

$id = $_POST['id'];

// ユーザーIDを取得
$user_id = $_SESSION['users']['id'];

if (!isset($_SESSION['product'])) {
    $_SESSION['product'] = [];
}

$count = 0;

if (isset($_SESSION['product'][$id])) {
    $count = $_SESSION['product'][$id]['count'];
}

$_SESSION['product'][$id] = [
    'name' => $_POST['name'],
    'price' => $_POST['price'],
    'count' => $count + $_POST['count']
];

echo '<p>カートに商品を追加しました。</p>';
echo '<hr>';
require 'cart.php';
require 'footer.php';
?>
