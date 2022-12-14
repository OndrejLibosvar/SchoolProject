<?php
require_once "config.php";

$pokoj = $datum = $email = "";
$pokoj_err = $datum_err = $email_err = "";
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    $input_pokoj = trim($_POST["pokoj"]);
    if(empty($input_pokoj)){
        $pokoj_err = "Zadejte číslo pokoje";
    } else{
        $pokoj = $input_pokoj;
    }
    $input_datum = trim($_POST["datum"]);
    if(empty($input_datum)){
        $datum_err = "Zadejte číslo pokoje";
    } else{
        $datum = $input_datum;
    }
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Zadejte číslo pokoje";
    } else{
        $email = $input_email;
    }
    
    if(empty($pokoj_err) && empty($datum_err) && empty($email_err)){
        $sql = "UPDATE rezervace SET pokoj=?, datum=?, email=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "sssi", $param_pokoj, $param_datum, $param_email, $param_id);
            
            $param_pokoj = $pokoj;
            $param_datum = $datum;
            $param_email = $email;
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                header("location: welcome.php");
                exit();
            } else{
                echo "Zkuste to prosím později";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
} else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id =  trim($_GET["id"]);
        
        $sql = "SELECT * FROM rezevace WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;

            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) == 0){
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $pokoj = $row["pokoj"];
                    $datum = $row["datum"];
                    $email = $row["email"];
                } else{
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Zkuste to prosím později";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($link);
    }  else{
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
        <title>Závěrečný projekt 2</title>
        <link rel="stylesheet" href="main.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Antonio:wght@300&family=Raleway:wght@400;700&display=swap" rel="stylesheet">
        <link href="data:image/x-icon;base64,AAABAAEAEBACAAAAAACwAAAAFgAAACgAAAAQAAAAIAAAAAEAAQAAAAAAQAAAAAAAAAAAAAAAAgAAAAAAAAAAAAAAAKoAAAGAAAAH4AAAH/AAABmYAAAZmAAAAZgAAAGYAAAH8AAAD+AAABmAAAAZgAAAGZgAABmYAAAP+AAAB+AAAAGAAAD+fwAA+B8AAOAPAADmZwAA5mcAAP5nAAD+ZwAA+A8AAPAfAADmfwAA5n8AAOZnAADmZwAA8AcAAPgfAAD+fwAA" rel="icon" type="image/x-icon" />
    </head>
    <body>
            <div class="page">
                <div class="edit">
                    <form class="form" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-left">
                        <label>Jméno</label>
                        </div>
                        <div class="form-row <?php echo (!empty($pokoj_err)) ? 'has-error' : ''; ?>">
                            <input type="text" name="pokoj" class="form-item" value="<?php echo $pokoj; ?>">
                            <span class="err"><?php echo $pokoj_err;?></span>
                        </div>
                        <div class="form-left">
                            <label>Příjmení</label>
                        </div>
                        <div class="form-row <?php echo (!empty($datum_err)) ? 'has-error' : ''; ?>">
                            <input type="text" name="datum" class="form-item" value="<?php echo $datum; ?>">
                            <span class="err"><?php echo $datum_err;?></span>
                        </div>
                        <div class="form-left">
                            <label>Ulice</label><br>
                        </div>
                        <div class="form-row <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <input type="text" name="email" class="form-item" value="<?php echo $email; ?>">
                            <span class="err"><?php echo $email_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <div class="buttons">
                            <input type="submit" class="submit" value="Uložit">
                            <a href="welcome.php" class="back_cust">Zpět</a>
                        </div>
                    </form>
                </div>
            </div>
    </body>
</html>