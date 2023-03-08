<?php
include_once 'DBconnection.php';
?>
<!DOCTYPE html>

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


        <?php
        $colors = array("blue", "red", "green", "yellow");
        if (!isset($_POST["ricerca"])) {


            $queryGetReclami = "SELECT descrizioneProblema,indirizzoProblema,dataReclamo,stato from problema";
            $risultato = mysqli_query($connetti, $queryGetReclami);
            if (mysqli_num_rows($risultato) != 0) {
                $righe = mysqli_fetch_all($risultato);
                ?>




                <section class="dark" style="padding-bottom: 700px">
                    <div style="margin-left: 50px; padding-top: 30px; width: 200px; height: 20px; font-size: 25px" class="btn btn-link"> <a  href="index.php">Torna alla home</a> </div>
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
                        $dati = array("descrizione" => "", "indirizzo" => "", "data" => "", "stato" => "");
                        for ($i = 0; $i < count($righe); $i++) {
                            for ($j = 0; $j < count($righe[$i]); $j++) {
                                $dati["descrizione"] = $righe[$i][0];
                                $dati["indirizzo"] = $righe[$i][1];
                            }
                            $dati["data"] = date("D M y", strtotime($righe[$i][2]));
                            $dati["stato"] = $righe[$i][3];
                            ?>
                            <article class="postcard dark <?php echo $colors[rand(0, count($colors) - 1)]; ?>">
                                <a class="postcard__img_link" href="#"> 
                                    <iframe class="postcard__img" src="https://maps.google.com/maps?q=<?php echo $dati["indirizzo"]; ?>&output=embed" alt="Image Title"></iframe>
                                </a>
                                <div class="postcard__text">
                                    <h1 class="postcard__title blue"><?php echo $dati["indirizzo"]; ?></h1>
                                    <div class="postcard__subtitle small">

                                        <i class="fas fa-calendar-alt mr-2"><?php
                                            $date = explode("/", $dati["data"]);
                                            echo $date[0];
                                            ?></i>
                                        <i class="fas fa-calendar-alt mr-2">Stato: <?php
                                            if ($dati["stato"] == "0") {
                                                echo "in corso";
                                            } else {
                                                echo "Problema risolto";
                                            }
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
        } else {
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
                                        <h1 class="postcard__title blue"><?php echo $indirizzoRicevuto; ?></h1>
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
                } else {
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
                            <h1 class="h1 text-center" id="pageHeaderTitle" style="color: white">Non è stato trovato nessun reclamo, effettua nuovamente la ricerca!</h1>
                        </div>
                    </section>
                    <?php
                }
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
