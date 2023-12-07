<?php session_start(); 
if (!isset($_SESSION['users']['id'])) {
    header('Location: https://aso2201418.vivian.jp/GitHub/TeamA/User/login-input.php');
    exit(); // これ以降のコードを実行しない
}
?>
<?php require 'header.php'; ?>
<?php require 'menu_noswip.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Mypage</title>
    <link rel="stylesheet" href="css/update_user_out.css"> 
</head>
<body>
<br><br><br>
<?php
$pdo=new PDO($connect,USER,PASS);

if(isset($_SESSION['users'])){
    $id=$_SESSION['users']['id'];
    $sql=$pdo->prepare('select * from users where user_id!=? and mail=?');
    $sql->execute([$id,$_POST['mail']]);
}else{
    $sql=$pdo->prepare('select * from users where mail=?');
    $sql->execute([$_POST['mail']]);   
}
if(strlen($_POST['post_code']) == 7){
    if(strlen($_POST['phone_number']) == 10 || strlen($_POST['phone_number']) == 11 || strlen($_POST['phone_number']) == 12){
        if(empty($sql->fetchAll())){
            if(isset($_SESSION['users'])){
                $sql=$pdo->prepare('update users set user_name=?, post_code=?, address=?, phone_number=?, mail=? where user_id=?');
    
                $sql->execute([
                    $_POST['name'],$_POST['post_code'],$_POST['address'],
                    $_POST['phone_number'],$_POST['mail'],$id]);
                $_SESSION['users']=[
                    'id'=>$id,'name'=>$_POST['name'],'post_code'=>$_POST['post_code'],
                    'address'=>$_POST['address'],'phone_number'=>$_POST['phone_number'],'mail'=>$_POST['mail']
                ];
                echo '<div class ="aaa">';
                echo '<div class ="wrapper">';
                echo '<div class ="out">';
                echo '<form method="POST" action="mypage.php">';
                echo '<div class="mes" style="text-align: center;">ユーザー情報を更新しました。';
                echo '<button type="submit" class="btn">マイページ</button>';
                echo '</form>';
                echo '</div>';  
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }else{
            echo '<div class ="aaa">';
            echo '<div class ="wrapper">';
            echo '<div class ="out">';
            echo '<form method="POST" action="update_user.php">';
            echo '<div class="mes" style="text-align: center;">メールアドレスが既に使用されています変更してください';
            echo '<button type="submit" class="btn">戻る</button>';
            echo '</form>';
            echo '</div>';  
            echo '</div>';
            echo '</div>';
            echo '</div>';      
        }
    }else{
        echo '<div class ="aaa">';
        echo '<div class ="wrapper">';
        echo '<div class ="out">';
        echo '<form method="POST" action="update_user.php">';
        echo '<div class="mes" style="text-align: center;">電話番号は10~12桁で登録してください';
        echo '<button type="submit" class="btn">戻る</button>';
        echo '</form>';
        echo '</div>';  
        echo '</div>';
        echo '</div>';
        echo '</div>';      
    }
}else{
    echo '<div class ="aaa">';
    echo '<div class ="wrapper">';
    echo '<div class ="out">';
    echo '<form method="POST" action="update_user.php">';
    echo '<div class="mes" style="text-align: center;">郵便番号は7桁で登録してください';
    echo '<button type="submit" class="btn">戻る</button>';
    echo '</form>';
    echo '</div>';  
    echo '</div>';
    echo '</div>';
    echo '</div>';      
}

?>
<?php require 'footer.php'; ?>