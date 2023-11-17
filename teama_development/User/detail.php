<?php require 'header.php'; ?>
<?php require 'menu_noswip.php'; ?>
<?php require 'db-connect.php'; ?>

<?php
// カテゴリーIDと対応するカテゴリー名のマッピング
$categoryMapping = [
    1 => '家具',
    2 => 'ゲーム機',
    3 => '家電',
    4 => '靴',
    5 => 'おもちゃ',
    6 => 'スマートフォン',
    7 => '服',
    8 => '本',
];

// カテゴリーが選択されているかどうかを確認
if(isset($_GET['id'])) {
    $sql = $pdo->prepare('select * from goods where goods_id=?');
    $sql->execute([$_GET['id']]);

    foreach ($sql as $row) {
        $category_id = $row['category_id'];
        $category = $categoryMapping[$category_id];
        $name = $row['goods_name'];
        $path1 = "../manager/img/{$category}/{$name}/";
        $images = glob($path1 . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

        // 商品のすべての画像を表示
        foreach ($images as $image) {
            $fileName = basename($image);
            echo '<img src="' . $image . '" alt="' . $fileName . '" width="400" height="400">';
        }

        echo '<form action="cart-insert.php" method="post">';
        echo '<p>カテゴリー:', $category, '</p>';
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
} else {
    echo '商品IDが指定されていません。';
}
?>

<?php require 'footer.php'; ?>
