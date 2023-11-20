<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>購入履歴一覧</title>
    <link rel="stylesheet" href="css/buylist.css">
</head>
<body>

    <header>
        <?php require 'header.php'; ?>
        <?php require 'menu.php'; ?>
    </header>
    <main class="wrapper">
        <section class="head">
            <h1>購入履歴一覧</h1>
        </section>
        <section class="body">
            <?php
            require 'db-connect.php';
            $pdo = new PDO($connect, USER, PASS);
            echo '<table><thead><tr><th>購入ID</th><th>購入日付</th><th>購入合計額</th><th></th></tr></thead>';
            echo '<tbody>';
            $userID = 1; // ユーザーIDの指定
            $sql = $pdo->prepare('
            SELECT 
                c.user_id AS ユーザーid,
                p.buy_id AS 購入ID,
                p.total AS 購入合計額,
                p.buy_date AS 購入日
            FROM 
                buy_detail pd
            JOIN 
                buy p ON pd.buy_id = p.buy_id
            JOIN 
                goods g ON pd.goods_id = g.goods_id
            JOIN 
                users c ON p.user_id = c.user_id
            WHERE 
                c.user_id = :userID
            GROUP BY 
                p.buy_id, p.buy_date
        ');
            $sql->bindParam(':userID', $userID, PDO::PARAM_INT);
            $sql->execute();
            foreach ($sql as $row) {
                echo '<tr>';
                echo '<td class="center" style="word-break: break-word">', $row['購入ID'], '</td>';
                echo '<td style="word-break: break-word">', $row['購入日'], '</td>';
                echo '<td style="word-break: break-word"><strong>', $row['購入合計額'], '</strong></td>';
                echo '<td class="center">';
                echo '<form action="buydetail.php" method="post">';  // ManageUpdate.php から buydetail.php に変更
                echo '<input type="hidden" name="buy_id" value="'.$row['購入ID'].'">'; // 商品ID から 購入ID に変更
                echo '<button class="up" type ="submit">詳細</button>';
                echo '</form>';
                echo '</td></tr>';
            }
            echo '</tbody>';
            echo '</table>';
            ?>
        </section>
        <section class="foot">
            <form action="Maypage.php" method="post">
                <button class="register" type="submit">戻る</button>
            </form>
        </section>
    </main>
    <?php require 'footer.php'; ?>
</body>
</html>
