<?php
    session_start();
    if(!isset($_SESSION["login"]))
        header("Location: loginForm.php");
    include "connect.php"; 

    $sql = "SELECT * FROM avventure WHERE id=".$_GET["id"].";";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
        $riga = $res->fetch_assoc();
        if($riga["id_master"] != $_SESSION["user"]["username"]){
            header("Location: homepage.php");
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

        <div class="w3-container w3-margin-top w3-margin-left"> 
            <h1><?php echo $riga["titolo"]; ?></h1>
        </div>

        <div class="w3-container w3-display-bottomleft w3-light-green">
            <h6>Un progetto di Paolo Colombo</h6>
        </div>
    </body>
</html>     