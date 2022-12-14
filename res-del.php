<?php
if(isset($_POST["id"]) && !empty($_POST["id"])){
    require_once "config.php";
    
    $sql = "DELETE FROM rezervace WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_POST["id"]);
        
        if(mysqli_stmt_execute($stmt)){
            header("location: res-view.php");
            exit();
        } else{
            echo "Zkuste to prosím později";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else{
    if(empty(trim($_GET["id"]))){
        header("location: error.php");
        exit();
    }
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Smazat záznam</title>
        <link rel="stylesheet" href="main.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
    </head>
    <body style="background-image:none">
        <div class="page">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="del">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            Opravdu chcete tento záznam odstranit?
                        </div>
                        <div class="btns-res">
                            <input type="submit" value="ANO" class="btn-yes">
                            <a href="res-view.php" class="btn-no">NE</a>
                        </div>
                    </form>
            </div>
    </body>
</html>