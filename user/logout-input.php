<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu_noswip.php'; ?>

<link rel="stylesheet" href="css/logout.css">

<?php
    echo '<div class ="aaa">';
    echo '<div class ="wrapper">';
    echo '<div class ="out">';

    echo '<form method="POST" action="logout-output.php">';
    echo '<p>ログアウトしますか？</p>';
    echo '<button type="submit" class="btn">ログアウト</button>';
?>
<?php require 'footer.php'; ?>