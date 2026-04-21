<?php
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: loginForm.php");
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "connect.php"; 
        
        $titolo = $_POST["titolo"]; 
        $descrizione = $_POST["desc"]; 
        $user = $_SESSION["user"]["username"]; 

        $sql = "INSERT INTO avventure (titolo, descrizione, id_master) VALUES (?,?,?)"; 
        $stmt = mysqli_prepare($conn, $sql); 
        mysqli_stmt_bind_param($stmt, "sss", $titolo, $descrizione, $user); 

        mysqli_stmt_execute($stmt); 
        if(mysqli_error($conn)){

        }else{
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
            <h2 class="w3-left">Storyteller</h2>
            <div class="w3-right"> 
                <a href="logout.php" class="w3-button"> <img width="25px" height="25px" src="box-arrow-right.svg"> </a>

            </div>
        </div>
        
        <div class="w3-container w3-padding-48 w3-display-middle w3-light-green" style="width:1000px"> 
            <h1>Campagna creata!</h1>
            <p>Per tornare alla homepage, <a href="homepage.php">clicca qui.</a></p>
        </div>

        <div class="w3-container w3-display-bottomleft w3-light-green">
            <h6>Un progetto di Paolo Colombo</h6>
        </div>
    </body>
</html> 


<?php
        }
    }
?> 