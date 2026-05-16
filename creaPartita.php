<?php
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location: index.php");
    }
    include "connect.php"; 

    $titolo = $_POST["titolo"];
    $desc = $_POST["desc"];
    $data = $_POST["data"];
    $id = $_POST["id"];

    // Conta partite presenti 
    $sql = "SELECT COUNT(*) as n_partite FROM Partite WHERE id_avventura =".$id.";";
    $res=mysqli_execute_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
        $riga = mysqli_fetch_assoc($res);
        $numero = $riga["n_partite"]+1;
    } else {
        $numero = 1;
    }

    //Aggiugi partita 
    $sql = "INSERT INTO Partite(id_avventura, numero, titolo, descrizione, data_svolgimento) VALUES (".$id.", ".$numero.", '".$titolo."', '".$desc."', '".$data."');";
    mysqli_execute_query($conn, $sql);
     header("Location: dettagliCampagna.php?id=".$id."&accType=1");
    
?>