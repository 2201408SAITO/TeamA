<?php require 'db-connect.php'?>
<?php require 'menu_noswip.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css"> 
    <title>ユーザー登録</title>
    <style>
        .error-message {
            color: red;
            text-align:center;

        }
        .aaa{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>
<body>
<div class="aaa">
    <div class="wrapper">
        <div class="box login">
            <h2>ユーザー情報</h2>
            <form method="POST" action="#">
                <div class="input-box">
                    <input type="text" name="name" maxlength="30" required>
                    <label>名前</label>
                </div>
                <div class="input-box">
                    <input type="text" name="postcode" maxlength="7" 
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                    <label>郵便番号</label>
                </div>
                <div class="input-box">
                    <input type="text" name="address" maxlength="100" required>
                    <label>住所</label>
                </div>
                <div class="input-box">
                    <input type="text" name="phonenNumber" maxlength="12" 
                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                    <label>電話番号</label>
                </div>
                <div class="input-box">
                    <input type="text" name="mail" maxlength="50" required>
                    <label>メールアドレス</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" maxlength="20" required>
                    <label>パスワード</label>
                </div>
                <div class="error-message" id="error-msg"></div>
                <button type="submit" class="btn">登録</button>
            </form>
        </div>
    </div>
    </div>
</body>
</html>


