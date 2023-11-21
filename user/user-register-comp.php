<?php session_start(); ?>
<?php require 'db-connect.php'?>
<?php require 'menu.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/comp.css">
    <title>登録完了画面</title>


</head>
<body>
<?php
    $sql=$pdo->prepare('select * from users where mail = ? or phone_number = ?');
    $sql->execute([$_POST['mail'], $_POST['phoneNumber']]);

    if(empty($sql->fetchAll())){

        $sql=$pdo->prepare('insert into users values(null, ?, ?, ?, ?, ?, ?, null, null, 0)');
        $sql->execute([$_POST['password'], $_POST['name'], $_POST['address'], $_POST['mail'], $_POST['phoneNumber'], $_POST['postcode']]);
        echo '<div class ="aaa">';
        echo '<div class ="wrapper">';
        echo '<div class ="out">';
        echo '<form method="POST" action="index.php">';
        echo 'ご登録ありがとうございます';

        echo '<button type="submit" class="btn">ホーム</button>';
        echo '</form>';
        $_SESSION['users']=[ 
            'name'=> $_POST['name'], 
            'address' => $_POST['address'],
            'mail' => $_POST['mail'],
            'password' => $_POST['password']
            ];
        
    }else{

        echo '<div class ="aaa">';
        echo '<div class ="wrapper">';
        echo '<div class ="out">';
        echo '<form method="POST" action="user-register.php">';
        echo 'この電話番号かメールアドレスは既に登録されています';
        
        echo '<button type="submit" class="btn">戻る</button>';
        echo '</form>';
    }

?>
</body>
</html>