
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
            require 'db-connect.php';
            $pdo=new PDO($connect, USER, PASS);
                $sql=$pdo->prepare('select * from goods where goods_id=?');
	            $sql->execute([$_POST['id']]);
                $l = "ManageList.php";
                $file = "fileInput";
                foreach($sql as $row){
                    echo '<form action = "ManageUpdateFinish.php" method = "post" enctype="multipart/form-data">';
                    echo     '<section class="body">';
                    echo         '<div class="image">';
                    echo             '<label>画像：</label>';
                    echo             '<span id="imagePreviews" width=""></span>';
                    echo             '<input type="button" id="loadFileXml" value="画像" class="imageButton" onclick="document.getElementById(\'' . $file . '\').click();" />';
                    echo             '<input type="file" style="display:none;" name="files[]" id="fileInput" multiple="multiple" onchange="previewImages()">';
                    echo         '</div>';
                    echo         '<div>';
                    echo             '<label>個数：</label><input class="input-box-number" type="text" style="padding: 5px;" placeholder="個数" required="required" name="piece" value="'.$row['count'].'" v-model="piece"/>'.$row['count'].'個';
                    echo             '<p v-if="isKo" class="err">個数は数字4桁で入力してください</p>';
                    echo         '</div>'; 
                    echo         '<div>';
                    echo         '<label>カテゴリ：</label>';
                    echo             '<select class="input-box-option" style="padding: 5px;">';
                    echo               '<option value="'.$row['category'].'">'.$row['category_name'].'</option>';
                    echo               '<option value="1">家具</option>';
                    echo               '<option value="2">ゲーム機</option>';
                    echo               '<option value="3">家電</option>';
                    echo               '<option value="4">靴</option>';
                    echo               '<option value="5">おもちゃ</option>';
                    echo             '</select>';
                    echo         '</div>';
                    echo         '<div>';
                    echo             '<label>商品名：</label><input class="input-box" type="text" style="padding: 5px;" placeholder="商品名を入力してください" value="'.$row['goods_name'].'" required="required">';
                    echo         '</div>';
                    echo         '<div>';
                    echo             '<label>販売単価：</label><input type="text" class="input-box-number" style="padding: 5px;" placeholder="単価" required="required" name="price" value="'.$row['goods_price'].'" v-model="price"/>円';
                    echo             '<p v-if="isTan" class="err">単価は数字6桁で入力してください</p>';
                    echo         '</div>';
                    echo         '<div class="explain">';
                    echo             '<label>商品説明：</label><br><textarea class="input-box-explain" style="padding: 5px;" placeholder="商品説明を入力してください" required="required" cols="100" rows="5" name="explain" maxlength="200">新品。</textarea>';
                    echo         '</div>';
                    echo     '</section>';
                    echo     '<section class="foot">';
                    echo         '<button class="register" onclick="location.href=\'' . $l . '\'" type="submit">戻る</button>';
                    echo         '<button class="register" type="submit">登録</button>';
                    echo     '</section>';
                    echo '</form>';
                }
            ?>
        </div>
        <script src="./script/UpdateErr.js"></script>
    </body>
</html>
