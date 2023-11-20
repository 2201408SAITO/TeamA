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
        if(isset($_POST['category']) && !empty($_POST['category'])) {
            // カテゴリーが選択された場合
            $sql = $pdo->prepare('select goods_name, price, goods_id,category_id from goods where category_id = ? and goods_name like ? limit 0,18');
            $sql->execute([$_POST['category'], '%' . $_POST['keyword'] . '%']);
        } elseif(isset($_POST['keyword'])) {
            // カテゴリーが選択されていないがキーワードがある場合
            $sql = $pdo->prepare('select goods_name, price, goods_id,category_id from goods where goods_name like ? limit 0,18');
            $sql->execute(['%'.$_POST['keyword'].'%']);
        } else {
            // カテゴリーもキーワードもない場合
            $sql = $pdo->query('select category_id,goods_name, price, goods_id from goods limit 0,18');
        }
        echo '<br><br><br><br><br>';
        
        $count=0;
        $count_swip=1;
        foreach ($sql as $row) {

            if($count == 0){
            echo '<div class="tile is-ancestor">';
            }

            $count += 1;

            if($count == 4){
                $count_swip +=1;
                if($count_swip == 4){
                    echo '<div class="swiper mySwiper">';
                    echo '<div class="swiper-wrapper">';
                    echo '<div class="swiper-slide"><img src="img/book.png" alt=""></div>';
                    echo '<div class="swiper-slide"><img src="img/cloth.png" alt=""></div>';
                    echo '<div class="swiper-slide"><img src="img/cons_elec.png" alt=""></div>';
                    echo '<div class="swiper-slide"><img src="img/furniture.png" alt=""></div>';
                    echo '<div class="swiper-slide"><img src="img/game.png" alt=""></div>';
                    echo '<div class="swiper-slide"><img src="img/pc.png" alt=""></div>';
                    echo '<div class="swiper-slide"><img src="img/shoes.png" alt=""></div>';
                    echo '<div class="swiper-slide"><img src="img/smartphone.png" alt=""></div>';
                    echo '<div class="swiper-slide"><img src="img/toy.png" alt="" ></div>';
                    echo '</div>';
                    echo '<div class="swiper-button-next"></div>';
                    echo '<div class="swiper-button-prev"></div>';
                echo '</div>';
                echo '<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>';
                echo '<script src="js/swip.js"></script>';
                }
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
            <nav class="pagination is-rounded" role="navigation" aria-label="pagination">
                <a class="pagination-previous">前ページへ</a>
                <a class="pagination-next">次ページへ</a>
                <ul class="pagination-list">
                    <li>
                    <a class="pagination-link" aria-label="1ページ目へ">1</a>
                    </li>
                    <li>
                    <span class="pagination-ellipsis">…</span>
                    </li>
                    <li>
                    <a class="pagination-link" aria-label="12ページ目へ">12</a>
                    </li>
                    <li>
                    <a class="pagination-link is-current" aria-label="13ページ" aria-current="page">13</a>
                    </li>
                    <li>
                    <a class="pagination-link" aria-label="14ページ目へ">14</a>
                    </li>
                    <li>
                    <span class="pagination-ellipsis">…</span>
                    </li>
                    <li>
                    <a class="pagination-link" aria-label="25ページ目へ">25</a>
                    </li>
                </ul>
        </nav>
</form>
<?php require 'footer.php'; ?>  