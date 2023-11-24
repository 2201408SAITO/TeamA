<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>4-test</title>

</head>
<body>
<div id="app">
<?php
$user_id = $_SESSION['users']['id'];

if (!empty($_SESSION['user_cart'][$user_id])) {
    echo '<table>';
    echo '<tr><th>商品番号</th><th>商品名</th>';
    echo '<th>個数</th><th>価格</th><th></th></tr>';
    $total = 0;
    echo '<form action="buymethods.php" method="POST">'; // Move the form outside the loop

    foreach ($_SESSION['user_cart'][$user_id] as $id => $product) {
        $name = $product['name'];
        $path1 = "../manager/img/{$product['catename']}/{$name}/";
        $images = glob($path1 . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
        $firstImage = $images[0];
     
        echo '<tr>';
        echo '<td><a href="detail.php?id=', $id, '"><img alt="image" src="' . $firstImage . '"width="65" height="65"></a></td>';
     
        echo '<td><a href="detail.php?id=', $id, '">', $product['name'], '</a></td>';
        $subtotal = $product['price'] * $product['count'];
        $total += $subtotal;
    
        
        // Add the dropdown menu for quantity
        echo '<td>';
        echo $product['count'];
        echo '</td>';
        echo '<td>', $product['price'], '</td>';
        echo '<td><a href="cart-delete.php?id=', $id, '">削除</a></td>';
        echo '</tr>';
    }

    echo '<tr><td><input type="submit" value="会計" class="register"></td><td></td><td>合計</td><td></td><td>', $total, '</td><td></td></tr>';
    echo '<input type="hidden" name="action" value="update_cart">';
    echo '<input type="hidden" name="count" value="' . $total . '">';
    echo '</form>';

    echo '</table>';
} else {
    echo 'カートに商品がありません。';
}
?>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="./js/cart.js"></script>
</body>
</html>