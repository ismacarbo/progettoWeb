<?php
include_once 'DBconnection.php';
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
    </head>
    <body style="background-color: #01140d">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <link rel="stylesheet" href="pr.css">


        <?php
        $persona = array("nome" => "", "cognome" => "", "codiceFiscale" => "", "numeroTelefono" => "", "indirizzo" => "", "dataNascita" => "", "email" => "", "password" => "", "tipo" => "");

        $nome = "";
        $codiceFiscale = "";
        $cognome = "";
        if ($_SERVER["REQUEST_METHOD"] && isset($_POST["nome"]) || isset($_POST["cognome"]) || isset($_POST["codiceFiscale"])) {
            $nome = controllaInput($_POST["nome"]);
            $cognome = controllaInput($_POST["cognome"]);
            $codiceFiscale = controllaInput($_POST["codiceFiscale"]);


            $preQuery = "SELECT * FROM persona WHERE nome='$nome' AND cognome='$cognome' AND codiceFiscale='$codiceFiscale'";
            $result = mysqli_query($connetti, $preQuery);

            if (mysqli_num_rows($result) != 0) {
                $results = mysqli_fetch_row($result);
                $persona["nome"] = $results[1];
                $persona["cognome"] = $results[2];
                $persona["codiceFiscale"] = $results[3];
                $persona["numeroTelefono"] = $results[4];
                $persona["indirizzo"] = $results[5];
                $persona["tipo"] = $results[6];
                $persona["dataNascita"] = $results[7];
                $persona["email"] = $results[8];
                $persona["password"] = $results[9];
            }

            if ($results[6] == "1") {
                ?>
                <div class="card mx-auto shadow-lg p-3 mb-5 bg-white rounded" style="width:400px; margin-top: 100px">
                    <img class="card-img-top" src="foto/img_avatar1.png" alt="Card image" style="width:100%">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $nome . "  " . $cognome; ?></h4>
                        <p class="card-text">Bentornato ad uno dei nostri migliori dipendenti! Clicca qui sono per vedere il lavoro di oggi ↓</p>
                    </div>
                </div>

                <div class="text" style="display: flex; justify-content: center">
                    <form id="form" action="newsDipendente.php" method="post">
                        <input type="text" hidden="true" name="codiceFiscale" value="<?php echo $codiceFiscale; ?>">
                        <a onclick="document.getElementById('form').submit();">Visualizza bacheca delle news </a>
                    </form>
                </div> 
                <?php
            } else {
                ?>
                <div class="card mx-auto shadow-lg p-3 mb-5 bg-white rounded" style="width:400px; margin-top: 100px">
                    <img class="card-img-top" src="foto/img_avatar1.png" alt="Card image" style="width:100%">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $nome . "  " . $cognome; ?></h4>
                        <p class="card-text">Benvenuto nell'area personale del centro reclami, qui potrai effettuare tutte le operazioni necessarie per migliorare l'ambiente che ti circonda!</p>
                    </div>
                </div>

                <div class="text" style="display: flex; justify-content: center">
                    <form id="form" action="reclamo.php" method="post">
                        <input type="text" hidden="true" name="codiceFiscale" value="<?php echo $codiceFiscale; ?>">
                        <a onclick="document.getElementById('form').submit();">Presenta un reclamo </a>
                    </form>
                </div> 
                <?php
            }

            $preQuery = "SELECT * FROM persona WHERE nome='$nome' AND cognome='$cognome' AND codiceFiscale='$codiceFiscale'";
            $result = mysqli_query($connetti, $preQuery);

            if (mysqli_num_rows($result) != 0) {
                $results = mysqli_fetch_row($result);
                $persona["nome"] = $results[1];
                $persona["cognome"] = $results[2];
                $persona["codiceFiscale"] = $results[3];
                $persona["numeroTelefono"] = $results[4];
                $persona["indirizzo"] = $results[5];
                $persona["dataNascita"] = $results[7];
                $persona["email"] = $results[8];
                $persona["password"] = $results[9];
            }
        }

        function controllaInput($input) {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);

            return $input;
        }
        ?>



    </body>
</html>