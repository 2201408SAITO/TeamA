<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php require 'db-connect.php';?>
<style>
    .designation{
        width: 400px;
        height: 400px; 
    }
    .flex-item {
    flex-basis: 100%;
    }

    .image-wrap{
        position: relative;
        overflow: hidden;
        padding-top: 50%;
        margin: 10px 5px;
    }

    .image-wrap img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        width: 400px;
        height: 400px;
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
        if (isset($_POST['category']) && !empty($_POST['category'])) {
            $sql = $pdo->prepare('SELECT goods_name, price, goods_id, category_id FROM goods WHERE category_id = ? AND goods_name LIKE ?');
            $sql->execute([$_POST['category'], '%' . $_POST['keyword'] . '%']);
        } elseif (isset($_POST['keyword'])) {
            $sql = $pdo->prepare('SELECT goods_name, price, goods_id, category_id FROM goods WHERE goods_name LIKE ?');
            $sql->execute(['%' . $_POST['keyword'] . '%']);
        } else {
            $sql = $pdo->query('SELECT category_id, goods_name, price, goods_id FROM goods');
        }

        $resultsPerPage = 18; // 1ページあたりの表示結果数
        $totalResults = $sql->rowCount(); // 総商品数

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $resultsPerPage;

        $sql = $pdo->prepare('SELECT goods_name, price, goods_id, category_id FROM goods LIMIT :offset, :resultsPerPage');
        $sql->bindParam(':offset', $offset, PDO::PARAM_INT);
        $sql->bindParam(':resultsPerPage', $resultsPerPage, PDO::PARAM_INT);
        $sql->execute();
        
        echo '<br><br><br><br><br>';
        
        $count=0;
        foreach ($sql as $row) {

            if($count == 0){
            echo '<div class="tile is-ancestor">';
            }

            $count += 1;

            if($count == 4){
                $count =1;
            echo '<div class="tile is-ancestor">';
            }

            $key = $row['category_id'];
            echo '<input type="hidden" name="category" value="'.$row['category_id'].'">';
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
            echo '<a href="detail.php?id=', $id, '"><img alt="image" src="'.$firstImage.'"></a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<div class="tile  is-child">';
            echo '<a href="detail.php?id=', $id, '">'.$row['goods_name'].' ￥'.$row['price'].'</a>';
            echo '<input type="hidden" name="id" value="' . $row['goods_id'] . '" />';
            echo '</div>';
            echo '</div>';

            if($count == 3){
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
                        <li>
                            <a href="?page=<?= $i ?>" class="pagination-link <?= ($i === $currentPage) ? 'is-current' : '' ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
            <br><br><br>
</form>

 <br><br><br>
 <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><a href="cart.php"><img src="img/book.png" alt=""></a></div>
      <div class="swiper-slide"><a href="cart.php"><img src="img/book.png" alt=""></a></div>
      <div class="swiper-slide"><a href="cart.php"><img src="img/book.png" alt=""></a></div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
 <!-- swip.js JS -->
 <script src="js/swip.js"></script>
 <hr>
<?php require 'footer.php'; ?>  