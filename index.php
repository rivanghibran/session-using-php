<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    </head>
<body>
<br>
<br>
<br>
<h2>TUGAS 2 PEMROGRAMAN WEB</h2>
<p>5230411322 | RIVAN GHIBRAN BAHARUDIN SULISTYA</p>
<div align="center" class="container">
    <?php 
if(isset($_GET["login_gagal"])){
    ?>
    <div class="notifikasi">login gagal! <br> Username atau Password salah</div>
<?php
}
?>
    <div class="login-input">
        <form method="post" action="validasi.php">
            <div class="inputlogin">
                <div> <input type="text" class="element-input" name="username" 
placeholder="Username" required> </b>
            </div>
            
            <div class="inputlogin">
                <div> <input type="password" class="element-input" 
name="password" placeholder="Password" required> </div>
            </div>
            <div class="inputlogin">
                <br>
                <div align="center"> <button type="submit" name="login" 
class="button-login">Login</button> </div>
            </div>
        </form>
    </div>
        <br>
</div>
</body>
</html>