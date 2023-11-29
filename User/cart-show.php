<?php
session_start();
?>
<?php
if (!isset($_SESSION['users']['id'])) {
    header('Location:login-input.php');
    exit(); // これ以降のコードを実行しない
}

?>
<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu_noswip.php'; ?>
<?php require 'cart.php'; ?>
<?php require 'footer.php'; ?>