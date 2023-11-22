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
<form action="buycomp.php" method="POST">
  <div id="app" class="container">
    <div class="columns is-mobile is-centered">
      <div class="column is-half">
        <h2 class="title is-1">クレジットカード情報</h2>

        <!-- 決済方法のテーブル -->
        <table class="table">
          <thead>
            <tr>
              <th>決済方法 :</th>
              <th :class="{'is-active': acitiveWordsTab }">
                <input type="radio" @click="changeTab(1)" name="paymethod" value="credit">クレジット
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
      <td><input type="text"name=""></td>
    </tr>
    <tr>
      <td>クレジットカード有効期限</td>
      <td><input type="text"name="">月 <input type="text">年</td>
    </tr>
    <tr>
      <td>セキュリティコード</td>
      <td><input type="text"name=""></td>
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
      <table class="table">
        <tr>
          <td class="warning">
            <p>*お支払い回数は一括払いのみになります。</p>
            <p>*お届け先はMyPageで登録された住所になります。</p>
            <p>*代引きの場合は手数料770円発生します。</p>
          </td>
        </tr>
      </table>
    </div>

    <!-- ボタンのセクション -->
   
      
      <section class="foot">
                        <input type="button" value="戻る" class="register" onclick="location.href='cart.php'">
                    <button class="register" type="submit">決済</button>
      </section>
   <?php   
      if(isset($_POST['count'])){
    $count = $_POST['count'];
    echo '<input type="hidden" name="count" value="'.$count.'">';
}
?>
      </form>
  
  </div>

  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="js/buymethods.js"></script>
</body>

</html>
