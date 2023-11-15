<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db-connect.php';?>
<?php
$pdo = new PDO($connect, USER, PASS);
$sql=$pdo->prepare('select * from goods where goods_id=?');
$sql->execute([$_GET['goods_id']]);
foreach($sql as $row){
    echo '<p><img alt="image" src="image/',$row['id'],'.jpg" width="400" high="400"></p>';
    echo '<form action="cart-insert.php" method="post">';
    echo '<p>商品番号:',$row['goods_id'],'</p>';
    echo '<p>商品名:',$row['goods_name'],'</p>';
    echo '<p>価格:',$row['price'],'</p>';
    echo '<p>商品詳細:',$row['exp'],'</p>';
    echo '<p>個数<select name="count">';
    for($i=1; $i <= 10; $i++){
        echo '<option value ="',$i,'">',$i,'</option>';
    }
    echo '</select></p>';
    echo '<input type="hidden" name="id" value="',$row['goods_id'],'">';
    echo '<input type="hidden" name="name" value="',$row['goods_name'],'">';
    echo '<input type="hidden" name="price" value="',$row['price'],'">';
    echo '<p><input type="submit" value="カートに追加"></p>';
    echo '</form>';
}
?>
<?php require 'footer.php'; ?>