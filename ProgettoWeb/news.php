<?php
include_once 'DBconnection.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>


        <link rel="stylesheet" href="pr.css">


    </head>

    <body style="background-color: #01140d">
        <?php
        $queryGetReclami = "SELECT descrizioneProblema,indirizzoProblema from problema";
        $risultato = mysqli_query($connetti, $queryGetReclami);
        if (mysqli_num_rows($risultato) != 0) {
            $righe = mysqli_fetch_all($risultato);
            ?>

            <div class="d-flex r row h-100 justify-content-center align-items-center">
                <div class="overflow-auto " style="height: 400px">
                    <?php
                    for ($i = 0; $i < count($righe); $i++) {
                        for ($j = 0; $j < count($righe[$i]); $j++) {
                            if ($righe[$i][$j] != $righe[$i][count($righe[$j]) - 1]) {
                                ?>
                                <div class="card m-2" style="max-width: 540px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <iframe width="100%" height="350" src="https://maps.google.com/maps?q=<?php echo $righe[$i][count($righe[$j]) - 1]; ?>&output=embed"></iframe>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $righe[$i][count($righe[$j]) - 1]; ?></h5>
                                                <p class="card-text">
                                                    <?php
                                                    echo $righe[$i][$j];
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                }
                            }
                        }
                        ?>
                    </div>

                </div>
            </div>
            <?php
        }
        ?>
    </body>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</html>
