<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>
    <link rel="stylesheet" href="css/List.css">
</head>
<body>

    <header>
        <img src="img/logo.png" class="logo" alt="" width="100" height="65">
        <nav class="logout">
            <a href="ManageLogin.html">ログアウト</a>
        </nav>
    </header>
    <main class="wrapper">
        <section class="head">
            <h1>商品一覧</h1>
        </section>
        <section class="body">
            <?php
            require 'db-connect.php';
            $pdo = new PDO($connect, USER, PASS);
            $delete = "return confirm('削除しますか？')";
            echo '<table><thead><tr><th width="8%">商品ID</th><th  width="18%">商品名</th><th  width="10%">カテゴリ</th><th  width="6%">単価</th><th  width="6%">在庫</th><th width="20%">商品画像</th><th width="20%">商品説明</th><th  width="10%">動作</th></tr></thead>';
                echo '<tbody>';
                foreach ($pdo->query('SELECT goods. * , category_name FROM goods INNER JOIN categories ON goods.category_id = categories.category_id') as $row) {
                    echo '<tr>';
                        echo '<td class="center"  style="word-break: break-word">'.$row['goods_id'].'</td>';
                        echo '<td style="word-break: break-word">'.$row['goods_name'].'</td>';
                        echo '<td style="word-break: break-word">'.$row['category_name'].'</td>';
                        echo '<td style="word-break: break-word"><strong>'.$row['price'].'</strong></td>';
                        echo '<td class="center" style="word-break: break-word">'.$row['count'].'</td>';
                        echo '<td style="word-break: break-word"><img src="img/switch.jpg" class="logo" alt="" width="65" height="65"></td>';
                        echo '<td style="word-break: break-word">'.$row['exp'].'</td>';
                        echo '<td class="center">';
                            echo '<form action="ManageUpdate.html" method="post">';
                                echo '<input type="hidden" name="id" value="'.$row['goods_id'].'">';
                                echo '<button class="up" type ="submit">更新</button>';
                            echo '</form>';
                            echo '<form action="ManageDeleteFinish.html" method="post">';
                                echo '<input type="hidden" name="id" value="'.$row['goods_id'].'">';
                                echo '<button onclick="'.$delete.'" class="del" type ="submit">削除</button>';
                            echo '</form>';
                    echo '</td></tr>';
                }
                echo '</tbody>';
            echo '</table>';
            ?>
        </section>
        <section class="foot">
            <form action="ManageRegister.html" method="post">
                <button class="register" type="submit">登録</button>
            </form>
        </section>
    </main>
</body>
</html>