<?php session_start(); ?>
<?php require 'header.php';?>
<?php require 'menu.php';?>
<?php require 'db-connect.php';?>


<link rel="stylesheet" href="css/logincomp.css">

<?php
unset($_SESSION['users']);
$pdo = new PDO($connect, USER, PASS);
$sql=$pdo->prepare('select * from users where mail=?');
$sql->execute([$_POST['mail']]);

foreach($sql as $row){
    if($_POST['password'] == $row['password']){
    $_SESSION['users']=[
        'id' =>$row['user_id'],
        'name'=>$row['user_name'],
        'address'=>$row['address'],
        'mail'=>$row['mail'],
        'password'=>$row['password']];
    }
}
if(isset($_SESSION['users'])){
    echo '<div class ="aaa">';
    echo '<div class ="wrapper">';
    echo '<div class ="out">';
    echo '<form method="POST" action="index.php">';
    echo 'ようこそ', $_SESSION['users']['name'], 'さん';
    echo '<button type="submit" class="btn">ホーム</button>';
    echo '</form>';
}else {
    echo '<div class ="aaa">';
    echo '<div class ="wrapper">';
    echo '<div class ="out">';
    echo '<form method="POST" action="login-input.php">';
    echo 'ログイン名またはパスワードが違います。';
    echo '<button type="submit" class="btn">戻る</button>';
    echo '</form>';

}
?>

<?php require 'footer.php'; ?>