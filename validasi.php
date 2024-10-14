<?php
    ob_start();
    session_start();
    ob_end_clean();
    $username=$_POST["username"];
    $password=$_POST["password"];
    if(($username=="admin" AND $password=="admin") OR ($username=="Rivan" AND $password=="ghibran"))
{
    $_SESSION["username"]=$username;
    header("location:loginsukses.php");
}else{
    header("location:index.php?login_gagal");
}
?>