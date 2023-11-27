<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu_noswip.php'; ?>

<link rel="stylesheet" href="css/logincomp.css">
<?php
if(isset($_SESSION['users'])){
    unset($_SESSION['users']);

    echo '<div class ="aaa">';
    echo '<div class ="wrapper">';
    echo '<div class ="out">';

    echo 'ログアウトしました。';
    echo '<form method="POST" action="login-input.php">';
    echo '<button type="submit" class="btn">ログイン画面へ</button>';
    echo '</form>';

  
}else{

    echo '<div class ="aaa">';
    echo '<div class ="wrapper">';
    echo '<div class ="out">';

    echo 'すでにログアウトしています。';
    echo '<form method="POST" action="login-input.php">';
    echo '<button type="submit" class="btn">ログイン画面へ</button>';
    echo '</form>';

    
    
}
?>
<?php require 'footer.php'; ?>