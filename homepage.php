<?php
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: loginForm.php");
    }
    include "connect.php"; 
    function showCampagneMaster(){
        global $conn; 
        $user = $_SESSION["user"]["username"]; 
        $sql = "SELECT id, titolo, descrizione   FROM avventure WHERE id_master=?"; 
        $stmt = mysqli_prepare($conn, $sql); 
        mysqli_stmt_bind_param($stmt, "s", $user);

        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt); 
        if(mysqli_num_rows($res) > 0){
            while($riga = $res->fetch_assoc()){
                echo "<div class='w3-card w3-padding w3-margin w3-light-green' style='width:400px;'>
                            <p class='title'><a href='dettagliCampagna.php?id=".$riga["id"]."&accType=1'>".$riga["titolo"]." </a></p>
                            <p class='w3-opacity'>".$riga["descrizione"]."</p>
                     </div>";
            }
        }else{
            echo "<p>Non hai creato nessuna campagna.</p>";
        }
    }
    function showCampagnePlayer(){
        global $conn; 
        $sql = "CREATE VIEW IF NOT EXISTS avventure_player AS 
                SELECT *
                FROM avventure AS a INNER JOIN giocatoreavventura AS ga 
                ON a.id = ga.id_avventura;"; 
        mysqli_query($conn, $sql);
        
        $user = $_SESSION["user"]["username"];
        //Fetch campagne a cui partecipa
        $sql = "SELECT * FROM avventure_player WHERE user = ? AND accepted = 1"; 
        $stmt = mysqli_prepare($conn, $sql); 
        mysqli_stmt_bind_param($stmt, "s", $user);

        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt); 
        if(mysqli_num_rows($res) > 0){
            while($riga = $res->fetch_assoc()){
                echo "<div class='w3-card w3-padding w3-margin w3-light-green' style='width:400px;'>
                            <p class='title'><a href='dettagliCampagna.php?id=".$riga["id"]."&accType=2'>".$riga["titolo"]." </a></p>
                            <p class='w3-opacity'> Master:".$riga["id_master"]."<br>".$riga["descrizione"]."</p>  
                     </div>";
            }
        }else{
            echo "<p>Non stai partecipando a nessuna campagna.</p>";
        }
    }


    function showInviti(){
        global $conn; 
        $sql = "CREATE VIEW IF NOT EXISTS avventure_player AS 
                SELECT *
                FROM avventure AS a INNER JOIN giocatoreavventura AS ga 
                ON a.id = ga.id_avventura;"; 
        mysqli_query($conn, $sql);
        
        $user = $_SESSION["user"]["username"];
        //Fetch inviti
        $sql = "SELECT * FROM avventure_player WHERE user = ? AND accepted = 0";
        $stmt = mysqli_prepare($conn, $sql); 
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt); 
        if(mysqli_num_rows($res) > 0){
            while($riga = $res->fetch_assoc()){
                echo "<div class='w3-card w3-padding w3-margin w3-light-green' style='width:400px;'>
                            <p class='title'>".$riga["titolo"]." </a></p>
                            <p class='w3-opacity'> Master:".$riga["id_master"]."<br>".$riga["descrizione"]."</p> 
                            <form action='aggiungiPlayer.php' method='post'>
                            <input type='hidden' name='id_campagna' value='".$riga["id"]."'>
                            <button class='w3-button w3-border w3-green' name='accept' value='1'>Accetta</button> 
                            <button class='w3-button w3-border w3-green' name='accept' value='0'>Rifiuta</button>
                        </form>
                     </div>";
            }
        }else{
            echo "<p>Non hai inviti in questo momento.</p>";
        }
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
    </head> 
    <body>
        <div class="w3-container w3-light-green">
            <h2 class="w3-left"><a class="w3-button" href="homepage.php">Storyteller</a></h2>
            <div class="w3-right w3-flex" style="align-items: center; gap: 5px;"> 
                <a href="personaggi.php"> <button class="w3-button w3-border w3-green">Personaggi</button></a>
                <a href="logout.php" class="w3-button"> <img width="25px" height="25px" src="box-arrow-right.svg"> </a>
            </div>
        </div>

        <div class="w3-container w3-margin-top w3-margin-left"> 
            <h1> Benvenuto, <?php echo $_SESSION["user"]["username"]; ?></h1>
        </div>

        <div class="w3-flex w3-margin-top w3-margin-left" style="height:100%;justify-content:space-around;align-items:center;">
                <div class="w3-container w3-margin-top w3-margin-left" style="width:20%"> 
                     <h3> Inviti </h3>  <hr>
                 
                     <!-- DIV ESEMPIO
                     <div class="w3-card w3-padding w3-margin w3-light-green" style="width:400px;">
                         <p class="title"><a href="">Titolo</a></p>
                         <p class="w3-opacity">Lorem ipsum dolor sit amet...</p>
                     </div>-->
                     <?php showInviti() ?>
                 </div>     
        
        
        
        <!-- SEZIONE 1-->
                <div class="w3-container w3-margin-top w3-margin-left" style="width:20%"> 
                     <h3> Le tue campagne 
                         <a href="formCampagna.php"><button class="w3-button w3-right"><b>+</b></button></a>
                     </h3>  <hr>
                 
                     <!-- DIV ESEMPIO
                     <div class="w3-card w3-padding w3-margin w3-light-green" style="width:400px;">
                         <p class="title"><a href="">Titolo</a></p>
                         <p class="w3-opacity">Lorem ipsum dolor sit amet...</p>
                     </div>-->
                     <?php showCampagneMaster() ?>
                 </div>


             <!-- SEZIONE 2 --> 
             <div class="w3-container w3-margin-top w3-margin-left" style="width:20%"> 
                  <h3> Campagne a cui partecipi </h3>  <hr>
                <!-- DIV ESEMPIO
                <div class='w3-card w3-padding w3-margin w3-light-green' style='width:400px;'>
                        <p class='title'><a href='dettagliCampagna.php?id=".$riga["id"]."'> Title </a></p>
                        <p class='w3-opacity'> Master: TEST <br> Lorem ipsum dolor sit amet... </p> 
                        <form action="aggiungiPlayer.php" method="post">
                            <input type="hidden" name="id_campagna" value="1">
                            <button class="w3-button w3-border w3-green" name="accept" value="1">Accetta</button> 
                            <button class="w3-button w3-border w3-green" name="accept" value="0">Rifiuta</button>
                        </form>
                 </div>-->
                 <?php showCampagnePlayer() ?>
             </div>
        </div>

        <div class="w3-container w3-display-bottomleft w3-light-green">
            <h6>Un progetto di Paolo Colombo</h6>
        </div>
    </body>
</html> 