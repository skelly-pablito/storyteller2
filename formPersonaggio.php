<?php
    session_start();
    if(!isset($_SESSION["login"]))
        header("Location: index.php");

    include "connect.php";
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
        <div class="w3-container w3-light-green" >
            <h2 class="w3-left"><a class="w3-button" href="homepage.php">Storyteller</a></h2>
            <div class="w3-right w3-flex" style="align-items: center; gap: 5px;"> 
                <a href="personaggi.php"> <button class="w3-button w3-border w3-green">Personaggi</button></a>
                <a href="logout.php" class="w3-button"> <img width="25px" height="25px" src="box-arrow-right.svg"> </a>
            </div>
        </div> 

        <div class="w3-container w3-display-middle"> 
            <h1> Crea un nuovo personaggio </h1> 
            <div class="w3-card w3-padding w3-light-green w3-animate-bottom" style="width:400px;">
                
                <h3> Inserisci i dettagli del personaggio: </h3>
                <form class="w3-container" action="creaPersonaggio.php" method="post">
                    <label>Nome del personaggio:</label> <input class="w3-input" type="text" name="nome" required> <br>
                    <label>Livello:</label> <input class="w3-input" type="number" name="livello" min="1" max="20" required> <br>
                    <label>Classe:</label> <input class="w3-input" type="text" name="classe" required> <br>
                    <label>Razza:</label> <input class="w3-input" type="text" name="razza" required> <br>
                    <label>Statistiche:</label>
                    <div class="w3-flex w3-margin" style="height:40px; GAP:2px;">
                       <div> <label> FOR </label><input class="w3-input w3-margin-left w3-margin-right" type="number" name="for" min="1" max="20" required></div>
                        <div> <label> DES </label><input class="w3-input w3-margin-left w3-margin-right" type="number" name="des" min="1" max="20" required></div>
                        <div> <label> COS </label><input class="w3-input w3-margin-left w3-margin-right" type="number" name="cos" min="1" max="20" required></div>
                        <div> <label> INT </label><input class="w3-input w3-margin-left w3-margin-right" type="number" name="int" min="1" max="20" required></div>
                        <div> <label> SAG </label><input class="w3-input w3-margin-left w3-margin-right" type="number" name="sag" min="1" max="20" required></div>
                        <div> <label> CAR </label><input class="w3-input w3-margin-left w3-margin-right" type="number" name="car" min="1" max="20" required></div>
                    </div>
                    <button class="w3-button w3-border w3-margin w3-green" type="submit"> Crea </button>
                </form>
            </div>
        </div>

        <div class="w3-container w3-display-bottomleft w3-light-green">
            <h6>Un progetto di Paolo Colombo</h6>
        </div>
    </body>
</html> 