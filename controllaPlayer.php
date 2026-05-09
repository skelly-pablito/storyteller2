<?php
    $player = $_POST["username"];
    include "connect.php";
    $sql = "SELECT * FROM utenti WHERE username='$player';";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){
        //Player esiste
        echo "200";
    } else {
        //Player non esiste
        echo "404";
    }
?>