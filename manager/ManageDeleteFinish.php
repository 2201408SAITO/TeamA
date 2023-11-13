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
            $pdo=new PDO($connect, USER, PASS);
            $sql=$pdo->prepare("delete from goods where goods_id=?");
            $sql->execute([$_POST['delid']]);
            echo '<p style="color:red;">商品削除が完了しました。</p>';
            $category=$_POST['delcategory'];
            $id=$_POST['delname'];
            $path1="./img/{$category}/{$id}";
            $imageDirectory = 'img/' . $category . '/'.$id.'/';
            $images = glob($imageDirectory . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
            if(file_exists($path1)){
                foreach ($images as $image) {
                   unlink($image);
                }
                rmdir($path1);
            }

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