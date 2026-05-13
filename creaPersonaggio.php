<?php
    session_start(); 
    if(!isset($_SESSION["login"]))
        header("Location: index.php");
    include "connect.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nome = $_POST["nome"];
        $livello = $_POST["livello"];
        $classe = $_POST["classe"];
        $razza = $_POST["razza"];
        $for = $_POST["for"];
        $des = $_POST["des"];
        $cos = $_POST["cos"];
        $int = $_POST["int"];
        $sag = $_POST["sag"];
        $car = $_POST["car"];

        $user = $_SESSION["user"]["username"]; 
        $sql = "INSERT INTO personaggi (nome, livello, classe, razza, forza, destrezza, costituzione, intelligenza, saggezza, carisma, id_utente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sissiiiiiis", $nome, $livello, $classe, $razza, $for, $des, $cos, $int, $sag, $car, $user);
        mysqli_stmt_execute($stmt); 
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
            <h2 class="w3-left"><a class="w3-button" href="homepage.php">Storyteller</a></h2>
            <div class="w3-right"> 
                <a href="logout.php" class="w3-button"> <img width="25px" height="25px" src="box-arrow-right.svg"> </a>

            </div>
        </div>
        
        <div class="w3-container w3-padding-48 w3-display-middle w3-light-green" style="width:1000px"> 
            <h1>Personaggio creato!</h1>
            <p>Per tornare alla homepage, <a href="homepage.php">clicca qui.</a></p>
        </div>

        <div class="w3-container w3-display-bottomleft w3-light-green">
            <h6>Un progetto di Paolo Colombo</h6>
        </div>
    </body>
</html> 
