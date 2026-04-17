<?php 
    include "connect.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $usr = $_POST["usr"];
        $email = $_POST["mail"]; 
        $pwd = $_POST["pwd"]; 

        $pwd = password_hash($pwd, PASSWORD_DEFAULT); 
        $sql = "INSERT INTO Utenti(username, email, password) VALUES(?, ?, ?);";
        $stmt = mysqli_prepare($conn, $sql);
        
        mysqli_stmt_bind_param($stmt, "sss", $usr, $email, $pwd);
        mysqli_execute($stmt); 

        if(mysqli_error($conn)){
            die("Errore!!!\n" + mysqli_error($conn));
        }
    }else{
        header("Location: loginForm.php");
    }
?>

<!DOCTYPE html>
<html>
    <head> 
        <!--Sfondo da https://tiled-bg.blogspot.com/2013/03/green-stone-seamless-web-texture.html -->
        <meta charset="utf-8">
        <title>Storyteller</title>
        <link rel="stylesheet" href="w3.css">
        <style>
            body, h1, h2, h3, h4, h5, h6 {
                 font-family: Georgia, serif;
            }
            body {
                background-image: url("green-stone-seamless-web-texture.jpg");
                background-repeat: repeat;
            }
        </style>
    </head> 
    <body>
        <div class="w3-container w3-light-green">
            <h2>Storyteller</h3>
        </div>

        <div class="w3-container w3-padding-48 w3-display-middle w3-light-green" style="width:1000px"> 
            <h1>Registrazione completata!</h1>
            <p>Per tornare alla pagina di accesso, <a href="loginForm.php">clicca qui.</a></p>
        </div>

        <div class="w3-container w3-display-bottomleft w3-light-green">
            <h6>Un progetto di Paolo Colombo</h6>
        </div>
    </body>
</html> 