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
        <?php
        $persona = array("nome" => "", "cognome" => "", "codiceFiscale" => "", "numeroTelefono" => "", "indirizzo" => "", "dataNascita" => "", "email" => "", "password" => "");

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
        ?>
    </body>
</html>
