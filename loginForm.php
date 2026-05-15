<?php
    include "connect.php";
    
    //Cookie per ricodare accesso (non implementato)
    if(isset($_COOKIE["reminder"]))
        header("Location: homepage.php");
        
?>
<!DOCTYPE html>
<html>
    <head> 
        <!--Sfondo da https://tiled-bg.blogspot.com/2013/03/green-stone-seamless-web-texture.html -->
        <title>Storyteller</title>
        <link rel="stylesheet" href="w3.css">
        <style>
            body, h1, h2, h3, h4, h5, h6 {
                 font-family: Georgia, serif;
            }
            body {
                background-image: url("green-stone-seamless-web-texture.jpg");
                background-repeat: repeat;
            }
        </style>
        <script>
            const urlParams = new URLSearchParams(window.location.search);
            const error = urlParams.get('error');
            if(error !== null){
                if(error == 1){
                    alert("Password errata");
                }else if(error == 2){
                    alert("Username non esistente");
                }
        }
        </script>
    </head> 
    <body>
        <div class="w3-container w3-light-green">
            <h2>Storyteller</h2>
        </div>


        <div class="w3-container w3-display-middle"> 
            <h1> Benvenuto </h1> 
            <div class="w3-card w3-padding w3-light-green w3-animate-bottom" style="width:400px;">
                
                <h3> Accedi a Storyteller</h3>
                <form class="w3-container" action="login.php" method="post">
                    <label>Username:</label> <input class="w3-input" type="text" name="usr"> <br>
                    <label>Password:</label> <input class="w3-input" type="password" name="pwd"> <br>
                    <input class="w3-check w3-green" type="checkbox" name="remember"> <label> Ricorda accesso </label> <br>
                    <button class="w3-button w3-border w3-margin w3-green" type="submit"> Accedi </button>
                </form>
                <p>Non hai un account? <a href="registerForm.php"> Registrati </a></p>
            </div>
        </div>

        <div class="w3-container w3-display-bottomleft w3-light-green">
            <h6>Un progetto di Paolo Colombo</h6>
        </div>
    </body>
</html> 
 