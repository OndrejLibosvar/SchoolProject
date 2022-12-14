<?php
session_start();
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Rezervační systém</title>
    <link rel="stylesheet" href="main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        body{ font: 14px sans-serif; text-align: center; color:white }
    </style>
    
</head>
<body>
    <p class="title">
        Ahoj, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Vítej v našem rezervačním systému.
    </p>
    <!--<p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>-->
    <div class="crt-res">
        <a href="crt-res.php"><button type="button" class="btn-one">Vytvořit rezervaci</button></a>
        <a href="res-view.php"><button type="button" class="btn-one">Prohlédnout si rezervace</button></a>
        <a href="logout.php"><button type="button" class="btn-3">Odhlásit se</button></a>
    </div>
</body>
</html>