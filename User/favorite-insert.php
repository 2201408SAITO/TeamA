<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db-connect.php'; ?>
<?php
if(isset($_SESSION['customer'])){
    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->prepare('insert into favorite values(?,?)');
try{
    $sql=$pdo->prepare('insert into favorite values(?,?)');
    $sql->execute([$_SESSION['customer']['id'],$_GET['id']]);
    echo 'お気に入りに商品を追加しました。';
    
}catch(Exception $e){
    echo 'すでにお気に入りに追加されています。';
}
    echo '<hr>';
    require 'favorite.php';
}else{
    echo 'お気に入りに商品を追加するには、ログインしてください。';
}
?>
<?php require 'footer.php'; ?>