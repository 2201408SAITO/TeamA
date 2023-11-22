<?php require 'header.php'; ?>
<form action="index.php" method="post" class="has-background-grey-lighter">
<nav class="level">
<img src="img/logo.png" class="logo" alt="" width="100" height="85">
    <div class="level-item">
    <div class="select is-normal">
    <select name="category">
    <option value="">カテゴリー</option>
        <option value="1">テレビ</option>
        <option value="2">ゲーム</option>
        <option value="3">家電</option>
        <option value="4">靴</option>
        <option value="5">おもちゃ</option>
        <option value="6">スマートフォン</option>
        <option value="7">服</option>
        <option value="8">本</option>
        <option value="9">家具</option>
    </select>
    </div>
    <div class="control">
    <input type="text" name="keyword" class="input is-normal " type="text" placeholder="Search">
    </div>
    <button class="button">
        <span class="icon is-small">
        <i class="fas fa-search"></i>
        </span>
    </button>
    </div>
    <div class="level-right">
    <div class="level-item"><a href="index.php" ><i class="fas fa-home fa-3x" style="color:dimgray;"></i></a></div>
    <div class="level-item"><a href="cart-show.php" ><i class="fas fa-shopping-cart fa-3x" style="color:dimgray"></i></a></div>
    <div class="level-item"><a href="mypage.php" ><i class="far fa-user-circle fa-3x" style="color:dimgray"></i></a></div>
    </div>
</nav>
<hr>
</form>