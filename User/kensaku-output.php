<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php require 'db-connect.php'; ?>
<?php
// カテゴリーIDと対応するカテゴリー名のマッピング
$categoryMapping = [
    1 => 'テレビ',
    2 => 'ゲーム',
    3 => '家電',
    4 => '靴',
    5 => 'おもちゃ',
];

$sql=$pdo->prepare('select * from goods where goods_id=?');
$sql->execute([$_GET['id']]);
foreach ($sql as $row) {
    echo '<p><img alt="image" src="image/', $row['goods_id'], '.jpg" width="100" height="100"></p>';
    echo '<form action="cart-insert.php" method="post">';
    echo '<p>カテゴリー:', $categoryMapping[$row['category_id']], '</p>';
    echo '<p>商品名:', $row['goods_name'], '</p>';
    echo '<p>販売価格:￥', $row['price'], '</p>';
    echo '<p>商品説明:', $row['exp'], '</p>';
    echo '<p>数量:<select name="count">';
    for ($i=1; $i<=10; $i++) {
        echo '<option value="', $i, '">', $i, '</option>';
    }
    echo '</select></p>';
    echo '<input type="hidden" name="id" value="', $row['goods_id'], '">';
    echo '<input type="hidden" name="name" value="', $row['goods_name'], '">';
    echo '<input type="hidden" name="price" value="', $row['price'], '">';
    echo '<p><input type="submit" value="カートに追加"></p>';
    echo '</form>';
}
?>
</body>
</html>
