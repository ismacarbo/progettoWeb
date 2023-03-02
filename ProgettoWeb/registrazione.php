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

        <link rel="stylesheet" href="StyleLogin.css">

        <?php if (!isset($_POST["invia"])) { ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <section class="vh-100 gradient-custom">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card bg-dark text-white" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">
                                    <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registrazione</h3>
                                    <form>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">

                                                <div class="form-outline">
                                                    <input type="text" id="nome" name="nome" class="form-control form-control-lg" required="" pattern="[a-zA-Z]+" title="Puoi inserire solo lettere"/>
                                                    <label class="form-label" for="nome" >Nome</label>
                                                </div>

                                            </div>
                                            <div class="col-md-6 mb-4">

                                                <div class="form-outline">
                                                    <input type="text" id="cognome" name="cognome" class="form-control form-control-lg" required="" pattern="[a-zA-Z]+" title="Puoi inserire solo lettere"/>
                                                    <label class="form-label" for="cognome" >Cognome</label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4 d-flex align-items-center">

                                                <div class="form-outline datepicker w-100">
                                                    <input type="date" name="dataNascita" class="form-control form-control-lg" required="" id="dataNascita" />
                                                    <label for="dataNascita" class="form-label">Data di nascita</label>
                                                </div>

                                            </div>
                                            <div class="col-md-6 mb-4">

                                                <div class="form-outline">
                                                    <input type="text" id="indirizzo" name="indirizzo" class="form-control form-control-lg" required=""/>
                                                    <label class="form-label" for="indirizzo">Indirizzo</label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-4 pb-2">

                                                <div class="form-outline">
                                                    <input type="email" name="email" id="email" class="form-control form-control-lg" required=""/>
                                                    <label class="form-label" for="email" >Email</label>
                                                </div>

                                            </div>
                                            <div class="col-md-6 mb-4 pb-2">

                                                <div class="form-outline">
                                                    <input type="tel" id="numeroTelefono" required="" name="numeroTelefono" class="form-control form-control-lg" />
                                                    <label class="form-label" for="numeroTelefono">Numero di telefono</label>
                                                </div>

                                            </div>

                                            <div class="col-md-6 mb-4 pb-2">

                                                <div class="form-outline">
                                                    <input type="text" id="codiceFiscale" required="" name="codiceFiscale" class="form-control form-control-lg" />
                                                    <label class="form-label" for="codiceFiscale">Codice fiscale</label>
                                                </div>

                                            </div>

                                            <div class="col-md-6 mb-4 pb-2">

                                                <div class="form-outline">
                                                    <input type="password" name="password" id="password" class="form-control form-control-lg"required="" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$" title="Inserisci correttamente la password" />
                                                    <label class="form-label" for="password">Password</label>
                                                </div>
                                            </div>
                                        </div>



                                        

                                        <div class="mt-4 pt-2">
                                            <input  class="btn btn-outline-light btn-lg px-5" style="margin-top: 10px" type="submit" name="invia" value="INVIA">
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </section>
            </form>

            <?php
        }

        $persona = array("nome" => "", "cognome" => "", "dataNascita" => "", "indirizzo" => "", "email" => "", "codiceFiscale" => "", "password" => "", "numeroTelefono" => "");

        if ($_SERVER["REQUEST_METHOD"] && isset($_POST["invia"])) {
            $persona["nome"] = ucwords(strtolower(controllaInput($_POST["nome"])));
            $persona["cognome"] = ucwords(strtolower(controllaInput($_POST["cognome"])));
            $persona["numeroTelefono"] = controllaInput($_POST["numeroTelefono"]);
            $tempNascita = $_POST["dataNascita"];
            $tempNascita = str_replace("/", "-", $tempNascita);
            $timestamp = strtotime($tempNascita);
            $tempNascita = date("Y-m-d", $timestamp);
            $persona["dataNascita"] = $tempNascita;
            $persona["indirizzo"] = controllaInput($_POST["indirizzo"]);
            $persona["email"] = controllaInput($_POST["email"]);
            $persona["codiceFiscale"] = trim(strtoupper($_POST["codiceFiscale"]));
            $hash = hash('ripemd160', $_POST["password"]); //cripto la password
            echo substr($hash, 0, 30);
            $hash = substr($hash, 0, 30);
            $persona["password"] = $hash;
            
            print_r($persona);

            $preQuery = "SELECT passwordP FROM persona WHERE passwordP='$hash' OR codiceFiscale='$persona[codiceFiscale]'";
            $result = mysqli_query($connetti, $preQuery);

            if (mysqli_num_rows($result) != 0) {

                $righe = mysqli_fetch_row($result);
                print_r($righe);

                echo "già registrato";
                ?>


                <form id="autoform" action="areaPersonale.php" method="POST">
                    <input type="text" hidden="true" name="nome" value="<?php echo $persona["nome"]; ?>">
                    <input type="text" hidden="true" name="cognome" value="<?php echo $persona["cognome"]; ?>">
                    <input type="text" hidden="true" name="codiceFiscale" value="<?php echo $persona["codiceFiscale"]; ?>">
                </form>


                <script type="text/javascript">

                    function formAutoSubmit() {
                        var frm = document.getElementById("autoform");
                        frm.submit();
                    }

                    formAutoSubmit();
                </script>
                <?php
            } else {
                $file = fopen("hashes.txt", "a") or die("impossibile aprire il file");
                fwrite($file, $hash . "\n");
                fclose($file);

                $query = "INSERT INTO persona(nome,cognome,codiceFiscale,numeroTelefono,indirizzo,dataNascita,email,passwordP,idComune)"
                        . "VALUES('$persona[nome]','$persona[cognome]','$persona[codiceFiscale]','$persona[numeroTelefono]','$persona[indirizzo]','$persona[dataNascita]','$persona[email]','$persona[password]','1')";
                if (mysqli_query($connetti, $query)) {
                    ?>

                    <form id="autoform" action="areaPersonale.php" method="POST">
                        <input type="text" hidden="true" name="nome" value="<?php echo $persona["nome"]; ?>">
                        <input type="text" hidden="true" name="cognome" value="<?php echo $persona["cognome"]; ?>">
                        <input type="text" hidden="true" name="codiceFiscale" value="<?php echo $persona["codiceFiscale"]; ?>">
                    </form>



                    <script type="text/javascript">


                        function formAutoSubmit() {
                            var frm = document.getElementById("autoform");
                            frm.submit();
                        }

                        formAutoSubmit();
                    </script>
                    <?php
                    echo "valore inserito";
                } else {
                    echo "valore non inserito";
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

