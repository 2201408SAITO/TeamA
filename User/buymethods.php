<?php session_start(); ?>
<?php
if (!isset($_SESSION['users']['id'])) {
    header('Location: https://aso2201418.vivian.jp/GitHub/TeamA/User/login-input.php');
    exit(); // これ以降のコードを実行しない
}

?>
<?php

$user=$_SESSION['users']['id'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>クレジットカード情報</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.0/css/bulma.min.css" />
  <link rel="stylesheet" href="css/buymethods.css">
</head>
<body>
<?php require 'header.php'; ?>
<?php require 'menu_noswip.php'; ?>
<?php require 'db-connect.php';?>
<?php   

$sql=$pdo->prepare('select * from users where user_id=?');
$sql->execute([$_SESSION['users']['id']]);
$userData = $sql->fetch(PDO::FETCH_ASSOC);
$card=$userData['credit_card'];
?>
<form action="buycomp.php" method="POST"class="form">
  <div id="app" class="container">
    <div class="columns is-mobile is-centered">
      <div class="column is-half">
        <!-- 決済方法のテーブル -->
        <table class="table">
          <thead>
            <tr>
              <th> 決済方法 :  </th>    
              <th :class="{'is-active': acitiveWordsTab }">
                <input type="radio" @click="changeTab(1)" name="paymethod" value="credit" checked>クレジット
              </th>
              <th :class="{'is-active': acitivePriceTab }">
                <input type="radio" @click="changeTab(2)" name="paymethod" value="daibiki">代引き
              </th>
            </tr>
          </thead>
        </table>

    <!-- クレジットカード情報フォーム -->
<div v-if="acitiveWordsTab" class="field">
  <label class="label" for="words">クレジットカード情報</label>
  <table class="table is-bordered">
  <tr>
    <td>クレジットカード番号</td>
    <td>
        <input type="text" placeholder="16桁の数字で入力" style="outline:none; border-color:seagreen; width: 200px;" value="<?php echo $card; ?>" class="input is-normal" name="card" required pattern="^[0-9]{16}$" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('16桁の数字を入力してください。')">
    </td>
</tr>
<tr>
    <td>クレジットカード有効期限</td>
    <td>
        <input type="text" placeholder="2桁の数字で入力" style="outline:none; border-color:seagreen; width: 150px;" value="<?php echo htmlspecialchars($_SESSION['credit_card'][$user]['expiry_month']); ?>" class="input is-normal" name="expiry_month" required pattern="^(0[1-9]|1[0-2])$" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('2桁の数字を入力してください。例(1月→01月)')">月
        <input type="text" placeholder="4桁の数字で入力" style="outline:none; border-color:seagreen; width: 150px;" value="<?php echo htmlspecialchars($_SESSION['credit_card'][$user]['expiry_year']); ?>" class="input is-normal" name="expiry_year" required pattern="^[0-9]{4}$" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('4桁の数字を入力してください。')">年
    </td>
</tr>
<tr>
    <td>セキュリティコード</td>
    <td>
        <input type="text" placeholder="3桁の数字で入力" style="outline:none; border-color:seagreen; width: 150px;" value="<?php echo htmlspecialchars($_SESSION['credit_card'][$user]['security_code']); ?>" class="input is-normal" name="security_code" required pattern="^[0-9]{3}$" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('3桁の数字を入力してください。')">
    </td>
</tr>

  </table>
</div>


        <!-- 代引きの場合のフォームなどを追加 -->
        <div v-if="acitivePriceTab" class="field">
          <!-- 代引きのフォームを追加 -->
        </div>
      </div>
    </div>

    <!-- 警告メッセージのテーブル -->
    <div class="columns is-mobile is-centered">
      <table class="table"id="myTable">
        <tr>
          <td class="warning">
            <p>*お支払い回数は一括払いのみになります。</p><br>
            <p>*お届け先はMyPageで登録された住所になります。</p><br>
            <p>*代引きの場合は手数料770円発生します。</p>
         
          </td>
        </tr>
      </table>
    </div>

    <!-- ボタンのセクション -->
    <?php   
      if(isset($_POST['count'])){
    $count = $_POST['count'];
    echo '<input type="hidden" name="count" value="'.$count.'">';  
}
?>
      
      <section class="foot">
                        <input type="button" value="戻る" class="register" onclick="location.href='cart-show.php'">
                    <button class="register" type="submit">決済</button>
      </section>
      </form>
  
  </div>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="js/buymethods.js"></script>
</body>

</html>
