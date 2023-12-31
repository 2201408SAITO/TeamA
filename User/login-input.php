<?php require 'header.php'; ?>
<?php require 'menu_noswip.php'; ?>
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
            <h2>Login</h2>
            <form method="POST" action="login-output.php">
                <div class="input-box">
                    <input type="text" name='mail'maxlength="50" required>
                    <label>メールアドレス</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" maxlength="20" required>
                    <label>Password</label>
                </div>
                <div class="error-message" id="error-msg"></div>
                <button input type="submit" class="btn" value="ログイン">Login</button>
            </form>
            <div class="has-text-centered pt-3"><a href="user-register.php">ユーザー作成の方はこちらから</a></div>
        </div>
    </div>
</div>
<?php require 'footer.php'; ?>