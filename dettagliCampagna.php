<?php
    function isAllowed($user){
        global $conn; 
        $sql = "SELECT * FROM avventure WHERE id = ? AND id_master = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "is", $_GET["id"], $user);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($res) > 0){
            return true;
        }else{
             $sql = "SELECT * FROM giocatoreavventura WHERE id_avventura = ? AND user = ? AND accepted = 1";
             $stmt = mysqli_prepare($conn, $sql);
             mysqli_stmt_bind_param($stmt, "is", $_GET["id"], $user);
             mysqli_stmt_execute($stmt);
             $res = mysqli_stmt_get_result($stmt);
             if(mysqli_num_rows($res) > 0){
                return true;
             }
        }
        return false;
    }

    function getPlayers(){
        global $conn; 
        $sql = "CREATE VIEW IF NOT EXISTS avventure_player AS 
                SELECT *
                FROM avventure AS a INNER JOIN giocatoreavventura AS ga 
                ON a.id = ga.id_avventura;"; 
        mysqli_query($conn, $sql);
        
        $user = $_SESSION["user"]["username"];
        $sql = "SELECT user FROM avventure_player WHERE id = ? AND accepted = 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $_GET["id"]);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($res) > 0){
            
            while($riga = $res->fetch_assoc()){
                echo "<li>".$riga["user"]."</li>";
            }
        }
    }

    function showPersonaggi($user){
        global $conn; 
        $sql = "SELECT p.id, p.nome, p.livello FROM personaggi AS p WHERE p.id_utente = ? AND NOT EXISTS
                (SELECT * FROM personaggiavventura AS pa WHERE p.id = pa.id_personaggio AND pa.id_avventura = ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "si", $user, $_GET["id"]);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($res) > 0){
            while($riga = $res->fetch_assoc()){
                 echo "<div class='w3-card w3-padding w3-margin w3-green' style='width:400px;align:center;'>
                            <p> <span class='title'><a href='aggiungiPg.php?id=" . $riga["id"] . "&id_campagna=" . $_GET["id"] . "'>". $riga["nome"] . "</a></span>
                            Livello: " . $riga["livello"] . "</p> 
                        </div>";
            }
        }else{
            echo "<p>Non hai personaggi disponibili</p>";
        }
    }

    function showPersonaggiCampagna(){
        global $conn; 
        $sql = "SELECT id, nome, livello FROM personaggi AS p INNER JOIN personaggiavventura AS pa ON p.id = pa.id_personaggio WHERE pa.id_avventura = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $_GET["id"]);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($res) > 0){
            while($riga = $res->fetch_assoc()){
                 echo "<div class='w3-card w3-padding w3-margin w3-green' style='width:400px;align:center;'>
                            <p> <span class='title'><a href='dettagliPersonaggio.php?id=" . $riga["id"] . "'>". $riga["nome"] . "</a></span>
                            Livello: " . $riga["livello"] . "</p> 
                        </div>";
            }
        }else{
            echo "<p>Nessun personaggio presente</p>";
        }
    }

    session_start();
    if(!isset($_SESSION["login"]))
        header("Location: loginForm.php");
    include "connect.php"; 

     if(!isAllowed($_SESSION["user"]["username"])){
        header("Location: homepage.php");
    }else{
        $sql = "SELECT * FROM avventure WHERE id=".$_GET["id"].";";
        $res = mysqli_query($conn, $sql);
        $riga = $res->fetch_assoc();
    }   
?>
<!DOCTYPE html>
<html>
    <head>
        <!--Sfondo da https://tiled-bg.blogspot.com/2013/03/green-stone-seamless-web-texture.html -->
        <meta charset="utf-8">
        <title>Storyteller</title>
        <link rel="stylesheet" href="w3.css">
        <link rel="stylesheet" href="homestyles.css">
        <style>
            body, h1, h2, h3, h4, h5, h6 {
                 font-family: Georgia, serif;
            }
            body {
                background-image: url("green-stone-seamless-web-texture.jpg");
                background-repeat: repeat;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
        function charDropdown() {
            var x = document.getElementById("charoptions");
            if (x.className.indexOf("w3-show") == -1) { 
                x.className += " w3-show";
            } else {
              x.className = x.className.replace(" w3-show", "");
             }
        }

        function addPlayer(){
                const input = document.getElementById("playerInput");
                const player = input.value.trim();
                const id_campagna = <?php echo $_GET["id"]; ?>;
                if(player !== ""){
                    $.post("controllaPlayer.php", {username: player, campagna: id_campagna}, function(data, status){
                        if(data == "200"){
                            const playerList = document.getElementById("players");
                            const dispPlayers = document.getElementById("dispPlayers");
                            playerList.value += player + ",";
                            input.value = "";
                            dispPlayers.innerHTML += "<li>" + player + "</li>";
                        } else if(data == "404"){ 
                            alert("Il giocatore " + player + " non esiste.");           
                        } else if(data == "400"){
                            alert("Il giocatore " + player + " è già associato alla campagna.");
                        } else {
                            alert("Si è verificato un errore. Riprova.");
                        }   
                    }); 
                }
            }
        </script>
    </head> 
    <body>
        <div class="w3-container w3-light-green" >
            <h2 class="w3-left"><a class="w3-button" href="homepage.php">Storyteller</a></h2>
            <div class="w3-right"> 
                <a href="logout.php" class="w3-button"> <img width="25px" height="25px" src="box-arrow-right.svg"> </a>

            </div>
        </div> 

        <div class="w3-flex w3-margin-top w3-margin-left" style="height:100%;justify-content:center;align-items:center;">
            <!-- SEZIONE 1-->
            <div class="w3-card w3-light-green  w3-padding" style="width:50%"> 
                <h1><?php echo $riga["titolo"]; ?></h1>
                <p><?php echo $riga["descrizione"]; ?> </p>

                <div class="w3-container">
                    <p class="title">Giocatori: <?php
                        if($_GET["accType"] == 1){
                            ?> <button onclick="document.getElementById('id02').style.display='block'" class="w3-button"><b>+</b></button> </h1> <?php
                        }
                        
                    ?></p>
                    <ul>
                        <?php getPlayers(); ?>
                    </ul>

                </div>
            </div>

            <div class="w3-card w3-light-green  w3-padding" style="width:30%;margin-left:20px;"> 
                <h1>Personaggi
                    <?php
                        if($_GET["accType"] == 2){?>
                            <div class="w3-dropdown-click"> 
                                <button onclick="charDropdown()" class="w3-button w3-right"><b>+</b></button> </h1> 
                                <div id="charoptions" class="w3-dropdown-content w3-bar-block"> 
                                    <a href="formPersonaggio.php" class="w3-bar-item w3-button">Crea Personaggio</a>
                                    <a class="w3-bar-item w3-button" onclick="document.getElementById('id01').style.display='block'">Scegli esistente</a>
                            </div>
                            <hr>
                           
                        <?php showPersonaggiCampagna();
                        }else {?>
                            </h1><hr> <?php
                            showPersonaggiCampagna();
                   } ?>
            </div>
        </div>

        <!-- Modal per scegliere personaggio esistente -->
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content w3-light-green" style="width:25%;height:50%;"> 
                <button class="w3-button w3-display-topright" onclick="document.getElementById('id01').style.display='none'; charDropdown()">x</button>
                <div class="w3-container " >
                    <h2>Scegli un personaggio</h2>
                        <hr> 
                    <div class="w3-middle">
                    <?php
                        showPersonaggi($_SESSION["user"]["username"]); 
                    ?> 
                    </div>
                </div>
            </div>  
        </div>

        <!--Modal Invito giocatore-->
        <div id="id02" class="w3-modal">
            <div class="w3-modal-content w3-light-green" style="width:25%;height:50%;"> 
                <button class="w3-button w3-display-topright" onclick="document.getElementById('id02').style.display='none'">x</button>
                <div class="w3-container " >
                    <h2>Invita giocatori</h2>
                        <hr> 
                    <div class="w3-middle">
                         <form class="w3-container" action="invitaPlayer.php" method="post">
                            <div class="w3-flex" style="height:40px">
                                <input class="w3-input" type="text" id="playerInput"> 
                                <button class="w3-button w3-border w3-green" type="button" onclick="addPlayer()">Aggiungi</button>
                            </div>
                            <ul id="dispPlayers">

                            </ul>
                            <input type="hidden" name="players" id="players">
                            <input type="hidden" name="id_campagna" value="<?php echo $_GET["id"];?>">
                            <button class="w3-button w3-border w3-margin w3-green" type="submit">Invita</button>
                        </form>
                    </div>
                </div>
            </div>  
        </div>



        <div class="w3-container w3-display-bottomleft w3-light-green">
            <h6>Un progetto di Paolo Colombo</h6>
        </div>
    </body>
</html>     