<?php
    session_start(); 
    if(!isset($_SESSION["login"]))
        header("Location: loginForm.php");
    include "connect.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["accept"] == "1"){
            $sql="UPDATE giocatoreavventura SET accepted=1 WHERE user=? AND id_avventura=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "si", $_SESSION["user"]["username"], $_POST["id_campagna"]); 
            mysqli_stmt_execute($stmt);           
        }
        else{
            $sql="DELETE FROM giocatoreavventura WHERE user=? AND id_avventura=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "si", $_SESSION["user"]["username"], $_POST["id_campagna"]); 
            mysqli_stmt_execute($stmt); 
        }
        header("Location: homepage.php");
    }
    
?>