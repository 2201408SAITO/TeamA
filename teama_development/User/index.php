<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db-connect.php';?>

<form action="index.php" method="post">
    <table>
        <?php
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

        if(isset($_POST['category']) && !empty($_POST['category'])) {
            // カテゴリーが選択された場合
            $sql = $pdo->prepare('select goods_name, price, goods_id from goods where category_id = ? and goods_name like ?');
            $sql->execute([$_POST['category'], '%' . $_POST['keyword'] . '%']);
        } elseif(isset($_POST['keyword'])) {
            // カテゴリーが選択されていないがキーワードがある場合
            $sql = $pdo->prepare('select goods_name, price, goods_id from goods where goods_name like ?');
            $sql->execute(['%'.$_POST['keyword'].'%']);
        } else {
            // カテゴリーもキーワードもない場合
            $sql = $pdo->query('select category_id,goods_name, price, goods_id from goods');
        }
        echo '<div class="tile is-ancestor">';
        foreach ($sql as $row) {
            $key = $row['category_id'];
            $category = $categoryMapping[$key];
            $name = $row['goods_name'];
            $path1 = "../manager/img/'.$category.'/'.$name.'/";
            $images = glob($path1 . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
            $firstImage = $images[0];
            echo '<div class="tile is-parent is-vertical">';
            $id = $row['goods_id'];
            echo '<a href="detail.php?id=', $id, '"><img alt="image" src="'.$firstImage.'" width="400" height="400"></a>';
            echo '<div class="tile  is-child">';
            echo '<a href="detail.php?id=', $id, '">'.$row['goods_name'].' ￥'.$row['price'].'</a>';
            echo '<input type="hidden" name="id" value="' . $row['goods_id'] . '" />';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        ?>
    </table>
</form>
<?php require 'footer.php'; ?>  