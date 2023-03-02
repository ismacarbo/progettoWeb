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

        <link rel="stylesheet" href="styleLogin.css">

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <section class="vh-100 gradient-custom">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card bg-dark text-white" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">

                                    <div class="mb-md-5 mt-md-4 pb-5">

                                        <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                        <p class="text-white-50 mb-5">Inserisci email e password</p>

                                        <div class="form-outline form-white mb-4">
                                            <input class="form-control form-control-lg" name="email" type="email" required="">
                                            <label class="form-label" for="typeEmailX">Email</label>
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <input class="form-control form-control-lg" name="password" type="password" required="" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$" title="Inserisci correttamente la password">
                                            <label class="form-label" for="typePasswordX">Password</label>
                                        </div>
                                        <input  class="btn btn-outline-light btn-lg px-5" type="submit" value="INVIA">

                                        <div hidden="true" id="nonLoggato" style="margin-bottom: -80px">
                                            <br>
                                            <br>
                                            Non sembri essere registrato, rimedia subito cliccando qui sotto ↓
                                        </div>

                                    </div>


                                    <div > 
                                        <p class="mb-0">Non hai un account? <a href="registrazione.php" class="text-white-50 fw-bold">Registrati</a>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>



        <?php
        $emailERR = "";
        $dati = array("email" => "", "password" => "");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $dati["email"] = $_POST["email"];
            $tempPass = $_POST["password"];
            checkPassword($tempPass);
            if ($dati["password"] != "") {
                echo $dati["password"];
                $query = "SELECT email FROM persona WHERE email='$dati[email]' AND passwordP='$dati[password]'";
                $risultato = mysqli_query($connetti, $query);
                if (mysqli_num_rows($risultato) != 0) {
                    echo "benvenuto";

                    $queryNuova = "SELECT * FROM persona WHERE email='$dati[email]' AND passwordP='$dati[password]'";
                    $risultato2 = mysqli_query($connetti, $queryNuova);
                    $results = mysqli_fetch_row($risultato2);
                    print_r($results);
                    ?>

                    <form id="autoform" action="areaPersonale.php" method="POST">
                        <input type="text" hidden="true" name="nome" value="<?php echo $results[1]; ?>">
                        <input type="text" hidden="true" name="cognome" value="<?php echo $results[2]; ?>">
                        <input type="text" hidden="true" name="codiceFiscale" value="<?php echo $results[3]; ?>">
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
                    ?> 
                    <script>
                        document.getElementById("nonLoggato").hidden = false;
                    </script>
                    <?php
                }
            } else {
                ?> 
                <script>
                    document.getElementById("nonLoggato").hidden = false;
                    document.getElementById("nonLoggato").innerHTML = "password non presente nel sistema, riprovare";
                </script>
                <?php
            }
        }

        function checkPassword($input) {
            global $dati, $connetti;

            $hashToCompare = hash('ripemd160', $input);
            $hashToCompare = substr($hashToCompare, 0, 30);
            $queryPassword = "SELECT * FROM persona WHERE passwordP='$hashToCompare'";
            $risultato = mysqli_query($connetti, $queryPassword);
            if (mysqli_num_rows($risultato) != 0) {
                $dati["password"] = $hashToCompare;
                return true;
            } else { {
                    return false;
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

