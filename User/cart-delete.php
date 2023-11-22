<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu_noswip.php'; ?>
<?php
$user_id = $_SESSION['users']['id'];
    unset($_SESSION['user_cart'][$user_id][$_GET['id']]);
    echo 'カートから商品を削除しました。';
    echo '<hr>';
    require 'cart.php';
?>
<?php require 'footer.php'; ?>