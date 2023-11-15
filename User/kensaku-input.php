<?php require 'menu.php'; ?>
<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<form action="kensaku-input.php" method="post">
    <table>
        <?php
        if(isset($_POST['category']) && !empty($_POST['category'])) {
            // カテゴリーが選択された場合
            $sql = $pdo->prepare('select goods_name, price, goods_id from goods where category_id = ? and goods_name like ?');
            $sql->execute([$_POST['category'], '%' . $_POST['keyword'] . '%']);
        } elseif(isset($_POST['keyword'])) {
            // カテゴリーが選択されていないがキーワードがある場合
            $sql = $pdo->prepare('select goods_name, price, goods_id from goods where goods_name like ?');
            $sql->execute(['%'.$_POST['keyword'].'%']);
        } else {
            // カテゴリーもキーワードもない場合
            $sql = $pdo->query('select goods_name, price, goods_id from goods');
        }

        foreach ($sql as $row) {
            $id = $row['goods_id'];
            echo '<tr>';
            echo '<td>';
            echo '<p><a href="kensaku-output.php?id=', $id, '"><img alt="image" src="image/', $row['goods_id'], '.jpg" width="100" height="100"></a></p>';
            echo '<p><a href="kensaku-output.php?id=', $id, '">'.$row['goods_name'].' ￥'.$row['price'].'</a></p>';
            echo '</td>';
            echo '</tr>';
            echo '<input type="hidden" name="id" value="' . $row['goods_id'] . '" />';
        }
        ?>
    </table>
</form>
</body>
</html>
