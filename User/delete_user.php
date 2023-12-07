<?php session_start(); 
if (!isset($_SESSION['users']['id'])) {
    header('Location:login-input.php');
    exit(); // これ以降のコードを実行しない
}
?>
<?php unset($_SESSION['users']); ?>
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?>
<?php require 'menu_noswip.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー退会</title>
    <link rel="stylesheet" href="css/delete_user.css"> 
</head>
<body>
    <?php
        $pdo = new PDO($connect, USER, PASS);
        $sql=$pdo->prepare('update users set leave_date =? where user_id=?');
        $sql->execute([date("Y/m/d",time()),$_POST['user_id']]);
    ?>

    <main class="WrapperUserFinish">
        <section class="BodyUserFinish">
          <label style="color:red;">ご利用いただきありがとうございました。</label>
        </section>
    </main>
</body>
</html>