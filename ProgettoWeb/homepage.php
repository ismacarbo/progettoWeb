<?php
include_once 'DBconnection.php';

if (!isset($_SESSION["primo_run"])) {
    $_SESSION["primo_run"] = 1;
    include 'createDB';
}
?>


<!DOCTYPE html>

<html>
    <head>
        <title>HomePage </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <link rel="stylesheet" href="pr.css">


    </head>
    <body>
        <section class="showcase">
            <header>
                <h2 class="logo"> <a href="https://www.alpecimbra.it/it/alpe-cimbra/1-0.html">Scopri l'Alpe Cimbra</a> </h2>
                <div class="toggle" accesskey=""></div>
            </header>
            <div class="overlay"></div>
            <div class="text">
                <h2>Alpe Cimbra</h2> 
                <h3>Centro reclami e consigli</h3>
                <p>Benvenuto sul sito del centro reclami di Folgaria, qui potrai effettuare richieste di costruzione e ristturazioni ambientali semplicemente accedendo 
                    all'area personale. Migliora te stesso e l'ambiente in cui vivi.</p>
                <a href="index.php">Accedi</a>
            </div>
            <ul class="social">
                <li><a href="https://www.facebook.com/groups/257262689684/"><img src="https://i.ibb.co/x7P24fL/facebook.png"></a></li>
                <li><a href="https://twitter.com/folgariaski"><img src="https://i.ibb.co/Wnxq2Nq/twitter.png"></a></li>
                <li><a href="https://www.instagram.com/comune_di_folgaria/?hl=it"><img src="https://i.ibb.co/ySwtH4B/instagram.png"></a></li>
            </ul>
        </section>
        <div class="menu">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="index.php">Area Personale</a></li>
            </ul>
        </div>
    </body>
    <script src="prove.js"></script>
</html>