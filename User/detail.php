<?php require 'header.php'; ?>
<?php require 'menu_noswip.php'; ?>
<?php require 'db-connect.php';?>
<?php
// カテゴリーIDと対応するカテゴリー名のマッピング
$categoryMapping = [
    1 => 'テレビ',
    2 => 'ゲーム',
    3 => '家電',
    4 => '靴',
    5 => 'おもちゃ',
    6 => 'スマートフォン',
    7 => '服',
    8 => '靴',
    9 => '本',
    10 => '家具',
];

$sql=$pdo->prepare('select * from goods where goods_id=?');
$sql->execute([$_GET['id']]);
foreach ($sql as $row) {
    echo '<p><img alt="image" src="image/', $row['goods_id'], '.jpg" width="400" height="400"></p>';
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
    echo '<p><input type="submit" value="カートイン"></p>';
    echo '</form>';
}
?>
<?php require 'footer.php'; ?>