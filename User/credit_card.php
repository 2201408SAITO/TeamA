<?php
session_start();
require 'db-connect.php';
$sql = $pdo->prepare('select credit_card from users where user_id = ?');
$sql->execute([$_SESSION['users']['id']]);
$row = $sql->fetch(PDO::FETCH_BOTH);
$card = $row['credit_card'];
$user=$_SESSION['users']['id'];

?>
<?php
require 'header.php';
require 'menu_noswip.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/credit_card.css">
    <title>credit-register</title>
</head>
<body>


    <div class="wrapper">
        <section class="head">
            <h2>クレジットカード情報</h2>
        </section>
        <form method="post" action="credit_card-comp.php">
    
        <p class="num">クレジットカード番号
    <input type="text" placeholder="16桁の数字で入力してください" style="width: 200px;" value="<?php echo htmlspecialchars($card); ?>" name="credit_card_number" required pattern="^[0-9]{16,16}$">
</p><br>

<p class="expiry">クレジットカード有効期限
    <input type="text" placeholder="2桁の数字で入力してください" style="width: 200px;" value="<?php echo htmlspecialchars($_SESSION['credit_card'][$user]['expiry_month']); ?>" name="expiry_month" required pattern="^[0-9]{2,2}$">月
    <input type="text" placeholder="4桁の数字で入力してください" style="width: 200px;" value="<?php echo htmlspecialchars($_SESSION['credit_card'][$user]['expiry_year']); ?>" name="expiry_year" required pattern="^[0-9]{4,4}$">年
</p><br>

<p class="code">セキュリティコード
    <input type="text" placeholder="4桁の数字で入力してください" style="width: 200px;" value="<?php echo htmlspecialchars($_SESSION['credit_card'][$user]['security_code']); ?>" name="security_code" required pattern="^[0-9]{4,4}">
</p><br>

            <?php 
            if ($card!=null)  {
                echo '<input type="submit" value="更新" class="register">';
                echo '<input type="hidden" name="id" value="更新">';
            } else {
                echo '<input type="submit" value="登録" class="register">';
                echo '<input type="hidden" name="id" value="登録">';
            }
            ?>
        </form>
       
    </div>
</body>
</html>
