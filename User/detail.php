<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta http-equiv="Cache-Control" content="no-cache">
        <meta charset="UTF-8">   
        <title>商品更新画面</title>
        <link rel="stylesheet" href="css/detail.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
    </head>

    <body>
    <?php require 'header.php'; ?>
<?php require 'menu_noswip.php'; ?>
        <div class="wrapper">
       
            <section class="head">
                <h2>商品詳細</h2>
            </section>
            <?php
                 require 'db-connect.php';
               
                $l = "location.href='index.php'";
                
                
       
                $sql=$pdo->prepare('select goods. * , category_name from goods inner join categories on goods.category_id = categories.category_id where goods_id=?');
                $sql->execute([$_GET['id']]);
                foreach($sql as $row){
                    echo '<form action = "cart-insert.php" method = "post" enctype="multipart/form-data class="formbox"">';
                    echo     '<input type="hidden" name="id" value="'.$row['goods_id'].'">';
                    echo     '<input type="hidden" name="OldCategory" value="'.$row['category_id'].'">';
                    echo     '<input type="hidden" name="OldName" value="'.$row['goods_name'].'">';
                    echo     '<section class="body">';
                    echo         '<div class="image">';
                    echo             '<label>画像：</label>';
                    $category=$row['category_name'];
                    $id=$row['goods_name'];
                    $imageDirectory = '../manager/img/' . $category . '/'.$id.'/';
                    $images = glob($imageDirectory . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                    if (!empty($images)) {
                        foreach ($images as $image) {
                            $fileName = basename($image);
                            echo '<a href="' . $image . '" data-lightbox="group"><img src="' . $image . '" class="UpdatedImages" style="cursor: zoom-in;" alt="' . $fileName . '" width="65" height="65"></a>';

                        }
                    }else{
                        echo 'No images';
                    }
       
                    echo         '</div>';
                 
                    echo         '<div>';
                    echo         '<label>カテゴリ：</label>'.$row['category_name'];
                    echo         '</div>';
                    echo         '<div>';
                    echo             '<label>商品名：</label>'.$row['goods_name'];
                    echo         '</div>';
                    echo         '<div>';
                    echo             '<label>販売単価：</label>'.$row['price'].'円';
                    echo         '</div>';
                    echo         '<div class="explain">';
                    echo             '<label>商品説明：</label>'.$row['exp'];
                    echo         '</div>';
                    echo         '<br>';
                    echo '<div>';
                    echo '<label>個数：</label>';
                    echo '<select class="input-box-number" style="padding: 5px;" required="required" name="count">';
                    for ($i = 1; $i <= 20; $i++) {
                       
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                    echo '</select>個';
                    echo '</div>';
                    echo     '</section>';
                    echo     '<section class="foot">';
                    echo '<input type="hidden" name="id" value="', $row['goods_id'], '">';
                    echo '<input type="hidden" name="name" value="', $row['goods_name'], '">';
                    echo '<input type="hidden" name="cate" value="', $row['category_name'], '">';
                    echo '<input type="hidden" name="price" value="', $row['price'], '">';
                    echo         '<input type="button" value="戻る" class="register" onclick="'.$l.'">';
                    echo         '<button class="register" type="submit">カートイン</button>';
                    echo     '</section>';
                    echo '</form>';
                }
            ?>
        </div>
     
    </body>
</html>
 