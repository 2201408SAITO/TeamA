<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db-connect.php';?>

<?php

$pdo = new PDO($connect, USER, PASS);
if(isset($_POST['keyword'])){

$sql=$pdo->prepare('select * from goods where goods_name like ?');
$sql->execute(['%'.$_POST['keyword'].'%']);

}else{
    $sql=$pdo->query('select * from goods');
}
foreach($sql as $row){
    $id=$row['goods_id'];
    echo '<tr>';
    echo '<td>',$id,'</td>';
    echo '<td>';
    echo '<a href="detail.php?id=',$id,'">',$row['goods_name'],'</a>';
    echo '</td>';
    echo '<td>',$row['price'],'</td>';
    echo '</tr>';
}
?>
<?php require 'footer.php'; ?>