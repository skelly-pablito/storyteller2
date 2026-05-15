<?php
    $player = $_POST["username"];
    include "connect.php";
    $sql = "SELECT * FROM utenti WHERE username='$player';";
    $res = mysqli_query($conn, $sql);
    if(mysqli_num_rows($res) > 0){ 
        if(isset($_POST["campagna"])){
            //Controllare se il player e' gia associato alla campagna
                $campagna = $_POST["campagna"];
                $sql = "SELECT * FROM GiocatoreAvventura WHERE id_avventura =".$campagna.";";
                $res = mysqli_query($conn, $sql);
                if(mysqli_num_rows($res) > 0){
                    while($riga = mysqli_fetch_assoc($res)){
                        if($riga["user"] == $player){
                            //Player gia' associato alla campagna
                            echo "400";
                            exit();
                        }
                    }
                        //Player non associato alla campagna
                        echo "200";
                        exit();
                } else {
                    //Nessun player associato alla campagna
                    echo "200";
                    exit();
                }

        } else {
            //Player esiste ma non ha una campagna (OK)
            echo "200";
            exit();
        }
    } else {
        //Player non esiste
        echo "404";
        exit();
    }
?>