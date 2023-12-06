<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db-connect.php'; ?>
<style>
    .designation {
        width: 400px;
        height: 240px;
    }

    .flex-item {
        flex-basis: 100%;
    }

    .image-wrap {
        position: relative;
        overflow: hidden;
        padding-top: 50%;
        margin: 10px 5px;
    }

    .image-wrap img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        object-fit: cover;
    }
</style>
<form action="index.php" method="post">
    <table>
        <?php
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

        // ページネーションのための処理
        $resultsPerPage = 18; // 1ページあたりの表示結果数
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $resultsPerPage;

        // SQL文の準備
        if (isset($_POST['category']) && !empty($_POST['category'])) {
            $category = $_POST['category'];
            $keyword = '%' . $_POST['keyword'] . '%';
            $sql = $pdo->prepare('SELECT goods_name, price, goods_id, category_id FROM goods WHERE category_id = :category AND goods_name LIKE :keyword LIMIT :offset, :resultsPerPage');
        } elseif (isset($_POST['keyword'])) {
            $keyword = '%' . $_POST['keyword'] . '%';
            $sql = $pdo->prepare('SELECT goods_name, price, goods_id, category_id FROM goods WHERE goods_name LIKE :keyword LIMIT :offset, :resultsPerPage');
        } else {
            $sql = $pdo->prepare('SELECT category_id, goods_name, price, goods_id FROM goods LIMIT :offset, :resultsPerPage');
        }

        // バインド
        $sql->bindParam(':offset', $offset, PDO::PARAM_INT);
        $sql->bindParam(':resultsPerPage', $resultsPerPage, PDO::PARAM_INT);

        if (isset($category)) {
            $sql->bindParam(':category', $category, PDO::PARAM_INT);
        }
        if (isset($keyword)) {
            $sql->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        }

        // SQL実行
        $sql->execute();

        // 検索条件がない場合の総商品数の取得
        if (($_POST['category']==0) && ($_POST['keyword']=="")) {
            $totalResults = $pdo->query('SELECT COUNT(*) FROM goods')->fetchColumn();
        } else {
            // 検索条件がある場合は、条件に応じた商品数を取得
            $totalResults = $sql->rowCount();
            
        }

        echo '<br><br><br><br><br>';

        $count = 0;
        foreach ($sql as $row) {
            if ($count == 0) {
                echo '<div class="tile is-ancestor">';
            }

            $count += 1;

            if ($count == 4) {
                $count = 1;
                echo '<div class="tile is-ancestor">';
            }

            $key = $row['category_id'];
            echo '<input type="hidden" name="category" value="' . $row['category_id'] . '">';
            $category = $categoryMapping[$key];
            $name = $row['goods_name'];
            $path1 = "../manager/img/{$category}/{$name}/";
            $images = glob($path1 . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
            $firstImage = $images[0];
            echo '<div class="tile is-parent is-vertical">';
            $id = $row['goods_id'];
            echo '<div class="designation">';
            echo '<div class="flex-item">';
            echo '<div class="image-wrap">';
            echo '<a href="detail.php?id=', $id, '"><img alt="image" src="' . $firstImage . '"></a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<div class="tile  is-child">';
            echo '<a href="detail.php?id=', $id, '">' . $row['goods_name'] . ' ￥' . $row['price'] . '</a>';
            echo '<input type="hidden" name="id" value="' . $row['goods_id'] . '" />';
            echo '</div>';
            echo '</div>';

            if ($count == 3) {
                echo '</div>';
            }
        }
        ?>
    </table>
    <br><br><br><br><br>
    <!-- ページネーションリンク -->
    <nav class="pagination is-centered" role="navigation" aria-label="pagination">
        <?php if ($currentPage > 1) : ?>
            <a href="?page=<?= $currentPage - 1 ?>" class="pagination-previous">前ページへ</a>
        <?php endif; ?>

        <?php if ($currentPage < ceil($totalResults / $resultsPerPage)) : ?>
            <a href="?page=<?= $currentPage + 1 ?>" class="pagination-next">次ページへ</a>
        <?php endif; ?>

        <ul class="pagination-list">
            <?php for ($i = 1; $i <= ceil($totalResults / $resultsPerPage); $i++) : ?>
                <?php
                if($currentPage != $i){
                ?>
                <li>
                    <a href="?page=<?= $i ?>" class="pagination-link <?= ($i === $currentPage) ? 'is-current' : '' ?>">
                        <?= $i ?>
                    </a>
                </li>
                <?php
                }
                ?>
            <?php endfor; ?>
        </ul>
    </nav>
    <br><br><br>
</form>

<br><br><br>
<?php require 'footer.php'; ?>
