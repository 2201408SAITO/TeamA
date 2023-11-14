
<!DOCTYPE html>
<html lang="ja">
	<head>
    <meta http-equiv="Cache-Control" content="no-cache">
		<meta charset="UTF-8">
		<title>商品更新画面</title>
        <link rel="stylesheet" href="css/Update.css">
        <script src="./script/Update.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
        <header>
            <img src="img/logo.png" class="logo" alt="" width="100" height="65">
            <nav class="logout">
                <a href="ManageLogin.html">ログアウト</a>
            </nav>
        </header>
        <div class="wrapper" id="app">
            <section class="head">
                <h2>商品更新</h2>
            </section>
            <?php
            $pdo=new PDO($connect, USER, PASS);
                $sql=$pdo->prepare('select * from Goods where goods_id=?');
	            $sql->execute([$_POST['id']]);
            <form action = "ManageUpdateFinish.php" method = "post" enctype="multipart/form-data">
                <section class="body">
                    <div class="image">
                        <label>画像：</label>
                        <span id="imagePreviews" width=""></span>
                        <input type="button" id="loadFileXml" value="画像" class="imageButton" onclick="document.getElementById('fileInput').click();" />
                        <input type="file" style="display:none;" name="files[]" id="fileInput" multiple="multiple" onchange="previewImages()">
                    </div>
                    <div>
                        <label>個数：</label><input class="input-box-number" type="text" style="padding: 5px;" placeholder="個数" required="required" name="piece" v-model="piece"/>個
                        <p v-if="isKo" class="err">個数は数字4桁で入力してください</p>
                    </div>
                        
                    <div>
                    <label>カテゴリ：</label>
                        <select class="input-box-option" style="padding: 5px;">
                          <option value="">選んでください</option>
                          <option selected value="">ゲーム機</option>
                          <option value="">家具</option>
                        </select>
                    </div>
                    <div>
                        <label>商品名：</label><input class="input-box" type="text" style="padding: 5px;" placeholder="商品名を入力してください" value="Switch" required="required">
                    </div>
                    <div>
                        <label>販売単価：</label><input type="text" class="input-box-number" style="padding: 5px;" placeholder="単価" required="required" name="price" v-model="price"/>円
                        <p v-if="isTan" class="err">単価は数字6桁で入力してください</p>
                    </div>
                    <div class="explain">
                        <label>商品説明：</label><br><textarea class="input-box-explain" style="padding: 5px;" placeholder="商品説明を入力してください" required="required" cols="100" rows="5" name="explain" maxlength="200">新品。</textarea>
                    </div>
                </section>
                <section class="foot">
                    <button class="register" onclick="location.href='ManageList.html'" type="submit">戻る</button>
                    <button class="register" type="submit">登録</button>
                </section>
            </form>
            ?>
        </div>
        <script src="./script/UpdateErr.js"></script>
    </body>
</html>
