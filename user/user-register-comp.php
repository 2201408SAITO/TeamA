<?php session_start(); ?>
<?php require 'db-connect.php'?>
<?php require 'menu_noswip.php'; ?>
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


    if(strlen($_POST['postcode']) ==7){
        if(strlen($_POST['phoneNumber']) == 10 || strlen($_POST['phoneNumber']) == 11 || strlen($_POST['phoneNumber']) == 12){
            if(empty($sql->fetchAll())){

                $sql=$pdo->prepare('insert into users values(null, ?, ?, ?, ?, ?, ?, null, null, 0)');
                $sql->execute([$_POST['password'], $_POST['name'], $_POST['address'], $_POST['mail'], $_POST['phoneNumber'], $_POST['postcode']]);
                echo '<div class ="aaa">';
                echo '<div class ="wrapper">';
                echo '<div class ="out">';
                echo '<form method="POST" action="login-input.php">';
                echo 'ご登録ありがとうございます';
        
                echo '<button type="submit" class="btn">ログイン</button>';
                echo '</form>';
        
             
            }else{
        
                echo '<div class ="aaa">';
                echo '<div class ="wrapper">';
                echo '<div class ="out">';
                echo '<form method="POST" action="user-register.php">';
                echo 'この電話番号かメールアドレスは既に登録されています';
                
                echo '<button type="submit" class="btn">戻る</button>';
                echo '</form>';
            }

        }else{
                    
            echo '<div class ="aaa">';
            echo '<div class ="wrapper">';
            echo '<div class ="out">';
            echo '<form method="POST" action="user-register.php">';
            echo '電話番号は10~12桁で登録して下さい';
            
            echo '<button type="submit" class="btn">戻る</button>';
            echo '</form>';
        }
    }else{
                
        echo '<div class ="aaa">';
        echo '<div class ="wrapper">';
        echo '<div class ="out">';
        echo '<form method="POST" action="user-register.php">';
        echo '郵便番号は7桁で登録してください';        
        echo '<button type="submit" class="btn">戻る</button>';
        echo '</form>';
    }

    

?>
</body>
</html>