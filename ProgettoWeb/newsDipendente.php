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

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="news.css">
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
        $colors = array("blue", "red", "green", "yellow");
        $persona = array("nome" => "", "cognome" => "", "codiceFiscale" => "", "numeroTelefono" => "", "indirizzo" => "", "dataNascita" => "", "email" => "", "password" => "");
        $nome = "";
        $codiceFiscale = "";
        $cognome = "";
        $out = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["completato"]) && isset($_POST["codiceFiscale"])) {

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


            $queryGetReclami = "SELECT idProblema,descrizioneProblema,indirizzoProblema,dataReclamo,stato from problema WHERE stato='0'";
            $risultato = mysqli_query($connetti, $queryGetReclami);
            $dati = array("descrizione" => "", "indirizzo" => "", "data" => "", "stato" => "", "idProblema" => "");
            if (mysqli_num_rows($risultato) != 0) {
                $righe = mysqli_fetch_all($risultato);
                ?>

                <section class="dark" style="padding-bottom: 700px">
                    <div class="container py-4">
                        <h1 class="h1 text-center" id="pageHeaderTitle" style="color: white">BACHECA DELLE NEWS</h1>
                        <div class="col-md-15 mb-4 pb-2">
                            <div class="container h-100">
                                <div class="d-flex justify-content-center h-100">
                                    <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                        <div class="searchbar">
                                            <input class="search_input" type="text" name="ricerca" placeholder="Cerca...">
                                            <a onclick="document.getElementById('form').submit();" class="search_icon"><img style="height: 80px; width: 80px" src="foto/logo.png"/><i class="fas fa-search"></i></a>
                                        </div> 
                                    </form>

                                </div>
                            </div>
                        </div>

                        <?php
                        $dati = array("descrizione" => "", "indirizzo" => "", "data" => "");
                        for ($i = 0; $i < count($righe); $i++) {
                            for ($j = 0; $j < count($righe[$i]); $j++) {
                                $dati["descrizione"] = $righe[$i][1];
                                $dati["indirizzo"] = $righe[$i][2];
                                $dati["stato"] = $righe[$i][4];
                                $dati["idProblema"] = $righe[$i][0];
                            }
                            $dati["data"] = date("D M y", strtotime($righe[$i][3]));
                            ?>
                            <article class="postcard dark <?php echo $colors[rand(0, count($colors) - 1)]; ?>">
                                <a class="postcard__img_link"> 
                                    <iframe class="postcard__img" src="https://maps.google.com/maps?q=<?php echo $dati["indirizzo"]; ?>&output=embed" alt="Image Title"></iframe>
                                </a>
                                <div class="postcard__text" >
                                    <a <a href="https://it.wikipedia.org/wiki/<?php echo $dati["indirizzo"]; ?>">
                                        <h1 class="postcard__title blue"><?php echo $dati["indirizzo"]; ?> </h1>
                                    </a>
                                    <div class="postcard__subtitle small">

                                        <i class="fas fa-calendar-alt mr-2"><?php
                                            $date = explode("/", $dati["data"]);
                                            echo $date[0];
                                            ?></i>

                                        <i class="fas fa-calendar-alt mr-2"><div class="form-check">
                                                <form id="autoform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                                    <input class="form-check-input" type="checkbox"  id="flexCheckIndeterminate" onchange="this.form.submit()" name="completato" value="<?php echo $dati["idProblema"]; ?>">
                                                    <label class="form-check-label" for="flexCheckIndeterminate">
                                                        Lavoro completato
                                                    </label>

                                                </form>
                                            </div>

                                        </i>
                                    </div>
                                    <div class="postcard__bar"></div>
                                    <div class="postcard__preview-txt"><?php echo $dati["descrizione"]; ?></div>

                                </div>
                            </article>

                            <?php
                        }
                        ?>
                    </div>
                </section>
                <?php
            } else {
                $out = true;
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["completato"])) {

            $queryUPDATE = "UPDATE problema SET stato='1' WHERE idProblema='$_POST[completato]'";
            $risultato = mysqli_query($connetti, $queryUPDATE);
            if ($risultato) {


                $queryGetReclami = "SELECT idProblema,descrizioneProblema,indirizzoProblema,dataReclamo,stato from problema WHERE stato='0'";
                $risultato1 = mysqli_query($connetti, $queryGetReclami);
                $dati2 = array("descrizione" => "", "indirizzo" => "", "data" => "", "stato" => "", "idProblema" => "");
                if ($risultato1) {
                    $righe2 = mysqli_fetch_all($risultato1, MYSQLI_ASSOC);
                    if (count($righe2) > 0) {
                        ?>

                        <section class="dark" style="padding-bottom: 700px">
                            <div class="container py-4">
                                <h1 class="h1 text-center" id="pageHeaderTitle" style="color: white">BACHECA DELLE NEWS</h1>
                                <div class="col-md-15 mb-4 pb-2">
                                    <div class="container h-100">
                                        <div class="d-flex justify-content-center h-100">
                                            <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                                <div class="searchbar">
                                                    <input class="search_input" type="text" name="ricerca" placeholder="Cerca...">
                                                    <a onclick="document.getElementById('form').submit();" class="search_icon"><img style="height: 80px; width: 80px" src="foto/logo.png"/><i class="fas fa-search"></i></a>
                                                </div> 
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <?php
                                $dati = array("descrizione" => "", "indirizzo" => "", "data" => "");
                                for ($i = 0; $i < count($righe2); $i++) {
                                    for ($j = 0; $j < count($righe2[$i]); $j++) {
                                        $dati["descrizione"] = $righe2[$i][1];
                                        $dati["indirizzo"] = $righe2[$i][2];
                                        $dati["stato"] = $righe2[$i][4];
                                        $dati["idProblema"] = $righe2[$i][0];
                                    }
                                    $dati["data"] = date("D M y", strtotime($righe2[$i][3]));
                                    ?>
                                    <article class="postcard dark <?php echo $colors[rand(0, count($colors) - 1)]; ?>">
                                        <a class="postcard__img_link" href="#"> 
                                            <iframe class="postcard__img" src="https://maps.google.com/maps?q=<?php echo $dati["indirizzo"]; ?>&output=embed" alt="Image Title"></iframe>
                                        </a>
                                        <div class="postcard__text">
                                            <a <a href="https://it.wikipedia.org/wiki/<?php echo $dati["indirizzo"]; ?>">
                                                <h1 class="postcard__title blue"><?php echo $dati["indirizzo"]; ?> </h1>
                                            </a>
                                            <div class="postcard__subtitle small">

                                                <i class="fas fa-calendar-alt mr-2"><?php
                                                    $date = explode("/", $dati["data"]);
                                                    echo $date[0];
                                                    ?></i>

                                                <i class="fas fa-calendar-alt mr-2"><div class="form-check">
                                                        <form id="autoform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                                            <input class="form-check-input" type="checkbox"  id="flexCheckIndeterminate" onchange="this.form.submit()" name="completato" value="<?php echo $dati2["idProblema"]; ?>">
                                                            <label class="form-check-label" for="flexCheckIndeterminate">
                                                                Lavoro completato
                                                            </label>

                                                        </form>
                                                    </div>

                                                </i>
                                            </div>
                                            <div class="postcard__bar"></div>
                                            <div class="postcard__preview-txt"><?php echo $dati2["descrizione"]; ?></div>

                                        </div>
                                    </article>

                                    <?php
                                }
                                ?>
                            </div>
                        </section>
                        <?php
                    } else {
                        $queryGetReclami = "SELECT idProblema,descrizioneProblema,indirizzoProblema,dataReclamo,stato from problema WHERE stato='1'";
                        $risultato = mysqli_query($connetti, $queryGetReclami);
                        $dati = array("descrizione" => "", "indirizzo" => "", "data" => "", "stato" => "", "idProblema" => "");
                        if (mysqli_num_rows($risultato) != 0) {
                            $righe = mysqli_fetch_all($risultato);
                            ?>

                            <section class="dark" style="padding-bottom: 600px">
                                <div class="container py-4">
                                    <h1 class="h1 text-center" id="pageHeaderTitle" style="color: white">BACHECA DELLE NEWS: LAVORI COMPLETATI</h1>
                                    <div class="col-md-15 mb-4 pb-2">
                                        <div class="container h-100">
                                            <div class="d-flex justify-content-center h-100">
                                                <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                                    <div class="searchbar">
                                                        <input class="search_input" type="text" name="ricerca" placeholder="Cerca...">
                                                        <a onclick="document.getElementById('form').submit();" class="search_icon"><img style="height: 80px; width: 80px" src="foto/logo.png"/><i class="fas fa-search"></i></a>
                                                    </div> 
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    $dati = array("descrizione" => "", "indirizzo" => "", "data" => "");
                                    for ($i = 0; $i < count($righe); $i++) {
                                        for ($j = 0; $j < count($righe[$i]); $j++) {
                                            $dati["descrizione"] = $righe[$i][1];
                                            $dati["indirizzo"] = $righe[$i][2];
                                            $dati["stato"] = $righe[$i][4];
                                            $dati["idProblema"] = $righe[$i][0];
                                        }
                                        $dati["data"] = date("D M y", strtotime($righe[$i][3]));
                                        ?>
                                        <article class="postcard dark <?php echo $colors[rand(0, count($colors) - 1)]; ?>">
                                            <a class="postcard__img_link"> 
                                                <iframe class="postcard__img" src="https://maps.google.com/maps?q=<?php echo $dati["indirizzo"]; ?>&output=embed" alt="Image Title"></iframe>
                                            </a>
                                            <div class="postcard__text" >
                                                <a <a href="https://it.wikipedia.org/wiki/<?php echo $dati["indirizzo"]; ?>">
                                                    <h1 class="postcard__title blue"><?php echo $dati["indirizzo"]; ?> </h1>
                                                </a>
                                                <div class="postcard__subtitle small">

                                                    <i class="fas fa-calendar-alt mr-2"><?php
                                                        $date = explode("/", $dati["data"]);
                                                        echo $date[0];
                                                        ?></i>
                                                </div>
                                                <div class="postcard__bar"></div>
                                                <div class="postcard__preview-txt"><?php echo $dati["descrizione"]; ?></div>

                                            </div>
                                        </article>

                                        <?php
                                    }
                                    ?>
                                </div>
                            </section>
                            <?php
                        }
                    }
                }
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ricerca"])) {
            $indirizzoRicevuto = controllaInput($_POST["ricerca"]);
            $query3 = "SELECT descrizioneProblema,indirizzoProblema,dataReclamo FROM problema WHERE indirizzoProblema='$indirizzoRicevuto'";
            $risultato3 = mysqli_query($connetti, $query3);


            if (mysqli_num_rows($risultato3) != 0) {
                $righe2 = mysqli_fetch_all($risultato3);
                ?>

                <section class="dark" style="padding-bottom: 700px">
                    <div class="container py-4">
                        <h1 class="h1 text-center" id="pageHeaderTitle" style="color: white">BACHECA DELLE NEWS</h1>
                        <div class="col-md-15 mb-4 pb-2">
                            <div class="container h-100">
                                <div class="d-flex justify-content-center h-100">
                                    <form id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                        <div class="searchbar">
                                            <input class="search_input" type="text" name="ricerca" placeholder="Cerca...">
                                            <a onclick="document.getElementById('form').submit();" class="search_icon"><img style="height: 80px; width: 80px" src="foto/logo.png"/><i class="fas fa-search"></i></a>
                                        </div> 
                                    </form>

                                </div>
                            </div>
                        </div>

                        <?php
                        $dati2 = array("descrizione" => "", "indirizzo" => "", "data" => "");
                        for ($i = 0; $i < count($righe2); $i++) {
                            for ($j = 0; $j < count($righe2[$i]); $j++) {
                                $dati2["descrizione"] = $righe2[$i][0];
                                $dati2["indirizzo"] = $righe2[$i][1];
                            }
                            $dati2["data"] = date("D M y", strtotime($righe2[$i][2]));
                            ?>
                            <article class="postcard dark <?php echo $colors[rand(0, count($colors) - 1)]; ?>">
                                <a class="postcard__img_link" href="#"> 
                                    <iframe class="postcard__img" src="https://maps.google.com/maps?q=<?php echo $indirizzoRicevuto; ?>&output=embed" alt="Image Title"></iframe>
                                </a>
                                <div class="postcard__text">
                                    <a <a href="https://it.wikipedia.org/wiki/<?php echo $indirizzoRicevuto ?>">
                                        <h1 class="postcard__title blue"><?php echo $indirizzoRicevuto ?> </h1>
                                    </a>
                                    <div class="postcard__subtitle small">

                                        <i class="fas fa-calendar-alt mr-2"><?php
                                            $date2 = explode("/", $dati2["data"]);
                                            echo $date2[0];
                                            ?></i>

                                    </div>
                                    <div class="postcard__bar"></div>
                                    <div class="postcard__preview-txt"><?php echo $dati2["descrizione"]; ?></div>

                                </div>
                            </article>
                            <?php
                        }
                        ?>


                    </div>
                </section>

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
