<?php
    session_start(); 
    if(!isset($_SESSION["login"]))
        header("Location: index.php");
    include "connect.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nome = $_POST["nome"];
        $livello = $_POST["livello"];
        $classe = $_POST["classe"];
        $razza = $_POST["razza"];
        $for = $_POST["for"];
        $des = $_POST["des"];
        $cos = $_POST["cos"];
        $int = $_POST["int"];
        $sag = $_POST["sag"];
        $car = $_POST["car"];

        $user = $_SESSION["user"]["username"]; 
        $sql = "INSERT INTO personaggi (nome, livello, classe, razza, forza, destrezza, costituzione, intelligenza, saggezza, carisma, id_utente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sissiiiiiis", $nome, $livello, $classe, $razza, $for, $des, $cos, $int, $sag, $car, $user);
        mysqli_stmt_execute($stmt);
        
        echo "ok"; 
    }
?>
