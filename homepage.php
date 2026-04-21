<?php
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: loginForm.php");
    }
    include "connect.php"; 
    function showCampagne(){
        global $conn; 
        $user = $_SESSION["user"]["username"]; 
        $sql = "SELECT titolo FROM avventure WHERE id_master=?"; 
        $stmt = mysqli_prepare($conn, $sql); 
        mysqli_stmt_bind_param($stmt, "s", $user);

        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt); 
        if(mysqli_num_rows($res) > 0){
            while($riga = $res->fetch_assoc()){
                echo "<p><a href=''>".$riga["titolo"]."</a></p>";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head> 
		<!--Versione: 1.1>
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
            <h1> Benvenuto, <?php echo $_SESSION["user"]["username"]; ?></h1>
        </div>

        <!-- SEZIONE 1-->
        <div class="w3-container w3-margin-top w3-margin-left" style="width:20%"> 
            <h3> Le tue campagne 
                <a href="formCampagna.php"><button class="w3-button w3-right"><b>+</b></button></a>
            </h3>  <hr>
        </div>
        <div>
            <?php showCampagne() ?>
        </div>


        <!-- SEZIONE 2 --> 
        <div class="w3-container w3-margin-top w3-margin-left" style="width:20%"> 
             <h3> Campagne a cui partecipi 
                <a><button class="w3-button w3-right"><b>+</b></button></a>
            </h3>  <hr>
        </div>

        <div class="w3-container w3-display-bottomleft w3-light-green">
            <h6>Un progetto di Paolo Colombo</h6>
        </div>
    </body>
</html> 