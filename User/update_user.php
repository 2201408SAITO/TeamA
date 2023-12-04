<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu_noswip.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Mypage</title>
    <link rel="stylesheet" href="css/update_user.css"> 
    <script src="js/jquery-3.7.0.min.js"></script>
    <script src="js/addsearch.js"></script>
</head>
<body>
<br><br><br><br><br>
<div class="main">ユーザー情報</div>
<br>
<?php
    // ログインしているユーザーの情報を取得する
    $sql = $pdo->prepare('SELECT * FROM users WHERE user_id = ?');
    $sql->execute([$_SESSION['users']['id']]);
    
    // 取得したユーザー情報を表示する
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    echo  '<p>',$_SESSION['users']['name'], 'さんのマイページ<p>';
    echo '<hr>';
    $name=$post_code=$address=$phone_number=$mail='';
    if(isset($_SESSION['users'])){
        $name=$_SESSION['users']['name'];
        $post_code=$_SESSION['users']['post_code'];
        $address=$_SESSION['users']['address'];
        $phone_number=$_SESSION['users']['phone_number'];
        $mail=$_SESSION['users']['mail'];
    }
    echo '<form action="update_user_output.php" method="post">';
    echo '<p>名前　　　　　　';
    echo '<input type="text" name="name" class="input is-normal" style="outline:none; border-color:seagreen; width:500px;" value="',$name,'">';
    echo '</p>';
    echo '<p>郵便番号　　　　';
    echo '<input type="text" name="post_code" class="input is-normal" pattern="^[0-9]+$" minlength="7" maxlength="7" style="outline:none; border-color:seagreen; width:500px;" value="',$post_code,'">';
    echo '</p>';
    echo '<p>住所　　　　　　';
    echo '<input type="text" name="address" class="input is-normal" style="outline:none; border-color:seagreen; width:500px;" value="',$address,'">';
    echo '</p>';
    echo '<p>電話番号　　　　';
    echo '<input type="text" name="phone_number" class="input is-normal" pattern="^[0-9]+$" minlength="10"  maxlength="12" style="outline:none; border-color:seagreen; width:500px;" value="',$phone_number,'">';
    echo '</p>';
    echo '<p>メールアドレス　';
    echo '<input type="text" name="mail" class="input is-normal" style="outline:none; border-color:seagreen; width:500px;" value="',$mail,'">';
    echo '</p>';
    echo '<hr>';

    echo '<div class="but">';
    echo '<form action="mypage.php" method="post">';
    echo '<input type="hidden" name="user_id" value="', $row['user_id'], '">';
    echo '<input type="submit" class="btn" value="更新">';
    echo '</form>';
?>

<?php require 'footer.php'; ?>
