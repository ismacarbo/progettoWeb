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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <link rel="stylesheet" href="pr.css">
        <button class="btn" onclick="location.href = 'index.php'"><i class="fa fa-home"></i> Home</button>
        <style>
            .btn {
                
                margin-left: 30px;
                margin-top: 30px;
                background-color: #01146d;
                border: none;
                color: white;
                padding: 12px 16px;
                font-size: 16px;
                cursor: pointer;
            }

            .btn:hover {
                background-color: RoyalBlue;
            }
        </style>

        <?php
        $persona = array("nome" => "", "cognome" => "", "codiceFiscale" => "", "numeroTelefono" => "", "indirizzo" => "", "dataNascita" => "", "email" => "", "password" => "", "tipo" => "", "id" => "");

        $nome = "";
        $codiceFiscale = "";
        $cognome = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nome"]) || isset($_POST["cognome"]) || isset($_POST["codiceFiscale"])) {
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
                $persona["id"] = $results[0];
            }

            if ($persona["tipo"] == "1") {
                $result = null;
                $queryRec = "SELECT avg(p.recensione) as media from persona as p where p.recensione!=0";
                $runQuery = mysqli_query($connetti, $queryRec);
                if ($runQuery) {
                    $result = mysqli_fetch_assoc($runQuery);
                }
                ?>

                <div class="card mx-auto shadow-lg p-3 mb-5 bg-white rounded" style="width:400px; margin-top: 100px">
                    <img class="card-img-top" src="foto/img_avatar1.png" alt="Card image" style="width:100%">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $nome . "  " . $cognome; ?></h4>
                        <p class="card-text">Bentornato ad uno dei nostri migliori dipendenti <br> Media recensioni clienti attuale: <?php echo round($result["media"], 2); ?> stelle</p>
                    </div>
                </div>



                <div class="text" style="display: flex; justify-content: center">
                    <form id="form" action="newsDipendente.php" method="post">
                        <input type="text" hidden="true" name="codiceFiscale" value="<?php echo $persona["codiceFiscale"]; ?>">
                        <a onclick="document.getElementById('form').submit();">Visualizza bacheca delle news </a>
                    </form>
                </div>

                <div class="text" style="display: flex; justify-content: center">
                    <form id="form1" action="clientela.php" method="post">
                        <a onclick="document.getElementById('form1').submit();">Visualizza dati sui clienti</a>
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

                <div class="text" style="display: flex; justify-content: center">
                    <form id="form1" action="news.php" method="post">
                        <a onclick="document.getElementById('form1').submit();">Bacheca delle news</a>
                    </form>
                </div> 

                <div class="text" style="display: flex; justify-content: center">
                    <form id="form2" action="ChatBot.php" method="post">
                        <a onclick="document.getElementById('form2').submit();">Fatti aiutare dal nostro mitico chatbot!</a>
                    </form>
                </div>
                <div class="text" style="display: flex; justify-content: center">
                    <form id="form3" action="recensione.php" method="post">
                        <input type="text" hidden="true" name="id" value="<?php echo $persona["id"]; ?>">
                        <a onclick="document.getElementById('form3').submit();">Lascia una recensione!</a>
                    </form>
                </div>
        <?php
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