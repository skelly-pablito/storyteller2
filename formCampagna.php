
<?php
    session_start();

    if(!isset($_SESSION["login"])){
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
            textarea {
                resize: none;
            }
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            // AGGIUNGI VALIDA FORM 

            function addPlayer(){
                const input = document.getElementById("playerInput");
                const player = input.value.trim();
                if(player !== ""){
                    $.post("controllaPlayer.php", {username: player}, function(data, status){
                        if(data == "200"){
                            const playerList = document.getElementById("players");
                            const dispPlayers = document.getElementById("dispPlayers");
                            playerList.value += player + ",";
                            input.value = "";
                            dispPlayers.innerHTML += "<li>" + player + "</li>";
                        } else {
                            alert("Il giocatore " + player + " non esiste.");           
                        }
                    }); 
                }
            }
        </script>
    </head> 
    <body>
        <div class="w3-container w3-light-green">
            <h2 class="w3-left">Storyteller</h2>
            <div class="w3-right"> 
                <a href="logout.php" class="w3-button"> <img width="25px" height="25px" src="box-arrow-right.svg"> </a>

            </div>
        </div>

        <div class="w3-container w3-display-middle"> 
            <h1> Crea una nuova campagna </h1> 
            <div class="w3-card w3-padding w3-light-green w3-animate-bottom" style="width:400px;">
                
                <h3> Inserisci i dettagli della campagna: </h3>
                <form class="w3-container" action="creaCampagna.php" method="post">
                    <label>Titolo della campagna:</label> <input class="w3-input" type="text" name="titolo" required> <br>
                    <label>Descrizione:</label> <textarea class="w3-input" maxlength="255" rows="5" name="desc"></textarea> <br>
                    <label class="">Invita giocatore: </label>
                    <div class="w3-flex" style="height:40px">
                        <input class="w3-input" type="text" id="playerInput"> 
                        <button class="w3-button w3-border w3-green" type="button" onclick="addPlayer()">Aggiungi</button>
                    </div>
                    <ul id="dispPlayers">

                    </ul>
                    <input type="hidden" name="players" id="players">
                    <button class="w3-button w3-border w3-margin w3-green" type="submit"> Crea </button>
                </form>
            </div>
        </div>

        <div class="w3-container w3-display-bottomleft w3-light-green">
            <h6>Un progetto di Paolo Colombo</h6>
        </div>
    </body>
</html> 