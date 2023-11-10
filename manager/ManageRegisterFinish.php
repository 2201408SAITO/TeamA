<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録完了画面</title>
    <link rel="stylesheet" href="css/Finish.css">
</head>
<body>

    <header>
        <img src="img/logo.png" class="logo" alt="" width="100" height="65">
        <nav class="logout">
            <a href="ManageLogin.php">ログアウト</a>
        </nav>
    </header>
    <main class="wrapper">
        <section class="body">
        <?php
                require 'db-connect.php';
                $pdo = new PDO($connect, USER, PASS);
                $sql=$pdo->prepare('insert into goods(category_id,goods_name,price,count,exp) value (?,?,?,?,?)');
                $sql->execute([$_POST['category'],$_POST['name'],$_POST['price'],$_POST['piece'],$_POST['explain']]);
                    echo '<label>追加に成功しました<label>';
                ?>
        </section>
        <section class="foot">
            <form action="ManageList.php" method="post">
                <button class="register" type="submit">商品一覧へ</button>
            </form>
        </section>
    </main>
</body>
</html>