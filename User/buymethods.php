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
          <p>クレジットカード番号 <input type="text"></p><br>
          <p>クレジットカード有効期限<input type="text">月<input type="text">年</p><br>
          <p>セキュリティコード <input type="text"></p><br>
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
   
      <form action="buycomp.php" method="POST">
      <section class="foot">
                        <input type="button" value="戻る" class="register" onclick="location.href='cart.php'">
                    <button class="register" type="submit">決済</button>
      </section>
      </form>
  
  </div>

  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="js/buymethods.js"></script>
</body>

</html>
