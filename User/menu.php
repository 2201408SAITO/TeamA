<?php require 'header.php'; ?>
<form action="product.php" method="post" class="has-background-grey-lighter">
<nav class="level">
<img src="img/logo.png" class="logo" alt="" width="100" height="85">
    <div class="level-item">
    <div class="select is-normal">
    <select name="category">
    <option>カテゴリー</option>
    <option>家電</option>
    <option>家具</option>
    <option>服</option>
    <option>本</option>
    <option>靴</option>
    <option>スマートフォン</option>
    <option>PC</option>
    <option>ゲーム</option>
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
    <div class="level-item"><a href="product.php" ><i class="fas fa-home fa-3x" style="color:dimgray;"></i></a></div>
    <div class="level-item"><a href="cart-show.php" ><i class="fas fa-shopping-cart fa-3x" style="color:dimgray"></i></a></div>
    <div class="level-item"><a href="login-input.php" ><i class="far fa-user-circle fa-3x" style="color:dimgray"></i></a></div>
    </div>
</nav>
<hr>
</form>