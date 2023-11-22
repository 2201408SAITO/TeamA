<?php
session_start();
require 'header.php';
require 'menu_noswip.php';

$id = $_POST['id'];

// ユーザーIDを取得
$user_id = $_SESSION['users']['id'];

// ユーザーごとのカート情報がまだセッションに存在しない場合は初期化
if (!isset($_SESSION['user_cart'][$user_id])) {
    $_SESSION['user_cart'][$user_id] = [];
}

$count = 0;

// ユーザーごとのカート情報内で商品が既に存在する場合は個数を更新
if (isset($_SESSION['user_cart'][$user_id][$id])) {
    $count = $_SESSION['user_cart'][$user_id][$id]['count'];
}

// 商品情報をセッションに保存
$_SESSION['user_cart'][$user_id][$id] = [
    'name' => $_POST['name'],
    'price' => $_POST['price'],
    'count' => $count + $_POST['count']
];

echo '<p>カートに商品を追加しました。</p>';
echo '<hr>';
require 'cart.php';
require 'footer.php';
?>
