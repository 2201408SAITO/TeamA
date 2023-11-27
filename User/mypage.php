<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu_noswip.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Mypage</title>
    <link rel="stylesheet" href="css/mypage.css"> 
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
    echo '<p>名前　　　　　　', $row['user_name'], '</p>';
    echo '<p>郵便番号　　　　', $row['post_code'], '</p>';
    echo '<p>住所　　　　　　', $row['address'], '</p>';
    echo '<p>電話番号　　　　', $row['phone_number'], '</p>';
    echo '<p>メールアドレス　', $row['mail'], '</p>';

    echo '<div class="but">';
    echo '<form action="update_user.php" method="post">';
    echo '<input type="hidden" name="user_id" value="', $row['user_id'], '">';
    echo '<input type="submit" class="btn" value="更新">';
    echo '</form>';
    echo '<form action="delete_user.php" method="post">';
    echo '<input type="hidden" name="user_id" value="', $row['user_id'], '">';
    echo '<input type="submit" class="btn" value="ユーザー退会">';
    echo '</form>';
    echo '</div>';

    echo '<hr>';
    echo '<p>あなたのポイント　', $row['point'], 'Pt','</p>';
    echo '<p>クレジットカード情報　　<a href="credit_card.php">こちらから</a></p>';

    echo '<div class="but">';
    echo '<form action="buylist.php" method="post">';
    echo '<input type="hidden" name="user_id" value="', $row['user_id'], '">';
    echo '<input type="submit" class="btn" value="購入履歴">';
    echo '</form>';
    echo '<form method="POST" action="logout-input.php">';
    echo '<button type="submit" class="out_btn">ログアウト</button>';
    echo '</form>';
    echo '</div>';
?>

</body>
</html>
