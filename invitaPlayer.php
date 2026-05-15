<?php
    session_start();
    include "connect.php";
    if(!isset($_SESSION["login"])){
        header("Location: index.php");
    }       


    if(isset($_POST["players"]) && !empty($_POST["players"])){
        $players = explode(",", $_POST["players"]);
    } else {
        $players = array();
    }
    $id_campagna = $_POST["id_campagna"]; 
    foreach($players as $p){
     if(empty($p)) continue;
            $sql = "INSERT INTO GiocatoreAvventura (user, id_avventura, accepted) VALUES (?,?,?);"; 
            $stmt = mysqli_prepare($conn, $sql);  
            $accepted = 0; 
            mysqli_stmt_bind_param($stmt, "sii", $p, $id_campagna, $accepted); 
            mysqli_stmt_execute($stmt);
            if(mysqli_error($conn)){
                echo "Errore: ".mysqli_error($conn);
            }
    }
    echo "ok"; 
    header("Location: dettagliCampagna.php?id=".$id_campagna."&accType=1");
?> 