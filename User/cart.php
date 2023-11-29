<?php require 'db-connect.php'?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cart.css">
<title>cart</title>

</head>
<body>
<div class="wrapper">
<section class="head">
                <h2>カートインされた商品</h2>
            </section>
<?php

$user_id = $_SESSION['users']['id'];
$total = 0; //カートの合計金額

if (!empty($_SESSION['user_cart'][$user_id])) {
    echo '<section class="body">';
    echo '<table>';
    echo '<tr><th>商品画像</th><th></th><th>商品名</th><th></th>';
    echo '<th>個数</th><th></th><th>価格</th><th></th><th></th></tr>';
    


    foreach ($_SESSION['user_cart'][$user_id] as $id => $product) {

        $sql=$pdo->prepare('select count from goods where goods_id =?');
        $sql->execute([$id]);
        $row = $sql->fetch(PDO::FETCH_BOTH);
        $zaiko = $row['count'];
        
        if($zaiko >= $product['count']){
            $name = $product['name'];
            $path1 = "../manager/img/{$product['catename']}/{$name}/";
            $images = glob($path1 . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
            $firstImage = $images[0];
     
            echo '<tr>';
            
            echo '<td><a href="detail.php?id=', $id, '"><img alt="image"class="UpdatedImages" src="' . $firstImage . '"width="100" height="100"></a></td>';
            echo '<td></td>';
            echo '<td><a href="detail.php?id=', $id, '">', $product['name'], '</a></td>';
            echo '<td></td>';
            $subtotal = $product['price'] * $product['count'];
            $total += $subtotal;
        
            
           
            echo '<td>';
            echo $product['count'];
            echo '</td>';
            echo '<td></td>';
            echo '<td>', $product['price'], '</td>';
            echo '<td></td>';
            echo '<td><a href="cart-delete.php?id=', $id, '">削除</a></td>';
            echo '</tr>';
        }
    } 
if($total!=0){
    echo '<form action="buymethods.php" method="POST">'; 
    
    echo '<input type="hidden" name="action" value="update_cart">';
    echo '<input type="hidden" name="count" value="' . $total . '">';
}
    
  

    echo '</table>';
    echo '</section>';
} else {
    echo 'カートに商品がありません。';
}
echo '<input type="submit" value="会計" class="register">';
echo '<div class="sum">合計金額</div>';
echo '<div class="total">'.$total.'</div>';
echo '</form>';
?>
</div>


<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="./js/cart.js"></script>
</body>
</html>