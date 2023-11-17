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
    $sql=$pdo->prepare('select * from users where mail = ?');
    $sql->execute([$_POST['mail']]);

    if(empty($sql->fetchAll())){

        $sql=$pdo->prepare('insert into users values(null, ?, ?, ?, ?, ?, ?, null, null, 0)');
        $sql->execute([$_POST['password'], $_POST['name'], $_POST['address'], $_POST['mail'], $_POST['phoneNumber'], $_POST['postcode']]);
        
        echo 'ご登録ありがとうございます';
    }else{
        echo 'このメールアドレスは既に登録されています';
    }

?>
</body>
</html>