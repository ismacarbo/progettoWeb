<!DOCTYPE html>
<?php
include_once 'DBconnection.php';
?>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <link rel="stylesheet" href="tableClientela.css">
    </head>
    <body style="background-color: #01140d">
        <br>
        <br>
        <h1>Gestione Clientela</h1>
        <br>
        <br>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["invia"])) {

            $tempNascita = $_POST["dataNascita"];
            $tempNascita = str_replace("/", "-", $tempNascita);
            $timestamp = strtotime($tempNascita);
            $tempNascita = date("Y-m-d", $timestamp);
            $hash = hash('ripemd160', $_POST["password"]);

            $query = "UPDATE persona SET "
                    . "nome              = '$_POST[nome]', "
                    . "cognome           = '$_POST[cognome]', "
                    . "codiceFiscale    = '$_POST[codiceFiscale]', "
                    . "numeroTelefono      = '$_POST[numeroTelefono]', "
                    . "indirizzo       = '$_POST[indirizzo]', "
                    . "tipo       = '1', "
                    . "dataNascita       = '$tempNascita', "
                    . "email       = '$_POST[email]', "
                    . "passwordP       = '$hash', "
                    . "idComune       = '1'"
                    . "WHERE idPersona = '$_POST[ID]'";
            $update = mysqli_query($connetti, $query);
            header("refresh:3; url=clientela.php");
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["invia2"])) {

            $query = "DELETE FROM persona WHERE idPersona = '$_POST[ID]'";

            $delete = mysqli_query($connetti, $query);
            header("refresh:3; url=clientela.php");
        }



        if (!isset($_GET["modifica"]) && !isset($_GET["elimina"])) {




            $queryTabella = "select idPersona,nome,cognome,codiceFiscale,numeroTelefono,indirizzo,dataNascita,email,passwordP from persona";
            $risultato = mysqli_query($connetti, $queryTabella);
            if (mysqli_num_rows($risultato) > 0) {
                $resulset = mysqli_fetch_all($risultato);
                ?>
                <table class="container">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Cognome</th>
                            <th scope="col">Codice Fiscale</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Indirizzo</th>
                            <th scope="col">Data Nascita</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($resulset); $i++) { ?>
                            <tr>
                                <?php for ($j = 0; $j < count($resulset[$i]) - 1; $j++) { ?>
                                    <td>
                                        <?php
                                        echo $resulset[$i][$j];
                                        ?>
                                    </td>
                                <?php } ?>

                                <td>
                                    <form id="form<?php echo $i . "," . $j; ?>" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                                        <input type="submit" value="modifica" name="modifica" class="btn btn-success" onclick="document.getElementById("form<?php echo $i . "," . $j; ?> ).submit(); >
                                        <br>
                                        <input hidden="true" name="id" value="<?php echo $resulset[$i][0]; ?>">
                                        <br>
                                        <input type="submit"  name="elimina" value="elimina" class="btn btn-danger" onclick="document.getElementById("form<?php echo $i . "," . $j; ?> ).submit();>
                                    </form>

                                </td>


                            </tr>

                        <?php } ?>
                    </tbody>
                </table>



            </body>
        </html>

        <?php
    }
} else {
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["modifica"])) {

        $id = $_GET["id"];
        echo $id;
        $queryGet = "select * from persona where idPersona='$id'";
        $risultato2 = mysqli_query($connetti, $queryGet);
        if (mysqli_num_rows($risultato2) > 0) {
            $resulset2 = mysqli_fetch_all($risultato2);
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <table class="container">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Cognome</th>
                            <th scope="col">CodiceFiscale</th>
                            <th scope="col">Numero Telefono</th>
                            <th scope="col">Indirizzo</th>
                            <th scope="col">Data Nascita</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($resulset2); $i++) { ?>
                            <tr>
                                <?php for ($j = 0; $j < count($resulset2[$i]) - 1; $j++) { ?>
                                    <?php if ($j != 6) { ?>
                                        <td>
                                            <?php
                                            echo $resulset2[$i][$j];
                                            ?>
                                        </td>

                                    <?php } ?>
                                <?php } ?>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>


                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Modifica Dati</h3>


                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <input type="text" id="nome" name="nome" class="form-control form-control-lg" value="<?php echo $resulset2[0][1]; ?>" required="" pattern="[a-zA-Z]+" title="Puoi inserire solo lettere"/>
                                            <label class="form-label" for="nome" >Nome</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <input type="text" id="cognome" name="cognome" class="form-control form-control-lg" required="" value="<?php echo $resulset2[0][2]; ?>" pattern="[a-zA-Z]+" title="Puoi inserire solo lettere"/>
                                            <label class="form-label" for="cognome" >Cognome</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">

                                        <div class="form-outline datepicker w-100">
                                            <input type="date" name="dataNascita" class="form-control form-control-lg" required="" value="<?php echo $resulset2[0][7]; ?>" id="dataNascita" />
                                            <label for="dataNascita" class="form-label">Data di nascita</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <input type="text" id="indirizzo" name="indirizzo" class="form-control form-control-lg" value="<?php echo $resulset2[0][5]; ?>" required=""/>
                                            <label class="form-label" for="indirizzo">Indirizzo</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">

                                        <div class="form-outline">
                                            <input type="email" name="email" id="email" class="form-control form-control-lg" value="<?php echo $resulset2[0][8]; ?>"required=""/>
                                            <label class="form-label" for="email" >Email</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4 pb-2">

                                        <div class="form-outline">
                                            <input type="tel" id="numeroTelefono" required="" name="numeroTelefono" value="<?php echo $resulset2[0][4]; ?>" class="form-control form-control-lg" />
                                            <label class="form-label" for="numeroTelefono">Numero di telefono</label>
                                        </div>

                                    </div>

                                    <div class="col-md-6 mb-4 pb-2">

                                        <div class="form-outline">
                                            <input type="text" id="codiceFiscale" required="" name="codiceFiscale" value="<?php echo $resulset2[0][3]; ?>" class="form-control form-control-lg" />
                                            <label class="form-label" for="codiceFiscale">Codice fiscale</label>
                                        </div>

                                    </div>

                                    <div class="col-md-6 mb-4 pb-2">

                                        <div class="form-outline">
                                            <input  name="password" id="password" value="<?php echo $resulset2[0][9]; ?>" class="form-control form-control-lg"required=""  />
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="mt-4 pt-2">
                                    <input type="text" hidden="true" name="ID" value="<?php echo $id; ?>">
                                    <input  class="btn btn-outline-light btn-lg px-5" style="margin-top: 10px" type="submit" name="invia" value="MODIFICA">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            </form>

            <?php
        }
    } else {
        $id = $_GET["id"];
        $queryGet = "select * from persona where idPersona='$id'";
        $risultato2 = mysqli_query($connetti, $queryGet);
        if (mysqli_num_rows($risultato2) > 0) {
            $resulset2 = mysqli_fetch_all($risultato2);
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <<table class="container">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Cognome</th>
                            <th scope="col">CodiceFiscale</th>
                            <th scope="col">Numero Telefono</th>
                            <th scope="col">Indirizzo</th>
                            <th scope="col">Data Nascita</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($resulset2); $i++) { ?>
                            <tr>
                                <?php for ($j = 0; $j < count($resulset2[$i]) - 1; $j++) { ?>
                                    <?php if ($j != 6) { ?>
                                        <td>
                                            <?php
                                            echo $resulset2[$i][$j];
                                            ?>
                                        </td>

                                    <?php } ?>
                                <?php } ?>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>


                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Eliminazione Dati</h3>


                                <div class="row">
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <input readonly="" type="text" id="nome" name="nome" class="form-control form-control-lg" value="<?php echo $resulset2[0][1]; ?>" required="" pattern="[a-zA-Z]+" title="Puoi inserire solo lettere"/>
                                            <label class="form-label" for="nome" >Nome</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <input readonly="" type="text" id="cognome" name="cognome" class="form-control form-control-lg" required="" value="<?php echo $resulset2[0][2]; ?>" pattern="[a-zA-Z]+" title="Puoi inserire solo lettere"/>
                                            <label class="form-label" for="cognome" >Cognome</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">

                                        <div class="form-outline datepicker w-100">
                                            <input readonly="" type="date" name="dataNascita" class="form-control form-control-lg" required="" value="<?php echo $resulset2[0][7]; ?>" id="dataNascita" />
                                            <label for="dataNascita" class="form-label">Data di nascita</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4">

                                        <div class="form-outline">
                                            <input readonly="" type="text" id="indirizzo" name="indirizzo" class="form-control form-control-lg" value="<?php echo $resulset2[0][5]; ?>" required=""/>
                                            <label class="form-label" for="indirizzo">Indirizzo</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">

                                        <div class="form-outline">
                                            <input readonly="" type="email" name="email" id="email" class="form-control form-control-lg" value="<?php echo $resulset2[0][8]; ?>"required=""/>
                                            <label class="form-label" for="email" >Email</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4 pb-2">

                                        <div class="form-outline">
                                            <input readonly="" type="tel" id="numeroTelefono" required="" name="numeroTelefono" value="<?php echo $resulset2[0][4]; ?>" class="form-control form-control-lg" />
                                            <label class="form-label" for="numeroTelefono">Numero di telefono</label>
                                        </div>

                                    </div>

                                    <div class="col-md-6 mb-4 pb-2">

                                        <div class="form-outline">
                                            <input readonly="" type="text" id="codiceFiscale" required="" name="codiceFiscale" value="<?php echo $resulset2[0][3]; ?>" class="form-control form-control-lg" />
                                            <label class="form-label" for="codiceFiscale">Codice fiscale</label>
                                        </div>

                                    </div>

                                    <div class="col-md-6 mb-4 pb-2">

                                        <div class="form-outline">
                                            <input readonly="" name="password" id="password" value="<?php echo $resulset2[0][9]; ?>" class="form-control form-control-lg"required="" />
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 pt-2">
                                    <input type="text" hidden="true" name="ID" value="<?php echo $id; ?>">
                                    <input  class="btn btn-outline-light btn-lg px-5" style="margin-top: 10px" type="submit" name="invia2" value="ELIMINA">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            </form>
            <?php
        }
    }
}
?>