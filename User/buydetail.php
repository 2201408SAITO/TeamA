<?php session_start();?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>購入履歴詳細一覧</title>
    <link rel="stylesheet" href="css/buydetail.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
</head>


    <?php require 'header.php'; ?>
    <?php require 'menu_noswip.php'; ?>

<main class="wrapper">
    <section class="head">
        <h1>購入詳細</h1>
    </section>    
    <section class="body">       
        <?php
        require 'db-connect.php';

        $buyId = $_POST['buy_id'];

        if (isset($_POST['buy_id'])) {
            // 購入履歴詳細SQL
            
            $detailSql = $pdo->prepare('
                SELECT 
                    g.goods_name AS 商品名,
                    g.price AS 値段,
                    pd.buy_size AS 数量,
                    c.category_name AS カテゴリー名
                FROM 
                    buy_detail pd
                JOIN 
                    buy p ON pd.buy_id = p.buy_id
                JOIN 
                    goods g ON pd.goods_id = g.goods_id
                JOIN 
                    categories c ON g.category_id = c.category_id
                WHERE 
                    pd.buy_id = :buyId
            ');

            $detailSql->bindParam(':buyId', $buyId, PDO::PARAM_INT);
            $detailSql->execute();
            $total = 0;

            echo '<table>';
            echo '<thead><tr><th>商品画像</th><th>商品名</th><th>値段</th><th>数量</th></tr></thead>';
            echo '<tbody>';
          
            foreach ($detailSql as $row) {
                $catename = $row['カテゴリー名'];
                $path1 = "../manager/img/{$catename}/{$row['商品名']}/";
                $images = glob($path1 . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

                // 最初の画像だけを取得
                $firstImage = $images[0];

                echo '<tr>';
                // 商品画像を表示するためのコード
                echo '<td>';
                echo '<a href="' . $firstImage . '" data-lightbox="group"><img src="' . $firstImage . '" alt="no image" width="100" height="100" class="UpdatedImages" style="cursor: zoom-in;"></a>';
                echo '</td>';
                echo '<td style="word-break: break-word">', $row['商品名'], '</td>';
                echo '<td style="word-break: break-word">', $row['値段'], '</td>';
                echo '<td style="word-break: break-word">', $row['数量'], '</td>';
                echo '</tr>';

                // 合計金額を計算
                $total += $row['値段'] * $row['数量'];
            }
            echo '</tbody>';
            echo '</table>';
           
        } else {
            echo '購入IDが指定されていません。';
        }
        ?>

        <?php
          $sql = $pdo->prepare('SELECT use_point FROM buy WHERE buy_id = ? AND user_id = ?');
          $sql->execute([$_POST['buy_id'] ,$_SESSION['users']['id']]);
          $row = $sql->fetch(PDO::FETCH_ASSOC);

          echo '<p style="text-align: right; font-size: 1.5em;">使用ポイント：', $row['use_point'], '</p>';
        ?>
    </section>
    <section class="foot">
        <form action="buylist.php" method="post">
            <button class="register" type="submit">戻る</button>
        </form>
        <span class="price">合計金額</span>
        <?php  echo '<span class="price-output">'.$total-=$row['use_point'].'</span>';   
        ?>
    </section>
</main>
<?php require 'footer.php'; ?>
</form>
</body>
</html>
