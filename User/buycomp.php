<?php session_start();?>
<?php require 'header.php'; ?>
<?php require 'menu_noswip.php'; ?>
<?php require 'db-connect.php';?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録完了画面</title>
    <link rel="stylesheet" href="css/Finish.css">
    <script src="./script/Register.js"></script>
</head>
<body> 
    <h2>ご購入ありがとうございました</h2>
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
foreach ($_SESSION['product'] as $id => $product) {
    $goods_id = $id;
    $quantity = $product['count'];

    $sql_detail = $pdo->prepare('INSERT INTO buy_detail (buy_id, goods_id, buy_size) VALUES (?,?,?)');
    $sql_detail->execute([$buy_id, $goods_id, $quantity]);
    //在庫を減らす処理
}             $_SESSION['product'] = array();
     ?>
        <section class="foot">
            <form action="index.php" method="post">
                <button class="register" type="submit">HOME</button>
            </form>
        </section>
    </main>
</body>
</html>