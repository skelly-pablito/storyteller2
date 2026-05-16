<?php
    function isAllowed($user){
        global $conn; 
        $sql = "SELECT id, id_utente FROM personaggi WHERE id = ? AND id_utente = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "is", $_GET["id"], $user);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($res) > 0){
            return true;
        }else{
                $sql = "CREATE VIEW IF NOT EXISTS avventure_player AS 
                    SELECT *
                    FROM avventure AS a INNER JOIN giocatoreavventura AS ga 
                     ON a.id = ga.id_avventura;"; 
                mysqli_query($conn, $sql);

                $sql = "SELECT v.id_master, v.user FROM avventure_player AS v INNER JOIN PersonaggiAvventura as pa WHERE pa.id_personaggio=?;";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "i", $_GET["id"]);
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($res) > 0){
                    while($riga = mysqli_fetch_assoc($res)){
                        if($riga["id_master"] == $user || $riga["user"] == $user)
                            return true;
                    }
                    return false; 
                } else {
                    return false;
                }
        }
    }

    session_start();
    if(!isset($_SESSION["login"]))
        header("Location: index.php");
    include "connect.php";
    if(!isAllowed($_SESSION["user"]["username"])){
        header("Location: homepage.php");
    }else{
       $sql = "SELECT * FROM personaggi WHERE id=".$_GET["id"].";";
       $res=mysqli_query($conn, $sql);
       $riga = mysqli_fetch_assoc($res);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <!--Sfondo da https://tiled-bg.blogspot.com/2013/03/green-stone-seamless-web-texture.html -->
        <meta charset="utf-8">
        <title>Storyteller</title>
        <link rel="stylesheet" href="w3.css">
        <link rel="stylesheet" href="charStyle.css">
        <style> 
            body, h1, h2, h3, h4, h5, h6 {
                 font-family: Georgia, serif;
            }
            body {
                background-image: url("green-stone-seamless-web-texture.jpg");
                background-repeat: repeat;
            }
            table, tr, td, th{
                 font-size: 20px;
            }
            td{
                text-align: center;
                padding: 25px; 
                border-top : 1px solid black;
            }
            th{
                 padding: 5px;
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

        <div class="w3-flex w3-margin-top w3-margin-left" style="height:100%;justify-content:center;align-items:center;">
            <!-- SEZIONE 1-->
            <div class="w3-card w3-light-green w3-padding" style="width:50%;height:750px;"> 
                <div class="w3-flex w3-margin-top" style="justify-content:space-around;">
                    <p class="big"><?php echo $riga["nome"]; ?></p>
                </div>
                

                <div class="w3-flex w3-margin-top" style="justify-content:space-around;">
                   <p class="medium"><b>Livello: </b><?php echo $riga["livello"]; ?> </p> 
                   <p class="medium"><b>Classe: </b><?php echo $riga["classe"]; ?> </p>
                    <p class="medium"><b>Razza: </b><?php echo $riga["razza"]; ?> </p> 
                </div>
             
                <div class="w3-flex w3-margin-top" style="justify-content:space-around;">
                <table>
                    <tr>
                        <th>Forza</th>
                        <th>Destrezza</th>
                        <th>Costituzione</th>
                        <th>Intelligenza</th>
                        <th>Saggezza</th>
                        <th>Carisma</th>
                    </tr>
                    <tr>
                        <td><?php echo $riga["FORZA"]; ?></td>
                        <td><?php echo $riga["DESTREZZA"]; ?></td>
                        <td><?php echo $riga["COSTITUZIONE"]; ?></td>
                        <td><?php echo $riga["INTELLIGENZA"]; ?></td>
                        <td><?php echo $riga["SAGGEZZA"]; ?></td>
                        <td><?php echo $riga["CARISMA"]; ?></td>
                    </tr>
                </table>
                </div>  
            </div>

            
        </div>

        <div class="w3-container w3-display-bottomleft w3-light-green">
            <h6>Un progetto di Paolo Colombo</h6>
        </div>
    </body>
</html>     
