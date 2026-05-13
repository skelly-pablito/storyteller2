<?php
    function showPersonaggi(){
        global $conn;
        $user = $_SESSION["user"]["username"];
        $sql = "SELECT * FROM personaggi WHERE id_utente = ?";
        $stmt = mysqli_prepare($conn, $sql); 
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($res) > 0){
            while($riga = $res->fetch_assoc()){
                echo "<div class='w3-card w3-padding w3-margin w3-green' style='width:400px;'>
                            <p> <span class='title'><a href='dettagliPersonaggio.php?id=" . $riga["id"] . "'>". $riga["nome"] . "</a></span>
                            Livello: " . $riga["livello"] . "</p> 
                        </div>"; 
            }
        }
                            
    }
    session_start();
    if(!isset($_SESSION["login"]))
        header("Location: loginForm.php");
    include "connect.php"; 
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
            body, h1, h2, h3, h4, h5, h6, pre{
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
                <a href="logout.php" class="w3-button"> <img width="25px" height="25px" src="box-arrow-right.svg"> </a>
            </div>
        </div>

        <div class="w3-container w3-display-middle"> 
            <div class="w3-card w3-light-green  w3-padding" style="margin-left:20px;"> 
                <h1>Personaggi
                    <a href="formPersonaggio.php"><button class="w3-button w3-right"><b>+</b></button></a>
                </h1> <hr>

                <div class="w3-card w3-padding w3-margin w3-green" style="width:400px;">
                            <p> <span class="title"><a href="dettagliPersonaggio.php?id=1">Title</a></span>Livello: 1</p> 
                </div>

                <?php showPersonaggi(); ?>
            </div>
        </div>

        <div class="w3-container w3-display-bottomleft w3-light-green">
            <h6>Un progetto di Paolo Colombo</h6>
        </div>
    </body>
</html> 