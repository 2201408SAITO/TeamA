<?php session_start(); ?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($_POST['mail'] == $_SESSION['users']['mail'] && $_POST['password'] == $_SESSION['users']['password']){
            header("Location: credit_card.php");
            exit();
        }
    }
?>
<?php require 'header.php'; ?>
<?php require 'menu_noswip.php'; ?>
<?php require 'db-connect.php'; ?>

<style>
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.bodylogin{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

header{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    padding: 5px 20px;
    background: #e3e6f3;
    box-shadow: 0 5px 15px rgba(0,0,0,0.06);
    align-items: center;
}

.wrapper{
    position: relative;
    width: 400px;
    height: 400px;
    display: flex;
    border-radius: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.06);
    background: #e3e6f3;
}

.wrapper .box{
    width: 100%;
    padding: 40px;
}

.box h2{
    font-size: 2em;
    text-align: center;
    color: #162938;
}

.input-box{
    position: relative;
    width: 100%;
    height: 50px;
    border-bottom: 2px solid black;
    margin: 30px 0;
}

.input-box label{
    position: absolute;
    top: 50%;
    left: 5px;
    transform: translateY(-50%);
    font-size: 1em;
    font-weight: 500;
    pointer-events: none;
    transition: .5s;
}

.input-box input:focus~label,
.input-box input:valid~label{
    top: -5px;   
}


.input-box input{
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    font-weight: 600;
}

.btn{
    width: 100%;
    height: 45px;
    background: #175222;
    border: none;
    outline: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1em;
    color: #fff;
    font-weight: 500;
    margin-top: 20px;
}
</style>


<div class="bodylogin">
    <div class="wrapper">
        <div class="box login">
            <h2>本人確認</h2>
    <form method="POST" action="user_virify.php">
        <div class="input-box">
            <input type="email" name="mail" required>
            <label>メールアドレス</label>
        </div>
        <div class="input-box">
            <input type="password" name="password" required>
            <label>Password</label>
            <div id="error-msg" class="error" style="text-align:center; color:red; margin: 15px;" ></div>
        </div>
        <button input type="submit" class="btn" value="認証">Login</button>
     </form>
<?php
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $mail = $_POST["mail"];
                $pass = $_POST["password"];
                $stmt = $pdo->prepare("SELECT * FROM users WHERE mail = ?");
                $stmt->execute([$mail]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row) {
                    $upass = $row["password"];
                    $umail = $row["mail"];
                    if($upass != $pass || $umail != $mail){ 
                        // パスワードが一致しない場合のエラーメッセージ
                        echo '<div id =error>';
                        echo '<script>document.getElementById("error-msg").innerHTML = "認証に失敗しました。";</script>';
                        echo '</div>';
                    }
                }
            }

?>


        </div>
    </div>
</div>
<?php require 'footer.php'; ?>