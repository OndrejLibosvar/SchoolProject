<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "project");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt select query execution
$sql = "SELECT * FROM rezervace";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<link rel='stylesheet' type='text/css' href='main.css'>";
        echo "<title>Vytvořené rezervace</title>";
        echo "<body style='background-image:none'>";
            echo "<div class='page'>";
                echo "<div>";
                    echo "<a href='login.php'>";
                    echo "<button type='button'class='btn-4'>";
                    echo "Zpět";
                    echo "</button>";
                    echo "</a>";                
                echo "</div>";
                echo "<table class='tab'>";
                    echo "<tr class='row'>";
                        echo "<th class='head'>id</th>";
                        echo "<th class='head'>Pokoj</th>";
                        echo "<th class='head'>Datum</th>";
                        echo "<th class='head'>E-mail</th>";
                        echo "<th class='head'>Smazat</th>";
                        echo "<th class='head'>Edit</th>";

                    echo "</tr>";
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                        echo "<td class='item'>" . $row['id'] . "</td>";
                        echo "<td class='item'>" . $row['pokoj'] . "</td>";
                        echo "<td class='item'>" . $row['datum'] . "</td>";
                        echo "<td class='item'>" . $row['email'] . "</td>";
                        echo "<td class='item-del'><a href='res-del.php?id=". $row['id'] ."' title='Delete Record' class='item-del2'>Smazat</a></td>";
                        echo "<td class='item-del'><a href='res-edit.php?id=". $row['id'] ."' title='Update Record'class='item-del2'>Editovat</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            echo "</div>";
        echo "</body>";
        // Free result set
        mysqli_free_result($result);
    } else{
            header("location: welcome.php");
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>

