<?php
require_once("config.php");
if(isset($_POST['sub-login']))
{
    $login = $_POST['login_var'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE (username = '$login' OR email = '$login');";
    $res = mysqli_query($conn, $query);
    $numRows = mysqli_num_rows($res);
    if($numRows == 1)
    {
        $row = mysqli_fetch_assoc($res);
        if($password == $row["password"]){
            $_SESSION["login_sess"]="1";
            $_SESSION["login_email"] = $row["email"];
            $_SESSION["user_id"] = $row["id"];
            header("location: dashboard.php");
        }
        else{
            header("location:login.php?loginerror=".$login);
        }
    }
    else{
        header("location:login.php?loginerror=".$login);
    }
}



?>
