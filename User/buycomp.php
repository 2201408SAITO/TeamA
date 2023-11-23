<?php session_start();?>
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
                <input type="submit"name="home"value="Home">
            </form>
              <?php          
              $user_id=$_SESSION['users']['id'];//ここをセッションで
              $sum=$_POST['count'];//合計金額の受け取り
              $plan=$_POST['paymethod'];//支払方法の受け取り
              $currentDate = date("Y-m-d"); // 現在の日付を取得
                 //購入に挿入するデータはユーザーidと購入日、合計金額、支払方法             
$sql = $pdo->prepare('INSERT INTO buy (user_id, buy_date, total, plan) VALUES (?, ?, ?, ?)');
$sql->execute([$user_id, $currentDate, $sum, $plan]);

//購入詳細には購入idと商品id別で商品別の購入数
// 直前に挿入した購入のIDを取得
$buy_id = $pdo->lastInsertId();

// 購入詳細テーブルに挿入

foreach ($_SESSION['user_cart'][$user_id] as $id => $product) {
    $goods_id = $id;
    $quantity = $product['count'];

    // buy_detail テーブルへの挿入
    $sql_detail = $pdo->prepare('INSERT INTO buy_detail (buy_id, goods_id, buy_size) VALUES (?,?,?)');
    $sql_detail->execute([$buy_id, $goods_id, $quantity]);

    // 在庫を減らす処理
    $sql_update_stock = $pdo->prepare('UPDATE goods SET count = count - ? WHERE goods_id = ?');
    $sql_update_stock->execute([$quantity, $goods_id]);
}
unset($_SESSION['user_cart'][$user_id]);
        
     ?>
   
</body>
</html>