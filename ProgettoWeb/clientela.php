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
        <link rel="stylesheet" href="pr.css">
    </head>
    <body style="background-color: #01140d">
        <?php
        $queryTabella = "select * from persona";
        $risultato = mysqli_query($connetti, $queryTabella);
        if (mysqli_num_rows($risultato) > 0) {
            $resulset = mysqli_fetch_all($risultato);
            ?>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered">
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
                                    <th scope="col">Modifiche</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($resulset); $i++) { ?>
                                    <tr>
                                        <?php for ($j = 0; $j < count($resulset[$i]) - 1; $j++) { ?>
                                            <?php if ($j != 6) { ?>
                                                <td>
                                                    <?php
                                                    echo $resulset[$i][$j];
                                                    ?>
                                                </td>

                                            <?php } ?>
                                        <?php } ?>

                                        <td>
                                            <form id="form<?php echo $i.",".$j; ?>" action="clientela.php" method="post">
                                                <button type="button" class="btn btn-success" onclick="document.getElementById("form<?php echo $i.",".$j; ?> ).submit(); > <i class="fas fa-edit"></i>Modifica</button>
                                                <button type="button" class="btn btn-danger" onclick="document.getElementById("form<?php echo $i.",".$j; ?> ).submit();><i class="far fa-trash-alt"></i>Elimina</button>
                                            </form>

                                        </td>


                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </body>
    </html>

    <?php
}
?>