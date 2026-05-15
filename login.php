<?php
    include "connect.php";
    session_start(); 

    if(isset($_POST)){
        $usr = $_POST["usr"];
        $pwd = $_POST["pwd"];

        $sql = "SELECT * FROM Utenti WHERE username=?;"; 
        $stmt = mysqli_prepare($conn, $sql); 
        mysqli_stmt_bind_param($stmt, "s", $usr);

        mysqli_execute($stmt); 
        $res=mysqli_stmt_get_result($stmt); 
        if(mysqli_num_rows($res) > 0){
             $riga = $res->fetch_assoc(); 
             if(password_verify($pwd, $riga["password"])==true){
                if(isset($_POST["remember"])){
                    $expire = time() + 86.400; 
                    setcookie("reminder", "1", $expire); 
                }
                $_SESSION["login"] = true; 
                $_SESSION["user"] = $riga; 
                header("Location: homepage.php");
             }else{
                header("Location: loginForm.php?error=1");
             }
        }else{
            header("Location: loginForm.php?error=2");
        }
    }else{
        header("Location loginForm.php");
    }
?>