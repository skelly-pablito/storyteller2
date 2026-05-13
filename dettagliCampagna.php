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
                    <p class="title">Giocatori:</p>
                    <ul>
                        <?php getPlayers(); ?>
                    </ul>

                </div>
            </div>

            <div class="w3-card w3-light-green  w3-padding" style="width:30%;margin-left:20px;"> 
                <h1>Personaggi
                    <a href="formPersonaggio.php"><button class="w3-button w3-right"><b>+</b></button></a>
                </h1> <hr>


            </div>
        </div>

        <div class="w3-container w3-display-bottomleft w3-light-green">
            <h6>Un progetto di Paolo Colombo</h6>
        </div>
    </body>
</html>     