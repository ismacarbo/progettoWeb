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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="styleLogin.css">
    <body>

        <?php if (!isset($_POST["oggetto"])) { ?>
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

                                            <div class="form-outline">
                                                <textarea type="text" id="oggetto" name="oggetto" id="oggetto" class="form-control form-control-lg" required=""></textarea>
                                                <label class="form-label" for="oggetto" >Messaggio</label>
                                            </div>
                                            <input  class="btn btn-outline-light btn-lg px-5" type="submit" value="INVIA">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>


            <?php
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["oggetto"])) {
            $email = "ismaele.carbonari@buonarroti.tn.it";
            $headers = array(
                "Authorization: Bearer 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",
                'Content-Type: application/json'
            );
            $dati = array(
                "personalizations"=>array(
                    array(
                        "to"=>array(
                            array(
                                "email"=>$email,
                                "name"=>"Ismaele"
                            )
                        )
                    )
                ),
                "from"=>array(
                    "email"=>$_POST["email"]
                ),
                "subject"=>"progettoWeb",
                "content"=>array(
                    array(
                        "type"=>"text/plain",
                        "value"=>$_POST["oggetto"]
                    )
                )
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dati));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $risposta = curl_exec($ch);
            curl_close($ch);
            ?>
            <section class="vh-100 gradient-custom">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card bg-dark text-white" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">

                                    <div class="mb-md-5 mt-md-4 pb-5">

                                        <h2 class="fw-bold mb-2 text-uppercase">Perfetto! Un dipendente ti risponderà il prima possibile</h2>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    <?php
}
?>
    </body>
</html>
