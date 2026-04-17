<?php
    include "connect.php";
    //implement login cookie
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
    </head> 
    <body>
        <div class="w3-container w3-light-green">
            <h2>Storyteller</h3>
        </div>
        <div class="w3-container w3-display-middle"> 
             
            <div class="w3-card w3-padding w3-light-green w3-animate-bottom" style="width:400px;">
                
                <form class="w3-container" action="register.php" method="post">
                    <h3> Registrati a Storyteller </h3>
                    <label>Username:</label> <input class="w3-input" type="text" name="usr"> <br>
                     <label>Email:</label> <input class="w3-input" type="text" name="mail"> <br>
                    <label>Password:</label> <input class="w3-input" type="password" name="pwd"> <br>
                    <button class="w3-button w3-border w3-margin w3-green" type="submit"> Registrati </button>
                </form>
                <p>Hai già un account? <a href="loginForm.php"> Accedi </a></p>
            </div>
        </div>

        <div class="w3-container w3-display-bottomleft w3-light-green">
            <h6>Un progetto di Paolo Colombo</h6>
        </div>
    </body>
</html> 
 