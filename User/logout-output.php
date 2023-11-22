<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu_noswip.php'; ?>
<?php
if(isset($_SESSION['users'])){
    unset($_SESSION['users']);
    echo 'ログアウトしました。';

  
}else{
    echo 'すでにログアウトしています。';
    
}
echo '<form method="POST" action="login-input.php">';
echo '<button type="submit" class="btn">ログイン画面へ</button>';
echo '</form>';
?>
<?php require 'footer.php'; ?>