<?php 
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location: index.php");
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
            textarea {
                resize: none;
            }
        </style>
    </head> 
    <body>
        <div class="w3-container w3-light-green">
            <h2 class="w3-left"><a class="w3-button" href="homepage.php">Storyteller</a></h2>
            <div class="w3-right w3-flex" style="align-items: center; gap: 5px;"> 
                <a href="personaggi.php"> <button class="w3-button w3-border w3-green">Personaggi</button></a>
                <a href="logout.php" class="w3-button"> <img width="25px" height="25px" src="box-arrow-right.svg"> </a>
            </div>
        </div>

        <div class="w3-container w3-display-middle"> 
            <h1> Crea una nuova partita </h1> 
            <div class="w3-card w3-padding w3-light-green w3-animate-bottom" style="width:400px;">
                
                <h3> Inserisci i dettagli della partita: </h3>
                <form class="w3-container" action="creaPartita.php" method="post">
                    <label>Titolo della partita:</label> <input class="w3-input" type="text" name="titolo" required> <br>
                    <label>Descrizione:</label> <textarea class="w3-input" maxlength="255" rows="5" name="desc"></textarea> <br>
                    <label>Data della partita:</label> <input class="w3-input" type="date" name="data" required> <br>
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <button class="w3-button w3-border w3-margin w3-green" type="submit"> Crea </button>
                </form>
            </div>
        </div>

        <div class="w3-container w3-display-bottomleft w3-light-green">
            <h6>Un progetto di Paolo Colombo</h6>
        </div>
    </body>
</html> 