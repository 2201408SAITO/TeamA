<!DOCTYPE html>
<html lang="ja">
	<head>
    <meta http-equiv="Cache-Control" content="no-cache">
		<meta charset="UTF-8">
		<title>商品登録画面</title>
        <link rel="stylesheet" href="css/Register.css">
        <script src="./script/Register.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
        <header>
            <img src="img/logo.png" class="logo" alt="" width="100" height="65">
            <nav class="logout">
                <a href="ManageLogin.php">ログアウト</a>
            </nav>
        </header>
        <div class="wrapper">
            <section class="head">
                <h2>商品登録</h2>
            </section>
            <form action = "ManageRegisterFinish.php" method = "post" enctype="multipart/form-data">
                <section class="body">
                    <div class="image">
                        <label>画像：</label>
                        <span id="imagePreviews" width=""></span>
                        <input type="button" id="loadFileXml" value="画像" class="imageButton" onclick="document.getElementById('fileInput').click();" />
                        <input type="file" style="display:none;" name="files[]" id="fileInput" required="required" multiple="multiple" onchange="previewImages()">
                    </div>
                    <div>
                        <label>個数：</label>
                        <input class="input-box-number" type="text" style="padding: 5px;" placeholder="個数" required="required" name="piece" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g,'$1');"/>個
                    </div>
                        
                    <div>
                    <label>カテゴリ：</label>
                        <select name="category" class="input-box-option" style="padding: 5px;" required="required">
                          <option value="">選んでください</option>
                          <option value="1">家具</option>
                          <option value="2">ゲーム機</option>
                          <option value="3">家電</option>
                          <option value="4">靴</option>
                          <option value="5">おもちゃ</option>
                        </select>
                    </div>
                    <div>
                        <label>商品名：</label>
                        <input name="name" class="input-box" type="text" style="padding: 5px;" placeholder="商品名を入力してください" required="required">
                    </div>
                    <div>
                        <label>販売単価：</label>
                        <input type="text" class="input-box-number" style="padding: 5px;" placeholder="単価" required="required" name="price" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g,'$1');"/>円
                    </div>
                    <div class="explain">
                        <label>商品説明：</label>
                        <br>
                        <textarea name="explain" class="input-box-explain" style="padding: 5px;" placeholder="商品説明を入力してください" required="required" cols="100" rows="5" name="explain" maxlength="200"></textarea>
                    </div>
                </section>
                <section class="foot">
                    <button class="register" onclick="location.href='ManageList.php'" type="submit">戻る</button>
                    <button class="register" type="submit">登録</button>
                </section>
            </form>
        </div>
    </body>
</html>