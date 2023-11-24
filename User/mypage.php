<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu_noswip.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Mypage</title>
</head>
<body>

        <?php
        echo  '<br>' ,$_SESSION['users']['name'], 'さんのマイページ</br>';
           echo '<form method="POST" action="login-input.php">';
           echo '<br><button type="submit" class="btn">ログイン画面</button></br>';
           echo '</form>';
           echo '<form method="POST" action="logout-input.php"><br>';
           echo '<br><button type="submit" class="btn">ログアウト</button></br>';
           echo '</form>';
        ?>
</body>
</html>