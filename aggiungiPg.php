<?php
    include "connect.php";
    session_start();
    if(!isset($_SESSION["login"])){
        header("Location: index.php");
    }

    $idPg = $_GET["id"];
    $id_campagna = $_GET["id_campagna"];

    $sql =  "INSERT INTO PersonaggiAvventura (id_personaggio, id_avventura) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $idPg, $id_campagna);
    if(mysqli_stmt_execute($stmt))
        header("Location: dettagliCampagna.php?id=" . $id_campagna."&accType=2");
?> 