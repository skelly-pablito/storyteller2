<?php
    session_start();
    session_destroy(); 
    header("Location: loginForm.php");

    $expire = time() - 3600; 
    setcookie("reminder", "1", $expire);
?>