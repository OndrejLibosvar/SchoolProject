<?php
$link = mysqli_connect("localhost", "root", "", "project");
$pokoj = $datum = $email = "";
$pokoj_err = $datum_err = $email_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["pokoj"]))){
        $pokoj_err = "Zadejte číslo pokoje";     
    } else{
        $pokoj = trim($_POST["pokoj"]);
    }
    if(empty(trim($_POST["datum"]))){
        $datum_err = "Zadejte datum";     
    } else{
        $datum = trim($_POST["datum"]);
    }
    if(empty(trim($_POST["email"]))){
        $email_err = "Zadejte email";     
    } else{
        $email = trim($_POST["email"]);
    }
    if(empty($pokoj_err) && empty($datum_err) && empty($email_err)){
        $sql = "INSERT INTO project.rezervace (pokoj, datum, email) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
           mysqli_stmt_bind_param($stmt, "sss", $param_pokoj, $param_datum, $param_email);
            
            $param_pokoj = $pokoj;
            $param_datum = $datum;
            $param_email = $email;
            
            if(mysqli_stmt_execute($stmt)){
                header("location: res-view.php");
            } else{
                echo "Něco je špatně, zkuste to prosím později.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vytvořit rezervaci</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div class="page">
        <div class="login">
            <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="label">
                    <label>Pokoj</label>
                </div>
                <div class="form-row <?php echo (!empty($pokoj_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="pokoj" class="form-control" value="<?php echo $pokoj; ?>">
                    <span class="err"><?php echo $pokoj_err;?></span>
                </div>
                <div class="label">
                    <label>Datum</label>
                </div>
                <div class="form-row <?php echo (!empty($datum_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="datum" class="form-control" value="<?php echo $datum; ?>">
                    <span class="err"><?php echo $datum_err;?></span>
                </div>
                <div class="label">
                    <label>E-mail</label><br>
                </div>
                <div class="form-row <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                    <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                    <span class="err"><?php echo $email_err;?></span>
                </div>
                <button type="submit" class="btn-one">Uložit</button>
                <a href="welcome.php"><button type="button" class="btn-3">
                        Zpět</button></a>
            </form>
        </div>
    </div>
</body>

</html>
