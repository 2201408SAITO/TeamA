<?php session_start(); ?>
<?php
if (!isset($_SESSION['users']['id'])) {
    header('Location: login-input.php');
    exit(); // これ以降のコードを実行しない
}
?>
<?php require 'header.php'; ?>
<?php require 'menu_noswip.php'; ?>
<?php require 'db-connect.php';?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>buycomp</title>
    <link rel="stylesheet" href="css/buycomp.css">
</head>
<body> 
    <h1>ご購入ありがとうございました</h1>

    <form action="index.php" method="post">
        <input type="submit" name="home" value="Home">
    </form>
    <?php          
    $user_id = $_SESSION['users']['id'];
    $sum = $_POST['count'];
    $plan = $_POST['paymethod'];
    $currentDate = date("Y-m-d");

    // 現在のポイントを取得
    $sql_get_point = $pdo->prepare('SELECT point FROM users WHERE user_id = ?');
    $sql_get_point->execute([$user_id]);
    $current_point = $sql_get_point->fetchColumn();

    // 新しいポイントを計算
    $new_point = $current_point + ($sum * 0.01);

    // ポイントを更新
    $sql_point = $pdo->prepare('UPDATE users SET point=? WHERE user_id=?');
    $sql_point->execute([$new_point, $user_id]);

    $sql = $pdo->prepare('INSERT INTO buy (user_id, buy_date, total, plan) VALUES (?, ?, ?, ?)');
    $sql->execute([$user_id, $currentDate, $sum, $plan]);

    // 直前に挿入した購入のIDを取得
    $buy_id = $pdo->lastInsertId();

    // 購入詳細テーブルに挿入
    foreach ($_SESSION['user_cart'][$user_id] as $id => $product) {
        $goods_id = $id;
        $quantity = $product['count'];

        $sql_zaiko = $pdo->prepare('SELECT count FROM goods WHERE goods_id = ?');
        $sql_zaiko->execute([$goods_id]);
        $row = $sql_zaiko->fetch(PDO::FETCH_BOTH);
        $zaiko = $row['count'];

        if ($zaiko >= $quantity) {
            // buy_detail テーブルへの挿入
            $sql_detail = $pdo->prepare('INSERT INTO buy_detail (buy_id, goods_id, buy_size) VALUES (?,?,?)');
            $sql_detail->execute([$buy_id, $goods_id, $quantity]);

            // 在庫を減らす処理
            $sql_update_stock = $pdo->prepare('UPDATE goods SET count = count - ? WHERE goods_id = ?');
            $sql_update_stock->execute([$quantity, $goods_id]);
        }
    }

    unset($_SESSION['user_cart'][$user_id]);
    ?>
</body>
</html>
