<?php session_start(); ?>
<?php require 'header.php'; ?>
<div class="abc">
<form action="index.php" method="post" class="has-background-success-light">
<nav class="level">
<a href="index.php" ><img src="img/logo.png" class="logo" alt="" width="100" height="85"></a>
    <div class="level-item">
    <div class="select is-normal">
    <select name="category" style="border-radius: 25px; outline:none; border-color:seagreen; margin-right:5px;">
    <option value="">カテゴリー</option>
        <option value="1">家具</option>
        <option value="2">ゲーム</option>
        <option value="3">家電</option>
        <option value="4">靴</option>
        <option value="5">おもちゃ</option>
        <option value="6">スマートフォン</option>
        <option value="7">服</option>
        <option value="8">本</option>
   
    </select>
    </div>
    <div class="control">
    <input type="text" name="keyword" class="input is-normal" style="border-radius: 25px; outline:none; border-color:seagreen; width:500px; padding: 0 50px 0 10px;" length="" type="text" placeholder="Search">
    </div>
    <button class="button">
        <span class="icon is-small">
        <i class="fas fa-search"></i>
        </span>
    </button>
    </div>
    <div class="level-right">
    <div class="level-item"><a href="index.php" ><i class="fas fa-home fa-3x" style="color:seagreen;"></i></a></div>
    <div class="level-item"><a href="cart-show.php" ><i class="fas fa-shopping-cart fa-3x" style="color:seagreen"></i></a></div>
    <?php
    if(!empty($_SESSION['users'])){
        echo '<div class="level-item"><a href="mypage.php" ><i class="far fa-user-circle fa-3x" style="color:seagreen"></i></a></div>';
    }else{
        echo '<div class="level-item"><a href="login-input.php" ><i class="far fa-user-circle fa-3x" style="color:"></i></a></div>';
    }
    ?>
    </div>
</nav>
</form>
</div>

<style>
  .control{

  }
  
    .button{
      display: flex;
      right:40px;
      border-color:seagreen;
    }
    .logo{
      margin-left:20px ;
    }

    .level-right{
      margin-right:20px;
    }
    .abc{
      position: fixed;
      top:0;
      z-index: 999;
      width:100%;
    }
 
</style>
