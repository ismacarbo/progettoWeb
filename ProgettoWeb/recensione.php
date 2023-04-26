<?php
include_once 'DBconnection.php';
session_start();
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="recensione.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    </head>
    
    <body>
        
        <button class="btn1" onclick="history.back()"></i>Indietro</button>
        <style>
            .btn1 {
                
                margin-left: 30px;
                margin-top: 30px;
                background-color: #01146d;
                border: none;
                color: white;
                padding: 12px 16px;
                font-size: 16px;
                cursor: pointer;
            }

            .btn1:hover {
                background-color: RoyalBlue;
            }
        </style>
       

        <?php
        $id = "";
        $blocca = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
            $id = $_POST["id"];
            $_SESSION["id"] = $_POST["id"];
            $controllo = "select idPersona from persona where recensione<>0";
            $controlla = mysqli_query($connetti, $controllo);
            if ($controlla) {
                if (mysqli_num_rows($controlla) > 0) {
                    $result = mysqli_fetch_all($controlla);
                    for ($i = 0; $i < count($result); $i++) {
                        for ($j = 0; $j < count($result[$i]); $j++) {
                            if ($result[$i][$j] == $id) {
                                $blocca = true;
                            }
                        }
                    }
                }
            }
        }


        if (!$blocca) {
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="form" method="post">
                <div align="center" style="background: #01140d;  padding-top: 400px;color:white;">
                    <input type="text" hidden="true" id="hiddenInput" name="star" value="">
                    <div style="margin-bottom: 400px">
                        <i class="fa fa-star fa-2x" id="1"></i>
                        <i class="fa fa-star fa-2x" id="2"></i>
                        <i class="fa fa-star fa-2x" id="3"></i>
                        <i class="fa fa-star fa-2x" id="4"></i>
                        <i class="fa fa-star fa-2x" id="5"></i>
                    </div>

                    <br><br>
                </div>
            </form>

            <script>
                var form = document.getElementById("form");
                for (let i = 1; i <= 5; i++) {
                    document.getElementById("" + i).addEventListener("click", function () {
                        var input = document.getElementById("hiddenInput").value = this.id;
                        form.submit();
                    });
                }
            </script>

            <?php
        } else {
            ?>
            <h1>
                Hai già lasciato una recensione, grazie mille!
            </h1>
            <?php
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["star"])) {
            $stelle = trim($_POST["star"]);


            $id = $_SESSION["id"];
            echo $id;

            $query = "UPDATE persona SET recensione='$stelle' WHERE idPersona='$_SESSION[id]'";
            $update = mysqli_query($connetti, $query);
            $query2 = "SELECT nome,cognome,codiceFiscale from persona where idPersona='$id'";
            $run = mysqli_query($connetti, $query2);
            if ($run) {
                $risultato = mysqli_fetch_all($run);
                ?>
                <form id="form5" action="areaPersonale.php" method="post">
                    <input type="text" hidden="true" name="nome" value="<?php echo $risultato[0][0]; ?>">
                    <input type="text" hidden="true" name="cognome" value="<?php echo $risultato[0][1]; ?>">
                    <input type="text" hidden="true" name="codiceFiscale" value="<?php echo $risultato[0][2]; ?>">

                </form>
                <script>
                    alert('Grazie per la tua recensione!');
                    document.getElementById("form5").submit();
                </script>
                <?php
            }
            ?>



            <?php
        }
        ?>

 
                
    </body>
</html>
