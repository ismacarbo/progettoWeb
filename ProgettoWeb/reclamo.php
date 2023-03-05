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
    <body>


        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="reclamo.css">

        <?php if (!isset($_POST["invia"])) { ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <section class="vh-100 gradient-custom">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card bg-dark text-white" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">
                                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Inserimento Problema</h3>

                                    <div class="mb-md-5 mt-md-4 pb-5">

                                        <div class="form-outline">
                                            <textarea type="text" id="descrizione" name="descrizione" id="descrizione" class="form-control form-control-lg" required=""></textarea>
                                            <label class="form-label" for="descrizione" >Descrizione Problema</label>
                                        </div>

                                        <br>
                                        <br>

                                        <div class="form-outline">
                                            <input type="text" id="indirizzoProblema" name="indirizzoProblema" id="indirizzoProblema" class="form-control form-control-lg" required="">
                                            <label class="form-label" for="indirizzoProblema" >Indirizzo Problema</label>
                                        </div>

                                        <br>
                                        <br>


                                        <label class="mb-3 mr-1">Tipo Problema: </label>

                                        <input type="radio" class="btn-check" value="0" name="tipo" id="ristrutturazione" autocomplete="off" >
                                        <label class="btn btn-sm btn-outline-secondary" for="ristrutturazione">Ristrutturazione</label>

                                        <input type="radio" class="btn-check" value="1" name="tipo" id="costruzione" autocomplete="off" checked="">
                                        <label class="btn btn-sm btn-outline-secondary" for="costruzione">Costruzione</label>



                                        <div class="mt-4 pt-2">
                                            <input  class="btn btn-outline-light btn-lg px-5" style="margin-top: 10px" type="submit" name="invia" value="INVIA">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>




            <?php
            $persona = array("nome" => "", "cognome" => "", "codiceFiscale" => "", "numeroTelefono" => "", "indirizzo" => "", "dataNascita" => "", "email" => "", "password" => "");
            $problema = array("descrizioneProblema" => "", "idComune" => "", "tipo" => "");
        } else {
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["invia"])) {
                $problema["descrizioneProblema"] = controllaInput($_POST["descrizione"]);
                $getComune = "SELECT idComune FROM comune";
                $resultComune = mysqli_query($connetti, $getComune);
                $righe2 = mysqli_fetch_row($resultComune);
                $lastComune = $righe2[count($righe2) - 1];
                $problema["idComune"] = controllaInput($lastComune);
                $problema["tipo"] = controllaInput($_POST["tipo"]);

                $queryInserimento = "INSERT INTO problema(descrizioneProblema,idComune,tipo) VALUES('$problema[descrizioneProblema]'"
                        . ",'$problema[idComune]','$problema[tipo]')";

                if (mysqli_query($connetti, $queryInserimento)) {
                    echo "inserito reclamo";
                } else {
                    echo "no bro";
                }
            }
        }


        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["codiceFiscale"])) {
            echo $_POST["codiceFiscale"];

            $preQuery = "SELECT * FROM persona WHERE codiceFiscale='$_POST[codiceFiscale]'";
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


            print_r($persona);
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
