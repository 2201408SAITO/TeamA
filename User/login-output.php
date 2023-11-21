<?php session_start(); ?>
<?php require 'header.php';?>
<?php require 'menu.php';?>
<?php require 'db-connect.php';?>

<?php
unset($_SESSION['users']);
$pdo = new PDO($connect, USER, PASS);
$sql=$pdo->prepare('select * from users where mail=?');
$sql->execute([$_POST['mail']]);

foreach($sql as $row){
    if($_POST['password'] == $row['password']){
    $_SESSION['users']=[
        'name'=>$row['user_name'],
        'address'=>$row['address'],'mail'=>$row['mail'],
        'password'=>$row['password']];
    }
}
if(isset($_SESSION['users'])){
    echo '<div class="title is-4"><div class="has-text-weight-bold is-italic is-underlined has-text-right">ユーザー:',$_SESSION['users']['name'],'</div></div>';
}else {
    echo 'ログイン名またはパスワードが違います。';
}
?>

<?php require 'footer.php'; ?>