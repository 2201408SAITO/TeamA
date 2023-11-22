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
<form action="kensaku-input.php" method="post">
    <table>
        <?php
        echo  $_SESSION['users']['name'], 'さんのマイページ';
           echo '<form method="POST" action="login-input.php">';
           echo '<button type="submit" class="btn">ログイン画面</button>';
           echo '</form>';
           echo '<form method="POST" action="logout-input.php">';
           echo '<button type="submit" class="btn">ログアウト</button>';
           echo '</form>';
        ?>
    </table>
</form>
</body>
</html>