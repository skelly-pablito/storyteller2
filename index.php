<?php
    include "connect.php";
    $file = fopen("tables.sql", "r");
    while($sql = fgets($file)){
        mysqli_query($conn, $sql);

        if(mysqli_error($conn)){
            die("Errore!!!\n" + mysqli_error($conn));
        }
    }
    header("Location: loginForm.php"); 
?>