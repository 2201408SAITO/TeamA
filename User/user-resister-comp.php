<?php session_start(); ?>
<?php require 'db-connect.php'?>
<?php require 'menu.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録完了画面</title>
</head>
<body>
<?php
    if($sql->fetchAll()){
    }
    $sql=$pdo->prepare('insert into users values(null, ?, ?, ?, ?, ?, ?, null, null, 0)');
    $sql->execute([$_POST['password'],$_POST['name'],$_POST['address'],$_POST['mail'],$_POST['postcode'],$_POST['password']]);
?>
</body>
</html>