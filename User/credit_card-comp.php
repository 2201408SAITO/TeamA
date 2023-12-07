<?php
session_start();
if (!isset($_SESSION['users']['id'])) {
    header('Location:login-input.php');
    exit(); // これ以降のコードを実行しない
}
require 'header.php';
require 'menu_noswip.php';
require 'db-connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; 

    $credit_card_number = $_POST['credit_card_number'];
    $expiry_month = $_POST['expiry_month'];
    $expiry_year = $_POST['expiry_year'];
    $security_code = $_POST['security_code'];

    if ($id === '登録') {
        $sql = $pdo->prepare('UPDATE users SET credit_card = ? WHERE user_id = ?');
        $sql->execute([$credit_card_number, $_SESSION['users']['id']]);
    } elseif ($id === '更新') {
        $sql = $pdo->prepare('UPDATE users SET credit_card = ? WHERE user_id = ?');
        $sql->execute([$credit_card_number, $_SESSION['users']['id']]);
    }

    // セッションにも保存
    $user=$_SESSION['users']['id'];
    $_SESSION['credit_card'][$user] = [
        'credit_card_number' => $credit_card_number,
        'expiry_month' => $expiry_month,
        'expiry_year' => $expiry_year,
        'security_code' => $security_code
    ];
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/credit-comp.css">
    <title>credit-register</title>
</head>
<body>
    <div class="wrapper">
        <section class="body">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                echo '<p>クレジットカード情報を'.$id.'しました。</p>';
            } else {
                echo '<p>アクセスが不正です。</p>';
            }
            ?>
        </section>
        <form action="mypage.php">
            <input type="submit" value="mypage" class="register">
        </form>
    </div>
</body>
</html>
