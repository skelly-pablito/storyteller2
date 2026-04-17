<?php
    $conn=mysqli_connect("localhost", "root", "", "storyteller");
    if(!$conn) die("Connessione al database fallita!\n" . mysqli_error($conn)); 
?>