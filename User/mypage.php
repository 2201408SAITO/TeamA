<?php
session_start();
require 'header.php';
require 'menu_noswip.php';
require 'db-connect.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Mypage</title>
</head>
<body>

<?php
// $_SESSION['users']がセットされているか確認
if (isset($_SESSION['users']) && is_array($_SESSION['users'])) {
    // ログインしているユーザーの情報を取得する
    $sql = $pdo->prepare('SELECT * FROM users WHERE user_id = ?');
    $sql->execute([$_SESSION['users']['id']]);
    
    // 取得したユーザー情報を表示する
    $row = $sql->fetch(PDO::FETCH_ASSOC);

    echo  $_SESSION['users']['id'], 'さんのマイページ';
    
    echo '<p>名前　　　', $row['user_name'], '</p>';
    echo '<p>郵便番号　', $row['post_code'], '</p>';
    echo '<p>住所　　　', $row['address'], '</p>';
    echo '<p>電話番号　', $row['phone_number'], '</p>';
    echo '<p>メールアドレス　', $row['mail'], '</p>';

    echo '<form action="update_user.php" method="post">';//更新のリンクに変更
    echo '<input type="hidden" name="user_id" value="', $row['user_id'], '">';
    echo '<input type="submit" value="更新">';
    echo '</form>';

    echo '<form action="delete_user.php" method="post">';//退会のリンクに変更
    echo '<input type="hidden" name="user_id" value="', $row['user_id'], '">';
    echo '<input type="submit" value="ユーザー退会">';
    echo '</form>';

    echo '<p>あなたのポイント　', $row['point'], 'Pt','</p>';
    echo '<p>クレジットカード情報　　<a href="credit_card.php">こちらから</a></p>';//クレジットカードのリンクに変更

    echo '<form action="購入履歴.php" method="post">';//購入履歴のリンクに変更
    echo '<input type="hidden" name="user_id" value="', $row['user_id'], '">';
    echo '<input type="submit" value="購入履歴">';
    echo '</form>';

} else {
    // $_SESSION['users']が未定義またはnullの場合の処理
    echo 'セッションエラー：ユーザー情報が取得できませんでした。';
}
echo '<form method="POST" action="login-input.php">';
echo '<button type="submit" class="btn">ログイン画面</button>';
echo '</form>';
echo '<form method="POST" action="logout-input.php">';
echo '<button type="submit" class="btn">ログアウト</button>';
echo '</form>';
?>

</body>
</html>
